<?php
// ADMIN ROUTES -------------> [PROTECTED WITH MIDDLEWARE AUTH AND ADMIN ROLE]

use Illuminate\Support\Facades\Route;

Route::pattern('id', '[0-9]+');

Route::prefix('admin')
    ->middleware(['checkRole:admin'])
    ->group(function () {
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
            Route::get('/product/edit/{id}', 'edit');
            Route::put('/product/{id}', 'update');
            Route::delete('/product', 'destroy');
        });

        // Admin - Article
        Route::controller(App\Http\Controllers\Admin\ArticleController::class)->group(function () {
            Route::get('/article', 'index');
            Route::get('/article/create', 'create');
            Route::post('/article', 'store');
            Route::get('/article/edit/{id}', 'edit');
            Route::put('/article/{id}', 'update');
            Route::delete('/article', 'destroy');
        });

        // Admin - Links
        Route::controller(App\Http\Controllers\Admin\LinksController::class)->group(function () {
            Route::get('/links', 'index');
            Route::get('/links/create', 'create');
            Route::post('/links', 'store');
            Route::get('/links/edit/{id}', 'edit');
            Route::put('/links/{id}', 'update');
            Route::delete('/links', 'destroy');
        });

        // Admin - Users
        Route::controller(App\Http\Controllers\Admin\UserController::class)->group(function () {
            Route::get('/user', 'index');
            Route::get('/user/create', 'create');
            Route::post('/user', 'store');
            Route::get('/user/edit/{id}', 'edit');
            Route::put('/user/{id}', 'update');
            Route::delete('/user', 'destroy');
        });

        // Admin - Order
        Route::controller(App\Http\Controllers\Admin\OrderController::class)->group(function () {
            Route::get('/order/proses', 'proses');
            Route::get('/order/dikirim', 'dikirim');
        });

        // Admin Omset
        Route::controller(App\Http\Controllers\Admin\DashboardController::class)->group(function () {
            Route::get('/omset', 'omsetAll');
        });

        // Admin - Promo
        Route::controller(App\Http\Controllers\Admin\PromoController::class)->group(function () {
            Route::get('/promo', 'index');
            Route::get('/promo/create', 'create');
            Route::post('/promo', 'store');
            Route::get('/promo/edit/{id}', 'edit');
            Route::put('/promo/{id}', 'update');
            Route::delete('/promo', 'destroy');
        });
    });
