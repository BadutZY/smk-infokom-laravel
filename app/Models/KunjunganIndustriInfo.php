<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KunjunganIndustriInfo extends Model
{
    protected $table = 'kunjungan_industri_info';

    protected $fillable = ['judul', 'periode', 'kota_tujuan', 'intro'];
}