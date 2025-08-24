<?php

use App\Livewire\Category\CategoryManager;
use App\Livewire\Counter;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Livewire\Product\ProductManager;

Route::get( '/', function () {
    return view( 'welcome' );
} );

Route::get( '/counter', Counter::class );
Route::get('/category', CategoryManager::class)->name('category.index');
Route::get('/product', ProductManager::class)->name('product.index');

Auth::routes();

Route::get( '/home', [App\Http\Controllers\HomeController::class, 'index'] )->name( 'home' );
