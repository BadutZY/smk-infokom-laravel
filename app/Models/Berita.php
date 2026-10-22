<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Berita extends Model
{
    protected $table = 'berita';

    protected $fillable = [
        'slug',
        'judul',
        'kategori',
        'ringkasan',
        'konten',
        'gambar_sampul',
        'penulis',
        'tanggal',
    ];

    protected function casts(): array
    {
        return [
            'tanggal' => 'date',
        ];
    }

    public function foto(): HasMany
    {
        return $this->hasMany(BeritaFoto::class)->orderBy('urutan')->orderBy('id');
    }
}
