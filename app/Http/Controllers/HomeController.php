<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('public_user/home');
    }

    public function show($id)
    {
        return view('category', ['id' => $id]);
    }
}
