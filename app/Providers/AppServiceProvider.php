<?php

namespace App\Providers;

use App\Models\PesanKontak;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * PENTING: Dahulu "site" data diisi lewat View::share(...) yang langsung
     * mengeksekusi query ke database saat aplikasi boot (setiap kali provider
     * ini dijalankan, termasuk saat `composer install` menjalankan
     * `artisan package:discover`). Karena saat instalasi pertama tabel
     * database belum ada (migrasi belum dijalankan), query tersebut gagal
     * dan MEMBATALKAN proses composer install.
     *
     * Sekarang data "site" diisi lewat View::composer('*', ...) yang hanya
     * dieksekusi saat sebuah view benar-benar dirender (permintaan HTTP
     * biasa). Perintah artisan seperti package:discover, migrate, dsb tidak
     * merender view apa pun, sehingga tidak lagi memicu query database ini.
     * SiteData::all() sendiri juga sudah dibuat aman (lihat app/Support/SiteData.php)
     * dengan pengecekan tabel dan try/catch, jadi walau suatu saat method ini
     * terpanggil sebelum migrasi selesai, aplikasi tidak akan crash.
     */
    public function boot(): void
    {
        View::composer('layouts.admin', function ($view) {
            $unread = 0;

            try {
                if (Schema::hasTable('pesan_kontak')) {
                    $unread = PesanKontak::where('status', 'belum_dibaca')->count();
                }
            } catch (\Throwable $e) {
                $unread = 0;
            }

            $view->with('unreadBadge', $unread);
        });

        View::composer('*', function ($view) {
            $view->with('site', \App\Support\SiteData::all());
        });
    }
}