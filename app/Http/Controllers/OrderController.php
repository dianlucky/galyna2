<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderModel;
use App\Models\ProductModel;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

// Tambahkan use statement untuk Midtrans
use Midtrans\Config;
use Midtrans\Snap; // Jika Anda menggunakan Snap.php

class OrderController extends Controller
{
    public function showOrderForm($code_product)
    {
        // Perbaikan: Pastikan mengambil satu produk dengan ->first()
        // dan cari berdasarkan 'code' jika $code_product memang kode produk,
        // atau 'id_product' jika itu ID produk
        $product = ProductModel::where('code', $code_product)->with('category')->first();

        // Jika $code_product adalah ID produk (angka), gunakan ini:
        // $product = ProductModel::where('id_product', $code_product)->with('category')->first();

        if (!$product) {
            Log::warning("Produk dengan kode {$code_product} tidak ditemukan untuk form order.");
            return redirect()->back()->with('error', 'Produk tidak ditemukan.');
        }

        $user = Auth::user();
        if (!$user) {
            Log::info('Pengguna belum login saat mencoba mengakses form order.');
            return redirect()->route('login')->with('error', 'Anda harus login untuk membuat pesanan.');
        }

        return view('checkout.checkout_summary', compact('product', 'user'));
    }

    public function storeOrder(Request $request)
    {
        $request->validate([
            'product_code' => 'required|string',
            'quantity' => 'required|integer|min:1',
            'phone_number' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'message' => 'nullable|string|max:500',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);

        $user = Auth::user();
        if (!$user) {
            Log::info('Pengguna belum login saat mencoba menyimpan order.');
            return redirect()->route('login')->with('error', 'Anda harus login untuk membuat pesanan.');
        }

        $product = ProductModel::where('code', $request->product_code)->first();
        if (!$product) {
            Log::error("Produk dengan kode {$request->product_code} tidak ditemukan saat menyimpan pesanan.");
            return redirect()->back()->with('error', 'Produk tidak ditemukan saat menyimpan pesanan.');
        }

        $totalPrice = $product->price * $request->quantity;

        $order = new OrderModel();
        $order->id_user = $user->id_user;
        $order->code = 'ORD-' . strtoupper(Str::random(8));
        $order->id_product = $product->id_product;
        $order->quantity = $request->quantity;
        $order->total = $totalPrice;
        $order->status = 'pending';

        $order->name = $request->name;
        $order->email = $request->email;
        $order->phone = $request->phone_number;
        $order->address = $request->address;
        $order->message = $request->message;
        $order->transaction_token = '';

        try {
            $order->save();
            Log::info('Order berhasil disimpan.', ['order_id' => $order->id_order, 'user_id' => $order->id_user, 'product_id' => $order->id_product]);
            return redirect()->route('order.my')->with('success', 'Pesanan berhasil dibuat!');
        } catch (\Exception $e) {
            Log::error('Gagal menyimpan order: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat menyimpan pesanan: ' . $e->getMessage());
        }
    }

    public function myOrder()
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login')->with('error', 'Anda harus login untuk melihat pesanan.');
        }

