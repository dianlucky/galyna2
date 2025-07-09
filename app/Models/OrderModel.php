<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderModel extends Model
{
    use HasFactory;

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
            'quantity',
            'total',
            'courier',
            'delivery_cost',
            'estimated_day',
            'code',
            'transaction_token',
        ];

    public $timestamps = true;

    public function product()
    {
        return $this->belongsTo(ProductModel::class, 'id_product', 'id_product');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
}
