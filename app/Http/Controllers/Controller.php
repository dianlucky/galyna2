<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests; // WAJIB ada
use Illuminate\Foundation\Validation\ValidatesRequests;   // WAJIB ada
use Illuminate\Routing\Controller as BaseController;      // WAJIB ada, dengan alias BaseController

class Controller extends BaseController // WAJIB meng-extend BaseController
{
    use AuthorizesRequests, ValidatesRequests; // WAJIB menggunakan trait ini
}
