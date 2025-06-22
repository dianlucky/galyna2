<?php

use Midtrans\Snap;
use Midtrans\Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// ROUTE CONFIGURATION

// Route pattern {id} to accept only numbers
Route::pattern('id', '[0-9]+');


require __DIR__ . '/auth.php';

require __DIR__ . '/guest.php';

require __DIR__ . '/admin.php';

require __DIR__ . '/customer.php';

// Route::post('/midtrans-test-token', function (Request $request) {
//     Config::$serverKey = env('MIDTRANS_SERVER_KEY');
//     Config::$isProduction = false;
//     Config::$isSanitized = true;
//     Config::$is3ds = true;

//     $params = [
//         'transaction_details' => [
//             'order_id' => uniqid(),
//             'gross_amount' => (int) $request->total,
//         ],
//         'customer_details' => [
//             'first_name' => 'User',
//             'email' => 'user@example.com',
//         ],
//     ];

//     try {
//         $snapToken = Snap::getSnapToken($params);
//         return response()->json(['snap_token' => $snapToken]);
//     } catch (\Exception $e) {
//         // \Log::error('Midtrans error: ' . $e->getMessage());
//         return response()->json(['message' => $e->getMessage()], 500);
//     }
// });




