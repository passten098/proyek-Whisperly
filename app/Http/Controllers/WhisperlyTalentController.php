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

        return view('whisperly.talents.edit', [
            'talent' => $this->profileFor($user),
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

        $talent->deskripsi = $validated['description'];


        /*
        |--------------------------------------------------------------------------
        | UPDATE FOTO
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('photo')) {

            if (
                $talent->photo &&
                Storage::disk('public')->exists($talent->photo)
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
        |
        | Jadwal yang diedit talent hanya untuk hari ini.
        |
        */

        $today = now(
            config('app.timezone')
        )->toDateString();


        /*
        |--------------------------------------------------------------------------
        | PASTIKAN SLOT HARI INI ADA
        |--------------------------------------------------------------------------
        |
        | PENTING:
        | Query selalu menggunakan:
        |
        | talent_id
        | schedule_date
        | start_time
        | end_time
        |
        | Jadi jadwal talent A tidak bercampur dengan talent B
        | dan jadwal kemarin tidak bercampur dengan hari ini.
        |
        */

        foreach (self::SLOTS as [$start, $end]) {

            $schedule = TalentSchedule::query()
                ->where('talent_id', $talent->id)
                ->whereDate('schedule_date', $today)
                ->where('start_time', $start)
                ->where('end_time', $end)
                ->first();


            /*
            |--------------------------------------------------------------------------
            | Kalau belum ada, buat.
            |--------------------------------------------------------------------------
            */

            if (!$schedule) {

                $schedule = new TalentSchedule();

                $schedule->talent_id = $talent->id;
                $schedule->schedule_date = $today;
                $schedule->start_time = $start;
                $schedule->end_time = $end;
                $schedule->status = 'unavailable';

                $schedule->save();
            }
        }


        /*
        |--------------------------------------------------------------------------
        | AMBIL SLOT HARI INI
        |--------------------------------------------------------------------------
        */

        $schedules = TalentSchedule::query()
            ->where('talent_id', $talent->id)
            ->whereDate('schedule_date', $today)
            ->orderBy('start_time')
            ->get();


        $selected = $validated['schedule'] ?? [];


        /*
        |--------------------------------------------------------------------------
        | UPDATE STATUS JADWAL
        |--------------------------------------------------------------------------
        */

        foreach ($schedules as $schedule) {

            /*
            |--------------------------------------------------------------------------
            | JIKA SUDAH BOOKED
            |--------------------------------------------------------------------------
            |
            | Talent tidak boleh mengubah slot yang sudah dibooking.
            |
            */

            if ($schedule->status === 'booked') {
                continue;
            }


            /*
            |--------------------------------------------------------------------------
            | STATUS YANG DIPILIH TALENT
            |--------------------------------------------------------------------------
            */

            $desired = $selected[$schedule->id]
                ?? 'unavailable';


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
                $desired = 'unavailable';
            }


            $schedule->status = $desired;

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
        | AMBIL / BUAT PROFIL
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
        | TANGGAL HARI INI
        |--------------------------------------------------------------------------
        */

        $today = now(
            config('app.timezone')
        )->toDateString();


        /*
        |--------------------------------------------------------------------------
        | AMBIL SLOT YANG SUDAH ADA HARI INI
        |--------------------------------------------------------------------------
        */

        $existingSchedules = TalentSchedule::query()
            ->where('talent_id', $profile->id)
            ->whereDate('schedule_date', $today)
            ->get()
            ->keyBy(function ($schedule) {

                return
                    substr($schedule->start_time, 0, 5)
                    . '-'
                    . substr($schedule->end_time, 0, 5);
            });


        /*
        |--------------------------------------------------------------------------
        | BUAT SLOT YANG BELUM ADA
        |--------------------------------------------------------------------------
        |
        | Jangan gunakan firstOrCreate berdasarkan unique index lama.
        | Kita cek berdasarkan tanggal secara eksplisit.
        |
        */

        foreach (self::SLOTS as [$start, $end]) {

            $key = $start . '-' . $end;


            if ($existingSchedules->has($key)) {
                continue;
            }


            $schedule = new TalentSchedule();

            $schedule->talent_id = $profile->id;
            $schedule->schedule_date = $today;
            $schedule->start_time = $start;
            $schedule->end_time = $end;
            $schedule->status = 'unavailable';

            $schedule->save();
        }


        /*
        |--------------------------------------------------------------------------
        | LOAD ULANG JADWAL HARI INI SAJA
        |--------------------------------------------------------------------------
        */

        $profile->load([
            'pengguna',
            'ratings',
        ]);


        /*
        |--------------------------------------------------------------------------
        | LOAD SCHEDULE
        |--------------------------------------------------------------------------
        |
        | Jangan load semua jadwal lama.
        | Yang ditampilkan di halaman talent adalah jadwal hari ini.
        |
        */

        $profile->setRelation(
            'schedules',
            TalentSchedule::query()
                ->where('talent_id', $profile->id)
                ->whereDate('schedule_date', $today)
                ->orderBy('start_time')
                ->get()
        );


        return $profile;
    }
}