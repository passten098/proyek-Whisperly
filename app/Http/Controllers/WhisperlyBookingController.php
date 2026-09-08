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
                    |
                    | Tidak menggunakan schedule_date karena tabel
                    | talent_schedules sekarang hanya menyimpan:
                    |
                    | id
                    | talent_id
                    | start_time
                    | end_time
                    | status
                    |
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
                    | CEK STATUS JADWAL
                    |--------------------------------------------------------------------------
                    */

                    if ($schedule->status !== 'available') {
                        return null;
                    }


                    /*
                    |--------------------------------------------------------------------------
                    | CEK JAM SUDAH LEWAT ATAU BELUM
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
                    | CEK APAKAH JAM SUDAH DIBOOKING
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

                        /*
                        |--------------------------------------------------------------------------
                        | KALAU SUDAH PERNAH DIBOOKING USER YANG SAMA
                        |--------------------------------------------------------------------------
                        */

                        if (
                            $existingBooking->pengguna_id ===
                            $user->id
                        ) {
                            return $existingBooking;
                        }


                        /*
                        |--------------------------------------------------------------------------
                        | SUDAH DIBOOKING USER LAIN
                        |--------------------------------------------------------------------------
                        */

                        return null;
                    }


                    /*
                    |--------------------------------------------------------------------------
                    | BUAT BOOKING
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
                    | UBAH STATUS JADWAL
                    |--------------------------------------------------------------------------
                    |
                    | available → booked
                    |
                    |--------------------------------------------------------------------------
                    */

                    $schedule->update([
                        'status' => 'booked',
                    ]);


                    /*
                    |--------------------------------------------------------------------------
                    | SINKRONISASI BOOKING
                    |--------------------------------------------------------------------------
                    */

                    $booking->syncLaralagBooking(true);


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
                            'username' => $username
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
            |
            | Data booking_success dan booking_id tetap dikirim
            | supaya popup booking yang sudah kamu buat sebelumnya
            | tetap bisa membaca hasil booking.
            |
            |--------------------------------------------------------------------------
            */

            return redirect()
                ->route(
                    'whisperly.talents.show',
                    [
                        'username' => $username
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

            /*
            |--------------------------------------------------------------------------
            | JANGAN TAMPILKAN ERROR 500 KE USER
            |--------------------------------------------------------------------------
            */

            return redirect()
                ->route(
                    'whisperly.talents.show',
                    [
                        'username' => $username
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

        $user = $request->user('whisperly');


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

        $alreadyRated = ratings::query()
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