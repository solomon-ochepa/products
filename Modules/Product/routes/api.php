<?php

use Illuminate\Support\Facades\Route;
use Modules\Product\app\Http\Controllers\Api\ProductController;

/*
    |--------------------------------------------------------------------------
    | API Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can register API routes for your application. These
    | routes are loaded by the RouteServiceProvider within a group which
    | is assigned the "api" middleware group. Enjoy building your API!
    |
*/

Route::/*middleware(['auth:api'])->*/ prefix('v1')->group(function () {
    Route::apiResource('product', ProductController::class)->except(['index'])->names('product');
    Route::get('products', [ProductController::class, 'index'])->name('product.index');
    Route::patch('product/{product}/restore', [ProductController::class, 'restore'])->name('product.restore');
    Route::delete('product/{product}/permanent',
        [ProductController::class, 'permanent']
    )->name('product.destroy.permanent');
    Route::get('product', fn () => redirect()->route('product.index'))->name('product.index.redirect');
});
