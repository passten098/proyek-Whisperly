<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        /*
        |--------------------------------------------------------------------------
        | 1. Pastikan bookings.kode_booking tersedia
        |--------------------------------------------------------------------------
        */

        if (!Schema::hasColumn('bookings', 'kode_booking')) {
            throw new RuntimeException(
                'Kolom bookings.kode_booking belum tersedia.'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | 2. Pastikan semua kode booking sudah terisi
        |--------------------------------------------------------------------------
        */

        $emptyBookings = DB::table('bookings')
            ->whereNull('kode_booking')
            ->count();

        if ($emptyBookings > 0) {
            throw new RuntimeException(
                'Masih ada ' . $emptyBookings .
                ' booking yang belum memiliki kode_booking.'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | 3. Hapus foreign key/index lama pada id_booking
        |--------------------------------------------------------------------------
        */

        try {
            Schema::table('ratings', function (Blueprint $table) {
                $table->dropForeign('ratings_id_booking_foreign');
            });
        } catch (\Throwable $e) {
            // Foreign key tidak ada, lanjut.
        }

        /*
        |--------------------------------------------------------------------------
        | 4. Hapus index lama jika masih ada
        |--------------------------------------------------------------------------
        */

        try {
            Schema::table('ratings', function (Blueprint $table) {
                $table->dropIndex('ratings_id_booking_foreign');
            });
        } catch (\Throwable $e) {
            // Index tidak ada, lanjut.
        }

        /*
        |--------------------------------------------------------------------------
        | 5. Pastikan id_booking VARCHAR(36)
        |--------------------------------------------------------------------------
        |
        | Kolom saat ini sudah VARCHAR(36), jadi tidak perlu
        | melakukan ->change() lagi.
        |
        */

        /*
        |--------------------------------------------------------------------------
        | 6. Konversi data lama
        |--------------------------------------------------------------------------
        |
        | Jika ratings.id_booking masih berisi bookings.id,
        | ubah menjadi bookings.kode_booking.
        |
        */

        DB::statement('
            UPDATE ratings
            INNER JOIN bookings
                ON bookings.id = ratings.id_booking
            SET ratings.id_booking = bookings.kode_booking
            WHERE ratings.id_booking IS NOT NULL
              AND ratings.id_booking <> bookings.kode_booking
        ');

        /*
        |--------------------------------------------------------------------------
        | 7. Pastikan tidak ada rating orphan
        |--------------------------------------------------------------------------
        */

        $orphanRatings = DB::table('ratings')
            ->leftJoin(
                'bookings',
                'bookings.kode_booking',
                '=',
                'ratings.id_booking'
            )
            ->whereNotNull('ratings.id_booking')
            ->whereNull('bookings.id')
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

        /*
        |--------------------------------------------------------------------------
        | 8. Tambahkan foreign key baru
        |--------------------------------------------------------------------------
        */

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
        /*
        |--------------------------------------------------------------------------
        | 1. Hapus foreign key
        |--------------------------------------------------------------------------
        */

        try {
            Schema::table('ratings', function (Blueprint $table) {
                $table->dropForeign('ratings_id_booking_foreign');
            });
        } catch (\Throwable $e) {
            // Tidak ada foreign key.
        }

        /*
        |--------------------------------------------------------------------------
        | 2. Kembalikan kode_booking menjadi bookings.id
        |--------------------------------------------------------------------------
        */

        DB::statement('
            UPDATE ratings
            INNER JOIN bookings
                ON bookings.kode_booking = ratings.id_booking
            SET ratings.id_booking = bookings.id
            WHERE ratings.id_booking IS NOT NULL
        ');

        /*
        |--------------------------------------------------------------------------
        | 3. Buat kembali foreign key lama
        |--------------------------------------------------------------------------
        */

        Schema::table('ratings', function (Blueprint $table) {
            $table->foreign(
                'id_booking',
                'ratings_id_booking_foreign'
            )
                ->references('id')
                ->on('bookings')
                ->cascadeOnUpdate()
                ->restrictOnDelete();
        });
    }
};