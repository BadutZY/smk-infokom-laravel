<?php

namespace App\Models;

use App\Support\Site;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KunjunganIndustriVideo extends Model
{
    protected $table = 'kunjungan_industri_video';

    protected $fillable = [
        'kunjungan_industri_id', 'judul', 'deskripsi', 'jenis', 'provider', 'rasio',
        'media_path', 'embed_url', 'source_url', 'sampul', 'urutan',
    ];

    public const JENIS = [
        'lokal' => 'Upload dari Komputer',
        'embed' => 'Embed dari Link',
    ];

    public const RASIO = [
        'auto' => 'Otomatis (ikuti sumber video)',
        'landscape' => 'Lebar / Landscape (16:9)',
        'portrait' => 'Tegak / Portrait (9:16)',
    ];

    public const PROVIDER = [
        'youtube' => 'YouTube',
        'vimeo' => 'Vimeo',
        'instagram' => 'Instagram',
        'tiktok' => 'TikTok',
        'facebook' => 'Facebook',
        'gdrive' => 'Google Drive',
        'file' => 'File Video (link langsung)',
        'lainnya' => 'Situs Lain',
        'upload' => 'Upload',
    ];

    public function lokasi(): BelongsTo
    {
        return $this->belongsTo(KunjunganIndustri::class, 'kunjungan_industri_id');
    }

    public function isPortrait(): bool
    {
        return $this->rasio === 'portrait';
    }

    public function providerLabel(): string
    {
        $key = $this->jenis === 'lokal' ? 'upload' : ($this->provider ?: 'lainnya');

        return self::PROVIDER[$key] ?? ucfirst($key);
    }

    /** Tag yang dipakai pemutar: <video> (file) atau <iframe> (embed). */
    public function playerType(): string
    {
        return ($this->jenis === 'lokal' || $this->provider === 'file') ? 'video' : 'iframe';
    }

    public function playerSrc(): ?string
    {
        if ($this->jenis === 'lokal') {
            return $this->media_path ? Site::imageUrl($this->media_path) : null;
        }

        return $this->embed_url;
    }

    public function posterUrl(): ?string
    {
        if ($this->sampul) {
            return Site::imageUrl($this->sampul);
        }

        // YouTube menyediakan gambar sampul otomatis.
        if ($this->provider === 'youtube' && $this->embed_url
            && preg_match('~/embed/([A-Za-z0-9_-]{11})~', $this->embed_url, $m)) {
            return 'https://i.ytimg.com/vi/'.$m[1].'/hqdefault.jpg';
        }

        return null;
    }

    /** Ikon untuk lencana jenis video. */
    public function icon(): string
    {
        return match ($this->provider) {
            'youtube' => 'youtube',
            'instagram' => 'instagram',
            'facebook' => 'facebook',
            default => 'video',
        };
    }

    /**
     * Mengubah link / kode embed yang ditempel admin menjadi data pemutar.
     * Mengembalikan ['provider', 'embed_url', 'source_url', 'rasio'] atau null bila tidak valid.
     * Mendukung: YouTube, Vimeo, Instagram, TikTok, Facebook, Google Drive,
     * link file video langsung (.mp4/.webm/.mov), kode <iframe ...>, dan link https lain.
     */
    public static function parseEmbed(string $input): ?array
    {
        $input = trim($input);
        if ($input === '') {
            return null;
        }

        // Admin menempel kode <iframe src="...">: ambil src-nya saja.
        if (stripos($input, '<iframe') !== false) {
            if (! preg_match('~src\s*=\s*["\']([^"\']+)["\']~i', $input, $m)) {
                return null;
            }
            $input = html_entity_decode(trim($m[1]));
            if (str_starts_with($input, '//')) {
                $input = 'https:'.$input;
            }
        }

        if (! preg_match('~^https?://~i', $input)) {
            // Hanya kode YouTube 11 karakter yang boleh tanpa "https://".
            if (preg_match('~^[A-Za-z0-9_-]{11}$~', $input)) {
                $input = 'https://www.youtube.com/watch?v='.$input;
            } else {
                return null;
            }
        }

        // YouTube
        if (preg_match('~(?:youtu\.be/|youtube(?:-nocookie)?\.com/(watch\?(?:.*&)?v=|embed/|shorts/|live/|v/))([A-Za-z0-9_-]{11})~', $input, $m)) {
            $id = $m[2];

            return [
                'provider' => 'youtube',
                'embed_url' => 'https://www.youtube-nocookie.com/embed/'.$id.'?autoplay=1&rel=0&playsinline=1',
                'source_url' => 'https://www.youtube.com/watch?v='.$id,
                'rasio' => str_contains($input, '/shorts/') ? 'portrait' : 'landscape',
            ];
        }

        // Vimeo
        if (preg_match('~vimeo\.com/(?:video/|channels/[^/]+/|groups/[^/]+/videos/)?(\d+)~', $input, $m)) {
            return [
                'provider' => 'vimeo',
                'embed_url' => 'https://player.vimeo.com/video/'.$m[1].'?autoplay=1',
                'source_url' => 'https://vimeo.com/'.$m[1],
                'rasio' => 'landscape',
            ];
        }

        // Instagram (reel / post / tv)
        if (preg_match('~instagram\.com/(?:[A-Za-z0-9_.]+/)?(reels?|p|tv)/([A-Za-z0-9_-]+)~', $input, $m)) {
            $tipe = $m[1] === 'reels' ? 'reel' : $m[1];

            return [
                'provider' => 'instagram',
                'embed_url' => 'https://www.instagram.com/'.$tipe.'/'.$m[2].'/embed/',
                'source_url' => 'https://www.instagram.com/'.$tipe.'/'.$m[2].'/',
                'rasio' => 'portrait',
            ];
        }

        // TikTok
        if (preg_match('~tiktok\.com/(?:@[A-Za-z0-9_.]+/video/|embed/v2/|embed/)(\d+)~', $input, $m)) {
            return [
                'provider' => 'tiktok',
                'embed_url' => 'https://www.tiktok.com/embed/v2/'.$m[1],
                'source_url' => $input,
                'rasio' => 'portrait',
            ];
        }

        // Facebook (video / reel / watch / fb.watch)
        if (preg_match('~(?:facebook\.com|fb\.watch)~i', $input)) {
            // Jika yang ditempel sudah berupa link plugin, ambil href aslinya.
            $href = $input;
            if (preg_match('~facebook\.com/plugins/video\.php\?(?:.*&)?href=([^&]+)~', $input, $m)) {
                $href = urldecode($m[1]);
            }

            return [
                'provider' => 'facebook',
                'embed_url' => 'https://www.facebook.com/plugins/video.php?href='.urlencode($href).'&show_text=false&autoplay=true',
                'source_url' => $href,
                'rasio' => str_contains($href, '/reel/') ? 'portrait' : 'landscape',
            ];
        }

        // Google Drive (file/d/ID)
        if (preg_match('~drive\.google\.com/(?:file/d/|open\?id=|uc\?(?:.*&)?id=)([A-Za-z0-9_-]+)~', $input, $m)) {
            return [
                'provider' => 'gdrive',
                'embed_url' => 'https://drive.google.com/file/d/'.$m[1].'/preview',
                'source_url' => 'https://drive.google.com/file/d/'.$m[1].'/view',
                'rasio' => 'landscape',
            ];
        }

        // Link file video langsung
        if (preg_match('~\.(mp4|webm|mov|m4v)(\?.*)?$~i', $input)) {
            return [
                'provider' => 'file',
                'embed_url' => $input,
                'source_url' => null,
                'rasio' => 'landscape',
            ];
        }

        // Situs lain: dimuat apa adanya dalam iframe (situs tujuan harus mengizinkan embed).
        if (filter_var($input, FILTER_VALIDATE_URL)) {
            return [
                'provider' => 'lainnya',
                'embed_url' => $input,
                'source_url' => $input,
                'rasio' => 'landscape',
            ];
        }

        return null;
    }
}