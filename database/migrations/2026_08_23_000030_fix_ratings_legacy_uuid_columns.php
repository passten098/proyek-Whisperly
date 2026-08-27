<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (DB::getDriverName() === 'sqlite') {
            $hasBookingId = Schema::hasColumn('ratings', 'booking_id');
            $hasPenggunaId = Schema::hasColumn('ratings', 'pengguna_id');
            $hasTalentId = Schema::hasColumn('ratings', 'talent_id');

            Schema::create('ratings_rebuild', function (Blueprint $table) use ($hasBookingId, $hasPenggunaId, $hasTalentId) {
                $table->string('id', 36)->primary();
                if ($hasBookingId) {
                    $table->string('booking_id', 36)->nullable();
                } else {
                    $table->string('booking_id', 36)->nullable();
                }
                if ($hasPenggunaId) {
                    $table->string('pengguna_id', 36)->nullable();
                } else {
                    $table->string('pengguna_id', 36)->nullable();
                }
                $table->unsignedBigInteger('id_booking')->nullable();
                $table->unsignedBigInteger('id_pengguna')->nullable();
                if ($hasTalentId) {
                    $table->string('talent_id', 36)->nullable();
                } else {
                    $table->string('talent_id', 36)->nullable();
                }
                $table->integer('nilai_rating');
                $table->text('ulasan');
                $table->timestamps();
                $table->softDeletes();
                $table->string('created_by', 36)->nullable();
                $table->string('updated_by', 36)->nullable();
                $table->string('deleted_by', 36)->nullable();
            });

            DB::statement('INSERT INTO ratings_rebuild (id, booking_id, pengguna_id, id_booking, id_pengguna, talent_id, nilai_rating, ulasan, created_at, updated_at, deleted_at, created_by, updated_by, deleted_by) SELECT id, booking_id, pengguna_id, id_booking, id_pengguna, talent_id, nilai_rating, ulasan, created_at, updated_at, deleted_at, created_by, updated_by, deleted_by FROM ratings');

            Schema::dropIfExists('ratings');
            Schema::rename('ratings_rebuild', 'ratings');

            return;
        }

        DB::statement('ALTER TABLE ratings MODIFY id_booking BIGINT UNSIGNED NULL');
        DB::statement('ALTER TABLE ratings MODIFY id_pengguna BIGINT UNSIGNED NULL');
    }

    public function down(): void
    {
        if (DB::getDriverName() === 'sqlite') {
            $columns = DB::select('PRAGMA table_info("ratings")');
            $columnNames = array_map(fn ($column) => $column->name, $columns);

            if (! in_array('booking_id', $columnNames, true)) {
                DB::statement('ALTER TABLE ratings ADD COLUMN booking_id VARCHAR(36) NULL');
            }

            if (! in_array('pengguna_id', $columnNames, true)) {
                DB::statement('ALTER TABLE ratings ADD COLUMN pengguna_id VARCHAR(36) NULL');
            }

            if (! in_array('talent_id', $columnNames, true)) {
                DB::statement('ALTER TABLE ratings ADD COLUMN talent_id VARCHAR(36) NULL');
            }

            return;
        }

        DB::statement('ALTER TABLE ratings MODIFY id_booking BIGINT UNSIGNED NOT NULL');
        DB::statement('ALTER TABLE ratings MODIFY id_pengguna BIGINT UNSIGNED NOT NULL');
    }
};
