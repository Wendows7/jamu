<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;



Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/products', [ProductController::class, 'index'])->name('products');
Route::get('/products/detail/{product}', [ProductController::class, 'detail'])->name('products.detail');
Route::post('/addToCart', [CartController::class, 'addToCart'])->name('cart.addToCart');
Route::post('/cart/updateQuantity', [CartController::class, 'updateQuantity'])->name('cart.updateQuantity');
Route::post('/cart/remove', [CartController::class, 'removeFromCart'])->name('cart.remove');
Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');

Route::get('/cart/orderDetail/{orderCode}', [CartController::class, 'OrderDetail'])->name('cart.orderDetail');
Route::post('/cart/checkout/createOrderDetail', [CartController::class, 'createOrderDetail'])->name('cart.createOrderDetail');
Route::post('/cart/payment', [CartController::class, 'addPaymentProof'])->name('cart.payment');
Route::get('/payment', [CartController::class, 'payment'])->name('payment');
Route::get('/cart', [CartController::class, 'index'])->name('cart');



