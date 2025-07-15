<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrderModel;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function proses()
    {
        $data = [
            'status' => 'belum diproses'
        ];
        $orders = OrderModel::where('status_order', 'packing')->with('delivery', 'payment')->get();
        return view('admin.order.data', compact('orders', 'data'));
    }
    public function dikirim()
    {
        $data = [
            'status' => 'sedang diantar'
        ];
        $orders = OrderModel::where('status_order', 'shipping')->with('delivery', 'payment')->get();
        return view('admin.order.data', compact('orders', 'data'));
    }
}
