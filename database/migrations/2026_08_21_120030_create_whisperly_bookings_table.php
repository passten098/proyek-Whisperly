<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('whisperly_bookings', function (Blueprint $table) {
            $table->string('id', 36)->primary();
            $table->string('pengguna_id', 36);
            $table->string('talent_id', 36);
            $table->string('schedule_id', 36);
            $table->string('status', 20)->default('confirmed');
            $table->timestamps();
            $table->softDeletes();

            // Tidak ada unique schedule_id + status

            $table->foreign('pengguna_id')->references('id')->on('pengguna')->cascadeOnDelete();
            $table->foreign('talent_id')->references('id')->on('talents')->cascadeOnDelete();
            $table->foreign('schedule_id')->references('id')->on('talent_schedules')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('whisperly_bookings');
    }
};