<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\MidtransController;
use App\Http\Controllers\ShoppingCartController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\User\CheckoutController;
use App\Http\Controllers\User\CheckoutSummaryController;
use App\Http\Controllers\User\OrderController as UserOrderController;
use App\Mail\SendTestMail;
use App\Models\ShoppingCartModel;
use Illuminate\Support\Facades\Mail;
/*
|--------------------------------------------------------------------------
| Customer Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {
    // ================== PROFILE ROUTES ==================
    Route::prefix('profile')->group(function () {
        Route::get('/', [HomeController::class, 'profile'])->name('profile.index');
        Route::patch('/update/{id}', [HomeController::class, 'profileUpdate'])->name('profile.update');
    });

    Route::prefix('address')->group(function () {
        Route::post('/add', [AddressController::class, 'store'])->name('address.store');
        Route::delete('/remove/{id}', [AddressController::class, 'destroy'])->name('address.remove');
        Route::patch('/status/{id}', [AddressController::class, 'status'])->name('address.status');
    });

    Route::prefix('shopping-cart')->group(function () {
        Route::get('/', [ShoppingCartController::class, 'index'])->name('cart.index');
        Route::post('/add', [ShoppingCartController::class, 'store'])->name('cart.store');
        Route::delete('/remove/{id}', [ShoppingCartController::class, 'destroy'])->name('shopping-cart.destroy');
    });

    Route::prefix('checkout-order')->group(function () {
        Route::post('/add', [CheckoutController::class, 'store'])->name('checkout-order.store');
    });

    Route::prefix('history-order')->group(function () {
        Route::get('/', [OrderController::class, 'index'])->name('history-order.index');
    });

    // ================== ORDER ROUTES ==================
    // Tampilkan form order produk berdasarkan kode produk
    Route::get('/make-order/{code_product}', [OrderController::class, 'showOrderForm'])->name('order.form');
    // Proses penyimpanan order
    Route::post('/order/store', [OrderController::class, 'storeOrder'])->name('order.store');
    Route::post('/update-payment-status', [OrderController::class, 'updatePayment']);
    // MIDTRANS PUNYA LAAAHHH
    Route::post('/midtrans-test-token', [MidtransController::class, 'make_snap']);
    Route::post('/midtrans-callback', [MidtransController::class, 'callback']);
    // Tampilkan daftar order milik user yang login
    Route::get('/orders/my', [OrderController::class, 'myOrder'])->name('order.my');
    // Raja Ongkir API
    // Route::middleware(['web', 'throttle:none'])->group(function () {
    //     Route::get('/search-destination', [RajaOngkirController::class, 'getDestination']);
    // });

    // Single order checkout
    Route::prefix('checkout')->group(function () {
        // Checkout summary (mungkin menampilkan ringkasan, ongkir, dll)
        Route::post('/summary', [CheckoutSummaryController::class, 'showSummary'])->name('checkout.checkout_summary');
        Route::post('/{order}/process', [OrderController::class, 'processCheckout'])->name('checkout.process_single');

        // Multiple orders checkout
        Route::get('/summary-multiple', [OrderController::class, 'showMultiOrderCheckoutSummary'])->name('checkout.summary_multiple');
        Route::post('/process-selected', [OrderController::class, 'processSelectedCheckout'])->name('checkout.process_multiple');

        Route::get('/checkout/{id}', [CheckoutController::class, 'show'])->name('checkout.show');

        // Calculate shipping cost
        Route::post('/shipping/calculate', [CheckoutSummaryController::class, 'calculateShippingCost'])->name('shipping.calculate');

        // Proses pembayaran final (umumnya setelah review semua data)
        Route::post('/process', [CheckoutController::class, 'process'])->name('checkout.process_payment');

        Route::get('/{order}', [OrderController::class, 'showCheckout'])->name('checkout.show');
    });
});

// ================== PUBLIC ROUTES (optional) ==================
// Route yang tidak memerlukan login (misal lihat produk)
