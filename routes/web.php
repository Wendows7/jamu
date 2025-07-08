<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PartnershipController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;



Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/products', [ProductController::class, 'index'])->name('products');
Route::get('/products/detail/{product}', [ProductController::class, 'detail'])->name('products.detail');
Route::get('/products/search', [ProductController::class, 'search'])->name('products.search');
Route::get('/login', [LoginController::class, 'index'])->name('auth.login');
Route::post('/auth/login', [LoginController::class, 'authenticate'])->name('auth.authenticate');
Route::get('/register', [LoginController::class, 'register'])->name('auth.register');
Route::post('/auth/register', [LoginController::class, 'store'])->name('auth.register.store');
Route::get('/partnership', [PartnershipController::class, 'index'])->name('partnership');

Route::middleware('auth')->group(function () {
    Route::post('/addToCart', [CartController::class, 'addToCart'])->name('cart.addToCart');
    Route::post('/cart/updateQuantity', [CartController::class, 'updateQuantity'])->name('cart.updateQuantity');
    Route::post('/cart/remove', [CartController::class, 'removeFromCart'])->name('cart.remove');
    Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');

    Route::get('/cart/orderDetail/{orderCode}', [CartController::class, 'OrderDetail'])->name('cart.orderDetail');
    Route::post('/cart/checkout/createOrderDetail', [CartController::class, 'createOrderDetail'])->name('cart.createOrderDetail');
    Route::post('/cart/payment', [CartController::class, 'addPaymentProof'])->name('cart.payment');
    Route::get('/payment', [CartController::class, 'payment'])->name('payment');
    Route::get('/cart', [CartController::class, 'index'])->name('cart');

    Route::get('/user/orders', [UserController::class, 'getOrderByUserId'])->name('user.orders');
    Route::post('/user/order/cancel/{orderCode}', [UserController::class, 'cancelOrder'])->name('user.cancelOrderByOrderCode');


    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/profile', [UserController::class, 'profile'])->name('auth.profile');
    Route::post('/profile/update', [UserController::class, 'updateProfile'])->name('auth.updateProfile');

    Route::post('/partnership/create', [PartnershipController::class, 'create'])->name('partnership.create');

});

Route::middleware('admin')->group(function () {
    Route::get('/dashboard/admin', [AdminController::class, 'index'])->name('admin.index');

    Route::get('dashboard/admin/users', [AdminController::class, 'users'])->name('admin.users');
    Route::delete('dashboard/admin/users/delete/{user}', [AdminController::class, 'deleteUserById'])->name('admin.users.delete');
    Route::post('dashboard/admin/users/create', [AdminController::class, 'addUser'])->name('admin.users.create');
    Route::put('dashboard/admin/users/update/{user}', [AdminController::class, 'editUserById'])->name('admin.users.update');

    Route::get('dashboard/admin/products', [AdminController::class, 'getProducts'])->name('admin.products');
    Route::delete('dashboard/admin/products/delete/{product}', [AdminController::class, 'deleteProductById'])->name('admin.products.delete');
    Route::post('dashboard/admin/products/update', [AdminController::class, 'editProduct'])->name('admin.products.update');
    Route::post('dashboard/admin/products/create', [AdminController::class, 'addProduct'])->name('admin.products.create');

    Route::get('dashboard/admin/category', [AdminController::class, 'getCategory'])->name('admin.category');
    Route::post('dashboard/admin/category/create', [AdminController::class, 'addCategory'])->name('admin.category.create');
    Route::post('dashboard/admin/category/update', [AdminController::class, 'editCategoryById'])->name('admin.category.update');
    Route::delete('dashboard/admin/category/delete', [AdminController::class, 'deleteCategoryById'])->name('admin.category.delete');

    Route::get('dashboard/admin/orders', [AdminController::class, 'getOrders'])->name('admin.orders');
    Route::put('dashboard/admin/orders/update', [AdminController::class, 'updateStatusOrder'])->name('admin.orders.update');


});

Route::get('/email', function () {
//    Mail::to('aryadwi482@gmail.com')->send(new \App\Mail\NotifMail());
    return new \App\Mail\NotifMail();
});





