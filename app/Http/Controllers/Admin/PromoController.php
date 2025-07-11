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
            'code_promo' => 'required|min:3',
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

    /**
     * Display the specified resource.
     */
    public function show(PromoModel $promoModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PromoModel $promoModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PromoModel $promoModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PromoModel $promoModel)
    {
        //
    }
}
