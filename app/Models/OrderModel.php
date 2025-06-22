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
        'phone', // Sesuai DB: 'phone', bukan 'phone_number'. Ini yang akan diisi dari $request->phone_number di controller.
        'address',
        'message',
        'status',
        'id_user',
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

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
}
