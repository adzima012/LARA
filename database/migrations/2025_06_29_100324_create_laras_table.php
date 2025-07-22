<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration untuk membuat tabel laras
 * 
 * Tabel ini menyimpan data surat digital dalam sistem LARA
 */
return new class extends Migration
{
    /**
     * Membuat tabel laras
     * 
     * Struktur tabel:
     * - id: Primary key
     * - title: Judul surat
     * - content: Isi surat
     * - file_path: Path ke file lampiran
     * - pemilik_id: ID pengguna pemilik surat (foreign key ke users)
     * - penerima_id: ID pengguna penerima surat (foreign key ke users)
     * - is_released: Status rilis surat
     * - timestamps: Waktu pembuatan dan update
     */
    public function up(): void
    {
        Schema::create('laras', function (Blueprint $table) {
            $table->id();                    // Auto-increment primary key
            $table->string('title');         // Judul surat (wajib)
            $table->text('content')->nullable(); // Isi surat (opsional)
            $table->string('file_path')->nullable(); // Path file lampiran (opsional)
            // Relasi ke tabel users (pemilik), akan menghapus surat jika user dihapus
            $table->foreignId('pemilik_id')->constrained('users')->cascadeOnDelete();
            // Relasi ke tabel users (penerima), akan menghapus surat jika user dihapus
            $table->foreignId('penerima_id')->constrained('users')->cascadeOnDelete();
            $table->boolean('is_released')->default(false); // Status rilis (default: false)
            $table->timestamps(); // created_at dan updated_at
        });
    }

    /**
     * Menghapus tabel laras
     * 
     * Method ini akan dijalankan ketika melakukan rollback migration
     */
    public function down(): void
    {
        Schema::dropIfExists('laras');
    }
};
