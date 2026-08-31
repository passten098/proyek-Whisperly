<?php

namespace App\Modules\talents\Models;

use App\Helpers\UsesUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

class TalentSchedule extends Model
{
    use SoftDeletes, UsesUuid;

    protected $table = 'talent_schedules';

    protected $fillable = [
        'talent_id',
        'start_time',
        'end_time',
        'status',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELASI KE TALENT
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
    | STATUS JADWAL UNTUK HARI INI
    |--------------------------------------------------------------------------
    |
    | Status yang digunakan oleh tampilan:
    |
    | available   = hijau
    | booked      = merah
    | unavailable = abu-abu
    |
    | Penting:
    | kolom status database tidak langsung dianggap sebagai status
    | tampilan karena jadwal berulang setiap hari.
    |
    */

    public function getTodayStatusAttribute(): string
    {
        /*
        |--------------------------------------------------------------------------
        | WAKTU SEKARANG
        |--------------------------------------------------------------------------
        */

        $now = Carbon::now();

        /*
        |--------------------------------------------------------------------------
        | AMBIL JAM MULAI DAN SELESAI
        |--------------------------------------------------------------------------
        */

        $startTime = $this->parseTime(
            $this->start_time,
            $now
        );

        $endTime = $this->parseTime(
            $this->end_time,
            $now
        );

        /*
        |--------------------------------------------------------------------------
        | JIKA JAM SUDAH LEWAT
        |--------------------------------------------------------------------------
        |
        | Contoh:
        |
        | sekarang 10:00
        |
        | 08:00 - 09:00 => unavailable
        | 09:00 - 10:00 => unavailable
        |
        */

        if ($now->greaterThanOrEqualTo($endTime)) {
            return 'unavailable';
        }

        /*
        |--------------------------------------------------------------------------
        | JIKA DATABASE MASIH MENYIMPAN BOOKED
        |--------------------------------------------------------------------------
        |
        | Status booked nantinya akan disinkronkan kembali berdasarkan
        | booking hari ini.
        |
        */

        if ($this->status === 'booked') {
            return 'booked';
        }

        /*
        |--------------------------------------------------------------------------
        | JIKA BELUM LEWAT DAN BELUM BOOKED
        |--------------------------------------------------------------------------
        */

        return 'available';
    }

    /*
    |--------------------------------------------------------------------------
    | STATUS CLASS UNTUK BLADE
    |--------------------------------------------------------------------------
    */

    public function getStatusClassAttribute(): string
    {
        return match ($this->today_status) {

            'available' =>
                'available',

            'booked' =>
                'booked',

            default =>
                'unavailable',
        };
    }

    /*
    |--------------------------------------------------------------------------
    | CEK APAKAH MASIH BISA DIBOOKING HARI INI
    |--------------------------------------------------------------------------
    */

    public function getIsBookableTodayAttribute(): bool
    {
        return $this->today_status === 'available';
    }

    /*
    |--------------------------------------------------------------------------
    | CEK APAKAH WAKTU SUDAH LEWAT
    |--------------------------------------------------------------------------
    */

    public function getIsExpiredTodayAttribute(): bool
    {
        $now = Carbon::now();

        $endTime = $this->parseTime(
            $this->end_time,
            $now
        );

        return $now->greaterThanOrEqualTo($endTime);
    }

    /*
    |--------------------------------------------------------------------------
    | FORMAT JAM
    |--------------------------------------------------------------------------
    */

    public function getStartTimeFormattedAttribute(): string
    {
        return Carbon::parse(
            $this->start_time
        )->format('H:i');
    }

    public function getEndTimeFormattedAttribute(): string
    {
        return Carbon::parse(
            $this->end_time
        )->format('H:i');
    }

    /*
    |--------------------------------------------------------------------------
    | PARSE JAM KE TANGGAL HARI INI
    |--------------------------------------------------------------------------
    */

    private function parseTime(
        mixed $time,
        Carbon $date
    ): Carbon {

        /*
        |--------------------------------------------------------------------------
        | Jika sudah berupa Carbon
        |--------------------------------------------------------------------------
        */

        if ($time instanceof Carbon) {

            return $time->copy()
                ->setDate(
                    $date->year,
                    $date->month,
                    $date->day
                );
        }

        /*
        |--------------------------------------------------------------------------
        | Ambil hanya bagian jam
        |--------------------------------------------------------------------------
        */

        $timeString = substr(
            (string) $time,
            0,
            8
        );

        /*
        |--------------------------------------------------------------------------
        | Gabungkan dengan tanggal hari ini
        |--------------------------------------------------------------------------
        */

        return Carbon::createFromFormat(
            'Y-m-d H:i:s',
            $date->format('Y-m-d') . ' ' . $timeString
        );
    }
}