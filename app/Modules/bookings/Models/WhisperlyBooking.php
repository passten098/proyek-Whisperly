<?php

namespace App\Modules\bookings\Models;

use App\Helpers\UsesUuid;
use App\Modules\chat\Models\WhisperlyConversation;
use App\Modules\pengguna\Models\pengguna;
use App\Modules\ratings\Models\ratings;
use App\Modules\talents\Models\TalentSchedule;
use App\Modules\talents\Models\talents;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class WhisperlyBooking extends Model
{
    use SoftDeletes, UsesUuid;

    protected $table = 'whisperly_bookings';

    protected $fillable = [
        'pengguna_id',
        'talent_id',
        'schedule_id',
        'status',
    ];

    /*
    |--------------------------------------------------------------------------
    | PENGGUNA
    |--------------------------------------------------------------------------
    */

    public function pengguna()
    {
        return $this->belongsTo(
            pengguna::class,
            'pengguna_id'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | TALENT
    |--------------------------------------------------------------------------
    */

    public function talent()
    {
        return $this->belongsTo(
            talents::class,
            'talent_id'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | SCHEDULE
    |--------------------------------------------------------------------------
    */

    public function schedule()
    {
        return $this->belongsTo(
            TalentSchedule::class,
            'schedule_id'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | CONVERSATION
    |--------------------------------------------------------------------------
    */

    public function conversation()
    {
        return $this->hasOne(
            WhisperlyConversation::class,
            'booking_id'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | RATINGS
    |--------------------------------------------------------------------------
    |
    | WhisperlyBooking
    |       ↓
    | bookings.source_booking_id
    |       ↓
    | bookings.kode_booking
    |       ↓
    | ratings.id_booking
    |
    */

    public function ratings()
    {
        return $this->hasManyThrough(
            ratings::class,
            bookings::class,
            'source_booking_id',
            'id_booking',
            'id',
            'kode_booking'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | SYNC CHAT STATUS
    |--------------------------------------------------------------------------
    */

    public function syncChatStatus(): void
    {
        $status = $this->chatStatus();

        if ($status !== $this->status) {
            $this->update([
                'status' => $status
            ]);
        }

        if ($this->conversation) {
            $this->conversation->update([
                'status' => $status === 'completed'
                    ? 'closed'
                    : $status
            ]);
        }

        $this->syncLaralagBooking(false);
    }

    /*
    |--------------------------------------------------------------------------
    | SYNC KE TABEL BOOKINGS LARALAG
    |--------------------------------------------------------------------------
    |
    | Whisperly:
    | whisperly_bookings.id
    |
    | Laralag:
    | bookings.id
    |
    | Hubungan:
    | bookings.source_booking_id
    | =
    | whisperly_bookings.id
    |
    */

    public function syncLaralagBooking(bool $allowCreate = true): void
    {
        $status = $this->chatStatus();

        DB::transaction(function () use ($status, $allowCreate) {

            /*
            |--------------------------------------------------------------------------
            | CARI BOOKING LARALAG
            |--------------------------------------------------------------------------
            */

            $booking = bookings::withTrashed()
                ->where(
                    'source_booking_id',
                    $this->id
                )
                ->lockForUpdate()
                ->first();

            /*
            |--------------------------------------------------------------------------
            | JIKA BELUM ADA
            |--------------------------------------------------------------------------
            */

            if (! $booking) {

                if (! $allowCreate) {
                    return;
                }

                $booking = new bookings();
            }

            /*
            |--------------------------------------------------------------------------
            | JIKA TERHAPUS
            |--------------------------------------------------------------------------
            */

            elseif ($booking->trashed()) {
                $booking->restore();
            }

            /*
            |--------------------------------------------------------------------------
            | GENERATE KODE BOOKING
            |--------------------------------------------------------------------------
            |
            | Format:
            |
            | BK-000001
            | BK-000002
            | BK-000003
            | ...
            |
            | Kalau booking sudah punya kode, kode TIDAK diubah.
            |
            */

            if (
                empty($booking->kode_booking)
            ) {

                /*
                |--------------------------------------------------------------------------
                | AMBIL KODE BOOKING TERAKHIR
                |--------------------------------------------------------------------------
                */

                $lastBooking = bookings::withTrashed()
                    ->whereNotNull('kode_booking')
                    ->where(
                        'kode_booking',
                        'like',
                        'BK-%'
                    )
                    ->orderByRaw(
                        'CAST(SUBSTRING(kode_booking, 4) AS UNSIGNED) DESC'
                    )
                    ->lockForUpdate()
                    ->first();

                /*
                |--------------------------------------------------------------------------
                | NOMOR BERIKUTNYA
                |--------------------------------------------------------------------------
                */

                $nextNumber = 1;

                if ($lastBooking) {

                    $lastCode =
                        (string) $lastBooking->kode_booking;

                    if (
                        preg_match(
                            '/^BK-(\d+)$/',
                            $lastCode,
                            $matches
                        )
                    ) {
                        $nextNumber =
                            ((int) $matches[1]) + 1;
                    }
                }

                /*
                |--------------------------------------------------------------------------
                | BENTUK KODE
                |--------------------------------------------------------------------------
                */

                $booking->kode_booking =
                    'BK-' .
                    str_pad(
                        (string) $nextNumber,
                        6,
                        '0',
                        STR_PAD_LEFT
                    );
            }

            /*
            |--------------------------------------------------------------------------
            | HUBUNGAN BOOKING
            |--------------------------------------------------------------------------
            */

            $booking->source_booking_id =
                $this->id;

            /*
            |--------------------------------------------------------------------------
            | PENGGUNA
            |--------------------------------------------------------------------------
            */

            $booking->id_pengguna =
                $this->pengguna_id;

            $booking->pengguna_username =
                $this->pengguna?->username;

            /*
            |--------------------------------------------------------------------------
            | TALENT
            |--------------------------------------------------------------------------
            */

            $booking->id_talent =
                $this->talent_id;

            $booking->talent_username =
                $this->talent?->pengguna?->username;

            /*
            |--------------------------------------------------------------------------
            | TANGGAL BOOKING
            |--------------------------------------------------------------------------
            */

            $booking->tanggal_booking =
                $this->created_at?->toDateString()
                ?? now()->toDateString();

            /*
            |--------------------------------------------------------------------------
            | DURASI
            |--------------------------------------------------------------------------
            */

            $booking->durasi_jam =
                $this->durationHours();

            /*
            |--------------------------------------------------------------------------
            | STATUS
            |--------------------------------------------------------------------------
            */

            $booking->status =
                $status;

            /*
            |--------------------------------------------------------------------------
            | SIMPAN
            |--------------------------------------------------------------------------
            */

            $booking->save();
        });
    }

    /*
    |--------------------------------------------------------------------------
    | DURASI BOOKING
    |--------------------------------------------------------------------------
    */

    public function durationHours(): float
    {
        if (! $this->schedule) {
            return 1.0;
        }

        $start = $this->toMinutes(
            (string) $this->schedule->start_time
        );

        $end = $this->toMinutes(
            (string) $this->schedule->end_time
        );

        if ($end < $start) {
            $end += 24 * 60;
        }

        $minutes = max(
            0,
            $end - $start
        );

        return round(
            $minutes / 60,
            2
        );
    }

    /*
    |--------------------------------------------------------------------------
    | CONVERT TIME KE MENIT
    |--------------------------------------------------------------------------
    */

    protected function toMinutes(
        string $timeValue
    ): int {

        $time = trim($timeValue);

        $parts = array_pad(
            explode(':', $time),
            3,
            '0'
        );

        $hours = (int) (
            $parts[0] ?? 0
        );

        $minutes = (int) (
            $parts[1] ?? 0
        );

        $seconds = (int) (
            $parts[2] ?? 0
        );

        return (
            $hours * 60
        ) + $minutes
            + (int) round(
                $seconds / 60
            );
    }

    /*
    |--------------------------------------------------------------------------
    | CEK BOLEH RATING
    |--------------------------------------------------------------------------
    */

    public function canBeRatedBy(
        pengguna $user
    ): bool {

        return $this->pengguna_id === $user->id
            && $this->chatStatus() === 'completed';
    }

    /*
    |--------------------------------------------------------------------------
    | STATUS CHAT
    |--------------------------------------------------------------------------
    */

    public function chatStatus(): string
    {
        if (! $this->schedule) {
            return 'completed';
        }

        $now = now()->setTimezone(
            'Asia/Jakarta'
        );

        $bookingDate = $this->schedule->schedule_date;

        $start = Carbon::parse(
            $bookingDate->format('Y-m-d') . ' ' . $this->schedule->start_time,
            'Asia/Jakarta'
        );

        $end = Carbon::parse(
            $bookingDate->format('Y-m-d') . ' ' . $this->schedule->end_time,
            'Asia/Jakarta'
        );

        if ($end->lessThan($start)) {
            $end->addDay();
        }

        if ($now->lt($start)) {
            return 'upcoming';
        }

        if ($now->gte($end)) {
            return 'completed';
        }

        return 'active';
    }
}