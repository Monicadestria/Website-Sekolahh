<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SectionGhpSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('section_ghps')->insert([
            [
                'id' => '2384eb5e-1e17-4080-98c8-4061dd10cde0',
                'section_id' => '3dbb24ce-e64b-4c55-a79c-26d6f63c8556',
                'content' => '<h1>Tentang Kami</h1><div>Kami adalah sebuah institusi pendidikan yang berkomitmen untuk memberikan pendidikan berkualitas kepada para siswa. Dengan pengalaman yang luas dalam dunia pendidikan, kami menyediakan lingkungan belajar yang inspiratif dan mendukung perkembangan holistik setiap individu.<br><br></div><h1>Visi Misi</h1><div>Visi kami adalah menjadi lembaga pendidikan unggulan yang berorientasi pada inovasi dan pemberdayaan potensi siswa untuk menjadi individu yang berkualitas, berintegritas, dan mampu berkontribusi positif bagi masyarakat. Misi kami adalah:</div><ol><li>Memberikan pendidikan yang berkualitas dengan kurikulum yang berbasis kompetensi.</li><li>Mendorong kreativitas dan inovasi dalam proses pembelajaran.</li><li>Menyediakan lingkungan belajar yang aman, nyaman, dan mendukung.</li><li>Membangun karakter siswa yang berintegritas, bertanggung jawab, dan menghargai keberagaman.</li></ol>',
                'created_by' => '49508285-4879-40a4-93a3-0cdb6db30618',
                'updated_by' => '49508285-4879-40a4-93a3-0cdb6db30618',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => '96bcf831-ae7c-4010-86dc-cf8ae026e07d',
                'section_id' => '20a77ec6-8edf-4b90-8df9-1dc535f9431d',
                'content' => "<h1>VISI MISI</h1><ol><li>Memberikan pendidikan yang berkualitas dengan kurikulum yang berbasis kompetensi.</li><li>Mendorong kreativitas dan inovasi dalam proses pembelajaran.</li><li>Menyediakan lingkungan belajar yang aman, nyaman, dan mendukung.</li><li>Membangun karakter siswa yang berintegritas, bertanggung jawab, dan menghargai keberagaman.</li></ol>",
                'created_by' => 'c2feaad1-947b-4299-9c89-7b7f0ab438be',
                'updated_by' => 'c2feaad1-947b-4299-9c89-7b7f0ab438be',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
