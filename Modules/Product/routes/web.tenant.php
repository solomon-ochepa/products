<?php

use Illuminate\Support\Facades\Route;
use Modules\Product\app\Livewire\Index;
use Modules\Product\app\Livewire\Show;

/*
    |--------------------------------------------------------------------------
    | Tenant Routes
    |--------------------------------------------------------------------------
    |
    | Here you can register the tenant routes for your application.
    | These routes are loaded by the TenantRouteServiceProvider.
    |
    | Feel free to customize them however you want. Good luck!
    |
*/

Route::group([], function () {
    Route::get('products/{product?}', Index::class)->name('product.index');
    Route::get('product/{product}', Show::class)->name('product.show');
    Route::get('product', fn () => redirect(route('product.index')));
});
