<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Models\User;
use App\Http\Middleware\EnsureUserIsAdmin;

Route::prefix('api')
    ->middleware('api')
    ->group(base_path('routes/api.php'));

/* Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login'); */
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/admin', function () {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized');
        }
        return app(AdminController::class)->index();
    })->name('admin.home');

    Route::get('/admin/users', function () {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized');
        }
        return app(AdminController::class)->users();
    })->name('admin.users');
});

Route::middleware(['auth'])->group(function () {
    Route::middleware([EnsureUserIsAdmin::class])->group(function () {
        Route::get('/admin/product-requests', [AdminController::class, 'productRequests'])->name('admin.product_requests');
        Route::post('/admin/product-requests/{id}/accept', [AdminController::class, 'acceptProductRequest'])->name('admin.product_requests.accept');
        Route::post('/admin/product-requests/{id}/decline', [AdminController::class, 'declineProductRequest'])->name('admin.product_requests.decline');
        Route::get('/admin/products', [AdminController::class, 'products'])->name('admin.products');
    });
});



Route::get('/', [ProductController::class, 'home'])
    ->name('home');

Route::get('/checkout/cart', [CheckoutController::class, 'cartCheckout'])
    ->name('checkout.cart');

//*----------- Sanctum Routes ---------- */

Route::view('painting_dashboard', 'painting_dashboard')
    ->middleware('auth:sanctum');

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/checkout/{id}', [CheckoutController::class, 'show'])
        ->name('checkout.show');

    Route::view('create', 'create_product')
        ->middleware('verified')
        ->name('create');

    Route::view('dashboard', 'dashboard')
        ->middleware('verified')
        ->name('dashboard');

    Route::view('profile', 'profile')
        ->name('profile');

    Route::get('/hub', [ProductController::class, 'userHub']);

    Route::delete('/products/{id}', [ProductController::class, 'destroy']);

    Route::get('/products/{id}/edit', [ProductController::class, 'edit']);

    Route::put('/products/{id}', [ProductController::class, 'update']);

    Route::get('/cart', [CartController::class, 'showCart'])
        ->name('cart.show');

    Route::delete('/cart/remove/{productId}', [CartController::class, 'removeFromCart'])
        ->name('cart.remove');
});

// Public routes
Route::get('/artist/{id}', [ProductController::class, 'artist_products'])
    ->name('artist.show');

Route::get('/products', [ProductController::class, 'index'])
    ->name('products.index');

Route::get('/product/{id}', [ProductController::class, 'show'])
    ->name('product.show');

Route::post('/cart/add', [CartController::class, 'add'])
    ->name('cart.add');

Route::post('/checkout', [CheckoutController::class, 'process'])
    ->name('checkout.process');

Route::get('/orders/history', [CheckoutController::class, 'history'])
    ->name('orders.history');

Route::post('/submit-painting', [ProductController::class, 'store']);

require __DIR__.'/auth.php';
