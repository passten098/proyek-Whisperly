<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Ubah foreign key rating dari BIGINT menjadi UUID/string.
     *
     * Booking dan pengguna Whisperly/Laralag menggunakan UUID,
     * sehingga kolom id_booking dan id_pengguna pada ratings
     * harus dapat menyimpan string UUID.
     */
    public function up(): void
    {
        Schema::table('ratings', function (Blueprint $table) {
            $table->string('id_booking', 36)->change();
            $table->string('id_pengguna', 36)->change();
        });
    }

    /**
     * Kembalikan ke tipe BIGINT seperti struktur lama.
     */
    public function down(): void
    {
        Schema::table('ratings', function (Blueprint $table) {
            $table->unsignedBigInteger('id_booking')->change();
            $table->unsignedBigInteger('id_pengguna')->change();
        });
    }
};
