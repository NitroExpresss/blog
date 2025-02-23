<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('posts')->group(function () {
    Route::get('/', [PostController::class, 'index']);
    Route::get('/{categorySlug}/{postSlug}', [PostController::class, 'detail'])->name('posts.detail');
    Route::get('/{categorySlug}', [PostController::class, 'category'])->name('posts.category');
});


