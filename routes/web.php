<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MessageController;

// Halaman utama
Route::get('/', function () {
    return view('welcome');
});

// Halaman form pesan (tanpa harus login)
Route::get('/messages', function () {
    return view('messages.messages'); // ✅ Sesuai struktur folder
})->name('messages');

// Menyimpan pesan dari form (tanpa harus login)
Route::post('/messages', [MessageController::class, 'store'])->name('messages.store');

// Halaman dashboard - hanya untuk user login & terverifikasi
Route::get('/dashboard', [MessageController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Grup rute yang hanya bisa diakses oleh user yang login
Route::middleware(['auth'])->group(function () {

    // Resource messages (kecuali index karena sudah dipakai di dashboard)
    Route::resource('messages', MessageController::class)->except('index');

    // Rute profil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rute bawaan untuk auth (login, register, dll)
require __DIR__.'/auth.php';
