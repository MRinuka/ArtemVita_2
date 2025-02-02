<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CheckoutController;
use App\Http\Controllers\AuthController;

Route::post('login', [AuthController::class, 'generateToken']); // Route for user login and token generation
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum'); // Route for user logout and token revocation
    // Logout route

// Public Routes
Route::get('/products', [ProductController::class, 'index']); // Get all products
Route::get('/products/{id}', [ProductController::class, 'show']); // Get product details by ID

// Protected Routes (Requires Authentication)
Route::middleware('auth:sanctum')->group(function () {
    // Product Routes
    Route::get('/user/products', [ProductController::class, 'userHub']); // Get user's products
    Route::post('/products', [ProductController::class, 'store']); // Create a product
    Route::put('/products/{id}', [ProductController::class, 'update']); // Update a product
    Route::delete('/products/{id}', [ProductController::class, 'destroy']); // Delete a product

    // Checkout Routes
    Route::get('/checkout/{id}', [CheckoutController::class, 'show']); // Get checkout details for a product
    Route::post('/checkout', [CheckoutController::class, 'process']); // Process the checkout
});
