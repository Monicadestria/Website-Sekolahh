<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use App\Models\Setting;
use App\Models\SectionImg;
use App\Models\SectionMap;
use App\Models\SectionHero;
use Illuminate\Support\Str;
use App\Models\SectionGhpImg;
use Illuminate\Database\Seeder;
use Database\Seeders\MenuSeeder;
use Database\Seeders\StafSeeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\BeritaSeeder;
use Database\Seeders\GalerySeeder;
use Database\Seeders\MasterSeeder;
use Database\Seeders\SectionSeeder;
use Database\Seeders\SettingSeeder;
use Database\Seeders\DownloadSeeder;
use Database\Seeders\SectionGhpSeeder;
use Database\Seeders\SectionMapSeeder;
use Database\Seeders\SectionHeroSeeder;
use Database\Seeders\SectionLineSeeder;
use Illuminate\Support\Facades\Artisan;
use Database\Seeders\SectionGhpImgSeeder;
use Database\Seeders\SectionSliderSeeder;
use Database\Seeders\SectionTaglineSeeder;
use Database\Seeders\SectionHeroSliderSeeder;
use App\Http\Controllers\Web\SuperAdminController;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            SettingSeeder::class,
            MasterSeeder::class,
            MenuSeeder::class,
            // DownloadSeeder::class,
            // StafSeeder::class,
            // BeritaSeeder::class,
            // GalerySeeder::class,

            // Section utama
            SectionSeeder::class,
            // section turunan
            SectionHeroSeeder::class,
            SectionHeroSliderSeeder::class,
            SectionMapSeeder::class,
            SectionTaglineSeeder::class,
            SectionSliderSeeder::class,
            SectionGhpSeeder::class,
            SectionGhpImgSeeder::class,
            SectionLineSeeder::class,
            // end section
        ]);

        try {
            $users = User::all();
            foreach ($users as $user) {
                access_generate($user->id);
                menu_generate($user->id);
            }
        } catch (\Throwable $th) {
            dd($th);
        }
    }
}
