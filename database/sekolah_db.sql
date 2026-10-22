-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 21 Okt 2026 pada 08.18
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.5.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sekolah_db`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL DEFAULT 'Admin Sekolah',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`, `nama_lengkap`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', '$2y$12$c4RrfPGneA/9VI8YS7WZPuJi7a/PAZZxRUkq/uccEpTJnSiZKGCf6', 'Admin SMK INFOKOM', 'Vq7EAQZe5VWdW78YeUE1ZFmVXqa8P28FFvH722bJxpSdLwt2ExGje5cpwoEQ', '2026-10-18 17:05:44', '2026-10-18 17:05:44');

-- --------------------------------------------------------

--
-- Struktur dari tabel `berita`
--

CREATE TABLE `berita` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `slug` varchar(191) NOT NULL,
  `judul` varchar(200) NOT NULL,
  `kategori` varchar(50) NOT NULL,
  `ringkasan` text NOT NULL,
  `konten` longtext NOT NULL,
  `gambar_sampul` varchar(255) NOT NULL,
  `penulis` varchar(100) NOT NULL DEFAULT 'Admin Sekolah',
  `tanggal` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `berita`
--

INSERT INTO `berita` (`id`, `slug`, `judul`, `kategori`, `ringkasan`, `konten`, `gambar_sampul`, `penulis`, `tanggal`, `created_at`, `updated_at`) VALUES
(1, 'pendaftaran-ppdb-2025-2026-dibuka', 'Pendaftaran Peserta Didik Baru Tahun Ajaran 2025/2026 Resmi Dibuka', 'Pengumuman', 'SMK INFOKOM Kota Bogor membuka pendaftaran peserta didik baru untuk empat kompetensi keahlian.', 'SMK Informatika dan Telekomunikasi (INFOKOM) Kota Bogor resmi membuka Penerimaan Peserta Didik Baru (PPDB) untuk tahun ajaran 2025/2026. Pendaftaran dapat dilakukan secara daring melalui halaman PPDB pada website ini maupun langsung datang ke sekolah pada hari dan jam kerja.\n\nCalon peserta didik dapat memilih salah satu dari empat kompetensi keahlian yang tersedia, yaitu Teknik Komputer dan Jaringan, Rekayasa Perangkat Lunak, Multimedia, serta Produksi dan Siaran Program Televisi.\n\nPanitia PPDB siap membantu proses pendaftaran melalui nomor telepon maupun WhatsApp Humas sekolah.', 'berita/demo-1.jpg', 'Admin Sekolah', '2025-01-10', '2026-10-18 17:05:44', '2026-10-18 17:05:44'),
(2, 'karya-siswa-multimedia-terpilih-festival-film', 'Karya Siswa Multimedia Terpilih pada Festival Film Pelajar Kota Bogor', 'Prestasi', 'Tim Multimedia SMK INFOKOM Kota Bogor berhasil masuk nominasi festival film pelajar tingkat kota.', 'Siswa kompetensi keahlian Multimedia SMK INFOKOM Kota Bogor kembali menorehkan prestasi membanggakan setelah karya film pendek mereka terpilih pada festival film pelajar tingkat Kota Bogor.\n\nKarya tersebut merupakan hasil pembelajaran produksi audio visual yang dikerjakan langsung oleh siswa, mulai dari penulisan skenario, pengambilan gambar, hingga proses penyuntingan akhir.\n\nPrestasi ini menjadi bukti nyata kualitas pembelajaran praktik di studio multimedia sekolah.', 'berita/demo-4.jpg', 'Admin Sekolah', '2025-02-18', '2026-10-18 17:05:44', '2026-10-18 17:05:44'),
(3, 'uji-kompetensi-keahlian-kelas-xii', 'Uji Kompetensi Keahlian Kelas XII Bersama Asesor Industri', 'Akademik', 'Siswa kelas XII mengikuti Uji Kompetensi Keahlian yang dinilai langsung oleh asesor dari industri mitra.', 'Sebagai bagian dari proses kelulusan, siswa kelas XII SMK INFOKOM Kota Bogor mengikuti rangkaian Uji Kompetensi Keahlian (UKK) yang dinilai langsung oleh asesor dari dunia usaha dan dunia industri.\n\nSetiap kompetensi keahlian menyiapkan proyek uji yang relevan dengan kebutuhan dunia kerja saat ini, mulai dari konfigurasi jaringan, pengembangan aplikasi, produksi konten multimedia, hingga produksi program televisi.\n\nHasil UKK menjadi salah satu tolok ukur kesiapan kerja lulusan sebelum terjun ke dunia industri.', 'berita/demo-2.jpg', 'Admin Sekolah', '2025-03-20', '2026-10-18 17:05:44', '2026-10-18 17:05:44'),
(4, 'dokumentasi-produksi-program-televisi-studio-sekolah', 'Dokumentasi Produksi Program Televisi di Studio Sekolah', 'Kegiatan', 'Siswa kompetensi keahlian PSPT berlatih memproduksi program televisi secara langsung di studio sekolah.', 'Studio televisi SMK INFOKOM Kota Bogor kembali digunakan untuk praktik produksi program siaran oleh siswa kompetensi keahlian Produksi dan Siaran Program Televisi (PSPT).\n\nDalam kegiatan ini, siswa berperan langsung sebagai sutradara, kameramen, penata artistik, hingga pengisi acara, dengan pendampingan penuh dari guru produktif.\n\nKegiatan semacam ini rutin dilaksanakan untuk mengasah kesiapan siswa menghadapi dunia penyiaran profesional.', 'berita/demo-3.jpg', 'Admin Sekolah', '2025-04-05', '2026-10-18 17:05:44', '2026-10-18 17:05:44');

-- --------------------------------------------------------

--
-- Struktur dari tabel `berita_foto`
--

CREATE TABLE `berita_foto` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `berita_id` bigint(20) UNSIGNED NOT NULL,
  `url_gambar` varchar(255) NOT NULL,
  `urutan` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `bkk_follow`
--

CREATE TABLE `bkk_follow` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `urutan` int(11) NOT NULL DEFAULT 0,
  `icon` varchar(50) NOT NULL,
  `judul` varchar(150) NOT NULL,
  `deskripsi` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `bkk_follow`
--

INSERT INTO `bkk_follow` (`id`, `urutan`, `icon`, `judul`, `deskripsi`, `created_at`, `updated_at`) VALUES
(1, 1, 'bell', 'Info Loker Real-Time', 'Jadi yang pertama tahu saat ada lowongan kerja baru dari mitra industri BKK.', '2026-10-18 17:05:43', '2026-10-18 17:05:43'),
(2, 2, 'calendar-days', 'Jadwal Kegiatan', 'Pantau jadwal pembekalan, walk-in interview, dan job fair yang diadakan BKK.', '2026-10-18 17:05:43', '2026-10-18 17:05:43'),
(3, 3, 'star', 'Kisah Sukses Alumni', 'Lihat cerita alumni yang berhasil disalurkan dan diterima bekerja.', '2026-10-18 17:05:43', '2026-10-18 17:05:43');

-- --------------------------------------------------------

--
-- Struktur dari tabel `bkk_konten`
--

CREATE TABLE `bkk_konten` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `apa_itu` text DEFAULT NULL,
  `ig_nama` varchar(100) NOT NULL DEFAULT 'BKK INFOKOM',
  `ig_foto` varchar(255) DEFAULT NULL,
  `ig_username` varchar(100) NOT NULL DEFAULT 'bkkinfokom',
  `ig_bio` text DEFAULT NULL,
  `ig_kiriman` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `ig_pengikut` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `ig_diikuti` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `ig_url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `bkk_konten`
--

INSERT INTO `bkk_konten` (`id`, `apa_itu`, `ig_nama`, `ig_foto`, `ig_username`, `ig_bio`, `ig_kiriman`, `ig_pengikut`, `ig_diikuti`, `ig_url`, `created_at`, `updated_at`) VALUES
(1, 'Bursa Kerja Khusus (BKK) INFOKOM adalah lembaga unit pelaksana di SMK INFOKOM yang memberikan pelayanan dan informasi lowongan kerja, bimbingan karier, serta penyaluran dan penempatan tenaga kerja bagi para lulusan SMK INFOKOM Kota Bogor.', 'BKK INFOKOM', 'bkk/profil/Vxbpx9QMErmB3YQ9hXLEvM2r8MELP9WFnSpW7F44.jpg', 'bkkinfokom', 'Info loker & penyaluran kerja alumni SMK INFOKOM Kota Bogor.', 108, 850, 8, 'https://www.instagram.com/bkkinfokom/', '2026-10-18 17:05:43', '2026-10-18 17:05:43');

-- --------------------------------------------------------

--
-- Struktur dari tabel `bkk_langkah`
--

CREATE TABLE `bkk_langkah` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `urutan` int(11) NOT NULL DEFAULT 0,
  `nomor` varchar(5) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `deskripsi` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `bkk_langkah`
--

INSERT INTO `bkk_langkah` (`id`, `urutan`, `nomor`, `judul`, `deskripsi`, `created_at`, `updated_at`) VALUES
(1, 1, '01', 'Daftar ke BKK', 'Alumni mendaftarkan diri sebagai pencari kerja binaan BKK INFOKOM.', '2026-10-18 17:05:43', '2026-10-18 17:05:43'),
(2, 2, '02', 'Bimbingan & Konseling', 'Mendapat pembekalan CV, wawancara kerja, dan konsultasi minat karier.', '2026-10-18 17:05:43', '2026-10-18 17:05:43'),
(3, 3, '03', 'Pencocokan Lowongan', 'BKK mencocokkan profil alumni dengan lowongan dari mitra industri.', '2026-10-18 17:05:43', '2026-10-18 17:05:43'),
(4, 4, '04', 'Penyaluran & Penempatan', 'Alumni disalurkan dan ditempatkan bekerja di perusahaan mitra.', '2026-10-18 17:05:43', '2026-10-18 17:05:43');

-- --------------------------------------------------------

--
-- Struktur dari tabel `bkk_layanan`
--

CREATE TABLE `bkk_layanan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `urutan` int(11) NOT NULL DEFAULT 0,
  `icon` varchar(50) NOT NULL,
  `judul` varchar(150) NOT NULL,
  `deskripsi` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `bkk_layanan`
--

INSERT INTO `bkk_layanan` (`id`, `urutan`, `icon`, `judul`, `deskripsi`, `created_at`, `updated_at`) VALUES
(1, 1, 'megaphone', 'Info Lowongan Kerja', 'Menghimpun dan menyebarkan informasi lowongan kerja terpercaya dari berbagai mitra industri.', '2026-10-18 17:05:43', '2026-10-18 17:05:43'),
(2, 2, 'users', 'Bimbingan Karier', 'Konseling dan pembekalan agar siswa/alumni siap menghadapi dunia kerja, mulai dari CV hingga wawancara.', '2026-10-18 17:05:43', '2026-10-18 17:05:43'),
(3, 3, 'shield-check', 'Penyaluran Tenaga Kerja', 'Menjembatani dan menyalurkan lulusan ke perusahaan/industri yang membutuhkan tenaga kerja.', '2026-10-18 17:05:43', '2026-10-18 17:05:43'),
(4, 4, 'building', 'Kerja Sama Industri', 'Membangun kemitraan berkelanjutan dengan perusahaan untuk membuka lebih banyak peluang kerja bagi alumni.', '2026-10-18 17:05:43', '2026-10-18 17:05:43');

-- --------------------------------------------------------

--
-- Struktur dari tabel `bkk_media`
--

CREATE TABLE `bkk_media` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `judul` varchar(150) NOT NULL,
  `keterangan` text DEFAULT NULL,
  `jenis_media` varchar(20) NOT NULL DEFAULT 'instagram',
  `media_path` varchar(255) DEFAULT NULL,
  `media_ref` varchar(255) DEFAULT NULL,
  `sampul` varchar(255) DEFAULT NULL,
  `tema` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `urutan` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `bkk_media`
--

