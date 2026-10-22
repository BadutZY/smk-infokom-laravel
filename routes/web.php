<?php

use App\Http\Controllers\Admin\BeritaController as AdminBeritaController;
use App\Http\Controllers\Admin\BkkController as AdminBkkController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PesanController;
use App\Http\Controllers\Admin\PpdbController as AdminPpdbController;
use App\Http\Controllers\Admin\GuruStaffController as AdminGuruStaffController;
use App\Http\Controllers\Admin\KontenController;
use App\Http\Controllers\Admin\KunjunganIndustriController as AdminKunjunganIndustriController;
use App\Http\Controllers\Admin\MagangJepangController as AdminMagangJepangController;
use App\Http\Controllers\Admin\PrestasiSekolahController as AdminPrestasiSekolahController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\AkademikController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\BkkController;
use App\Http\Controllers\ChatbotController;
use App\Http\Controllers\FasilitasController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\GuruStaffController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KontakController;
use App\Http\Controllers\KunjunganIndustriController;
use App\Http\Controllers\MagangJepangController;
use App\Http\Controllers\PpdbController;
use App\Http\Controllers\PrestasiController;
use App\Http\Controllers\ProfilController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Halaman Publik
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/profil', [ProfilController::class, 'index'])->name('profil');
Route::get('/fasilitas', [FasilitasController::class, 'index'])->name('fasilitas');
Route::get('/akademik', [AkademikController::class, 'index'])->name('akademik');
Route::get('/akademik/jurusan/{slug}', [AkademikController::class, 'jurusanShow'])->name('akademik.jurusan');
Route::get('/guru-staff', [GuruStaffController::class, 'index'])->name('guru-staff');
Route::get('/berita', [BeritaController::class, 'index'])->name('berita.index');
Route::get('/berita/{slug}', [BeritaController::class, 'show'])->name('berita.show');
Route::get('/galeri', [GaleriController::class, 'index'])->name('galeri');
Route::get('/prestasi', [PrestasiController::class, 'index'])->name('prestasi');
Route::get('/magang-jepang', [MagangJepangController::class, 'index'])->name('magang-jepang');
Route::get('/kunjungan-industri', [KunjunganIndustriController::class, 'index'])->name('kunjungan-industri');
Route::get('/bkk', [BkkController::class, 'index'])->name('bkk');
Route::get('/ppdb', [PpdbController::class, 'create'])->name('ppdb');
Route::post('/ppdb', [PpdbController::class, 'store'])->name('ppdb.store');
Route::get('/kontak', [KontakController::class, 'create'])->name('kontak');
Route::post('/kontak', [KontakController::class, 'store'])->name('kontak.store');

// Chatbot AI (Gemini). Dibatasi 20 pesan/menit per pengguna (IP) agar kuota API aman.
Route::post('/chatbot/ask', [ChatbotController::class, 'ask'])->middleware('throttle:20,1')->name('chatbot.ask');

