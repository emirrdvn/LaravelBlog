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
    // Makaleler
    Route::get('makaleler/silinenler', [App\Http\Controllers\Back\ArticleController::class, 'trashed'])->name('trashed.article');
    Route::resource('makaleler', App\Http\Controllers\Back\ArticleController::class);
    Route::get('/switch', [App\Http\Controllers\Back\ArticleController::class, 'switch'])->name('switch');
    Route::get('/deletearticle/{id}', [App\Http\Controllers\Back\ArticleController::class, 'delete'])->name('delete.article');
    Route::get('/harddeletearticle/{id}', [App\Http\Controllers\Back\ArticleController::class, 'hardDelete'])->name('hard.delete.article');
    Route::get('/recoverarticle/{id}', [App\Http\Controllers\Back\ArticleController::class, 'recover'])->name('recover.article');
    // Kategoriler
    Route::get('/kategoriler', [App\Http\Controllers\Back\CategoryController::class, 'index'])->name('category.index');
    Route::post('/kategoriler/create', [App\Http\Controllers\Back\CategoryController::class, 'create'])->name('category.create');
    Route::post('/kategoriler/update', [App\Http\Controllers\Back\CategoryController::class, 'update'])->name('category.update');
    Route::post('/kategoriler/delete', [App\Http\Controllers\Back\CategoryController::class, 'delete'])->name('category.delete');
    Route::get('/kategoriler/status', [App\Http\Controllers\Back\CategoryController::class, 'switch'])->name('category.switch');
    Route::get('/kategoriler/getData', [App\Http\Controllers\Back\CategoryController::class, 'getData'])->name('category.getdata');
    // Sayfalar
    Route::get('/sayfalar', [App\Http\Controllers\Back\PageController::class, 'index'])->name('page.index');
    Route::get('/sayfa/switch', [App\Http\Controllers\Back\PageController::class, 'switch'])->name('page.switch');
    Route::get('/sayfalar/create', [App\Http\Controllers\Back\PageController::class, 'create'])->name('page.create');
    Route::post('/sayfalar/create', [App\Http\Controllers\Back\PageController::class, 'post'])->name('page.create.post');
    Route::get('/sayfalar/update/{id}', [App\Http\Controllers\Back\PageController::class, 'update'])->name('page.edit');
    Route::post('/sayfalar/update/{id}', [App\Http\Controllers\Back\PageController::class, 'updatePost'])->name('page.edit.post');
    Route::get('/sayfalar/delete/{id}', [App\Http\Controllers\Back\PageController::class, 'delete'])->name('page.delete');

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















