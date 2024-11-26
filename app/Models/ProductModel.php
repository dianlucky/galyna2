<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model
{
    protected $table = 'product';
    protected $primaryKey = 'id_product';
    protected $fillable = [
        'name',
        'description',
        'rating',
        'code',
        'is_new',
        'cover_image',
        'id_category',
    ];

    public $timestamps = true;
}
