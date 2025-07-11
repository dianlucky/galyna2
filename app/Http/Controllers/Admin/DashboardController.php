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
        $totalOmset = OrderModel::where('status_order', 'delivered')
            ->whereMonth('updated_at', now()->month)
            ->whereYear('updated_at', now()->year)
            ->with('payment')
            ->get()
            ->sum(function ($order) {
                return $order->payment->amount ?? 0;
            });

        $totalProduk = DetailOrderModel::get()->sum('quantity');
        return view('admin.dashboard', compact('totalOmset', 'totalProduk'));
    }

    public function omsetAll()
    {
        $totalOmsetBulanan = OrderModel::selectRaw(
            '
                DATE_FORMAT(updated_at, "%Y-%m") as bulan,
                SUM(quantity) as totalProduk,
                SUM(total) as totalOmset
            ',
        )
            ->groupBy(DB::raw('DATE_FORMAT(updated_at, "%Y-%m")'))
            ->orderBy('bulan', 'desc')
            ->get();

        return view('admin.omset.data', compact('totalOmsetBulanan'));
    }
}
