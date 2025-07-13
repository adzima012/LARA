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
        Schema::table('laras', function (Blueprint $table) {
            // Drop the foreign key constraint first
            $table->dropForeign(['penerima_id']);
            
            // Drop the penerima_id column
            $table->dropColumn('penerima_id');
            
            // Add the recipient_email column
            $table->string('recipient_email')->after('pemilik_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('laras', function (Blueprint $table) {
            // Drop the recipient_email column
            $table->dropColumn('recipient_email');
            
            // Add back the penerima_id column
            $table->foreignId('penerima_id')->after('pemilik_id')->constrained('users')->cascadeOnDelete();
        });
    }
};
