<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CheckoutController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\AuthController;
use App\Models\Product;
use App\Models\Order;
use App\Models\Cart;
use App\Models\User;

Route::withoutMiddleware(['web'])->group(function () {
    Route::post('login', [AuthController::class, 'generateToken']);
    Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

    // Public Routes
    Route::get('/products', [ProductController::class, 'index']);
    Route::get('/products/{id}', [ProductController::class, 'show']);
    


    // Protected Routes (Requires Authentication)
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/user/profile', [UserController::class, 'profile']);
        Route::get('/user/products', [ProductController::class, 'userHub']);
        Route::post('/products', [ProductController::class, 'store']);
        Route::put('/products/{id}', [ProductController::class, 'update']);
        Route::delete('/products/{id}', [ProductController::class, 'destroy']);

        Route::post('/cart/add', [CartController::class, 'add']);
        Route::get('/cart', [CartController::class, 'view']);
        Route::delete('/cart/remove', [CartController::class, 'remove']);

        // Checkout Routes
        Route::post('/checkout', [CheckoutController::class, 'process']);
        Route::get('/checkout/{id}', [CheckoutController::class, 'show']);
        


        Route::get('/orders', [OrderController::class, 'index']);
    });
});
