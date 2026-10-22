<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Menyamakan data yang pada dump `sekolah_db.sql` sudah diubah/ditambah
 * lewat panel admin (foto, urutan id, pesan, pendaftar, dst.) tetapi pada
 * instalasi baru hanya terisi data awal dari migration. Seeder ini dijalankan
 * PALING AKHIR oleh DatabaseSeeder, sehingga setelah `php artisan migrate --seed`
 * seluruh isi database persis sama dengan dump.
 *
 * Yang disamakan:
 * - fasilitas                : 8 fasilitas dengan id 15-22 beserta foto
 *   (`gambar`, `gambar_2`). Data awal dari migration (id 1-8, tanpa foto)
 *   dibuang dulu, hanya yang judulnya persis data bawaan itu.
 * - bkk_konten               : kolom `ig_foto`.
 * - prestasi_sekolah         : kolom `foto` milik id 24.
 * - kunjungan_industri       : teks `sorotan` (versi hasil edit admin).
 * - kunjungan_industri_foto  : 7 foto hasil unggahan admin.
 * - kunjungan_industri_video : 1 video dokumentasi.
 * - pesan_kontak, ppdb       : data masuk dari formulir publik.
 *
 * Semua operasi memakai id sebagai kunci (ubah kalau ada, tambah kalau belum
 * ada), jadi aman dijalankan berulang kali. Berkas gambar yang dirujuk harus
 * sudah ada di storage/app/public (salin folder storage/app/public dari
 * sumbernya) supaya foto langsung tampil.
 */
class DataTerbaruSeeder extends Seeder
{
    public function run(): void
    {
        $this->fasilitas();
        $this->fotoDanTeks();
        $this->kunjunganIndustri();
        $this->formulirPublik();
    }

    protected function fasilitas(): void
    {
        // Buang 8 data awal dari migration (id 1-8, tanpa foto) supaya tidak
        // dobel dengan data di bawah. Data buatan admin dengan judul lain aman.
        DB::table('fasilitas')
            ->whereNotIn('id', range(15, 22))
            ->whereIn('judul', [
                'Ruang Kelas', 'Perpustakaan', 'Ruang Kepala Sekolah', 'Ruang Guru',
                'Tata Usaha', 'Musholla', 'Kantin', 'Taman',
            ])
            ->delete();

        $this->upsert('fasilitas', [
            ['id' => 15, 'urutan' => 1, 'kategori' => 'Ruang Pembelajaran', 'judul' => 'Ruang Kelas', 'icon' => 'presentation', 'deskripsi' => 'Ruang belajar yang nyaman dan tertata untuk mendukung kegiatan belajar mengajar setiap hari.', 'gambar' => 'fasilitas/uOrBsOLW2vmZ5dGNOqWn8UprfjUfEa4Ct1owFVGo.jpg', 'gambar_2' => null],
            ['id' => 16, 'urutan' => 2, 'kategori' => 'Ruang Pembelajaran', 'judul' => 'Perpustakaan', 'icon' => 'book-open', 'deskripsi' => 'Tempat membaca dan belajar mandiri dengan koleksi buku pelajaran, kejuruan, dan bacaan umum untuk menumbuhkan budaya literasi.', 'gambar' => 'fasilitas/aQl0rpvn4UApI4z2RZ1mUVvIFs6awBq7NEDJzU2l.jpg', 'gambar_2' => null],
            ['id' => 17, 'urutan' => 3, 'kategori' => 'Pimpinan & Administrasi', 'judul' => 'Ruang Kepala Sekolah', 'icon' => 'building', 'deskripsi' => 'Ruang kerja pimpinan sekolah sekaligus tempat menerima tamu, orang tua, dan mitra sekolah.', 'gambar' => 'fasilitas/TSi9oauxcOan4Si6TPKkdPrfSw1qucrYVmpdyK2Z.jpg', 'gambar_2' => null],
            ['id' => 18, 'urutan' => 4, 'kategori' => 'Pimpinan & Administrasi', 'judul' => 'Ruang Guru', 'icon' => 'users', 'deskripsi' => 'Ruang kerja para guru untuk menyiapkan pembelajaran, berdiskusi, dan melayani konsultasi siswa.', 'gambar' => 'fasilitas/8cljvQwEfjLo1kzWEHzq6K6j7ueiP94QO8Yt7yps.jpg', 'gambar_2' => null],
            ['id' => 19, 'urutan' => 5, 'kategori' => 'Pimpinan & Administrasi', 'judul' => 'Tata Usaha', 'icon' => 'folder', 'deskripsi' => 'Pusat layanan administrasi sekolah, mulai dari pengelolaan data siswa hingga surat-menyurat.', 'gambar' => 'fasilitas/zB8yf3SmBRVmQuIZ0PFwjdIyxpfuA8IpTTpqPF3b.jpg', 'gambar_2' => 'fasilitas/7fg3m1IF4SyLsxyflHfU1KHP8SJDGwwKOqO5lDb1.jpg'],
            ['id' => 20, 'urutan' => 6, 'kategori' => 'Penunjang Sekolah', 'judul' => 'Musholla', 'icon' => 'mosque', 'deskripsi' => 'Sarana ibadah yang bersih dan nyaman bagi seluruh warga sekolah.', 'gambar' => 'fasilitas/hy8cJCQEDH7jPU7CFcJcVZAogzwAbh1mhdF1guqF.jpg', 'gambar_2' => null],
            ['id' => 21, 'urutan' => 7, 'kategori' => 'Penunjang Sekolah', 'judul' => 'Kantin', 'icon' => 'utensils', 'deskripsi' => 'Tempat istirahat dan makan bagi siswa serta guru dengan berbagai pilihan makanan dan minuman.', 'gambar' => 'fasilitas/BN7j8Jb2jM3DpjHAxQvgkv7masB2xq0ua1qY2OsH.jpg', 'gambar_2' => null],
            ['id' => 22, 'urutan' => 8, 'kategori' => 'Penunjang Sekolah', 'judul' => 'Taman', 'icon' => 'trees', 'deskripsi' => 'Area hijau yang asri sebagai ruang berkumpul, bersantai, dan belajar santai di luar kelas.', 'gambar' => 'fasilitas/vqbTWluRFNj0CUOJlh5KBXtZjWBftsnNgsatxpEs.jpg', 'gambar_2' => null],
        ]);
    }

