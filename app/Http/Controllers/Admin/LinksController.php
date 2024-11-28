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

    public function create()
    {
        // Data for form
        $data = [
            'form' => 'Create',
            'action' => url('admin/links')
        ];

        // Return view with data
        return view('admin.links.form', compact('data'));
    }

    public function store(Request $request)
    {
        // Validate Input
        $request->validate([
            'name' => 'required|unique:category,name|max:30',
            'link' => ['required', 'regex:/^https?:\/\/[^\s]+$/', 'max:255']
        ]);


        // Save Data
        $category = new LinksModel();
        $category->name = $request->name;
        $category->link = $request->link;
        $category->save();

        // Return back with success message
        session()->flash('success', 'Data saved successfully');
        return redirect('admin/links');
    }
}
