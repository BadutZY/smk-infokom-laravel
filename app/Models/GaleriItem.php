<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GaleriItem extends Model
{
    protected $table = 'galeri';

    protected $fillable = ['urutan', 'sumber', 'judul', 'kategori'];
}
