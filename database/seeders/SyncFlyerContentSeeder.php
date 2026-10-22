<?php

namespace Database\Seeders;

use App\Models\Ekstrakurikuler;
use App\Models\Fasilitas;
use App\Models\Jurusan;
use App\Models\KerjasamaIndustri;
use App\Models\KerjasamaUniversitas;
use Illuminate\Database\Seeder;

/**
 * Seeder tambahan (bukan bagian dari alur `db:seed` bawaan) untuk
 * MENYAMAKAN data yang sudah ada di database dengan data terbaru pada dump
 * `sekolah_db.sql` (yang sebelumnya mengikuti brosur PPDB SMK INFOKOM),
 * tanpa perlu migrate:fresh (aman dijalankan di database yang
 * sudah dipakai / sudah pernah di-seed sebelumnya lewat SiteContentSeeder).
 *
 * Jalankan manual lewat:
 *   php artisan db:seed --class="Database\Seeders\SyncFlyerContentSeeder"
 *
 * Yang dilakukan:
 * - Fasilitas & Ekstrakurikuler   : diganti total (hapus + isi ulang)
 *   supaya persis sama dengan dump (fasilitas: 8 data id 15-22 beserta foto).
 * - Jurusan                      : HANYA kolom `lingkup_kerja` yang
 *   disinkronkan (dicocokkan lewat kolom `kode`), field lain (deskripsi,
 *   gambar, poin) yang mungkin sudah diubah admin tidak disentuh.
 * - Kerjasama Universitas/Industri: ditambahkan lewat firstOrCreate
 *   (dicocokkan lewat nama, lengkap dengan id, urutan & logo dari dump)
 *   supaya tidak duplikat & tidak menimpa logo yang mungkin sudah diunggah
 *   admin kalau seeder ini dijalankan ulang.
 */
class SyncFlyerContentSeeder extends Seeder
{
    public function run(): void
    {
        $this->syncFasilitas();
        $this->syncEkstrakurikuler();
        $this->syncLingkupKerjaJurusan();
        $this->syncKerjasamaUniversitas();
        $this->syncKerjasamaIndustri();
    }

