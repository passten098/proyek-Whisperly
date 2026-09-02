<?php

namespace App\Modules\chat\Models;

use App\Helpers\UsesUuid;
use Illuminate\Database\Eloquent\Model;

class WhisperlyChatUserState extends Model
{
    use UsesUuid;

    protected $table = 'whisperly_chat_user_states';

    protected $fillable = [
        'user_id',
        'contact_user_id',
        'deleted_at',
        'cleared_at',
    ];

    protected $casts = [
        'deleted_at' => 'datetime',
        'cleared_at' => 'datetime',
    ];
}
