<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrestasiBidang extends Model
{
    protected $table = 'prestasi_bidang';

    protected $fillable = ['urutan', 'icon', 'judul', 'deskripsi'];
}