INSERT INTO `bkk_media` (`id`, `judul`, `keterangan`, `jenis_media`, `media_path`, `media_ref`, `sampul`, `tema`, `urutan`, `created_at`, `updated_at`) VALUES
(1, 'Rekrutmen Beasiswa', NULL, 'foto', 'bkk/foto/GUrXKGlOpYpif9mUrWJ2Gh6FoR4UDD7YVYY6ElWv.webp', NULL, NULL, 0, 2, '2026-10-18 17:05:44', '2026-10-18 17:05:44'),
(2, 'BKK SMK INFOKOM', NULL, 'foto', 'bkk/foto/b9Tf7HQ4rMlWpymT7UtaULGfdl75EmR7KURw9K6a.jpg', NULL, NULL, 0, 1, '2026-10-18 17:05:44', '2026-10-18 17:05:44'),
(3, 'BKK SMK INFOKOM', NULL, 'foto', 'bkk/foto/jzIGaQ9YpvPUVoiK4KdxP9t1PSw3ybEkTWgzSgO9.webp', NULL, NULL, 0, 0, '2026-10-18 17:05:44', '2026-10-18 17:05:44'),
(4, 'BKK SMK INFOKOM', NULL, 'foto', 'bkk/foto/gZ4wmRvv71AXJwOZyakxkAymiKt9G6aZA5y8nBV2.webp', NULL, NULL, 0, 0, '2026-10-18 17:05:44', '2026-10-18 17:05:44'),
(5, 'BKK SMK INFOKOM', NULL, 'foto', 'bkk/foto/OQHeCazRhWBtF6kkrfcaxTgt9qj00JDkqyo0vmaw.webp', NULL, NULL, 0, 0, '2026-10-18 17:05:44', '2026-10-18 17:05:44');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ekstrakurikuler`
--

CREATE TABLE `ekstrakurikuler` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `urutan` int(11) NOT NULL DEFAULT 0,
  `nama` varchar(100) NOT NULL,
  `icon` varchar(50) NOT NULL DEFAULT 'sparkles',
  `deskripsi` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `ekstrakurikuler`
--

INSERT INTO `ekstrakurikuler` (`id`, `urutan`, `nama`, `icon`, `deskripsi`, `created_at`, `updated_at`) VALUES
(1, 1, 'PASKIBRA', 'award', 'Membina sikap baris-berbaris, ketegasan, dan nasionalisme.', '2026-10-18 17:05:44', '2026-10-18 17:05:44'),
(2, 2, 'PRAMUKA', 'users', 'Melatih kedisiplinan, kemandirian, dan jiwa kepemimpinan siswa.', '2026-10-18 17:05:44', '2026-10-18 17:05:44'),
(3, 3, 'PMR', 'activity', 'Palang Merah Remaja, membina kepedulian dan keterampilan pertolongan pertama.', '2026-10-18 17:05:44', '2026-10-18 17:05:44'),
(4, 4, 'Japan Indonesia Community (JIC)', 'sparkles', 'Wadah pembelajaran bahasa dan budaya Jepang bagi siswa.', '2026-10-18 17:05:44', '2026-10-18 17:05:44'),
(5, 5, 'Cerdas TKA', 'book-open', 'Pembinaan akademik untuk persiapan Tes Kemampuan Akademik.', '2026-10-18 17:05:44', '2026-10-18 17:05:44'),
(6, 6, 'Tahsin/Tahfidz Qur\'an', 'star', 'Pembinaan bacaan dan hafalan Al-Qur\'an bagi siswa.', '2026-10-18 17:05:44', '2026-10-18 17:05:44'),
(7, 7, 'Futsal', 'trophy', 'Mengasah kekompakan tim dan prestasi olahraga futsal.', '2026-10-18 17:05:44', '2026-10-18 17:05:44'),
(8, 8, 'Handball', 'shield-check', 'Melatih kebugaran, kerja sama tim, dan prestasi olahraga bola tangan.', '2026-10-18 17:05:44', '2026-10-18 17:05:44'),
(9, 9, 'Bulu Tangkis', 'star', 'Menyalurkan minat dan bakat siswa di cabang olahraga bulu tangkis.', '2026-10-18 17:05:44', '2026-10-18 17:05:44'),
(10, 10, 'Basketball', 'trophy', 'Melatih kebugaran, kerja sama tim, dan semangat kompetisi.', '2026-10-18 17:05:44', '2026-10-18 17:05:44'),
(11, 11, 'Paduan Suara', 'megaphone', 'Menyalurkan bakat vokal siswa dalam kegiatan paduan suara sekolah.', '2026-10-18 17:05:44', '2026-10-18 17:05:44'),
(12, 12, 'Hadroh', 'sparkles', 'Kesenian musik Islami tradisional sebagai wadah kreativitas siswa.', '2026-10-18 17:05:44', '2026-10-18 17:05:44'),
(13, 13, 'Musik/Band', 'video', 'Wadah pengembangan bakat bermusik siswa lewat kegiatan band sekolah.', '2026-10-18 17:05:44', '2026-10-18 17:05:44');

-- --------------------------------------------------------

--
-- Struktur dari tabel `faq`
--

CREATE TABLE `faq` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `urutan` int(11) NOT NULL DEFAULT 0,
  `pertanyaan` varchar(255) NOT NULL,
  `jawaban` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `faq`
--

INSERT INTO `faq` (`id`, `urutan`, `pertanyaan`, `jawaban`, `created_at`, `updated_at`) VALUES
(1, 1, 'Kapan pendaftaran peserta didik baru dibuka?', 'Pendaftaran dibuka setiap awal tahun dan berlangsung sampai kuota masing-masing kompetensi keahlian terpenuhi. Informasi jadwal terbaru dapat ditanyakan ke panitia PPDB sekolah.', '2026-10-18 17:05:44', '2026-10-18 17:05:44'),
(2, 2, 'Apa saja kompetensi keahlian yang tersedia?', 'Tersedia empat kompetensi keahlian: Teknik Komputer dan Jaringan, Rekayasa Perangkat Lunak, Multimedia, serta Produksi dan Siaran Program Televisi.', '2026-10-18 17:05:44', '2026-10-18 17:05:44'),
(3, 3, 'Dokumen apa yang harus disiapkan saat mendaftar?', 'Fotokopi akta kelahiran, kartu keluarga, rapor SMP/MTs, surat keterangan lulus atau ijazah, dan pas foto terbaru.', '2026-10-18 17:05:44', '2026-10-18 17:05:44'),
(4, 4, 'Bagaimana cara menghubungi panitia PPDB?', 'Silakan hubungi nomor telepon sekolah (0251) 8348108, WhatsApp Humas 0878-7307-1400, atau datang langsung ke sekolah pada hari dan jam kerja.', '2026-10-18 17:05:44', '2026-10-18 17:05:44');

-- --------------------------------------------------------

--
-- Struktur dari tabel `fasilitas`
--

CREATE TABLE `fasilitas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `urutan` int(11) NOT NULL DEFAULT 0,
  `kategori` varchar(100) DEFAULT 'Sarana & Prasarana',
  `judul` varchar(150) NOT NULL,
  `deskripsi` text NOT NULL,
  `icon` varchar(50) DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `gambar_2` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `fasilitas`
--

INSERT INTO `fasilitas` (`id`, `urutan`, `kategori`, `judul`, `deskripsi`, `icon`, `gambar`, `gambar_2`, `created_at`, `updated_at`) VALUES
(15, 1, 'Ruang Pembelajaran', 'Ruang Kelas', 'Ruang belajar yang nyaman dan tertata untuk mendukung kegiatan belajar mengajar setiap hari.', 'presentation', 'fasilitas/uOrBsOLW2vmZ5dGNOqWn8UprfjUfEa4Ct1owFVGo.jpg', NULL, '2026-10-18 17:05:44', '2026-10-18 17:05:44'),
(16, 2, 'Ruang Pembelajaran', 'Perpustakaan', 'Tempat membaca dan belajar mandiri dengan koleksi buku pelajaran, kejuruan, dan bacaan umum untuk menumbuhkan budaya literasi.', 'book-open', 'fasilitas/aQl0rpvn4UApI4z2RZ1mUVvIFs6awBq7NEDJzU2l.jpg', NULL, '2026-10-18 17:05:44', '2026-10-18 17:05:44'),
(17, 3, 'Pimpinan & Administrasi', 'Ruang Kepala Sekolah', 'Ruang kerja pimpinan sekolah sekaligus tempat menerima tamu, orang tua, dan mitra sekolah.', 'building', 'fasilitas/TSi9oauxcOan4Si6TPKkdPrfSw1qucrYVmpdyK2Z.jpg', NULL, '2026-10-18 17:05:44', '2026-10-18 17:05:44'),
(18, 4, 'Pimpinan & Administrasi', 'Ruang Guru', 'Ruang kerja para guru untuk menyiapkan pembelajaran, berdiskusi, dan melayani konsultasi siswa.', 'users', 'fasilitas/8cljvQwEfjLo1kzWEHzq6K6j7ueiP94QO8Yt7yps.jpg', NULL, '2026-10-18 17:05:44', '2026-10-18 17:05:44'),
(19, 5, 'Pimpinan & Administrasi', 'Tata Usaha', 'Pusat layanan administrasi sekolah, mulai dari pengelolaan data siswa hingga surat-menyurat.', 'folder', 'fasilitas/zB8yf3SmBRVmQuIZ0PFwjdIyxpfuA8IpTTpqPF3b.jpg', 'fasilitas/7fg3m1IF4SyLsxyflHfU1KHP8SJDGwwKOqO5lDb1.jpg', '2026-10-18 17:05:44', '2026-10-18 17:05:44'),
(20, 6, 'Penunjang Sekolah', 'Musholla', 'Sarana ibadah yang bersih dan nyaman bagi seluruh warga sekolah.', 'mosque', 'fasilitas/hy8cJCQEDH7jPU7CFcJcVZAogzwAbh1mhdF1guqF.jpg', NULL, '2026-10-18 17:05:44', '2026-10-18 17:05:44'),
(21, 7, 'Penunjang Sekolah', 'Kantin', 'Tempat istirahat dan makan bagi siswa serta guru dengan berbagai pilihan makanan dan minuman.', 'utensils', 'fasilitas/BN7j8Jb2jM3DpjHAxQvgkv7masB2xq0ua1qY2OsH.jpg', NULL, '2026-10-18 17:05:44', '2026-10-18 17:05:44'),
(22, 8, 'Penunjang Sekolah', 'Taman', 'Area hijau yang asri sebagai ruang berkumpul, bersantai, dan belajar santai di luar kelas.', 'trees', 'fasilitas/vqbTWluRFNj0CUOJlh5KBXtZjWBftsnNgsatxpEs.jpg', NULL, '2026-10-18 17:05:44', '2026-10-18 17:05:44');

-- --------------------------------------------------------

--
-- Struktur dari tabel `galeri`
--

CREATE TABLE `galeri` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `urutan` int(11) NOT NULL DEFAULT 0,
  `sumber` varchar(255) NOT NULL,
  `judul` varchar(150) NOT NULL,
  `kategori` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `galeri`
--

INSERT INTO `galeri` (`id`, `urutan`, `sumber`, `judul`, `kategori`, `created_at`, `updated_at`) VALUES
(1, 1, 'galeri/QOALoUVblyEbtG8iHH8XNtyJOPpEY4JOIQXKQjq3.jpg', 'Praktik Konfigurasi Jaringan', 'Akademik', '2026-10-18 17:05:44', '2026-10-19 12:24:29'),
(2, 2, 'galeri/3na8brGf535hhcUUoquhK3zmKD7TdK3aGnusO4E8.jpg', 'Raung Perpustakaan', 'Akademik', '2026-10-18 17:05:44', '2026-10-19 12:24:38'),
(3, 3, 'galeri/dQViBY8qgSkzQF8wRMrzhZtCC5mAPNNJ6uutD8Gr.png', 'Kunjungan Industri', 'Akademik', '2026-10-18 17:05:44', '2026-10-19 12:24:57'),
(4, 4, 'galeri/FvxM4rgFy7rGz6wIB0gwdDjqCImcbx5uZFAYvllR.jpg', 'Juara 1 Mobile Legen', 'Kegiatan', '2026-10-18 17:05:44', '2026-10-19 12:25:08');

-- --------------------------------------------------------

--
-- Struktur dari tabel `guru_staff`
--

