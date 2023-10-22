<?php

use Illuminate\Support\Facades\Route;
use Modules\Product\app\Http\Controllers\ProductController;

/*
    |--------------------------------------------------------------------------
    | Web Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can register web routes for your application. These
    | routes are loaded by the RouteServiceProvider within a group which
    | contains the "web" middleware group. Now create something great!
    |
*/

Route::middleware(['auth', 'verified'])->group(function () {
    // Route::resource('product', ProductController::class)->except(['index'])->names('product');
    // Route::get('products', [ProductController::class, 'index'])->name('product.index');
    // Route::get('product/{product}/restore', [ProductController::class, 'restore'])->name('product.restore');
    // Route::delete('product/{product}/permanent', [ProductController::class, 'permanent'])->name('product.destroy.permanent');
    // Route::get('product', fn () => redirect()->route('product.index'))->name('product.index.redirect');
});
