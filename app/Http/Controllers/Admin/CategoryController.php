<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CategoryModel;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categorys = CategoryModel::all();
        return view('admin.category.data', compact('categorys'));
    }

    public function create()
    {
        $data = [
            'form' => 'Create',
            'action' => url('admin/category')
        ];
        return view('admin.category.form', compact('data'));
    }

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

        session()->flash('success', 'Data saved successfully');
        return redirect('admin/category');
    }
}
