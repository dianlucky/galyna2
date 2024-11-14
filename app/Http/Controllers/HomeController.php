<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function links()
    {
        return view('public_user/links');
    }

    public function home()
    {
        return view('public_user/home');
    }

    public function show($id)
    {
        return view('category', ['id' => $id]);
    }
}
