<?php

use Hosam\ProductCrud\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;


Route::resource('product', ProductController::class);
