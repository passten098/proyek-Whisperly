<?php

namespace App\Modules\menfess\Models;

use App\Helpers\UsesUuid;
use App\Modules\categories\Models\categories;
use App\Modules\comments\Models\comments;
use App\Modules\pengguna\Models\pengguna;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class menfess extends Model
{
    use SoftDeletes;
    use UsesUuid;

    protected $casts = [
        'deleted_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected $table = 'menfess';
    protected $fillable = [
        'id_pengguna',
        'id_kategori',
        'isi_pesan',
        'status',
    ];

    protected $appends = ['anonymous_display_name'];

    public function pengguna()
    {
        return $this->belongsTo(pengguna::class, 'id_pengguna', 'id');
    }

    public function kategori()
    {
        return $this->belongsTo(categories::class, 'id_kategori', 'id');
    }

    public function comments()
    {
        return $this->hasMany(comments::class, 'id_menfess', 'id');
    }

    public function getAnonymousDisplayNameAttribute(): string
    {
        $seed = $this->id ?? $this->attributes['id'] ?? 'anon';

        return 'Anonim-' . strtoupper(substr(md5((string) $seed), 0, 4));
    }
}
