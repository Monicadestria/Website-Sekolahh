<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SectionHeroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('section_heroes')->insert([
            [
                'id' => '7b21a0fd-19b0-41bf-b268-a121e06ba736',
                'section_id' => '19b15e15-66f2-44ed-ab56-8c8bfa89aef2',
                'text_hero' => 'Proses Pembelajaran di Kelas',
                'text_button' => 'Lihat',
                'link_button' => '3',
                'created_by' => '49508285-4879-40a4-93a3-0cdb6db30618',
                'updated_by' => '49508285-4879-40a4-93a3-0cdb6db30618',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => '9fa0b771-b862-45cd-9a2f-56c3e1dc828d',
                'section_id' => '42d1ec88-ae55-4cad-897d-d121cfe24551',
                'text_hero' => 'Pembekalan Siswa Baru',
                'text_button' => 'Lihat',
                'link_button' => '6',
                'created_by' => 'c2feaad1-947b-4299-9c89-7b7f0ab438be',
                'updated_by' => 'c2feaad1-947b-4299-9c89-7b7f0ab438be',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
