<?php

namespace Database\Seeders;

use App\Models\Galery;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class GalerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Galery::insert([
            // gambar
            [
                'id' => 'b809af14-29ff-4e70-9d71-6ba1cc565bbc',
                'category_id' => '2494acd2-9bc5-4bf2-8ef9-6b28bdb7d4b6',
                'type' => 'photo',
                'title' => 'Belajar Bersama',
                'photo' => 'b809af14-29ff-4e70-9d71-6ba1cc565bbc.png',
                'video' => '',
                'status' => '1',
                'desc' => 'Ini adalah deskripsi',
                'created_by' => '49508285-4879-40a4-93a3-0cdb6db30618',
                'created_at' => now(),
            ],
            [
                'id' => '459d239e-1e23-4764-be16-044bbd49db67',
                'category_id' => 'c7195f72-ddd6-4b50-b169-6cd4f1504e6a',
                'type' => 'photo',
                'title' => 'Bersih Bersih',
                'photo' => '459d239e-1e23-4764-be16-044bbd49db67.png',
                'video' => '',
                'status' => '0',
                'desc' => 'Ini adalah deskripsi',
                'created_by' => '49508285-4879-40a4-93a3-0cdb6db30618',
                'created_at' => now(),
            ],
            [
                'id' => '15cf61a6-41e8-49cb-aea0-54fcbd5d6a76',
                'category_id' => '8c79c2f1-5b34-4cf4-b2ef-d1b716255d77',
                'type' => 'photo',
                'title' => 'Teman Baru',
                'photo' => '15cf61a6-41e8-49cb-aea0-54fcbd5d6a76.png',
                'video' => '',
                'status' => '1',
                'desc' => 'Ini adalah deskripsi',
                'created_by' => '49508285-4879-40a4-93a3-0cdb6db30618',
                'created_at' => now(),
            ],
            [
                'id' => '29e0ec54-7b25-4f57-9727-ef4ebc29b102',
                'category_id' => '1845407f-fc7d-47b1-b1f2-6603d446bcf7',
                'type' => 'photo',
                'title' => 'Makanan Sehat',
                'photo' => '29e0ec54-7b25-4f57-9727-ef4ebc29b102.png',
                'video' => '',
                'status' => '0',
                'desc' => 'Ini adalah deskripsi',
                'created_by' => '49508285-4879-40a4-93a3-0cdb6db30618',
                'created_at' => now(),
            ],
            // video
            [
                'id' => '0fa490c6-12e1-4fe5-82c7-2a02d3c7528e',
                'category_id' => '2494acd2-9bc5-4bf2-8ef9-6b28bdb7d4b6',
                'type' => 'video',
                'title' => 'Belajar Sendiri',
                'photo' => '',
                'video' => 'https://youtu.be/P25hb9imQ5I?si=A8rE8hH9OmKTjNWN',
                'status' => '1',
                'desc' => 'Ini adalah deskripsi',
                'created_by' => '49508285-4879-40a4-93a3-0cdb6db30618',
                'created_at' => now(),
            ],
            [
                'id' => '19b86a70-b999-4c5e-83f3-71bb72f9d6ef',
                'category_id' => 'c7195f72-ddd6-4b50-b169-6cd4f1504e6a',
                'type' => 'video',
                'title' => 'Bersih Sehat',
                'photo' => '',
                'video' => 'https://youtu.be/qZ0JFgQ00oc?si=LWKDYTRFxmp4tuqU',
                'status' => '0',
                'desc' => 'Ini adalah deskripsi',
                'created_by' => '49508285-4879-40a4-93a3-0cdb6db30618',
                'created_at' => now(),
            ],
            [
                'id' => '430c5772-8b16-408b-9883-ede6ad2b945d',
                'category_id' => '8c79c2f1-5b34-4cf4-b2ef-d1b716255d77',
                'type' => 'video',
                'title' => 'Teman Lama',
                'photo' => '',
                'video' => 'https://youtu.be/8IJqlbcv4Qk?si=42p1qDQ9XXzBfSPf',
                'status' => '1',
                'desc' => 'Ini adalah deskripsi',
                'created_by' => '49508285-4879-40a4-93a3-0cdb6db30618',
                'created_at' => now(),
            ],
            [
                'id' => '87238498-1397-406f-88a9-824148f63d3a',
                'category_id' => '1845407f-fc7d-47b1-b1f2-6603d446bcf7',
                'type' => 'video',
                'title' => 'Makanan Bergizi',
                'photo' => '',
                'video' => 'https://youtu.be/tZ3uurBCtpU?si=bkd39_bhXu8ZjwMj',
                'status' => '0',
                'desc' => 'Ini adalah deskripsi',
                'created_by' => '49508285-4879-40a4-93a3-0cdb6db30618',
                'created_at' => now(),
            ],
        ]);
        // 	id	name	created_by	updated_by	deleted_by	deleted_at	created_at	updated_at	

        // Galery::factory(5)->create();
        // masih error
    }
}
