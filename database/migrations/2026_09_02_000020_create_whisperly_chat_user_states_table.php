<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('whisperly_chat_user_states', function (Blueprint $table) {
            $table->string('id', 36)->primary();
            $table->string('user_id', 36);
            $table->string('contact_user_id', 36);
            $table->timestamp('deleted_at')->nullable();
            $table->timestamp('cleared_at')->nullable();
            $table->timestamps();

            $table->unique(['user_id', 'contact_user_id']);
            $table->foreign('user_id')->references('id')->on('pengguna')->cascadeOnDelete();
            $table->foreign('contact_user_id')->references('id')->on('pengguna')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('whisperly_chat_user_states');
    }
};
