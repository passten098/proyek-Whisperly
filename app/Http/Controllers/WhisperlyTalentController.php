<?php

namespace App\Http\Controllers;

use App\Modules\pengguna\Models\pengguna;
use App\Modules\talents\Models\TalentSchedule;
use App\Modules\talents\Models\talents;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class WhisperlyTalentController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | SLOT JADWAL
    |--------------------------------------------------------------------------
    */

    private const SLOTS = [
        ['08:00', '09:00'],
        ['09:00', '10:00'],
        ['10:00', '11:00'],
        ['11:00', '12:00'],

        ['13:00', '14:00'],
        ['14:00', '15:00'],
        ['15:00', '16:00'],
        ['16:00', '17:00'],
        ['17:00', '18:00'],
        ['18:00', '19:00'],
        ['19:00', '20:00'],
        ['20:00', '21:00'],
        ['21:00', '22:00'],
    ];


    /*
    |--------------------------------------------------------------------------
    | DAFTAR TALENT
    |--------------------------------------------------------------------------
    */

    public function index(): View
    {
        /*
         * Ambil semua akun yang memiliki role talent.
         */
        $users = pengguna::query()
            ->where('role', 'talent')
            ->orderBy('username')
            ->get();


        /*
         * Buat profile talent untuk setiap user.
         *
         * Penting:
         * Relasi pengguna pada profile dipaksa menggunakan
         * user yang sedang diproses agar tidak tertukar.
         */
        $talents = $users->map(function (pengguna $user) {

            $profile = $this->profileFor($user);

            $profile->setRelation(
                'pengguna',
                $user
            );

            return $profile;
        });


        return view(
            'whisperly.talents.index',
            compact('talents')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | DETAIL TALENT
    |--------------------------------------------------------------------------
    */

    public function show(string $username): View
    {
        $user = pengguna::query()
            ->where('role', 'talent')
            ->where('username', $username)
            ->firstOrFail();


        return view(
            'whisperly.talents.show',
            [
                'talent' => $this->profileFor($user),
            ]
        );
    }


    /*
    |--------------------------------------------------------------------------
    | PROFIL TALENT SENDIRI
    |--------------------------------------------------------------------------
    */

    public function own(Request $request): View
    {
        $user = $request->user('whisperly');


        abort_unless(
            $user && $user->role === 'talent',
            403
        );


        return view(
            'talent',
            [
                'talent' => $this->profileFor($user),
                'user' => $user,
            ]
        );
    }


    /*
    |--------------------------------------------------------------------------
    | ADMIN
    |--------------------------------------------------------------------------
    */

    public function admin(): View
    {
        $talents = pengguna::query()
            ->where('role', 'talent')
            ->orderBy('username')
            ->get()
            ->map(function (pengguna $user) {

                $profile = $this->profileFor($user);

                $profile->setRelation(
                    'pengguna',
                    $user
                );

                return $profile;
            });


        return view(
            'admin',
            compact('talents')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | EDIT PROFIL TALENT
    |--------------------------------------------------------------------------
    */

    public function edit(Request $request): View
    {
        $user = $request->user('whisperly');


        abort_unless(
            $user && $user->role === 'talent',
            403
        );


        return view(
            'whisperly.talents.edit',
            [
                'talent' => $this->profileFor($user),
                'user' => $user,
            ]
        );
    }


    /*
    |--------------------------------------------------------------------------
    | UPDATE PROFIL + FOTO + JADWAL
    |--------------------------------------------------------------------------
    */

    public function update(Request $request): RedirectResponse
    {
        $user = $request->user('whisperly');


        abort_unless(
            $user && $user->role === 'talent',
            403
        );


        /*
        |--------------------------------------------------------------------------
        | VALIDASI
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([
            'description' => [
                'required',
                'string',
                'max:2000',
            ],

            'photo' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],

            'schedule' => [
                'nullable',
                'array',
            ],

            'schedule.*' => [
                'nullable',
                'in:available,unavailable',
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | AMBIL / BUAT PROFIL TALENT
        |--------------------------------------------------------------------------
        */

        $talent = talents::firstOrCreate(
            [
                'pengguna_id' => $user->id,
            ],
            [
                'deskripsi' => 'Belum ada deskripsi talent.',
            ]
        );


        /*
        |--------------------------------------------------------------------------
        | UPDATE DESKRIPSI
        |--------------------------------------------------------------------------
        */

        $talent->deskripsi =
            $validated['description'];


        /*
        |--------------------------------------------------------------------------
        | UPDATE FOTO
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('photo')) {

            if (
                $talent->photo &&
                Storage::disk('public')->exists(
                    $talent->photo
                )
            ) {
                Storage::disk('public')->delete(
                    $talent->photo
                );
            }


            $talent->photo = $request
                ->file('photo')
                ->store(
                    'talent-profiles',
                    'public'
                );
        }


        $talent->save();


        /*
        |--------------------------------------------------------------------------
        | TANGGAL HARI INI
        |--------------------------------------------------------------------------
        */

        $timezone = config('app.timezone');

        $now = now($timezone);

        $today = $now->toDateString();


        /*
        |--------------------------------------------------------------------------
        | PASTIKAN SEMUA SLOT HARI INI ADA
        |--------------------------------------------------------------------------
        */

        foreach (
            self::SLOTS
            as [$start, $end]
        ) {

            $schedule = TalentSchedule::query()
                ->where(
                    'talent_id',
                    $talent->id
                )
                ->whereDate(
                    'schedule_date',
                    $today
                )
                ->where(
                    'start_time',
                    $start
                )
                ->where(
                    'end_time',
                    $end
                )
                ->first();


            if ($schedule) {
                continue;
            }


            $schedule = new TalentSchedule();

            $schedule->talent_id =
                $talent->id;

            $schedule->schedule_date =
                $today;

            $schedule->start_time =
                $start;

            $schedule->end_time =
                $end;

            $schedule->status =
                'unavailable';

            $schedule->save();
        }


        /*
        |--------------------------------------------------------------------------
        | AMBIL SLOT HARI INI
        |--------------------------------------------------------------------------
        */

        $schedules = TalentSchedule::query()
            ->where(
                'talent_id',
                $talent->id
            )
            ->whereDate(
                'schedule_date',
                $today
            )
            ->orderBy(
                'start_time'
            )
            ->get();


        /*
        |--------------------------------------------------------------------------
        | DATA YANG DIKIRIM FORM
        |--------------------------------------------------------------------------
        */

        $selected =
            $validated['schedule'] ?? [];


        /*
        |--------------------------------------------------------------------------
        | UPDATE STATUS JADWAL
        |--------------------------------------------------------------------------
        */

        foreach ($schedules as $schedule) {

            /*
            |--------------------------------------------------------------------------
            | SUDAH BOOKED
            |--------------------------------------------------------------------------
            */

            if (
                $schedule->status === 'booked'
            ) {
                continue;
            }


            /*
            |--------------------------------------------------------------------------
            | CEK WAKTU
            |--------------------------------------------------------------------------
            */

            $scheduleDate =
                Carbon::parse(
                    $schedule->schedule_date,
                    $timezone
                )->toDateString();


            $scheduleStart =
                Carbon::parse(
                    $scheduleDate .
                    ' ' .
                    $schedule->start_time,
                    $timezone
                );


            $scheduleEnd =
                Carbon::parse(
                    $scheduleDate .
                    ' ' .
                    $schedule->end_time,
                    $timezone
                );


            /*
             * Untuk jadwal yang melewati tengah malam.
             */
            if (
                $scheduleEnd->lt(
                    $scheduleStart
                )
            ) {
                $scheduleEnd->addDay();
            }


            /*
            |--------------------------------------------------------------------------
            | SUDAH LEWAT
            |--------------------------------------------------------------------------
            */

            if (
                $scheduleEnd->lessThanOrEqualTo(
                    $now
                )
            ) {
                continue;
            }


            /*
            |--------------------------------------------------------------------------
            | ID TIDAK DIKIRIM
            |--------------------------------------------------------------------------
            */

            if (
                !array_key_exists(
                    $schedule->id,
                    $selected
                )
            ) {
                continue;
            }


            /*
            |--------------------------------------------------------------------------
            | STATUS YANG DIPILIH
            |--------------------------------------------------------------------------
            */

            $desired =
                $selected[$schedule->id];


            /*
            |--------------------------------------------------------------------------
            | VALIDASI STATUS
            |--------------------------------------------------------------------------
            */

            if (
                !in_array(
                    $desired,
                    [
                        'available',
                        'unavailable',
                    ],
                    true
                )
            ) {
                continue;
            }


            /*
            |--------------------------------------------------------------------------
            | SIMPAN
            |--------------------------------------------------------------------------
            */

            $schedule->status =
                $desired;

            $schedule->save();
        }


        /*
        |--------------------------------------------------------------------------
        | SELESAI
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('talent.edit')
            ->with(
                'success',
                'Profil, foto, dan jadwal berhasil diperbarui.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | PROFILE TALENT
    |--------------------------------------------------------------------------
    */

    private function profileFor(
        pengguna $user
    ): talents {

        /*
        |--------------------------------------------------------------------------
        | AMBIL / BUAT PROFIL
        |--------------------------------------------------------------------------
        */

        $profile = talents::firstOrCreate(
            [
                'pengguna_id' =>
                    $user->id,
            ],
            [
                'deskripsi' =>
                    'Belum ada deskripsi talent.',
            ]
        );


        /*
        |--------------------------------------------------------------------------
        | TANGGAL HARI INI
        |--------------------------------------------------------------------------
        */

        $timezone =
            config('app.timezone');


        $today =
            now($timezone)
                ->toDateString();


        /*
        |--------------------------------------------------------------------------
        | JADWAL YANG SUDAH ADA
        |--------------------------------------------------------------------------
        */

        $existingSchedules =
            TalentSchedule::query()
                ->where(
                    'talent_id',
                    $profile->id
                )
                ->whereDate(
                    'schedule_date',
                    $today
                )
                ->get()
                ->keyBy(
                    function ($schedule) {

                        return
                            substr(
                                $schedule->start_time,
                                0,
                                5
                            )
                            . '-'
                            .
                            substr(
                                $schedule->end_time,
                                0,
                                5
                            );
                    }
                );


        /*
        |--------------------------------------------------------------------------
        | BUAT SLOT YANG BELUM ADA
        |--------------------------------------------------------------------------
        */

        foreach (
            self::SLOTS
            as [$start, $end]
        ) {

            $key =
                $start .
                '-' .
                $end;


            if (
                $existingSchedules->has($key)
            ) {
                continue;
            }


            $schedule =
                new TalentSchedule();


            $schedule->talent_id =
                $profile->id;


            $schedule->schedule_date =
                $today;


            $schedule->start_time =
                $start;


            $schedule->end_time =
                $end;


            $schedule->status =
                'unavailable';


            $schedule->save();
        }


        /*
        |--------------------------------------------------------------------------
        | LOAD RELATION
        |--------------------------------------------------------------------------
        */

        $profile->load([
            'pengguna',
            'ratings',
        ]);


        /*
        |--------------------------------------------------------------------------
        | LOAD JADWAL HARI INI
        |--------------------------------------------------------------------------
        */

        $profile->setRelation(
            'schedules',
            TalentSchedule::query()
                ->where(
                    'talent_id',
                    $profile->id
                )
                ->whereDate(
                    'schedule_date',
                    $today
                )
                ->orderBy(
                    'start_time'
                )
                ->get()
        );


        return $profile;
    }
}