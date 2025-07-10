<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\User\ArticleController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CartController;

    Route::controller(HomeController::class)->group(function () {
        Route::get('/', 'links');
        Route::get('/home', 'home');
        Route::get('/about', 'about');
        Route::get('/collection', 'collection');
        Route::get('/collection/{code}', 'collection');
        Route::post('/collection/like/{code}', 'like');
    });

    // Public - Article
    Route::controller(ArticleController::class)->group(function () {
        Route::get('/article', 'index');
        Route::get('/article/{slug}', 'index');
    });
Route::controller(OrderController::class)->group(function () {
    Route::get('/make-order/{product}', 'showOrderForm');
    Route::post('/make-order/{product}', 'storeOrder');
    Route::get('/my-order', 'myOrder');
    Route::get('/order-payment/{code}', 'orderPayment');
    Route::post('/order-payment/{code}', 'updatePayment');
    Route::get('/edit-order/{code}', 'edit');
    Route::post('/update-order/{code}', 'update');
    Route::delete('/delete-order/{code}', 'destroy');
});

// Cart Routes
Route::controller(CartController::class)->group(function () {
    Route::get('/cart', 'index')->name('cart.index');
    Route::post('/cart', 'store')->name('cart.store');
    // Route::delete('/cart/{id}', 'destroy')->name('cart.destroy');
});
