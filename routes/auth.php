<?php

// AUTH ROUTES -------------> [NO MIDDLEWARE]
use Illuminate\Support\Facades\Route;

Route::controller(App\Http\Controllers\Auth\AuthController::class)->group(
    function () {
        Route::get('/login', 'showLoginForm')->name('login');
        Route::get('/register', 'showRegisterForm')->name('register');
        Route::post('/login', 'login')->name('login');
        Route::post('/logout', 'logout')->name('logout');
        Route::get('/logout', 'logout')->name('logout');
    }
);
