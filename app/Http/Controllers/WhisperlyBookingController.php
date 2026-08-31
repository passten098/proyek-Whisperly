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

        $user =
            $request->user('whisperly');


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

        $talent =
            pengguna::query()
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

        $profile =
            talents::query()
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

            $booking =
                DB::transaction(
                    function () use (
                        $request,
                        $user,
                        $profile
                    ) {


                        /*
                        |--------------------------------------------------------------------------
                        | LOCK JADWAL
                        |--------------------------------------------------------------------------
                        */

                        $schedule =
                            TalentSchedule::query()
                                ->where(
                                    'id',
                                    $request->input(
                                        'schedule_id'
                                    )
                                )
                                ->where(
                                    'talent_id',
                                    $profile->id
                                )
                                ->lockForUpdate()
                                ->first();


                        /*
                        |--------------------------------------------------------------------------
                        | JADWAL TIDAK DITEMUKAN
                        |--------------------------------------------------------------------------
                        */

                        if (!$schedule) {

                            return null;
                        }


                        /*
                        |--------------------------------------------------------------------------
                        | CEK WAKTU SEKARANG
                        |--------------------------------------------------------------------------
                        */

                        $now =
                            now();


                        $startTime =
                            \Carbon\Carbon::today()
                                ->setTimeFromTimeString(
                                    $schedule->start_time
                                );


                        $endTime =
                            \Carbon\Carbon::today()
                                ->setTimeFromTimeString(
                                    $schedule->end_time
                                );


                        /*
                        |--------------------------------------------------------------------------
                        | JADWAL SUDAH LEWAT
                        |--------------------------------------------------------------------------
                        */

                        if (
                            $endTime
                                ->lessThanOrEqualTo($now)
                        ) {

                            return null;
                        }


                        /*
                        |--------------------------------------------------------------------------
                        | CARI BOOKING AKTIF HARI INI
                        |
                        | BOOKING KEMARIN TIDAK DIHITUNG.
                        |--------------------------------------------------------------------------
                        */

                        $existingBooking =
                            WhisperlyBooking::query()
                                ->where(
                                    'schedule_id',
                                    $schedule->id
                                )
                                ->whereDate(
                                    'created_at',
                                    today()
                                )
                                ->whereNull(
                                    'deleted_at'
                                )
                                ->lockForUpdate()
                                ->first();


                        /*
                        |--------------------------------------------------------------------------
                        | SUDAH DIBOOKING USER LAIN
                        |--------------------------------------------------------------------------
                        */

                        if (
                            $existingBooking &&
                            $existingBooking->pengguna_id
                                !== $user->id
                        ) {

                            return null;
                        }


                        /*
                        |--------------------------------------------------------------------------
                        | USER YANG SAMA SUDAH BOOKING
                        |--------------------------------------------------------------------------
                        */

                        if (
                            $existingBooking &&
                            $existingBooking->pengguna_id
                                === $user->id
                        ) {

                            return $existingBooking;
                        }


                        /*
                        |--------------------------------------------------------------------------
                        | BUAT BOOKING BARU
                        |--------------------------------------------------------------------------
                        */

                        $booking =
                            WhisperlyBooking::create([
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
                        | UPDATE STATUS SCHEDULE
                        |--------------------------------------------------------------------------
                        */

                        $schedule->update([
                            'status' =>
                                'booked',
                        ]);


                        /*
                        |--------------------------------------------------------------------------
                        | SINKRONISASI KE LARALAG
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
            |
            | BISA TERJADI KARENA:
            |
            | 1. Jadwal sudah dibooking orang lain.
            | 2. Jadwal sudah lewat.
            | 3. User lain berhasil booking sepersekian detik
            |    sebelum request ini.
            |
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
                    'Booking berhasil! Silakan tunggu sampai booking dikonfirmasi.'
                );


        } catch (\Throwable $e) {

            /*
            |--------------------------------------------------------------------------
            | JANGAN TAMPILKAN 500 KEPADA USER
            |--------------------------------------------------------------------------
            |
            | Kalau terjadi race condition / database exception,
            | user tetap dikembalikan ke halaman talent.
            |
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
                    'booking_error',
                    'Maaf, jadwal tersebut baru saja diambil oleh pengguna lain. Silakan pilih jadwal lain.'
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


        /*
        |--------------------------------------------------------------------------
        | CEK PEMILIK BOOKING
        |--------------------------------------------------------------------------
        */

        abort_unless(
            $user &&
            $booking->pengguna_id === $user->id,
            403,
            'Anda tidak berhak memberi rating untuk booking ini.'
        );


        /*
        |--------------------------------------------------------------------------
        | RATING SETELAH CHAT SELESAI
        |--------------------------------------------------------------------------
        */

        abort_unless(
            $booking->chatStatus() === 'completed',
            422,
            'Rating hanya dapat diberikan setelah booking selesai.'
        );


        /*
        |--------------------------------------------------------------------------
        | VALIDASI
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
        | CEK SUDAH RATING
        |--------------------------------------------------------------------------
        */

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


        /*
        |--------------------------------------------------------------------------
        | SIMPAN RATING
        |--------------------------------------------------------------------------
        */

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


        /*
        |--------------------------------------------------------------------------
        | UPDATE STATUS BOOKING
        |--------------------------------------------------------------------------
        */

        $booking->update([
            'status' =>
                'completed',
        ]);


        /*
        |--------------------------------------------------------------------------
        | SINKRONISASI
        |--------------------------------------------------------------------------
        */

        $booking->syncLaralagBooking(
            true
        );


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