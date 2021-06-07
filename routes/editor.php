<?php

use App\Http\Controllers\Editor\DashboardController;
use App\Http\Controllers\Editor\GalleryController;
use App\Http\Controllers\Editor\NewsController;

Route::group(['prefix' => '/editor', 'as' => 'editor.', 'middleware' => ['editor', 'auth']], function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('galleries', GalleryController::class);
    Route::resource('news', NewsController::class);

});