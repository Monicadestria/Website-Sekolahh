<?php

use App\Http\Controllers\Web\LP\LPBeritaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\LP\LPStaffController;
use App\Http\Controllers\Web\LP\LPGaleryController;
use App\Http\Controllers\Web\LP\LPHomeController;
use App\Http\Controllers\Web\LP\LPDownloadController;

Route::prefix('{slug}')->group(function () {
    // Galery
    Route::prefix('galery')->group(function () {
        Route::get('gambar', [LPGaleryController::class, 'gambar_index'])->name('lp.galery.gambar.index');
        Route::get('gambar/{id}', [LPGaleryController::class, 'gambar_show'])->name('lp.galery.gambar.show');
        Route::get('video', [LPGaleryController::class, 'video_index'])->name('lp.galery.video.index');
        Route::get('video/{id}', [LPGaleryController::class, 'video_show'])->name('lp.galery.video.show');
    });

    // Staff
    Route::prefix('staff')->group(function () {
        Route::get('/', [LPStaffController::class, 'landing'])->name('lp.staff.index');
        // Route::get('/detail/{id}', [LPStaffController::class, 'detail'])->name('lp.staff.show');
    });

    // Berita
    Route::prefix('berita')->group(function() {
        Route::get('/', [LPBeritaController::class, 'landing'])->name('lp.berita.index');
        Route::get('/detail/{id}', [LPBeritaController::class, 'detail'])->name('lp.berita.show');
        Route::get('/search', [LPBeritaController::class, 'search'])->name('lp.berita.search');
    });

    // Home
    Route::prefix('')->group(function () {
        Route::get('', [LPHomeController::class, 'index'])->name('lp.home.index');
    });

    // Download
    Route::prefix('download')->group(function () {
        Route::get('', [LPDownloadController::class, 'landing_download'])->name('lp.unduh.index');
        Route::get('category', [LPDownloadController::class, 'getCategories'])->name('lp.unduh.category');
        Route::post('/click/{id}', [LPDownloadController::class, 'tekan_unduh'])->name('lp.download.click');
    });
});
