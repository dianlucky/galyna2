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
        'price'
    ];

    public $timestamps = true;

    public function category()
    {
        return $this->belongsTo(CategoryModel::class, 'id_category', 'id_category');
    }
}
