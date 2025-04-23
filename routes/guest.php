<?php

use Illuminate\Support\Facades\Route;

// PUBLIC ROUTES -------------> [NO MIDDLEWARE]
Route::prefix('')->group(
    function () {
        // Public - Home
        Route::controller(App\Http\Controllers\HomeController::class)->group(
            function () {
                Route::get('/', 'links');
                Route::get('/home', 'home');
                Route::get('/about', 'about');
                Route::get('/collection', 'collection');
                Route::get('/collection/{code}', 'collection');
                Route::post('/collection/like/{code}', 'like');
            }
        );

        // Public - Article
        Route::controller(App\Http\Controllers\User\ArticleController::class)->group(
            function () {
                Route::get('/article', 'index');
                Route::get('/article/{slug}', 'index');
            }
        );
    }
);


// PUBLIC ROUTE --------> [WITH MIDDLEWARE AUTH]
Route::middleware(['auth'])->group(
    function () {
        // User - Order
        Route::controller(App\Http\Controllers\User\OrderController::class)->group(
            function () {
                Route::get('/make-order/{product}', 'showOrderForm');
                Route::post('/make-order/{product}', 'storeOrder');
                Route::get('/my-order', 'myOrder');
                Route::get('/order-payment/{code}', 'orderPayment');
                Route::post('/order-payment/{code}', 'updatePayment');
            }
        );
    }
);
