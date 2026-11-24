<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InteractionController;
use App\Http\Controllers\NewsController;
use Illuminate\Support\Facades\Route;

// Halaman Utama
Route::get('/', [HomeController::class, 'index'])->name('home');

// Pencarian
Route::get('/search', [HomeController::class, 'search'])->name('search');

// Kategori & Filter
Route::get('/kategori/{slug?}', [CategoryController::class, 'index'])->name('category');

// Detail Berita (Route Model Binding by slug)
Route::get('/berita/{news:slug}', [NewsController::class, 'show'])->name('news.show');

// Interaksi (POST)
Route::post('/komentar', [InteractionController::class, 'storeComment'])->name('comment.store');
Route::post('/polling/vote', [InteractionController::class, 'votePoll'])->name('poll.vote');
Route::post('/newsletter', [InteractionController::class, 'subscribeNewsletter'])->name('newsletter.subscribe');