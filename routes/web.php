<?php

use Illuminate\Support\Facades\Route;



Route::prefix('admin')->group(function () {
    // Define your admin routes here
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index']);

    // Category
    Route::get('/category', [App\Http\Controllers\Admin\CategoryController::class, 'index']);
});
