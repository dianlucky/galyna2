<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
