<?php

namespace App\Modules\talents\Models;

use App\Helpers\UsesUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

class TalentSchedule extends Model
{
    use SoftDeletes, UsesUuid;

    protected $table = 'talent_schedules';

    protected $fillable = [
        'talent_id',
        'schedule_date',
        'start_time',
        'end_time',
        'status',
    ];

    protected $casts = [
        'schedule_date' => 'date:Y-m-d',
    ];

    public function talent()
    {
        return $this->belongsTo(
            talents::class,
            'talent_id'
        );
    }

    public function scopeForDate($query, string $date)
    {
        return $query->whereDate('schedule_date', $date);
    }

    public function resolveStatusForDate(string $date): string
    {
        $targetDate = Carbon::parse(
            $date,
            config('app.timezone')
        )->toDateString();

        if (
            !$this->schedule_date ||
            $this->schedule_date->toDateString() !== $targetDate
        ) {
            return 'unavailable';
        }

        return match ($this->status) {
            'available' => 'available',
            'booked' => 'booked',
            default => 'unavailable',
        };
    }

    public function getTodayStatusAttribute(): string
    {
        return $this->resolveStatusForDate(
            Carbon::now(config('app.timezone'))->toDateString()
        );
    }

    public function getStatusClassAttribute(): string
    {
        return match ($this->today_status) {
            'available' => 'available',
            'booked' => 'booked',
            default => 'unavailable',
        };
    }

    public function getIsBookableTodayAttribute(): bool
    {
        return $this->today_status === 'available';
    }

    public function getIsExpiredTodayAttribute(): bool
    {
        $now = Carbon::now(config('app.timezone'));

        if (
            !$this->schedule_date ||
            $this->schedule_date->toDateString() !== $now->toDateString()
        ) {
            return true;
        }

        $endTime = Carbon::parse(
            $this->end_time,
            config('app.timezone')
        )->setDate(
            $now->year,
            $now->month,
            $now->day
        );

        return $now->greaterThanOrEqualTo($endTime);
    }

    public function getStartTimeFormattedAttribute(): string
    {
        return Carbon::parse($this->start_time)->format('H:i');
    }

    public function getEndTimeFormattedAttribute(): string
    {
        return Carbon::parse($this->end_time)->format('H:i');
    }
}