    protected function fotoDanTeks(): void
    {
        DB::table('bkk_konten')->where('id', 1)->update([
            'ig_foto' => 'bkk/profil/Vxbpx9QMErmB3YQ9hXLEvM2r8MELP9WFnSpW7F44.jpg',
        ]);

        DB::table('prestasi_sekolah')->where('id', 24)->update([
            'foto' => 'prestasi/CWHXKqYpO2KnaHWABZfpXwc6FRhpFNcp9gkSenjK.jpg',
        ]);
    }

    protected function kunjunganIndustri(): void
    {
        // Teks sorotan hasil edit admin (baris baru bergaya Windows, \r\n).
        $sorotan = [
            1 => "Sesi pemaparan di auditorium\r\nMengenal Amikom Creative Economy Park\r\nWawasan kelanjutan studi & karier",
            2 => "Menjelajah lereng Gunung Merapi\r\nBelajar jejak erupsi & alam\r\nKebersamaan antar siswa",
            3 => "Koleksi peninggalan erupsi Merapi\r\nPelajaran empati & kepedulian\r\nDokumentasi kebersamaan siswa",
        ];

        foreach ($sorotan as $id => $teks) {
            DB::table('kunjungan_industri')->where('id', $id)->update(['sorotan' => $teks]);
        }

        $this->upsert('kunjungan_industri_foto', [
            ['id' => 1, 'kunjungan_industri_id' => 1, 'path' => 'kunjungan-industri/foto/dQCPrQqdQUH1mGlrqn4yU8Zw9II2gemU7S0syLd2.png', 'keterangan' => 'Universitas Amikom', 'urutan' => 1],
            ['id' => 2, 'kunjungan_industri_id' => 1, 'path' => 'kunjungan-industri/foto/a9YbnlKzzCYgZ64CJZ8U2sKAN7FXFYbszWNL6Zvk.png', 'keterangan' => 'Universitas Amikom', 'urutan' => 2],
            ['id' => 3, 'kunjungan_industri_id' => 1, 'path' => 'kunjungan-industri/foto/fYbI7mFyxrcd630frB2ewmlKXWlb3SBs4RMbWkeb.png', 'keterangan' => 'Universitas Amikom', 'urutan' => 3],
            ['id' => 4, 'kunjungan_industri_id' => 1, 'path' => 'kunjungan-industri/foto/d1DXH6LFOp2DJTqjeUOEz8YrXaFgDKdO7HNU0Brs.png', 'keterangan' => 'Universitas Amikom', 'urutan' => 4],
            ['id' => 5, 'kunjungan_industri_id' => 2, 'path' => 'kunjungan-industri/foto/QFSUkD2xd4GTKMI5MjXEjmUhCPIVItzjqoiU4Ym5.png', 'keterangan' => 'Foto bersama di lereng Merapi', 'urutan' => 1],
            ['id' => 6, 'kunjungan_industri_id' => 3, 'path' => 'kunjungan-industri/foto/qvaWC6inyrjyCOWWIW6dIzYskkWYraOhCNjTNsw8.png', 'keterangan' => 'Foto bersama di Museum Mini Sisa Hartaku', 'urutan' => 1],
            ['id' => 7, 'kunjungan_industri_id' => 3, 'path' => 'kunjungan-industri/foto/JZhQ3rtAyygapwx3DZf9peHM8KvXSO8TWGXLmqKU.png', 'keterangan' => 'Siswa SMK INFOKOM di Museum Mini Sisa Hartaku', 'urutan' => 2],
        ]);

        $this->upsert('kunjungan_industri_video', [
            ['id' => 1, 'kunjungan_industri_id' => null, 'judul' => 'Keseruan Kunjungan Industri', 'deskripsi' => null, 'jenis' => 'embed', 'provider' => 'gdrive', 'rasio' => 'landscape', 'media_path' => null, 'embed_url' => 'https://drive.google.com/file/d/19q6lE_auUtgT7H-_RF0jP0KbD-b9vHDV/preview', 'source_url' => 'https://drive.google.com/file/d/19q6lE_auUtgT7H-_RF0jP0KbD-b9vHDV/view', 'sampul' => 'kunjungan-industri/sampul/CH8jK7FLdX1WG7X3qpi6v4SbWfs4t7LlzJVUo8Zy.png', 'urutan' => 1, 'created_at' => '2026-10-01 12:03:13', 'updated_at' => '2026-10-01 12:21:23'],
        ], false);
    }

