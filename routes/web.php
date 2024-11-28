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
Route::prefix('')->group(
    function () {

        // Public - Home
        Route::controller(App\Http\Controllers\HomeController::class)->group(
            function () {
                Route::get('/', 'links');
                Route::get('/home', 'home');
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




// ADMIN ROUTES -------------> [PROTECTED WITH MIDDLEWARE AUTH AND ADMIN ROLE]
Route::prefix('admin')
    ->middleware(['checkRole:admin'])
    ->group(
        function () {

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

<<<<<<< HEAD
    // Admin - Links
    Route::controller(App\Http\Controllers\Admin\LinksController::class)->group(function () {
        Route::get('/links', 'index');
        Route::get('/links/create', 'create');
        Route::post('/links', 'store');
        Route::get('/links/edit/{id}', 'edit');
        Route::put('/links/{id}', 'update');
        Route::delete('/links', 'destroy');
    });

    // Admin - User
});
=======
            // Admin - User
        }
    );
>>>>>>> ff2bbb35179c2d83a3eed4485e509d068af63c48
