<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PartnershipController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AboutController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;



Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/products', [ProductController::class, 'index'])->name('products');
Route::get('/products/detail/{product}', [ProductController::class, 'detail'])->name('products.detail');
Route::get('/products/search', [ProductController::class, 'search'])->name('products.search');
Route::get('/login', [LoginController::class, 'index'])->name('auth.login');
Route::post('/auth/login', [LoginController::class, 'authenticate'])->name('auth.authenticate');
Route::get('/register', [LoginController::class, 'register'])->name('auth.register');
Route::post('/auth/register', [LoginController::class, 'store'])->name('auth.register.store');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::get('/products/stocks/{productId}', [ProductController::class, 'getStocks'])->name('products.stocks');

Route::middleware('user')->group(function () {
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


//    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
//    Route::get('/profile', [UserController::class, 'profile'])->name('auth.profile');
//    Route::post('/profile/update', [UserController::class, 'updateProfile'])->name('auth.updateProfile');

//    Route::post('/partnership/create', [PartnershipController::class, 'create'])->name('partnership.create');

});

Route::middleware('partner')->group(function () {
    Route::get('/partnership', [PartnershipController::class, 'index'])->name('partnership');
    Route::post('/partnership/create', [PartnershipController::class, 'create'])->name('partnership.create');
    Route::get('/partnership/data', [PartnershipController::class, 'partnershipData'])->name('partnership.data');
    Route::post('/partnership/replyFile/Upload', [PartnershipController::class, 'uploadReplyFile'])->name('partnership.replyFile.upload');
});

Route::middleware('admin')->group(function () {
    Route::get('/dashboard/admin', [AdminController::class, 'index'])->name('admin.index');

    Route::get('dashboard/admin/users', [AdminController::class, 'users'])->name('admin.users');
    Route::delete('dashboard/admin/users/delete/{user}', [AdminController::class, 'deleteUserById'])->name('admin.users.delete');
    Route::post('dashboard/admin/users/create', [AdminController::class, 'addUser'])->name('admin.users.create');
    Route::put('dashboard/admin/users/update/{user}', [AdminController::class, 'editUserById'])->name('admin.users.update');

    Route::get('dashboard/admin/data/products', [AdminController::class, 'getProducts'])->name('admin.products');
    Route::delete('dashboard/admin/data/products/delete/{product}', [AdminController::class, 'deleteProductById'])->name('admin.products.delete');
    Route::post('dashboard/admin/data/products/update', [AdminController::class, 'editProduct'])->name('admin.products.update');
    Route::post('dashboard/admin/data/products/create', [AdminController::class, 'addProduct'])->name('admin.products.create');

    Route::get('dashboard/admin/data/category', [AdminController::class, 'getCategory'])->name('admin.category');
    Route::post('dashboard/admin/data/category/create', [AdminController::class, 'addCategory'])->name('admin.category.create');
    Route::post('dashboard/admin/data/category/update', [AdminController::class, 'editCategoryById'])->name('admin.category.update');
    Route::delete('dashboard/admin/data/category/delete', [AdminController::class, 'deleteCategoryById'])->name('admin.category.delete');

    Route::get('dashboard/admin/data/orders', [AdminController::class, 'getOrders'])->name('admin.orders');
    Route::put('dashboard/admin/data/orders/update', [AdminController::class, 'updateStatusOrder'])->name('admin.orders.update');

    Route::get('dashboard/admin/partnerships/data', [AdminController::class, 'getPartnerships'])->name('admin.partnerships');
    Route::put('dashboard/admin/partnerships/update', [AdminController::class, 'updatePartnershipStatus'])->name('admin.partnerships.update');
    Route::get('dashboard/admin/partnerships/data/sending', [AdminController::class, 'getPartnerSendHistory'])->name('admin.partnerships.sendHistory');
    Route::post('dashboard/admin/partnerships/sending/add', [AdminController::class, 'addPartnerSendHistory'])->name('admin.partnerships.sending.add');



});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/profile', [UserController::class, 'profile'])->name('auth.profile');
    Route::post('/profile/update', [UserController::class, 'updateProfile'])->name('auth.updateProfile');
});

//Route::get('/email', function () {
////    Mail::to('aryadwi482@gmail.com')->send(new \App\Mail\NotifMail());
//    $data = [
//        'name' => 'Arya Dwi',
//        'status' => 'approved',
//        ];
//    return new \App\Mail\ApprovalMail($data);
//});





