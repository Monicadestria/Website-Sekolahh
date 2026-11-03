<?php

use App\Models\Menu;
use App\Models\User;
use App\Models\Access;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

if (!function_exists('resources_path')) {
    function resources_path($path = '') {
        return app()->basePath('resources').($path ? DIRECTORY_SEPARATOR.$path : $path);
    }
}

// definisi fungsi bantuan lainnya di sini jika ada

if (!function_exists('access_generate')) {
    function access_generate($id) {
        DB::beginTransaction();
        try {
            $access = Access::pluck('id')->toArray();
            $user = User::find($id);
            $result = $user->accesses()->sync($access);

            DB::commit();
            return $result;
        } catch (\Throwable $th) {
            DB::rollback();

            return $th;
        }
    }
}

if (!function_exists('menu_generate')) {
    function menu_generate($id) {
        DB::beginTransaction();
        try {
            $menu = Menu::pluck('id')->toArray();
            $user = User::find($id);
            $result = $user->menus()->sync($menu);

            DB::commit();
            return $result;
        } catch (\Throwable $th) {
            DB::rollback();
            return $th;
        }
    }
}

if (!function_exists('validator_errors')) {
    function validator_errors($validator) {
        $errors = $validator->errors();
        $allErrors = [];

        // Iterasi melalui semua field yang memiliki pesan kesalahan
        foreach ($errors->messages() as $field => $messages) {
            // Gabungkan semua pesan kesalahan untuk setiap field
            foreach ($messages as $message) {
                $allErrors[] = $message;
            }
        }

        // Gabungkan semua pesan kesalahan menjadi satu string
        $errorString = implode(' ', $allErrors);
        return $errorString;
    }
}

if (!function_exists('get_url_name')) {
    function get_url_name($name)
    {
        // Pecahkan url dengan '.'
        $parts = explode('.', $name);
        $names = [
            'password.request' => 'Lupa Password'
        ];

        if(isset($names[$name])) return $names[$name];

        $actions = [
            'index' => 'Tampilkan',
            'create' => 'Buat',
            'store' => 'Simpan',
            'show' => 'Tampilkan Detail',
            'edit' => 'Edit',
            'update' => 'Simpan Perubahan',
            'use' => 'Gunakan',
            'delete' => 'Hapus',
        ];
        // Ambil yang terakhir
        $actionCode = array_pop($parts);

        return ($actions[$actionCode] ?? ' ') . ' ' . implode(' ', array_map('ucfirst', $parts));
    }
}

if (!function_exists('get_url_path')) {
    function get_url_path($name)
    {
        $url = route($name, ['id' => '[id]', 'masterAjax' => '[id]', 'slug' => '[slug]', 'token' => '[token]', 'hash' => '[hash]']);

        $url = str_replace(url('/'), '', $url);
        $url = str_replace('%5B', '{', $url);
        $url = str_replace('%5D', '}', $url);

        $position = strpos($url, '?');

        return Str::substr($url, 0, $position);
    }
}

