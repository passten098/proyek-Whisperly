<?php

namespace App\Modules\chat\Models;

use App\Helpers\UsesUuid;
use App\Modules\bookings\Models\WhisperlyBooking;
use App\Modules\pengguna\Models\pengguna;
use App\Modules\talents\Models\talents;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WhisperlyConversation extends Model
{
    use SoftDeletes, UsesUuid;

    protected $table = 'whisperly_conversations';

    protected $fillable = [
        'booking_id',
        'user_id',
        'talent_id',
        'start_time',
        'end_time',
        'status',
    ];

    public function booking()
    {
        return $this->belongsTo(WhisperlyBooking::class, 'booking_id');
    }

    public function user()
    {
        return $this->belongsTo(pengguna::class, 'user_id');
    }

    public function talent()
    {
        return $this->belongsTo(talents::class, 'talent_id');
    }

    public function messages()
    {
        return $this->hasMany(WhisperlyMessage::class, 'conversation_id')->orderBy('created_at');
    }
}
