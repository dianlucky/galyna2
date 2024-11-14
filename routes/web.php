<?php

use Illuminate\Support\Facades\Route;



// Route Public
Route::prefix('')->group(
    function () {
        Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);
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
    
    //Product
    Route::get('/product', [App\Http\Controllers\Admin\ProductController::class, 'index'])->name('product.index');
    Route::get('/product/create', [App\Http\Controllers\Admin\ProductController::class, 'create'])->name('product.create');
    Route::post('/product', [App\Http\Controllers\Admin\ProductController::class, 'store'])->name('product.store');
    Route::get('/product/{id}/edit', [App\Http\Controllers\Admin\ProductController::class, 'edit'])->name('product.edit');
    Route::put('/product/{id}', [App\Http\Controllers\Admin\ProductController::class, 'update'])->name('product.update');
    Route::delete('/product/{id}', [App\Http\Controllers\Admin\ProductController::class, 'destroy'])->name('product.destroy');

    // articel
    Route::get('/articel', [App\Http\Controllers\Admin\ArticelController::class, 'index'])->name('articel.index');
    Route::get('/articel/create', [App\Http\Controllers\Admin\ArticelController::class, 'create'])->name('articel.create');
    Route::post('/articel', [App\Http\Controllers\Admin\ArticelController::class, 'store'])->name('articel.store');
    Route::get('/articel/{id}/edit', [App\Http\Controllers\Admin\ArticelController::class, 'edit'])->name('articel.edit');
    Route::put('/articel/{id}', [App\Http\Controllers\Admin\ArticelController::class, 'update'])->name('articel.update');
    Route::delete('/articel/{id}', [App\Http\Controllers\Admin\ArticelController::class, 'destroy'])->name('articel.destroy');
});

