<?php

namespace Database\Seeders;

use App\Models\Staf;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StafSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Staf::insert([
            [
                'id' => Str::uuid(),
                'category_staf_id' => '51b5173a-4eaf-4823-9aea-6cf5ce20712d',
                'name' => 'Udin',
                'nip' => '2736827365786',
                'photo' => 'udin.png',
                'phone_number' => '0823635625382',
                'email' => 'udin123@gmail.com',
                'status' => '1',
                'created_by' => '49508285-4879-40a4-93a3-0cdb6db30618',
                'created_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'category_staf_id' => '938881ac-80b2-40a0-b724-107d067a7b84',
                'name' => 'Marijo',
                'nip' => '8734568358378',
                'photo' => 'marijo.png',
                'phone_number' => '08765634567634',
                'email' => 'marijo@gmail.com',
                'status' => '0',
                'created_by' => '49508285-4879-40a4-93a3-0cdb6db30618',
                'created_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'category_staf_id' => 'c9ded687-9aab-4abd-b98a-a533c5f993cc',
                'name' => 'Soep',
                'nip' => '928373927492789',
                'photo' => 'soep.png',
                'phone_number' => '08235473274326',
                'email' => 'udin123@gmail.com',
                'status' => '1',
                'created_by' => '49508285-4879-40a4-93a3-0cdb6db30618',
                'created_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'category_staf_id' => '0362980b-b997-4186-a15b-6e0f6cc497f4',
                'name' => 'Yati',
                'nip' => '10231082302139',
                'photo' => 'yati.png',
                'phone_number' => '0827364726423',
                'email' => 'yati@gmail.com',
                'status' => '0',
                'created_by' => '49508285-4879-40a4-93a3-0cdb6db30618',
                'created_at' => now(),
            ],
        ]);
        // 	id	name	created_by	updated_by	deleted_by	deleted_at	created_at	updated_at	

        // Staf::factory(13)->create();
    }
}
