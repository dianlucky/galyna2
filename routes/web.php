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
    
    // pengguna
    Route::get('/pengguna', [App\Http\Controllers\Admin\PenggunaController::class, 'index'])->name('pengguna.index');
    Route::get('/pengguna/create', [App\Http\Controllers\Admin\PenggunaController::class, 'create'])->name('pengguna.create');
    Route::post('/pengguna', [App\Http\Controllers\Admin\PenggunaController::class, 'store'])->name('pengguna.store');
    Route::get('/pengguna/{id}/edit', [App\Http\Controllers\Admin\PenggunaController::class, 'edit'])->name('pengguna.edit');
    Route::put('/pengguna/{id}', [App\Http\Controllers\Admin\PenggunaController::class, 'update'])->name('pengguna.update');
    Route::delete('/pengguna/{id}', [App\Http\Controllers\Admin\PenggunaController::class, 'destroy'])->name('pengguna.destroy');
    
    // pengguna
    Route::get('/pengaturan', [App\Http\Controllers\Admin\PengaturanController::class, 'index'])->name('pengaturan.index');
    Route::get('/pengaturan/create', [App\Http\Controllers\Admin\PengaturanController::class, 'create'])->name('pengaturan.create');
    Route::post('/pengaturan', [App\Http\Controllers\Admin\PengaturanController::class, 'store'])->name('pengaturan.store');
    Route::get('/pengaturan/{id}/edit', [App\Http\Controllers\Admin\PengaturanController::class, 'edit'])->name('pengaturan.edit');
    Route::put('/pengaturan/{id}', [App\Http\Controllers\Admin\PengaturanController::class, 'update'])->name('pengaturan.update');
    Route::delete('/pengaturan/{id}', [App\Http\Controllers\Admin\PengaturanController::class, 'destroy'])->name('pengaturan.destroy');
});

