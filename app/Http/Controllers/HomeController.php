<?php

namespace App\Http\Controllers;

use App\Models\ProductModel;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $products = [
        [
            'id' => 1,
            'name' => 'Outer Sasirangan',
            'image' => 'produk_1.png',
            'rate' => 4.5,
            'is_new' => true,
        ],
        [
            'id' => 2,
            'name' => 'Blazer Sasirangan Embrodier',
            'image' => 'produk_2.png',
            'rate' => 5,
            'is_new' => true,
        ],
        [
            'id' => 3,
            'name' => 'Blazer Sasirangan',
            'image' => 'produk_3.png',
            'rate' => 5.0,
            'is_new' => true,
        ],
        [
            'id' => 4,
            'name' => 'Prayer Gown',
            'image' => 'produk_4.png',
            'rate' => 4.0,
            'is_new' => true,
        ],
        [
            'id' => 5,
            'name' => 'Set Blue Indigo Sasirangan',
            'image' => 'produk_5.png',
            'rate' => 4.8,
            'is_new' => true,
        ],
        [
            'id' => 6,
            'name' => 'Alea Hat Sasirangan',
            'image' => 'produk_6.png',
            'rate' => 4.8,
            'is_new' => false,
        ],
    ];
    public function links()
    {
        return view('public_user/links');
    }

    public function home()
    {
        $products = ProductModel::all();
        return view('public_user/home', ['products' => $products]);
    }

    public function show($id)
    {
        return view('category', ['id' => $id]);
    }
}
