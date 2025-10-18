<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CreatePostController;
use App\Http\Controllers\ShowLoginController;
use App\Http\Controllers\StoreLoginController;
use App\Http\Controllers\ShowLogoutController;
use App\Http\Controllers\StoreLogoutController;
use App\Http\Controllers\ImageUploadController;

Route::get('/', HomeController::class)->name('home');

Route::get('/login', ShowLoginController::class)->name('login.show');
Route::post('/login', StoreLoginController::class)->name('login.store');

Route::get('/logout', ShowLogoutController::class)->name('logout.show');
Route::post('/logout', StoreLogoutController::class)->name('logout.store');

Route::post('/posts', CreatePostController::class)->name('posts.create');
Route::post('/upload-image', ImageUploadController::class)->name('image.upload');
