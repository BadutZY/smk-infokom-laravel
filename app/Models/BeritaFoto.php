<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BeritaFoto extends Model
{
    protected $table = 'berita_foto';

    public $timestamps = false;

    protected $fillable = [
        'berita_id',
        'url_gambar',
        'urutan',
    ];

    public function berita(): BelongsTo
    {
        return $this->belongsTo(Berita::class);
    }
}
