<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\IdeaController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LikeController;
use Illuminate\Support\Facades\Route;

Route::get('', [DashboardController::class, 'index'])->name('dashboard');

Route::group(['prefix' => 'ideas/', 'as' => 'ideas.'], function () {
    Route::get('/{idea}', [IdeaController::class, 'show'])->name('show');
    Route::post('', [IdeaController::class, 'store'])->name('store');

    Route::group(['middleware' => ['auth']], function () {
        Route::get('/{idea}/edit', [IdeaController::class, 'edit'])->name('edit');
        Route::put('/{idea}', [IdeaController::class, 'update'])->name('update');
        Route::delete('/{idea}', [IdeaController::class, 'destroy'])->name('destroy');
        Route::post('/{idea}/comments', [CommentController::class, 'store'])->name('comments.store');
    });
});

Route::group(['prefix' => 'ideas/', 'as' => 'ideas.'], function () {
    Route::get('/{idea}', [IdeaController::class, 'show'])->name('show');
    Route::post('', [IdeaController::class, 'store'])->middleware('auth')->name('store');

    Route::group(['middleware' => ['auth']], function () {
        Route::get('/{idea}/edit', [IdeaController::class, 'edit'])->name('edit');
        Route::put('/{idea}', [IdeaController::class, 'update'])->name('update');
        Route::delete('/{idea}', [IdeaController::class, 'destroy'])->name('destroy');
        Route::post('/{idea}/comments', [CommentController::class, 'store'])->name('comments.store');

        Route::post('/{idea}/like', [LikeController::class, 'store'])->name('like');
        Route::delete('/{idea}/like', [LikeController::class, 'destroy'])->name('unlike');
    });
});

Route::get('/profile/{user}', [ProfileController::class, 'show'])->name('profile.show');

Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'store']);

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
