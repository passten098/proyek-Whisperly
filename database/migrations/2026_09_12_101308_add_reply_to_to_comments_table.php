<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->char('reply_to', 36)
                ->nullable()
                ->after('komentar');

            $table->index(
                'reply_to',
                'comments_reply_to_index'
            );
        });
    }

    public function down(): void
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->dropIndex(
                'comments_reply_to_index'
            );

            $table->dropColumn('reply_to');
        });
    }
};