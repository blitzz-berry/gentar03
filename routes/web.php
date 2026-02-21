<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PengurusController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\PesanKontakController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;

Route::get('/', [HomeController::class, 'index'])->name('welcome');

Route::view('tentang-kami', 'tentang-kami')->name('tentang-kami');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

// Routes untuk manajemen pengurus
Route::resource('pengurus', PengurusController::class)
    ->middleware(['auth'])
    ->parameters(['pengurus' => 'pengurus'])
    ->names('pengurus');

// Routes untuk manajemen kegiatan (admin)
Route::resource('admin/kegiatan', KegiatanController::class)
    ->middleware(['auth'])
    ->names('admin.kegiatan');

// Routes untuk public kegiatan
Route::get('/kegiatan', [KegiatanController::class, 'indexPublic'])->name('kegiatan.index');
Route::get('/kegiatan/{kegiatan}', [KegiatanController::class, 'showPublic'])->name('kegiatan.show');

// Routes untuk manajemen galeri (admin)
Route::resource('admin/galeri', GaleriController::class)
    ->middleware(['auth'])
    ->names('admin.galeri');

// Routes untuk public galeri
Route::get('/galeri', [GaleriController::class, 'indexPublic'])->name('galeri.index');
Route::get('/galeri/{galeri}', [GaleriController::class, 'showPublic'])->name('galeri.show');

// Routes untuk manajemen artikel (admin)
Route::resource('admin/artikel', ArtikelController::class)
    ->middleware(['auth'])
    ->names('admin.artikel');

// Routes untuk public artikel
Route::get('/artikel', [ArtikelController::class, 'indexPublic'])->name('artikel.index');
Route::get('/artikel/{artikel}', [ArtikelController::class, 'showPublic'])->name('artikel.show');

// Routes untuk manajemen pesan kontak (admin)
Route::resource('pesan-kontak', PesanKontakController::class)
    ->middleware(['auth'])
    ->parameters(['pesan-kontak' => 'pesanKontak'])
    ->names('pesan-kontak');

// Route khusus untuk balas pesan
Route::post('/pesan-kontak/{pesanKontak}/balas', [PesanKontakController::class, 'balas'])
    ->middleware(['auth'])
    ->name('pesan-kontak.balas');

// Route untuk public form pesan kontak
Route::get('/kontak', [PesanKontakController::class, 'createPublic'])->name('kontak.create');
Route::post('/kontak', [PesanKontakController::class, 'store'])->name('kontak.store');

require __DIR__.'/auth.php';
