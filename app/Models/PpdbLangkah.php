<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PpdbLangkah extends Model
{
    protected $table = 'ppdb_langkah';

    protected $fillable = ['urutan', 'nomor', 'judul', 'deskripsi'];
}
