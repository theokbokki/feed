<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CreatePostController;

Route::get('/', HomeController::class)->name('home');

Route::post('/posts', CreatePostController::class)->name('posts.create');
