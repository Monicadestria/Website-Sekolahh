<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Date;
use App\Http\Controllers\Web\SuperAdminController;

class UserSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::insert([
            [
                'id' => '49508285-4879-40a4-93a3-0cdb6db30618',
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'email_verified_at' => Date::now(),
                'role' => 'super-admin',
                'password' => bcrypt('12345678'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 'c2feaad1-947b-4299-9c89-7b7f0ab438be',
                'name' => 'Admin ABC',
                'email' => 'admin2@gmail.com',
                'email_verified_at' => Date::now(),
                'role' => 'admin',
                'password' => bcrypt('10101010'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
