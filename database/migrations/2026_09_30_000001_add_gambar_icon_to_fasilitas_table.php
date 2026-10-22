<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Fasilitas sekarang punya halaman publik sendiri (/fasilitas) dan tab
     * sendiri di panel admin (Fasilitas Sekolah), terpisah dari Profil Sekolah.
     *
     * Migration ini:
     *  1. menambah kolom `icon`, `gambar` (foto utama), dan `gambar_2`
     *     (foto tambahan, opsional) pada tabel `fasilitas`;
     *  2. mengganti data fasilitas bawaan lama (14 baris contoh dari brosur)
     *     dengan 8 fasilitas sesuai foto yang disediakan sekolah:
     *     Ruang Kelas, Perpustakaan, Ruang Kepala Sekolah, Ruang Guru,
     *     Tata Usaha, Musholla, Kantin, dan Taman.
     *
     * Kolom foto sengaja dibiarkan KOSONG - foto diunggah sendiri oleh admin
     * lewat Admin > Fasilitas Sekolah > Edit. Selama belum ada foto, halaman
     * publik menampilkan tampilan pengganti yang tetap rapi.
     *
     * Aman dijalankan berulang, dan data tambahan buatan admin (yang judulnya
     * bukan salah satu data bawaan lama) TIDAK dihapus.
     */
    public function up(): void
    {
        Schema::table('fasilitas', function (Blueprint $table) {
            if (! Schema::hasColumn('fasilitas', 'icon')) {
                $table->string('icon', 50)->nullable()->after('deskripsi');
            }
            if (! Schema::hasColumn('fasilitas', 'gambar')) {
                $table->string('gambar')->nullable()->after('icon');
            }
            if (! Schema::hasColumn('fasilitas', 'gambar_2')) {
                $table->string('gambar_2')->nullable()->after('gambar');
            }
        });

        // Hapus data contoh lama (hanya yang persis judul bawaan).
        DB::table('fasilitas')->whereIn('judul', [
            'Sarana Ruang Belajar yang Nyaman',
            'Ruang OSIS dan Organisasi',
            'Ruang Perpustakaan',
            'Mushola',
            'Ruang UKS',
            'Lapangan Olahraga',
            'Studio Musik',
            'Studio Podcast',
            'Studio Televisi',
            'Teknik Komputer Jaringan (TKJ)',
            'Rekayasa Perangkat Lunak (RPL)',
            'Desain Komunikasi Visual (DKV)',
            'Produksi dan Siaran Program Televisi (PSPT)',
            'Ruang Produksi dan Show Case Teaching Factory',
        ])->delete();

        $now = now();
        $data = [
            ['urutan' => 1, 'kategori' => 'Ruang Pembelajaran', 'judul' => 'Ruang Kelas', 'icon' => 'presentation', 'deskripsi' => 'Ruang belajar yang nyaman dan tertata untuk mendukung kegiatan belajar mengajar setiap hari.'],
            ['urutan' => 2, 'kategori' => 'Ruang Pembelajaran', 'judul' => 'Perpustakaan', 'icon' => 'book-open', 'deskripsi' => 'Tempat membaca dan belajar mandiri dengan koleksi buku pelajaran, kejuruan, dan bacaan umum untuk menumbuhkan budaya literasi.'],
            ['urutan' => 3, 'kategori' => 'Pimpinan & Administrasi', 'judul' => 'Ruang Kepala Sekolah', 'icon' => 'building', 'deskripsi' => 'Ruang kerja pimpinan sekolah sekaligus tempat menerima tamu, orang tua, dan mitra sekolah.'],
            ['urutan' => 4, 'kategori' => 'Pimpinan & Administrasi', 'judul' => 'Ruang Guru', 'icon' => 'users', 'deskripsi' => 'Ruang kerja para guru untuk menyiapkan pembelajaran, berdiskusi, dan melayani konsultasi siswa.'],
            ['urutan' => 5, 'kategori' => 'Pimpinan & Administrasi', 'judul' => 'Tata Usaha', 'icon' => 'folder', 'deskripsi' => 'Pusat layanan administrasi sekolah, mulai dari pengelolaan data siswa hingga surat-menyurat.'],
            ['urutan' => 6, 'kategori' => 'Penunjang Sekolah', 'judul' => 'Musholla', 'icon' => 'mosque', 'deskripsi' => 'Sarana ibadah yang bersih dan nyaman bagi seluruh warga sekolah.'],
            ['urutan' => 7, 'kategori' => 'Penunjang Sekolah', 'judul' => 'Kantin', 'icon' => 'utensils', 'deskripsi' => 'Tempat istirahat dan makan bagi siswa serta guru dengan berbagai pilihan makanan dan minuman.'],
            ['urutan' => 8, 'kategori' => 'Penunjang Sekolah', 'judul' => 'Taman', 'icon' => 'trees', 'deskripsi' => 'Area hijau yang asri sebagai ruang berkumpul, bersantai, dan belajar santai di luar kelas.'],
        ];

        foreach ($data as $row) {
            // Jangan gandakan kalau judul yang sama sudah ada (mis. migrate dijalankan ulang).
            if (DB::table('fasilitas')->where('judul', $row['judul'])->exists()) {
                continue;
            }

            DB::table('fasilitas')->insert($row + [
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
    }

    public function down(): void
    {
        Schema::table('fasilitas', function (Blueprint $table) {
            foreach (['gambar_2', 'gambar', 'icon'] as $column) {
                if (Schema::hasColumn('fasilitas', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};