<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class SectionHeroSliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('section_hero_sliders')->insert([
            [
                'id' => '2w71g4mn-14f7-55gh-h093-v347r76fg432',
                'section_hero_id' => '7b21a0fd-19b0-41bf-b268-a121e06ba736',
                'file' => '2w71g4mn-14f7-55gh-h093-v347r76fg432.png',
                'created_by' => '49508285-4879-40a4-93a3-0cdb6db30618',
                'updated_by' => '49508285-4879-40a4-93a3-0cdb6db30618',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 'cf94e625-0e7f-45ac-b76e-e2015cfa70c3',
                'section_hero_id' => '7b21a0fd-19b0-41bf-b268-a121e06ba736',
                'file' => 'cf94e625-0e7f-45ac-b76e-e2015cfa70c3.png',
                'created_by' => '49508285-4879-40a4-93a3-0cdb6db30618',
                'updated_by' => '49508285-4879-40a4-93a3-0cdb6db30618',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 'faff7951-2f55-418a-b29c-16fcd27457af',
                'section_hero_id' => '7b21a0fd-19b0-41bf-b268-a121e06ba736',
                'file' => 'faff7951-2f55-418a-b29c-16fcd27457af.jpg',
                'created_by' => '49508285-4879-40a4-93a3-0cdb6db30618',
                'updated_by' => '49508285-4879-40a4-93a3-0cdb6db30618',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => '192370b4-59e9-41c8-96d2-5bef6f05d4d4',
                'section_hero_id' => '9fa0b771-b862-45cd-9a2f-56c3e1dc828d',
                'file' => '192370b4-59e9-41c8-96d2-5bef6f05d4d4.jpeg',
                'created_by' => 'c2feaad1-947b-4299-9c89-7b7f0ab438be',
                'updated_by' => 'c2feaad1-947b-4299-9c89-7b7f0ab438be',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => '3e16fbef-b681-4dd3-9bdf-542c2ff6bf04',
                'section_hero_id' => '9fa0b771-b862-45cd-9a2f-56c3e1dc828d',
                'file' => '3e16fbef-b681-4dd3-9bdf-542c2ff6bf04.jpg',
                'created_by' => 'c2feaad1-947b-4299-9c89-7b7f0ab438be',
                'updated_by' => 'c2feaad1-947b-4299-9c89-7b7f0ab438be',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