if (!function_exists('section_generate')) {
    function section_generate($user_id) {
        DB::beginTransaction();
        try {
            $section_ids = [];
            $hero_img_ids = [];
            $ghp_img_ids = [];
            for ($i = 1; $i <= 5; $i++) {
                $section_ids[] = (string) Str::uuid();
                if ($i <= 3) {
                    $hero_img_ids[] = (string) Str::uuid();
                    $ghp_img_ids[] = (string) Str::uuid();
                }
            }
            $hero_id = (string) Str::uuid();
            $tagline_id = (string) Str::uuid();
            $ghp_id = (string) Str::uuid();
            $line_id = (string) Str::uuid();
            $map_id = (string) Str::uuid();

            $section = [
                [
                    'id' =>  $section_ids[0],
                    'name' => 'Hero pengenalan paling atas',
                    'partial' => 'hero',
                    'jenis' => 'Hero',
                    'size' => 'full',
                    'urutan' => 1,
                    'margin_top' => 0,
                    'margin_bottom' => 50,
                    'active' => 1,
                    'created_by' => $user_id,
                    'updated_by' => $user_id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'id' =>  $section_ids[1],
                    'name' => 'Info pembelajaran',
                    'partial' => 'tagline',
                    'jenis' => 'Slogan',
                    'size' => 'full',
                    'urutan' => 2,
                    'margin_top' => 0,
                    'margin_bottom' => 50,
                    'active' => 1,
                    'created_by' => $user_id,
                    'updated_by' => $user_id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'id' =>  $section_ids[2],
                    'name' => 'tentang & visi misi',
                    'partial' => 'ghp',
                    'jenis' => 'Gambar Head Paragraf',
                    'size' => 'big',
                    'urutan' => 3,
                    'margin_top' => 0,
                    'margin_bottom' => 50,
                    'active' => 1,
                    'created_by' => $user_id,
                    'updated_by' => $user_id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'id' =>  $section_ids[3],
                    'name' => 'Garis biru pemisah ghp dan peta',
                    'partial' => 'line',
                    'jenis' => 'Garis',
                    'size' => 'full',
                    'urutan' => 4,
                    'margin_top' => 0,
                    'margin_bottom' => 50,
                    'active' => 1,
                    'created_by' => $user_id,
                    'updated_by' => $user_id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'id' =>  $section_ids[4],
                    'name' => 'Peta Vetencode',
                    'partial' => 'peta',
                    'jenis' => 'Peta',
                    'size' => 'full',
                    'urutan' => 5,
                    'margin_top' => 0,
                    'margin_bottom' => 50,
                    'active' => 1,
                    'created_by' => $user_id,
                    'updated_by' => $user_id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ];

            $hero = [
                'id' => $hero_id,
                'section_id' => $section_ids[0],
                'text_hero' => 'Proses Pembelajaran di Kelas',
                'text_button' => 'Lihat',
                'link_button' => '3',
                'created_by' => $user_id,
                'updated_by' => $user_id,
                'created_at' => now(),
                'updated_at' => now(),
            ];

            $heroImg = [
                [
                    'id' => $hero_img_ids[0],
                    'section_hero_id' => $hero_id,
                    'file' => $hero_img_ids[0] . '.png',
                    'created_by' => $user_id,
                    'updated_by' => $user_id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'id' => $hero_img_ids[1],
                    'section_hero_id' => $hero_id,
                    'file' => $hero_img_ids[1] . '.jpg',
                    'created_by' => $user_id,
                    'updated_by' => $user_id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'id' => $hero_img_ids[2],
                    'section_hero_id' => $hero_id,
                    'file' => $hero_img_ids[2] . '.jpeg',
                    'created_by' => $user_id,
                    'updated_by' => $user_id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ];

            $tagline = [
                'id' => $tagline_id,
                'section_id' => $section_ids[1],
                'name' => 'Selamat Datang di Website Sekolah Kami',
                'created_by' => '49508285-4879-40a4-93a3-0cdb6db30618',
                'updated_by' => '49508285-4879-40a4-93a3-0cdb6db30618',
                'created_by' => $user_id,
                'updated_by' => $user_id,
                'created_at' => now(),
                'updated_at' => now(),
            ];

            $ghp = [
                'id' => $ghp_id,
                'section_id' => $section_ids[2],
                'content' => '<h1>Tentang Kami</h1><div>Kami adalah sebuah institusi pendidikan yang berkomitmen untuk memberikan pendidikan berkualitas kepada para siswa. Dengan pengalaman yang luas dalam dunia pendidikan, kami menyediakan lingkungan belajar yang inspiratif dan mendukung perkembangan holistik setiap individu.<br><br></div><h1>Visi Misi</h1><div>Visi kami adalah menjadi lembaga pendidikan unggulan yang berorientasi pada inovasi dan pemberdayaan potensi siswa untuk menjadi individu yang berkualitas, berintegritas, dan mampu berkontribusi positif bagi masyarakat. Misi kami adalah:</div><ol><li>Memberikan pendidikan yang berkualitas dengan kurikulum yang berbasis kompetensi.</li><li>Mendorong kreativitas dan inovasi dalam proses pembelajaran.</li><li>Menyediakan lingkungan belajar yang aman, nyaman, dan mendukung.</li><li>Membangun karakter siswa yang berintegritas, bertanggung jawab, dan menghargai keberagaman.</li></ol>',
                'created_by' => $user_id,
                'updated_by' => $user_id,
                'created_at' => now(),
                'updated_at' => now(),
            ];

            $ghpImg = [
                [
                    'id' => $ghp_img_ids[0],
                    'section_ghp_id' => $ghp_id,
                    'file' => $ghp_img_ids[0] . '.png',
                    'created_by' => $user_id,
                    'updated_by' => $user_id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'id' => $ghp_img_ids[1],
                    'section_ghp_id' => $ghp_id,
                    'file' => $ghp_img_ids[1] . '.png',
                    'created_by' => $user_id,
                    'updated_by' => $user_id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'id' => $ghp_img_ids[2],
                    'section_ghp_id' => $ghp_id,
                    'file' => $ghp_img_ids[2] . '.png',
                    'created_by' => $user_id,
                    'updated_by' => $user_id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ];

            $line = [
                'id' => $line_id,
                'section_id' => $section_ids[3],
                'position' => 'center',
                'bold' => 5,
                'length' => 85,
                'round' => 1,
                'color' => '#80CEF9',
                'amount' => 1,
                'created_by' => $user_id,
                'updated_by' => $user_id,
                'created_at' => now(),
                'updated_at' => now(),
            ];

            $map = [
                'id' => $map_id,
                'section_id' => $section_ids[4],
                'url' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3961.7359559251254!2d107.15889847356354!3d-6.801942666522971!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68531746660c83%3A0x872f7eb20922929f!2sVetencode!5e0!3m2!1sen!2sid!4v1710854908514!5m2!1sen!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>',
                'created_by' => $user_id,
                'updated_by' => $user_id,
                'created_at' => now(),
                'updated_at' => now(),
            ];

            DB::table('sections')->insert($section);
            DB::table('section_heroes')->insert($hero);
            DB::table('section_hero_sliders')->insert($heroImg);
            DB::table('section_taglines')->insert($tagline);
            DB::table('section_ghps')->insert($ghp);
            DB::table('section_ghp_imgs')->insert($ghpImg);
            DB::table('section_lines')->insert($line);
            DB::table('section_maps')->insert($map);

            $sourceHeroImg1 = public_path('img/hero.png');
            $sourceHeroImg2 = public_path('img/hero-2.jpg');
            $sourceHeroImg3 = public_path('img/hero-3.jpeg');
            $sourceGhpImg1 = public_path('img/anak.png');
            $sourceGhpImg2 = public_path('img/anak-2.png');
            $sourceGhpImg3 = public_path('img/anak-3.png');

            $newHeroImg1 = $hero_img_ids[0] . '.png';
            $newHeroImg2 = $hero_img_ids[1] . '.jpg';
            $newHeroImg3 = $hero_img_ids[2] . '.jpeg';
            $newGhpImg1 = $ghp_img_ids[0] . '.png';
            $newGhpImg2 = $ghp_img_ids[1] . '.png';
            $newGhpImg3 = $ghp_img_ids[2] . '.png';

            // Path tujuan di storage
            $destinationHeroImg1 = storage_path('app/public/section/hero/' . $newHeroImg1);
            $destinationHeroImg2 = storage_path('app/public/section/hero/' . $newHeroImg2);
            $destinationHeroImg3 = storage_path('app/public/section/hero/' . $newHeroImg3);
            $destinationGhpImg1 = storage_path('app/public/section/ghp/' . $newGhpImg1);
            $destinationGhpImg2 = storage_path('app/public/section/ghp/' . $newGhpImg2);
            $destinationGhpImg3 = storage_path('app/public/section/ghp/' . $newGhpImg3);

            // Copy file dari sumber ke tujuan dengan nama baru
            File::copy($sourceHeroImg1, $destinationHeroImg1);
            File::copy($sourceHeroImg2, $destinationHeroImg2);
            File::copy($sourceHeroImg3, $destinationHeroImg3);
            File::copy($sourceGhpImg1, $destinationGhpImg1);
            File::copy($sourceGhpImg2, $destinationGhpImg2);
            File::copy($sourceGhpImg3, $destinationGhpImg3);

            DB::commit();
            return true;
        } catch (\Throwable $th) {
            DB::rollback();
            return $th;
        }
    }
}