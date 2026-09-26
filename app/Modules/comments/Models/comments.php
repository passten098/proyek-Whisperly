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

    protected $table = 'comments';

    protected $casts = [
        'deleted_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected $fillable = [
        'id_menfess',
        'id_pengguna',
        'komentar',
        'status',
        'reply_to',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELATIONSHIP MENFESS
    |--------------------------------------------------------------------------
    */

    public function menfess()
    {
        return $this->belongsTo(
            menfess::class,
            'id_menfess',
            'id'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONSHIP PENGGUNA
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

    /*
    |--------------------------------------------------------------------------
    | RELATIONSHIP PARENT COMMENT
    |--------------------------------------------------------------------------
    */

    public function parent()
    {
        return $this->belongsTo(
            self::class,
            'reply_to',
            'id'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONSHIP REPLIES
    |--------------------------------------------------------------------------
    */

    public function replies()
    {
        return $this->hasMany(
            self::class,
            'reply_to',
            'id'
        )->orderBy('created_at', 'asc');
    }

    /*
    |--------------------------------------------------------------------------
    | DELETE COMMENT TREE
    |--------------------------------------------------------------------------
    |
    | Menghapus komentar utama beserta semua child reply-nya, baik langsung
    | maupun bersarang di bawahnya, tanpa meninggalkan reply yatim.
    |--------------------------------------------------------------------------
    */

    public static function deleteTree($commentId): void
    {
        if (empty($commentId)) {
            return;
        }

        $ids = collect();
        $stack = [(string) $commentId];

        while (!empty($stack)) {
            $currentId = array_pop($stack);

            if (empty($currentId) || $ids->contains($currentId)) {
                continue;
            }

            $ids->push((string) $currentId);

            $children = static::query()
                ->where('reply_to', $currentId)
                ->pluck('id')
                ->all();

            foreach ($children as $childId) {
                $stack[] = (string) $childId;
            }
        }

        if ($ids->isEmpty()) {
            return;
        }

        static::query()
            ->whereIn('id', $ids->all())
            ->delete();
    }

    /*
    |--------------------------------------------------------------------------
    | COMMENT USERNAME
    |--------------------------------------------------------------------------
    */

    public function getUsernameAttribute(): string
    {
        return $this->pengguna?->username
            ?? 'Pengguna';
    }

    /*
    |--------------------------------------------------------------------------
    | COMMENT ROLE
    |--------------------------------------------------------------------------
    */

    public function getRoleAttribute(): string
    {
        return strtolower(
            trim(
                (string) (
                    $this->pengguna?->role
                    ?? ''
                )
            )
        );
    }

    /*
    |--------------------------------------------------------------------------
    | TALENT CHECK
    |--------------------------------------------------------------------------
    */

    public function getIsTalentAttribute(): bool
    {
        return $this->role === 'talent';
    }

    /*
    |--------------------------------------------------------------------------
    | ADMIN CHECK
    |--------------------------------------------------------------------------
    */

    public function getIsAdminAttribute(): bool
    {
        return $this->role === 'admin';
    }
}