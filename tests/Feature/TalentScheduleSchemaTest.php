<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class TalentScheduleSchemaTest extends TestCase
{
    public function test_talent_schedule_unique_index_includes_schedule_date(): void
    {
        if (config('database.default') !== 'mysql') {
            $this->markTestSkipped('This schema check runs against MySQL only.');
        }

        $this->assertTrue(Schema::hasTable('talent_schedules'));
        $this->assertTrue(Schema::hasColumn('talent_schedules', 'schedule_date'));

        $indexes = DB::select(
            "SHOW INDEX FROM talent_schedules WHERE Key_name = 'talent_schedules_talent_date_time_unique'"
        );

        $this->assertNotEmpty($indexes);
        $this->assertSame(
            ['talent_id', 'schedule_date', 'start_time', 'end_time'],
            collect($indexes)->sortBy('Seq_in_index')->pluck('Column_name')->all()
        );
    }
}
