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
    Route::post('signup', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'generateToken']);
    

    // Public Routes
    Route::get('/products', [ProductController::class, 'index']);
    Route::get('/products/{id}', [ProductController::class, 'show']);
    


    // Protected Routes (Requires Authentication)
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/user/profile', [UserController::class, 'profile']);
        Route::post('logout', [AuthController::class, 'logout']);
        
        Route::post('/cart/add', [CartController::class, 'add']);
        Route::get('/cart', [CartController::class, 'view']);
        Route::delete('/cart/remove', [CartController::class, 'remove']);

        Route::post('/checkout', [CheckoutController::class, 'process']);
        Route::get('/checkout/{id}', [CheckoutController::class, 'show']);
        
        Route::get('/orders', [OrderController::class, 'index']);
    });
});
