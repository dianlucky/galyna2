<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        return view('admin.category.data');
    }

    public function create(){
        $data = [
            'form' => 'Tambah',
            'action' => route('category.store')
        ];
        return view('admin.category.form', compact('data'));
    }
}

