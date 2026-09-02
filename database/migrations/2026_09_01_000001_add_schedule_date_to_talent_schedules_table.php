<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('talent_schedules')) {
            return;
        }

        if (! Schema::hasColumn('talent_schedules', 'schedule_date')) {
            Schema::table('talent_schedules', function (Blueprint $table) {
                $table->date('schedule_date')->nullable()->after('talent_id');
            });
        }

        DB::table('talent_schedules')
            ->whereNull('schedule_date')
            ->update([
                'schedule_date' => DB::raw('DATE(created_at)'),
            ]);

        DB::table('talent_schedules')
            ->whereNull('schedule_date')
            ->update([
                'schedule_date' => now()->toDateString(),
            ]);

        Schema::table('talent_schedules', function (Blueprint $table) {
            $table->date('schedule_date')->nullable(false)->change();
        });

        Schema::table('talent_schedules', function (Blueprint $table) {
            if (! Schema::hasIndex('talent_schedules', 'talent_schedules_talent_id_index')) {
                $table->index('talent_id', 'talent_schedules_talent_id_index');
            }

            if (Schema::hasIndex('talent_schedules', ['talent_id', 'start_time', 'end_time'])) {
                $table->dropUnique(['talent_id', 'start_time', 'end_time']);
            } elseif (Schema::hasIndex('talent_schedules', 'talent_schedules_talent_id_start_time_end_time_unique')) {
                $table->dropUnique('talent_schedules_talent_id_start_time_end_time_unique');
            }

            if (! Schema::hasIndex('talent_schedules', ['talent_id', 'schedule_date', 'start_time', 'end_time'])) {
                $table->unique(
                    ['talent_id', 'schedule_date', 'start_time', 'end_time'],
                    'talent_schedules_talent_date_time_unique'
                );
            }
        });
    }

    public function down(): void
    {
        if (! Schema::hasTable('talent_schedules')) {
            return;
        }

        Schema::table('talent_schedules', function (Blueprint $table) {
            if (Schema::hasIndex('talent_schedules', 'talent_schedules_talent_date_time_unique')) {
                $table->dropUnique('talent_schedules_talent_date_time_unique');
            }

            if (! Schema::hasIndex('talent_schedules', ['talent_id', 'start_time', 'end_time'])) {
                $table->unique(['talent_id', 'start_time', 'end_time']);
            }

            if (Schema::hasIndex('talent_schedules', 'talent_schedules_talent_id_index')) {
                $table->dropIndex('talent_schedules_talent_id_index');
            }
        });

        if (Schema::hasColumn('talent_schedules', 'schedule_date')) {
            Schema::table('talent_schedules', function (Blueprint $table) {
                $table->dropColumn('schedule_date');
            });
        }
    }
};
