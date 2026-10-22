<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfilSekolah extends Model
{
    protected $table = 'profil_sekolah';

    protected $fillable = [
        'nama',
        'nama_singkat',
        'brand_atas',
        'brand_bawah',
        'tagline',
        'alamat',
        'telepon',
        'whatsapp',
        'email',
        'jam_operasional',
        'kepala_sekolah',
        'visi',
        'sejarah',
        'kata_pengantar',
        'gambar_hero',
        'gambar_siswa',
        'gambar_kepala_sekolah',
        'total_biaya_gelombang1',
        'total_biaya_gelombang2',
        'total_biaya_gelombang3',
    ];
}