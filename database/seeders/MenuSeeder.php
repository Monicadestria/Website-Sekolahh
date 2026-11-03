<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\Access;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Artisan::call('access:sync');
        
        $access = Access::all();

        Menu::insert([
            [
                'id' => Str::uuid(),
                'name' => 'Dashboard',
                'sequence' => 1,
                'icon' => 'bi-grid-1x2',
                'access_id' => $access->firstWhere('name', 'dashboard.index')->id,
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Category',
                'sequence' => 2,
                'icon' => 'bi-database-gear',
                'access_id' => $access->firstWhere('name', 'category.index')->id,
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Staf',
                'sequence' => 3,
                'icon' => 'bi-people',
                'access_id' => $access->firstWhere('name', 'staf.index')->id,
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Berita',
                'sequence' => 4,
                'icon' => 'bi-newspaper',
                'access_id' => $access->firstWhere('name', 'berita.index')->id,
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Galery',
                'sequence' => 5,
                'icon' => 'bi-image',
                'access_id' => $access->firstWhere('name', 'galery.index')->id,
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Download',
                'sequence' => 6,
                'icon' => 'bi-download',
                'access_id' => $access->firstWhere('name', 'download.index')->id,
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Theme',
                'sequence' => 7,
                'icon' => 'bi-palette',
                'access_id' => $access->firstWhere('name', 'theme.index')->id,
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Section',
                'sequence' => 8,
                'icon' => 'bi-layout-wtf',
                'access_id' => $access->firstWhere('name', 'section.index')->id,
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Setting',
                'sequence' => 9,
                'icon' => 'bi-gear',
                'access_id' => $access->firstWhere('name', 'setting.index')->id,
            ],
        ]);
    }
}
