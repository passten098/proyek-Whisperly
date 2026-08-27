<?php

namespace App\Modules\talents\Models;

use App\Helpers\UsesUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TalentSchedule extends Model
{
    use SoftDeletes, UsesUuid;

    protected $table = 'talent_schedules';

    protected $fillable = ['talent_id', 'start_time', 'end_time', 'status'];

    public function talent()
    {
        return $this->belongsTo(talents::class, 'talent_id');
    }
}
