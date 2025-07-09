<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\OrderModel;
use Illuminate\Http\Request;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = CartItem::with('product')->where('user_id', Auth::id())->get();
        return view('customer.cart.index', compact('cartItems'));
    }

    public function add(Request $request, $productId)
    {
        $cartItem = CartItem::where('user_id', Auth::id())
            ->where('product_id', $productId)
            ->first();

        if ($cartItem) {
            $cartItem->quantity += $request->quantity ?? 1;
            $cartItem->save();
        } else {
            CartItem::create([
                'user_id' => Auth::id(),
                'product_id' => $productId,
                'quantity' => $request->quantity ?? 1,
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Produk berhasil ditambahkan ke keranjang.');
    }

    public function detail($id){
        $dataOrder = OrderModel::where('id_order', $id)->first();
        // dd($dataOrder);
        return view('cart.detail', compact('dataOrder'));
    }

    public function remove($id)
    {
        dd($id);
        $cartItem = OrderModel::where('id_order', $id)->firstOrFail();
        $cartItem->delete();

        return redirect('my-order')->with('success', 'Produk berhasil dihapus dari keranjang.');
    }
}
