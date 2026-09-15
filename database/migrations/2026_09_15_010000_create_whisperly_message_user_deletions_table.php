<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('whisperly_message_user_deletions', function (Blueprint $table) {
            $table->id();
            $table->string('message_id', 191);
            $table->string('user_id', 191);
            $table->timestamps();

            $table->unique(['message_id', 'user_id']);
            $table->index('message_id');
            $table->index('user_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('whisperly_message_user_deletions');
    }
};