CREATE TABLE `guru_staff` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_lengkap` varchar(150) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `jabatan` varchar(150) NOT NULL,
  `kategori` varchar(100) NOT NULL DEFAULT 'Guru & Staf',
  `urutan` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `guru_staff`
--

INSERT INTO `guru_staff` (`id`, `nama_lengkap`, `foto`, `jabatan`, `kategori`, `urutan`, `created_at`, `updated_at`) VALUES
(1, 'Ir. Hj. Liliek Rahmaningsih, M.M.Pd.', 'guru-staff/gUGi1A7kgs8zvZBfl3Tq5MkIwlkw9ch0uZ0XjBTE.png', 'Kepala Sekolah', 'Pimpinan Sekolah', 1, '2026-10-18 17:05:44', '2026-10-18 17:05:44'),
(2, 'Mila Yaelasari, M.Pd.', 'guru-staff/rzqNJbwIfCVJBxpXmhiTZ4j0U7FUiFxzwTdHUvai.png', 'Wakil Kepala Sekolah Bidang Kurikulum', 'Pimpinan Sekolah', 2, '2026-10-18 17:05:44', '2026-10-18 17:05:44'),
(3, 'Dea Rijalul Fikri, S.Kom., Gr.', 'guru-staff/LeWTAysrIN9YplZ3x3LgCvI9WM34366w8Ffo8yij.png', 'Wakil Kepala Sekolah Bidang Kesiswaan', 'Pimpinan Sekolah', 3, '2026-10-18 17:05:44', '2026-10-18 17:05:44'),
(4, 'R. Radiani Srirestuti Dewi, SS., Gr.', 'guru-staff/esrj7d54I9A5kBLFAANuoDdi9c0WWuzgCIgqIzq6.png', 'Wakil Kepala Sekolah Bidang Hubungan Industri dan Masyarakat', 'Pimpinan Sekolah', 4, '2026-10-18 17:05:44', '2026-10-18 17:05:44'),
(5, 'Heny Handayani, S.Pd.', 'guru-staff/hAWzQN1k27x0QQNV8Eb1aLRO5gTVyxI0AhiPZgRq.png', 'Wakil Kepala Sekolah Bidang Pengembangan Sumber Daya Manusia', 'Pimpinan Sekolah', 5, '2026-10-18 17:05:44', '2026-10-18 17:05:44'),
(6, 'Agus Tiyono, M.Pd.', 'guru-staff/YrnuZpLLfZOfr1FGRLOXdtMM4LQsvzy9ACpdDKnE.png', 'Wakil Kepala Sekolah Bidang Sarana dan Prasarana', 'Pimpinan Sekolah', 6, '2026-10-18 17:05:44', '2026-10-18 17:05:44'),
(7, 'Aditya Nugraha, ST.', 'guru-staff/rnpe0gfOfNYskgoB0NEa6q4MAWm7d80L196CGp8y.png', 'Ketua Manajemen Mutu', 'Manajemen & Tata Usaha', 1, '2026-10-18 17:05:44', '2026-10-18 17:05:44'),
(8, 'Cahyadi Rozi, ST.', 'guru-staff/P8xKpTztUR5dYkCmQe36NnaskBQ88HLubLvzP1NR.png', 'Kepala Tata Usaha', 'Manajemen & Tata Usaha', 2, '2026-10-18 17:05:44', '2026-10-18 17:05:44'),
(9, 'Drs. Puji Marhaen Waluyo', 'guru-staff/fMsbicsvP3DtAbuiIf93Vdr4GVvciuCcH5f8pDpW.png', 'Kepala Perpustakaan', 'Manajemen & Tata Usaha', 3, '2026-10-18 17:05:44', '2026-10-18 17:05:44'),
(10, 'Putri Riandini, S.Hut., M.Pd., Gr.', 'guru-staff/4vM2kGyzzj40AEwBp4qFJBTwlhmIG1aM7HNIkmb1.png', 'Kepala Bendahara', 'Manajemen & Tata Usaha', 4, '2026-10-18 17:05:44', '2026-10-18 17:05:44'),
(11, 'Aditya Nugraha, ST.', 'guru-staff/2JdYdtG8VAPl5nfvBfVsHzWHv0IeDoOvKSnR2ooA.png', 'Kepala Program Keahlian TKJ', 'Kepala Program Keahlian', 1, '2026-10-18 17:05:44', '2026-10-18 17:05:44'),
(12, 'Ridwan Hala, S.Kom., Gr.', 'guru-staff/DwwhpU9Em63R5errOI9u6XMcTmtcEeJ16Qf7MW9Z.png', 'Kepala Program Keahlian RPL', 'Kepala Program Keahlian', 2, '2026-10-18 17:05:44', '2026-10-18 17:05:44'),
(13, 'Muhammad Ibnu Arif, S.IKom.', 'guru-staff/PRdZZEqxcxGu8p6WGLYTZUEfusuZeZelJvzcOLVI.png', 'Kepala Program Keahlian DKV', 'Kepala Program Keahlian', 3, '2026-10-18 17:05:44', '2026-10-18 17:05:44'),
(14, 'Erli Suherli, A.Md.Kom.', 'guru-staff/9J67aZDYNaJNINUJFfOPIxl4NR6aVJbUo9vjGvN4.png', 'Kepala Program Keahlian PSPT', 'Kepala Program Keahlian', 4, '2026-10-18 17:05:44', '2026-10-18 17:05:44'),
(15, 'Ahmad Hotib, S.Pd.I', 'guru-staff/2gY42lTaUHpZ5wrjS6eKaAMvzM9X08NyiNuXIxzh.png', 'Pembina OSIS', 'Pembina OSIS', 1, '2026-10-18 17:05:44', '2026-10-18 17:05:44'),
(16, 'Abdul Azis, M.Pd.', 'guru-staff/UMxXZd5aopWNSNtf2ApA8D5QWCW6BQcrmLx8J7xi.png', 'Pembina OSIS', 'Pembina OSIS', 2, '2026-10-18 17:05:44', '2026-10-18 17:05:44'),
(17, 'Vera Yuni Astuti, SP., M.IKom., Gr.', 'guru-staff/3LcHJiQBO7SP0gDq3myBbNobSDsQMDwONR9IWtAa.png', 'Guru PKK', 'Guru & Staf', 1, '2026-10-18 17:05:44', '2026-10-18 17:05:44'),
(18, 'M. Fauzan Arifin, S.IKom., Gr.', 'guru-staff/p0by4WV7pPgfW4iys7jNbFwm7Hy9JVcVuQ55fOlF.png', 'Guru Desain Publikasi & Fotografi', 'Guru & Staf', 2, '2026-10-18 17:05:44', '2026-10-18 17:05:44'),
(19, 'Dra. Popon Puspitasari', 'guru-staff/kaRXaUCN051lCNqdu8rGzPJnRjYqhQTTFv65PlT3.png', 'Guru PAI', 'Guru & Staf', 3, '2026-10-18 17:05:44', '2026-10-18 17:05:44'),
(20, 'Richo Santana, S.Kom.', 'guru-staff/haYC34B4IdVC9AFWKwqfFKUMR1dNuUjunhxO2sde.png', 'Guru PWPB', 'Guru & Staf', 4, '2026-10-18 17:05:44', '2026-10-18 17:05:44'),
(21, 'Dian Hardianti, S.Kom., Gr.', 'guru-staff/Cioy1U8p9GVloIPCRaKz99IUAYHr4CCUcoY9wiB6.png', 'Guru Basis Data', 'Guru & Staf', 5, '2026-10-18 17:05:44', '2026-10-18 17:05:44'),
(22, 'Yeni Yuliawati, S.Pd., Gr.', 'guru-staff/csiKkRfsPMB5lncyopYKYJdtXuaVqppLhcqIlXjz.png', 'Guru Bahasa Indonesia', 'Guru & Staf', 6, '2026-10-18 17:05:44', '2026-10-18 17:05:44'),
(23, 'Rita Widyastuti', 'guru-staff/LmqZD6KNpvNvcC2h7vjL8PFpInKm4du0uY9p4P88.png', 'Staf Teller (Bendahara)', 'Guru & Staf', 7, '2026-10-18 17:05:44', '2026-10-18 17:05:44'),
(24, 'Eva Farida Rahayu, S.Pd., Gr.', 'guru-staff/48Yshzn7vYe0xYJEEvx1bq9RZRAlr1uMMrxYy5Wu.png', 'Guru Bahasa Indonesia', 'Guru & Staf', 8, '2026-10-18 17:05:44', '2026-10-18 17:05:44'),
(25, 'Jayadi, S.Pd., Gr.', 'guru-staff/VshJ8UvjtSa5VHJ5JemUPXcuYBFgVrwvOTXAejuz.png', 'Guru PJOK', 'Guru & Staf', 9, '2026-10-18 17:05:44', '2026-10-18 17:05:44'),
(26, 'Yadi Setiadi, S.Sos., Gr.', 'guru-staff/nA7l4RJhEP2YrdBxXlalkJFsdU2alrBkGYtHTs9W.png', 'Guru PKK', 'Guru & Staf', 10, '2026-10-18 17:05:44', '2026-10-18 17:05:44'),
(27, 'Siti Nuraeni', 'guru-staff/ukq0AVSD41KVmtBWmWWpcNpkRnOhO6BcJzHZU32K.png', 'Staf Tata Usaha', 'Guru & Staf', 11, '2026-10-18 17:05:44', '2026-10-18 17:05:44'),
(28, 'Reza Prafitriansyah, S.Kom., Gr.', 'guru-staff/0KE8f1jx1hb5CXhzFZsBQv3S2RtuGlMqIusqz985.png', 'Guru Dasar DKV', 'Guru & Staf', 12, '2026-10-18 17:05:44', '2026-10-18 17:05:44'),
(29, 'Dra. Diana Octaria', 'guru-staff/SQ5BWONNfor8uo1jOXl0spACHJEWHcByOi9LGiob.png', 'Guru PPKn', 'Guru & Staf', 13, '2026-10-18 17:05:44', '2026-10-18 17:05:44'),
(30, 'Nabila Ahmadia Pratama, S.Pd.', 'guru-staff/FFZD795JZPsbehHtZY3uwFJMaJMdRAQXhbozMmso.png', 'Guru Bahasa Indonesia', 'Guru & Staf', 14, '2026-10-18 17:05:44', '2026-10-18 17:05:44'),
(31, 'Erwin Hasiholan Gultom, S.Kom.', 'guru-staff/zco3poGvjFAuv41JXMDOzq4UtUXAtmzceODltJxl.png', 'Guru Produktif RPL', 'Guru & Staf', 15, '2026-10-18 17:05:44', '2026-10-18 17:05:44'),
(32, 'Widyatama Nuranisa, SM.', 'guru-staff/gbUWqIvCt0J0it9OuSsclEjNHJY2wnwTkT0l14AW.png', 'Guru PKK', 'Guru & Staf', 16, '2026-10-18 17:05:44', '2026-10-18 17:05:44'),
(33, 'Dara Purwanita, S.Pd., Gr.', 'guru-staff/ZrJQXSoBK4x2MfKlwhsAhBlD13w4Cq4RfwCotTqw.png', 'Guru Bahasa Inggris', 'Guru & Staf', 17, '2026-10-18 17:05:44', '2026-10-18 17:05:44'),
(34, 'Mila Yaelasari, M.Pd.', 'guru-staff/pBXqMltd6h1YVC7tp5evmWnTeT2qljyxIOzoDJiK.png', 'Guru Matematika', 'Guru & Staf', 0, '2026-10-18 17:44:06', '2026-10-19 12:25:49');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jurusan`
--

CREATE TABLE `jurusan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `urutan` int(11) NOT NULL DEFAULT 0,
  `kode` varchar(10) NOT NULL,
  `slug` varchar(160) DEFAULT NULL,
  `nama` varchar(150) NOT NULL,
  `deskripsi` text NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `gambar_lab` varchar(255) DEFAULT NULL,
  `warna` varchar(9) DEFAULT NULL,
  `poin` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`poin`)),
  `lingkup_kerja` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`lingkup_kerja`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `jurusan`
--

INSERT INTO `jurusan` (`id`, `urutan`, `kode`, `slug`, `nama`, `deskripsi`, `gambar`, `gambar_lab`, `warna`, `poin`, `lingkup_kerja`, `created_at`, `updated_at`) VALUES
(1, 1, 'TKJ', 'tkj', 'Teknik Komputer dan Jaringan', 'Membekali siswa menjadi teknisi dan administrator jaringan yang siap kerja di dunia teknologi informasi. Peserta didik dilatih merakit dan memperbaiki perangkat komputer, membangun serta mengelola jaringan LAN/WAN, hingga menerapkan sistem keamanan jaringan secara terpusat, sehingga siap terjun langsung ke industri maupun melanjutkan pendidikan di bidang TI.', 'jurusan/A4y8TtkbQMzCVieYXzoayODVzhaxKLhsXIsh7f6u.png', 'jurusan/VERMnTVvkYyxRfc4hfFclLu3yeFtSXXR0PY6Kldn.jpg', '#BD0AA2', '[\"IT Support Jaringan\",\"Perakitan dan Perbaikan Komputer\",\"Administrator Jaringan LAN\\/WAN\",\"Keamanan Jaringan Terpusat\"]', '[\"Perusahaan Jaringan\",\"Wireless Networking\",\"Network Administrator\",\"Server Administrator\",\"Computer Integrator\",\"Connection Integrator\"]', '2026-10-18 17:05:44', '2026-10-18 17:05:44'),
(2, 2, 'RPL', 'rpl', 'Rekayasa Perangkat Lunak', 'Mempelajari perancangan dan pembangunan perangkat lunak mulai dari aplikasi desktop hingga sistem enterprise berskala besar. Siswa dibimbing menguasai analisa dan perancangan sistem, pemrograman lintas platform (desktop, mobile, dan web), serta praktik langsung membangun aplikasi sesuai kebutuhan dunia industri.', 'jurusan/WXya0DgPNdWHU4Y6CPlnWvmTBqVXs3Dpze4X775F.png', 'jurusan/xFjcVUJcIkvQUlwoZmy1fBUWPbm3ucfV2ZAyuqKu.jpg', '#E0201B', '[\"Pemrograman Desktop\",\"Analisa dan Perancangan Sistem\",\"Arsitektur Desktop, Mobile dan Web\",\"Pengembangan Aplikasi Enterprise\"]', '[\"Desktop Programmer\",\"Mobile Programmer\",\"Web Programmer\",\"Analis Teknologi (Mobile, Desktop, Web, Enterprise)\"]', '2026-10-18 17:05:44', '2026-10-18 17:05:44'),
(3, 3, 'DKV', 'dkv', 'Desain Komunikasi Visual', 'Mengasah kemampuan produksi karya digital, mulai dari desain grafis, animasi, hingga audio visual interaktif. Siswa berlatih mengolah citra dan animasi digital, merancang tampilan web yang menarik, serta merekam dan menyunting audio video menjadi karya multimedia yang siap pakai untuk industri kreatif.', 'jurusan/bg6b6d7QapjRo5l3PqerRsgoNBiK4BjrivHxXtaW.png', 'jurusan/83TmV5lpKSorJAtOWJEDQKBoAgjIXTY1g1ZYXaV1.jpg', '#FF6A13', '[\"Pengolahan Citra dan Animasi Digital\",\"Desain Web Interaktif\",\"Rekam dan Sunting Audio Video\",\"Aplikasi Multimedia Interaktif\"]', '[\"Illustrator\",\"Animator\",\"Desainer Grafis\",\"Desainer Permainan (Game Designer)\",\"Content Creator\"]', '2026-10-18 17:05:44', '2026-10-18 17:05:44'),
(4, 4, 'PSPT', 'pspt', 'Produksi dan Siaran Program Televisi', 'Menyiapkan kru penyiaran profesional yang menguasai seluruh tahapan produksi program televisi, mulai dari perencanaan hingga tayang. Siswa dilatih langsung berperan sebagai sutradara, kameramen, dan editor, merangkap penata artistik dan penata suara, sekaligus menulis naskah dan skenario program siaran secara utuh.', 'jurusan/TgOWE8MyXeok971fmcsUUvxbANUgkQ37AYBbyhKe.png', 'jurusan/DkthlOqDXseccoguxTTOnEDBJzo5a5OtHIuc9o4B.jpg', '#F2C200', '[\"Dasar Pertelevisian\",\"Penyutradaraan, Editor dan Kameramen\",\"Penata Artistik dan Penata Suara\",\"Penulis Naskah dan Skenario\"]', '[\"Biro Advertising\",\"Rumah Produksi (Production House)\",\"Content Creator Social Media\",\"Lembaga Penyiaran TV\\/Radio\"]', '2026-10-18 17:05:44', '2026-10-18 17:05:44');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kalender_akademik`
--

