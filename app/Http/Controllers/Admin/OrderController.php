<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrderModel;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = OrderModel::with('product')
            ->orderBy('created_at', 'desc')
            ->get();
            // dd($orders);
        return view('admin.order.data', [
            'orders' => $orders
        ]);
    }
}
