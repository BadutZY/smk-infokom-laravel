<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fasilitas extends Model
{
    protected $table = 'fasilitas';

    /**
     * Kolom `icon`, `gambar` (foto utama), dan `gambar_2` (foto tambahan,
     * opsional) ditambahkan oleh migration
     * 2026_09_30_000001_add_gambar_icon_to_fasilitas_table.php.
     */
    protected $fillable = ['urutan', 'kategori', 'judul', 'deskripsi', 'icon', 'gambar', 'gambar_2'];
}