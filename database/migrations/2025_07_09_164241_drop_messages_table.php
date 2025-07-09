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
        Schema::dropIfExists('messages');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('recipient_name');
            $table->string('recipient_email');
            $table->date('delivery_schedule');
            $table->text('message');
            $table->boolean('repeat_yearly')->default(false);
            $table->timestamps();
        });
    }
};
