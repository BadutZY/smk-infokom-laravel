<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ppdb extends Model
{
    /**
     * Daftar pilihan agama pada formulir pendaftaran publik & validasi.
     */
    public const AGAMA = ['Islam', 'Kristen Protestan', 'Katolik', 'Hindu', 'Buddha', 'Konghucu', 'Lainnya'];

    protected $table = 'ppdb';

    public $timestamps = false;

    protected $fillable = [
        'nomor_pendaftaran',
        'nama',
        'nisn',
        'asal_sekolah',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'agama',
        'email',
        'telepon',
        'nama_orang_tua',
        'telepon_orang_tua',
        'pekerjaan_orang_tua',
        'pilihan1',
        'pilihan2',
        'alamat',
        'dokumen',
        'created_at',
    ];

    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
            'tanggal_lahir' => 'date',
        ];
    }
}