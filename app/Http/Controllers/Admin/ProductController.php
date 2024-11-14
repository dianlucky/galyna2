<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        return view('admin.product.data');
    }
    public function create(){
        $data = [
            'form' => 'Tambah',
            'action' => route('product.store')
        ];
        return view('admin.product.form', compact('data'));
    }
}
