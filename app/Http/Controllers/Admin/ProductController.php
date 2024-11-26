<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CategoryModel;
use App\Models\ProductModel;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Index method -> show products data
    public function index()
    {

        // Get all products data
        // $products = ProductModel::all();
        $products = [
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

        // Return view with data
        return view(
            'admin.product.data',
            compact('products')
        );
    }

    // Create method -> show form create
    public function create()
    {
        // Data for form
        $data = [
            'form' => 'Create',
            'action' => url('admin/product')
        ];

        // Get Data Categories
        $categories = CategoryModel::all();

        // Return view Form 
        return view('admin.product.form', compact('data', 'categories'));
    }
}
