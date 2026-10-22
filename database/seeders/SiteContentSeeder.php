<?php

namespace Database\Seeders;

use App\Models\Ekstrakurikuler;
use App\Models\Faq;
use App\Models\Fasilitas;
use App\Models\GaleriItem;
use App\Models\Jurusan;
use App\Models\KalenderAkademik;
use App\Models\KerjasamaIndustri;
use App\Models\KerjasamaUniversitas;
use App\Models\Misi;
use App\Models\Pengumuman;
use App\Models\PpdbBiaya;
use App\Models\PpdbJadwal;
use App\Models\PpdbLangkah;
use App\Models\PpdbSyarat;
use App\Models\ProfilSekolah;
use App\Models\Stat;
use App\Models\Tujuan;
use Illuminate\Database\Seeder;

/**
 * Memindahkan seluruh konten statis halaman Profil & Akademik (yang
 * sebelumnya ada di config/site.php) ke database. Data disamakan persis
 * dengan dump `sekolah_db.sql`, termasuk kolom `gambar` pada Jurusan serta
 * `logo` pada Kerjasama Universitas & Kerjasama Industri, yang semuanya
 * sudah menunjuk ke berkas hasil upload di storage/app/public/{jurusan,
 * kerjasama_universitas,kerjasama_industri}.
 *
 * Catatan: `gambar_hero`, `gambar_siswa`, dan `gambar_kepala_sekolah` pada
 * Profil Sekolah sekarang juga menunjuk ke berkas hasil upload admin di
 * storage/app/public/profil (bukan lagi ke public/images/*.jpg bawaan
 * aplikasi), sesuai kondisi terbaru di dump. Pastikan berkas-berkas
 * tersebut, dan seluruh logo Kerjasama Universitas/Industri di atas,
 * sudah ada di storage/app/public sebelum menjalankan seeder ini (mis.
 * dengan menyalin folder storage/app/public dari server/dump sumbernya),
 * supaya gambar & logo langsung tampil begitu data ini di-seed.
 */
