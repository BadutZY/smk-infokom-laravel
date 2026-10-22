<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * Catatan: tabel `prestasi_bidang`, `prestasi_sekolah`,
     * `magang_jepang_alasan`, dan `magang_jepang_langkah` TIDAK punya
     * seeder tersendiri karena datanya sudah disisipkan langsung oleh
     * migration masing-masing (lihat method up() pada
     * 2026_09_24_000000_create_prestasi_sekolah_table.php,
     * 2026_09_25_000001_create_prestasi_bidang_table.php,
     * 2026_09_25_000002_create_magang_jepang_alasan_table.php, dan
     * 2026_09_25_000003_create_magang_jepang_langkah_table.php), sehingga
     * otomatis terisi persis sama dengan dump `sekolah_db.sql` begitu
     * `php artisan migrate` dijalankan.
     *
     * DataTerbaruSeeder harus paling akhir: ia menyamakan data hasil
     * migration (fasilitas, kunjungan industri, dst.) serta menambahkan
     * data formulir publik (pesan kontak & pendaftar PPDB) dari dump.
     */
    public function run(): void
    {
        $this->call([
            AdminSeeder::class,
            BeritaSeeder::class,
            SiteContentSeeder::class,
            GuruStaffSeeder::class,
            BkkMediaSeeder::class,
            MagangJepangSeeder::class,
            DataTerbaruSeeder::class,
        ]);
    }
}