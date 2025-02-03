<?php

use App\Livewire\Category\CategoryManager;
use App\Livewire\Category\SubcategoryManager;
use App\Livewire\Counter;
use App\Livewire\Post\PostManager;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get( '/', function () {
    return view( 'welcome' );
} );

Route::get( '/counter', Counter::class );

Auth::routes();

Route::middleware( 'auth' )->group( function () {

    Route::get( 'clear', function () {
        Artisan::call( 'optimize:clear' );
        session()->flash( 'message', 'Cache Clear ' );
        return redirect()->back();
    } )->name( 'clear' );
    Route::get( '/home', [App\Http\Controllers\HomeController::class, 'index'] )->name( 'home' );
    Route::get( '/category', CategoryManager::class )->name( 'category.index' );
    Route::get( '/subcategory', SubcategoryManager::class )->name( 'subcategory.index' );
    Route::get( '/post', PostManager::class )->name( 'post.index' );
} );