<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PpdbJadwal extends Model
{
    protected $table = 'ppdb_jadwal';

    protected $fillable = ['urutan', 'periode', 'agenda'];
}
