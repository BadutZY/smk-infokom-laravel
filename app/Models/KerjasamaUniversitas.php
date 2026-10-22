<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KerjasamaUniversitas extends Model
{
    protected $table = 'kerjasama_universitas';

    protected $fillable = ['urutan', 'nama', 'logo'];
}
