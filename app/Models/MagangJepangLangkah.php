<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MagangJepangLangkah extends Model
{
    protected $table = 'magang_jepang_langkah';

    protected $fillable = ['urutan', 'nomor', 'judul', 'deskripsi'];
}