CREATE TABLE `kalender_akademik` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `urutan` int(11) NOT NULL DEFAULT 0,
  `periode` varchar(100) NOT NULL,
  `agenda` varchar(150) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kalender_akademik`
--

INSERT INTO `kalender_akademik` (`id`, `urutan`, `periode`, `agenda`, `created_at`, `updated_at`) VALUES
(1, 1, 'Juli', 'Masa Pengenalan Lingkungan Sekolah (MPLS)', '2026-10-18 17:05:44', '2026-10-18 17:05:44'),
(2, 2, 'September', 'Penilaian Tengah Semester Ganjil', '2026-10-18 17:05:44', '2026-10-18 17:05:44'),
(3, 3, 'Desember', 'Penilaian Akhir Semester & Class Meeting', '2026-10-18 17:05:44', '2026-10-18 17:05:44'),
(4, 4, 'Januari', 'Praktik Kerja Lapangan Kelas XI', '2026-10-18 17:05:44', '2026-10-18 17:05:44'),
(5, 5, 'Maret', 'Uji Kompetensi Keahlian Kelas XII', '2026-10-18 17:05:44', '2026-10-18 17:05:44'),
(6, 6, 'Juni', 'Kenaikan Kelas & Pelepasan Siswa Kelas XII', '2026-10-18 17:05:44', '2026-10-18 17:05:44');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kerjasama_industri`
--

CREATE TABLE `kerjasama_industri` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `urutan` int(11) NOT NULL DEFAULT 0,
  `nama` varchar(200) NOT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kerjasama_industri`
--

INSERT INTO `kerjasama_industri` (`id`, `urutan`, `nama`, `logo`, `created_at`, `updated_at`) VALUES
(1, 1, 'BSI (Bank Syariah Indonesia)', 'kerjasama_industri/xXOPx2m7j84DEiCMIjdVDZNyGwISsdvruMgwtzrk.jpg', '2026-10-18 17:05:44', '2026-10-18 17:05:44'),
(2, 2, 'Bank BJB Syariah', 'kerjasama_industri/z5q8C04iNWfW2nYMl7oT3sLtvaw7HJBirjuvGHeu.png', '2026-10-18 17:05:44', '2026-10-18 17:05:44'),
(3, 3, 'BONET IT Solution Partner', 'kerjasama_industri/GJnu438egQZ4lqVM8lI9G82DrKa9zuwVdIAfINvM.jpg', '2026-10-18 17:05:44', '2026-10-18 17:05:44'),
(4, 4, 'MSV Studio', 'kerjasama_industri/Hm44PwIcniyjVDlC1nhVmbt84B8QyLv5Gapi3lOg.jpg', '2026-10-18 17:05:44', '2026-10-18 17:05:44'),
(5, 5, 'Cakrawala Digital Indonesia', 'kerjasama_industri/aUsTHlondAJSBK32kXx4YTtWPRGYNEy3oXa3EMc4.png', '2026-10-18 17:05:44', '2026-10-18 17:05:44'),
(6, 6, 'CITRAWEB Solusi Teknologi', 'kerjasama_industri/3MbrScwnUyyXeRGNsCWrkLpyXjRjDXEKyqCMmojg.jpg', '2026-10-18 17:05:44', '2026-10-18 17:05:44'),
(7, 7, 'Bank Mandiri', 'kerjasama_industri/W2hgj8ChgdLSkVLwpkqebKCcLiNk7dtidTOuuBsV.png', '2026-10-18 17:05:44', '2026-10-18 17:05:44'),
(8, 8, 'Laku', 'kerjasama_industri/0yHqimd5qbOUnfApnirb8YLOBKzU0cJTJKluoXkR.png', '2026-10-18 17:05:44', '2026-10-18 17:05:44'),
(9, 9, 'IPB Press', 'kerjasama_industri/vl1HnMQSFkjfZmcFgPL6LiRN8TqbULRFYN7HlJsG.png', '2026-10-18 17:05:44', '2026-10-18 17:05:44'),
(10, 10, 'Bharata Tour Organizer', 'kerjasama_industri/3CYUKd34K856Uu04G999fQvFICxZGdhBdUD0jBo8.jpg', '2026-10-18 17:05:44', '2026-10-18 17:05:44'),
(11, 11, 'Jawa Pos', 'kerjasama_industri/upPbZVN9SOywWUO724Ad7DmUOQHxyZ6Q9An9Wx9E.png', '2026-10-18 17:05:44', '2026-10-18 17:05:44'),
(12, 12, 'Mega Motor', 'kerjasama_industri/oHXVhBbnfvBKGQSEK3ZJ5H9tOVzA7hIGhfZmZzFF.jpg', '2026-10-18 17:05:44', '2026-10-18 17:05:44'),
(13, 13, 'Almadita Global College', 'kerjasama_industri/iIixrHRo8kYgYX7QTcMZ6ZBcaK6Krh8d0jhgfeLc.png', '2026-10-18 17:05:44', '2026-10-18 17:05:44'),
(14, 14, 'OSM (PT. Ovall Solusindo Mandiri)', 'kerjasama_industri/fbYnunjH7GH8GPVofynOJ9jNqFBc7gH5jiH6N0DZ.png', '2026-10-18 17:05:44', '2026-10-18 17:05:44'),
(15, 15, 'Cabs', 'kerjasama_industri/N5GBjU1xKOg2dKWWfHzEucAVM0QjcoG7VUI4dYSX.png', '2026-10-18 17:05:44', '2026-10-18 17:05:44'),
(16, 16, 'by.U', 'kerjasama_industri/PqtaS39JxZL8juXkym4B5OjWWAxagDIJZHdIRma5.png', '2026-10-18 17:05:44', '2026-10-18 17:05:44'),
(17, 17, 'MUM', 'kerjasama_industri/Mk6bejeVidlCQdX5Wi5RQYRrYHoKy5aD5r7eQsVK.jpg', '2026-10-18 17:05:44', '2026-10-18 17:05:44'),
(18, 18, 'Tribunnews.com', 'kerjasama_industri/P161aY5K0RwNzmN5y062LkF3s0KbFGFX7nbzUmjI.webp', '2026-10-18 17:05:44', '2026-10-18 17:05:44'),
(20, 19, 'AdiTV', 'kerjasama_industri/loxKBnTULjgemSZyaGTv6oyZ48npXIBsEg3dhkHg.png', '2026-10-18 17:05:44', '2026-10-18 17:05:44'),
(21, 20, 'Anteraja', 'kerjasama_industri/7ssq2DFMyWtkZtCIXDwywzKv8h4qctzYyljFuNDp.jpg', '2026-10-18 17:05:44', '2026-10-18 17:05:44'),
(22, 21, 'Taman Safari Bogor', 'kerjasama_industri/CZ6Chl21N5oxhRbwFt0Vx2b0PK8r3ZsQQX9SCKjX.webp', '2026-10-18 17:05:44', '2026-10-18 17:05:44'),
(23, 22, 'Seki Sho (Sekisho Group)', 'kerjasama_industri/NVoozf4efMTJWkYaojZXmC0UuNWxyum4N4mQX9yL.png', '2026-10-18 17:05:44', '2026-10-18 17:05:44'),
(24, 23, 'Sakura Edukasi', 'kerjasama_industri/3hF3MQcaegFHKxTDNfA9nI7utD8grOQmjIzjcOnh.jpg', '2026-10-18 17:05:44', '2026-10-18 17:05:44'),
(25, 24, 'Azalee Group', 'kerjasama_industri/I3VbtNLEV1KnJb1fqkdGhgUWrePirLdvTxvLcwRJ.jpg', '2026-10-18 17:05:44', '2026-10-18 17:05:44'),
(26, 25, 'AiCI (Artificial Intelligence Center Indonesia)', 'kerjasama_industri/lnqKK5oEcsxA8qC6Ht6005wPYnwciKF3XdmcS0i8.jpg', '2026-10-18 17:05:44', '2026-10-18 17:05:44'),
(27, 26, 'Tenma Hospital Group', 'kerjasama_industri/RBzKU81bDmXMeylUznWjS8KaDx0Iw8bFKHhPSbtm.jpg', '2026-10-18 17:05:44', '2026-10-18 17:05:44');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kerjasama_universitas`
--

CREATE TABLE `kerjasama_universitas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `urutan` int(11) NOT NULL DEFAULT 0,
  `nama` varchar(200) NOT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kerjasama_universitas`
--

INSERT INTO `kerjasama_universitas` (`id`, `urutan`, `nama`, `logo`, `created_at`, `updated_at`) VALUES
(1, 1, 'Institut Pertanian Bogor (IPB)', 'kerjasama_universitas/W0EE4VTfYvCtXzz3aYTB1d1EfQC4T1A58uXWeaBp.png', '2026-10-18 17:05:44', '2026-10-18 17:05:44'),
(2, 2, 'Telkom University', 'kerjasama_universitas/yDxied9r6ByVSU2A38xzdJs5KozEyNX1AJ6AYDwa.png', '2026-10-18 17:05:44', '2026-10-18 17:05:44'),
(3, 3, 'Universitas Ibn Khaldun (UIKA) Bogor', 'kerjasama_universitas/EscVTuAHnUiTa6lILtjAWVllj2CUrSXoSnVkJ54T.png', '2026-10-18 17:05:44', '2026-10-18 17:05:44'),
(4, 4, 'Universitas Gunadarma', 'kerjasama_universitas/sZBOdO1RJhWjABlgVmSyaGPTjjq0ukk6hi2odKcO.jpg', '2026-10-18 17:05:44', '2026-10-18 17:05:44'),
(5, 5, 'Institut Bisnis dan Informatika Kesatuan (IBIK) Bogor', 'kerjasama_universitas/5tk5PI5RvGbl1kLH6lIUUCehNtbCdxwcOYgczoXY.jpg', '2026-10-18 17:05:44', '2026-10-18 17:05:44'),
(6, 7, 'Universitas Bunda Mulia (UBM)', 'kerjasama_universitas/tJGrQa4LZiEyXyeRzDairAsM0tnZNhAcMRmNJQRO.jpg', '2026-10-18 17:05:44', '2026-10-18 17:05:44'),
(7, 8, 'Japan Foundation', 'kerjasama_universitas/4Xzzg2AKKNK3Mz0Kg0pDVr9Q2MG6Kuy8aEH66un4.png', '2026-10-18 17:05:44', '2026-10-18 17:05:44'),
(8, 6, 'Universitas Amikom', 'kerjasama_universitas/UWhvhLU0LTaYchQ1EZ44IiZPDWIW1W0hK9kTst91.png', '2026-10-18 17:05:44', '2026-10-18 17:05:44');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kunjungan_industri`
--

CREATE TABLE `kunjungan_industri` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(150) NOT NULL,
  `kategori` varchar(80) DEFAULT NULL,
  `icon` varchar(50) NOT NULL DEFAULT 'map-pin',
  `kota` varchar(150) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `sorotan` text DEFAULT NULL,
  `urutan` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kunjungan_industri`
