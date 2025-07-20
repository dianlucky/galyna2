<?php

namespace App\Http\Controllers;

use App\Models\CommentModel;
use App\Models\DetailOrderModel;
use Carbon\Carbon;
use App\Models\OrderModel;
use App\Models\AddressModel;
use Illuminate\Http\Request;
use App\Models\ShoppingCartModel;

// Tambahkan use statement untuk Midtrans
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $orders = OrderModel::where('id_user', Auth::user()->id_user)
            ->with('delivery', 'payment')
            ->orderBy('created_at', 'asc')
            ->get();
        $dataOrder = $orders->map(function ($order) {
            preg_match('/(\d+)/', $order->delivery->estimated_day ?? '0', $matches);
            $daysToAdd = isset($matches[1]) ? (int) $matches[1] : 0;
            $estimatedDate = Carbon::parse($order->created_at)->addDays($daysToAdd);
            $formattedDate = $estimatedDate->translatedFormat('l, d F Y');
            $order->estimated_arrival = $formattedDate;
            return $order;
        });
        return view('history-order.index', compact('dataOrder'));
    }

    public function detail($code)
    {
        $order = OrderModel::where('order_code', $code)->with('delivery', 'payment', 'user')->first();
        if ($order) {
            preg_match('/(\d+)/', $order->delivery->estimated_day ?? '0', $matches);
            $daysToAdd = isset($matches[1]) ? (int) $matches[1] : 0;
            $estimatedDate = Carbon::parse($order->created_at)->addDays($daysToAdd);
            $order->estimated_arrival = $estimatedDate->translatedFormat('l, d F Y');
        }
        $detailOrders = DetailOrderModel::where('id_order', $order->id_order)->with('product')->get();

        return view('history-order.detail', compact('order', 'detailOrders'));
    }

    /**
     * Menampilkan halaman checkout untuk beberapa order yang dipilih (dipanggil dari tombol 'Checkout').
     *

     */
    public function showMultiOrderCheckoutSummary(Request $request)
    {
        // dd($request);
        $request->validate([
            'cart_ids' => 'required|array',
            // 'cart_ids.*' => 'exists:shopping_cart.id_cart',
        ]);

        $selectedOrderIds = $request->input('cart_ids');
        $ordersToProcess = ShoppingCartModel::whereIn('id_cart', $selectedOrderIds)
            ->where('id_user', Auth::user()->id_user)
            ->with([
                'product.promos' => function ($query) {
                    $query->where('status', 'active');
                },
            ])
            ->get();
        // $ordersToProcess = ShoppingCartModel::whereIn('id_cart', $selectedOrderIds)->where('id_user', Auth::user()->id_user)->with('product')->get();
        //    dd($ordersToProcess);
        if ($ordersToProcess->isEmpty()) {
            return redirect()->to('/shopping-cart')->with('error', 'Tidak ada pesanan valid yang dipilih untuk diproses.');
        }

        $addresses = AddressModel::where('id_user', Auth::user()->id_user)->get();

        return view('checkout.checkout_summary', compact('ordersToProcess', 'selectedOrderIds', 'addresses'));
    }

    public function comment(Request $request, $id)
    {
        $status = CommentModel::create([
            'id_user' => Auth::user()->id_user,
            'id_product' => $id,
            'comment' => $request->comment,
            'rating' => $request->rating,
        ]);

        if ($status) {
            return redirect()->back();
        }
    }

    public function updateDone($id)
    {
        $status = OrderModel::where('id_order', $id)->update([
            'status_order' => 'done',
        ]);

        if ($status) {
            return redirect('/history-order')->with('success', 'THANKYOU!');
        }
    }
}
