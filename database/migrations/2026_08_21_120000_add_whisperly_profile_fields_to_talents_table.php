<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('talents', function (Blueprint $table) {
            $table->string('pengguna_id', 36)->nullable()->unique()->after('id_user');
            $table->string('photo')->nullable()->after('deskripsi');
        });
    }

    public function down(): void
    {
        Schema::table('talents', function (Blueprint $table) {
            $table->dropUnique(['pengguna_id']);
            $table->dropColumn(['pengguna_id', 'photo']);
        });
    }
};
