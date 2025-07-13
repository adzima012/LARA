<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LARAController;

// Halaman utama
Route::get('/', function () {
    return view('welcome');
});

// Halaman dashboard - hanya untuk user login & terverifikasi
Route::get('/dashboard', [LARAController::class, 'getDashboard'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Grup rute yang hanya bisa diakses oleh user yang login
Route::middleware(['auth'])->group(function () {
    // LARA Resource Routes
    Route::resource('laras', LARAController::class);
    
    // Rute profil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rute bawaan untuk auth (login, register, dll)
require __DIR__.'/auth.php';
