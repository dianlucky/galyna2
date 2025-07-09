<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PaymentModel extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'payment';
    protected $primaryKey = 'id_payment';
    protected $fillable = [
        'payment_code',
        'amount',
        'status',
    ];

    public $timestamps = true;
}
