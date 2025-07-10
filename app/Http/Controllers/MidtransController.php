<?php

namespace App\Http\Controllers;

use App\Models\OrderModel;
use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;

class MidtransController extends Controller
{
    public function make_snap(Request $request)
    {
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = false;
        Config::$isSanitized = true;
        Config::$is3ds = true;

        $params = [
            'transaction_details' => [
                'order_id' => $request->order_id,
                'gross_amount' => (int) $request->total,
            ],
            'customer_details' => [
                'first_name' => 'User',
                'email' => 'user@example.com',
            ],
        ];

        try {
            $snapToken = Snap::getSnapToken($params);
            return response()->json(['snap_token' => $snapToken]);
        } catch (\Exception $e) {
            // \Log::error('Midtrans error: ' . $e->getMessage());
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function callback(Request $request)
{
    $orderId = $request->order_id;
    $status = $request->transaction_status;

    if ($status === 'settlement') {
        OrderModel::where('order_id', $orderId)->update(['status' => 'paid']);
    }

    return response()->json(['message' => 'callback received']);
}
}
