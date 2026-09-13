<?php

namespace App\Modules\ratings\Models;

use App\Helpers\UsesUuid;
use App\Modules\bookings\Models\bookings;
use App\Modules\pengguna\Models\pengguna;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ratings extends Model
{
    use SoftDeletes;
    use UsesUuid;

    public $incrementing = false;

    protected $keyType = 'string';

    protected $table = 'ratings';

    protected $casts = [
        'deleted_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'nilai_rating' => 'integer',
    ];

    protected $fillable = [
        'id_booking',
        'id_pengguna',
        'nilai_rating',
        'ulasan',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    /*
    |--------------------------------------------------------------------------
    | BOOKING LARALAG
    |--------------------------------------------------------------------------
    */

    public function booking()
    {
        return $this->belongsTo(
            bookings::class,
            'id_booking',
            'id'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | PENGGUNA
    |--------------------------------------------------------------------------
    */

    public function pengguna()
    {
        return $this->belongsTo(
            pengguna::class,
            'id_pengguna',
            'id'
        );
    }
}