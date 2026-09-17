<?php

namespace App\Modules\pengguna\Models;

use App\Helpers\UsesUuid;
use App\Modules\talents\Models\talents;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class pengguna extends Authenticatable
{
    use SoftDeletes;
    use UsesUuid;
    use Notifiable;

    protected $casts = [
        'deleted_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'last_seen_at' => 'datetime',
        'typing_until' => 'datetime',
    ];

    protected $table = 'pengguna';

    protected $fillable = [
        'username',
        'email',
        'password',
        'role',
        'bio',
        'profil',
        'created_by',
        'updated_by',
        'deleted_by'
    ];

    protected $hidden = [
        'password',
        'remember_token'
    ];

    /*
    |--------------------------------------------------------------------------
    | RELASI KE TALENT
    |--------------------------------------------------------------------------
    */

    public function talent()
    {
        return $this->hasOne(
            talents::class,
            'pengguna_id',
            'id'
        );
    }

    /**
     * URL foto profil pengguna (Whisperly & Talent)
     */
    public function getAvatarUrlAttribute()
    {
        if (!empty($this->profil)) {
            $photo = trim((string) $this->profil);

            if (filter_var($photo, FILTER_VALIDATE_URL)) {
                return $photo;
            }

            if (str_starts_with($photo, 'profil/')) {
                return asset('storage/' . $photo);
            }

            if (str_starts_with($photo, 'storage/')) {
                return asset($photo);
            }

            return asset('storage/profil/' . ltrim($photo, '/'));
        }

        if ($this->role === 'talent' && $this->talent && !empty($this->talent->photo)) {
            $talentPhoto = trim((string) $this->talent->photo);

            if (filter_var($talentPhoto, FILTER_VALIDATE_URL)) {
                return $talentPhoto;
            }

            return asset('storage/' . ltrim(preg_replace('#^public/#', '', $talentPhoto), '/'));
        }

        return null;
    }
}