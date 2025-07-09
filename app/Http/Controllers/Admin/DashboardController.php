<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrderModel;
use App\Models\ProductModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalOmset = OrderModel::where('status', 'paid')
        ->whereMonth('updated_at', now()->month)
        ->whereYear('updated_at', now()->year)
        ->sum('total');
        $totalProduk = ProductModel::get()->count();
        return view('admin.dashboard', compact('totalOmset', 'totalProduk'));
    }

    public function omsetAll() {
        $totalOmsetBulanan = OrderModel::selectRaw('
                DATE_FORMAT(updated_at, "%Y-%m") as bulan,
                SUM(quantity) as totalProduk,
                SUM(total) as totalOmset
            ')
            ->groupBy(DB::raw('DATE_FORMAT(updated_at, "%Y-%m")'))
            ->orderBy('bulan', 'desc')
            ->get();
    
        return view('admin.omset.data', compact('totalOmsetBulanan'));
    }
}
