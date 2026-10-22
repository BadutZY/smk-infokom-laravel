<?php

namespace Database\Seeders;

use App\Models\BkkMedia;
use Illuminate\Database\Seeder;

/**
 * Data galeri media Bursa Kerja Khusus (BKK) SMK INFOKOM.
 *
 * Disamakan persis dengan dump `sekolah_db.sql` (termasuk `urutan` yang
 * belum dirapikan admin lewat panel: tiga kartu terakhir masih bernilai 0),
 * mengacu ke berkas yang sudah ada di storage/app/public/bkk/foto.
 */
class BkkMediaSeeder extends Seeder
{
    public function run(): void
    {
        if (BkkMedia::count() > 0) {
            return;
        }

        $rows = [
            [
                'judul' => 'Rekrutmen Beasiswa',
                'keterangan' => null,
                'jenis_media' => 'foto',
                'media_path' => 'bkk/foto/GUrXKGlOpYpif9mUrWJ2Gh6FoR4UDD7YVYY6ElWv.webp',
                'media_ref' => null,
                'sampul' => null,
                'tema' => 0,
                'urutan' => 2,
            ],
            [
                'judul' => 'BKK SMK INFOKOM',
                'keterangan' => null,
                'jenis_media' => 'foto',
                'media_path' => 'bkk/foto/b9Tf7HQ4rMlWpymT7UtaULGfdl75EmR7KURw9K6a.jpg',
                'media_ref' => null,
                'sampul' => null,
                'tema' => 0,
                'urutan' => 1,
            ],
            [
                'judul' => 'BKK SMK INFOKOM',
                'keterangan' => null,
                'jenis_media' => 'foto',
                'media_path' => 'bkk/foto/jzIGaQ9YpvPUVoiK4KdxP9t1PSw3ybEkTWgzSgO9.webp',
                'media_ref' => null,
                'sampul' => null,
                'tema' => 0,
                'urutan' => 0,
            ],
            [
                'judul' => 'BKK SMK INFOKOM',
                'keterangan' => null,
                'jenis_media' => 'foto',
                'media_path' => 'bkk/foto/gZ4wmRvv71AXJwOZyakxkAymiKt9G6aZA5y8nBV2.webp',
                'media_ref' => null,
                'sampul' => null,
                'tema' => 0,
                'urutan' => 0,
            ],
            [
                'judul' => 'BKK SMK INFOKOM',
                'keterangan' => null,
                'jenis_media' => 'foto',
                'media_path' => 'bkk/foto/OQHeCazRhWBtF6kkrfcaxTgt9qj00JDkqyo0vmaw.webp',
                'media_ref' => null,
                'sampul' => null,
                'tema' => 0,
                'urutan' => 0,
            ],
        ];

        foreach ($rows as $row) {
            BkkMedia::create($row);
        }
    }
}