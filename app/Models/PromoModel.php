<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PromoModel extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'promo';
    protected $primaryKey = 'id_promo';
    protected $fillable = [
        'id_product',
        'code_promo',
        'type',
        'amount',
        'name',
        'description',
    ];

    public $timestamps = true;
}
