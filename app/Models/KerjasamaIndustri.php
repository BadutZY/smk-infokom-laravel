<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KerjasamaIndustri extends Model
{
    protected $table = 'kerjasama_industri';

    protected $fillable = ['urutan', 'nama', 'logo'];
}
