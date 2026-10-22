<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Jurusan extends Model
{
    protected $table = 'jurusan';

    protected $fillable = ['urutan', 'kode', 'nama', 'slug', 'deskripsi', 'gambar', 'gambar_lab', 'warna', 'poin', 'lingkup_kerja'];

    protected function casts(): array
    {
        return [
            'poin' => 'array',
            'lingkup_kerja' => 'array',
        ];
    }

    /**
     * Warna identitas jurusan yang SIAP DIPAKAI di tampilan (selalu berupa
     * kode hex valid seperti "#BD0AA2"):
     *  1. warna yang diatur admin (kolom `warna`), kalau valid;
     *  2. warna bawaan berdasarkan kode jurusan (config/site.php);
     *  3. warna cadangan bergiliran, supaya jurusan baru tetap punya warna.
     *
     * Aman dipakai walau kolom `warna` belum ada di database (belum migrate):
     * atribut yang tidak ada dianggap kosong, jadi otomatis jatuh ke bawaan.
     */
    public function getWarnaEfektifAttribute(): string
    {
        return self::resolveWarna($this->attributes['warna'] ?? null, $this->kode, (int) ($this->urutan ?? 0));
    }

    public static function resolveWarna(?string $warna, ?string $kode = null, int $index = 0): string
    {
        $warna = is_string($warna) ? strtoupper(trim($warna)) : '';
        if (preg_match('/^#[0-9A-F]{6}$/', $warna)) {
            return $warna;
        }

        $defaults = (array) config('site.jurusan_warna_default', []);
        $key = strtoupper(trim((string) $kode));
        if ($key !== '' && isset($defaults[$key])) {
            return strtoupper($defaults[$key]);
        }

        $spare = array_values((array) config('site.jurusan_warna_cadangan', ['#2563EB']));

        return strtoupper($spare[abs($index) % max(count($spare), 1)] ?? '#2563EB');
    }

    /**
     * Dipakai untuk route model binding (/akademik/jurusan/{jurusan})
     * supaya URL halaman detail jurusan pakai slug, bukan id numerik.
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    protected static function booted(): void
    {
        // Slug dibuat otomatis dari kode jurusan (mis. "TKJ" -> "tkj") setiap
        // kali data disimpan lewat panel admin, supaya admin tidak perlu
        // mengisi field slug secara manual dan URL tetap konsisten dengan kode.
        static::saving(function (Jurusan $jurusan) {
            $base = Str::slug($jurusan->kode ?: $jurusan->nama) ?: 'jurusan';
            $slug = $base;
            $i = 2;

            while (
                DB::table('jurusan')
                    ->where('slug', $slug)
                    ->when($jurusan->exists, fn ($q) => $q->where('id', '!=', $jurusan->id))
                    ->exists()
            ) {
                $slug = $base.'-'.$i++;
            }

            $jurusan->slug = $slug;
        });
    }
}