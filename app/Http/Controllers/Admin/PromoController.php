<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductModel;
use App\Models\PromoModel;
use Illuminate\Http\Request;

class PromoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $promo = PromoModel::with('product')->get();
        // dd($promo);
        return view('admin.promo.index', compact('promo'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'form' => 'Create',
            'action' => url('admin/promo'),
            'product' => ProductModel::get(),
        ];
        // dd($data['product']);
        // Return view with data
        return view('admin.promo.form', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        $request->validate([
            'name' => 'required|min:6',
            'code_promo' => 'required|min:3|unique:promo,code_promo',
            'id_product' => 'required|exists:product,id_product',
            'type' => 'required|in:persen,potongan',
            'amount' => 'required|numeric|min:0',
        ]);

        $status = PromoModel::create([
            'name' => $request->name,
            'code_promo' => $request->code_promo,
            'id_product' => $request->id_product,
            'type' => $request->type,
            'amount' => $request->amount,
            'description' => $request->description,
        ]);

        if($status){
            session()->flash('success', 'Data saved successfully');
            return redirect('admin/promo');
        }
    }

   public function edit($id)
    {
        // Get data by id
        $promo = PromoModel::with('product')->find($id);
        $product = ProductModel::all();

        // Data for form
        $data = [
            'form' => 'Edit',
            'action' => url('admin/promo/' . $id),
            'method' => 'PUT',
            'product' => $product,
        ];

        // Return view with data
        return view('admin.promo.form', compact('data', 'promo'));
    }

    // Update Method -> update data category to DB
    public function update(Request $request, $id)
    {
        // Validate Input
        $request->validate([
             'code_promo' => 'required|unique:promo,code_promo,' . $id. ',id_promo',
            'description' => 'required|max:100'
        ]);

        // Update data promo
        $status = PromoModel::where('id_promo', $id)->update([
            'name' => $request->name,
            'code_promo' => $request->code_promo,
            'id_product' => $request->id_product,
            'type' => $request->type,
            'amount' => $request->amount,
            'description' => $request->description,
        ]);

        // Update Data Category
        $category = PromoModel::find($id);
        $category->name = $request->name;
        $category->description = $request->description;
        $category->save();

        // Return back with success message
        session()->flash('success', 'Data updated successfully');
        return redirect('admin/promo');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:category,id_category'
        ]);

        PromoModel::destroy($request->id);

        session()->flash('success', 'Data deleted successfully');
        return redirect('admin/promo');
    }
}
