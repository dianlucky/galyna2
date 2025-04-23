<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\OrderModel;
use App\Models\ProductModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Transaction as TransactionMidtrans;

class OrderController extends Controller
{
    public function __construct()
    {
        Config::$serverKey = config('app.midtrans.server_key');
        Config::$isProduction = config('app.midtrans.is_production');
        Config::$isSanitized = config('app.midtrans.is_sanitized');
        Config::$is3ds = config('app.midtrans.is_3ds');
    }

    public function showOrderForm($code_product = null)
    {
        $product = ProductModel::where('code', $code_product)->first();
        return view('public_user.product.make_order', [
            'product' => $product
        ]);
    }

    public function storeOrder(Request $request)
    {
        $request->validate([
            'id_product' => 'required|exists:product,id_product',
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|numeric',
            'address' => 'required',
            'quantity' => 'required|numeric|min:1',
        ]);

        $checkIfOrderExist = OrderModel::where('id_product', $request->id_product)
            ->where('id_user', Auth::user()->id_user)
            ->where('status', 'pending')
            ->first();
        if ($checkIfOrderExist) {
            session()->flash('error', 'You already have an order for this product');
            return redirect('order/' . $checkIfOrderExist->code);
        }

        DB::beginTransaction();
        try {

            $product = ProductModel::find($request->id_product);
            $code = 'ORD' . time();
            $total = $request->quantity * $product->price;

            $payload = [
                'transaction_details' => [
                    'order_id' => $code,
                    'gross_amount' => $total,
                ],
                'customer_details' => [
                    'first_name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'shipping_address' => $request->address,
                ],
            ];

            $snapToken = Snap::getSnapToken($payload);
            OrderModel::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'message' => $request->message,
                'status' => 'pending',
                'id_user' => Auth::user()->id_user,
                'id_product' => $product->id_product,
                'quantity' => $request->quantity,
                'total' => $total,
                'code' => $code,
                'transaction_token' => $snapToken,
            ]);

            DB::commit();
            session()->flash('success', 'Order saved successfully');
            return redirect('my-order');
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', $e->getMessage());
            return redirect()->back();
        }
    }

    public function myOrder()
    {
        $orders = OrderModel::where('id_user', Auth::user()->id_user)->get();
        return view('public_user.product.my_order', [
            'orders' => $orders
        ]);
    }

    public function orderPayment($code)
    {
        $order = OrderModel::where('code', $code)->first();
        if ($this->checkStatusTransaction($code)) {
            $status = $this->checkStatusTransaction($code);
            $order->status = $status;
            $order->save();
            if ($status == 'success') {
                session()->flash('success', 'Order status updated successfully');
                return redirect('my-order');
            } elseif ($status == 'failed') {
                session()->flash('error', 'Order status updated failed');
                return redirect('my-order');
            }elseif ($status == 'expired') {
                session()->flash('error', 'Order status updated expired');
                return redirect('my-order');
            }elseif ($status == 'pending') {
                session()->flash('info', 'Order status updated pending');
                redirect()->back();
            }
        }

        $product = ProductModel::find($order->id_product);
        return view('public_user.product.order_payment', [
            'order' => $order,
            'product' => $product
        ]);
    }

    public function updatePayment(Request $request, $code)
    {
        $request->validate([
            'status' => 'required|in:success,pending,cancel'
        ]);

        $order = OrderModel::where('code', $code)->first();
        $order->status = $this->checkStatusTransaction($code);
        $order->save();

        session()->flash('success', 'Order status updated successfully');
        return redirect('my-order');
    }

    protected function checkStatusTransaction($code)
    {
        try {
            $midtransStatus = (object) TransactionMidtrans::status($code);
            $transactionStatus = $midtransStatus->transaction_status;
            if ($transactionStatus == 'settlement') {
                return 'success';
            } elseif ($transactionStatus == 'pending') {
                return 'pending';
            } elseif ($transactionStatus == 'expire') {
                return 'expired';
            } else {
                return 'failed';
            }
        } catch (\Exception $e) {
            // Do nothing
            // because error will be handled in the next step
        }
    }
}
