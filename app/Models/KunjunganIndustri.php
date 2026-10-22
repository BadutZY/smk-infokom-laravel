<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KunjunganIndustri extends Model
{
    protected $table = 'kunjungan_industri';

    protected $fillable = ['nama', 'kategori', 'icon', 'kota', 'deskripsi', 'sorotan', 'urutan'];

    /** Pilihan ikon yang tersedia untuk lokasi (nama ikon ada di components/icon.blade.php). */
    public const ICONS = [
        'school' => 'Kampus / Sekolah',
        'building' => 'Gedung / Perusahaan',
        'briefcase' => 'Industri / Kantor',
        'trees' => 'Alam / Wisata',
        'map-pin' => 'Lokasi Umum',
        'camera' => 'Museum / Dokumentasi',
        'monitor' => 'Teknologi',
        'star' => 'Spesial',
    ];

    public function fotos(): HasMany
    {
        return $this->hasMany(KunjunganIndustriFoto::class, 'kunjungan_industri_id')->orderBy('urutan')->orderBy('id');
    }

    public function videos(): HasMany
    {
        return $this->hasMany(KunjunganIndustriVideo::class, 'kunjungan_industri_id');
    }

    /** Poin sorotan (satu per baris di database). */
    public function sorotanList(): array
    {
        return array_values(array_filter(array_map('trim', preg_split('/\r\n|\r|\n/', (string) $this->sorotan) ?: [])));
    }
}