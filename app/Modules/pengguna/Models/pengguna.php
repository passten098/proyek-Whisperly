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
}