    protected function syncFasilitas(): void
    {
        Fasilitas::query()->delete();

        // 8 fasilitas terbaru (id 15-22 beserta foto) persis seperti dump
        // `sekolah_db.sql`. `id` ikut diisi (unguarded) supaya sama dengan dump.
        $rows = [
            ['id' => 15, 'urutan' => 1, 'kategori' => 'Ruang Pembelajaran', 'judul' => 'Ruang Kelas', 'icon' => 'presentation', 'deskripsi' => 'Ruang belajar yang nyaman dan tertata untuk mendukung kegiatan belajar mengajar setiap hari.', 'gambar' => 'fasilitas/uOrBsOLW2vmZ5dGNOqWn8UprfjUfEa4Ct1owFVGo.jpg', 'gambar_2' => null],
            ['id' => 16, 'urutan' => 2, 'kategori' => 'Ruang Pembelajaran', 'judul' => 'Perpustakaan', 'icon' => 'book-open', 'deskripsi' => 'Tempat membaca dan belajar mandiri dengan koleksi buku pelajaran, kejuruan, dan bacaan umum untuk menumbuhkan budaya literasi.', 'gambar' => 'fasilitas/aQl0rpvn4UApI4z2RZ1mUVvIFs6awBq7NEDJzU2l.jpg', 'gambar_2' => null],
            ['id' => 17, 'urutan' => 3, 'kategori' => 'Pimpinan & Administrasi', 'judul' => 'Ruang Kepala Sekolah', 'icon' => 'building', 'deskripsi' => 'Ruang kerja pimpinan sekolah sekaligus tempat menerima tamu, orang tua, dan mitra sekolah.', 'gambar' => 'fasilitas/TSi9oauxcOan4Si6TPKkdPrfSw1qucrYVmpdyK2Z.jpg', 'gambar_2' => null],
            ['id' => 18, 'urutan' => 4, 'kategori' => 'Pimpinan & Administrasi', 'judul' => 'Ruang Guru', 'icon' => 'users', 'deskripsi' => 'Ruang kerja para guru untuk menyiapkan pembelajaran, berdiskusi, dan melayani konsultasi siswa.', 'gambar' => 'fasilitas/8cljvQwEfjLo1kzWEHzq6K6j7ueiP94QO8Yt7yps.jpg', 'gambar_2' => null],
            ['id' => 19, 'urutan' => 5, 'kategori' => 'Pimpinan & Administrasi', 'judul' => 'Tata Usaha', 'icon' => 'folder', 'deskripsi' => 'Pusat layanan administrasi sekolah, mulai dari pengelolaan data siswa hingga surat-menyurat.', 'gambar' => 'fasilitas/zB8yf3SmBRVmQuIZ0PFwjdIyxpfuA8IpTTpqPF3b.jpg', 'gambar_2' => 'fasilitas/7fg3m1IF4SyLsxyflHfU1KHP8SJDGwwKOqO5lDb1.jpg'],
            ['id' => 20, 'urutan' => 6, 'kategori' => 'Penunjang Sekolah', 'judul' => 'Musholla', 'icon' => 'mosque', 'deskripsi' => 'Sarana ibadah yang bersih dan nyaman bagi seluruh warga sekolah.', 'gambar' => 'fasilitas/hy8cJCQEDH7jPU7CFcJcVZAogzwAbh1mhdF1guqF.jpg', 'gambar_2' => null],
            ['id' => 21, 'urutan' => 7, 'kategori' => 'Penunjang Sekolah', 'judul' => 'Kantin', 'icon' => 'utensils', 'deskripsi' => 'Tempat istirahat dan makan bagi siswa serta guru dengan berbagai pilihan makanan dan minuman.', 'gambar' => 'fasilitas/BN7j8Jb2jM3DpjHAxQvgkv7masB2xq0ua1qY2OsH.jpg', 'gambar_2' => null],
            ['id' => 22, 'urutan' => 8, 'kategori' => 'Penunjang Sekolah', 'judul' => 'Taman', 'icon' => 'trees', 'deskripsi' => 'Area hijau yang asri sebagai ruang berkumpul, bersantai, dan belajar santai di luar kelas.', 'gambar' => 'fasilitas/vqbTWluRFNj0CUOJlh5KBXtZjWBftsnNgsatxpEs.jpg', 'gambar_2' => null],
        ];

        Fasilitas::unguarded(function () use ($rows) {
            foreach ($rows as $row) {
                Fasilitas::create($row);
            }
        });
    }

