<?php

use Hosam\ProductCrud\Http\Controllers\ProductController;
use Hosam\ProductCrud\Http\Controllers\CartController;
use Hosam\ProductCrud\Http\Controllers\OrderController;
use Hosam\ProductCrud\Http\Controllers\Front\ProductController as FrontProductController;
use Illuminate\Support\Facades\Route;
use Hosam\ProductCrud\Http\Controllers\CategoryController;


Route::resource('product', ProductController::class);
Route::resource('category', CategoryController::class);
Route::get('/all-products', [FrontProductController::class, 'index'])->name('products.index');
Route::get('product-stocks/{product}', [FrontProductController::class, 'productStocks'])->name('product.stocks');

// Cart routes
Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('/cart', [CartController::class, 'viewCart'])->name('cart.view');
Route::get('/cart/clear', [CartController::class, 'clearCart'])->name('cart.clear');

// Order routes
Route::post('/order/{order}', [OrderController::class, 'find'])->name('order.find');
Route::get('/order/create', [OrderController::class, 'create'])->name('order.create')->middleware('auth');
Route::get('/order/update/{order}', [OrderController::class, 'update'])->name('order.update');
