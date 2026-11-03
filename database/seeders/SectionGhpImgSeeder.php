<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SectionGhpImgSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('section_ghp_imgs')->insert([
            [
                'id' => '450a0093-2c9f-43a2-a396-5f44d0629424',
                'section_ghp_id' => '2384eb5e-1e17-4080-98c8-4061dd10cde0',
                'file' => '450a0093-2c9f-43a2-a396-5f44d0629424.png',
                'created_by' => '49508285-4879-40a4-93a3-0cdb6db30618',
                'updated_by' => '49508285-4879-40a4-93a3-0cdb6db30618',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 'a2d4be58-0784-400f-8fe7-3ab5861ebea1',
                'section_ghp_id' => '2384eb5e-1e17-4080-98c8-4061dd10cde0',
                'file' => 'a2d4be58-0784-400f-8fe7-3ab5861ebea1.png',
                'created_by' => '49508285-4879-40a4-93a3-0cdb6db30618',
                'updated_by' => '49508285-4879-40a4-93a3-0cdb6db30618',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 'c6facfd6-de69-419f-9105-bf34feb6810e',
                'section_ghp_id' => '2384eb5e-1e17-4080-98c8-4061dd10cde0',
                'file' => 'c6facfd6-de69-419f-9105-bf34feb6810e.png',
                'created_by' => '49508285-4879-40a4-93a3-0cdb6db30618',
                'updated_by' => '49508285-4879-40a4-93a3-0cdb6db30618',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 'd50058b8-72d7-46e3-a84b-5ffbe7200ad4',
                'section_ghp_id' => '96bcf831-ae7c-4010-86dc-cf8ae026e07d',
                'file' => 'd50058b8-72d7-46e3-a84b-5ffbe7200ad4.png',
                'created_by' => 'c2feaad1-947b-4299-9c89-7b7f0ab438be',
                'updated_by' => 'c2feaad1-947b-4299-9c89-7b7f0ab438be',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
