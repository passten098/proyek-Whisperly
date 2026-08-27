<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $defaultCategories = [
            'cinta',
            'horror',
            'sedih',
            'campuran',
        ];

        foreach ($defaultCategories as $slug) {
            $exists = DB::table('categories')->where('jenis_kategori', $slug)->exists();

            if (! $exists) {
                DB::table('categories')->insert([
                    'id' => (string) Str::uuid(),
                    'jenis_kategori' => $slug,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
