<?php

use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('shaqshouse.index');
});

Auth::routes();
Route::get('/', [App\Http\Controllers\MobileController::class, 'index'])->name('index.mobile');
Route::get('/home', [App\Http\Controllers\MobileController::class, 'index'])->name('home-index');
Route::post('/search-post', [App\Http\Controllers\MobileController::class, 'search_post'])->name('search_post');

