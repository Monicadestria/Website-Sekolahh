<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Web\StafController;
use App\Http\Controllers\Web\ThemeController;
use App\Http\Controllers\Web\AccessController;
use App\Http\Controllers\Web\BeritaController;
use App\Http\Controllers\Web\GaleryController;
use App\Http\Controllers\Web\MasterController;
use App\Http\Controllers\Web\SectionController;
use App\Http\Controllers\Web\SettingController;
use App\Http\Controllers\Web\DownloadController;
use App\Http\Controllers\Web\UserMenuController;
use App\Http\Controllers\Web\DashboardController;
use App\Http\Controllers\Web\MenuController;
use App\Http\Controllers\Web\MasterController as WebMasterController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// sepertinya udah tidak dipake, dipake waktu awal" nampilin section home end user
Route::get('/', function () {
    // session()->flash('success', 'Data berhasil disimpan.');
    // session()->flash('warning', 'Data PERHATIIANAIA.');
    // session()->flash('error', 'GAGAGAAAL.');
    return view('school_index');
})->name('landing_page');

Route::middleware(['auth', 'verified', 'access'])->group(function () {
    // Route Dashboard
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    // Route Section
    Route::prefix('section')->group(function () {
        Route::get('', [SectionController::class, 'index'])->name('section.index');
        Route::get('pratinjau', [SectionController::class, 'getPratinjauSection'])->name('pratinjau.data');
        Route::get('table', [SectionController::class, 'sectionTable'])->name('section.table');
        Route::get('slider/{id}', [SectionController::class, 'detailSlider'])->name('section.detail.slider');
        Route::get('hero/{id}', [SectionController::class, 'detailHero'])->name('section.detail.hero');
        Route::get('ghp/{id}', [SectionController::class, 'detailGhp'])->name('section.detail.ghp');
        Route::get('{id}/detail', [SectionController::class, 'detailSection'])->name('section.detail');
        Route::get('create', [SectionController::class, 'create'])->name('section.create');
        Route::post('store', [SectionController::class, 'store'])->name('section.store');
        Route::put('update/{id}', [SectionController::class, 'update'])->name('section.update');
        Route::put('updateDetail/{id}', [SectionController::class, 'updateDetail'])->name('section.updateDetail');
        Route::post('updateDetail/{id}', [SectionController::class, 'updateDetail'])->name('section.updateDetailPost'); //gambar ajax pakai post
        Route::put('naik/{id}', [SectionController::class, 'naik'])->name('section.naik');
        Route::put('turun/{id}', [SectionController::class, 'turun'])->name('section.turun');
        Route::put('active/{id}', [SectionController::class, 'active'])->name('section.active');
        Route::delete('deleteImg/{id}', [SectionController::class, 'deleteImg'])->name('section.deleteImg');
        Route::delete('delete/{id}', [SectionController::class, 'delete'])->name('section.delete');
    });

    // Route Setting
    Route::prefix('setting')->group(function () {
        Route::get('', [SettingController::class, 'index'])->name('setting.index');
        Route::put('{id}/update', [SettingController::class, 'update'])->name('setting.update');
    });

    // Route Galery
    Route::prefix('galery')->group(function () {
        Route::get('', [GaleryController::class, 'index'])->name('galery.index');
        Route::get('create', [GaleryController::class, 'create'])->name('galery.create');
        Route::post('', [GaleryController::class, 'store'])->name('galery.store');
        Route::get('{id}', [GaleryController::class, 'show'])->name('galery.show');
        Route::get('{id}/edit', [GaleryController::class, 'edit'])->name('galery.edit');
        Route::put('{id}/update', [GaleryController::class, 'update'])->name('galery.update');
        Route::delete('{id}/delete', [GaleryController::class, 'delete'])->name('galery.delete');
    });

    // Route Theme
    Route::prefix('themes')->group(function () {
        Route::get('', [ThemeController::class, 'index'])->name('theme.index');
        Route::get('create', [ThemeController::class, 'create'])->name('theme.create');
        Route::post('', [ThemeController::class, 'store'])->name('theme.store');
        Route::get('{id}', [ThemeController::class, 'show'])->name('theme.show');
        Route::put('{id}/use', [ThemeController::class, 'use'])->name('theme.use');
        Route::get('{id}/edit', [ThemeController::class, 'edit'])->name('theme.edit');
        Route::put('{id}', [ThemeController::class, 'update'])->name('theme.update');
        Route::delete('{id}/delete', [ThemeController::class, 'delete'])->name('theme.delete');
    });

    // Route Berita
    Route::prefix('berita')->group(function () {
        Route::get('', [BeritaController::class, 'index'])->name('berita.index');
        Route::get('/create', [BeritaController::class, 'create'])->name('berita.create');
        Route::get('/create/checkSlug', [BeritaController::class, 'checkSlug'])->name('check-slug');
        Route::post('/store', [BeritaController::class, 'store'])->name('berita.store');
        Route::post('/upload', [BeritaController::class, 'upload'])->name('upload');
        Route::get('/show/{id}', [BeritaController::class, 'show'])->name('berita.show');
        Route::get('/edit/{id}', [BeritaController::class, 'edit'])->name('berita.edit');
        Route::put('/update/{id}', [BeritaController::class, 'update'])->name('berita.update');
        Route::delete('/delete/{id}', [BeritaController::class, 'delete'])->name('berita.delete');
        Route::post('{id}/status', [BeritaController::class, 'status'])->name('berita.status');
    });

    // Route Staf
    Route::prefix('staf')->group(function () {
        Route::get('/', [StafController::class, 'index'])->name('staf.index');
        Route::get('/create', [StafController::class, 'create'])->name('staf.create');
        Route::post('/store', [StafController::class, 'store'])->name('staf.store');
        Route::get('/show/{id}', [StafController::class, 'show'])->name('staf.show');
        Route::get('/edit/{id}', [StafController::class, 'edit'])->name('staf.edit');
        Route::put('/update/{id}', [StafController::class, 'update'])->name('staf.update');
        Route::delete('/delete/{id}', [StafController::class, 'delete'])->name('staf.delete');
        Route::post('{id}/status', [StafController::class, 'status'])->name('staf.status');
    });

    // Route Download
    Route::prefix('download')->group(function () {
        Route::get('', [DownloadController::class, 'index'])->name('download.index');
        Route::get('/create', [DownloadController::class, 'create'])->name('download.create');
        Route::post('/store', [DownloadController::class, 'store'])->name('download.store');
        Route::get('/show/{id}', [DownloadController::class, 'show'])->name('download.show');
        Route::get('/edit/{id}', [DownloadController::class, 'edit'])->name('download.edit');
        Route::put('/update/{id}', [DownloadController::class, 'update'])->name('download.update');
        Route::delete('/delete/{id}', [DownloadController::class, 'delete'])->name('download.delete');
        Route::get('/status/{id}', [DownloadController::class, 'status']);
    });

    // AJAX Master
    Route::get('/master', function () {
        return view('category.Master');
    })->name('category.index');

    Route::resource('masterAjax', MasterController::class);

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Super Admin Routes
Route::middleware('super.admin')->group(function () {
    Route::prefix('menu')->group(function () {
        Route::get('', [MenuController::class, 'index'])->name('menu.index');
        Route::get('create', [MenuController::class, 'create'])->name('menu.create');
        Route::post('store', [MenuController::class, 'store'])->name('menu.store');
        Route::get('{id}/edit', [MenuController::class, 'edit'])->name('menu.edit');
        Route::put('{id}', [MenuController::class, 'update'])->name('menu.update');
        Route::delete('{id}', [MenuController::class, 'delete'])->name('menu.delete');
    });
    
    Route::prefix('user-menu')->group(function () {
        Route::get('', [UserMenuController::class, 'index'])->name('user_menu.index');
        Route::get('create', [UserMenuController::class, 'create'])->name('user_menu.create');
        Route::post('store', [UserMenuController::class, 'store'])->name('user_menu.store');
        Route::get('{id}/edit', [UserMenuController::class, 'edit'])->name('user_menu.edit');
        Route::put('{id}', [UserMenuController::class, 'update'])->name('user_menu.update');
        Route::delete('{id}', [UserMenuController::class, 'delete'])->name('user_menu.delete');
    
        Route::get('{id}/menu', [UserMenuController::class, 'menu'])->name('user_menu.menu');
        Route::post('{id}/menu', [UserMenuController::class, 'menu_store'])->name('user_menu.menu_store');
        Route::get('{id}/access', [UserMenuController::class, 'access'])->name('user_menu.access');
        Route::post('{id}/access', [UserMenuController::class, 'access_store'])->name('user_menu.access_store');
    });
    
    Route::prefix('access')->group(function () {
        Route::get('', [AccessController::class, 'index'])->name('access.index');
        Route::get('sync', [AccessController::class, 'sync'])->name('access.sync');
    });
});

require __DIR__ . '/auth.php';
require __DIR__ . '/lp_web.php';
