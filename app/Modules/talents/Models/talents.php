<?php

namespace App\Modules\talents\Models;

use App\Helpers\UsesUuid;
use App\Modules\ratings\Models\ratings;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class talents extends Model
{
    use SoftDeletes;
    use UsesUuid;

    protected $casts = ['deleted_at' => 'datetime', 'created_at' => 'datetime', 'updated_at' => 'datetime'];
    protected $table = 'talents';
    protected $fillable = ['id_user', 'pengguna_id', 'deskripsi', 'photo', 'created_by', 'updated_by', 'deleted_by'];

    public function pengguna()
    {
        return $this->belongsTo(\App\Modules\pengguna\Models\pengguna::class, 'pengguna_id');
    }

    public function schedules()
    {
        return $this->hasMany(TalentSchedule::class, 'talent_id')->orderBy('start_time');
    }

    public function ratings()
    {
        return $this->hasMany(ratings::class, 'talent_id', 'id');
    }

    public function averageRating(): float
    {
        return round((float) $this->ratings()->avg('nilai_rating') ?? 0, 1);
    }

    public function ratingCount(): int
    {
        return (int) $this->ratings()->count();
    }
}

