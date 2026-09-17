<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Tambahkan kolom kode_booking
        Schema::table('bookings', function (Blueprint $table) {
            $table->string('kode_booking', 36)
                ->nullable()
                ->unique()
                ->after('id');
        });

        // 2. Isi kode_booking untuk booking lama
        $bookings = DB::table('bookings')
            ->whereNull('kode_booking')
            ->orderBy('created_at')
            ->orderBy('id')
            ->get();

        $number = 1;

        foreach ($bookings as $booking) {
            DB::table('bookings')
                ->where('id', $booking->id)
                ->update([
                    'kode_booking' => 'BK-' . str_pad($number, 6, '0', STR_PAD_LEFT),
                ]);

            $number++;
        }
    }

    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropUnique(['kode_booking']);
            $table->dropColumn('kode_booking');
        });
    }
};