<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MagangJepangAlasan extends Model
{
    protected $table = 'magang_jepang_alasan';

    protected $fillable = ['urutan', 'icon', 'judul', 'deskripsi'];
}