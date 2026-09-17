<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Pastikan kode booking tersedia.
        if (!Schema::hasColumn('bookings', 'kode_booking')) {
            throw new RuntimeException(
                'Kolom bookings.kode_booking belum tersedia.'
            );
        }

        // Pastikan semua booking sudah memiliki kode booking.
        $emptyBookings = DB::table('bookings')
            ->whereNull('kode_booking')
            ->count();

        if ($emptyBookings > 0) {
            throw new RuntimeException(
                'Masih ada ' . $emptyBookings .
                ' booking yang belum memiliki kode_booking.'
            );
        }

        // Hapus foreign key lama jika ada.
        try {
            Schema::table('ratings', function (Blueprint $table) {
                $table->dropForeign('ratings_id_booking_foreign');
            });
        } catch (\Throwable $e) {
            // Tidak ada foreign key lama.
        }

        // Ubah id_booking agar bisa menyimpan kode seperti BK-000001.
        Schema::table('ratings', function (Blueprint $table) {
            $table->string('id_booking', 36)->change();
        });

        /*
         * Data legacy menggunakan angka:
         *
         * 1 -> BK-000001
         * 2 -> BK-000002
         * dst.
         */
        DB::statement("
            UPDATE ratings
            SET id_booking = CONCAT(
                'BK-',
                LPAD(CAST(id_booking AS UNSIGNED), 6, '0')
            )
            WHERE id_booking REGEXP '^[0-9]+$'
        ");

        // Pastikan semua rating memiliki booking yang valid.
        $orphanRatings = DB::table('ratings')
            ->leftJoin(
                'bookings',
                'bookings.kode_booking',
                '=',
                'ratings.id_booking'
            )
            ->whereNotNull('ratings.id_booking')
            ->whereNull('bookings.id')
            ->whereNull('ratings.deleted_at')
            ->select(
                'ratings.id',
                'ratings.id_booking'
            )
            ->get();

        if ($orphanRatings->isNotEmpty()) {
            $data = $orphanRatings
                ->map(function ($rating) {
                    return 'rating_id=' . $rating->id .
                        ', id_booking=' . $rating->id_booking;
                })
                ->implode('; ');

            throw new RuntimeException(
                'Masih ada rating yang tidak memiliki booking: ' . $data
            );
        }

        // Buat foreign key baru ke bookings.kode_booking.
        Schema::table('ratings', function (Blueprint $table) {
            $table->foreign(
                'id_booking',
                'ratings_id_booking_foreign'
            )
                ->references('kode_booking')
                ->on('bookings')
                ->cascadeOnUpdate()
                ->restrictOnDelete();
        });
    }

    public function down(): void
    {
        try {
            Schema::table('ratings', function (Blueprint $table) {
                $table->dropForeign('ratings_id_booking_foreign');
            });
        } catch (\Throwable $e) {
            // Foreign key tidak ada.
        }

        // Kembalikan BK-000001 menjadi 1, BK-000002 menjadi 2, dst.
        Schema::table('ratings', function (Blueprint $table) {
            $table->unsignedBigInteger('id_booking')->change();
        });

        DB::statement("
            UPDATE ratings
            SET id_booking = CAST(
                SUBSTRING(id_booking, 4) AS UNSIGNED
            )
            WHERE id_booking LIKE 'BK-%'
        ");
    }
};