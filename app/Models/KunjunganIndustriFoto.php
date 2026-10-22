<?php

namespace App\Models;

use App\Support\Site;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KunjunganIndustriFoto extends Model
{
    protected $table = 'kunjungan_industri_foto';

    protected $fillable = ['kunjungan_industri_id', 'path', 'keterangan', 'urutan'];

    public function lokasi(): BelongsTo
    {
        return $this->belongsTo(KunjunganIndustri::class, 'kunjungan_industri_id');
    }

    public function url(): string
    {
        return Site::imageUrl($this->path);
    }

    /** Foto bawaan (di public/images/...) tidak boleh ikut terhapus dari disk storage. */
    public function isUpload(): bool
    {
        return ! str_starts_with((string) $this->path, 'images/') && ! str_starts_with((string) $this->path, 'http');
    }
}