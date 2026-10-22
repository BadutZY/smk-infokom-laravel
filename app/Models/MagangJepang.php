<?php

namespace App\Models;

use App\Support\Site;
use Illuminate\Database\Eloquent\Model;

class MagangJepang extends Model
{
    protected $table = 'magang_jepang';

    protected $fillable = [
        'nama', 'handle', 'kota', 'angkatan', 'catatan',
        'jenis_media', 'media_path', 'media_ref', 'sampul',
        'tema', 'urutan',
    ];

    /** Pilihan jenis media (kunci disimpan di database). */
    public const JENIS = [
        'foto' => 'Foto',
        'video_lokal' => 'Video Upload',
        'youtube' => 'YouTube',
        'instagram' => 'Instagram',
    ];

    public const TEMA = [
        0 => 'Biru Laut',
        1 => 'Sakura',
        2 => 'Emas',
    ];

    public function isFoto(): bool
    {
        return $this->jenis_media === 'foto';
    }

    public function jenisLabel(): string
    {
        return self::JENIS[$this->jenis_media] ?? $this->jenis_media;
    }

    /** URL file upload (foto atau video lokal). */
    public function fileUrl(): ?string
    {
        return $this->media_path ? Site::imageUrl($this->media_path) : null;
    }

    /** Gambar latar kartu: foto itu sendiri, atau sampul untuk kartu video. */
    public function posterUrl(): ?string
    {
        if ($this->isFoto()) {
            return $this->fileUrl();
        }

        return $this->sampul ? Site::imageUrl($this->sampul) : null;
    }

    /** Alamat yang dimuat saat tombol putar ditekan. */
    public function embedSrc(): ?string
    {
        return match ($this->jenis_media) {
            'video_lokal' => $this->fileUrl(),
            'youtube' => 'https://www.youtube-nocookie.com/embed/'.$this->media_ref.'?autoplay=1&rel=0&playsinline=1',
            'instagram' => 'https://www.instagram.com/'.$this->media_ref.'/embed/',
            default => null,
        };
    }

    /** Tautan "buka di aplikasi asal" (hanya YouTube dan Instagram). */
    public function sourceUrl(): ?string
    {
        return match ($this->jenis_media) {
            'youtube' => 'https://www.youtube.com/watch?v='.$this->media_ref,
            'instagram' => 'https://www.instagram.com/'.$this->media_ref.'/',
            default => null,
        };
    }

    public function sourceLabel(): ?string
    {
        return match ($this->jenis_media) {
            'youtube' => 'Buka di YouTube',
            'instagram' => 'Buka di Instagram',
            default => null,
        };
    }

    public function profileUrl(): ?string
    {
        return $this->handle ? 'https://www.instagram.com/'.$this->handle.'/' : null;
    }

    /** Nilai yang ditampilkan kembali pada kolom link di form edit. */
    public function sourceUrlForForm(): string
    {
        return $this->sourceUrl() ?? '';
    }

    public function initials(): string
    {
        $kata = array_values(array_filter(preg_split('/\s+/', trim($this->nama)) ?: []));
        $inisial = collect($kata)->take(2)->map(fn ($w) => mb_strtoupper(mb_substr($w, 0, 1)))->implode('');

        return $inisial !== '' ? $inisial : '?';
    }

    /* ------------------------------------------------------------------
     | Parser link. Menerima link lengkap ATAU id/kode saja.
     ------------------------------------------------------------------ */

    /** Mengembalikan id video YouTube (11 karakter) atau null bila tidak valid. */
    public static function parseYoutube(string $input): ?string
    {
        $input = trim($input);

        if (preg_match('~^[A-Za-z0-9_-]{11}$~', $input)) {
            return $input;
        }

        if (preg_match('~(?:youtu\.be/|youtube(?:-nocookie)?\.com/(?:watch\?(?:.*&)?v=|embed/|shorts/|live/|v/))([A-Za-z0-9_-]{11})~', $input, $m)) {
            return $m[1];
        }

        return null;
    }

    /** Mengembalikan "reel/KODE" (atau "p/KODE", "tv/KODE") atau null bila tidak valid. */
    public static function parseInstagram(string $input): ?string
    {
        $input = trim($input);

        if (preg_match('~instagram\.com/(?:[A-Za-z0-9_.]+/)?(reels?|p|tv)/([A-Za-z0-9_-]+)~', $input, $m)) {
            $tipe = $m[1] === 'reels' ? 'reel' : $m[1];

            return $tipe.'/'.$m[2];
        }

        if (preg_match('~^[A-Za-z0-9_-]{6,}$~', $input)) {
            return 'reel/'.$input;
        }

        return null;
    }

    public static function normalizeHandle(?string $handle): ?string
    {
        $handle = trim((string) $handle);
        if ($handle === '') {
            return null;
        }

        if (preg_match('~instagram\.com/([A-Za-z0-9_.]+)~', $handle, $m)) {
            $handle = $m[1];
        }

        $handle = ltrim($handle, '@');

        return $handle !== '' ? $handle : null;
    }
}