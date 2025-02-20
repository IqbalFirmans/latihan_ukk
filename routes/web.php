<?php

use App\Http\Controllers\AlbumController;
use App\Http\Controllers\BlogPostController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('', [BlogPostController::class, 'blogPost'])->name('blog.post');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix('post')->group(function () {
        Route::get('user/{user}', [PostController::class, 'index'])->name('post.index');
        Route::get('create', [PostController::class, 'create'])->name('post.create');
        Route::get('{post}', [PostController::class, 'show'])->name('post.show');
        Route::post('', [PostController::class, 'store'])->name('post.store');
        Route::put('{post}', [PostController::class, 'update'])->name('post.update');
        Route::delete('{post}', [PostController::class, 'destroy'])->name('post.destroy');
    });

    Route::prefix('albums')->group(function () {
        Route::get('{album}', [AlbumController::class, 'show'])->name('albums.show');
        Route::post('', [AlbumController::class, 'store'])->name('albums.store');
        Route::put('{album}', [AlbumController::class, 'update'])->name('albums.update');
        Route::delete('{album}', [AlbumController::class, 'destroy'])->name('albums.destroy');
    });

    Route::post('save', [AlbumController::class, 'save'])->name('save');
});

require __DIR__.'/auth.php';


