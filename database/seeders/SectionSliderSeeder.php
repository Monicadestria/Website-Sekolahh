<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SectionSliderSeeder extends Seeder
{
 /**
  * Run the database seeds.
  */
 public function run(): void
 {
  DB::table('section_sliders')->insert([
   [
    'id' => '494f4957-0047-425d-ac1a-f34af10a1915',
    'section_id' => '785a0503-2157-49f3-bc5c-fd0a5af66cd7',
    'file' => '494f4957-0047-425d-ac1a-f34af10a1915.png',
    'created_by' => '49508285-4879-40a4-93a3-0cdb6db30618',
    'updated_by' => '49508285-4879-40a4-93a3-0cdb6db30618',
    'created_at' => now(),
    'updated_at' => now(),
   ],
   [
    'id' => '56d9ea99-9b53-49d2-ba90-53de11282801',
    'section_id' => '785a0503-2157-49f3-bc5c-fd0a5af66cd7',
    'file' => '56d9ea99-9b53-49d2-ba90-53de11282801.png',
    'created_by' => '49508285-4879-40a4-93a3-0cdb6db30618',
    'updated_by' => '49508285-4879-40a4-93a3-0cdb6db30618',
    'created_at' => now(),
    'updated_at' => now(),
   ],
   [
    'id' => '869000fc-be79-46ba-aa18-e9aca581f3da',
    'section_id' => '785a0503-2157-49f3-bc5c-fd0a5af66cd7',
    'file' => '869000fc-be79-46ba-aa18-e9aca581f3da.png',
    'created_by' => '49508285-4879-40a4-93a3-0cdb6db30618',
    'updated_by' => '49508285-4879-40a4-93a3-0cdb6db30618',
    'created_at' => now(),
    'updated_at' => now(),
   ],
   [
    'id' => '9c66a235-f486-4c09-83d2-b3b5b8af1b11',
    'section_id' => '785a0503-2157-49f3-bc5c-fd0a5af66cd7',
    'file' => '9c66a235-f486-4c09-83d2-b3b5b8af1b11.png',
    'created_by' => '49508285-4879-40a4-93a3-0cdb6db30618',
    'updated_by' => '49508285-4879-40a4-93a3-0cdb6db30618',
    'created_at' => now(),
    'updated_at' => now(),
   ],
   [
    'id' => 'b8e7579c-bfb1-487d-bc01-048a5c9cf1e7',
    'section_id' => '785a0503-2157-49f3-bc5c-fd0a5af66cd7',
    'file' => 'b8e7579c-bfb1-487d-bc01-048a5c9cf1e7.png',
    'created_by' => '49508285-4879-40a4-93a3-0cdb6db30618',
    'updated_by' => '49508285-4879-40a4-93a3-0cdb6db30618',
    'created_at' => now(),
    'updated_at' => now(),
   ],
   [
    'id' => 'eb74f519-2998-42b0-b2ca-f9922b0ec67a',
    'section_id' => '14785dc9-d65d-4a84-8c9f-5b0a0d564b37',
    'file' => 'eb74f519-2998-42b0-b2ca-f9922b0ec67a.jpeg',
    'created_by' => 'c2feaad1-947b-4299-9c89-7b7f0ab438be',
    'updated_by' => 'c2feaad1-947b-4299-9c89-7b7f0ab438be',
    'created_at' => now(),
    'updated_at' => now(),
   ],
   [
    'id' => 'ee42efe7-8a9b-4717-9c9c-8b1326b7ee50',
    'section_id' => '14785dc9-d65d-4a84-8c9f-5b0a0d564b37',
    'file' => 'ee42efe7-8a9b-4717-9c9c-8b1326b7ee50.jpg',
    'created_by' => 'c2feaad1-947b-4299-9c89-7b7f0ab438be',
    'updated_by' => 'c2feaad1-947b-4299-9c89-7b7f0ab438be',
    'created_at' => now(),
    'updated_at' => now(),
   ],
  ]);
 }
}
