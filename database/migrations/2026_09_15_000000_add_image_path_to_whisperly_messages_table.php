<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('whisperly_messages', function (Blueprint $table) {
            if (! Schema::hasColumn('whisperly_messages', 'image_path')) {
                $table->string('image_path', 500)->nullable()->after('message');
            }
        });
    }

    public function down(): void
    {
        Schema::table('whisperly_messages', function (Blueprint $table) {
            if (Schema::hasColumn('whisperly_messages', 'image_path')) {
                $table->dropColumn('image_path');
            }
        });
    }
};
