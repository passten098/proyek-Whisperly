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
        | 1. Kolom kode_booking sudah ada
        |--------------------------------------------------------------------------
        */

        /*
        |--------------------------------------------------------------------------
        | 2. Isi booking lama terlebih dahulu
        |--------------------------------------------------------------------------
        | Jangan membuat unique index sebelum semua kode_booking terisi,
        | supaya tidak terjadi bentrok dengan kode yang sudah ada.
        */

        $bookings = DB::table('bookings')
            ->whereNull('kode_booking')
            ->orderBy('created_at')
            ->orderBy('id')
            ->get();

        $lastNumber = DB::table('bookings')
            ->whereNotNull('kode_booking')
            ->get()
            ->map(function ($booking) {
                if (
                    preg_match(
                        '/^BK-(\d+)$/',
                        $booking->kode_booking,
                        $matches
                    )
                ) {
                    return (int) $matches[1];
                }

                return 0;
            })
            ->max();

        $number = max(0, $lastNumber) + 1;

        foreach ($bookings as $booking) {
            DB::table('bookings')
                ->where('id', $booking->id)
                ->update([
                    'kode_booking' => 'BK-' . str_pad(
                        $number,
                        6,
                        '0',
                        STR_PAD_LEFT
                    ),
                ]);

            $number++;
        }

        /*
        |--------------------------------------------------------------------------
        | 3. Tambahkan unique index jika belum ada
        |--------------------------------------------------------------------------
        */

        $indexes = Schema::getIndexes('bookings');

        $hasUniqueKodeBooking = collect($indexes)->contains(function ($index) {
            return $index['unique']
                && $index['columns'] === ['kode_booking'];
        });

        if (!$hasUniqueKodeBooking) {
            Schema::table('bookings', function (Blueprint $table) {
                $table->unique('kode_booking');
            });
        }
    }

    public function down(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Migration ini tidak menghapus kolom kode_booking
        |--------------------------------------------------------------------------
        | Kolom tersebut sudah ada sebelum migration ini.
        */

        $indexes = Schema::getIndexes('bookings');

        $hasUniqueKodeBooking = collect($indexes)->contains(function ($index) {
            return $index['unique']
                && $index['columns'] === ['kode_booking'];
        });

        if ($hasUniqueKodeBooking) {
            Schema::table('bookings', function (Blueprint $table) {
                $table->dropUnique(['kode_booking']);
            });
        }
    }
};