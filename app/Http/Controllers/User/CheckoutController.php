<?php

namespace App\Http\Controllers\User;

use App\Models\DeliveryModel;
use App\Models\DetailOrderModel;
use App\Models\OrderModel;
use App\Models\PaymentModel;
use App\Models\ShoppingCartModel;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function store(Request $request)
    {
        try {
            Log::info('DATA CHECKOUT:', $request->all());

            // Simpan data pengiriman
            $delivery = DeliveryModel::create([
                'destination_code' => $request->destination_code,
                'destination' => $request->destination,
                'courier' => $request->courier,
                'delivery_type' => $request->delivery_type,
                'delivery_cost' => $request->delivery_cost,
                'estimated_day' => $request->estimated_day,
            ]);

            // Simpan data pembayaran
            $payment = PaymentModel::create([
                'payment_code' => $request->payment_code,
                'payment_type' => $request->payment_type, // pastikan ada payment_method
                'bank' => $request->bank ?? null,
                'amount' => $request->amount,
                'status' => 'paid',
            ]);

            // Simpan data order
            $order = OrderModel::create([
                'id_delivery' => $delivery->id_delivery,
                'id_payment' => $payment->id_payment,
                'id_user' => Auth::user()->id_user,
                'order_code' => 'ORD-' . strtoupper(Str::random(8)),
                'code_promo' => $request->code_promo ?? '',
                'status_payment' => 'Paid',
            ]);

            // Simpan detail pesanan (jika ada order_ids dari frontend)
            if (is_array($request->order_ids)) {
                foreach ($request->order_ids as $id_cart) {
                   $cart =  ShoppingCartModel::where('id_cart', $id_cart)->first();
                   Log::info('DATA KERANJANG:', ['id_product' => $cart->quantity]); 
                    DetailOrderModel::create([
                        'id_order' => $order->id_order,
                        'id_product' => $cart->id_product,
                        'quantity' => $cart->quantity,
                    ]);
                }
            }

            return response()->json([
                'success' => true,
                'message' => 'Checkout berhasil',
                'order_id' => $order->id,
            ]);
        } catch (\Exception $e) {
            Log::error('Checkout Error:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTrace(),
            ]);

            return response()->json(
                [
                    'success' => false,
                    'message' => 'Terjadi kesalahan saat proses checkout',
                    'error' => $e->getMessage(),
                ],
                500,
            );
        }
    }
}
