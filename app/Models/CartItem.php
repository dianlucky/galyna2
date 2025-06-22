<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    protected $table = 'cart_items';

    protected $fillable = [
        'user_id',
        'product_id',
        'quantity',
    ];

    public function product()
    {
        return $this->belongsTo(ProductModel::class, 'product_id', 'id_product');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
