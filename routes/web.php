<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PublicGameController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\OrderStatusController;
use App\Http\Controllers\PublicPostController;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES (Website User)
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/game', [PublicGameController::class, 'index'])->name('game.index');
Route::get('/game/{slug}', [PublicGameController::class, 'show'])->name('game.show');

// Cart
Route::prefix('keranjang')->name('cart.')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('index');
    Route::post('/add/{slug}', [CartController::class, 'add'])->name('add');
    Route::delete('/remove/{id}', [CartController::class, 'remove'])->name('remove');
    Route::delete('/clear', [CartController::class, 'clear'])->name('clear');
});

// Checkout
Route::prefix('checkout')->name('checkout.')->group(function () {
    Route::get('/', [CheckoutController::class, 'index'])->name('index');
    Route::post('/', [CheckoutController::class, 'store'])->name('store');
});

// Payment
Route::get('/payment/{order_code}', [PaymentController::class, 'show'])->name('payment.show');
Route::post('/payment/{order_code}/confirm', [PaymentController::class, 'confirm'])->name('payment.confirm');

// Account
Route::get('/account/{order_code}', [AccountController::class, 'show'])->name('account.show');
Route::post('/account/{order_code}', [AccountController::class, 'store'])->name('account.store');

// Invoice
Route::get('/invoice/{order_code}', [InvoiceController::class, 'show'])->name('invoice.show');


Route::get('/cek-order', [OrderStatusController::class, 'index'])->name('order.status');
Route::get('/cek-order/{order_code}', [OrderStatusController::class, 'show'])->name('order.status.show');

Route::get('/artikel', [PublicPostController::class, 'index'])->name('post.index');
Route::get('/artikel/{slug}', [PublicPostController::class, 'show'])->name('post.show');

Route::view('/cara-order', 'public.cara-order')->name('cara-order');
/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/

Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth'])        
    ->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::resource('game', GameController::class)
            ->parameters(['game' => 'slug']);

        Route::resource('service', ServiceController::class)
            ->parameters(['service' => 'slug']);

        Route::resource('order', OrderController::class)
            ->only(['index', 'show', 'update']);

        Route::resource('post', PostController::class)
            ->parameters(['post' => 'slug']);

        Route::get('/setting', [SettingController::class, 'index'])->name('setting.index');
        Route::put('/setting', [SettingController::class, 'update'])->name('setting.update');

    });