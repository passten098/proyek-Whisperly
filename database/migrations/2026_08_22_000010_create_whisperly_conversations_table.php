<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('whisperly_conversations', function (Blueprint $table) {
            $table->string('id', 36)->primary();
            $table->string('booking_id', 36);
            $table->string('user_id', 36);
            $table->string('talent_id', 36);
            $table->time('start_time');
            $table->time('end_time');
            $table->string('status', 20)->default('upcoming');
            $table->timestamps();
            $table->softDeletes();

            $table->unique('booking_id');
            $table->foreign('booking_id')->references('id')->on('whisperly_bookings')->cascadeOnDelete();
            $table->foreign('user_id')->references('id')->on('pengguna')->cascadeOnDelete();
            $table->foreign('talent_id')->references('id')->on('talents')->cascadeOnDelete();
        });

        Schema::create('whisperly_messages', function (Blueprint $table) {
            $table->string('id', 36)->primary();
            $table->string('conversation_id', 36);
            $table->string('sender_id', 36);
            $table->text('message');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('conversation_id')->references('id')->on('whisperly_conversations')->cascadeOnDelete();
            $table->foreign('sender_id')->references('id')->on('pengguna')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('whisperly_messages');
        Schema::dropIfExists('whisperly_conversations');
    }
};
