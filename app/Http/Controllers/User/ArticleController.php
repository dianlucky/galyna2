<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\ArticleModel;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    //Index Method -> showing All Article
    public function index($slug = "")
    {
        // Get all article data order by published_at
        $articles = ArticleModel::orderBy('published_at', 'desc')
            ->when($slug, function ($query, $slug) {
                return $query->where('slug', '!=', $slug);
            })
            ->get();

        // First published_at
        $article = ArticleModel::orderBy('published_at', 'desc')
            ->when($slug, function ($query, $slug) {
                return $query->where('slug', $slug);
            })
            ->first();

        // Return back with data
        return view('public_user.article.index', compact('articles', 'article'));
    }
}
