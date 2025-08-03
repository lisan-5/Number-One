<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Middleware\AdminMiddleware;

Route::get('/', function () {
    return view('welcome');
})->name('home');

// Products listing for all users and guests
Route::get('/products', [ProductController::class, 'index'])->name('products');
// Dedicated product detail page
Route::get('/products/{shoe}', [ProductController::class, 'show'])->name('products.show');
// Filter products by tag
Route::get('/tags/{tag}', [ProductController::class, 'tag'])->name('products.tag');
// Categories listing and filtering
Route::get('/categories', [CategoryController::class, 'index'])->name('categories');
Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('categories.show');
// About page
Route::view('/about', 'about')->name('about');
// Admin Shoe resource routes
Route::middleware(['auth', AdminMiddleware::class])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('shoes', \App\Http\Controllers\Admin\ShoeController::class);
    // User management
    Route::resource('users', \App\Http\Controllers\Admin\UserController::class)->only(['index', 'edit', 'update', 'destroy']);
    // Order management
    Route::resource('orders', OrderController::class)->only(['index', 'show', 'update']);
});
// Shopping Cart
Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
// Checkout routes for authenticated users
Route::middleware('auth')->get('/checkout', [CheckoutController::class, 'create'])->name('checkout.create');
Route::middleware('auth')->post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::post('/contact', function (Request $request) {
    $data = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email',
        'message' => 'required|string',
    ]);

    // Message handling logic goes here

    return back()->with('success', 'Your message has been sent successfully!');
})->name('contact.submit');

// Redirect dashboard access to home page
Route::get('/dashboard', function () {
    return redirect()->route('home');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // Order history
    Route::get('/orders/history', [\App\Http\Controllers\OrderHistoryController::class, 'index'])->name('orders.history');
    Route::get('/orders/{order}', [\App\Http\Controllers\OrderHistoryController::class, 'show'])->name('orders.show');
    // Wishlist routes
    Route::get('/wishlist', [\App\Http\Controllers\WishlistController::class, 'index'])->name('wishlist.index');
    Route::post('/wishlist/{shoe}/toggle', [\App\Http\Controllers\WishlistController::class, 'toggle'])->name('wishlist.toggle');
});


require __DIR__.'/auth.php';
