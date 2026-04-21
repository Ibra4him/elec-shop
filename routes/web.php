<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\PageController;

// ─── Public Pages ─────────────────────────────────────────────────────────────
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/shop', [ShopController::class, 'index'])->name('shop');
Route::get('/products/{slug}', [ShopController::class, 'show'])->name('products.show');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');

// ─── Checkout & Orders ────────────────────────────────────────────────────────
Route::get('/checkout', \App\Livewire\CheckoutPage::class)->name('checkout');
Route::get('/order-success/{orderNumber}', [ShopController::class, 'orderSuccess'])->name('order.success');

// ─── Favorites ──────────────────────────────────────────────────────────────
Route::middleware('auth')->group(function () {
    Route::get('/favoris', \App\Livewire\FavoritesPage::class)->name('favorites');
});

// ─── Auth (guests only) ───────────────────────────────────────────────────────
Route::middleware('guest')->group(function () {
    Route::get('/login',    [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login',   [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register',[AuthController::class, 'register']);
});

// ─── Auth (authenticated only) ────────────────────────────────────────────────
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
