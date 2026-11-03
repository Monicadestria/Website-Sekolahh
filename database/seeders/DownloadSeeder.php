<?php

namespace Database\Seeders;

use App\Models\Master;
use App\Models\User;
use App\Models\Download;
use Illuminate\Database\Seeder;

class DownloadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Download::insert([
            [
                'id' => '5fc62688-d407-487d-bf21-79d7f67ead3e',
                'category_download_id' => 'd5d61a64-9512-4929-8408-42e997e9a137',
                'file' => 'storage/download/original/Kelas Tambahan.pdf',
                'title' => 'Kelas Tambahan',
                'desc' => 'Ini adalah deskripsi',
                'status' => '1',
                'created_by' => '49508285-4879-40a4-93a3-0cdb6db30618',
                'created_at' => now(),
            ],
            [
                'id' => '41795a78-a2d3-43a0-964d-fec30bad8905',
                'category_download_id' => '3bfc8b61-dba6-4ada-99f8-3a2d20b29e48',
                'file' => 'storage/download/original/Bakti Sosial.pdf',
                'title' => 'Bakti Sosial',
                'desc' => 'Ini adalah deskripsi',
                'status' => '0',
                'created_by' => '49508285-4879-40a4-93a3-0cdb6db30618',
                'created_at' => now(),
            ],
            [
                'id' => 'c0ae03a1-9155-4b65-b23b-34e5e4528959',
                'category_download_id' => '0b2241a7-5011-43f5-8a03-5dfb77d05ee9',
                'file' => 'storage/download/original/Peserta Ujian.pdf',
                'title' => 'Peserta Ujian',
                'desc' => 'Ini adalah deskripsi',
                'status' => '1',
                'created_by' => '49508285-4879-40a4-93a3-0cdb6db30618',
                'created_at' => now(),
            ],
            [
                'id' => '60b3ce50-add4-4e3c-863b-6624965bbe7f',
                'category_download_id' => '5979873e-f96f-42d9-b5fe-e60e84e74209',
                'file' => 'storage/download/original/Jadwal Ujian.pdf',
                'title' => 'Jadwal Ujian',
                'desc' => 'Ini adalah deskripsi',
                'status' => '0',
                'created_by' => '49508285-4879-40a4-93a3-0cdb6db30618',
                'created_at' => now(),
            ],
        ]);

        // Download::factory(100)->create([
        //     'category_download_id' => function () {
        //         // Ambil ID kategori unduhan secara acak dari yang telah ada
        //         return Master::pluck('id')->random();
        //     },
        //     'user_id' => function () {
        //         // Ambil ID kategori unduhan secara acak dari yang telah ada
        //         return User::pluck('id')->random();
        //     },
        // ]);
    }
}
