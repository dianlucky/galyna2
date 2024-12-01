<?php

namespace App\Http\Controllers;

use App\Models\CategoryModel;
use App\Models\ProductModel;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function links()
    {
        return view('public_user/links');
    }

    public function home()
    {
        $products = ProductModel::orderBy('rating', 'desc')->limit(6)->get();
        return view('public_user/home', ['products' => $products]);
    }

    public function show($id)
    {
        return view('category', ['id' => $id]);
    }

    public function collection(Request $request, $code = null)
    {
        // If code : Return to Detail Product
        if ($code) {
            $product = ProductModel::where('code', $code)->first();
            $products_related = ProductModel::inRandomOrder()->take(6)->get();
            return view('public_user/product/detail', [
                'product' => $product,
                'products_related' => $products_related
            ]);
        }

        // If no code : Return to Collection Page (All Products)
        $products = ProductModel::all();
        $categories = CategoryModel::all();
        $category_query = $request->category;

        // if ($request->product) {
        //     $product = ProductModel::where('code', $request->product)->first();
        //     return view('public_user/product/collection', [
        //         'first_product' => $product,
        //         'products' => $products,
        //         'categories' => $categories
        //     ]);
        // } else {
        // }
        // $first_product = ProductModel::first();

        if ($category_query) {
            $products = ProductModel::whereHas('category', function ($query) use ($category_query) {
                $query->where('name', $category_query);
            })->get();
        }

        return view('public_user/product/collection', [
            // 'first_product' => $first_product,
            'products' => $products,
            'categories' => $categories
        ]);
    }

    public function like($code)
    {
        $product = ProductModel::where('code', $code)->first();
        $product->rating += 1;
        $product->save();
        return redirect('/collection/' . $code);
    }
}
