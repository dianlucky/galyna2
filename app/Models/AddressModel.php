<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AddressModel extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'address';
    protected $primaryKey = 'id_address';
    protected $fillable = [
        'id_user',
        'address_code',
        'address_name',
        'status',
    ];

    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
}
