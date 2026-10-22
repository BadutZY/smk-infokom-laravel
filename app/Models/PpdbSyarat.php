<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PpdbSyarat extends Model
{
    protected $table = 'ppdb_syarat';

    protected $fillable = ['urutan', 'isi'];
}
