<?php

use Illuminate\Support\Facades\Route;

// ROUTE CONFIGURATION

// Route pattern {id} to accept only numbers
Route::pattern('id', '[0-9]+');


require __DIR__ . '/auth.php';

require __DIR__ . '/guest.php';

require __DIR__ . '/admin.php';


