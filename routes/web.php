<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MessageController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/messages', function () {return view('messages');
})->name('messages');
Route::post('/messages', [MessageController::class, 'store'])->name('messages.store');
Route::middleware(['auth'])->group(function () {
    Route::middleware(['auth'])->group(function () {
        Route::get('/dashboard', [MessageController::class, 'index'])->name('dashboard');
        Route::resource('messages', MessageController::class)->except('index');
    });
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::resource('messages', MessageController::class)->except('index');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';