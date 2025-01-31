<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CheckoutController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within the "api" middleware
| group. Enjoy building your API!
|
*/

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
