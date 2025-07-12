<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DetailOrderModel extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'detail_order';
    protected $primaryKey = 'id_detail_order';
    protected $fillable = [
        'id_order',
        'id_product',
        'quantity',
        'code_promo',
    ];

    public $timestamps = true;

    public function order()
    {
        return $this->belongsTo(OrderModel::class, 'id_order', 'id_order');
    }

    public function product()
    {
        return $this->belongsTo(ProductModel::class, 'id_product', 'id_product');
    }
}
