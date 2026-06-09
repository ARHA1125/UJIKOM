<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;

Route::get(
    '/',
    [DashboardController::class, 'index']
);

Route::resource(
    'products',
    ProductController::class
);

Route::resource(
    'categories',
    CategoryController::class
);

Route::view(
    '/bantuan',
    'bantuan'
);