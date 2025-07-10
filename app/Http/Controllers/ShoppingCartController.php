<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShoppingCartModel;
use Illuminate\Support\Facades\Auth;

class ShoppingCartController extends Controller
{

    
    /**
     * To access shopping cart pages
     */
public function index(){
    $carts = ShoppingCartModel::where('id_user', Auth::user()->id_user)->with('product')->orderBy('status', 'asc')->get();

    return view('cart.index', ['carts' => $carts]);
}



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $status = ShoppingCartModel::create([
            'id_user' => Auth::user()->id_user,
            'id_product' => $request->id_product,
            'quantity' => $request->quantity,
            'status' => 'cart',
        ]);

        if ($status) {
            session()->flash('success', 'Berhasil menambahkan keranjang');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        dd($id);
        $status = ShoppingCartModel::where('id_cart', $id)->delete();

        if($status) 
        {
            session()->flash('success', 'Berhasil menghapus data keranjang');
            return redirect()->back();
        }
    }
}
