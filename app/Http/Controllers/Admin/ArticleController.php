<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
}
