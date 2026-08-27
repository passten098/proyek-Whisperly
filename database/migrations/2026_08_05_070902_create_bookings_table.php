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
        Schema::create('bookings', function (Blueprint $table) {
            $table->string('id', 36)->primary();
            $table->string('id_pengguna', 36);
            $table->string('id_talent', 36);
            $table->date('tanggal_booking');
            $table->decimal('durasi_jam', 5, 2)->default(0);
            $table->string('status');
            $table->timestamps();
            $table->softDeletes();
            $table->string('created_by', 36)->nullable();
            $table->string('updated_by', 36)->nullable();
            $table->string('deleted_by', 36)->nullable();
            $table->string('source_booking_id', 36)->nullable()->unique();
            $table->string('pengguna_username', 255)->nullable();
            $table->string('talent_username', 255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
