<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', [App\Http\Controllers\Front\Homepage::class, 'index'])->name('homepage'); 
Route::get('sayfa', [App\Http\Controllers\Front\Homepage::class, 'index']);
Route::get('/kategori/{slug}', [App\Http\Controllers\Front\Homepage::class, 'category'])->name('category');
Route::get('/{category}/{slug}', [App\Http\Controllers\Front\Homepage::class, 'single'])->name('single');
















