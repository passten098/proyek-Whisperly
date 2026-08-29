<?php

namespace App\Http\Controllers;

use App\Modules\bookings\Models\WhisperlyBooking;
use App\Modules\ratings\Models\ratings;
use App\Modules\talents\Models\TalentSchedule;
use App\Modules\pengguna\Models\pengguna;
use App\Modules\talents\Models\talents;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class WhisperlyBookingController extends Controller
{
    /**
     * ============================================================
     * CONFIRM BOOKING
     * ============================================================
     */
    public function store(Request $request, string $username): RedirectResponse
    {
        /*
        |--------------------------------------------------------------------------
        | VALIDASI
        |--------------------------------------------------------------------------
        */

        $request->validate([
            'schedule_id' => ['required', 'uuid'],
        ]);

        /*
        |--------------------------------------------------------------------------
        | USER YANG SEDANG LOGIN
        |--------------------------------------------------------------------------
        */

        $user = $request->user('whisperly');

        abort_unless(
            $user,
            401,
            'Anda harus login terlebih dahulu.'
        );

        /*
        |--------------------------------------------------------------------------
        | CARI TALENT
        |--------------------------------------------------------------------------
        */

        $talent = pengguna::query()
            ->where('username', $username)
            ->where('role', 'talent')
            ->firstOrFail();

        /*
        |--------------------------------------------------------------------------
        | CARI PROFILE TALENT
        |--------------------------------------------------------------------------
        */

        $profile = talents::query()
            ->where('pengguna_id', $talent->id)
            ->firstOrFail();

        /*
        |--------------------------------------------------------------------------
        | PROSES BOOKING
        |--------------------------------------------------------------------------
        */

        $booking = DB::transaction(function () use (
            $request,
            $user,
            $profile
        ) {

            /*
            |--------------------------------------------------------------------------
            | LOCK JADWAL
            |--------------------------------------------------------------------------
            */

            $schedule = TalentSchedule::query()
                ->where('id', $request->input('schedule_id'))
                ->where('talent_id', $profile->id)
                ->lockForUpdate()
                ->firstOrFail();

            /*
            |--------------------------------------------------------------------------
            | CEK BOOKING LAMA
            |--------------------------------------------------------------------------
            */

            $existingBooking = WhisperlyBooking::withTrashed()
                ->where('schedule_id', $schedule->id)
                ->first();

            /*
            |--------------------------------------------------------------------------
            | KALAU SUDAH ADA BOOKING
            |--------------------------------------------------------------------------
            */

            if ($existingBooking) {

                /*
                |--------------------------------------------------------------------------
                | Kalau booking sebelumnya dihapus/soft delete,
                | aktifkan kembali.
                |--------------------------------------------------------------------------
                */

                if ($existingBooking->trashed()) {
                    $existingBooking->restore();
                }

                /*
                |--------------------------------------------------------------------------
                | Kalau ternyata booking milik user lain
                |--------------------------------------------------------------------------
                */

                if ($existingBooking->pengguna_id !== $user->id) {

                    abort(
                        422,
                        'Jadwal tersebut sudah dipesan oleh user lain.'
                    );
                }

                /*
                |--------------------------------------------------------------------------
                | Booking milik user sendiri
                |--------------------------------------------------------------------------
                */

                TalentSchedule::query()
                    ->whereKey($schedule->getKey())
                    ->update([
                        'status' => 'booked',
                    ]);

                $existingBooking->update([
                    'status' => 'upcoming',
                ]);

                /*
                |--------------------------------------------------------------------------
                | Sinkronisasi ke Laralag
                |--------------------------------------------------------------------------
                */

                $existingBooking->syncLaralagBooking(true);

                return $existingBooking;
            }

            /*
            |--------------------------------------------------------------------------
            | JADWAL HARUS AVAILABLE
            |--------------------------------------------------------------------------
            */

            if ($schedule->status !== 'available') {

                abort(
                    422,
                    'Jadwal tersebut sudah tidak tersedia.'
                );
            }

            /*
            |--------------------------------------------------------------------------
            | BUAT BOOKING BARU
            |--------------------------------------------------------------------------
            */

            $booking = WhisperlyBooking::create([
                'pengguna_id' => $user->id,
                'talent_id' => $profile->id,
                'schedule_id' => $schedule->id,
                'status' => 'upcoming',
            ]);

            /*
            |--------------------------------------------------------------------------
            | UBAH JADWAL MENJADI BOOKED
            |--------------------------------------------------------------------------
            */

            TalentSchedule::query()
                ->whereKey($schedule->getKey())
                ->update([
                    'status' => 'booked',
                ]);

            /*
            |--------------------------------------------------------------------------
            | SINKRONISASI
            |--------------------------------------------------------------------------
            */

            $booking->syncLaralagBooking(true);

            return $booking;
        });

        /*
        |--------------------------------------------------------------------------
        | KEMBALI KE DETAIL TALENT
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route(
                'whisperly.talents.show',
                ['username' => $username]
            )
            ->with('booking_success', true)
            ->with('booking_id', $booking->id)
            ->with(
                'status',
                'Booking berhasil! Silakan tunggu sampai booking dikonfirmasi.'
            );
    }


    /**
     * ============================================================
     * RATING
     * ============================================================
     */
    public function storeRating(
        Request $request,
        WhisperlyBooking $booking
    ): RedirectResponse {

        $user = $request->user('whisperly');

        /*
        |--------------------------------------------------------------------------
        | CEK PEMILIK BOOKING
        |--------------------------------------------------------------------------
        */

        abort_unless(
            $user && $booking->pengguna_id === $user->id,
            403,
            'Anda tidak berhak memberi rating untuk booking ini.'
        );

        /*
        |--------------------------------------------------------------------------
        | RATING HANYA SETELAH CHAT SELESAI
        |--------------------------------------------------------------------------
        */

        abort_unless(
            $booking->chatStatus() === 'completed',
            422,
            'Rating hanya dapat diberikan setelah booking selesai.'
        );

        /*
        |--------------------------------------------------------------------------
        | VALIDASI RATING
        |--------------------------------------------------------------------------
        */

        $request->validate([
            'rating' => [
                'required',
                'integer',
                'between:1,5',
            ],

            'ulasan' => [
                'nullable',
                'string',
                'max:2000',
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | CEK SUDAH PERNAH RATING
        |--------------------------------------------------------------------------
        */

        $alreadyRated = ratings::query()
            ->where('booking_id', $booking->id)
            ->where('pengguna_id', $user->id)
            ->exists();

        if ($alreadyRated) {

            return redirect()
                ->route(
                    'whisperly.chat.show',
                    $booking->id
                )
                ->with(
                    'status',
                    'Anda sudah memberikan rating untuk booking ini.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | SIMPAN RATING
        |--------------------------------------------------------------------------
        */

        ratings::create([
            'booking_id' => $booking->id,
            'pengguna_id' => $user->id,
            'talent_id' => $booking->talent_id,
            'nilai_rating' => $request->input('rating'),
            'ulasan' => trim(
                (string) $request->input('ulasan', '')
            ),
        ]);

        /*
        |--------------------------------------------------------------------------
        | UPDATE STATUS BOOKING
        |--------------------------------------------------------------------------
        */

        $booking->update([
            'status' => 'completed',
        ]);

        /*
        |--------------------------------------------------------------------------
        | SINKRONISASI
        |--------------------------------------------------------------------------
        */

        $booking->syncLaralagBooking(true);

        /*
        |--------------------------------------------------------------------------
        | KEMBALI KE CHAT
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route(
                'whisperly.chat.show',
                $booking->id
            )
            ->with(
                'status',
                'Rating berhasil dikirim.'
            );
    }
}