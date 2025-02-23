<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

Route::get('/', [PostController::class, 'index']);

Route::get('/posts/{categorySlug}', [PostController::class, 'category'])->name('posts.category');
Route::get('/posts/{categorySlug}/{postSlug}', [PostController::class, 'detail'])->name('posts.detail');



