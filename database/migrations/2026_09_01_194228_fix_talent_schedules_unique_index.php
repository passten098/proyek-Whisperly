<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
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

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('talent_schedules', function (Blueprint $table) {
            if (Schema::hasIndex('talent_schedules', 'talent_schedules_talent_date_time_unique')) {
                $table->dropUnique('talent_schedules_talent_date_time_unique');
            }

            if (! Schema::hasIndex('talent_schedules', ['talent_id', 'start_time', 'end_time'])) {
                $table->unique(
                    ['talent_id', 'start_time', 'end_time'],
                    'talent_schedules_talent_id_start_time_end_time_unique'
                );
            }

            if (Schema::hasIndex('talent_schedules', 'talent_schedules_talent_id_index')) {
                $table->dropIndex('talent_schedules_talent_id_index');
            }
        });
    }
};