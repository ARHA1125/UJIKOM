<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;

Route::get('/', [ProductController::class, 'index'])->name('dashboard');

Route::resource('products', ProductController::class)->except(['index']);

Route::resource('categories', CategoryController::class);

Route::view('/bantuan', 'bantuan');