<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasColumn('ratings', 'booking_id')) {
            DB::statement('ALTER TABLE ratings ADD COLUMN booking_id VARCHAR(36) NULL');
        }

        if (! Schema::hasColumn('ratings', 'pengguna_id')) {
            DB::statement('ALTER TABLE ratings ADD COLUMN pengguna_id VARCHAR(36) NULL');
        }

        if (! Schema::hasColumn('ratings', 'talent_id')) {
            DB::statement('ALTER TABLE ratings ADD COLUMN talent_id VARCHAR(36) NULL');
        }

        if (! Schema::hasColumn('bookings', 'source_booking_id')) {
            DB::statement('ALTER TABLE bookings ADD COLUMN source_booking_id VARCHAR(36) NULL');
        }

        if (! Schema::hasColumn('bookings', 'pengguna_username')) {
            DB::statement('ALTER TABLE bookings ADD COLUMN pengguna_username VARCHAR(255) NULL');
        }

        if (! Schema::hasColumn('bookings', 'talent_username')) {
            DB::statement('ALTER TABLE bookings ADD COLUMN talent_username VARCHAR(255) NULL');
        }

        try {
            DB::statement('CREATE UNIQUE INDEX bookings_source_booking_id_unique ON bookings (source_booking_id)');
        } catch (\Throwable $exception) {
            // The index may already exist or the database engine may reject duplicate definitions.
        }
    }

    public function down(): void
    {
        Schema::table('ratings', function (Blueprint $table) {
            if (Schema::hasColumn('ratings', 'booking_id')) {
                $table->dropColumn('booking_id');
            }

            if (Schema::hasColumn('ratings', 'pengguna_id')) {
                $table->dropColumn('pengguna_id');
            }

            if (Schema::hasColumn('ratings', 'talent_id')) {
                $table->dropColumn('talent_id');
            }
        });

        Schema::table('bookings', function (Blueprint $table) {
            if (Schema::hasColumn('bookings', 'source_booking_id')) {
                $table->dropColumn('source_booking_id');
            }

            if (Schema::hasColumn('bookings', 'pengguna_username')) {
                $table->dropColumn('pengguna_username');
            }

            if (Schema::hasColumn('bookings', 'talent_username')) {
                $table->dropColumn('talent_username');
            }
        });
    }
};
