<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderModel extends Model
{
    protected $table = 'order';
    protected $primaryKey = 'id_order';
    protected $fillable = [
        'id_product',
        'name',
        'email',
        'phone',
        'address',
        'message',
        'status',
        'id_user',
        'id_product',
        'quantity',
        'total',
        'code',
        'transaction_token',
    ];

    public $timestamps = true;

    public function product()
    {
        return $this->belongsTo(ProductModel::class, 'id_product', 'id_product');
    }
}
