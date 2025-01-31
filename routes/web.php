<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;

Route::get('/', [ProductController::class, 'home'])
    ->name('home');



Route::get('/checkout/cart', [CheckoutController::class, 'cartCheckout'])
    ->name('checkout.cart');


//*----------- Sanctum Routes ---------- */

Route::view('painting_dashboard', 'painting_dashboard')
    ->middleware('auth:sanctum'); 

Route::middleware(['auth:sanctum'])
    ->get('/checkout/{id}', [CheckoutController::class, 'show'])
    ->name('checkout.show');
/* ---------------------------- */

Route::get('/products', [ProductController::class, 'index'])
    ->name('products.index');

Route::view('create', 'create_product')
    ->middleware(['auth', 'verified'])
    ->name('create');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::get('/product/{id}', [ProductController::class, 'show'])
    ->name('product.show');



Route::post('/cart/add', [CartController::class, 'add'])
    ->name('cart.add');


    


Route::middleware('auth')->group(function () {
        // Route to show the cart
    Route::get('/cart', [CartController::class, 'showCart'])->name('cart.show');
    
        // Route to remove a product from the cart
    Route::delete('/cart/remove/{productId}', [CartController::class, 'removeFromCart'])->name('cart.remove');
});




Route::post('/checkout', [CheckoutController::class, 'process'])
    ->name('checkout.process');


Route::get('/hub', [ProductController::class, 'userHub'])
    ->middleware('auth');

Route::delete('/products/{id}', [ProductController::class, 'destroy'])
    ->middleware('auth');

Route::get('/products/{id}/edit', [ProductController::class, 'edit']);

Route::put('/products/{id}', [ProductController::class, 'update']);
    

Route::get('/orders/history', [CheckoutController::class, 'history'])
    ->name('orders.history');
    

/* Post Routes */

Route::post('/submit-painting', [ProductController::class, 'store']);
    



require __DIR__.'/auth.php';