        $orders = OrderModel::where('id_user', $user->id_user)
            ->with('product.category')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('public_user.product.my_order', compact('orders', 'user'));
    }

    /**
     * Menampilkan halaman checkout untuk satu order tertentu (dipanggil dari tombol 'Detail').
     *
     * @param \App\Models\OrderModel $order
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function showCheckout(OrderModel $order)
    {
        if (Auth::id() !== $order->id_user) {
            return redirect()->route('order.my')->with('error', 'Anda tidak memiliki akses ke pesanan ini.');
        }

        $order->loadMissing('product');

        return view('checkout.checkout_summary', compact('order'));
    }

    /**
     * Memproses pembayaran atau checkout untuk satu order tertentu (dipanggil dari form di checkout_summary).
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\OrderModel $order
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function processCheckout(Request $request, OrderModel $order)
    {
        if (Auth::id() !== $order->id_user) {
            return redirect()->route('order.my')->with('error', 'Anda tidak memiliki akses untuk memproses pesanan ini.');
        }

        if ($order->status !== 'pending') {
            return redirect()->route('order.my')->with('error', 'Pesanan ini tidak dapat diproses karena statusnya bukan pending.');
        }

        $request->validate([
            'payment_method' => 'required|string',
            'final_shipping_cost' => 'required|numeric|min:0', // Validasi biaya pengiriman
        ]);

        $finalShippingCost = $request->input('final_shipping_cost');
        $totalAmount = $order->total + $finalShippingCost;

        // Konfigurasi Midtrans
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = env('MIDTRANS_IS_PRODUCTION', false);
        Config::$isSanitized = true;
        Config::$is3ds = true;

        try {
            // Data transaksi untuk Midtrans
            $transaction_details = [
                'order_id' => $order->code, // Menggunakan kode order sebagai ID transaksi
                'gross_amount' => $totalAmount,
            ];

            $customer_details = [
                'first_name' => $order->name,
                'email' => $order->email,
                'phone' => $order->phone,
                'address' => $order->address,
            ];

            // Detail item (opsional, tapi disarankan untuk pelaporan yang lebih baik di Midtrans)
            $item_details = [
                [
                    'id' => optional($order->product)->code, // ID produk
                    'name' => optional($order->product)->name, // Nama produk
                    'price' => $order->product->price,
                    'quantity' => $order->quantity,
                ],
            ];
            // Jika ada biaya pengiriman, tambahkan sebagai item terpisah
            if ($finalShippingCost > 0) {
                $item_details[] = [
                    'id' => 'SHIPPING_FEE',
                    'name' => 'Biaya Pengiriman',
                    'price' => $finalShippingCost,
                    'quantity' => 1,
                ];
            }

            $params = [
                'transaction_details' => $transaction_details,
                'customer_details' => $customer_details,
                'item_details' => $item_details,
            ];

            $snapToken = Snap::getSnapToken($params);

            // Simpan snap token ke database order
            $order->transaction_token = $snapToken;
            $order->status = 'waiting_payment'; // Ubah status menjadi menunggu pembayaran
            $order->save();

            // Kembalikan snap token ke frontend untuk menampilkan pop-up pembayaran
            return response()->json(['snap_token' => $snapToken]);
        } catch (\Exception $e) {
            Log::error('Gagal memproses checkout untuk order ' . $order->id_order . ': ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
            $order->status = 'failed'; // Ubah status menjadi failed jika ada error
            $order->save();
            return response()->json(['message' => 'Terjadi kesalahan saat memproses pembayaran. Mohon coba lagi. Detail: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Menampilkan halaman checkout untuk beberapa order yang dipilih (dipanggil dari tombol 'Checkout').
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function showMultiOrderCheckoutSummary(Request $request)
    {
        // dd($request); // Baris ini bisa dihapus jika tidak lagi diperlukan untuk debugging

        // Validasi bahwa order_ids harus ada dan berupa array
        $request->validate([
            'order_ids' => 'required|array',
            'order_ids.*' => 'exists:order,id_order', // Memastikan setiap ID order ada di database
        ]);

        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login')->with('error', 'Anda harus login untuk melihat pesanan.');
        }

        $selectedOrderIds = $request->input('order_ids');

        // Ambil order yang dipilih dari database
        $ordersToProcess = OrderModel::whereIn('id_order', $selectedOrderIds)
            ->where('id_user', $user->id_user)
            ->where('status', 'pending') // Hanya ambil order yang masih pending
            ->with('product') // Eager load produk untuk detail tampilan
            ->get();

        if ($ordersToProcess->isEmpty()) {
            return redirect()->route('order.my')->with('error', 'Tidak ada pesanan valid yang dipilih untuk diproses.');
        }

        // Hitung total keseluruhan dari pesanan yang dipilih
        $grandTotal = $ordersToProcess->sum('total');

        return view('checkout.checkout_summary', compact('ordersToProcess', 'grandTotal', "selectedOrderIds"));
    }

    /**
     * Memproses pembayaran untuk beberapa order yang dipilih (dipanggil dari form di checkout_summary).
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function processSelectedCheckout(Request $request)
    {
        $request->validate([
            'order_ids' => 'required|array',
            'order_ids.*' => 'exists:order,id_order',
            'final_shipping_cost' => 'required|numeric|min:0',
        ]);

        $user = Auth::user();
        if (!$user) {
            return response()->json(['message' => 'Anda harus login untuk memproses pesanan.'], 401);
        }

        $selectedOrderIds = $request->input('order_ids');
        $finalShippingCost = $request->input('final_shipping_cost');

        $ordersToProcess = OrderModel::whereIn('id_order', $selectedOrderIds)
            ->where('id_user', $user->id_user)
            ->where('status', 'pending')
            ->with('product')
            ->get();

        if ($ordersToProcess->isEmpty()) {
            return response()->json(['message' => 'Tidak ada pesanan valid yang dipilih untuk diproses.'], 400);
        }

        $grandTotalProduct = $ordersToProcess->sum('total');
        $grandTotalAmount = $grandTotalProduct + $finalShippingCost;

        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = env('MIDTRANS_IS_PRODUCTION', false);
        Config::$isSanitized = true;
        Config::$is3ds = true;

        try {
            $order_ids_string = implode(',', $selectedOrderIds);
            $transaction_code = 'BATCH-ORD-' . Str::random(8);

            $customer_details = [
                'first_name' => $user->name,
                'email' => $user->email,
                'phone' => $user->phone,
            ];

            $item_details = [];
            foreach ($ordersToProcess as $order) {
                $item_details[] = [
                    'id' => $order->code,
                    'name' => 'Order: ' . (optional($order->product)->name ?? 'Produk Tidak Dikenal'),
                    'price' => $order->total,
                    'quantity' => 1,
                ];
                // Jangan mengubah status order di sini sebelum pembayaran berhasil
                // Biarkan status pending, nanti akan diupdate oleh webhook Midtrans
                // atau setelah pembayaran berhasil
                // $order->status = 'waiting_payment'; // <-- Hapus baris ini
                // $order->save(); // <-- Hapus baris ini
            }

            if ($finalShippingCost > 0) {
                $item_details[] = [
                    'id' => 'SHIPPING_FEE',
                    'name' => 'Biaya Pengiriman',
                    'price' => $finalShippingCost,
                    'quantity' => 1,
                ];
            }

            $params = [
                'transaction_details' => [
                    'order_id' => $transaction_code,
                    'gross_amount' => $grandTotalAmount,
                ],
                'customer_details' => $customer_details,
                'item_details' => $item_details,
            ];

            $snapToken = Snap::getSnapToken($params);

            // Simpan snap token ke setiap order yang terkait dalam batch ini
            // Agar bisa di-track nantinya jika ada notifikasi dari Midtrans
            foreach ($ordersToProcess as $order) {
                $order->transaction_token = $snapToken;
                $order->status = 'waiting_payment'; // Ubah status setelah mendapatkan token
                $order->save();
            }

            return response()->json(['snap_token' => $snapToken, 'message' => 'Transaksi batch berhasil dibuat.']);
        } catch (\Exception $e) {
            Log::error('Gagal memproses selected checkout: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
            // Jika gagal, kembalikan status ke pending (jika sempat diubah)
            foreach ($ordersToProcess as $order) {
                if ($order->status == 'waiting_payment') {
                    $order->status = 'pending';
                    $order->save();
                }
            }
            return response()->json(['message' => 'Terjadi kesalahan saat memproses pesanan yang dipilih: ' . $e->getMessage()], 500);
        }
    }


    public function updatePayment(Request $request)
    {
        $orderIds = $request->input('order_ids');
    
        // Validasi bahwa order_ids adalah array dan tidak kosong
        if (!is_array($orderIds) || empty($orderIds)) {
            return response()->json([
                'success' => false,
                'message' => 'Data order tidak valid.'
            ], 400);
        }
    
        // Update status menjadi 'paid' untuk semua order yang cocok
        try {
            OrderModel::whereIn('id_order', $orderIds)->update([
                'status' => 'paid'
            ]);
    
            return response()->json([
                'success' => true,
                'message' => 'Status pembayaran berhasil diperbarui.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat update status.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}