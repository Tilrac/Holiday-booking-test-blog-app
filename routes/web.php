<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [PostController::class, 'index'])->name('home');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // User routes  
    Route::middleware(['auth'])->group(function () {
        Route::resource('user/posts', PostController::class)->names([
            'index' => 'user.posts.index',
            'create' => 'user.posts.create',
            'store' => 'user.posts.store',
            'show' => 'user.posts.show',
            'edit' => 'user.posts.edit',
            'update' => 'user.posts.update',
            'destroy' => 'user.posts.destroy',
        ]);
        Route::get('/user/posts-per-user', [PostController::class, 'showPostsByUser'])->name('user.posts.per.user');
    });

    // Admin routes
    Route::middleware(['admin'])->prefix('admin')->group(function () {
        Route::get('/posts', [PostController::class, 'adminIndex'])->name('admin.posts.index');
        Route::post('/posts/{post}/update-status', [PostController::class, 'updateStatus'])->name('admin.posts.update-status');
        Route::get('/posts/show/{post}', [PostController::class, 'show'])->name('admin.posts.show');
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
