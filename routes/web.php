<?php

use App\Livewire\Category\CategoryManager;
use App\Livewire\Counter;
use App\Livewire\Product\ProductManager;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get( '/', function () {
    return view( 'welcome' );
} );

Route::get( '/counter', Counter::class );

Auth::routes();

Route::middleware( 'auth' )->group( function () {
    Route::get( '/home', [App\Http\Controllers\HomeController::class, 'index'] )->name( 'home' );
    Route::get( '/category', CategoryManager::class )->name( 'category.index' );
    Route::get( '/product', ProductManager::class )->name( 'product.index' );
} );
