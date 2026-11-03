<?php

namespace Database\Seeders;

use App\Models\Master;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Master::factory(20)->create();
        DB::table('masters')->insert([
            // staf
            [
                'id' => '51b5173a-4eaf-4823-9aea-6cf5ce20712d',
                'user_id' => '49508285-4879-40a4-93a3-0cdb6db30618',
                'name' => 'Tata Usaha',
                'type' => 'Staf',
                'status' => 1,
                'created_by' => '49508285-4879-40a4-93a3-0cdb6db30618',
                'created_at' => now(),
            ],
            [
                'id' => '938881ac-80b2-40a0-b724-107d067a7b84',
                'user_id' => '49508285-4879-40a4-93a3-0cdb6db30618',
                'name' => 'Guru',
                'type' => 'Staf',
                'status' => 1,
                'created_by' => '49508285-4879-40a4-93a3-0cdb6db30618',
                'created_at' => now(),
            ],
            [
                'id' => 'c9ded687-9aab-4abd-b98a-a533c5f993cc',
                'user_id' => '49508285-4879-40a4-93a3-0cdb6db30618',
                'name' => 'Kepala Sekolah',
                'type' => 'Staf',
                'status' => 0,
                'created_by' => '49508285-4879-40a4-93a3-0cdb6db30618',
                'created_at' => now(),
            ],
            [
                'id' => '0362980b-b997-4186-a15b-6e0f6cc497f4',
                'user_id' => '49508285-4879-40a4-93a3-0cdb6db30618',
                'name' => 'Penjaga',
                'type' => 'Staf',
                'status' => 0,
                'created_by' => '49508285-4879-40a4-93a3-0cdb6db30618',
                'created_at' => now(),
            ],
            // berita
            [
                'id' => '3badf18c-7d88-452b-be4e-3de5be488d87',
                'user_id' => '49508285-4879-40a4-93a3-0cdb6db30618',
                'name' => 'Kelulusan',
                'type' => 'Berita',
                'status' => 1,
                'created_by' => '49508285-4879-40a4-93a3-0cdb6db30618',
                'created_at' => now(),
            ],
            [
                'id' => '43a08e13-1613-4775-ae05-caa5a8cf47bd',
                'user_id' => '49508285-4879-40a4-93a3-0cdb6db30618',
                'name' => 'Perlombaan',
                'type' => 'Berita',
                'status' => 1,
                'created_by' => '49508285-4879-40a4-93a3-0cdb6db30618',
                'created_at' => now(),
            ],
            [
                'id' => '85fbd717-4046-495b-afc1-6abb4d63622b',
                'user_id' => '49508285-4879-40a4-93a3-0cdb6db30618',
                'name' => 'Kemerdekaan',
                'type' => 'Berita',
                'status' => 0,
                'created_by' => '49508285-4879-40a4-93a3-0cdb6db30618',
                'created_at' => now(),
            ],
            [
                'id' => 'c01411f3-7d23-49c6-9ea3-4a54f2accf22',
                'user_id' => '49508285-4879-40a4-93a3-0cdb6db30618',
                'name' => 'Bencana Alam',
                'type' => 'Berita',
                'status' => 0,
                'created_by' => '49508285-4879-40a4-93a3-0cdb6db30618',
                'created_at' => now(),
            ],
            // galeri
            [
                'id' => '2494acd2-9bc5-4bf2-8ef9-6b28bdb7d4b6',
                'user_id' => '49508285-4879-40a4-93a3-0cdb6db30618',
                'name' => 'Pembelajaran',
                'type' => 'Galeri',
                'status' => 1,
                'created_by' => '49508285-4879-40a4-93a3-0cdb6db30618',
                'created_at' => now(),
            ],
            [
                'id' => 'c7195f72-ddd6-4b50-b169-6cd4f1504e6a',
                'user_id' => '49508285-4879-40a4-93a3-0cdb6db30618',
                'name' => 'Kerja Bakti',
                'type' => 'Galeri',
                'status' => 1,
                'created_by' => '49508285-4879-40a4-93a3-0cdb6db30618',
                'created_at' => now(),
            ],
            [
                'id' => '8c79c2f1-5b34-4cf4-b2ef-d1b716255d77',
                'user_id' => '49508285-4879-40a4-93a3-0cdb6db30618',
                'name' => 'Pengenalan',
                'type' => 'Galeri',
                'status' => 0,
                'created_by' => '49508285-4879-40a4-93a3-0cdb6db30618',
                'created_at' => now(),
            ],
            [
                'id' => '1845407f-fc7d-47b1-b1f2-6603d446bcf7',
                'user_id' => '49508285-4879-40a4-93a3-0cdb6db30618',
                'name' => 'Kantin',
                'type' => 'Galeri',
                'status' => 0,
                'created_by' => '49508285-4879-40a4-93a3-0cdb6db30618',
                'created_at' => now(),
            ],
            // unduh
            [
                'id' => 'd5d61a64-9512-4929-8408-42e997e9a137',
                'user_id' => '49508285-4879-40a4-93a3-0cdb6db30618',
                'name' => 'Pembelajaran',
                'type' => 'Unduh',
                'status' => 1,
                'created_by' => '49508285-4879-40a4-93a3-0cdb6db30618',
                'created_at' => now(),
            ],
            [
                'id' => '3bfc8b61-dba6-4ada-99f8-3a2d20b29e48',
                'user_id' => '49508285-4879-40a4-93a3-0cdb6db30618',
                'name' => 'Kerja Bakti',
                'type' => 'Unduh',
                'status' => 1,
                'created_by' => '49508285-4879-40a4-93a3-0cdb6db30618',
                'created_at' => now(),
            ],
            [
                'id' => '0b2241a7-5011-43f5-8a03-5dfb77d05ee9',
                'user_id' => '49508285-4879-40a4-93a3-0cdb6db30618',
                'name' => 'Ujian',
                'type' => 'Unduh',
                'status' => 0,
                'created_by' => '49508285-4879-40a4-93a3-0cdb6db30618',
                'created_at' => now(),
            ],
            [
                'id' => '5979873e-f96f-42d9-b5fe-e60e84e74209',
                'user_id' => '49508285-4879-40a4-93a3-0cdb6db30618',
                'name' => 'Jadwal',
                'type' => 'Unduh',
                'status' => 0,
                'created_by' => '49508285-4879-40a4-93a3-0cdb6db30618',
                'created_at' => now(),
            ],
        ]);
    }
}