class SiteContentSeeder extends Seeder
{
    public function run(): void
    {
        ProfilSekolah::firstOrCreate([], [
            'nama' => 'SMK Informatika dan Telekomunikasi (INFOKOM) Kota Bogor',
            'nama_singkat' => 'SMK INFOKOM',
            'brand_atas' => 'SMK INFOKOM',
            'brand_bawah' => 'KOTA BOGOR',
            'tagline' => 'SMK yang peduli dan berbudaya lingkungan hidup dengan tamatan kompeten dan mampu bersaing di tingkat Nasional maupun Internasional.',
            'alamat' => 'Jl. Letjen Ibrahim Adjie No.178, RT.03/RW.08, Sindangbarang, Kec. Bogor Barat, Kota Bogor, Jawa Barat 16117',
            'telepon' => '(0251) 8348108',
            'whatsapp' => '0878-7307-1400 (Humas SMK INFOKOM)',
            'email' => 'smk.infokom@gmail.com',
            'jam_operasional' => 'Senin - Jumat : 07.00 - 17.00 WIB',
            'kepala_sekolah' => 'Ir. Hj. Liliek Rahmaningsih, M.MPd',
            'visi' => 'SMK yang peduli dan berbudaya lingkungan hidup dengan tamatan kompeten dan mampu bersaing di tingkat Nasional maupun Internasional.',
            'sejarah' => "SMK Informatika dan Telekomunikasi (INFOKOM) Kota Bogor didirikan sebagai jawaban atas kebutuhan tenaga kerja terampil di bidang teknologi informasi dan telekomunikasi yang terus berkembang pesat di Kota Bogor dan sekitarnya.\r\n\r\nBerawal dari komitmen untuk menghadirkan pendidikan kejuruan yang relevan dengan dunia industri, sekolah ini terus bertumbuh dari tahun ke tahun, baik dari sisi jumlah peserta didik, kompetensi keahlian yang ditawarkan, maupun kerja sama dengan berbagai mitra industri.\r\n\r\nHingga saat ini, SMK INFOKOM Kota Bogor telah meluluskan ribuan siswa yang siap kerja, siap berwirausaha, maupun melanjutkan pendidikan ke jenjang yang lebih tinggi, dengan terus berkomitmen pada mutu pembelajaran dan pengembangan karakter peserta didik.",
            'kata_pengantar' => "Assalaamu'alaikum Warahmatullahi Wabarakatuh.\r\n\r\nSalam sejahtera untuk kita semua. Segala puji syukur kita panjatkan ke hadirat Allah SWT, karena atas limpahan Rahmat, dan Karunia-Nya sehingga Website resmi SMK INFOKOM Kota Bogor ini dapat terus kita kembangkan sebagai sarana Informasi yang akurat mengenai segala hal yang berkaitan dengan sekolah ini. Ucapan terima kasih juga kami haturkan kepada semua pihak yang telah memberikan dukungan dan masukan dalam kelancaran pengembangan Website ini. Selamat datang di Website resmi SMK INFOKOM Kota Bogor.\r\n\r\nDi era digital saat ini, website sekolah merupakan pintu gerbang informasi terdepan sebagai sarana untuk menyebarluaskan berbagai publikasi terkait kemajuan pendidikan dan pencapaian sekolah terkini. Sebagai media pembelajaran, terlebih di masa pandemi masih berlangsung, Website sekolah juga diarahkan dapat mendatangkan kemanfaatan sebagai sarana pembelajaran dengan memuat blog, e-learning, karya dan media pembelajaran yang dibuat oleh pendidik serta para siswa.",
            'gambar_hero' => 'profil/ojPSwHtmUCn5HbtqoWFel8ghTmW2udNPpQUDjRUV.jpg',
            'gambar_siswa' => 'profil/kitT8e2MObx9Es1FcjOXMpHOjHQaFkOvSbbZuKka.webp',
            'gambar_kepala_sekolah' => 'profil/0z41sqv3idw84BLkh7hjI9bWTTItqTX7jasIVGZ2.png',
            'total_biaya_gelombang1' => 5400000,
            'total_biaya_gelombang2' => 5600000,
            'total_biaya_gelombang3' => 5800000,
        ]);

        $this->seedIfEmpty(Stat::class, [
            ['urutan' => 1, 'value' => 900, 'suffix' => '+', 'label' => 'Siswa Aktif', 'icon' => 'graduation-cap'],
            ['urutan' => 2, 'value' => 60, 'suffix' => '+', 'label' => 'Guru & Staff', 'icon' => 'users'],
            ['urutan' => 3, 'value' => 4, 'suffix' => '', 'label' => 'Kompetensi Keahlian', 'icon' => 'book-open'],
            ['urutan' => 4, 'value' => 100, 'suffix' => '+', 'label' => 'Mitra Industri', 'icon' => 'award'],
        ]);

        $this->seedIfEmpty(Misi::class, collect([
            'Menyiapkan mental dan sikap peserta didik yang beriman serta bertaqwa kepada Tuhan Yang Maha Esa.',
            'Menyelenggarakan kurikulum berstandar Nasional yang selaras dengan kebutuhan dunia kerja.',
            'Meningkatkan kualitas tamatan agar siap bekerja pada bidang keahliannya.',
            'Menyiapkan wirausahawan yang handal dan berdaya saing.',
            'Menyiapkan tenaga terampil yang memiliki etos kerja tinggi.',
            'Mengembangkan kemitraan dan pelayanan prima kepada seluruh warga sekolah dan masyarakat.',
        ])->map(fn ($isi, $i) => ['urutan' => $i + 1, 'isi' => $isi])->all());

        $this->seedIfEmpty(Tujuan::class, collect([
            'Menghasilkan lulusan yang bertaqwa kepada Tuhan Yang Maha Esa dan siap memasuki dunia kerja.',
            'Membentuk warga negara yang peduli dan berbudaya lingkungan hidup.',
            'Membekali peserta didik agar memahami penerapan manajemen mutu.',
            'Menyiapkan tenaga kerja tingkat menengah yang mampu bersaing secara global.',
            'Menyiapkan peserta didik agar mandiri sesuai dengan program keahlian yang dipilih.',
            'Menumbuhkan sikap profesional dalam bekerja maupun berwirausaha.',
            'Mengembangkan ilmu pengetahuan dan teknologi sesuai perkembangan zaman.',
        ])->map(fn ($isi, $i) => ['urutan' => $i + 1, 'isi' => $isi])->all());

        $this->seedIfEmpty(Pengumuman::class, [
            ['urutan' => 1, 'judul' => 'Pengumuman', 'teks' => 'Pendaftaran Peserta Didik Baru Tahun Ajaran 2025/2026 telah dibuka', 'tanggal' => '10 Januari 2025', 'icon' => 'megaphone'],
            ['urutan' => 2, 'judul' => 'Agenda', 'teks' => 'Uji Kompetensi Keahlian kelas XII bersama asesor industri', 'tanggal' => '20 Maret 2025', 'icon' => 'calendar-days'],
            ['urutan' => 3, 'judul' => 'Prestasi', 'teks' => 'Karya siswa Multimedia terpilih pada festival film pelajar Kota Bogor', 'tanggal' => '18 Februari 2025', 'icon' => 'trophy'],
            ['urutan' => 4, 'judul' => 'Galeri', 'teks' => 'Dokumentasi produksi program televisi di studio sekolah', 'tanggal' => '05 April 2025', 'icon' => 'image'],
        ]);

        $this->seedIfEmpty(Jurusan::class, [
            [
                'urutan' => 1,
                'kode' => 'TKJ',
                'nama' => 'Teknik Komputer dan Jaringan',
                'deskripsi' => 'Membekali siswa menjadi teknisi dan administrator jaringan yang siap kerja di dunia teknologi informasi. Peserta didik dilatih merakit dan memperbaiki perangkat komputer, membangun serta mengelola jaringan LAN/WAN, hingga menerapkan sistem keamanan jaringan secara terpusat, sehingga siap terjun langsung ke industri maupun melanjutkan pendidikan di bidang TI.',
                'gambar' => 'jurusan/A4y8TtkbQMzCVieYXzoayODVzhaxKLhsXIsh7f6u.png',
                'gambar_lab' => 'jurusan/VERMnTVvkYyxRfc4hfFclLu3yeFtSXXR0PY6Kldn.jpg',
                'warna' => '#BD0AA2',
                'poin' => ['IT Support Jaringan', 'Perakitan dan Perbaikan Komputer', 'Administrator Jaringan LAN/WAN', 'Keamanan Jaringan Terpusat'],
                'lingkup_kerja' => ['Perusahaan Jaringan', 'Wireless Networking', 'Network Administrator', 'Server Administrator', 'Computer Integrator', 'Connection Integrator'],
            ],
            [
                'urutan' => 2,
                'kode' => 'RPL',
                'nama' => 'Rekayasa Perangkat Lunak',
                'deskripsi' => 'Mempelajari perancangan dan pembangunan perangkat lunak mulai dari aplikasi desktop hingga sistem enterprise berskala besar. Siswa dibimbing menguasai analisa dan perancangan sistem, pemrograman lintas platform (desktop, mobile, dan web), serta praktik langsung membangun aplikasi sesuai kebutuhan dunia industri.',
                'gambar' => 'jurusan/WXya0DgPNdWHU4Y6CPlnWvmTBqVXs3Dpze4X775F.png',
                'gambar_lab' => 'jurusan/xFjcVUJcIkvQUlwoZmy1fBUWPbm3ucfV2ZAyuqKu.jpg',
                'warna' => '#E0201B',
                'poin' => ['Pemrograman Desktop', 'Analisa dan Perancangan Sistem', 'Arsitektur Desktop, Mobile dan Web', 'Pengembangan Aplikasi Enterprise'],
                'lingkup_kerja' => ['Desktop Programmer', 'Mobile Programmer', 'Web Programmer', 'Analis Teknologi (Mobile, Desktop, Web, Enterprise)'],
            ],
            [
                'urutan' => 3,
                'kode' => 'DKV',
                'nama' => 'Desain Komunikasi Visual',
                'deskripsi' => 'Mengasah kemampuan produksi karya digital, mulai dari desain grafis, animasi, hingga audio visual interaktif. Siswa berlatih mengolah citra dan animasi digital, merancang tampilan web yang menarik, serta merekam dan menyunting audio video menjadi karya multimedia yang siap pakai untuk industri kreatif.',
                'gambar' => 'jurusan/bg6b6d7QapjRo5l3PqerRsgoNBiK4BjrivHxXtaW.png',
                'gambar_lab' => 'jurusan/83TmV5lpKSorJAtOWJEDQKBoAgjIXTY1g1ZYXaV1.jpg',
                'warna' => '#FF6A13',
                'poin' => ['Pengolahan Citra dan Animasi Digital', 'Desain Web Interaktif', 'Rekam dan Sunting Audio Video', 'Aplikasi Multimedia Interaktif'],
                'lingkup_kerja' => ['Illustrator', 'Animator', 'Desainer Grafis', 'Desainer Permainan (Game Designer)', 'Content Creator'],
            ],
            [
                'urutan' => 4,
                'kode' => 'PSPT',
                'nama' => 'Produksi dan Siaran Program Televisi',
                'deskripsi' => 'Menyiapkan kru penyiaran profesional yang menguasai seluruh tahapan produksi program televisi, mulai dari perencanaan hingga tayang. Siswa dilatih langsung berperan sebagai sutradara, kameramen, dan editor, merangkap penata artistik dan penata suara, sekaligus menulis naskah dan skenario program siaran secara utuh.',
                'gambar' => 'jurusan/TgOWE8MyXeok971fmcsUUvxbANUgkQ37AYBbyhKe.png',
                'gambar_lab' => 'jurusan/DkthlOqDXseccoguxTTOnEDBJzo5a5OtHIuc9o4B.jpg',
                'warna' => '#F2C200',
                'poin' => ['Dasar Pertelevisian', 'Penyutradaraan, Editor dan Kameramen', 'Penata Artistik dan Penata Suara', 'Penulis Naskah dan Skenario'],
                'lingkup_kerja' => ['Biro Advertising', 'Rumah Produksi (Production House)', 'Content Creator Social Media', 'Lembaga Penyiaran TV/Radio'],
            ],
        ]);

        // Fasilitas: 8 fasilitas sesuai foto sekolah. Data yang sama juga disisipkan
        // oleh migration 2026_09_30_000001_add_gambar_icon_to_fasilitas_table.php,
        // jadi pada instalasi baru bagian ini otomatis dilewati (tabel sudah terisi).
        // Foto (`gambar`, `gambar_2`) sengaja kosong: diunggah admin lewat
        // Admin > Fasilitas Sekolah.
        $this->seedIfEmpty(Fasilitas::class, [
            ['urutan' => 1, 'kategori' => 'Ruang Pembelajaran', 'judul' => 'Ruang Kelas', 'icon' => 'presentation', 'deskripsi' => 'Ruang belajar yang nyaman dan tertata untuk mendukung kegiatan belajar mengajar setiap hari.'],
            ['urutan' => 2, 'kategori' => 'Ruang Pembelajaran', 'judul' => 'Perpustakaan', 'icon' => 'book-open', 'deskripsi' => 'Tempat membaca dan belajar mandiri dengan koleksi buku pelajaran, kejuruan, dan bacaan umum untuk menumbuhkan budaya literasi.'],
            ['urutan' => 3, 'kategori' => 'Pimpinan & Administrasi', 'judul' => 'Ruang Kepala Sekolah', 'icon' => 'building', 'deskripsi' => 'Ruang kerja pimpinan sekolah sekaligus tempat menerima tamu, orang tua, dan mitra sekolah.'],
            ['urutan' => 4, 'kategori' => 'Pimpinan & Administrasi', 'judul' => 'Ruang Guru', 'icon' => 'users', 'deskripsi' => 'Ruang kerja para guru untuk menyiapkan pembelajaran, berdiskusi, dan melayani konsultasi siswa.'],
            ['urutan' => 5, 'kategori' => 'Pimpinan & Administrasi', 'judul' => 'Tata Usaha', 'icon' => 'folder', 'deskripsi' => 'Pusat layanan administrasi sekolah, mulai dari pengelolaan data siswa hingga surat-menyurat.'],
            ['urutan' => 6, 'kategori' => 'Penunjang Sekolah', 'judul' => 'Musholla', 'icon' => 'mosque', 'deskripsi' => 'Sarana ibadah yang bersih dan nyaman bagi seluruh warga sekolah.'],
            ['urutan' => 7, 'kategori' => 'Penunjang Sekolah', 'judul' => 'Kantin', 'icon' => 'utensils', 'deskripsi' => 'Tempat istirahat dan makan bagi siswa serta guru dengan berbagai pilihan makanan dan minuman.'],
            ['urutan' => 8, 'kategori' => 'Penunjang Sekolah', 'judul' => 'Taman', 'icon' => 'trees', 'deskripsi' => 'Area hijau yang asri sebagai ruang berkumpul, bersantai, dan belajar santai di luar kelas.'],
        ]);

        $this->seedIfEmpty(PpdbLangkah::class, [
            ['urutan' => 1, 'nomor' => '01', 'judul' => 'Pendaftaran', 'deskripsi' => 'Mengisi formulir pendaftaran secara daring atau langsung di sekolah.'],
            ['urutan' => 2, 'nomor' => '02', 'judul' => 'Verifikasi Berkas', 'deskripsi' => 'Panitia memeriksa kelengkapan dan keabsahan dokumen calon siswa.'],
            ['urutan' => 3, 'nomor' => '03', 'judul' => 'Tes Seleksi', 'deskripsi' => 'Tes dasar dan wawancara pemilihan kompetensi keahlian.'],
            ['urutan' => 4, 'nomor' => '04', 'judul' => 'Pengumuman', 'deskripsi' => 'Hasil seleksi disampaikan melalui panitia PPDB sekolah.'],
            ['urutan' => 5, 'nomor' => '05', 'judul' => 'Daftar Ulang', 'deskripsi' => 'Calon siswa yang diterima melakukan daftar ulang sesuai jadwal.'],
        ]);

        $this->seedIfEmpty(PpdbJadwal::class, [
            ['urutan' => 1, 'periode' => 'Januari - Maret', 'agenda' => 'Pendaftaran Gelombang I'],
            ['urutan' => 2, 'periode' => 'Maret', 'agenda' => 'Seleksi & Wawancara Gelombang I'],
            ['urutan' => 3, 'periode' => 'April - Juni', 'agenda' => 'Pendaftaran Gelombang II'],
            ['urutan' => 4, 'periode' => 'Juni', 'agenda' => 'Seleksi & Wawancara Gelombang II'],
            ['urutan' => 5, 'periode' => 'Juni', 'agenda' => 'Pengumuman Hasil Seleksi'],
            ['urutan' => 6, 'periode' => 'Juni - Juli', 'agenda' => 'Daftar Ulang & Persiapan MPLS'],
        ]);

        $this->seedIfEmpty(PpdbSyarat::class, collect([
            'Lulusan SMP/MTs atau sederajat',
            'Fotokopi akta kelahiran dan kartu keluarga',
            'Fotokopi rapor SMP/MTs',
            'Surat keterangan lulus atau fotokopi ijazah',
            'Pas foto berwarna terbaru ukuran 3x4',
            'Fotokopi kartu program bantuan (KIP/PKH) bila ada',
        ])->map(fn ($isi, $i) => ['urutan' => $i + 1, 'isi' => $isi])->all());

        $this->seedIfEmpty(PpdbBiaya::class, [
            ['urutan' => 1, 'jenis' => 'Biaya Pendaftaran', 'gelombang1' => 165000, 'gelombang2' => 165000, 'gelombang3' => 165000],
            ['urutan' => 2, 'jenis' => 'Dana Sumbangan Pendidikan (DSP)', 'gelombang1' => 4080000, 'gelombang2' => 4280000, 'gelombang3' => 4480000],
            ['urutan' => 3, 'jenis' => 'SPP Bulan Juli', 'gelombang1' => 275000, 'gelombang2' => 275000, 'gelombang3' => 275000],
            ['urutan' => 4, 'jenis' => 'Biaya Praktikum', 'gelombang1' => 400000, 'gelombang2' => 400000, 'gelombang3' => 400000],
            ['urutan' => 5, 'jenis' => 'Biaya Uji Mutu', 'gelombang1' => 380000, 'gelombang2' => 380000, 'gelombang3' => 380000],
            ['urutan' => 6, 'jenis' => 'Biaya MOPDB', 'gelombang1' => 100000, 'gelombang2' => 100000, 'gelombang3' => 100000],
        ]);

        $this->seedIfEmpty(KalenderAkademik::class, [
            ['urutan' => 1, 'periode' => 'Juli', 'agenda' => 'Masa Pengenalan Lingkungan Sekolah (MPLS)'],
            ['urutan' => 2, 'periode' => 'September', 'agenda' => 'Penilaian Tengah Semester Ganjil'],
            ['urutan' => 3, 'periode' => 'Desember', 'agenda' => 'Penilaian Akhir Semester & Class Meeting'],
            ['urutan' => 4, 'periode' => 'Januari', 'agenda' => 'Praktik Kerja Lapangan Kelas XI'],
            ['urutan' => 5, 'periode' => 'Maret', 'agenda' => 'Uji Kompetensi Keahlian Kelas XII'],
            ['urutan' => 6, 'periode' => 'Juni', 'agenda' => 'Kenaikan Kelas & Pelepasan Siswa Kelas XII'],
        ]);

        // Ekstrakurikuler: disamakan dengan daftar pada brosur PPDB SMK INFOKOM.
        $this->seedIfEmpty(Ekstrakurikuler::class, [
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
        ]);

        $this->seedIfEmpty(Faq::class, [
            ['urutan' => 1, 'pertanyaan' => 'Kapan pendaftaran peserta didik baru dibuka?', 'jawaban' => 'Pendaftaran dibuka setiap awal tahun dan berlangsung sampai kuota masing-masing kompetensi keahlian terpenuhi. Informasi jadwal terbaru dapat ditanyakan ke panitia PPDB sekolah.'],
            ['urutan' => 2, 'pertanyaan' => 'Apa saja kompetensi keahlian yang tersedia?', 'jawaban' => 'Tersedia empat kompetensi keahlian: Teknik Komputer dan Jaringan, Rekayasa Perangkat Lunak, Multimedia, serta Produksi dan Siaran Program Televisi.'],
            ['urutan' => 3, 'pertanyaan' => 'Dokumen apa yang harus disiapkan saat mendaftar?', 'jawaban' => 'Fotokopi akta kelahiran, kartu keluarga, rapor SMP/MTs, surat keterangan lulus atau ijazah, dan pas foto terbaru.'],
            ['urutan' => 4, 'pertanyaan' => 'Bagaimana cara menghubungi panitia PPDB?', 'jawaban' => 'Silakan hubungi nomor telepon sekolah (0251) 8348108, WhatsApp Humas 0878-7307-1400, atau datang langsung ke sekolah pada hari dan jam kerja.'],
        ]);

        // Galeri: disamakan persis dengan dump `sekolah_db.sql` (4 foto hasil
        // unggahan admin; foto bawaan `images/infokom-*.jpg` sudah diganti dan
        // dua baris terakhir bawaan sudah dihapus). Berkas gambar mengacu ke
        // storage/app/public/galeri.
        $this->seedIfEmpty(GaleriItem::class, [
            ['urutan' => 1, 'sumber' => 'galeri/QOALoUVblyEbtG8iHH8XNtyJOPpEY4JOIQXKQjq3.jpg', 'judul' => 'Praktik Konfigurasi Jaringan', 'kategori' => 'Akademik'],
            ['urutan' => 2, 'sumber' => 'galeri/3na8brGf535hhcUUoquhK3zmKD7TdK3aGnusO4E8.jpg', 'judul' => 'Raung Perpustakaan', 'kategori' => 'Akademik'],
            ['urutan' => 3, 'sumber' => 'galeri/dQViBY8qgSkzQF8wRMrzhZtCC5mAPNNJ6uutD8Gr.png', 'judul' => 'Kunjungan Industri', 'kategori' => 'Akademik'],
            ['urutan' => 4, 'sumber' => 'galeri/FvxM4rgFy7rGz6wIB0gwdDjqCImcbx5uZFAYvllR.jpg', 'judul' => 'Juara 1 Mobile Legen', 'kategori' => 'Kegiatan'],
        ]);

        // Kerjasama Universitas: logo & urutan disamakan persis dengan
        // dump `sekolah_db.sql` (setelah admin mengunggah logo dan
        // menambah "Universitas Amikom" lewat panel admin, urutannya
        // tidak lagi sekadar 1..N berurutan seperti data awal — mengacu
        // ke berkas yang sudah ada di storage/app/public/kerjasama_universitas).
        $this->seedIfEmpty(KerjasamaUniversitas::class, [
            ['urutan' => 1, 'nama' => 'Institut Pertanian Bogor (IPB)', 'logo' => 'kerjasama_universitas/W0EE4VTfYvCtXzz3aYTB1d1EfQC4T1A58uXWeaBp.png'],
            ['urutan' => 2, 'nama' => 'Telkom University', 'logo' => 'kerjasama_universitas/yDxied9r6ByVSU2A38xzdJs5KozEyNX1AJ6AYDwa.png'],
            ['urutan' => 3, 'nama' => 'Universitas Ibn Khaldun (UIKA) Bogor', 'logo' => 'kerjasama_universitas/EscVTuAHnUiTa6lILtjAWVllj2CUrSXoSnVkJ54T.png'],
            ['urutan' => 4, 'nama' => 'Universitas Gunadarma', 'logo' => 'kerjasama_universitas/sZBOdO1RJhWjABlgVmSyaGPTjjq0ukk6hi2odKcO.jpg'],
            ['urutan' => 5, 'nama' => 'Institut Bisnis dan Informatika Kesatuan (IBIK) Bogor', 'logo' => 'kerjasama_universitas/5tk5PI5RvGbl1kLH6lIUUCehNtbCdxwcOYgczoXY.jpg'],
            ['urutan' => 7, 'nama' => 'Universitas Bunda Mulia (UBM)', 'logo' => 'kerjasama_universitas/tJGrQa4LZiEyXyeRzDairAsM0tnZNhAcMRmNJQRO.jpg'],
            ['urutan' => 8, 'nama' => 'Japan Foundation', 'logo' => 'kerjasama_universitas/4Xzzg2AKKNK3Mz0Kg0pDVr9Q2MG6Kuy8aEH66un4.png'],
            ['urutan' => 6, 'nama' => 'Universitas Amikom', 'logo' => 'kerjasama_universitas/UWhvhLU0LTaYchQ1EZ44IiZPDWIW1W0hK9kTst91.png'],
        ]);

        // Kerjasama Industri: id, logo & urutan disamakan persis dengan dump
        // `sekolah_db.sql` (26 mitra yang masih aktif saat ini — id 19 dan
        // 28 sudah dihapus admin, jadi id berikutnya melompat — mengacu ke
        // berkas yang sudah ada di storage/app/public/kerjasama_industri).
        $this->seedIfEmpty(KerjasamaIndustri::class, [
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
        ]);
    }

    /**
     * Seed hanya jika tabel masih kosong, supaya seeder ini aman dijalankan berulang kali.
     */
    protected function seedIfEmpty(string $modelClass, array $rows): void
    {
        if ($modelClass::count() === 0) {
            // unguarded: supaya kolom `id` eksplisit (mis. pada Kerjasama
            // Industri yang id-nya tidak berurutan) ikut tersimpan.
            $modelClass::unguarded(function () use ($modelClass, $rows) {
                foreach ($rows as $row) {
                    $modelClass::create($row);
                }
            });
        }
    }
}