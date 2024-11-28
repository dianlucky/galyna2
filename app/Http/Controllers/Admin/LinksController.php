<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LinksModel;

class LinksController extends Controller
{
    public function index()
    {
        // Get all category data
        $links = LinksModel::all();

        // Return back with data
        return view('admin.links.data', compact('links'));
    }
}