    protected function formulirPublik(): void
    {
        // Tabel ini hanya punya kolom `created_at` (tanpa `updated_at`).
        $this->upsert('pesan_kontak', [
            ['id' => 1, 'nama' => 'Rizky', 'email' => 'rizky@gmail.com', 'subjek' => 'Bertanya', 'pesan' => 'Apakah sudah buka pendaftaran', 'status' => 'dibaca', 'created_at' => '2026-09-26 13:29:54'],
        ], false);

        $this->upsert('ppdb', [
            ['id' => 1, 'nomor_pendaftaran' => 'PPDB-TLYB3D31', 'nama' => 'Badut ZY', 'nisn' => '0154818846', 'asal_sekolah' => 'SMP Negri 6', 'tempat_lahir' => 'Bogor', 'tanggal_lahir' => '2009-03-06', 'jenis_kelamin' => 'Laki-laki', 'agama' => 'Islam', 'email' => 'rizkimputra364@gmail.com', 'telepon' => '089516258211', 'pilihan1' => 'RPL', 'pilihan2' => 'TKJ', 'alamat' => 'BLK TEMAN SAYA AJA', 'nama_orang_tua' => 'Mario RAmdani', 'telepon_orang_tua' => '089516258242', 'pekerjaan_orang_tua' => 'LC', 'dokumen' => 'ppdb/dJyDrGkE4nBIvnHEVAGMZCl701XhpLZw6aiiqbE1.jpg', 'created_at' => '2026-09-25 20:02:01'],
            ['id' => 2, 'nomor_pendaftaran' => 'PPDB-TLZNXG25', 'nama' => 'Rizky Maulan Putra', 'nisn' => '1827392871', 'asal_sekolah' => 'SMP TAMAN SISWA', 'tempat_lahir' => 'Bogor', 'tanggal_lahir' => '2009-03-06', 'jenis_kelamin' => 'Laki-laki', 'agama' => 'Islam', 'email' => 'rizky@gmail.com', 'telepon' => '089162576521', 'pilihan1' => 'RPL', 'pilihan2' => 'TKJ', 'alamat' => 'Menteng Asri', 'nama_orang_tua' => 'Ina', 'telepon_orang_tua' => '087261827361', 'pekerjaan_orang_tua' => 'PNS', 'dokumen' => null, 'created_at' => '2026-09-26 13:36:52'],
        ], false);
    }

    /**
     * Ubah baris ber-id sama kalau sudah ada, tambahkan kalau belum ada.
     *
     * @param  bool  $timestamps  true = isi created_at/updated_at otomatis;
     *                            false = pakai nilai yang sudah ada di $rows.
     */
    protected function upsert(string $table, array $rows, bool $timestamps = true): void
    {
        $now = now();

        foreach ($rows as $row) {
            $query = DB::table($table)->where('id', $row['id']);

            if ($query->exists()) {
                $query->update($timestamps ? $row + ['updated_at' => $now] : $row);
            } else {
                DB::table($table)->insert($timestamps ? $row + ['created_at' => $now, 'updated_at' => $now] : $row);
            }
        }
    }
}