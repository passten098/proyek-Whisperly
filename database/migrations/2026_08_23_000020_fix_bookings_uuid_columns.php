<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->string('id_pengguna', 36)->nullable(false)->change();
            $table->string('id_talent', 36)->nullable(false)->change();
            $table->decimal('durasi_jam', 5, 2)->default(0)->change();
        });
    }

    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->unsignedBigInteger('id_pengguna')->nullable(false)->change();
            $table->unsignedBigInteger('id_talent')->nullable(false)->change();
            $table->integer('durasi_jam')->default(0)->change();
        });
    }
};
