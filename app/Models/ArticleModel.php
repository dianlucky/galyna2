<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArticleModel extends Model
{
    protected $table = 'article';

    protected $primaryKey = 'id_article';

    protected $fillable = [
        'title',
        'slug',
        'content',
        'cover_image',
        'author',
        'location',
        'published_at'
    ];

    protected $dates = ['published_at'];

    public $timestamps = true;
}
