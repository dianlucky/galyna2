<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ShoppingCartModel extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'shopping_cart';
    protected $primaryKey = 'id_cart';
    protected $fillable = [
        'id_user',
        'id_product',
        'quantity',
        'status',
    ];

    public $timestamps = true;
}