--

INSERT INTO `kunjungan_industri` (`id`, `nama`, `kategori`, `icon`, `kota`, `deskripsi`, `sorotan`, `urutan`, `created_at`, `updated_at`) VALUES
(1, 'Universitas Amikom', 'Perguruan Tinggi', 'school', 'Yogyakarta', 'Siswa berkunjung ke Universitas Amikom Yogyakarta, kampus yang dikenal kuat di bidang teknologi informasi dan ekonomi kreatif. Kegiatan diisi dengan sesi pemaparan di auditorium, pengenalan kampus, dan foto bersama di area Amikom Creative Economy Park, sehingga siswa mendapat gambaran tentang kelanjutan studi dan peluang karier di dunia digital.', 'Sesi pemaparan di auditorium\r\nMengenal Amikom Creative Economy Park\r\nWawasan kelanjutan studi & karier', 1, '2026-10-18 17:05:43', '2026-10-18 17:05:43'),
(2, 'Lava Tour Merapi', 'Wisata Edukasi', 'trees', 'Lereng Gunung Merapi, Yogyakarta', 'Lava Tour Merapi mengajak siswa menjelajahi lereng Gunung Merapi dan melihat langsung jejak erupsi yang membentuk lanskap sekitarnya. Selain menyenangkan, kegiatan ini menjadi pelajaran tentang alam, kebencanaan, dan ketangguhan masyarakat yang hidup di kaki gunung.', 'Menjelajah lereng Gunung Merapi\r\nBelajar jejak erupsi & alam\r\nKebersamaan antar siswa', 2, '2026-10-18 17:05:43', '2026-10-18 17:05:43'),
(3, 'Museum Mini Sisa Hartaku', 'Museum', 'building', 'Sleman, Yogyakarta', 'Museum Mini Sisa Hartaku menyimpan benda-benda peninggalan warga yang selamat dari erupsi Merapi. Di sini siswa belajar menghargai kehidupan, memahami dampak bencana, dan menumbuhkan rasa empati terhadap sesama.', 'Koleksi peninggalan erupsi Merapi\r\nPelajaran empati & kepedulian\r\nDokumentasi kebersamaan siswa', 3, '2026-10-18 17:05:43', '2026-10-18 17:05:43');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kunjungan_industri_foto`
--

CREATE TABLE `kunjungan_industri_foto` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kunjungan_industri_id` bigint(20) UNSIGNED NOT NULL,
  `path` varchar(255) NOT NULL,
  `keterangan` varchar(200) DEFAULT NULL,
  `urutan` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kunjungan_industri_foto`
--

INSERT INTO `kunjungan_industri_foto` (`id`, `kunjungan_industri_id`, `path`, `keterangan`, `urutan`, `created_at`, `updated_at`) VALUES
(1, 1, 'kunjungan-industri/foto/dQCPrQqdQUH1mGlrqn4yU8Zw9II2gemU7S0syLd2.png', 'Universitas Amikom', 1, '2026-10-18 17:05:43', '2026-10-18 17:05:44'),
(2, 1, 'kunjungan-industri/foto/a9YbnlKzzCYgZ64CJZ8U2sKAN7FXFYbszWNL6Zvk.png', 'Universitas Amikom', 2, '2026-10-18 17:05:43', '2026-10-18 17:05:44'),
(3, 1, 'kunjungan-industri/foto/fYbI7mFyxrcd630frB2ewmlKXWlb3SBs4RMbWkeb.png', 'Universitas Amikom', 3, '2026-10-18 17:05:43', '2026-10-18 17:05:44'),
(4, 1, 'kunjungan-industri/foto/d1DXH6LFOp2DJTqjeUOEz8YrXaFgDKdO7HNU0Brs.png', 'Universitas Amikom', 4, '2026-10-18 17:05:43', '2026-10-18 17:05:44'),
(5, 2, 'kunjungan-industri/foto/QFSUkD2xd4GTKMI5MjXEjmUhCPIVItzjqoiU4Ym5.png', 'Foto bersama di lereng Merapi', 1, '2026-10-18 17:05:43', '2026-10-18 17:05:44'),
(6, 3, 'kunjungan-industri/foto/qvaWC6inyrjyCOWWIW6dIzYskkWYraOhCNjTNsw8.png', 'Foto bersama di Museum Mini Sisa Hartaku', 1, '2026-10-18 17:05:43', '2026-10-18 17:05:44'),
(7, 3, 'kunjungan-industri/foto/JZhQ3rtAyygapwx3DZf9peHM8KvXSO8TWGXLmqKU.png', 'Siswa SMK INFOKOM di Museum Mini Sisa Hartaku', 2, '2026-10-18 17:05:43', '2026-10-18 17:05:44');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kunjungan_industri_info`
--

CREATE TABLE `kunjungan_industri_info` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `judul` varchar(150) NOT NULL,
  `periode` varchar(100) DEFAULT NULL,
  `kota_tujuan` varchar(100) DEFAULT NULL,
  `intro` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kunjungan_industri_info`
--

INSERT INTO `kunjungan_industri_info` (`id`, `judul`, `periode`, `kota_tujuan`, `intro`, `created_at`, `updated_at`) VALUES
(1, 'Kunjungan Industri ke Yogyakarta', '19-22 Februari 2025', 'Yogyakarta', 'Kunjungan industri adalah kegiatan belajar di luar kelas agar siswa melihat langsung dunia kampus, industri, dan lingkungan sekitar. Pada kegiatan ini, keluarga besar SMK INFOKOM Bogor berangkat ke Yogyakarta untuk menambah wawasan, memperluas pengalaman, dan mempererat kebersamaan.', '2026-10-18 17:05:43', '2026-10-18 17:05:43');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kunjungan_industri_video`
--

CREATE TABLE `kunjungan_industri_video` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kunjungan_industri_id` bigint(20) UNSIGNED DEFAULT NULL,
  `judul` varchar(150) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `jenis` varchar(20) NOT NULL DEFAULT 'embed',
  `provider` varchar(20) DEFAULT NULL,
  `rasio` varchar(20) NOT NULL DEFAULT 'landscape',
  `media_path` varchar(255) DEFAULT NULL,
  `embed_url` text DEFAULT NULL,
  `source_url` text DEFAULT NULL,
  `sampul` varchar(255) DEFAULT NULL,
  `urutan` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kunjungan_industri_video`
--

