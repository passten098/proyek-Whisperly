<?php

namespace App\Modules\bookings\Models;

use App\Helpers\UsesUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Modules\Pengguna\Models\Pengguna;
use App\Modules\talents\Models\talents;

class bookings extends Model
{
    use SoftDeletes;
    use UsesUuid;

    public $incrementing = false;

    protected $keyType = 'string';

    protected $table = 'bookings';

    protected $casts = [
        'deleted_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'tanggal_booking' => 'date',
        'durasi_jam' => 'decimal:2',
    ];

    protected $fillable = [
        '*',
    ];

    /*
    |--------------------------------------------------------------------------
    | PENGGUNA
    |--------------------------------------------------------------------------
    */

    public function pengguna()
    {
        return $this->belongsTo(
            Pengguna::class,
            'id_pengguna',
            'id'
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
            'id_talent',
            'id'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | WHISPERLY BOOKING
    |--------------------------------------------------------------------------
    */

    public function whisperlyBooking()
    {
        return $this->belongsTo(
            WhisperlyBooking::class,
            'source_booking_id',
            'id'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | RATINGS
    |--------------------------------------------------------------------------
    |
    | ratings.id_booking
    |        ↓
    | bookings.kode_booking
    |
    */

    public function ratings()
    {
        return $this->hasMany(
            \App\Modules\ratings\Models\ratings::class,
            'id_booking',
            'kode_booking'
        );
    }
}