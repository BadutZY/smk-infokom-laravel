<?php

namespace App\Support;

use Illuminate\Support\Str;

class Site
{
    /**
     * Mengubah path gambar (dari config statis, atau dari storage upload)
     * menjadi URL yang bisa diakses browser.
     */
    public static function imageUrl(?string $path): string
    {
        if (! $path) {
            return asset('images/infokom-hero.jpg');
        }

        if (Str::startsWith($path, ['http://', 'https://'])) {
            return $path;
        }

        if (Str::startsWith($path, 'images/')) {
            return asset($path);
        }

        return asset('storage/'.ltrim($path, '/'));
    }

    public static function formatTanggal(?string $value): string
    {
        if (! $value) {
            return '';
        }

        try {
            return \Carbon\Carbon::parse($value)->translatedFormat('j F Y');
        } catch (\Throwable) {
            return $value;
        }
    }

    public static function formatTanggalPanjang(?string $value): string
    {
        if (! $value) {
            return '';
        }

        try {
            return \Carbon\Carbon::parse($value)->translatedFormat('l, j F Y');
        } catch (\Throwable) {
            return $value;
        }
    }

    public static function rupiah(int $value): string
    {
        return 'Rp'.number_format($value, 0, ',', '.');
    }

    public static function slug(string $judul): string
    {
        $slug = Str::slug($judul);

        return $slug !== '' ? $slug : 'berita';
    }
}
