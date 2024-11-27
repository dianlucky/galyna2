<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CategoryModel;
use App\Models\ProductModel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    // Index method -> show products data
    public function index(Request $request)
    {

        // Keyword Search
        $keyword = $request->query('query') ?? '';

        // Get all products data or search by keyword
        $products = ProductModel::where('name', 'like', '%' . $keyword . '%')
            ->get();

        // Return view with data
        return view(
            'admin.product.data',
            compact('products')
        );
    }

    // Create method -> show form create
    public function create()
    {
        // Data for form
        $data = [
            'form' => 'Create',
            'action' => url('admin/product')
        ];

        // Get Data Categories
        $categories = CategoryModel::all();

        // Return view Form 
        return view('admin.product.form', compact('data', 'categories'));
    }

    // Store Method -> store data to DB
    public function store(Request $request)
    {

        // Validate Input
        $request->validate([
            'name' => 'required|unique:product,name|max:30',
            'description' => 'required|max:200',
            'is_new' => 'required|boolean',
            'cover_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'id_category' => 'required|exists:category,id_category'
        ]);


        // Generate Code Slug
        $code = Str::of($request->name)->slug('_');

        // Upload Image
        if ($request->hasFile('cover_image')) {
            $image = $request->file('cover_image');
            $image_name = time() . '_' . $code;
            $image->move(public_path('images'), $image_name);
        }


        // Save Data
        $product = new ProductModel();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->is_new = $request->is_new;
        $product->cover_image = $image_name ?? null;
        $product->id_category = $request->id_category;
        $product->code = $code;
        $product->save();

        // Return back with success message
        session()->flash('success', 'Data saved successfully');
        return redirect('admin/product');
    }

    // Edit Method -> show form Edit
    public function edit($id)
    {
        // Find data product by ID
        $product = ProductModel::find($id);

        // Data for form
        $data = [
            'form' => 'Edit',
            'action' => url('admin/product/' . $id),
            'method' => 'PUT'
        ];

        // Get Data Categories
        $categories = CategoryModel::all();

        // Return view with data
        return view('admin.product.form', compact('data', 'product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        // Validate Input
        $request->validate([
            'name' => 'required|unique:product,name,' . $request->id . ',id_product|max:30',
            'description' => 'required|max:200',
            'is_new' => 'required|boolean',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'id_category' => 'required|exists:category,id_category'
        ]);

        $code = Str::of($request->name)->slug('_');

        // Upload Image
        if ($request->hasFile('cover_image')) {
            $image = $request->file('cover_image');
            $image_name = time() . '_' . $code;
            $image->move(public_path('images'), $image_name);

            // Delete Old Image if Exist
            $product = ProductModel::find($id);
            if ($product->cover_image) {
                if (file_exists(public_path('images/' . $product->cover_image))) {
                    unlink(public_path('images/' . $product->cover_image));
                }
            }
        }

        // Find Data Product by ID
        $product = ProductModel::find($id);
        $product->name = $request->name;
        $product->description = $request->description;
        $product->is_new = $request->is_new;
        $product->cover_image = $image_name ?? $product->cover_image;
        $product->id_category = $request->id_category;
        $product->code = $code;
        $product->save();

        // Return back with success message
        session()->flash('success', 'Data updated successfully');
        return redirect('admin/product');
    }

    // Destroy Method -> delete data from DB
    public function destroy(Request $request)
    {
        // Find Data Product by ID
        $product = ProductModel::find($request->id);
        if (!$product) {
            session()->flash('error', 'Data not found');
            return redirect('admin/product');
        }

        // Delete Image if Exist
        if ($product->cover_image) {
            if (file_exists(public_path('images/' . $product->cover_image))) {
                unlink(public_path('images/' . $product->cover_image));
            }
        }

        // Delete Data
        $product->delete();

        // Return back with success message
        session()->flash('success', 'Data deleted successfully');
        return redirect('admin/product');
    }
}
