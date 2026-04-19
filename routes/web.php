<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/shop', [\App\Http\Controllers\ShopController::class, 'index'])->name('shop');
Route::get('/products/{slug}', [\App\Http\Controllers\ShopController::class, 'show'])->name('products.show');

// Checkout & Orders
Route::get('/checkout', \App\Livewire\CheckoutPage::class)->name('checkout');
Route::get('/order-success/{orderNumber}', [\App\Http\Controllers\ShopController::class, 'orderSuccess'])->name('order.success');
