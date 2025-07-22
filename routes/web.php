<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LARAController;

/**
 * File: web.php
 * Deskripsi: File ini berisi semua rute web untuk aplikasi LARA (Life Archive Records Access)
 */

// Rute untuk halaman utama/landing page
// Dapat diakses oleh semua pengunjung tanpa perlu login
Route::get('/', function () {
    return view('pages.welcome');
});

// Rute untuk halaman dashboard
// Hanya dapat diakses oleh pengguna yang sudah login dan email terverifikasi
// Menampilkan ringkasan surat digital pengguna
Route::get('/dashboard', [LARAController::class, 'getDashboard'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Grup rute yang memerlukan autentikasi
// Semua rute di dalam grup ini hanya bisa diakses setelah login
Route::middleware(['auth'])->group(function () {
    // Rute untuk manajemen surat digital (LARA)
    // Mencakup: index, create, store, show, edit, update, delete
    // Menggunakan resource controller untuk CRUD operations
    Route::resource('laras', LARAController::class);
    
    // Rute untuk manajemen profil pengguna
    // edit: Menampilkan form edit profil
    // update: Menyimpan perubahan profil
    // destroy: Menghapus akun pengguna
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Mengimpor rute autentikasi bawaan Laravel
// Mencakup login, register, reset password, dan verifikasi email
require __DIR__.'/auth.php';
