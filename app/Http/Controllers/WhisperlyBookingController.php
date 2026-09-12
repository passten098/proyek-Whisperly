<?php

namespace App\Http\Controllers;

use App\Modules\bookings\Models\WhisperlyBooking;
use App\Modules\ratings\Models\ratings;
use App\Modules\talents\Models\TalentSchedule;
use App\Modules\pengguna\Models\pengguna;
use App\Modules\talents\Models\talents;
use App\Modules\chat\Models\WhisperlyChatUserState;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WhisperlyBookingController extends Controller
{
    /**
     * ============================================================
     * CONFIRM BOOKING
     * ============================================================
     */
    public function store(
        Request $request,
        string $username
    ): RedirectResponse {

        /*
        |--------------------------------------------------------------------------
        | VALIDASI
        |--------------------------------------------------------------------------
        */

        $request->validate([
            'schedule_id' => [
                'required',
                'uuid',
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | USER LOGIN
        |--------------------------------------------------------------------------
        */

        $user = $request->user('whisperly');

        if (!$user) {

            return redirect()
                ->route('login.baru')
                ->with(
                    'booking_error',
                    'Silakan login terlebih dahulu.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | CARI TALENT
        |--------------------------------------------------------------------------
        */

        $talent = pengguna::query()
            ->where(
                'username',
                $username
            )
            ->where(
                'role',
                'talent'
            )
            ->first();

        if (!$talent) {

            return redirect()
                ->route(
                    'whisperly.talents.index'
                )
                ->with(
                    'booking_error',
                    'Talent tidak ditemukan.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | CARI PROFILE TALENT
        |--------------------------------------------------------------------------
        */

        $profile = talents::query()
            ->where(
                'pengguna_id',
                $talent->id
            )
            ->first();

        if (!$profile) {

            return redirect()
                ->route(
                    'whisperly.talents.index'
                )
                ->with(
                    'booking_error',
                    'Profil talent tidak ditemukan.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | PROSES BOOKING
        |--------------------------------------------------------------------------
        */

        try {

            $booking = DB::transaction(
                function () use (
                    $request,
                    $user,
                    $profile
                ) {

                    /*
                    |--------------------------------------------------------------------------
                    | CARI JADWAL
                    |--------------------------------------------------------------------------
                    */

                    $schedule = TalentSchedule::query()
                        ->where(
                            'id',
                            $request->input('schedule_id')
                        )
                        ->where(
                            'talent_id',
                            $profile->id
                        )
                        ->lockForUpdate()
                        ->first();

                    if (!$schedule) {
                        return null;
                    }

                    /*
                    |--------------------------------------------------------------------------
                    | CEK STATUS JADWAL
                    |--------------------------------------------------------------------------
                    */

                    if ($schedule->status !== 'available') {
                        return null;
                    }

                    /*
                    |--------------------------------------------------------------------------
                    | CEK JAM
                    |--------------------------------------------------------------------------
                    */

                    $now = now(
                        config('app.timezone')
                    );

                    $endTime = \Carbon\Carbon::parse(
                        $schedule->end_time,
                        config('app.timezone')
                    )->setDate(
                        $now->year,
                        $now->month,
                        $now->day
                    );

                    if ($endTime->lessThanOrEqualTo($now)) {
                        return null;
                    }

                    /*
                    |--------------------------------------------------------------------------
                    | CEK BOOKING LAMA
                    |--------------------------------------------------------------------------
                    */

                    $existingBooking = WhisperlyBooking::query()
                        ->where(
                            'schedule_id',
                            $schedule->id
                        )
                        ->whereNull('deleted_at')
                        ->lockForUpdate()
                        ->first();

                    if ($existingBooking) {

                        if (
                            $existingBooking->pengguna_id ===
                            $user->id
                        ) {
                            return $existingBooking;
                        }

                        return null;
                    }

                    /*
                    |--------------------------------------------------------------------------
                    | BUAT BOOKING BARU
                    |--------------------------------------------------------------------------
                    */

                    $booking = WhisperlyBooking::create([
                        'pengguna_id' =>
                            $user->id,

                        'talent_id' =>
                            $profile->id,

                        'schedule_id' =>
                            $schedule->id,

                        'status' =>
                            'upcoming',
                    ]);

                    /*
                    |--------------------------------------------------------------------------
                    | RESET CHAT USER
                    |--------------------------------------------------------------------------
                    |
                    | Booking baru berarti chat boleh digunakan kembali.
                    |
                    | deleted_at = null
                    | cleared_at = waktu booking baru
                    |
                    | Dengan cleared_at, pesan dari chat lama
                    | tidak akan ditampilkan lagi.
                    |--------------------------------------------------------------------------
                    */

                    $userChatState =
                        WhisperlyChatUserState::firstOrCreate([
                            'user_id' =>
                                $user->id,

                            'contact_user_id' =>
                                $profile->pengguna_id,
                        ]);

                    $userChatState->forceFill([
                        'deleted_at' =>
                            null,

                        'cleared_at' =>
                            now(),
                    ])->save();

                    /*
                    |--------------------------------------------------------------------------
                    | RESET CHAT DI SISI TALENT
                    |--------------------------------------------------------------------------
                    */

                    $talentChatState =
                        WhisperlyChatUserState::firstOrCreate([
                            'user_id' =>
                                $profile->pengguna_id,

                            'contact_user_id' =>
                                $user->id,
                        ]);

                    $talentChatState->forceFill([
                        'deleted_at' =>
                            null,

                        'cleared_at' =>
                            now(),
                    ])->save();

                    /*
                    |--------------------------------------------------------------------------
                    | UBAH STATUS JADWAL
                    |--------------------------------------------------------------------------
                    */

                    $schedule->update([
                        'status' =>
                            'booked',
                    ]);

                    /*
                    |--------------------------------------------------------------------------
                    | SINKRONISASI BOOKING
                    |--------------------------------------------------------------------------
                    */

                    $booking->syncLaralagBooking(
                        true
                    );

                    return $booking;
                }
            );

            /*
            |--------------------------------------------------------------------------
            | BOOKING GAGAL
            |--------------------------------------------------------------------------
            */

            if (!$booking) {

                return redirect()
                    ->route(
                        'whisperly.talents.show',
                        [
                            'username' =>
                                $username
                        ]
                    )
                    ->with(
                        'booking_error',
                        'Maaf, jadwal tersebut sudah tidak tersedia. Silakan pilih jadwal lain yang masih berwarna hijau.'
                    );
            }

            /*
            |--------------------------------------------------------------------------
            | BOOKING BERHASIL
            |--------------------------------------------------------------------------
            */

            return redirect()
                ->route(
                    'whisperly.talents.show',
                    [
                        'username' =>
                            $username
                    ]
                )
                ->with(
                    'booking_success',
                    true
                )
                ->with(
                    'booking_id',
                    $booking->id
                )
                ->with(
                    'status',
                    'Booking berhasil! Kamu sekarang bisa chat dengan talent.'
                );

        } catch (\Throwable $e) {

            return redirect()
                ->route(
                    'whisperly.talents.show',
                    [
                        'username' =>
                            $username
                    ]
                )
                ->with(
                    'booking_error',
                    'Maaf, terjadi kesalahan saat melakukan booking. Silakan coba lagi.'
                );
        }
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

        $user =
            $request->user('whisperly');

        abort_unless(
            $user &&
            $booking->pengguna_id === $user->id,
            403,
            'Anda tidak berhak memberi rating untuk booking ini.'
        );

        abort_unless(
            $booking->chatStatus() === 'completed',
            422,
            'Rating hanya dapat diberikan setelah booking selesai.'
        );

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

        $alreadyRated =
            ratings::query()
                ->where(
                    'booking_id',
                    $booking->id
                )
                ->where(
                    'pengguna_id',
                    $user->id
                )
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

        ratings::create([

            'booking_id' =>
                $booking->id,

            'pengguna_id' =>
                $user->id,

            'talent_id' =>
                $booking->talent_id,

            'nilai_rating' =>
                $request->input(
                    'rating'
                ),

            'ulasan' =>
                trim(
                    (string)
                    $request->input(
                        'ulasan',
                        ''
                    )
                ),

        ]);

        $booking->update([
            'status' =>
                'completed',
        ]);

        $booking->syncLaralagBooking(
            true
        );

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