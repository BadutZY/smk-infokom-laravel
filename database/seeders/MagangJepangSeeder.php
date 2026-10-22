<?php

namespace Database\Seeders;

use App\Models\MagangJepang;
use Illuminate\Database\Seeder;

/**
 * Data alumni Magang Jepang SMK INFOKOM.
 *
 * Baris dasarnya (nama, handle, kota, angkatan, catatan, media Instagram)
 * sudah diisi otomatis lewat migration `create_magang_jepang_table`. Seeder
 * ini MENYAMAKAN seluruh kolom (termasuk `sampul`, yang baru diunggah admin
 * lewat panel setelah migration berjalan) persis dengan dump
 * `sekolah_db.sql`, dicocokkan lewat kolom `nama` supaya aman dijalankan
 * berulang kali maupun di database yang sudah pernah dimigrasikan sebelumnya
 * (mengacu ke berkas yang sudah ada di storage/app/public/magang-jepang).
 */
class MagangJepangSeeder extends Seeder
{
    public function run(): void
    {
        $rows = [
            [
                'nama' => 'Surya Difraja',
                'handle' => '_.prajaa',
                'kota' => 'Tokyo',
                'angkatan' => 'Angkatan XVII',
                'catatan' => 'Selamat sampai Negeri Sakura (Tokyo) & betah-betah disana. Terbang tinggi menembus batas untuk mengejar cita-cita dan masa depanmu yang manis.',
                'jenis_media' => 'instagram',
                'media_path' => null,
                'media_ref' => 'reel/DZE77u4oNN_',
                'sampul' => 'magang-jepang/sampul/1xFvCE0vlj8ROAXJhrnAPZWsoOkS7lykBWY8ckvQ.jpg',
                'tema' => 0,
                'urutan' => 1,
            ],
            [
                'nama' => 'Irfan Rizqullah',
                'handle' => 'fanrzqlh',
                'kota' => 'Negeri Sakura',
                'angkatan' => 'Angkatan XVII',
                'catatan' => 'Selamat sampai Negeri Sakura & betah-betah disana. Terima kasih telah membanggakan almamatermu, nak!',
                'jenis_media' => 'instagram',
                'media_path' => null,
                'media_ref' => 'reel/DTfPQPRkkAq',
                'sampul' => 'magang-jepang/sampul/XmmkjTFpd0BxuZMremwvym14PXhjg5wb8IE4yUwU.jpg',
                'tema' => 1,
                'urutan' => 2,
            ],
            [
                'nama' => 'Nazib Sopian',
                'handle' => 'naziburaongs',
                'kota' => 'Negeri Sakura',
                'angkatan' => 'Angkatan XVII',
                'catatan' => 'Selamat sampai Negeri Sakura & betah-betah disana. Terbang tinggi untuk mengejar cita-cita dan masa depanmu yang manis.',
                'jenis_media' => 'instagram',
                'media_path' => null,
                'media_ref' => 'reel/DWjaMP3CEID',
                'sampul' => 'magang-jepang/sampul/2zu8Mv9anIxFRlc6DodxgWPHlEJXmU1yH1DELWha.jpg',
                'tema' => 2,
                'urutan' => 3,
            ],
        ];

        foreach ($rows as $row) {
            MagangJepang::updateOrCreate(['nama' => $row['nama']], $row);
        }
    }
}