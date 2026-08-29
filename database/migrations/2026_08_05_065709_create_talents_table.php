<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('talents', function (Blueprint $table) {
            $table->string('id', 36)->primary();

            // Relasi ke tabel pengguna
            $table->string('pengguna_id', 36);

            $table->text('deskripsi')->nullable();
            $table->string('photo')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->string('created_by', 36)->nullable();
            $table->string('updated_by', 36)->nullable();
            $table->string('deleted_by', 36)->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('talents');
    }
};