    protected function syncEkstrakurikuler(): void
    {
        Ekstrakurikuler::query()->delete();

        $rows = [
            ['urutan' => 1, 'nama' => 'PASKIBRA', 'icon' => 'award', 'deskripsi' => 'Membina sikap baris-berbaris, ketegasan, dan nasionalisme.'],
            ['urutan' => 2, 'nama' => 'PRAMUKA', 'icon' => 'users', 'deskripsi' => 'Melatih kedisiplinan, kemandirian, dan jiwa kepemimpinan siswa.'],
            ['urutan' => 3, 'nama' => 'PMR', 'icon' => 'activity', 'deskripsi' => 'Palang Merah Remaja, membina kepedulian dan keterampilan pertolongan pertama.'],
            ['urutan' => 4, 'nama' => 'Japan Indonesia Community (JIC)', 'icon' => 'sparkles', 'deskripsi' => 'Wadah pembelajaran bahasa dan budaya Jepang bagi siswa.'],
            ['urutan' => 5, 'nama' => 'Cerdas TKA', 'icon' => 'book-open', 'deskripsi' => 'Pembinaan akademik untuk persiapan Tes Kemampuan Akademik.'],
            ['urutan' => 6, 'nama' => 'Tahsin/Tahfidz Qur\'an', 'icon' => 'star', 'deskripsi' => 'Pembinaan bacaan dan hafalan Al-Qur\'an bagi siswa.'],
            ['urutan' => 7, 'nama' => 'Futsal', 'icon' => 'trophy', 'deskripsi' => 'Mengasah kekompakan tim dan prestasi olahraga futsal.'],
            ['urutan' => 8, 'nama' => 'Handball', 'icon' => 'shield-check', 'deskripsi' => 'Melatih kebugaran, kerja sama tim, dan prestasi olahraga bola tangan.'],
            ['urutan' => 9, 'nama' => 'Bulu Tangkis', 'icon' => 'star', 'deskripsi' => 'Menyalurkan minat dan bakat siswa di cabang olahraga bulu tangkis.'],
            ['urutan' => 10, 'nama' => 'Basketball', 'icon' => 'trophy', 'deskripsi' => 'Melatih kebugaran, kerja sama tim, dan semangat kompetisi.'],
            ['urutan' => 11, 'nama' => 'Paduan Suara', 'icon' => 'megaphone', 'deskripsi' => 'Menyalurkan bakat vokal siswa dalam kegiatan paduan suara sekolah.'],
            ['urutan' => 12, 'nama' => 'Hadroh', 'icon' => 'sparkles', 'deskripsi' => 'Kesenian musik Islami tradisional sebagai wadah kreativitas siswa.'],
            ['urutan' => 13, 'nama' => 'Musik/Band', 'icon' => 'video', 'deskripsi' => 'Wadah pengembangan bakat bermusik siswa lewat kegiatan band sekolah.'],
        ];

        foreach ($rows as $row) {
            Ekstrakurikuler::create($row);
        }
    }

    protected function syncLingkupKerjaJurusan(): void
    {
        $map = [
            'TKJ' => ['Perusahaan Jaringan', 'Wireless Networking', 'Network Administrator', 'Server Administrator', 'Computer Integrator', 'Connection Integrator'],
            'RPL' => ['Desktop Programmer', 'Mobile Programmer', 'Web Programmer', 'Analis Teknologi (Mobile, Desktop, Web, Enterprise)'],
            'DKV' => ['Illustrator', 'Animator', 'Desainer Grafis', 'Desainer Permainan (Game Designer)', 'Content Creator'],
            'PSPT' => ['Biro Advertising', 'Rumah Produksi (Production House)', 'Content Creator Social Media', 'Lembaga Penyiaran TV/Radio'],
        ];

        foreach ($map as $kode => $lingkupKerja) {
            Jurusan::where('kode', $kode)->update(['lingkup_kerja' => json_encode($lingkupKerja)]);
        }
    }

    protected function syncKerjasamaUniversitas(): void
    {
        // id, logo & urutan persis dump `sekolah_db.sql` (termasuk Universitas Amikom).
        // Dicocokkan lewat `nama`, jadi tidak menimpa logo yang sudah diunggah admin.
        $rows = [
            ['id' => 1, 'urutan' => 1, 'nama' => 'Institut Pertanian Bogor (IPB)', 'logo' => 'kerjasama_universitas/W0EE4VTfYvCtXzz3aYTB1d1EfQC4T1A58uXWeaBp.png'],
            ['id' => 2, 'urutan' => 2, 'nama' => 'Telkom University', 'logo' => 'kerjasama_universitas/yDxied9r6ByVSU2A38xzdJs5KozEyNX1AJ6AYDwa.png'],
            ['id' => 3, 'urutan' => 3, 'nama' => 'Universitas Ibn Khaldun (UIKA) Bogor', 'logo' => 'kerjasama_universitas/EscVTuAHnUiTa6lILtjAWVllj2CUrSXoSnVkJ54T.png'],
            ['id' => 4, 'urutan' => 4, 'nama' => 'Universitas Gunadarma', 'logo' => 'kerjasama_universitas/sZBOdO1RJhWjABlgVmSyaGPTjjq0ukk6hi2odKcO.jpg'],
            ['id' => 5, 'urutan' => 5, 'nama' => 'Institut Bisnis dan Informatika Kesatuan (IBIK) Bogor', 'logo' => 'kerjasama_universitas/5tk5PI5RvGbl1kLH6lIUUCehNtbCdxwcOYgczoXY.jpg'],
            ['id' => 6, 'urutan' => 7, 'nama' => 'Universitas Bunda Mulia (UBM)', 'logo' => 'kerjasama_universitas/tJGrQa4LZiEyXyeRzDairAsM0tnZNhAcMRmNJQRO.jpg'],
            ['id' => 7, 'urutan' => 8, 'nama' => 'Japan Foundation', 'logo' => 'kerjasama_universitas/4Xzzg2AKKNK3Mz0Kg0pDVr9Q2MG6Kuy8aEH66un4.png'],
            ['id' => 8, 'urutan' => 6, 'nama' => 'Universitas Amikom', 'logo' => 'kerjasama_universitas/UWhvhLU0LTaYchQ1EZ44IiZPDWIW1W0hK9kTst91.png'],
        ];

        KerjasamaUniversitas::unguarded(function () use ($rows) {
            foreach ($rows as $row) {
                KerjasamaUniversitas::firstOrCreate(['nama' => $row['nama']], $row);
            }
        });
    }

