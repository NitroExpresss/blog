<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ContactsController;

Route::get('/', function () {return view('welcome');});

Route::get('/contacts', [ContactsController::class, 'show'])->name('contact.show');

Route::post('/contacts', [ContactsController::class, 'submit'])->name('contact.submit');

Route::prefix('posts')->group(function () {
    Route::get('/', [PostController::class, 'index'])->name('posts.index');
    Route::get('/{categorySlug}/{postSlug}', [PostController::class, 'detail'])->name('posts.detail');
    Route::get('/{categorySlug}', [PostController::class, 'category'])->name('posts.category');
});


