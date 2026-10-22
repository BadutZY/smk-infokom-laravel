<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('prestasi_sekolah', function (Blueprint $table) {
            $table->id();

            // Menyatukan beberapa baris prestasi milik siswa/tim yang sama
            // ke dalam satu kartu di halaman publik (meniru kolom "No" pada
            // tabel prestasi di flyer sekolah).
            $table->unsignedInteger('kelompok')->default(0);

            $table->string('nama_siswa', 191);          // nama siswa/tim yang berprestasi
            $table->string('nama_kejuaraan', 500);       // nama kejuaraan & tingkat lomba
            $table->string('juara', 191);                // contoh: "Juara 1 (Medali Emas) Nasional"

            // Dipakai untuk lencana warna emas/perak/perunggu & statistik.
            $table->string('peringkat', 20)->default('lainnya');

            $table->string('tingkat', 150)->nullable();  // contoh: "Kota Bogor", "Nasional"
            $table->string('kategori', 100)->nullable(); // bidang lomba, dipakai untuk filter
            $table->string('tahun', 10);

            $table->integer('urutan')->default(0);
            $table->timestamps();
        });

        $now = now();
        $rows = [];

        // Bantuan kecil supaya penulisan data di bawah tetap ringkas & rapi.
        $add = function (int $kelompok, string $nama, string $kejuaraan, string $juara, string $peringkat, ?string $tingkat, string $kategori, string $tahun) use (&$rows, $now) {
            $rows[] = [
                'kelompok' => $kelompok,
                'nama_siswa' => $nama,
                'nama_kejuaraan' => $kejuaraan,
                'juara' => $juara,
                'peringkat' => $peringkat,
                'tingkat' => $tingkat,
                'kategori' => $kategori,
                'tahun' => $tahun,
                'urutan' => $kelompok,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        };

        // 1. Tim Futsal
        $add(1, 'Tim Futsal', 'Piala Kemerdekaan FutsalBGR 2025', 'Juara 3 (Kota Bogor)', 'perunggu', 'Kota Bogor', 'Olahraga', '2025');
        $add(1, 'Tim Futsal', 'SB Fusalnation 2025', 'Juara 3 (Kota Bogor)', 'perunggu', 'Kota Bogor', 'Olahraga', '2025');
        $add(1, 'Tim Futsal', 'Binaniaga Championship 2025', 'Juara 3 (Kota Bogor)', 'perunggu', 'Kota Bogor', 'Olahraga', '2025');

        // 2. Tim PASKIBRA
        $add(2, 'Tim PASKIBRA', 'LKBB Braja Musti 2024', 'Juara Harapan Potensial 2 (Kota Bogor)', 'lainnya', 'Kota Bogor', 'Baris-Berbaris', '2024');
        $add(2, 'Tim PASKIBRA', 'LKBB BIMA Season 1 Jawa Barat', 'Juara Purwa 5 (Provinsi Jawa Barat)', 'lainnya', 'Provinsi Jawa Barat', 'Baris-Berbaris', '2024');
        $add(2, 'Tim PASKIBRA', 'LKBB BIMA SAKTI 2025', 'Juara 1 (Kota Bogor)', 'emas', 'Kota Bogor', 'Baris-Berbaris', '2025');

        // 3. Bintang Rafiif Adzani
        $add(3, 'Bintang Rafiif Adzani', 'Kejurprov U-18 Subang Cabang Olahraga Bola Tangan (Hand Ball)', 'Juara 1 (Medali Emas) Divisi 1 Provinsi Jawa Barat', 'emas', 'Provinsi Jawa Barat', 'Olahraga', '2024');

        // 4. Tim Handball
        $add(4, 'Tim Handball', 'Kejuaraan Handball Najamudin Cup 7 Tahun 2025', 'Juara 3 (Kota Bogor)', 'perunggu', 'Kota Bogor', 'Olahraga', '2025');

        // 5. Amanda Tagrida Viona
        $add(5, 'Amanda Tagrida Viona', 'Young Scientists Competition Kategori Kimia', 'Juara 3 (Medali Perunggu) Nasional', 'perunggu', 'Nasional', 'Akademik & Sains', '2024');
        $add(5, 'Amanda Tagrida Viona', 'Karya Ilmiah Internet of Things (IoT) Universitas Ibn Khaldun', 'Juara 1 (Medali Emas) Kota Bogor', 'emas', 'Kota Bogor', 'Akademik & Sains', '2024');
        $add(5, 'Amanda Tagrida Viona', 'Lembaga Kompetisi Nasional (LKN) Science Olympiad Kategori Bahasa Indonesia', 'Juara 1 (Medali Emas) Nasional', 'emas', 'Nasional', 'Akademik & Sains', '2024');
        $add(5, 'Amanda Tagrida Viona', 'Lembaga Kompetisi Nasional (LKN) Science Olympiad Kategori Ekonomi', 'Juara 3 (Medali Perunggu) Nasional', 'perunggu', 'Nasional', 'Akademik & Sains', '2024');
        $add(5, 'Amanda Tagrida Viona', 'Olimpiade Indonesia Lembaga Kompetensi Indonesia (LKI) Kategori Biologi', 'Juara 2 (Medali Perak) Nasional', 'perak', 'Nasional', 'Akademik & Sains', '2024');

        // 6. Amanda Tagrida Viona, Aqilla Tyza Febyana, Alisa Putri Mulya
        $add(6, 'Amanda Tagrida Viona, Aqilla Tyza Febyana & Alisa Putri Mulya', 'Karya Ilmiah Internet of Things (IoT) Universitas Ibn Khaldun', 'Juara 1 (Medali Emas) Kota Bogor', 'emas', 'Kota Bogor', 'Akademik & Sains', '2024');

        // 7. Tim JIC (Mohamad Arjuna Ali)
        $add(7, 'Tim JIC (Mohamad Arjuna Ali)', 'Lomba Kanji YUKANA Festival 2025', 'Juara 1 (Kota Bogor)', 'emas', 'Kota Bogor', 'Bahasa & Budaya', '2025');

        // 8. Bungas Shesa Perindu
        $add(8, 'Bungas Shesa Perindu', 'OLIMFEST (Olimpiade Festival Nusantara) 2025 Bidang Lomba: Olimpiade Biologi Tingkat SMA', 'Medali Emas (Nasional)', 'emas', 'Nasional', 'Akademik & Sains', '2025');
        $add(8, 'Bungas Shesa Perindu', 'ISO (Indonesian Science Olympiad) 2025 Bidang Lomba: Olimpiade Biologi', 'Medali Emas (Nasional)', 'emas', 'Nasional', 'Akademik & Sains', '2025');
        $add(8, 'Bungas Shesa Perindu', 'OSSAN (Olimpiade Sains Siswa Nasional) 2026 Bidang Lomba: Biologi', 'Medali Perak (Nasional)', 'perak', 'Nasional', 'Akademik & Sains', '2025');
        $add(8, 'Bungas Shesa Perindu', 'OSSAN (Olimpiade Sains Siswa Nasional) 2026 Bidang Lomba: Informatika', 'Medali Perak (Nasional)', 'perak', 'Nasional', 'Akademik & Sains', '2026');

        // 9. Deanova Aprianza Gesyaputra
        $add(9, 'Deanova Aprianza Gesyaputra', 'POTENSI (Pekan Kompetisi Talenta dan Edukasi) Bidang Lomba: Sosiologi Tingkat SMA', 'Medali Emas (Nasional)', 'emas', 'Nasional', 'Akademik & Sains', '2026');
        $add(9, 'Deanova Aprianza Gesyaputra', 'POTENSI (Pekan Kompetisi Talenta dan Edukasi) Bidang Lomba: Bahasa Indonesia Tingkat SMA', 'Medali Emas (Nasional)', 'emas', 'Nasional', 'Akademik & Sains', '2026');
        $add(9, 'Deanova Aprianza Gesyaputra', '4Th OSBANAS (Olimpiade Sains, Sosial, dan Bahasa Nasional) 2025 Bidang Lomba: Olimpiade Sosiologi Tingkat SMA', 'Medali Perunggu (Nasional)', 'perunggu', 'Nasional', 'Akademik & Sains', '2026');

        // 10. Aulia Azzahra Hartiani
        $add(10, 'Aulia Azzahra Hartiani', 'POSBANAS (Pekan Olimpiade Sains Bahasa dan Agama Nasional) Bidang Lomba: Bahasa Jepang Tingkat SMA/SMK', 'Medali Emas (Nasional)', 'emas', 'Nasional', 'Bahasa & Budaya', '2026');

        // 11. Tim e-Sport
        $add(11, 'Rafisha Wahyu Assila, Mario Ramdani, Gibran Bijaksa S., Julian Iqbal & Alif Saputra Ramadhan', 'e-Sport (Mobile Legend) Festival Dwi Warna (FDW) 2026 RENASCORA', 'Juara 1 (Tingkat Kota & Kabupaten)', 'emas', 'Tingkat Kota & Kabupaten', 'Digital & Teknologi', '2026');

        // 12. Rahma Ashari
        $add(12, 'Rahma Ashari', 'Olimpiade Olahraga Siswa Nasional (O2SN) Tingkat SMK Kota Bogor Cabang Olahraga Bulu Tangkis', 'Juara 2 (Tingkat Kota)', 'perak', 'Tingkat Kota', 'Olahraga', '2026');

        DB::table('prestasi_sekolah')->insert($rows);
    }

    public function down(): void
    {
        Schema::dropIfExists('prestasi_sekolah');
    }
};