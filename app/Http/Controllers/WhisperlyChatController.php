<?php

namespace App\Http\Controllers;

use App\Modules\bookings\Models\WhisperlyBooking;
use App\Modules\chat\Models\WhisperlyConversation;
use App\Modules\pengguna\Models\pengguna;
use App\Modules\talents\Models\talents;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class WhisperlyChatController extends Controller
{
    public function index(Request $request): View|RedirectResponse
    {
        $user = $request->user('whisperly');
        $bookings = $this->bookingsForUser($user);

        // Otomatis buka room pertama, sesuai alur "room pertama otomatis dipilih".
        // Jika tidak ada booking sama sekali, tetap tampilkan view index seperti sebelumnya.
        if ($bookings->isNotEmpty()) {
            return redirect()->route('whisperly.chat.show', $bookings->first()->id);
        }

        return view('whisperly.chat.index', compact('bookings'));
    }

    public function show(Request $request, WhisperlyBooking $booking): View
    {
        $user = $request->user('whisperly');
        $guard = $request->user() ? 'web' : 'whisperly';

        Log::info('WhisperlyChat::show: access check start', [
            'guard' => $guard,
            'route' => $request->route()?->getName(),
            'authenticated_user_id' => $user?->id,
            'authenticated_username' => $user?->username,
            'authenticated_role' => $user?->role,
            'booking_id' => $booking?->id,
            'booking_user_id' => $booking?->pengguna_id,
            'booking_talent_id' => $booking?->talent_id,
        ]);

        $this->authorizeBookingAccess($user, $booking);

        $booking->syncChatStatus();
        $conversation = $booking->conversation()->firstOrCreate([
            'booking_id' => $booking->id,
            'user_id' => $booking->pengguna_id,
            'talent_id' => $booking->talent_id,
        ], [
            'start_time' => $booking->schedule?->start_time ?? '00:00',
            'end_time' => $booking->schedule?->end_time ?? '00:00',
            'status' => $this->chatState($booking),
        ]);

        if ($booking->schedule) {
            $conversation->update([
                'start_time' => $booking->schedule->start_time,
                'end_time' => $booking->schedule->end_time,
                'status' => $this->chatState($booking),
            ]);
        }

        $messages = $conversation->messages()->with('sender')->get();
        $status = $this->chatState($booking);
        $canChat = $status === 'active';
        $notice = $this->chatNotice($booking, $status);

        // Daftar seluruh room milik user yang login, untuk kolom "Riwayat Percakapan".
        // Query-nya sama persis dengan yang dipakai index(), tidak ada tabel/relasi baru.
        $bookings = $this->bookingsForUser($user);

        return view('whisperly.chat.show', [
            'booking' => $booking,
            'conversation' => $conversation,
            'messages' => $messages,
            'status' => $status,
            'canChat' => $canChat,
            'notice' => $notice,
            'bookings' => $bookings,
        ]);
    }

    public function store(Request $request, WhisperlyBooking $booking): RedirectResponse
    {
        $user = $request->user('whisperly');
        $this->authorizeBookingAccess($user, $booking);

        $request->validate([
            'message' => ['required', 'string', 'max:2000'],
        ]);

        $booking->syncChatStatus();

        if ($this->chatState($booking) !== 'active') {
            abort(403, 'Booking telah selesai. Chat ini sudah ditutup.');
        }

        $conversation = $booking->conversation()->firstOrCreate([
            'booking_id' => $booking->id,
            'user_id' => $booking->pengguna_id,
            'talent_id' => $booking->talent_id,
        ], [
            'start_time' => $booking->schedule?->start_time ?? '00:00',
            'end_time' => $booking->schedule?->end_time ?? '00:00',
            'status' => 'active',
        ]);

        $conversation->messages()->create([
            'sender_id' => $user->id,
            'message' => trim((string) $request->input('message')),
        ]);

        return redirect()->route('whisperly.chat.show', $booking->id)
            ->with('status', 'Pesan terkirim.');
    }

    /**
     * Semua booking (room chat) milik user yang sedang login, dengan relasi
     * yang dibutuhkan untuk kolom "Riwayat Percakapan" (avatar, preview pesan
     * terakhir, waktu, status). Sebelumnya logic ini hanya ada di index();
     * sekarang diekstrak agar show() bisa memakainya juga tanpa duplikasi.
     */
    private function bookingsForUser(pengguna $user): Collection
    {
        $query = WhisperlyBooking::query()
            ->with(['pengguna', 'talent.pengguna', 'schedule', 'conversation.messages.sender'])
            ->orderByDesc('created_at');

        if ($user->role === 'user') {
            $query->where('pengguna_id', $user->id);
        } elseif ($user->role === 'talent') {
            $profile = talents::query()->where('pengguna_id', $user->id)->first();
            if ($profile) {
                $query->where('talent_id', $profile->id);
            } else {
                $query->whereRaw('0 = 1');
            }
        } else {
            abort(403);
        }

        return $query->get()->map(function (WhisperlyBooking $booking) {
            $booking->syncChatStatus();
            return $booking;
        });
    }

    private function authorizeBookingAccess(pengguna $user, WhisperlyBooking $booking): void
    {
        $role = $user?->role;
        $talentProfile = $role === 'talent' ? talents::query()->where('pengguna_id', $user->id)->first() : null;

        Log::info('WhisperlyChat::authorizeBookingAccess', [
            'guard' => 'whisperly',
            'route' => request()->route()?->getName(),
            'authenticated_user_id' => $user?->id,
            'authenticated_username' => $user?->username,
            'authenticated_role' => $role,
            'booking_id' => $booking?->id,
            'booking_user_id' => $booking?->pengguna_id,
            'booking_talent_id' => $booking?->talent_id,
            'talent_profile_id' => $talentProfile?->id,
            'user_id_matches_booking' => $user && $booking && $booking->pengguna_id === $user->id,
            'talent_id_matches_profile' => $user && $booking && $talentProfile && $booking->talent_id === $talentProfile->id,
        ]);

        if ($user->role === 'user' && $booking->pengguna_id !== $user->id) {
            Log::warning('WhisperlyChat::authorizeBookingAccess: user forbidden (booking owner mismatch)', [
                'user_id' => $user->id,
                'booking_user_id' => $booking->pengguna_id,
                'booking_id' => $booking->id,
            ]);
            abort(403, 'Anda tidak memiliki akses ke chat ini.');
        }

        if ($user->role === 'talent') {
            $talentProfile = talents::query()->where('pengguna_id', $user->id)->first();
            if (! $talentProfile || $booking->talent_id !== $talentProfile->id) {
                Log::warning('WhisperlyChat::authorizeBookingAccess: talent forbidden (profile mismatch)', [
                    'user_id' => $user->id,
                    'talent_profile_id' => $talentProfile?->id,
                    'booking_talent_id' => $booking->talent_id,
                    'booking_id' => $booking->id,
                ]);
                abort(403, 'Anda tidak memiliki akses ke chat ini.');
            }
        }

        if (! in_array($user->role, ['user', 'talent'], true)) {
            Log::warning('WhisperlyChat::authorizeBookingAccess: forbidden role', [
                'role' => $user->role,
            ]);
            abort(403, 'Akses chat tidak tersedia untuk role ini.');
        }
    }

    private function chatState(WhisperlyBooking $booking): string
    {
        if (! $booking->schedule) {
            return 'closed';
        }

        $now = now()->setTimezone('Asia/Jakarta');
        $start = Carbon::parse($booking->schedule->start_time, 'Asia/Jakarta')
            ->setDate($now->year, $now->month, $now->day);
        $end = Carbon::parse($booking->schedule->end_time, 'Asia/Jakarta')
            ->setDate($now->year, $now->month, $now->day);

        if ($now->lt($start)) {
            return 'upcoming';
        }

        if ($now->gte($end)) {
            if ($booking->status !== 'completed') {
                $booking->update(['status' => 'completed']);
                $booking->conversation?->update(['status' => 'closed']);
            }

            return 'completed';
        }

        if ($booking->status !== 'active') {
            $booking->update(['status' => 'active']);
            $booking->conversation?->update(['status' => 'active']);
        }

        return 'active';
    }

    private function chatNotice(WhisperlyBooking $booking, string $status): string
    {
        if ($status === 'upcoming') {
            return 'Chat akan tersedia mulai pukul ' . $booking->schedule?->start_time . ' WIB.';
        }

        if ($status === 'completed') {
            return 'Booking telah selesai. Chat ini sudah ditutup.';
        }

        return '';
    }
}