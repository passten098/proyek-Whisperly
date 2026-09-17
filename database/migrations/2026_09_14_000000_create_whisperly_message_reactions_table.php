<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('whisperly_message_reactions', function (Blueprint $table) {
            $table->id();
            $table->string('message_id', 191);
            $table->string('user_id', 191);
            $table->string('emoji', 20);
            $table->timestamps();

            $table->unique(
                ['message_id', 'user_id'],
                'whisperly_message_reactions_message_user_unique'
            );

            $table->index('message_id');
            $table->index('user_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('whisperly_message_reactions');
    }
};
