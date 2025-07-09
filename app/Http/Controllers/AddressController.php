<?php

namespace App\Http\Controllers;

use App\Models\AddressModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        $status = AddressModel::create([
            'id_user' => Auth::user()->id_user, 
            'address_code' => $request['address_code'], 
            'province_name' => $request['province_name'], 
            'city_name' => $request['city_name'], 
            'address_name' => $request['address_name'],
            'status' => 0
        ]);

        if($status) {
            session()->flash('success', 'Berhasil menambahkan data alamat');
            return redirect()->back();
        }
    }

 
    public function status($id)
    {
        $oldAddress = AddressModel::where('status', true)->update(['status' => false]);
        if($oldAddress){
            $status = AddressModel::where('id_address', $id)->update(['status' => true]);
            if($status){
                session()->flash('success', 'Berhasil merubah status alamat utama');
                return redirect()->back();
            }
        }
        
    }


    public function destroy($id)
    {
        $status = AddressModel::where('id_address', $id)->delete();
        if($status){
            session()->flash('success', 'Berhasil menghapus data alamat');
            return redirect()->back();
        }
    }
}
