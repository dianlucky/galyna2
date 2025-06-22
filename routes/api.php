<?php
// routes/api.php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RajaOngkirController;

// Route::get('/search-destination', [RajaOngkirController::class, 'getDestination']);
Route::middleware('throttle:30,1')->group(function () {
    Route::get('/search-destination', [RajaOngkirController::class, 'getDestination']);
});

?>