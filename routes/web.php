<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', [StoryController::class, 'publicStories'])->name('home');
Route::get('/register', [RegisteredUserController::class, 'create'])
    ->name('register');

Route::get('/dashboard', [HomeController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::delete('/profile/avatar', [ProfileController::class, 'deleteAvatar'])->name('profile.delete-avatar');
    Route::get('/stories/create', [StoryController::class, 'create'])->name('stories.create');
    Route::post('/stories', [StoryController::class, 'store'])->name('stories.store');
    Route::get('/stories/{slug}', [StoryController::class, 'show'])->name('stories.show');
    Route::get('/my-stories', [StoryController::class, 'myStories'])->name('stories.my-stories');
    Route::get('/stories/{slug}/edit', [StoryController::class, 'edit'])->name('stories.edit');
    Route::patch('/stories/{slug}', [StoryController::class, 'update'])->name('stories.update');
    Route::delete('/stories/{slug}', [StoryController::class, 'destroy'])->name('stories.destroy');
    Route::get('/stories', [StoryController::class, 'index'])->name('stories.index');

});

require __DIR__.'/auth.php';
