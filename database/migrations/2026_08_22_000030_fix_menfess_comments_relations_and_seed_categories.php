<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $defaultCategories = [
            'cinta',
            'horror',
            'sedih',
            'campuran',
        ];

        foreach ($defaultCategories as $slug) {
            $exists = DB::table('categories')->where('jenis_kategori', $slug)->exists();

            if (!$exists) {
                DB::table('categories')->insert([
                    'id' => (string) Str::uuid(),
                    'jenis_kategori' => $slug,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        Schema::table('menfess', function (Blueprint $table) {
            $table->string('id_pengguna', 36)->change();
            $table->string('id_kategori', 36)->nullable()->change();
            $table->string('status')->default('pending')->change();
        });

        Schema::table('comments', function (Blueprint $table) {
            $table->string('id_menfess', 36)->change();
            $table->string('id_pengguna', 36)->change();
            $table->string('status')->default('active')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('categories')
            ->whereIn('jenis_kategori', ['cinta', 'horror', 'sedih', 'campuran'])
            ->delete();
    }
};
