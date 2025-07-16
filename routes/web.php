<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BlogPageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file contains all web routes for your Laravel application.
|
*/

// ✅ Redirect home page `/` to `/blog`
Route::get('/', function () {
    return redirect('/blog');
});

// ✅ Blog Routes (all under `/blog`)
Route::prefix('blog')->group(function () {
    Route::get('/', [BlogPageController::class, 'index'])->name('blog_pages.index');
    Route::get('/create', [BlogPageController::class, 'create'])->name('blog_pages.create');
    Route::post('/store', [BlogPageController::class, 'store'])->name('blog_pages.store');
    Route::get('/{blog_page}/edit', [BlogPageController::class, 'edit'])->name('blog_pages.edit');
    Route::put('/{blog_page}/update', [BlogPageController::class, 'update'])->name('blog_pages.update');
    Route::delete('/{blog_page}', [BlogPageController::class, 'destroy'])->name('blog_pages.destroy');
});

// ✅ Dashboard (requires login)
//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth', 'verified'])->name('dashboard');

// ✅ Profile Routes (requires login)
//Route::middleware('auth')->group(function () {
//    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
//});

// ✅ Auth routes (login, register, etc.)
//require __DIR__.'/auth.php';
