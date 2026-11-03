<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user_id =  User::first('id');
        $user_id2 = User::skip(1)->take(1)->pluck('id')->first();

        \App\Models\Setting::insert([
            [
                'id' => Str::uuid(),
                'slug' => 'vetencode-school',
                'school_name' => 'Vetencode School',
                'post_code' => '11100',
                'phone' => '080000000000',
                'visi_misi' => 'Jaya Jaya Jaya',
                'maps' => '',
                'address' => 'Jalan Arwinda, Gadung Permai, Blk. E No.61, Bojong, Kec. Karangtengah, Kabupaten Cianjur, Jawa Barat 43281',
                'facebook' => 'School FB',
                'instagram' => '@instagram_school',
                'tiktok' => 'tiktok_school',
                'twitter' => 'twitter_school',
                'youtube' => 'youtube_school',
                'email' => 'vetencodeschool@gmail.com',
                'footer_desc' => 'Sekolah Dasar dengan tujuan terwujudnyalulusan SD Negeri Ngesrep 01 yang berprestasi, Berakhlak mulia, Berkarakter, dan Berwawasan Lingkungan',
                'status' => 1,
                'desc' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit.',
                'created_by' => $user_id->id,
                'created_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'slug' => 'puma-school',
                'school_name' => 'Puma School',
                'phone' => '088888888888',
                'post_code' => '12345',
                'visi_misi' => 'HA E HA E HA E',
                'maps' => '',
                'address' => 'Jalan Arwinda, Gadung Permai, Blk. E No.61, Bojong, Kec. Karangtengah, Kabupaten Cianjur, Jawa Barat 43281',
                'facebook' => 'School FB',
                'instagram' => '@instagram_school',
                'tiktok' => 'tiktok_school',
                'twitter' => 'twitter_school',
                'youtube' => 'youtube_school',
                'email' => 'pumaschool@gmail.com',
                'footer_desc' => 'Footer description Lorem ipsum dolor sit amet consectetur adipisicing elit.',
                'desc' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit.',
                'status' => 1,
                'created_by' => $user_id2,
                'created_at' => now(),
            ],
        ]);
    }
}
