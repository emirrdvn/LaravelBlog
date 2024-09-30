<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/* Admin Routes */

Route::get('admin/panel', [App\Http\Controllers\Back\Dashboard::class, 'index'])->name('admin.dashboard');
Route::get('admin/giris', [App\Http\Controllers\Back\Auth::class, 'login'])->name('admin.login');


/* Front Routes */

Route::get('/', [App\Http\Controllers\Front\Homepage::class, 'index'])->name('homepage'); 
Route::get('sayfa', [App\Http\Controllers\Front\Homepage::class, 'index']);
Route::get('/kategori/{slug}', [App\Http\Controllers\Front\Homepage::class, 'category'])->name('category');
Route::get('iletisim', [App\Http\Controllers\Front\Homepage::class, 'contact'])->name('contact');
Route::post('iletisim', [App\Http\Controllers\Front\Homepage::class, 'contactpost'])->name('contact.post');
Route::get('/{category}/{slug}', [App\Http\Controllers\Front\Homepage::class, 'single'])->name('single');
Route::get('/{sayfa}', [App\Http\Controllers\Front\Homepage::class, 'page'])->name('page');















