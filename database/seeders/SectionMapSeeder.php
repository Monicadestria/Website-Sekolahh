<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SectionMapSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('section_maps')->insert([
            [
                // 'id' => Str::uuid(),
                'section_id' => '05225b8c-c6c6-4043-9f0b-43b7b892c106',
                'url' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.818269368662!2d107.61245857317886!3d-6.912320367647716!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e76961f736bb%3A0xec1e28a948930064!2sSMA%20Negeri%203%20Bandung!5e0!3m2!1sen!2sid!4v1717805916092!5m2!1sen!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>',
                'created_by' => '49508285-4879-40a4-93a3-0cdb6db30618',
                'updated_by' => '49508285-4879-40a4-93a3-0cdb6db30618',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                // 'id' => Str::uuid(),
                'section_id' => '458f263f-0719-43f3-b81a-e98c4191db11',
                'url' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.811914036684!2d100.18861717310396!3d0.10267506431874139!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x302a9972e3efcdcf%3A0xfac7eb3fefbaa7f7!2sSMA%20Negeri%203%20Sumatera%20Barat!5e0!3m2!1sen!2sid!4v1717806042281!5m2!1sen!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>',
                'created_by' => 'c2feaad1-947b-4299-9c89-7b7f0ab438be',
                'updated_by' => 'c2feaad1-947b-4299-9c89-7b7f0ab438be',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
