<?php

use App\Http\Controllers\Constructor\ConstructorController;
use App\Http\Controllers\OAuth\VkOAuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OAuth\GoogleOAuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/login', [\App\Http\Controllers\HomeController::class, 'login'])->name('auth');

Route::prefix('auth')->group(function () {
    Route::prefix('vk')->group(function () {
        Route::get('/', [VkOAuthController::class, 'redirect'])->name('auth.vk');
        Route::get('/callback', [VkOAuthController::class, 'handle_callback']);
    });

    // Gogle OAuth
    Route::prefix('google')->group(function () {
        Route::get('/', [GoogleOAuthController::class, 'redirect'])->name('auth.google');
        Route::get('/callback', [GoogleOAuthController::class, 'handle_callback']);
    });
});

Route::prefix('bot')->group(function () {
    Route::get('/constructor', [ConstructorController::class, 'control'])->name('bot.constructor.control');
});
