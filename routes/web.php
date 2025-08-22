<?php

use App\Livewire\Counter;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get( '/', function () {
    return view( 'welcome' );
} );

Route::get( '/counter', Counter::class );

Auth::routes();

Route::get( '/home', [App\Http\Controllers\HomeController::class, 'index'] )->name( 'home' );
