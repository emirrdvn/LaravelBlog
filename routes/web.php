<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/* Admin Routes */
Route::prefix('admin')->name('admin.')->middleware('isLogin')->group(function(){
Route::get('giris', [App\Http\Controllers\Back\AuthController::class, 'login'])->name('login');
Route::post('giris', [App\Http\Controllers\Back\AuthController::class, 'loginpost'])->name('login.post');
});
Route::prefix('admin')->name('admin.')->middleware('isAdmin')->group(function(){
    Route::get('panel', [App\Http\Controllers\Back\Dashboard::class, 'index'])->name('dashboard');
    Route::resource('makaleler', App\Http\Controllers\Back\ArticleController::class);
    Route::get('/switch', [App\Http\Controllers\Back\ArticleController::class, 'switch'])->name('switch');
    Route::get('cikis', [App\Http\Controllers\Back\AuthController::class, 'logout'])->name('logout');
});



/* Front Routes */

Route::get('/', [App\Http\Controllers\Front\Homepage::class, 'index'])->name('homepage'); 
Route::get('sayfa', [App\Http\Controllers\Front\Homepage::class, 'index']);
Route::get('/kategori/{slug}', [App\Http\Controllers\Front\Homepage::class, 'category'])->name('category');
Route::get('iletisim', [App\Http\Controllers\Front\Homepage::class, 'contact'])->name('contact');
Route::post('iletisim', [App\Http\Controllers\Front\Homepage::class, 'contactpost'])->name('contact.post');
Route::get('/{category}/{slug}', [App\Http\Controllers\Front\Homepage::class, 'single'])->name('single');
Route::get('/{sayfa}', [App\Http\Controllers\Front\Homepage::class, 'page'])->name('page');















