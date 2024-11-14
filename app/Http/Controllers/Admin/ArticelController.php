<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ArticelController extends Controller
{
    public function index(){
        return view('admin.articel.data');
    }

    public function create(){
        $data = [
            'form' => 'Tambah',
            'action' => route('articel.store')
        ];
        return view('admin.articel.form', compact('data'));
    }
}