/*
|--------------------------------------------------------------------------
| Autentikasi Admin
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.attempt');
    Route::get('/lupa-password', [AuthController::class, 'showForgot'])->name('lupa-password');
    Route::post('/lupa-password', [AuthController::class, 'forgot'])->name('lupa-password.submit');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Panel Admin
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/berita', [AdminBeritaController::class, 'index'])->name('berita.index');
    Route::get('/berita/baru', [AdminBeritaController::class, 'create'])->name('berita.create');
    Route::post('/berita', [AdminBeritaController::class, 'store'])->name('berita.store');
    Route::get('/berita/{berita}/edit', [AdminBeritaController::class, 'edit'])->name('berita.edit');
    Route::put('/berita/{berita}', [AdminBeritaController::class, 'update'])->name('berita.update');
    Route::delete('/berita/{berita}', [AdminBeritaController::class, 'destroy'])->name('berita.destroy');

    Route::get('/ppdb', [AdminPpdbController::class, 'index'])->name('ppdb.index');
    Route::get('/ppdb/{ppdb}/download', [AdminPpdbController::class, 'download'])->name('ppdb.download');
    Route::delete('/ppdb/{ppdb}', [AdminPpdbController::class, 'destroy'])->name('ppdb.destroy');

    Route::get('/guru-staff', [AdminGuruStaffController::class, 'index'])->name('guru-staff.index');
    Route::get('/guru-staff/baru', [AdminGuruStaffController::class, 'create'])->name('guru-staff.create');
    Route::post('/guru-staff', [AdminGuruStaffController::class, 'store'])->name('guru-staff.store');
    Route::get('/guru-staff/{guruStaff}/edit', [AdminGuruStaffController::class, 'edit'])->name('guru-staff.edit');
    Route::put('/guru-staff/{guruStaff}', [AdminGuruStaffController::class, 'update'])->name('guru-staff.update');
    Route::delete('/guru-staff/{guruStaff}', [AdminGuruStaffController::class, 'destroy'])->name('guru-staff.destroy');

    Route::get('/prestasi-sekolah', [AdminPrestasiSekolahController::class, 'index'])->name('prestasi-sekolah.index');
    Route::get('/prestasi-sekolah/baru', [AdminPrestasiSekolahController::class, 'create'])->name('prestasi-sekolah.create');
    Route::post('/prestasi-sekolah', [AdminPrestasiSekolahController::class, 'store'])->name('prestasi-sekolah.store');
    Route::get('/prestasi-sekolah/{prestasiSekolah}/edit', [AdminPrestasiSekolahController::class, 'edit'])->name('prestasi-sekolah.edit');
    Route::put('/prestasi-sekolah/{prestasiSekolah}', [AdminPrestasiSekolahController::class, 'update'])->name('prestasi-sekolah.update');
    Route::delete('/prestasi-sekolah/{prestasiSekolah}', [AdminPrestasiSekolahController::class, 'destroy'])->name('prestasi-sekolah.destroy');

    Route::get('/magang-jepang', [AdminMagangJepangController::class, 'index'])->name('magang-jepang.index');
    Route::get('/magang-jepang/baru', [AdminMagangJepangController::class, 'create'])->name('magang-jepang.create');
    Route::post('/magang-jepang', [AdminMagangJepangController::class, 'store'])->name('magang-jepang.store');
    Route::get('/magang-jepang/{magangJepang}/edit', [AdminMagangJepangController::class, 'edit'])->name('magang-jepang.edit');
    Route::put('/magang-jepang/{magangJepang}', [AdminMagangJepangController::class, 'update'])->name('magang-jepang.update');
    Route::delete('/magang-jepang/{magangJepang}', [AdminMagangJepangController::class, 'destroy'])->name('magang-jepang.destroy');

    Route::get('/kunjungan-industri', [AdminKunjunganIndustriController::class, 'index'])->name('kunjungan-industri.index');
    Route::put('/kunjungan-industri/info', [AdminKunjunganIndustriController::class, 'updateInfo'])->name('kunjungan-industri.info.update');

    Route::get('/kunjungan-industri/lokasi/baru', [AdminKunjunganIndustriController::class, 'createLokasi'])->name('kunjungan-industri.lokasi.create');
    Route::post('/kunjungan-industri/lokasi', [AdminKunjunganIndustriController::class, 'storeLokasi'])->name('kunjungan-industri.lokasi.store');
    Route::get('/kunjungan-industri/lokasi/{lokasi}/edit', [AdminKunjunganIndustriController::class, 'editLokasi'])->name('kunjungan-industri.lokasi.edit');
    Route::put('/kunjungan-industri/lokasi/{lokasi}', [AdminKunjunganIndustriController::class, 'updateLokasi'])->name('kunjungan-industri.lokasi.update');
    Route::delete('/kunjungan-industri/lokasi/{lokasi}', [AdminKunjunganIndustriController::class, 'destroyLokasi'])->name('kunjungan-industri.lokasi.destroy');

    Route::get('/kunjungan-industri/video/baru', [AdminKunjunganIndustriController::class, 'createVideo'])->name('kunjungan-industri.video.create');
    Route::post('/kunjungan-industri/video', [AdminKunjunganIndustriController::class, 'storeVideo'])->name('kunjungan-industri.video.store');
    Route::get('/kunjungan-industri/video/{video}/edit', [AdminKunjunganIndustriController::class, 'editVideo'])->name('kunjungan-industri.video.edit');
    Route::put('/kunjungan-industri/video/{video}', [AdminKunjunganIndustriController::class, 'updateVideo'])->name('kunjungan-industri.video.update');
    Route::delete('/kunjungan-industri/video/{video}', [AdminKunjunganIndustriController::class, 'destroyVideo'])->name('kunjungan-industri.video.destroy');

    Route::get('/bkk', [AdminBkkController::class, 'index'])->name('bkk.index');
    Route::get('/bkk/baru', [AdminBkkController::class, 'create'])->name('bkk.create');
    Route::post('/bkk', [AdminBkkController::class, 'store'])->name('bkk.store');
    Route::put('/bkk/konten', [AdminBkkController::class, 'updateKonten'])->name('bkk.konten.update');
    Route::get('/bkk/{bkk}/edit', [AdminBkkController::class, 'edit'])->name('bkk.edit');
    Route::put('/bkk/{bkk}', [AdminBkkController::class, 'update'])->name('bkk.update');
    Route::delete('/bkk/{bkk}', [AdminBkkController::class, 'destroy'])->name('bkk.destroy');

    Route::get('/pesan', [PesanController::class, 'index'])->name('pesan.index');
    Route::post('/pesan/{pesan}/baca', [PesanController::class, 'show'])->name('pesan.show');
    Route::delete('/pesan/{pesan}', [PesanController::class, 'destroy'])->name('pesan.destroy');

    Route::prefix('konten')->name('konten.')->group(function () {
        // Setiap halaman publik (Profil, Akademik, PPDB, Galeri) punya
        // halaman kelola kontennya sendiri di admin (bukan digabung jadi
        // satu halaman "Konten Website" seperti sebelumnya).
        Route::get('/profil', [KontenController::class, 'profil'])->name('profil');
        Route::put('/profil', [KontenController::class, 'updateProfil'])->name('profil.update');
        Route::put('/profil/visi-misi', [KontenController::class, 'updateVisi'])->name('profil.visi');

        // Fasilitas punya halaman kelola sendiri (terpisah dari Profil Sekolah).
        Route::get('/fasilitas', [KontenController::class, 'fasilitas'])->name('fasilitas');

        Route::get('/akademik', [KontenController::class, 'akademik'])->name('akademik');
        Route::get('/ppdb', [KontenController::class, 'ppdb'])->name('ppdb');
        Route::get('/galeri', [KontenController::class, 'galeri'])->name('galeri');

        // CRUD generik untuk resource di dalam sebuah grup/halaman di atas,
        // contoh: /admin/konten/akademik/jurusan/baru
        Route::get('/{group}/{resource}/baru', [KontenController::class, 'create'])->name('create');
        Route::post('/{group}/{resource}', [KontenController::class, 'store'])->name('store');
        Route::get('/{group}/{resource}/{id}/edit', [KontenController::class, 'edit'])->name('edit');
        Route::put('/{group}/{resource}/{id}', [KontenController::class, 'update'])->name('update');
        Route::delete('/{group}/{resource}/{id}', [KontenController::class, 'destroy'])->name('destroy');
    });

    Route::get('/pengaturan', [SettingsController::class, 'edit'])->name('settings');
    Route::put('/pengaturan', [SettingsController::class, 'update'])->name('settings.update');
});