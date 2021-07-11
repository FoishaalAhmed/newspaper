<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\NewsController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);
Route::get('/news/{slug}/{id}', [NewsController::class, 'news'])->name('category.news');
Route::get('/news-detail/{id}/{slug}', [NewsController::class, 'detail'])->name('news.detail');
Route::get('/search', [NewsController::class, 'search'])->name('news.search');
Route::get('/teams', [NewsController::class, 'teams'])->name('teams');




require __DIR__ . '/auth.php';

Route::group(['middleware' => ['auth']], function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    /** profile route start **/
    Route::view('/profile', 'backend/profile');
    Route::post('/profile', [ProfileController::class, 'photo'])->name('profile');
    Route::post('/password', [ProfileController::class, 'password'])->name('password.change');
    Route::post('/profile-update', [ProfileController::class, 'update'])->name('profile.update');
    /** profile route end **/
});

Route::get('/{slug}', [HomeController::class, 'page'])->name('pages');
