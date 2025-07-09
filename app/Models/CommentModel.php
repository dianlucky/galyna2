<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class CommentModel extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'comment';
    protected $primaryKey = 'id_comment';
    protected $fillable = [
        'id_user',
        'id_product',
        'comment',
        'rating',
    ];

    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
    public function product()
    {
        return $this->belongsTo(ProductModel::class, 'id_product', 'id_product');
    }
}
