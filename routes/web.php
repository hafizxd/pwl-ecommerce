<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\ProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisterController::class, 'create'])->name('register');
    Route::post('register', [RegisterController::class, 'store'])->name('register.store');
    Route::get('login', [AuthController::class, 'create'])->name('login');
    Route::post('login', [AuthController::class, 'store'])->name('login.store');
});

Route::middleware('auth')->group(function () {
    // user
    Route::middleware('user')->group(function () {
        Route::get('/', [HomeController::class, 'index'])->name('home');

        Route::get('carts', [HomeController::class, 'indexCart'])->name('cart');
        Route::post('carts/{productId}', [HomeController::class, 'storeCart'])->name('cart.store');
        Route::delete('carts', [HomeController::class, 'destroyAllCart'])->name('cart.delete-all');
        Route::delete('carts/{cartId}', [HomeController::class, 'destroyCart'])->name('cart.delete');
        
        Route::post('checkout', [HomeController::class, 'checkout'])->name('checkout');
        Route::get('orders', [HomeController::class, 'indexOrder'])->name('order');
    });


    // admin
    Route::group(['middleware' => 'admin', 'prefix' => 'admin', 'as' => 'admin.'], function () {
        Route::get('products', [ProductController::class, 'index'])->name('product');
        Route::get('products/create', [ProductController::class, 'create'])->name('product.create');
        Route::post('products', [ProductController::class, 'store'])->name('product.store');
        Route::get('products/{id}', [ProductController::class, 'edit'])->name('product.edit');
        Route::put('products/{id}', [ProductController::class, 'update'])->name('product.update');
        Route::delete('products/{id}', [ProductController::class, 'delete'])->name('product.delete');

        Route::get('orders', [OrderController::class, 'index'])->name('order');
        Route::get('orders/{id}', [OrderController::class, 'detail'])->name('order.detail');
        Route::put('orders/{id}', [OrderController::class, 'confirm'])->name('order.confirm');
    });

    Route::post('logout', [AuthController::class, 'destroy'])->name('logout');
});
