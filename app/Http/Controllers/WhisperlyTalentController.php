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
            ->map(fn (pengguna $user) => $this->profileFor($user));

        return view('whisperly.talents.index', compact('talents'));
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

        return view('whisperly.talents.show', [
            'talent' => $this->profileFor($user),
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | HALAMAN SENDIRI TALENT
    |--------------------------------------------------------------------------
    |
    | Talent tidak melihat daftar talent.
    | Talent langsung melihat profil miliknya sendiri.
    |
    */

    public function own(Request $request): View
    {
        $user = $request->user('whisperly');

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
            ->map(fn (pengguna $user) => $this->profileFor($user));

        return view('admin', compact('talents'));
    }


    /*
    |--------------------------------------------------------------------------
    | EDIT PROFIL TALENT
    |--------------------------------------------------------------------------
    */

    public function edit(Request $request): View
    {
        $user = $request->user('whisperly');

        $talent = $this->profileFor($user);

        return view('whisperly.talents.edit', [
            'talent' => $talent,
            'user' => $user,
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | UPDATE PROFIL + JADWAL
    |--------------------------------------------------------------------------
    */

    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'description' => [
                'required',
                'string',
                'max:2000'
            ],

            'photo' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048'
            ],

            'schedule' => [
                'required',
                'array'
            ],

            'schedule.*' => [
                'required',
                'in:available,unavailable,booked'
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | USER LOGIN TALENT
        |--------------------------------------------------------------------------
        */

        $user = $request->user('whisperly');


        /*
        |--------------------------------------------------------------------------
        | AMBIL PROFIL TALENT MILIK USER LOGIN
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

        $talent->deskripsi = $request
            ->string('description')
            ->toString();


        /*
        |--------------------------------------------------------------------------
        | UPDATE FOTO
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('photo')) {

            if ($talent->photo) {
                Storage::disk('public')->delete($talent->photo);
            }

            $talent->photo = $request
                ->file('photo')
                ->store('talent-profiles', 'public');
        }


        /*
        |--------------------------------------------------------------------------
        | SIMPAN PROFIL
        |--------------------------------------------------------------------------
        */

        $talent->save();


        /*
        |--------------------------------------------------------------------------
        | UPDATE JADWAL
        |--------------------------------------------------------------------------
        */

        foreach ($talent->schedules as $schedule) {

            $field = "schedule.{$schedule->id}";

            if ($request->has($field)) {

                /*
                | Jangan ubah slot yang sudah dibooking.
                */

                if ($schedule->status !== 'booked') {

                    $schedule->update([
                        'status' => $request->input($field)
                    ]);
                }
            }
        }


        /*
        |--------------------------------------------------------------------------
        | KEMBALI KE EDIT PROFIL
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('talent.edit')
            ->with(
                'status',
                'Profil dan jadwal berhasil diperbarui.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | PROFILE TALENT
    |--------------------------------------------------------------------------
    */

    private function profileFor(pengguna $user): talents
    {
        /*
        |--------------------------------------------------------------------------
        | CARI PROFIL BERDASARKAN PENGGUNA_ID
        |--------------------------------------------------------------------------
        */

        $profile = talents::firstOrCreate(
            [
                'pengguna_id' => $user->id
            ],
            [
                'deskripsi' => 'Belum ada deskripsi talent.'
            ]
        );


        /*
        |--------------------------------------------------------------------------
        | BUAT SLOT JADWAL
        |--------------------------------------------------------------------------
        */

        foreach (self::SLOTS as [$start, $end]) {

            TalentSchedule::firstOrCreate(
                [
                    'talent_id' => $profile->id,
                    'start_time' => $start,
                    'end_time' => $end,
                ],
                [
                    'status' => 'unavailable'
                ]
            );
        }


        /*
        |--------------------------------------------------------------------------
        | LOAD RELATIONSHIP
        |--------------------------------------------------------------------------
        */

        return $profile->load([
            'pengguna',
            'schedules',
            'ratings'
        ]);
    }
}