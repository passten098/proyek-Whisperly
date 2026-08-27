<?php

namespace App\Modules\bookings\Models;

use App\Helpers\UsesUuid;
use App\Modules\chat\Models\WhisperlyConversation;
use App\Modules\pengguna\Models\pengguna;
use App\Modules\ratings\Models\ratings;
use App\Modules\talents\Models\TalentSchedule;
use App\Modules\talents\Models\talents;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class WhisperlyBooking extends Model
{
    use SoftDeletes, UsesUuid;

    protected $table = 'whisperly_bookings';

    protected $fillable = ['pengguna_id', 'talent_id', 'schedule_id', 'status'];

    public function pengguna()
    {
        return $this->belongsTo(pengguna::class, 'pengguna_id');
    }

    public function talent()
    {
        return $this->belongsTo(talents::class, 'talent_id');
    }

    public function schedule()
    {
        return $this->belongsTo(TalentSchedule::class, 'schedule_id');
    }

    public function conversation()
    {
        return $this->hasOne(WhisperlyConversation::class, 'booking_id');
    }

    public function ratings()
    {
        return $this->hasMany(ratings::class, 'booking_id', 'id');
    }

    public function syncChatStatus(): void
    {
        $status = $this->chatStatus();

        if ($status !== $this->status) {
            $this->update(['status' => $status]);
        }

        if ($this->conversation) {
            $this->conversation->update(['status' => $status === 'completed' ? 'closed' : $status]);
        }

        $this->syncLaralagBooking(false);
    }

    public function syncLaralagBooking(bool $allowCreate = true): void
    {
        $status = $this->chatStatus();

        DB::transaction(function () use ($status, $allowCreate) {
            $booking = bookings::withTrashed()
                ->where('source_booking_id', $this->id)
                ->lockForUpdate()
                ->first();

            if (! $booking) {
                if (! $allowCreate) {
                    return;
                }

                $booking = new bookings();
            } elseif ($booking->trashed()) {
                $booking->restore();
            }

            $booking->source_booking_id = $this->id;
            $booking->id_pengguna = $this->pengguna_id;
            $booking->id_talent = $this->talent_id;
            $booking->pengguna_username = $this->pengguna?->username;
            $booking->talent_username = $this->talent?->pengguna?->username;
            $booking->tanggal_booking = $this->created_at?->toDateString() ?? now()->toDateString();
            $booking->durasi_jam = $this->durationHours();
            $booking->status = $status;

            $booking->save();
        });
    }

    public function durationHours(): float
    {
        if (! $this->schedule) {
            return 1.0;
        }

        $start = $this->toMinutes((string) $this->schedule->start_time);
        $end = $this->toMinutes((string) $this->schedule->end_time);

        if ($end < $start) {
            $end += 24 * 60;
        }

        $minutes = max(0, $end - $start);

        return round($minutes / 60, 2);
    }

    protected function toMinutes(string $timeValue): int
    {
        $time = trim($timeValue);
        $parts = array_pad(explode(':', $time), 3, '0');

        $hours = (int) ($parts[0] ?? 0);
        $minutes = (int) ($parts[1] ?? 0);
        $seconds = (int) ($parts[2] ?? 0);

        return ($hours * 60) + $minutes + (int) round($seconds / 60);
    }

    public function canBeRatedBy(pengguna $user): bool
    {
        return $this->pengguna_id === $user->id && $this->chatStatus() === 'completed';
    }

    public function chatStatus(): string
    {
        if (! $this->schedule) {
            return 'completed';
        }

        $now = now()->setTimezone('Asia/Jakarta');
        $start = Carbon::parse($this->schedule->start_time, 'Asia/Jakarta')
            ->setDate($now->year, $now->month, $now->day);
        $end = Carbon::parse($this->schedule->end_time, 'Asia/Jakarta')
            ->setDate($now->year, $now->month, $now->day);

        if ($now->lt($start)) {
            return 'upcoming';
        }

        if ($now->gte($end)) {
            return 'completed';
        }

        return 'active';
    }
}
