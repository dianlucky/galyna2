<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\ShippedMail;
use App\Models\DetailOrderModel;
use App\Models\OrderModel;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function proses()
    {
        $data = [
            'status' => 'belum diproses',
        ];
        $orders = OrderModel::where('status_order', 'packing')->with('delivery', 'payment')->get();
        return view('admin.order.data', compact('orders', 'data'));
    }
    public function dikirim()
    {
        $data = [
            'status' => 'sedang diantar',
        ];
        $orders = OrderModel::where('status_order', 'shipping')->with('delivery', 'payment')->get();
        return view('admin.order.data', compact('orders', 'data'));
    }

    public function detail($id)
    {
        $dataOrder = OrderModel::where('id_order', $id)->with('payment', 'delivery', 'user')->first();
        $detailOrders = DetailOrderModel::where('id_order', $id)->with('product')->get();
        if ($dataOrder) {
            preg_match('/(\d+)/', $order->delivery->estimated_day ?? '0', $matches);
            $daysToAdd = isset($matches[1]) ? (int) $matches[1] : 0;
            $estimatedDate = Carbon::parse($dataOrder->created_at)->addDays($daysToAdd);
            $dataOrder->estimated_arrival = $estimatedDate->translatedFormat('l, d F Y');
        }

        return view('admin.order.detail', compact('dataOrder', 'detailOrders'));
    }

    public function updateStatus(Request $request, $id)
    {
        $status = OrderModel::where('id_order', $id)->update([
            'status_order' => 'shipping',
            'resi' => $request->resi,
        ]);

        $order = OrderModel::where('id_order', $id)->with('user')->first();

        $data = [
            'name' => $order->user->name ?? 'Pelanggan',
            'code' => $order->order_code ?? 'Pelanggan',
            'resi' => $request->resi ?? 'N/A',
        ];
        Mail::to($order->user->email ?? 'imelda.aryani@mhs.politala.ac.id')->send(new ShippedMail($data));

        session()->flash('success', 'Data updated successfully');
        return redirect('/admin/order/dikirim');
    }
}
