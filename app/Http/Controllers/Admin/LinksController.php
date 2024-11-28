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
        $links = LinksModel::orderBy('id_link', 'desc')->get();


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

    // Destroy Method -> delete data form DB
    public function destroy(Request $request)
    {
        // Validate Input
        $request->validate([
            'id' => 'required|exists:link,id_link'
        ]);

        // Delete Data
        LinksModel::destroy($request->id);

        // Return back with success message
        session()->flash('success', 'Data deleted successfully');
        return redirect('admin/links');
    }

    public function edit($id)
    {
        // Get data by id
        $link = LinksModel::find($id);

        // Data for form
        $data = [
            'form' => 'Edit',
            'action' => url('admin/links/' . $id),
            'method' => 'PUT'
        ];

        // Return view with data
        return view('admin.links.form', compact('data', 'link'));
    }

    // Update Method -> update data category to DB
    public function update(Request $request, $id)
    {
        // Validate Input
        $request->validate([
            'name' => 'required|unique:category,name|max:30',
            'link' => ['required', 'regex:/^https?:\/\/[^\s]+$/', 'max:255']
        ]);

        // Update Data Category
        $link = LinksModel::find($id);
        $link->name = $request->name;
        $link->link = $request->link;
        $link->save();

        // Return back with success message
        session()->flash('success', 'Data updated successfully');
        return redirect('admin/links');
    }
}
