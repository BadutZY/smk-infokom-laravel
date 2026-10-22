<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BkkLayanan extends Model
{
    protected $table = 'bkk_layanan';

    protected $fillable = ['urutan', 'icon', 'judul', 'deskripsi'];
}