<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DetailOrderModel;
use App\Models\OrderModel;
use App\Models\ProductModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // $totalOmset = 70000;
        $totalOmset = OrderModel::whereIn('status_order', ['shipping', 'done'])
            ->whereYear('updated_at', now()->year)
            ->with('payment', 'delivery')
            ->get()
            ->sum(function ($order) {
                return $order->payment->amount - $order->delivery->delivery_cost ?? 0;
            });

        $totalProduk = DetailOrderModel::get()->sum('quantity');
        $orderPacking = OrderModel::where('status_order', 'packing')->count();
        $orderShipping  = OrderModel::where('status_order', 'shipping')->count();
        $orderDone  = OrderModel::where('status_order', 'done')->count();
        return view('admin.dashboard', compact('totalOmset', 'totalProduk', 'orderPacking', 'orderShipping', 'orderDone'));
    }

    public function omsetAll()
    {
        $totalOmsetBulanan = OrderModel::selectRaw(
            '
        DATE_FORMAT(order.updated_at, "%Y-%m") as bulan,
        SUM(payment.amount - delivery.delivery_cost) as totalOmset
    ',
        )
            ->join('payment', 'payment.id_payment', '=', 'order.id_payment')
            ->join('delivery', 'delivery.id_delivery', '=', 'order.id_delivery')
            ->groupBy(DB::raw('DATE_FORMAT(order.updated_at, "%Y-%m")'))
            ->orderBy('bulan', 'desc')
            ->whereIn('status_order', ['shipping', 'done'])
            ->get();

        return view('admin.omset.data', compact('totalOmsetBulanan'));
    }
}
