<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PpdbBiaya extends Model
{
    protected $table = 'ppdb_biaya';

    protected $fillable = ['urutan', 'jenis', 'gelombang1', 'gelombang2', 'gelombang3'];
}
