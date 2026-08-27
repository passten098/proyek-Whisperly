<?php

namespace App\Modules\comments\Models;

use App\Helpers\UsesUuid;
use App\Modules\menfess\Models\menfess;
use App\Modules\pengguna\Models\pengguna;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class comments extends Model
{
    use SoftDeletes;
    use UsesUuid;

    protected $casts = [
        'deleted_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected $table = 'comments';
    protected $fillable = [
        'id_menfess',
        'id_pengguna',
        'komentar',
        'status',
    ];

    public function menfess()
    {
        return $this->belongsTo(menfess::class, 'id_menfess', 'id');
    }

    public function pengguna()
    {
        return $this->belongsTo(pengguna::class, 'id_pengguna', 'id');
    }
}
