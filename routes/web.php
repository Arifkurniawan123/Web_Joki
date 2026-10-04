<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES (Website User)
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/

Route::prefix('admin')
    ->name('admin.')
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