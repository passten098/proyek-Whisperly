<?php

namespace App\Modules\talents\Models;

use App\Helpers\UsesUuid;
use App\Modules\pengguna\Models\pengguna;
use App\Modules\ratings\Models\ratings;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class talents extends Model
{
    use SoftDeletes;
    use UsesUuid;

    protected $table = 'talents';

    protected $casts = [
        'deleted_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected $fillable = [
        'id_user',
        'pengguna_id',
        'deskripsi',
        'photo',
        'created_by',
        'updated_by',
        'deleted_by',
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
            'pengguna_id',
            'id'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | JADWAL
    |--------------------------------------------------------------------------
    */

    public function schedules()
    {
        return $this->hasMany(
            TalentSchedule::class,
            'talent_id',
            'id'
        )->orderBy('start_time');
    }


    /*
    |--------------------------------------------------------------------------
    | RATING
    |--------------------------------------------------------------------------
    */

    public function ratings()
    {
        return $this->hasMany(
            ratings::class,
            'talent_id',
            'id'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | RATING RATA-RATA
    |--------------------------------------------------------------------------
    */

    public function averageRating(): float
    {
        return round(
            (float) ($this->ratings()->avg('nilai_rating') ?? 0),
            1
        );
    }


    /*
    |--------------------------------------------------------------------------
    | JUMLAH RATING
    |--------------------------------------------------------------------------
    */

    public function ratingCount(): int
    {
        return (int) $this->ratings()->count();
    }
}