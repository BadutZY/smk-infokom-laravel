<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BkkFollow extends Model
{
    protected $table = 'bkk_follow';

    protected $fillable = ['urutan', 'icon', 'judul', 'deskripsi'];
}