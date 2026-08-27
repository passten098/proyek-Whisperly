<?php

namespace App\Modules\chat\Models;

use App\Helpers\UsesUuid;
use App\Modules\pengguna\Models\pengguna;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WhisperlyMessage extends Model
{
    use SoftDeletes, UsesUuid;

    protected $table = 'whisperly_messages';

    protected $fillable = [
        'conversation_id',
        'sender_id',
        'message',
    ];

    public function conversation()
    {
        return $this->belongsTo(WhisperlyConversation::class, 'conversation_id');
    }

    public function sender()
    {
        return $this->belongsTo(pengguna::class, 'sender_id');
    }
}
