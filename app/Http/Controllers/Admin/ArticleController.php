<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ArticleModel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    // Index Method -> Showing article data
    public function index()
    {
        // Get all article data
        $articles = ArticleModel::all();

        // Return back with data
        return view('admin.article.data', compact('articles'));
    }

    // Create Method -> showing form create
    public function create()
    {
        // Data for form
        $data = [
            'form' => 'Create',
            'action' => url('admin/article')
        ];

        // Return view with data
        return view('admin.article.form', compact('data'));
    }

    // Store Method -> store data to DB
    public function store(Request $request)
    {
        // Validate Input
        $request->validate([
            'title' => 'required|unique:article,title|max:100',
            'content' => 'required',
            'cover_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'author' => 'required|max:50',
            'location' => 'required|max:80',
            'published_at' => 'required|date'
        ]);

        // Generate Code Slug
        $code = Str::of($request->title)->slug('_');

        // Upload Cover Image
        if ($request->hasFile('cover_image')) {
            $image = $request->file('cover_image');
            $extension = $image->getClientOriginalExtension();
            $image_title = time() . '_' . $code . '.' . $extension;
            $image->move(public_path('images'), $image_title);
        }

        // Save Data
        $article = new ArticleModel();
        $article->title = $request->title;
        $article->slug = $code;
        $article->content = $request->content;
        $article->cover_image = $image_title;
        $article->author = $request->author;
        $article->location = $request->location;
        $article->published_at = $request->published_at;
        $article->save();

        // Return back with success message
        session()->flash('success', 'Data saved successfully');
        return redirect('admin/article');
    }

    // Edit Method -> show form Edit
    public function edit($id)
    {
        // Get data by id
        $article = ArticleModel::find($id);

        // Data for form
        $data = [
            'form' => 'Edit',
            'action' => url('admin/article/' . $id),
            'method' => 'PUT'
        ];

        // Return view with data
        return view('admin.article.form', compact('data', 'article'));
    }

    // Update Method -> update data article to DB
    public function update(Request $request, $id)
    {
        // Validate Input
        $request->validate([
            'title' => 'required|unique:article,title,' . $request->id . ',id_article|max:100',
            'content' => 'required',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'author' => 'required|max:50',
            'location' => 'required|max:80',
            'published_at' => 'required|date'
        ]);

        // Get Data Article
        $article = ArticleModel::find($id);

        // Generate Code Slug
        $code = Str::of($request->title)->slug('_');

        // Upload Cover Image
        if ($request->hasFile('cover_image')) {
            $image = $request->file('cover_image');
            $extension = $image->getClientOriginalExtension();
            $image_title = time() . '_' . $code . '.' . $extension;
            $image->move(public_path('images'), $image_title);
        }

        // Update Data Article
        $article->title = $request->title;
        $article->slug = $code;
        $article->content = $request->content;
        $article->cover_image = $image_title ?? $article->cover_image;
        $article->author = $request->author;
        $article->location = $request->location;
        $article->published_at = $request->published_at;
        $article->save();

        // Return back with success message
        session()->flash('success', 'Data updated successfully');
        return redirect('admin/article');
    }

    // Destroy Method -> delete data article
    public function destroy(Request $request)
    {
        $id = $request->id;

        // Find data article by ID
        $article = ArticleModel::find($id);

        // Delete data article
        $article->delete();

        if ($article->cover_image) {
            if (file_exists(public_path('images/' . $article->cover_image))) {
                unlink(public_path('images/' . $article->cover_image));
            }
        }

        // Return back with success message
        session()->flash('success', 'Data deleted successfully');
        return redirect('admin/article');
    }
}
