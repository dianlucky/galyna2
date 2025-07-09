<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DeliveryModel extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'delivery';
    protected $primaryKey = 'id_delivery';
    protected $fillable = [
        'destination_code',
        'destination',
        'courier',
        'delivery_type',
        'estimated_day',
    ];

    public $timestamps = true;
}
