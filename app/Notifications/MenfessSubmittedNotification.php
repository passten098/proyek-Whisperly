<?php

namespace App\Notifications;

use App\Modules\menfess\Models\menfess;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class MenfessSubmittedNotification extends Notification
{
    use Queueable;

    public function __construct(public menfess $menfess)
    {
        //
    }

    public function via($notifiable): array
    {
        return ['database'];
    }

    public function toDatabase($notifiable): array
    {
        $categorySource = $this->menfess->kategori?->jenis_kategori
            ?? $this->menfess->kategori()->value('jenis_kategori')
            ?? 'campuran';

        $categoryKey = strtolower(trim((string) $categorySource));

        $normalizedCategory = match ($categoryKey) {
            'cinta', 'love' => 'love',
            'horor', 'horror' => 'horror',
            'sedih', 'sad' => 'sad',
            'campuran', 'random' => 'random',
            default => 'random',
        };

        $sender = $this->menfess->pengguna;
        $username = trim((string) ($sender?->username ?? '')) ?: 'pengguna';
        $avatarUrl = trim((string) ($sender?->avatar_url ?? '')) ?: asset('assets/images/faces/1.jpg');

        return [
            'menfess_id' => (string) $this->menfess->id,
            'username' => $username,
            'avatar_url' => $avatarUrl,
            'category' => $normalizedCategory,
            'label' => 'profil - ' . $username . ' (' . $normalizedCategory . ')',
            'created_at' => optional($this->menfess->created_at)->toDateTimeString() ?? now()->toDateTimeString(),
        ];
    }
}
