<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Berita;
use App\Models\CategoryBerita;
use Illuminate\Support\Str;


// use App\Models\CategoryBerita;

class BeritaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Berita::insert([
            [
                'id' => Str::uuid(),
                'user_id' => '49508285-4879-40a4-93a3-0cdb6db30618',
                'category_berita_id' => '3badf18c-7d88-452b-be4e-3de5be488d87',
                'photo' => 'berita-kelulusan.png',
                'title' => 'Kelulusan',
                'slug' => 'kelulusan',
                'body' => '<div>Ini adalah berita kelulusan</div>',
                'status' => '1',
                'view_count' => '10',
                'created_by' => '49508285-4879-40a4-93a3-0cdb6db30618',
                'created_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'user_id' => '49508285-4879-40a4-93a3-0cdb6db30618',
                'category_berita_id' => '43a08e13-1613-4775-ae05-caa5a8cf47bd',
                'photo' => 'berita-lomba.png',
                'title' => 'Olimpiade',
                'slug' => 'olimpiade',
                'body' => '<div>Ini adalah berita lomba</div>',
                'status' => '0',
                'view_count' => '5',
                'created_by' => '49508285-4879-40a4-93a3-0cdb6db30618',
                'created_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'user_id' => '49508285-4879-40a4-93a3-0cdb6db30618',
                'category_berita_id' => '85fbd717-4046-495b-afc1-6abb4d63622b',
                'photo' => 'berita-merdeka.png',
                'title' => 'Indonesia Merdeka',
                'slug' => 'merdeka',
                'body' => '<div>Ini adalah berita Indonesia Merdeka</div>',
                'status' => '1',
                'view_count' => '20',
                'created_by' => '49508285-4879-40a4-93a3-0cdb6db30618',
                'created_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'user_id' => '49508285-4879-40a4-93a3-0cdb6db30618',
                'category_berita_id' => 'c01411f3-7d23-49c6-9ea3-4a54f2accf22',
                'photo' => 'berita-bencana.png',
                'title' => 'Evakuasi Banjir',
                'slug' => 'evakuasi-banjir',
                'body' => '<div>Ini adalah berita evakuasi banjir</div>',
                'status' => '0',
                'view_count' => '0',
                'created_by' => '49508285-4879-40a4-93a3-0cdb6db30618',
                'created_at' => now(),
            ],
        ]);
        // 	id	name	created_by	updated_by	deleted_by	deleted_at	created_at	updated_at	

        // Berita::factory(12)->create();
    }
}
