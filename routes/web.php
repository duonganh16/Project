<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', [PageController::class, 'home']);
Route::get('/products', [PageController::class, 'products']);
Route::get('/product/{id}', [PageController::class, 'product']);
Route::get('/about', [PageController::class, 'about']);
Route::get('/contact', [PageController::class, 'contact']);

// Cart routes - require authentication
Route::middleware('auth')->group(function () {
    Route::get('/cart', [CartController::class, 'index']);
    Route::post('/cart/add/{id}', [CartController::class, 'add']);
    Route::post('/cart/remove/{id}', [CartController::class, 'remove']);
    Route::get('/checkout', [CartController::class, 'checkout']);
    Route::post('/place-order', [CartController::class, 'placeOrder']);
});

Route::get('/dashboard', function () {
    // Redirect admin to admin panel, regular users to home
    if (auth()->check() && auth()->user()->is_admin) {
        return redirect()->route('admin.products.index');
    }
    return redirect('/');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Order routes for authenticated users
    Route::get('/my-orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/my-orders/{id}', [OrderController::class, 'show'])->name('orders.show');
});

// Admin routes
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin', 'rate.limit:30,1'])->group(function () {
    Route::resource('products', AdminProductController::class);
});

require __DIR__.'/auth.php';