INSERT INTO `kunjungan_industri_video` (`id`, `kunjungan_industri_id`, `judul`, `deskripsi`, `jenis`, `provider`, `rasio`, `media_path`, `embed_url`, `source_url`, `sampul`, `urutan`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Keseruan Kunjungan Industri', NULL, 'embed', 'gdrive', 'landscape', NULL, 'https://drive.google.com/file/d/19q6lE_auUtgT7H-_RF0jP0KbD-b9vHDV/preview', 'https://drive.google.com/file/d/19q6lE_auUtgT7H-_RF0jP0KbD-b9vHDV/view', 'kunjungan-industri/sampul/CH8jK7FLdX1WG7X3qpi6v4SbWfs4t7LlzJVUo8Zy.png', 1, '2026-10-01 05:03:13', '2026-10-01 05:21:23');

-- --------------------------------------------------------

--
-- Struktur dari tabel `magang_jepang`
--

CREATE TABLE `magang_jepang` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(150) NOT NULL,
  `handle` varchar(100) DEFAULT NULL,
  `kota` varchar(100) DEFAULT NULL,
  `angkatan` varchar(50) DEFAULT NULL,
  `catatan` text DEFAULT NULL,
  `jenis_media` varchar(20) NOT NULL DEFAULT 'foto',
  `media_path` varchar(255) DEFAULT NULL,
  `media_ref` varchar(255) DEFAULT NULL,
  `sampul` varchar(255) DEFAULT NULL,
  `tema` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `urutan` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `magang_jepang`
--

INSERT INTO `magang_jepang` (`id`, `nama`, `handle`, `kota`, `angkatan`, `catatan`, `jenis_media`, `media_path`, `media_ref`, `sampul`, `tema`, `urutan`, `created_at`, `updated_at`) VALUES
(1, 'Surya Difraja', '_.prajaa', 'Tokyo', 'Angkatan XVII', 'Selamat sampai Negeri Sakura (Tokyo) & betah-betah disana. Terbang tinggi menembus batas untuk mengejar cita-cita dan masa depanmu yang manis.', 'instagram', NULL, 'reel/DZE77u4oNN_', 'magang-jepang/sampul/1xFvCE0vlj8ROAXJhrnAPZWsoOkS7lykBWY8ckvQ.jpg', 0, 1, '2026-10-18 17:05:43', '2026-10-18 17:05:44'),
(2, 'Irfan Rizqullah', 'fanrzqlh', 'Negeri Sakura', 'Angkatan XVII', 'Selamat sampai Negeri Sakura & betah-betah disana. Terima kasih telah membanggakan almamatermu, nak!', 'instagram', NULL, 'reel/DTfPQPRkkAq', 'magang-jepang/sampul/XmmkjTFpd0BxuZMremwvym14PXhjg5wb8IE4yUwU.jpg', 1, 2, '2026-10-18 17:05:43', '2026-10-18 17:05:44'),
(3, 'Nazib Sopian', 'naziburaongs', 'Negeri Sakura', 'Angkatan XVII', 'Selamat sampai Negeri Sakura & betah-betah disana. Terbang tinggi untuk mengejar cita-cita dan masa depanmu yang manis.', 'instagram', NULL, 'reel/DWjaMP3CEID', 'magang-jepang/sampul/2zu8Mv9anIxFRlc6DodxgWPHlEJXmU1yH1DELWha.jpg', 2, 3, '2026-10-18 17:05:43', '2026-10-18 17:05:44');

-- --------------------------------------------------------

--
-- Struktur dari tabel `magang_jepang_alasan`
--

CREATE TABLE `magang_jepang_alasan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `urutan` int(11) NOT NULL DEFAULT 0,
  `icon` varchar(50) NOT NULL,
  `judul` varchar(150) NOT NULL,
  `deskripsi` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `magang_jepang_alasan`
--

INSERT INTO `magang_jepang_alasan` (`id`, `urutan`, `icon`, `judul`, `deskripsi`, `created_at`, `updated_at`) VALUES
(1, 1, 'building', 'Pengalaman Kerja Nyata', 'Belajar langsung di lingkungan kerja profesional dan menerapkan keahlian yang dipelajari di sekolah.', '2026-10-18 17:05:43', '2026-10-18 17:05:43'),
(2, 2, 'book-open', 'Bahasa & Budaya Jepang', 'Menguasai bahasa baru dan memahami budaya kerja yang dikenal rapi, tepat waktu, dan menghargai proses.', '2026-10-18 17:05:43', '2026-10-18 17:05:43'),
(3, 3, 'shield-check', 'Disiplin & Etos Kerja', 'Membentuk karakter mandiri, bertanggung jawab, dan tangguh menghadapi tantangan.', '2026-10-18 17:05:43', '2026-10-18 17:05:43'),
(4, 4, 'trending-up', 'Modal Karier Masa Depan', 'Pengalaman internasional menjadi nilai tambah yang kuat saat melamar kerja atau melanjutkan studi.', '2026-10-18 17:05:43', '2026-10-18 17:05:43');

-- --------------------------------------------------------

--
-- Struktur dari tabel `magang_jepang_langkah`
--

CREATE TABLE `magang_jepang_langkah` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `urutan` int(11) NOT NULL DEFAULT 0,
  `nomor` varchar(5) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `deskripsi` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `magang_jepang_langkah`
--

INSERT INTO `magang_jepang_langkah` (`id`, `urutan`, `nomor`, `judul`, `deskripsi`, `created_at`, `updated_at`) VALUES
(1, 1, '01', 'Persiapan', 'Membekali diri dengan bahasa, mental, dan keterampilan teknis.', '2026-10-18 17:05:43', '2026-10-18 17:05:43'),
(2, 2, '02', 'Seleksi', 'Mengikuti proses seleksi dan melengkapi berkas keberangkatan.', '2026-10-18 17:05:43', '2026-10-18 17:05:43'),
(3, 3, '03', 'Keberangkatan', 'Dilepas sekolah dan keluarga menuju Jepang.', '2026-10-18 17:05:43', '2026-10-18 17:05:43'),
(4, 4, '04', 'Magang & Berkarya', 'Bekerja, belajar, dan membanggakan almamater di negeri orang.', '2026-10-18 17:05:43', '2026-10-18 17:05:43');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2024_01_01_000001_create_admins_table', 1),
(2, '2024_01_01_000002_create_berita_table', 1),
(3, '2024_01_01_000003_create_berita_foto_table', 1),
(4, '2024_01_01_000004_create_ppdb_table', 1),
(5, '2024_01_01_000005_create_pesan_kontak_table', 1),
(6, '2024_01_02_000001_create_konten_profil_akademik_tables', 1),
(7, '2024_01_02_000002_create_guru_staff_table', 1),
(8, '2024_01_03_000001_add_sejarah_to_profil_sekolah_table', 1),
(9, '2024_01_04_000001_add_kata_pengantar_to_profil_sekolah_table', 1),
(10, '2024_01_05_000001_add_jabatan_kategori_to_guru_staff_table', 1),
(11, '2024_01_06_000001_add_slug_lingkup_kerja_to_jurusan_table', 1),
(12, '2024_01_06_000002_add_kategori_to_fasilitas_table', 1),
(13, '2024_01_06_000003_create_kerjasama_universitas_table', 1),
(14, '2024_01_06_000004_create_kerjasama_industri_table', 1),
(15, '2024_01_07_000001_create_magang_jepang_table', 1),
(16, '2026_09_24_000000_create_prestasi_sekolah_table', 1),
(17, '2026_09_24_000001_create_bkk_table', 1),
(18, '2026_09_25_000001_create_prestasi_bidang_table', 1),
(19, '2026_09_25_000002_create_magang_jepang_alasan_table', 1),
(20, '2026_09_25_000003_create_magang_jepang_langkah_table', 1),
(21, '2026_09_26_000001_create_bkk_konten_table', 1),
(22, '2026_09_26_000002_create_bkk_layanan_table', 1),
(23, '2026_09_26_000003_create_bkk_follow_table', 1),
(24, '2026_09_26_000004_create_bkk_langkah_table', 1),
(25, '2026_09_26_000005_add_ig_foto_to_bkk_konten_table', 1),
(26, '2026_09_26_000006_add_detail_fields_to_ppdb_table', 1),
(27, '2026_09_26_000007_add_gambar_lab_to_jurusan_table', 1),
(28, '2026_09_29_000001_add_warna_to_jurusan_table', 1),
(29, '2026_09_30_000001_add_gambar_icon_to_fasilitas_table', 1),
(30, '2026_10_01_000001_add_foto_to_prestasi_sekolah_table', 1),
(31, '2026_10_02_000001_create_kunjungan_industri_tables', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `misi`
--

CREATE TABLE `misi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `urutan` int(11) NOT NULL DEFAULT 0,
  `isi` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `misi`
--

INSERT INTO `misi` (`id`, `urutan`, `isi`, `created_at`, `updated_at`) VALUES
(1, 1, 'Menyiapkan mental dan sikap peserta didik yang beriman serta bertaqwa kepada Tuhan Yang Maha Esa.', '2026-10-18 17:05:44', '2026-10-18 17:05:44'),
(2, 2, 'Menyelenggarakan kurikulum berstandar Nasional yang selaras dengan kebutuhan dunia kerja.', '2026-10-18 17:05:44', '2026-10-18 17:05:44'),
(3, 3, 'Meningkatkan kualitas tamatan agar siap bekerja pada bidang keahliannya.', '2026-10-18 17:05:44', '2026-10-18 17:05:44'),
(4, 4, 'Menyiapkan wirausahawan yang handal dan berdaya saing.', '2026-10-18 17:05:44', '2026-10-18 17:05:44'),
(5, 5, 'Menyiapkan tenaga terampil yang memiliki etos kerja tinggi.', '2026-10-18 17:05:44', '2026-10-18 17:05:44'),
(6, 6, 'Mengembangkan kemitraan dan pelayanan prima kepada seluruh warga sekolah dan masyarakat.', '2026-10-18 17:05:44', '2026-10-18 17:05:44');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengumuman`
--

CREATE TABLE `pengumuman` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `urutan` int(11) NOT NULL DEFAULT 0,
  `judul` varchar(100) NOT NULL,
  `teks` text NOT NULL,
  `tanggal` varchar(50) NOT NULL,
  `icon` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pengumuman`
--

INSERT INTO `pengumuman` (`id`, `urutan`, `judul`, `teks`, `tanggal`, `icon`, `created_at`, `updated_at`) VALUES
(1, 1, 'Pengumuman', 'Pendaftaran Peserta Didik Baru Tahun Ajaran 2025/2026 telah dibuka', '10 Januari 2025', 'megaphone', '2026-10-18 17:05:44', '2026-10-18 17:05:44'),
(2, 2, 'Agenda', 'Uji Kompetensi Keahlian kelas XII bersama asesor industri', '20 Maret 2025', 'calendar-days', '2026-10-18 17:05:44', '2026-10-18 17:05:44'),
(3, 3, 'Prestasi', 'Karya siswa Multimedia terpilih pada festival film pelajar Kota Bogor', '18 Februari 2025', 'trophy', '2026-10-18 17:05:44', '2026-10-18 17:05:44'),
(4, 4, 'Galeri', 'Dokumentasi produksi program televisi di studio sekolah', '05 April 2025', 'image', '2026-10-18 17:05:44', '2026-10-18 17:05:44');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pesan_kontak`
--

CREATE TABLE `pesan_kontak` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `subjek` varchar(150) NOT NULL,
  `pesan` text NOT NULL,
  `status` enum('belum_dibaca','dibaca') NOT NULL DEFAULT 'belum_dibaca',
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pesan_kontak`
--

INSERT INTO `pesan_kontak` (`id`, `nama`, `email`, `subjek`, `pesan`, `status`, `created_at`) VALUES
(1, 'Rizky', 'rizky@gmail.com', 'Bertanya', 'Apakah sudah buka pendaftaran', 'dibaca', '2026-09-26 06:29:54');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ppdb`
--

CREATE TABLE `ppdb` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nomor_pendaftaran` varchar(50) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `nisn` varchar(10) NOT NULL,
  `asal_sekolah` varchar(100) NOT NULL,
  `tempat_lahir` varchar(100) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `agama` varchar(30) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `telepon` varchar(15) NOT NULL,
  `pilihan1` varchar(10) NOT NULL,
  `pilihan2` varchar(10) NOT NULL,
  `alamat` text NOT NULL,
  `nama_orang_tua` varchar(100) DEFAULT NULL,
  `telepon_orang_tua` varchar(20) DEFAULT NULL,
  `pekerjaan_orang_tua` varchar(100) DEFAULT NULL,
  `dokumen` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `ppdb`
--

INSERT INTO `ppdb` (`id`, `nomor_pendaftaran`, `nama`, `nisn`, `asal_sekolah`, `tempat_lahir`, `tanggal_lahir`, `jenis_kelamin`, `agama`, `email`, `telepon`, `pilihan1`, `pilihan2`, `alamat`, `nama_orang_tua`, `telepon_orang_tua`, `pekerjaan_orang_tua`, `dokumen`, `created_at`) VALUES
(1, 'PPDB-TLYB3D31', 'Badut ZY', '0154818846', 'SMP Negri 6', 'Bogor', '2009-03-06', 'Laki-laki', 'Islam', 'rizkimputra364@gmail.com', '089516258211', 'RPL', 'TKJ', 'BLK TEMAN SAYA AJA', 'Mario RAmdani', '089516258242', 'LC', 'ppdb/dJyDrGkE4nBIvnHEVAGMZCl701XhpLZw6aiiqbE1.jpg', '2026-09-25 13:02:01'),
(5, 'PPDB-TN7SWW76', 'Badut ZY', '0154818846', 'SMP TAMAN SISWA', 'Bogor', '2019-04-19', 'Laki-laki', 'Islam', 'rizkimputra364@gmail.com', '089516258211', 'RPL', 'TKJ', 'Jalan Hati DIA', 'Ina', '089516258242', 'PNS', NULL, '2026-10-20 09:38:56');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ppdb_biaya`
--

CREATE TABLE `ppdb_biaya` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `urutan` int(11) NOT NULL DEFAULT 0,
  `jenis` varchar(150) NOT NULL,
  `gelombang1` bigint(20) UNSIGNED NOT NULL,
  `gelombang2` bigint(20) UNSIGNED NOT NULL,
  `gelombang3` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `ppdb_biaya`
--

INSERT INTO `ppdb_biaya` (`id`, `urutan`, `jenis`, `gelombang1`, `gelombang2`, `gelombang3`, `created_at`, `updated_at`) VALUES
(1, 1, 'Biaya Pendaftaran', 165000, 165000, 165000, '2026-10-18 17:05:44', '2026-10-18 17:05:44'),
(2, 2, 'Dana Sumbangan Pendidikan (DSP)', 4080000, 4280000, 4480000, '2026-10-18 17:05:44', '2026-10-18 17:05:44'),
(3, 3, 'SPP Bulan Juli', 275000, 275000, 275000, '2026-10-18 17:05:44', '2026-10-18 17:05:44'),
(4, 4, 'Biaya Praktikum', 400000, 400000, 400000, '2026-10-18 17:05:44', '2026-10-18 17:05:44'),
(5, 5, 'Biaya Uji Mutu', 380000, 380000, 380000, '2026-10-18 17:05:44', '2026-10-18 17:05:44'),
(6, 6, 'Biaya MOPDB', 100000, 100000, 100000, '2026-10-18 17:05:44', '2026-10-18 17:05:44');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ppdb_jadwal`
--

CREATE TABLE `ppdb_jadwal` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `urutan` int(11) NOT NULL DEFAULT 0,
  `periode` varchar(100) NOT NULL,
  `agenda` varchar(150) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `ppdb_jadwal`
--

INSERT INTO `ppdb_jadwal` (`id`, `urutan`, `periode`, `agenda`, `created_at`, `updated_at`) VALUES
(1, 1, 'Januari - Maret', 'Pendaftaran Gelombang I', '2026-10-18 17:05:44', '2026-10-18 17:05:44'),
(2, 2, 'Maret', 'Seleksi & Wawancara Gelombang I', '2026-10-18 17:05:44', '2026-10-18 17:05:44'),
(3, 3, 'April - Juni', 'Pendaftaran Gelombang II', '2026-10-18 17:05:44', '2026-10-18 17:05:44'),
(4, 4, 'Juni', 'Seleksi & Wawancara Gelombang II', '2026-10-18 17:05:44', '2026-10-18 17:05:44'),
(5, 5, 'Juni', 'Pengumuman Hasil Seleksi', '2026-10-18 17:05:44', '2026-10-18 17:05:44'),
(6, 6, 'Juni - Juli', 'Daftar Ulang & Persiapan MPLS', '2026-10-18 17:05:44', '2026-10-18 17:05:44');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ppdb_langkah`
--

CREATE TABLE `ppdb_langkah` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `urutan` int(11) NOT NULL DEFAULT 0,
  `nomor` varchar(5) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `deskripsi` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `ppdb_langkah`
--

INSERT INTO `ppdb_langkah` (`id`, `urutan`, `nomor`, `judul`, `deskripsi`, `created_at`, `updated_at`) VALUES
(1, 1, '01', 'Pendaftaran', 'Mengisi formulir pendaftaran secara daring atau langsung di sekolah.', '2026-10-18 17:05:44', '2026-10-18 17:05:44'),
(2, 2, '02', 'Verifikasi Berkas', 'Panitia memeriksa kelengkapan dan keabsahan dokumen calon siswa.', '2026-10-18 17:05:44', '2026-10-18 17:05:44'),
(3, 3, '03', 'Tes Seleksi', 'Tes dasar dan wawancara pemilihan kompetensi keahlian.', '2026-10-18 17:05:44', '2026-10-18 17:05:44'),
(4, 4, '04', 'Pengumuman', 'Hasil seleksi disampaikan melalui panitia PPDB sekolah.', '2026-10-18 17:05:44', '2026-10-18 17:05:44'),
(5, 5, '05', 'Daftar Ulang', 'Calon siswa yang diterima melakukan daftar ulang sesuai jadwal.', '2026-10-18 17:05:44', '2026-10-18 17:05:44');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ppdb_syarat`
--

CREATE TABLE `ppdb_syarat` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `urutan` int(11) NOT NULL DEFAULT 0,
  `isi` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `ppdb_syarat`
--

INSERT INTO `ppdb_syarat` (`id`, `urutan`, `isi`, `created_at`, `updated_at`) VALUES
(1, 1, 'Lulusan SMP/MTs atau sederajat', '2026-10-18 17:05:44', '2026-10-18 17:05:44'),
(2, 2, 'Fotokopi akta kelahiran dan kartu keluarga', '2026-10-18 17:05:44', '2026-10-18 17:05:44'),
(3, 3, 'Fotokopi rapor SMP/MTs', '2026-10-18 17:05:44', '2026-10-18 17:05:44'),
(4, 4, 'Surat keterangan lulus atau fotokopi ijazah', '2026-10-18 17:05:44', '2026-10-18 17:05:44'),
(5, 5, 'Pas foto berwarna terbaru ukuran 3x4', '2026-10-18 17:05:44', '2026-10-18 17:05:44'),
(6, 6, 'Fotokopi kartu program bantuan (KIP/PKH) bila ada', '2026-10-18 17:05:44', '2026-10-18 17:05:44');

-- --------------------------------------------------------

--
-- Struktur dari tabel `prestasi_bidang`
--

CREATE TABLE `prestasi_bidang` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `urutan` int(11) NOT NULL DEFAULT 0,
  `icon` varchar(50) NOT NULL,
  `judul` varchar(150) NOT NULL,
  `deskripsi` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `prestasi_bidang`
--

INSERT INTO `prestasi_bidang` (`id`, `urutan`, `icon`, `judul`, `deskripsi`, `created_at`, `updated_at`) VALUES
(1, 1, 'book-open', 'Akademik & Sains', 'Olimpiade sains, karya ilmiah, dan kompetisi riset tingkat kota hingga nasional.', '2026-10-18 17:05:43', '2026-10-18 17:05:43'),
(2, 2, 'activity', 'Olahraga', 'Futsal, handball, bulu tangkis, dan berbagai cabang olahraga kompetitif lainnya.', '2026-10-18 17:05:43', '2026-10-18 17:05:43'),
(3, 3, 'graduation-cap', 'Bahasa & Budaya', 'Kompetisi bahasa asing seperti Bahasa Jepang dan festival budaya antarsekolah.', '2026-10-18 17:05:43', '2026-10-18 17:05:43'),
(4, 4, 'code', 'Digital & E-Sport', 'Kompetisi e-sport dan ajang kreativitas teknologi digital siswa.', '2026-10-18 17:05:43', '2026-10-18 17:05:43');

-- --------------------------------------------------------

--
-- Struktur dari tabel `prestasi_sekolah`
--

CREATE TABLE `prestasi_sekolah` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kelompok` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `nama_siswa` varchar(191) NOT NULL,
  `nama_kejuaraan` varchar(500) NOT NULL,
  `juara` varchar(191) NOT NULL,
  `peringkat` varchar(20) NOT NULL DEFAULT 'lainnya',
  `tingkat` varchar(150) DEFAULT NULL,
  `kategori` varchar(100) DEFAULT NULL,
  `tahun` varchar(10) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `urutan` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `prestasi_sekolah`
--

INSERT INTO `prestasi_sekolah` (`id`, `kelompok`, `nama_siswa`, `nama_kejuaraan`, `juara`, `peringkat`, `tingkat`, `kategori`, `tahun`, `foto`, `urutan`, `created_at`, `updated_at`) VALUES
(1, 1, 'Tim Futsal', 'Piala Kemerdekaan FutsalBGR 2025', 'Juara 3 (Kota Bogor)', 'perunggu', 'Kota Bogor', 'Olahraga', '2025', NULL, 1, '2026-10-18 17:05:43', '2026-10-18 17:05:43'),
(2, 1, 'Tim Futsal', 'SB Fusalnation 2025', 'Juara 3 (Kota Bogor)', 'perunggu', 'Kota Bogor', 'Olahraga', '2025', NULL, 1, '2026-10-18 17:05:43', '2026-10-18 17:05:43'),
(3, 1, 'Tim Futsal', 'Binaniaga Championship 2025', 'Juara 3 (Kota Bogor)', 'perunggu', 'Kota Bogor', 'Olahraga', '2025', NULL, 1, '2026-10-18 17:05:43', '2026-10-18 17:05:43'),
(4, 2, 'Tim PASKIBRA', 'LKBB Braja Musti 2024', 'Juara Harapan Potensial 2 (Kota Bogor)', 'lainnya', 'Kota Bogor', 'Baris-Berbaris', '2024', NULL, 2, '2026-10-18 17:05:43', '2026-10-18 17:05:43'),
(5, 2, 'Tim PASKIBRA', 'LKBB BIMA Season 1 Jawa Barat', 'Juara Purwa 5 (Provinsi Jawa Barat)', 'lainnya', 'Provinsi Jawa Barat', 'Baris-Berbaris', '2024', NULL, 2, '2026-10-18 17:05:43', '2026-10-18 17:05:43'),
(6, 2, 'Tim PASKIBRA', 'LKBB BIMA SAKTI 2025', 'Juara 1 (Kota Bogor)', 'emas', 'Kota Bogor', 'Baris-Berbaris', '2025', NULL, 2, '2026-10-18 17:05:43', '2026-10-18 17:05:43'),
(7, 3, 'Bintang Rafiif Adzani', 'Kejurprov U-18 Subang Cabang Olahraga Bola Tangan (Hand Ball)', 'Juara 1 (Medali Emas) Divisi 1 Provinsi Jawa Barat', 'emas', 'Provinsi Jawa Barat', 'Olahraga', '2024', NULL, 3, '2026-10-18 17:05:43', '2026-10-18 17:05:43'),
(8, 4, 'Tim Handball', 'Kejuaraan Handball Najamudin Cup 7 Tahun 2025', 'Juara 3 (Kota Bogor)', 'perunggu', 'Kota Bogor', 'Olahraga', '2025', NULL, 4, '2026-10-18 17:05:43', '2026-10-18 17:05:43'),
(9, 5, 'Amanda Tagrida Viona', 'Young Scientists Competition Kategori Kimia', 'Juara 3 (Medali Perunggu) Nasional', 'perunggu', 'Nasional', 'Akademik & Sains', '2024', NULL, 5, '2026-10-18 17:05:43', '2026-10-18 17:05:43'),
(10, 5, 'Amanda Tagrida Viona', 'Karya Ilmiah Internet of Things (IoT) Universitas Ibn Khaldun', 'Juara 1 (Medali Emas) Kota Bogor', 'emas', 'Kota Bogor', 'Akademik & Sains', '2024', NULL, 5, '2026-10-18 17:05:43', '2026-10-18 17:05:43'),
(11, 5, 'Amanda Tagrida Viona', 'Lembaga Kompetisi Nasional (LKN) Science Olympiad Kategori Bahasa Indonesia', 'Juara 1 (Medali Emas) Nasional', 'emas', 'Nasional', 'Akademik & Sains', '2024', NULL, 5, '2026-10-18 17:05:43', '2026-10-18 17:05:43'),
(12, 5, 'Amanda Tagrida Viona', 'Lembaga Kompetisi Nasional (LKN) Science Olympiad Kategori Ekonomi', 'Juara 3 (Medali Perunggu) Nasional', 'perunggu', 'Nasional', 'Akademik & Sains', '2024', NULL, 5, '2026-10-18 17:05:43', '2026-10-18 17:05:43'),
(13, 5, 'Amanda Tagrida Viona', 'Olimpiade Indonesia Lembaga Kompetensi Indonesia (LKI) Kategori Biologi', 'Juara 2 (Medali Perak) Nasional', 'perak', 'Nasional', 'Akademik & Sains', '2024', NULL, 5, '2026-10-18 17:05:43', '2026-10-18 17:05:43'),
(14, 6, 'Amanda Tagrida Viona, Aqilla Tyza Febyana & Alisa Putri Mulya', 'Karya Ilmiah Internet of Things (IoT) Universitas Ibn Khaldun', 'Juara 1 (Medali Emas) Kota Bogor', 'emas', 'Kota Bogor', 'Akademik & Sains', '2024', NULL, 6, '2026-10-18 17:05:43', '2026-10-18 17:05:43'),
(15, 7, 'Tim JIC (Mohamad Arjuna Ali)', 'Lomba Kanji YUKANA Festival 2025', 'Juara 1 (Kota Bogor)', 'emas', 'Kota Bogor', 'Bahasa & Budaya', '2025', NULL, 7, '2026-10-18 17:05:43', '2026-10-18 17:05:43'),
(16, 8, 'Bungas Shesa Perindu', 'OLIMFEST (Olimpiade Festival Nusantara) 2025 Bidang Lomba: Olimpiade Biologi Tingkat SMA', 'Medali Emas (Nasional)', 'emas', 'Nasional', 'Akademik & Sains', '2025', NULL, 8, '2026-10-18 17:05:43', '2026-10-18 17:05:43'),
(17, 8, 'Bungas Shesa Perindu', 'ISO (Indonesian Science Olympiad) 2025 Bidang Lomba: Olimpiade Biologi', 'Medali Emas (Nasional)', 'emas', 'Nasional', 'Akademik & Sains', '2025', NULL, 8, '2026-10-18 17:05:43', '2026-10-18 17:05:43'),
(18, 8, 'Bungas Shesa Perindu', 'OSSAN (Olimpiade Sains Siswa Nasional) 2026 Bidang Lomba: Biologi', 'Medali Perak (Nasional)', 'perak', 'Nasional', 'Akademik & Sains', '2025', NULL, 8, '2026-10-18 17:05:43', '2026-10-18 17:05:43'),
(19, 8, 'Bungas Shesa Perindu', 'OSSAN (Olimpiade Sains Siswa Nasional) 2026 Bidang Lomba: Informatika', 'Medali Perak (Nasional)', 'perak', 'Nasional', 'Akademik & Sains', '2026', NULL, 8, '2026-10-18 17:05:43', '2026-10-18 17:05:43'),
(20, 9, 'Deanova Aprianza Gesyaputra', 'POTENSI (Pekan Kompetisi Talenta dan Edukasi) Bidang Lomba: Sosiologi Tingkat SMA', 'Medali Emas (Nasional)', 'emas', 'Nasional', 'Akademik & Sains', '2026', NULL, 9, '2026-10-18 17:05:43', '2026-10-18 17:05:43'),
(21, 9, 'Deanova Aprianza Gesyaputra', 'POTENSI (Pekan Kompetisi Talenta dan Edukasi) Bidang Lomba: Bahasa Indonesia Tingkat SMA', 'Medali Emas (Nasional)', 'emas', 'Nasional', 'Akademik & Sains', '2026', NULL, 9, '2026-10-18 17:05:43', '2026-10-18 17:05:43'),
(22, 9, 'Deanova Aprianza Gesyaputra', '4Th OSBANAS (Olimpiade Sains, Sosial, dan Bahasa Nasional) 2025 Bidang Lomba: Olimpiade Sosiologi Tingkat SMA', 'Medali Perunggu (Nasional)', 'perunggu', 'Nasional', 'Akademik & Sains', '2026', NULL, 9, '2026-10-18 17:05:43', '2026-10-18 17:05:43'),
(23, 10, 'Aulia Azzahra Hartiani', 'POSBANAS (Pekan Olimpiade Sains Bahasa dan Agama Nasional) Bidang Lomba: Bahasa Jepang Tingkat SMA/SMK', 'Medali Emas (Nasional)', 'emas', 'Nasional', 'Bahasa & Budaya', '2026', NULL, 10, '2026-10-18 17:05:43', '2026-10-18 17:05:43'),
(24, 11, 'Rafisha Wahyu Assila, Mario Ramdani, Gibran Bijaksa S., Julian Iqbal & Alif Saputra Ramadhan', 'e-Sport (Mobile Legend) Festival Dwi Warna (FDW) 2026 RENASCORA', 'Juara 1 (Tingkat Kota & Kabupaten)', 'emas', 'Tingkat Kota & Kabupaten', 'Digital & Teknologi', '2026', 'prestasi/CWHXKqYpO2KnaHWABZfpXwc6FRhpFNcp9gkSenjK.jpg', 11, '2026-10-18 17:05:43', '2026-10-18 17:05:43'),
(25, 12, 'Rahma Ashari', 'Olimpiade Olahraga Siswa Nasional (O2SN) Tingkat SMK Kota Bogor Cabang Olahraga Bulu Tangkis', 'Juara 2 (Tingkat Kota)', 'perak', 'Tingkat Kota', 'Olahraga', '2026', NULL, 12, '2026-10-18 17:05:43', '2026-10-18 17:05:43');

-- --------------------------------------------------------

--
-- Struktur dari tabel `profil_sekolah`
--

CREATE TABLE `profil_sekolah` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(200) NOT NULL,
  `nama_singkat` varchar(100) NOT NULL,
  `brand_atas` varchar(100) NOT NULL,
  `brand_bawah` varchar(100) NOT NULL,
  `tagline` text NOT NULL,
  `alamat` text NOT NULL,
  `telepon` varchar(50) NOT NULL,
  `whatsapp` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `jam_operasional` varchar(100) NOT NULL,
  `kepala_sekolah` varchar(150) NOT NULL,
  `visi` text NOT NULL,
  `sejarah` longtext DEFAULT NULL,
  `kata_pengantar` longtext DEFAULT NULL,
  `gambar_hero` varchar(255) DEFAULT NULL,
  `gambar_siswa` varchar(255) DEFAULT NULL,
  `gambar_kepala_sekolah` varchar(255) DEFAULT NULL,
  `total_biaya_gelombang1` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `total_biaya_gelombang2` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `total_biaya_gelombang3` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `profil_sekolah`
--

INSERT INTO `profil_sekolah` (`id`, `nama`, `nama_singkat`, `brand_atas`, `brand_bawah`, `tagline`, `alamat`, `telepon`, `whatsapp`, `email`, `jam_operasional`, `kepala_sekolah`, `visi`, `sejarah`, `kata_pengantar`, `gambar_hero`, `gambar_siswa`, `gambar_kepala_sekolah`, `total_biaya_gelombang1`, `total_biaya_gelombang2`, `total_biaya_gelombang3`, `created_at`, `updated_at`) VALUES
(1, 'SMK Informatika dan Telekomunikasi (INFOKOM) Kota Bogor', 'SMK INFOKOM', 'SMK INFOKOM', 'KOTA BOGOR', 'SMK yang peduli dan berbudaya lingkungan hidup dengan tamatan kompeten dan mampu bersaing di tingkat Nasional maupun Internasional.', 'Jl. Letjen Ibrahim Adjie No.178, RT.03/RW.08, Sindangbarang, Kec. Bogor Barat, Kota Bogor, Jawa Barat 16117', '(0251) 8348108', '0878-7307-1400 (Humas SMK INFOKOM)', 'smk.infokom@gmail.com', 'Senin - Jumat : 07.00 - 17.00 WIB', 'Ir. Hj. Liliek Rahmaningsih, M.MPd', 'SMK yang peduli dan berbudaya lingkungan hidup dengan tamatan kompeten dan mampu bersaing di tingkat Nasional maupun Internasional.', 'SMK Informatika dan Telekomunikasi (INFOKOM) Kota Bogor didirikan sebagai jawaban atas kebutuhan tenaga kerja terampil di bidang teknologi informasi dan telekomunikasi yang terus berkembang pesat di Kota Bogor dan sekitarnya.\r\n\r\nBerawal dari komitmen untuk menghadirkan pendidikan kejuruan yang relevan dengan dunia industri, sekolah ini terus bertumbuh dari tahun ke tahun, baik dari sisi jumlah peserta didik, kompetensi keahlian yang ditawarkan, maupun kerja sama dengan berbagai mitra industri.\r\n\r\nHingga saat ini, SMK INFOKOM Kota Bogor telah meluluskan ribuan siswa yang siap kerja, siap berwirausaha, maupun melanjutkan pendidikan ke jenjang yang lebih tinggi, dengan terus berkomitmen pada mutu pembelajaran dan pengembangan karakter peserta didik.', 'Assalaamu\'alaikum Warahmatullahi Wabarakatuh.\r\n\r\nSalam sejahtera untuk kita semua. Segala puji syukur kita panjatkan ke hadirat Allah SWT, karena atas limpahan Rahmat, dan Karunia-Nya sehingga Website resmi SMK INFOKOM Kota Bogor ini dapat terus kita kembangkan sebagai sarana Informasi yang akurat mengenai segala hal yang berkaitan dengan sekolah ini. Ucapan terima kasih juga kami haturkan kepada semua pihak yang telah memberikan dukungan dan masukan dalam kelancaran pengembangan Website ini. Selamat datang di Website resmi SMK INFOKOM Kota Bogor.\r\n\r\nDi era digital saat ini, website sekolah merupakan pintu gerbang informasi terdepan sebagai sarana untuk menyebarluaskan berbagai publikasi terkait kemajuan pendidikan dan pencapaian sekolah terkini. Sebagai media pembelajaran, terlebih di masa pandemi masih berlangsung, Website sekolah juga diarahkan dapat mendatangkan kemanfaatan sebagai sarana pembelajaran dengan memuat blog, e-learning, karya dan media pembelajaran yang dibuat oleh pendidik serta para siswa.', 'profil/ojPSwHtmUCn5HbtqoWFel8ghTmW2udNPpQUDjRUV.jpg', 'profil/kitT8e2MObx9Es1FcjOXMpHOjHQaFkOvSbbZuKka.webp', 'profil/0z41sqv3idw84BLkh7hjI9bWTTItqTX7jasIVGZ2.png', 5400000, 5600000, 5800000, '2026-10-18 17:05:44', '2026-10-18 17:45:54');

-- --------------------------------------------------------

--
-- Struktur dari tabel `stats`
--

CREATE TABLE `stats` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `urutan` int(11) NOT NULL DEFAULT 0,
  `value` int(10) UNSIGNED NOT NULL,
  `suffix` varchar(10) DEFAULT NULL,
  `label` varchar(100) NOT NULL,
  `icon` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `stats`
--

INSERT INTO `stats` (`id`, `urutan`, `value`, `suffix`, `label`, `icon`, `created_at`, `updated_at`) VALUES
(1, 1, 900, '+', 'Siswa Aktif', 'graduation-cap', '2026-10-18 17:05:44', '2026-10-18 17:05:44'),
(2, 2, 60, '+', 'Guru & Staff', 'users', '2026-10-18 17:05:44', '2026-10-18 17:05:44'),
(3, 3, 4, '', 'Kompetensi Keahlian', 'book-open', '2026-10-18 17:05:44', '2026-10-18 17:05:44'),
(4, 4, 100, '+', 'Mitra Industri', 'award', '2026-10-18 17:05:44', '2026-10-18 17:05:44');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tujuan`
--

CREATE TABLE `tujuan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `urutan` int(11) NOT NULL DEFAULT 0,
  `isi` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tujuan`
--

INSERT INTO `tujuan` (`id`, `urutan`, `isi`, `created_at`, `updated_at`) VALUES
(1, 1, 'Menghasilkan lulusan yang bertaqwa kepada Tuhan Yang Maha Esa dan siap memasuki dunia kerja.', '2026-10-18 17:05:44', '2026-10-18 17:05:44'),
(2, 2, 'Membentuk warga negara yang peduli dan berbudaya lingkungan hidup.', '2026-10-18 17:05:44', '2026-10-18 17:05:44'),
(3, 3, 'Membekali peserta didik agar memahami penerapan manajemen mutu.', '2026-10-18 17:05:44', '2026-10-18 17:05:44'),
(4, 4, 'Menyiapkan tenaga kerja tingkat menengah yang mampu bersaing secara global.', '2026-10-18 17:05:44', '2026-10-18 17:05:44'),
(5, 5, 'Menyiapkan peserta didik agar mandiri sesuai dengan program keahlian yang dipilih.', '2026-10-18 17:05:44', '2026-10-18 17:05:44'),
(6, 6, 'Menumbuhkan sikap profesional dalam bekerja maupun berwirausaha.', '2026-10-18 17:05:44', '2026-10-18 17:05:44'),
(7, 7, 'Mengembangkan ilmu pengetahuan dan teknologi sesuai perkembangan zaman.', '2026-10-18 17:05:44', '2026-10-18 17:05:44');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_username_unique` (`username`);

--
-- Indeks untuk tabel `berita`
--
ALTER TABLE `berita`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `berita_slug_unique` (`slug`);

--
-- Indeks untuk tabel `berita_foto`
--
ALTER TABLE `berita_foto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `berita_foto_berita_id_foreign` (`berita_id`);

--
-- Indeks untuk tabel `bkk_follow`
--
ALTER TABLE `bkk_follow`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `bkk_konten`
--
ALTER TABLE `bkk_konten`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `bkk_langkah`
--
ALTER TABLE `bkk_langkah`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `bkk_layanan`
--
ALTER TABLE `bkk_layanan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `bkk_media`
--
ALTER TABLE `bkk_media`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `ekstrakurikuler`
--
ALTER TABLE `ekstrakurikuler`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `fasilitas`
--
ALTER TABLE `fasilitas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `galeri`
--
ALTER TABLE `galeri`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `guru_staff`
--
ALTER TABLE `guru_staff`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `jurusan`
--
ALTER TABLE `jurusan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `jurusan_slug_unique` (`slug`);

--
-- Indeks untuk tabel `kalender_akademik`
--
ALTER TABLE `kalender_akademik`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kerjasama_industri`
--
ALTER TABLE `kerjasama_industri`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kerjasama_universitas`
--
ALTER TABLE `kerjasama_universitas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kunjungan_industri`
--
ALTER TABLE `kunjungan_industri`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kunjungan_industri_foto`
--
ALTER TABLE `kunjungan_industri_foto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kunjungan_industri_foto_kunjungan_industri_id_foreign` (`kunjungan_industri_id`);

--
-- Indeks untuk tabel `kunjungan_industri_info`
--
ALTER TABLE `kunjungan_industri_info`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kunjungan_industri_video`
--
ALTER TABLE `kunjungan_industri_video`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kunjungan_industri_video_kunjungan_industri_id_foreign` (`kunjungan_industri_id`);

--
-- Indeks untuk tabel `magang_jepang`
--
ALTER TABLE `magang_jepang`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `magang_jepang_alasan`
--
ALTER TABLE `magang_jepang_alasan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `magang_jepang_langkah`
--
ALTER TABLE `magang_jepang_langkah`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `misi`
--
ALTER TABLE `misi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pengumuman`
--
ALTER TABLE `pengumuman`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pesan_kontak`
--
ALTER TABLE `pesan_kontak`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `ppdb`
--
ALTER TABLE `ppdb`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `ppdb_biaya`
--
ALTER TABLE `ppdb_biaya`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `ppdb_jadwal`
--
ALTER TABLE `ppdb_jadwal`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `ppdb_langkah`
--
ALTER TABLE `ppdb_langkah`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `ppdb_syarat`
--
ALTER TABLE `ppdb_syarat`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `prestasi_bidang`
--
ALTER TABLE `prestasi_bidang`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `prestasi_sekolah`
--
ALTER TABLE `prestasi_sekolah`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `profil_sekolah`
--
ALTER TABLE `profil_sekolah`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `stats`
--
ALTER TABLE `stats`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tujuan`
--
ALTER TABLE `tujuan`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `berita`
--
ALTER TABLE `berita`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `berita_foto`
--
ALTER TABLE `berita_foto`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `bkk_follow`
--
ALTER TABLE `bkk_follow`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `bkk_konten`
--
ALTER TABLE `bkk_konten`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `bkk_langkah`
--
ALTER TABLE `bkk_langkah`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `bkk_layanan`
--
ALTER TABLE `bkk_layanan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `bkk_media`
--
ALTER TABLE `bkk_media`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `ekstrakurikuler`
--
ALTER TABLE `ekstrakurikuler`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `faq`
--
ALTER TABLE `faq`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `fasilitas`
--
ALTER TABLE `fasilitas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `galeri`
--
ALTER TABLE `galeri`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `guru_staff`
--
ALTER TABLE `guru_staff`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT untuk tabel `jurusan`
--
ALTER TABLE `jurusan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `kalender_akademik`
--
ALTER TABLE `kalender_akademik`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `kerjasama_industri`
--
ALTER TABLE `kerjasama_industri`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT untuk tabel `kerjasama_universitas`
--
ALTER TABLE `kerjasama_universitas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `kunjungan_industri`
--
ALTER TABLE `kunjungan_industri`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `kunjungan_industri_foto`
--
ALTER TABLE `kunjungan_industri_foto`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `kunjungan_industri_info`
--
ALTER TABLE `kunjungan_industri_info`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `kunjungan_industri_video`
--
ALTER TABLE `kunjungan_industri_video`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `magang_jepang`
--
ALTER TABLE `magang_jepang`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `magang_jepang_alasan`
--
ALTER TABLE `magang_jepang_alasan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `magang_jepang_langkah`
--
ALTER TABLE `magang_jepang_langkah`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT untuk tabel `misi`
--
ALTER TABLE `misi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `pengumuman`
--
ALTER TABLE `pengumuman`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `pesan_kontak`
--
ALTER TABLE `pesan_kontak`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `ppdb`
--
ALTER TABLE `ppdb`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `ppdb_biaya`
--
ALTER TABLE `ppdb_biaya`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `ppdb_jadwal`
--
ALTER TABLE `ppdb_jadwal`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `ppdb_langkah`
--
ALTER TABLE `ppdb_langkah`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `ppdb_syarat`
--
ALTER TABLE `ppdb_syarat`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `prestasi_bidang`
--
ALTER TABLE `prestasi_bidang`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `prestasi_sekolah`
--
ALTER TABLE `prestasi_sekolah`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT untuk tabel `profil_sekolah`
--
ALTER TABLE `profil_sekolah`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `stats`
--
ALTER TABLE `stats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tujuan`
--
ALTER TABLE `tujuan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `berita_foto`
--
ALTER TABLE `berita_foto`
  ADD CONSTRAINT `berita_foto_berita_id_foreign` FOREIGN KEY (`berita_id`) REFERENCES `berita` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `kunjungan_industri_foto`
--
ALTER TABLE `kunjungan_industri_foto`
  ADD CONSTRAINT `kunjungan_industri_foto_kunjungan_industri_id_foreign` FOREIGN KEY (`kunjungan_industri_id`) REFERENCES `kunjungan_industri` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `kunjungan_industri_video`
--
ALTER TABLE `kunjungan_industri_video`
  ADD CONSTRAINT `kunjungan_industri_video_kunjungan_industri_id_foreign` FOREIGN KEY (`kunjungan_industri_id`) REFERENCES `kunjungan_industri` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
