<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SectionLineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('section_lines')->insert([
            [
                // 'id' => Str::uuid(),
                'section_id' => '52363a3f-41ca-4365-925d-5603c44c8b6c',
                'position' => 'center',
                'bold' => 5,
                'length' => 85,
                'round' => 1,
                'color' => '#80CEF9',
                'amount' => 1,
                'created_by' => '49508285-4879-40a4-93a3-0cdb6db30618',
                'updated_by' => '49508285-4879-40a4-93a3-0cdb6db30618',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                // 'id' => Str::uuid(),
                'section_id' => 'e4d6bb8e-a463-46ca-8c16-97793c0ca911',
                'position' => 'end',
                'bold' => 3,
                'length' => 100,
                'round' => 0,
                'color' => '#9b4d2c',
                'amount' => 3,
                'created_by' => 'c2feaad1-947b-4299-9c89-7b7f0ab438be',
                'updated_by' => 'c2feaad1-947b-4299-9c89-7b7f0ab438be',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                // 'id' => Str::uuid(),
                'section_id' => '47ceac34-a8e4-4a83-be60-3c4e2ace9e2e',
                'position' => 'start',
                'bold' => 1,
                'length' => 80,
                'round' => 1,
                'color' => '#2b2b2b',
                'amount' => 1,
                'created_by' => 'c2feaad1-947b-4299-9c89-7b7f0ab438be',
                'updated_by' => 'c2feaad1-947b-4299-9c89-7b7f0ab438be',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                // 'id' => Str::uuid(),
                'section_id' => 'f457c169-45fe-4124-9e79-79dda8d8b396',
                'position' => 'start',
                'bold' => 1,
                'length' => 10,
                'round' => 1,
                'color' => '#2b2b2b',
                'amount' => 1,
                'created_by' => 'c2feaad1-947b-4299-9c89-7b7f0ab438be',
                'updated_by' => 'c2feaad1-947b-4299-9c89-7b7f0ab438be',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
