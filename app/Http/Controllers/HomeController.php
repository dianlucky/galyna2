<?php

namespace App\Http\Controllers;

use App\Models\AddressModel;
use App\Models\User;
use App\Models\ProductModel;
use Illuminate\Http\Request;
use App\Models\CategoryModel;
use Illuminate\Support\Facades\Auth;

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

        $products = ProductModel::all();
        $categories = CategoryModel::all();
        $category_query = $request->category;


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

    public function profile() {
        $id = Auth::user()->id_user;
        $profile = User::where('id_user', $id)->first();
        $address = AddressModel::where('id_user', $id)->get();
        return view('profile/index', ['dataProfile' => $profile, 'dataAddress' => $address]);
    }

    public function profileUpdate($id, Request $request){
        // dd($id, $request);
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:user,email,' . $id . ',id_user',
            'password' => 'nullable',
        ]);

        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->password) {
            $user->password = password_hash($request->password, PASSWORD_DEFAULT);
        }
        $user->save();

        session()->flash('success', 'Data updated successfully');
        return redirect()->back();
    }
}
