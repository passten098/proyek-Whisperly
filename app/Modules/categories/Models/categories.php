<?php

namespace App\Modules\categories\Models;

use App\Helpers\UsesUuid;
use App\Modules\menfess\Models\menfess;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class categories extends Model
{
    use SoftDeletes;
    use UsesUuid;

    protected $casts = [
        'deleted_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected $table = 'categories';
    protected $fillable = ['jenis_kategori'];

    public function menfess()
    {
        return $this->hasMany(menfess::class, 'id_kategori', 'id');
    }
}
