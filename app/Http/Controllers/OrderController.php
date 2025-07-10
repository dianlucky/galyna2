<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\OrderModel;
use App\Models\AddressModel;
use Illuminate\Http\Request;
use App\Models\ShoppingCartModel;

// Tambahkan use statement untuk Midtrans
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index(){
        $orders = OrderModel::where('id_user', Auth::user()->id_user)->with('delivery', 'payment')->get();
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
        $ordersToProcess = ShoppingCartModel::whereIn('id_cart', $selectedOrderIds)->where('id_user', Auth::user()->id_user)->with('product')->get();
    //    dd($ordersToProcess);
        if ($ordersToProcess->isEmpty()) {
            return redirect()->route('order.my')->with('error', 'Tidak ada pesanan valid yang dipilih untuk diproses.');
        }

        $addresses = AddressModel::where('id_user', Auth::user()->id_user)->get();


        return view('checkout.checkout_summary', compact('ordersToProcess', 'selectedOrderIds', 'addresses'));
    }


}
