<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('talent_schedules', function (Blueprint $table) {
            $table->string('id', 36)->primary();
            $table->string('talent_id', 36);
            $table->time('start_time');
            $table->time('end_time');
            $table->string('status', 20)->default('unavailable');
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['talent_id', 'start_time', 'end_time']);
            $table->foreign('talent_id')->references('id')->on('talents')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('talent_schedules');
    }
};
