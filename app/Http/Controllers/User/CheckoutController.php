<?php

namespace App\Http\Controllers\User;

use App\Models\DeliveryModel;
use App\Models\OrderModel;
use App\Models\PaymentModel;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function store(Request $request)
    {
        // dd($request);
        Log::info('DATA CHECKOUT:', $request->all());

        // return response()->json([
        //     'success' => true,
        //     'data' => $request->all(),
        // ]);

        $delivery = DeliveryModel::create([
            'destination_code' => $request->destination_code,
            'destination' => $request->destination,
            'courier' => $request->courier,
            'delivery_type' => $request->delivery_type,
            'delivery_cost' => $request->delivery_cost,
            'estimated_day' => $request->estimated_day,
        ]);

        $payment = PaymentModel::create([
            'payment_code' => $request->payment_code,
            'amount' => $request->amount,
            'status' => 'paid',
        ]);

        $order = OrderModel::create([
            'id_delivery' => ,
            'id_payment' => ,
            'id_user' => Auth::user()->id_user,
            'order_code' => 'ORD-' . strtoupper(Str::random(8)),
            'code_promo' => $request->code_promo ?? '',
            'status_payment' => 'Paid'

            
        ]);


    }
}
