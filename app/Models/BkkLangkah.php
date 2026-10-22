<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BkkLangkah extends Model
{
    protected $table = 'bkk_langkah';

    protected $fillable = ['urutan', 'nomor', 'judul', 'deskripsi'];
}