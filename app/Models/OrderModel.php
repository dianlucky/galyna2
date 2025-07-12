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
            'id_user',
            'id_payment',
            'id_delivery',
            'order_code',
            'message',
            'status_payment',
            'status_order',
        ];

    public $timestamps = true;

    // public function product()
    // {
    //     return $this->belongsTo(ProductModel::class, 'id_product', 'id_product');
    // }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
    public function payment()
    {
        return $this->belongsTo(PaymentModel::class, 'id_payment', 'id_payment');
    }
    
    public function delivery()
    {
        return $this->belongsTo(DeliveryModel::class, 'id_delivery', 'id_delivery');
    }
}
