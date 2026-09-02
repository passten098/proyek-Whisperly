<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('pengguna') || ! Schema::hasTable('categories')) {
            return;
        }

        DB::transaction(function (): void {
            $now = now();

            $admin = DB::table('pengguna')
                ->where('username', 'admin')
                ->first();

            $adminData = [
                'email' => 'admin@whisperly.test',
                'password' => Hash::make('nabila123'),
                'role' => 'admin',
                'updated_at' => $now,
                'deleted_at' => null,
            ];

            if ($admin) {
                DB::table('pengguna')
                    ->where('id', $admin->id)
                    ->update($adminData);
            } else {
                $adminId = (string) Str::uuid();

                DB::table('pengguna')->insert([
                    'id' => $adminId,
                    'username' => 'admin',
                    ...$adminData,
                    'created_at' => $now,
                ]);
            }

            foreach (['sedih', 'horror', 'campuran', 'cinta'] as $categoryName) {
                $category = DB::table('categories')
                    ->where('jenis_kategori', $categoryName)
                    ->first();

                if ($category) {
                    DB::table('categories')
                        ->where('id', $category->id)
                        ->update([
                            'deleted_at' => null,
                            'updated_at' => $now,
                        ]);
                } else {
                    DB::table('categories')->insert([
                        'id' => (string) Str::uuid(),
                        'jenis_kategori' => $categoryName,
                        'created_at' => $now,
                        'updated_at' => $now,
                    ]);
                }
            }

            if (! Schema::hasTable('talents') || ! Schema::hasTable('talent_schedules')) {
                return;
            }

            $talentUser = DB::table('pengguna')
                ->where('username', 'talent')
                ->first();

            $talentData = [
                'email' => 'talent@whisperly.test',
                'password' => Hash::make('talent123'),
                'role' => 'talent',
                'updated_at' => $now,
                'deleted_at' => null,
            ];

            if ($talentUser) {
                DB::table('pengguna')
                    ->where('id', $talentUser->id)
                    ->update($talentData);
            } else {
                $talentUserId = (string) Str::uuid();

                DB::table('pengguna')->insert([
                    'id' => $talentUserId,
                    'username' => 'talent',
                    ...$talentData,
                    'created_at' => $now,
                ]);

                $talentUser = (object) ['id' => $talentUserId];
            }

            $talent = DB::table('talents')
                ->where('pengguna_id', $talentUser->id)
                ->first();

            $talentData = [
                'deskripsi' => 'Talent Whisperly untuk konsultasi dan berbagi cerita.',
                'updated_at' => $now,
                'deleted_at' => null,
            ];

            if ($talent) {
                DB::table('talents')
                    ->where('id', $talent->id)
                    ->update($talentData);
            } else {
                $talentId = (string) Str::uuid();

                DB::table('talents')->insert([
                    'id' => $talentId,
                    'pengguna_id' => $talentUser->id,
                    ...$talentData,
                    'created_at' => $now,
                ]);

                $talent = (object) ['id' => $talentId];
            }

            $today = Carbon::now(config('app.timezone'))->toDateString();
            $slots = [
                ['08:00:00', '09:00:00'],
                ['09:00:00', '10:00:00'],
                ['10:00:00', '11:00:00'],
                ['11:00:00', '12:00:00'],
                ['13:00:00', '14:00:00'],
                ['14:00:00', '15:00:00'],
                ['15:00:00', '16:00:00'],
                ['16:00:00', '17:00:00'],
                ['17:00:00', '18:00:00'],
                ['18:00:00', '19:00:00'],
                ['19:00:00', '20:00:00'],
                ['20:00:00', '21:00:00'],
                ['21:00:00', '22:00:00'],
            ];

            foreach ($slots as [$startTime, $endTime]) {
                $schedule = DB::table('talent_schedules')
                    ->where('talent_id', $talent->id)
                    ->where('schedule_date', $today)
                    ->where('start_time', $startTime)
                    ->where('end_time', $endTime)
                    ->first();

                if ($schedule) {
                    DB::table('talent_schedules')
                        ->where('id', $schedule->id)
                        ->update([
                            'deleted_at' => null,
                            'updated_at' => $now,
                        ]);
                } else {
                    DB::table('talent_schedules')->insert([
                        'id' => (string) Str::uuid(),
                        'talent_id' => $talent->id,
                        'schedule_date' => $today,
                        'start_time' => $startTime,
                        'end_time' => $endTime,
                        'status' => 'unavailable',
                        'created_at' => $now,
                        'updated_at' => $now,
                    ]);
                }
            }
        });
    }

    public function down(): void
    {
        // Master data is intentionally retained on rollback to avoid deleting user data.
    }
};
