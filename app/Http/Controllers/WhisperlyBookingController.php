<?php

namespace App\Http\Controllers;

use App\Modules\bookings\Models\WhisperlyBooking;
use App\Modules\bookings\Models\bookings;
use App\Modules\ratings\Models\ratings;
use App\Modules\talents\Models\TalentSchedule;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class WhisperlyBookingController extends Controller
{
    public function store(Request $request, string $username): RedirectResponse
    {
        $request->validate([
            'schedule_id' => ['required', 'uuid'],
        ]);

        $user = $request->user('whisperly');
        $talent = \App\Modules\pengguna\Models\pengguna::where('username', $username)
            ->where('role', 'talent')
            ->firstOrFail();
        $profile = \App\Modules\talents\Models\talents::where('pengguna_id', $talent->id)->firstOrFail();

        $booking = DB::transaction(function () use ($request, $user, $profile) {
            $schedule = TalentSchedule::query()->where('id', $request->input('schedule_id'))
                ->where('talent_id', $profile->id)
                ->lockForUpdate()
                ->firstOrFail();

            $existingBooking = WhisperlyBooking::withTrashed()
                ->where('schedule_id', $schedule->id)
                ->first();

            if ($existingBooking) {
                if ($existingBooking->trashed()) {
                    $existingBooking->restore();
                }

                if ($existingBooking->pengguna_id !== $user->id) {
                    abort(422, 'Jadwal tersebut sudah dipesan oleh user lain.');
                }

                TalentSchedule::query()->whereKey($schedule->getKey())->update(['status' => 'booked']);
                $existingBooking->update(['status' => 'upcoming']);
                $existingBooking->syncLaralagBooking(true);

                return $existingBooking;
            }

            if ($schedule->status !== 'available') {
                abort(422, 'Jadwal tersebut sudah tidak tersedia.');
            }

            $booking = WhisperlyBooking::create([
                'pengguna_id' => $user->id,
                'talent_id' => $profile->id,
                'schedule_id' => $schedule->id,
                'status' => 'upcoming',
            ]);

            TalentSchedule::query()->whereKey($schedule->getKey())->update(['status' => 'booked']);

            $booking->syncLaralagBooking(true);

            return $booking;
        });

        return redirect()->route('whisperly.talents.show', $username)
            ->with('booking_success', true)
            ->with('booking_id', $booking->id)
            ->with('status', 'Booking berhasil!');
    }

    public function storeRating(Request $request, WhisperlyBooking $booking): RedirectResponse
    {
        $user = $request->user('whisperly');

        abort_unless($user && $booking->pengguna_id === $user->id, 403, 'Anda tidak berhak memberi rating untuk booking ini.');
        abort_unless($booking->chatStatus() === 'completed', 422, 'Rating hanya dapat diberikan setelah booking selesai.');

        $request->validate([
            'rating' => ['required', 'integer', 'between:1,5'],
            'ulasan' => ['nullable', 'string', 'max:2000'],
        ]);

        $alreadyRated = ratings::query()->where('booking_id', $booking->id)->where('pengguna_id', $user->id)->exists();
        if ($alreadyRated) {
            return redirect()->route('whisperly.chat.show', $booking->id)
                ->with('status', 'Anda sudah memberikan rating untuk booking ini.');
        }

        ratings::create([
            'booking_id' => $booking->id,
            'pengguna_id' => $user->id,
            'talent_id' => $booking->talent_id,
            'nilai_rating' => $request->input('rating'),
            'ulasan' => trim((string) $request->input('ulasan', '')),
        ]);

        $booking->update(['status' => 'completed']);
        $booking->syncLaralagBooking(true);

        return redirect()->route('whisperly.chat.show', $booking->id)
            ->with('status', 'Rating berhasil dikirim.');
    }
}
