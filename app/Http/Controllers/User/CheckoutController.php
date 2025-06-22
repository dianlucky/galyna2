<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Models\OrderModel;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Midtrans\Snap;
use Midtrans\Config;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        Config::$serverKey = config('services.midtrans.serverKey');
        Config::$isProduction = config('services.midtrans.isProduction');
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    /**
     * Memproses pembayaran, menghasilkan Snap Token, dan mengembalikannya sebagai JSON.
     * Metode ini akan dipanggil via AJAX dari halaman ringkasan checkout.
     */
    public function process(Request $request)
    {
        $request->validate([
            'order_ids' => 'required|array|min:1',
            'shipping_method' => 'required|string|in:jne,jnt,luar_negeri',
            'payment_type' => 'required|string|in:bank_transfer,credit_card,e_wallet', // Validasi tipe pembayaran
            'gross_amount' => 'required|numeric|min:1',
        ]);

        $user = Auth::user();
        if (!$user) {
            return response()->json(['error' => 'Unauthenticated'], 401);
        }

        $orders = OrderModel::whereIn('id_order', $request->order_ids)
                            ->where('id_user', $user->id_user)
                            ->where('status', 'pending')
                            ->with('product')
                            ->get();

        if ($orders->isEmpty()) {
            return response()->json(['error' => 'Tidak ada pesanan valid yang bisa diproses atau statusnya sudah berubah.'], 400);
        }

        $calculatedGrossAmount = $orders->sum('total');
        $shippingFee = 0;
        $selectedMethod = $request->shipping_method;

        if ($selectedMethod === 'jne') {
            $shippingFee = 20000;
        } elseif ($selectedMethod === 'jnt') {
            $shippingFee = 18000;
        } elseif ($selectedMethod === 'luar_negeri') {
            $shippingFee = 150000;
        }
        $calculatedGrossAmount += $shippingFee;

        if ((int) $request->gross_amount !== (int) $calculatedGrossAmount) {
             return response()->json(['error' => 'Total pembayaran tidak cocok. Harap segarkan halaman.'], 400);
        }

        $combinedOrderCode = 'ORD-' . strtoupper(Str::random(8));

        $itemDetails = $orders->map(function ($order) {
            return [
                'id'       => $order->code,
                'price'    => (int) $order->total,
                'quantity' => 1,
                'name'     => optional($order->product)->name ?? 'Produk Tidak Diketahui',
            ];
        })->toArray();

        if ($shippingFee > 0) {
            $itemDetails[] = [
                'id'       => 'SHIPPING-' . Str::slug($selectedMethod),
                'price'    => (int) $shippingFee,
                'quantity' => 1,
                'name'     => 'Biaya Pengiriman (' . $selectedMethod . ')',
            ];
        }

        // Tentukan metode pembayaran yang diizinkan berdasarkan pilihan pengguna
        $enabledPayments = [];
        switch ($request->payment_type) {
            case 'bank_transfer':
                $enabledPayments = ['permata_va', 'bca_va', 'bni_va', 'bri_va', 'other_va']; // Contoh VA banks
                break;
            case 'credit_card':
                $enabledPayments = ['credit_card'];
                break;
            case 'e_wallet':
                $enabledPayments = ['gopay', 'shopeepay']; // Tambahkan e-wallet lain jika perlu
                break;
            // Tambahkan case lain jika ada tipe pembayaran berbeda
        }

        $params = [
            'transaction_details' => [
                'order_id'     => $combinedOrderCode,
                'gross_amount' => (int) $calculatedGrossAmount,
            ],
            'item_details' => $itemDetails,
            'customer_details' => [
                'first_name' => $user->name,
                'email'      => $user->email,
            ],
            'enabled_payments' => $enabledPayments, // Ini akan memfilter pilihan di Midtrans
        ];

        try {
            $snapToken = Snap::getSnapToken($params);
            return response()->json(['snap_token' => $snapToken]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Gagal membuat token pembayaran: ' . $e->getMessage()], 500);
        }
    }
}