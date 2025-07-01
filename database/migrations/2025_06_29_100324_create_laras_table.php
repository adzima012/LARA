<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('laras', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('content')->nullable();
            $table->string('file_path')->nullable();
            $table->foreignId('pemilik_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('penerima_id')->constrained('users')->cascadeOnDelete();
            $table->boolean('is_released')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laras');
    }
};
