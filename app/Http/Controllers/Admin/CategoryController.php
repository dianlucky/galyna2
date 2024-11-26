<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CategoryModel;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Index Method -> Showing category data
    public function index()
    {
        // Get all category data
        $categorys = CategoryModel::all();

        // Return back with data
        return view('admin.category.data', compact('categorys'));
    }

    // Create Method -> showing form create
    public function create()
    {
        // Data for form
        $data = [
            'form' => 'Create',
            'action' => url('admin/category')
        ];

        // Return view with data
        return view('admin.category.form', compact('data'));
    }

    // Store Method -> store data to DB
    public function store(Request $request)
    {
        // Validate Input
        $request->validate([
            'name' => 'required|unique:category,name|max:30',
            'description' => 'required|max:30'
        ]);

        // Save Data
        $category = new CategoryModel();
        $category->name = $request->name;
        $category->description = $request->description;
        $category->save();

        // Return back with success message
        session()->flash('success', 'Data saved successfully');
        return redirect('admin/category');
    }

    public function edit($id)
    {
        // Get data by id
        $category = CategoryModel::find($id);

        // Data for form
        $data = [
            'form' => 'Edit',
            'action' => url('admin/category/' . $id),
            'method' => 'PUT'
        ];

        // Return view with data
        return view('admin.category.form', compact('data', 'category'));
    }

    // Update Method -> update data category to DB
    public function update(Request $request, $id)
    {
        // Validate Input
        $request->validate([
            'name' => 'required|unique:category,name,' . $request->id . ',id_category|max:30',
            'description' => 'required|max:30'
        ]);

        // Update Data Category
        $category = CategoryModel::find($id);
        $category->name = $request->name;
        $category->description = $request->description;
        $category->save();

        // Return back with success message
        session()->flash('success', 'Data updated successfully');
        return redirect('admin/category');
    }

    // Destroy Method -> delete data form DB
    public function destroy(Request $request)
    {
        // Validate Input
        $request->validate([
            'id' => 'required|exists:category,id_category'
        ]);

        // Delete Data
        CategoryModel::destroy($request->id);

        // Return back with success message
        session()->flash('success', 'Data deleted successfully');
        return redirect('admin/category');
    }
}
