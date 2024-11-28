<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LinksModel extends Model
{
    protected $table = 'link';
    protected $primaryKey = 'id_link';
    protected $fillable = ['name', 'description'];
    public $timestamps = true;
}
