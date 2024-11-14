<?php

use Illuminate\Support\Facades\Route;



// Route Public
Route::prefix('')->group(
    function () {
        Route::get('/', [App\Http\Controllers\HomeController::class, 'links'])->name('links');
        Route::get('/home', [App\Http\Controllers\HomeController::class, 'home'])->name('home');
        Route::get('/category/{id}', [App\Http\Controllers\HomeController::class, 'show'])->name('category.show');
    }
);

Route::prefix('admin')->group(function () {
    // Define your admin routes here
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index']);

    // Category
    Route::get('/category', [App\Http\Controllers\Admin\CategoryController::class, 'index'])->name('category.index');
    Route::get('/category/create', [App\Http\Controllers\Admin\CategoryController::class, 'create'])->name('category.create');
    Route::post('/category', [App\Http\Controllers\Admin\CategoryController::class, 'store'])->name('category.store');
    Route::get('/category/{id}/edit', [App\Http\Controllers\Admin\CategoryController::class, 'edit'])->name('category.edit');
    Route::put('/category/{id}', [App\Http\Controllers\Admin\CategoryController::class, 'update'])->name('category.update');
    Route::delete('/category/{id}', [App\Http\Controllers\Admin\CategoryController::class, 'destroy'])->name('category.destroy');
});

