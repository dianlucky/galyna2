<?php

use Illuminate\Support\Facades\Route;

// ROUTE CONFIGURATION

// Route pattern {id} to accept only numbers
Route::pattern('id', '[0-9]+');


// AUTH ROUTES -------------> [NO MIDDLEWARE]
Route::controller(App\Http\Controllers\Auth\AuthController::class)->group(
    function () {
        Route::get('/login', 'showLoginForm')->name('login');
        Route::post('/login', 'login')->name('login');
        Route::post('/logout', 'logout')->name('logout');
    }
);

// PUBLIC ROUTES -------------> [NO MIDDLEWARE]
Route::prefix('')
    ->controller(App\Http\Controllers\HomeController::class)
    ->group(
        function () {
            Route::get('/', 'links');
            Route::get('/home', 'home');
            Route::get('/category/{id}', 'show');
        }
    );

// ADMIN ROUTES -------------> [PROTECTED WITH MIDDLEWARE AUTH AND ADMIN ROLE]
Route::prefix('admin')->group(function () {

    // Admin - Dashboard
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index']);

    // Admin - Category
    Route::controller(App\Http\Controllers\Admin\CategoryController::class)->group(function () {
        Route::get('/category', 'index');
        Route::get('/category/create', 'create');
        Route::post('/category', 'store');
        Route::get('/category/edit/{id}', 'edit');
        Route::put('/category/{id}', 'update');
        Route::delete('/category', 'destroy');
    });

    // Admin - Products
    Route::controller(App\Http\Controllers\Admin\ProductController::class)->group(function () {
        Route::get('/product', 'index');
        Route::get('/product/create', 'create');
        Route::post('/product', 'store');
        Route::get('/product/{id}/edit', 'edit');
        Route::put('/product/{id}', 'update');
        Route::delete('/product/{id}', 'destroy');
    });
});
