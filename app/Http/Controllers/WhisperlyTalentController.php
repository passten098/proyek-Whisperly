<?php

namespace App\Http\Controllers;

use App\Modules\pengguna\Models\pengguna;
use App\Modules\talents\Models\TalentSchedule;
use App\Modules\talents\Models\talents;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class WhisperlyTalentController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | SLOT JADWAL DEFAULT
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
        $talents = pengguna::query()
            ->where('role', 'talent')
            ->orderBy('username')
            ->get()
            ->map(function (pengguna $user) {
                return $this->profileFor($user);
            });

        return view(
            'whisperly.talents.index',
            compact('talents')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | DETAIL / LIHAT PROFIL TALENT
    |--------------------------------------------------------------------------
    */

    public function show(string $username): View
    {
        $user = pengguna::query()
            ->where('role', 'talent')
            ->where('username', $username)
            ->firstOrFail();

        return view('whisperly.talents.show', [
            'talent' => $this->profileFor($user),
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | PROFIL SENDIRI MILIK TALENT
    |--------------------------------------------------------------------------
    */

    public function own(Request $request): View
    {
        $user = $request->user('whisperly');

        abort_unless(
            $user && $user->role === 'talent',
            403
        );

        return view('talent', [
            'talent' => $this->profileFor($user),
            'user' => $user,
        ]);
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
                return $this->profileFor($user);
            });

        return view('admin', compact('talents'));
    }


    /*
    |--------------------------------------------------------------------------
    | HALAMAN EDIT PROFIL
    |--------------------------------------------------------------------------
    */

    public function edit(Request $request): View
    {
        $user = $request->user('whisperly');

        abort_unless(
            $user && $user->role === 'talent',
            403
        );

        $talent = $this->profileFor($user);

        return view('whisperly.talents.edit', [
            'talent' => $talent,
            'user' => $user,
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | UPDATE PROFIL + FOTO + JADWAL
    |--------------------------------------------------------------------------
    */

    public function update(Request $request): RedirectResponse
    {
        $user = $request->user('whisperly');

        /*
        |--------------------------------------------------------------------------
        | Pastikan yang mengakses memang talent
        |--------------------------------------------------------------------------
        */

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
                'in:available,unavailable,booked',
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | AMBIL PROFIL TALENT
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

            /*
            | Hapus foto custom lama
            */

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


            /*
            | Simpan foto baru
            */

            $talent->photo =
                $request
                    ->file('photo')
                    ->store(
                        'talent-profiles',
                        'public'
                    );
        }


        /*
        |--------------------------------------------------------------------------
        | SIMPAN TALENT
        |--------------------------------------------------------------------------
        */

        $talent->save();


        /*
        |--------------------------------------------------------------------------
        | UPDATE JADWAL
        |--------------------------------------------------------------------------
        */

        if (
            isset($validated['schedule']) &&
            is_array($validated['schedule'])
        ) {

            foreach ($talent->schedules as $schedule) {

                $scheduleId = $schedule->id;


                if (
                    !array_key_exists(
                        $scheduleId,
                        $validated['schedule']
                    )
                ) {
                    continue;
                }


                /*
                | Jadwal yang sudah dibooking
                | tidak boleh diubah.
                */

                if (
                    $schedule->status === 'booked'
                ) {
                    continue;
                }


                $newStatus =
                    $validated['schedule'][$scheduleId];


                /*
                | Jangan izinkan status booked
                | dibuat manual dari halaman edit.
                */

                if ($newStatus === 'booked') {
                    continue;
                }


                $schedule->update([
                    'status' => $newStatus,
                ]);
            }
        }


        /*
        |--------------------------------------------------------------------------
        | KEMBALI KE HALAMAN EDIT
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('talent.edit')
            ->with(
                'status',
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
        | Ambil / buat profil talent
        |--------------------------------------------------------------------------
        */

        $profile = talents::firstOrCreate(
            [
                'pengguna_id' => $user->id,
            ],
            [
                'deskripsi' =>
                    'Belum ada deskripsi talent.',
            ]
        );


        /*
        |--------------------------------------------------------------------------
        | Buat slot jadwal default
        |--------------------------------------------------------------------------
        */

        foreach (self::SLOTS as [$start, $end]) {

            TalentSchedule::firstOrCreate(
                [
                    'talent_id' =>
                        $profile->id,

                    'start_time' =>
                        $start,

                    'end_time' =>
                        $end,
                ],
                [
                    'status' =>
                        'unavailable',
                ]
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Load relasi
        |--------------------------------------------------------------------------
        */

        return $profile->load([
            'pengguna',
            'schedules',
            'ratings',
        ]);
    }
}