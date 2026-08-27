<?php

namespace App\Modules\ratings\Models;

use App\Helpers\UsesUuid;
use App\Modules\bookings\Models\WhisperlyBooking;
use App\Modules\pengguna\Models\pengguna;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ratings extends Model
{
    use SoftDeletes;
    use UsesUuid;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $casts = [
        'deleted_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'nilai_rating' => 'integer',
    ];

    protected $table = 'ratings';
    protected $fillable = [
        'booking_id',
        'pengguna_id',
        'talent_id',
        'nilai_rating',
        'ulasan',
    ];

    public function booking()
    {
        return $this->belongsTo(WhisperlyBooking::class, 'booking_id', 'id');
    }

    public function pengguna()
    {
        return $this->belongsTo(pengguna::class, 'pengguna_id', 'id');
    }
}

