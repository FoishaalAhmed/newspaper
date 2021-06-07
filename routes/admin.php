<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\UserController;

Route::group(['prefix' => '/admin', 'as' => 'admin.', 'middleware' => ['admin', 'auth']], function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/contacts', [ContactController::class, 'index'])->name('contacts');
    Route::put('contacts/update/{id}', [ContactController::class, 'update'])->name('contacts.update');

    Route::resource('users', UserController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('galleries', GalleryController::class);
    Route::resource('news', NewsController::class);

});