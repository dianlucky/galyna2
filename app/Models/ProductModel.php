<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory; // Opsional: Tambahkan ini jika kamu pakai factory

class ProductModel extends Model
{
    protected $table = 'product';
    protected $primaryKey = 'id_product';
    public $incrementing = true;
    protected $keyType = 'int';
    protected $fillable = [
        'name',
        'description',
        'rating',
        'code',
        'is_new',
        'cover_image',
        'id_category', // Foreign key ke tabel kategori
        'price',
    ];

    public $timestamps = true;

    public function category()
    {
        return $this->belongsTo(CategoryModel::class, 'id_category', 'id_category');
    }

    public function promos()
    {
        return $this->hasMany(PromoModel::class, 'id_product', 'id_product');
    }
}