    protected function syncKerjasamaIndustri(): void
    {
        // id, logo & urutan persis dump `sekolah_db.sql` (26 mitra aktif; "PMN" dan
        // "MCM" sudah dihapus admin sehingga tidak ditambahkan lagi).
        // Dicocokkan lewat `nama`.
        $rows = [
            ['id' => 1, 'urutan' => 1, 'nama' => 'BSI (Bank Syariah Indonesia)', 'logo' => 'kerjasama_industri/xXOPx2m7j84DEiCMIjdVDZNyGwISsdvruMgwtzrk.jpg'],
            ['id' => 2, 'urutan' => 2, 'nama' => 'Bank BJB Syariah', 'logo' => 'kerjasama_industri/z5q8C04iNWfW2nYMl7oT3sLtvaw7HJBirjuvGHeu.png'],
            ['id' => 3, 'urutan' => 3, 'nama' => 'BONET IT Solution Partner', 'logo' => 'kerjasama_industri/GJnu438egQZ4lqVM8lI9G82DrKa9zuwVdIAfINvM.jpg'],
            ['id' => 4, 'urutan' => 4, 'nama' => 'MSV Studio', 'logo' => 'kerjasama_industri/Hm44PwIcniyjVDlC1nhVmbt84B8QyLv5Gapi3lOg.jpg'],
            ['id' => 5, 'urutan' => 5, 'nama' => 'Cakrawala Digital Indonesia', 'logo' => 'kerjasama_industri/aUsTHlondAJSBK32kXx4YTtWPRGYNEy3oXa3EMc4.png'],
            ['id' => 6, 'urutan' => 6, 'nama' => 'CITRAWEB Solusi Teknologi', 'logo' => 'kerjasama_industri/3MbrScwnUyyXeRGNsCWrkLpyXjRjDXEKyqCMmojg.jpg'],
            ['id' => 7, 'urutan' => 7, 'nama' => 'Bank Mandiri', 'logo' => 'kerjasama_industri/W2hgj8ChgdLSkVLwpkqebKCcLiNk7dtidTOuuBsV.png'],
            ['id' => 8, 'urutan' => 8, 'nama' => 'Laku', 'logo' => 'kerjasama_industri/0yHqimd5qbOUnfApnirb8YLOBKzU0cJTJKluoXkR.png'],
            ['id' => 9, 'urutan' => 9, 'nama' => 'IPB Press', 'logo' => 'kerjasama_industri/vl1HnMQSFkjfZmcFgPL6LiRN8TqbULRFYN7HlJsG.png'],
            ['id' => 10, 'urutan' => 10, 'nama' => 'Bharata Tour Organizer', 'logo' => 'kerjasama_industri/3CYUKd34K856Uu04G999fQvFICxZGdhBdUD0jBo8.jpg'],
            ['id' => 11, 'urutan' => 11, 'nama' => 'Jawa Pos', 'logo' => 'kerjasama_industri/upPbZVN9SOywWUO724Ad7DmUOQHxyZ6Q9An9Wx9E.png'],
            ['id' => 12, 'urutan' => 12, 'nama' => 'Mega Motor', 'logo' => 'kerjasama_industri/oHXVhBbnfvBKGQSEK3ZJ5H9tOVzA7hIGhfZmZzFF.jpg'],
            ['id' => 13, 'urutan' => 13, 'nama' => 'Almadita Global College', 'logo' => 'kerjasama_industri/iIixrHRo8kYgYX7QTcMZ6ZBcaK6Krh8d0jhgfeLc.png'],
            ['id' => 14, 'urutan' => 14, 'nama' => 'OSM (PT. Ovall Solusindo Mandiri)', 'logo' => 'kerjasama_industri/fbYnunjH7GH8GPVofynOJ9jNqFBc7gH5jiH6N0DZ.png'],
            ['id' => 15, 'urutan' => 15, 'nama' => 'Cabs', 'logo' => 'kerjasama_industri/N5GBjU1xKOg2dKWWfHzEucAVM0QjcoG7VUI4dYSX.png'],
            ['id' => 16, 'urutan' => 16, 'nama' => 'by.U', 'logo' => 'kerjasama_industri/PqtaS39JxZL8juXkym4B5OjWWAxagDIJZHdIRma5.png'],
            ['id' => 17, 'urutan' => 17, 'nama' => 'MUM', 'logo' => 'kerjasama_industri/Mk6bejeVidlCQdX5Wi5RQYRrYHoKy5aD5r7eQsVK.jpg'],
            ['id' => 18, 'urutan' => 18, 'nama' => 'Tribunnews.com', 'logo' => 'kerjasama_industri/P161aY5K0RwNzmN5y062LkF3s0KbFGFX7nbzUmjI.webp'],
            ['id' => 20, 'urutan' => 19, 'nama' => 'AdiTV', 'logo' => 'kerjasama_industri/loxKBnTULjgemSZyaGTv6oyZ48npXIBsEg3dhkHg.png'],
            ['id' => 21, 'urutan' => 20, 'nama' => 'Anteraja', 'logo' => 'kerjasama_industri/7ssq2DFMyWtkZtCIXDwywzKv8h4qctzYyljFuNDp.jpg'],
            ['id' => 22, 'urutan' => 21, 'nama' => 'Taman Safari Bogor', 'logo' => 'kerjasama_industri/CZ6Chl21N5oxhRbwFt0Vx2b0PK8r3ZsQQX9SCKjX.webp'],
            ['id' => 23, 'urutan' => 22, 'nama' => 'Seki Sho (Sekisho Group)', 'logo' => 'kerjasama_industri/NVoozf4efMTJWkYaojZXmC0UuNWxyum4N4mQX9yL.png'],
            ['id' => 24, 'urutan' => 23, 'nama' => 'Sakura Edukasi', 'logo' => 'kerjasama_industri/3hF3MQcaegFHKxTDNfA9nI7utD8grOQmjIzjcOnh.jpg'],
            ['id' => 25, 'urutan' => 24, 'nama' => 'Azalee Group', 'logo' => 'kerjasama_industri/I3VbtNLEV1KnJb1fqkdGhgUWrePirLdvTxvLcwRJ.jpg'],
            ['id' => 26, 'urutan' => 25, 'nama' => 'AiCI (Artificial Intelligence Center Indonesia)', 'logo' => 'kerjasama_industri/lnqKK5oEcsxA8qC6Ht6005wPYnwciKF3XdmcS0i8.jpg'],
            ['id' => 27, 'urutan' => 26, 'nama' => 'Tenma Hospital Group', 'logo' => 'kerjasama_industri/RBzKU81bDmXMeylUznWjS8KaDx0Iw8bFKHhPSbtm.jpg'],
        ];

        KerjasamaIndustri::unguarded(function () use ($rows) {
            foreach ($rows as $row) {
                KerjasamaIndustri::firstOrCreate(['nama' => $row['nama']], $row);
            }
        });
    }
}