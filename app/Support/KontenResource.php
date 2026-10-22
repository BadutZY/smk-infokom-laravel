<?php

namespace App\Support;

use App\Models\BkkFollow;
use App\Models\BkkLangkah;
use App\Models\BkkLayanan;
use App\Models\Ekstrakurikuler;
use App\Models\Faq;
use App\Models\Fasilitas;
use App\Models\GaleriItem;
use App\Models\Jurusan;
use App\Models\KalenderAkademik;
use App\Models\KerjasamaIndustri;
use App\Models\KerjasamaUniversitas;
use App\Models\MagangJepangAlasan;
use App\Models\MagangJepangLangkah;
use App\Models\Misi;
use App\Models\Pengumuman;
use App\Models\PpdbBiaya;
use App\Models\PpdbJadwal;
use App\Models\PpdbLangkah;
use App\Models\PpdbSyarat;
use App\Models\PrestasiBidang;
use App\Models\Stat;
use App\Models\Tujuan;

/**
 * Daftar "resource" konten (di luar Profil Sekolah, yang berupa singleton
 * dan ditangani terpisah) yang bisa dikelola admin lewat panel konten.
 *
 * Setiap resource sekarang juga punya kunci "group" yang menentukan di
 * halaman admin mana ia dikelola (profil / akademik / ppdb / galeri).
 * Ini yang membuat setiap halaman publik (Profil, Akademik, Galeri, PPDB)
 * punya "settingan" / halaman kelola kontennya sendiri-sendiri di sidebar
 * admin, alih-alih digabung jadi satu halaman "Konten Website".
 *
 * Tipe field yang didukung:
 * - text      : <input type="text">
 * - number    : <input type="number">
 * - textarea  : <textarea>
 * - lines     : <textarea>, disimpan sebagai array (1 baris = 1 item JSON)
 * - image     : <input type="file">, wajib diisi saat tambah data baru,
 *               opsional saat edit (kosongkan = gambar lama dipertahankan)
 * - color     : pemilih warna (kode hex "#RRGGBB"). Dikosongkan = otomatis
 *               memakai warna bawaan (lihat Jurusan::resolveWarna)
 * - select    : <select> pilihan tetap. Isi 'options' => [nilai => label] dan
 *               (opsional) 'default' => nilai awal saat menambah data baru
 *
 * PENTING: kunci array di sini ("stats", "misi", dst) dipakai sebagai
 * parameter route {resource}. KontenController HANYA mengizinkan resource
 * yang terdaftar di sini (whitelist) DAN yang cocok dengan {group} pada
 * URL, jadi aman dari input sembarangan.
 */
class KontenResource
{
    /**
     * Metadata setiap halaman/grup konten yang tampil sebagai menu
     * terpisah di sidebar admin.
     */
    public static function groups(): array
    {
        return [
            'profil' => [
                'label' => 'Profil Sekolah',
                'icon' => 'building',
                'desc' => 'Identitas, kontak, visi & misi, tujuan, statistik beranda, pengumuman, serta kerjasama universitas & industri.',
            ],
            'fasilitas' => [
                'label' => 'Fasilitas Sekolah',
                'icon' => 'school',
                'desc' => 'Sarana & prasarana yang tampil di halaman publik Fasilitas (menu Profil > Fasilitas): nama, kategori, deskripsi, ikon, dan foto.',
            ],
            'akademik' => [
                'label' => 'Akademik',
                'icon' => 'book-open',
                'desc' => 'Kompetensi keahlian (jurusan), kalender akademik, ekstrakurikuler, dan FAQ akademik.',
            ],
            'ppdb' => [
                'label' => 'Konten PPDB',
                'icon' => 'calendar-days',
                'desc' => 'Alur pendaftaran, jadwal, syarat, dan rincian biaya PPDB yang tampil di halaman publik PPDB.',
            ],
            'galeri' => [
                'label' => 'Galeri',
                'icon' => 'image',
                'desc' => 'Foto-foto yang tampil di halaman Galeri.',
            ],
            'prestasi' => [
                'label' => 'Bidang Prestasi',
                'icon' => 'star',
                'desc' => 'Kartu "Prestasi di Berbagai Bidang" yang tampil pada halaman publik Prestasi.',
            ],
            'magang' => [
                'label' => 'Konten Magang Jepang',
                'icon' => 'sparkles',
                'desc' => 'Bagian "Kenapa Magang ke Jepang?" dan "Langkah Menuju Jepang" pada halaman publik Magang Jepang.',
            ],
            'bkk' => [
                'label' => 'Konten BKK',
                'icon' => 'briefcase',
                'desc' => 'Bagian "Apa Saja yang BKK Bantu?", alasan follow Instagram, dan "Cara Kerja Layanan BKK" pada halaman publik BKK.',
            ],
        ];
    }

    public static function definitions(): array
    {
        return [
            'stats' => [
                'group' => 'profil',
                'label' => 'Statistik Beranda',
                'desc' => 'Angka-angka statistik (siswa aktif, guru & staff, dll) yang tampil di halaman beranda.',
                'model' => Stat::class,
                'fields' => [
                    'value' => ['label' => 'Angka', 'type' => 'number', 'rules' => 'required|integer|min:0'],
                    'suffix' => ['label' => 'Akhiran (contoh: +)', 'type' => 'text', 'rules' => 'nullable|string|max:10'],
                    'label' => ['label' => 'Label', 'type' => 'text', 'rules' => 'required|string|max:100'],
                    'icon' => ['label' => 'Nama Ikon', 'type' => 'text', 'rules' => 'required|string|max:50'],
                ],
            ],

            'pengumuman' => [
                'group' => 'profil',
                'label' => 'Pengumuman & Agenda',
                'desc' => 'Info berjalan (pengumuman, agenda, prestasi) yang tampil di beranda.',
                'model' => Pengumuman::class,
                'fields' => [
                    'judul' => ['label' => 'Judul', 'type' => 'text', 'rules' => 'required|string|max:100'],
                    'teks' => ['label' => 'Isi Teks', 'type' => 'textarea', 'rules' => 'required|string'],
                    'tanggal' => ['label' => 'Tanggal (teks bebas)', 'type' => 'text', 'rules' => 'required|string|max:50'],
                    'icon' => ['label' => 'Nama Ikon', 'type' => 'text', 'rules' => 'required|string|max:50'],
                ],
            ],

            'misi' => [
                'group' => 'profil',
                'label' => 'Visi & Misi',
                'desc' => 'Visi sekolah dan poin-poin misi yang tampil pada halaman Profil.',
                'item_label' => 'Poin Misi',
                'model' => Misi::class,
                'fields' => [
                    'isi' => ['label' => 'Isi Poin Misi', 'type' => 'textarea', 'rules' => 'required|string'],
                ],
            ],

            'tujuan' => [
                'group' => 'profil',
                'label' => 'Tujuan',
                'desc' => 'Poin-poin tujuan sekolah pada halaman Profil.',
                'model' => Tujuan::class,
                'fields' => [
                    'isi' => ['label' => 'Isi Poin Tujuan', 'type' => 'textarea', 'rules' => 'required|string'],
                ],
            ],

            'kerjasama_universitas' => [
                'group' => 'profil',
                'label' => 'Kerjasama Universitas',
                'item_label' => 'Mitra Universitas',
                'desc' => 'Daftar perguruan tinggi/lembaga mitra kerja sama yang tampil di halaman Beranda. Logo boleh dikosongkan dulu, bisa diunggah menyusul.',
                'model' => KerjasamaUniversitas::class,
                'fields' => [
                    'nama' => ['label' => 'Nama Universitas/Lembaga', 'type' => 'text', 'rules' => 'required|string|max:200'],
                    'logo' => ['label' => 'Logo (opsional)', 'type' => 'image', 'rules' => 'nullable|image|max:5120'],
                ],
            ],

            'kerjasama_industri' => [
                'group' => 'profil',
                'label' => 'Kerjasama Industri',
                'item_label' => 'Mitra Industri',
                'desc' => 'Daftar perusahaan/industri mitra kerja sama yang tampil di halaman Beranda. Logo boleh dikosongkan dulu, bisa diunggah menyusul.',
                'model' => KerjasamaIndustri::class,
                'fields' => [
                    'nama' => ['label' => 'Nama Perusahaan/Industri', 'type' => 'text', 'rules' => 'required|string|max:200'],
                    'logo' => ['label' => 'Logo (opsional)', 'type' => 'image', 'rules' => 'nullable|image|max:5120'],
                ],
            ],

            'fasilitas' => [
                'group' => 'fasilitas',
                'label' => 'Fasilitas Sekolah',
                'item_label' => 'Fasilitas',
                'desc' => 'Daftar fasilitas yang tampil di halaman Fasilitas. Isi "Kategori" yang sama untuk mengelompokkan kartu (kategori otomatis menjadi tombol filter di halaman publik).',
                'model' => Fasilitas::class,
                'fields' => [
                    'judul' => ['label' => 'Nama Fasilitas', 'type' => 'text', 'rules' => 'required|string|max:150'],
                    'kategori' => ['label' => 'Kategori (contoh: Ruang Pembelajaran / Penunjang Sekolah)', 'type' => 'text', 'rules' => 'nullable|string|max:100'],
                    'deskripsi' => ['label' => 'Deskripsi', 'type' => 'textarea', 'rules' => 'required|string'],
                    'icon' => [
                        'label' => 'Ikon Kartu',
                        'type' => 'select',
                        'options' => self::fasilitasIcons(),
                        'default' => 'building',
                        'rules' => 'required|in:'.implode(',', array_keys(self::fasilitasIcons())),
                        'hint' => 'Ikon kecil di kartu fasilitas. Juga dipakai sebagai gambar pengganti selama foto belum diunggah.',
                    ],
                    'gambar' => ['label' => 'Foto Utama (opsional, disarankan rasio 16:9)', 'type' => 'image', 'rules' => 'nullable|image|max:5120'],
                    'gambar_2' => ['label' => 'Foto Tambahan (opsional)', 'type' => 'image', 'rules' => 'nullable|image|max:5120'],
                ],
            ],

            'jurusan' => [
                'group' => 'akademik',
                'label' => 'Kompetensi Keahlian (Jurusan)',
                'desc' => 'Program jurusan yang tampil di halaman Akademik, Beranda, dan halaman detail masing-masing jurusan (termasuk daftar Lingkup Kerja).',
                'model' => Jurusan::class,
                'fields' => [
                    'kode' => ['label' => 'Kode Jurusan (contoh: TKJ)', 'type' => 'text', 'rules' => 'required|string|max:10'],
                    'nama' => ['label' => 'Nama Jurusan', 'type' => 'text', 'rules' => 'required|string|max:150'],
                    'deskripsi' => ['label' => 'Deskripsi', 'type' => 'textarea', 'rules' => 'required|string'],
                    'gambar' => ['label' => 'Gambar', 'type' => 'image', 'rules' => 'required|image|max:5120'],
                    'gambar_lab' => ['label' => 'Foto Laboratorium (opsional)', 'type' => 'image', 'rules' => 'nullable|image|max:5120'],
                    'warna' => ['label' => 'Warna Identitas Jurusan (border kartu)', 'type' => 'color', 'rules' => 'nullable|regex:/^#[0-9a-fA-F]{6}$/', 'hint' => 'Dipakai sebagai warna border luar kartu jurusan di Beranda, Akademik, dan halaman detail. Kosongkan untuk memakai warna bawaan.'],
                    'poin' => ['label' => 'Poin Keunggulan (satu poin per baris)', 'type' => 'lines', 'rules' => 'required|string'],
                    'lingkup_kerja' => ['label' => 'Lingkup Kerja / Peluang Profesi (satu per baris)', 'type' => 'lines', 'rules' => 'nullable|string'],
                ],
            ],

            'kalender_akademik' => [
                'group' => 'akademik',
                'label' => 'Kalender Akademik',
                'desc' => 'Agenda kalender akademik pada halaman Akademik.',
                'model' => KalenderAkademik::class,
                'fields' => [
                    'periode' => ['label' => 'Periode', 'type' => 'text', 'rules' => 'required|string|max:100'],
                    'agenda' => ['label' => 'Agenda', 'type' => 'text', 'rules' => 'required|string|max:150'],
                ],
            ],

            'ekstrakurikuler' => [
                'group' => 'akademik',
                'label' => 'Ekstrakurikuler',
                'desc' => 'Daftar ekstrakurikuler pada halaman Akademik.',
                'model' => Ekstrakurikuler::class,
                'fields' => [
                    'nama' => ['label' => 'Nama Ekstrakurikuler', 'type' => 'text', 'rules' => 'required|string|max:100'],
                    'icon' => ['label' => 'Nama Ikon', 'type' => 'text', 'rules' => 'required|string|max:50'],
                    'deskripsi' => ['label' => 'Deskripsi Singkat', 'type' => 'text', 'rules' => 'nullable|string|max:255'],
                ],
            ],

            'faq' => [
                'group' => 'akademik',
                'label' => 'FAQ',
                'desc' => 'Pertanyaan yang sering diajukan pada halaman Akademik.',
                'model' => Faq::class,
                'fields' => [
                    'pertanyaan' => ['label' => 'Pertanyaan', 'type' => 'text', 'rules' => 'required|string|max:255'],
                    'jawaban' => ['label' => 'Jawaban', 'type' => 'textarea', 'rules' => 'required|string'],
                ],
            ],

            'ppdb_langkah' => [
                'group' => 'ppdb',
                'label' => 'Alur Pendaftaran PPDB',
                'desc' => 'Langkah-langkah alur pendaftaran pada halaman PPDB.',
                'model' => PpdbLangkah::class,
                'fields' => [
                    'nomor' => ['label' => 'Nomor (contoh: 01)', 'type' => 'text', 'rules' => 'required|string|max:5'],
                    'judul' => ['label' => 'Judul Langkah', 'type' => 'text', 'rules' => 'required|string|max:100'],
                    'deskripsi' => ['label' => 'Deskripsi', 'type' => 'textarea', 'rules' => 'required|string'],
                ],
            ],

            'ppdb_jadwal' => [
                'group' => 'ppdb',
                'label' => 'Jadwal PPDB',
                'desc' => 'Jadwal/periode kegiatan PPDB.',
                'model' => PpdbJadwal::class,
                'fields' => [
                    'periode' => ['label' => 'Periode', 'type' => 'text', 'rules' => 'required|string|max:100'],
                    'agenda' => ['label' => 'Agenda', 'type' => 'text', 'rules' => 'required|string|max:150'],
                ],
            ],

            'ppdb_syarat' => [
                'group' => 'ppdb',
                'label' => 'Syarat Pendaftaran PPDB',
                'desc' => 'Daftar syarat/berkas pendaftaran PPDB.',
                'model' => PpdbSyarat::class,
                'fields' => [
                    'isi' => ['label' => 'Isi Syarat', 'type' => 'text', 'rules' => 'required|string|max:255'],
                ],
            ],

            'ppdb_biaya' => [
                'group' => 'ppdb',
                'label' => 'Rincian Biaya PPDB',
                'desc' => 'Rincian biaya per jenis dan gelombang pendaftaran.',
                'model' => PpdbBiaya::class,
                'fields' => [
                    'jenis' => ['label' => 'Jenis Biaya', 'type' => 'text', 'rules' => 'required|string|max:150'],
                    'gelombang1' => ['label' => 'Gelombang 1 (Rp)', 'type' => 'number', 'rules' => 'required|integer|min:0'],
                    'gelombang2' => ['label' => 'Gelombang 2 (Rp)', 'type' => 'number', 'rules' => 'required|integer|min:0'],
                    'gelombang3' => ['label' => 'Gelombang 3 (Rp)', 'type' => 'number', 'rules' => 'required|integer|min:0'],
                ],
            ],

            'galeri' => [
                'group' => 'galeri',
                'label' => 'Galeri Foto',
                'desc' => 'Foto-foto yang tampil di halaman Galeri.',
                'model' => GaleriItem::class,
                'fields' => [
                    'sumber' => ['label' => 'Foto', 'type' => 'image', 'rules' => 'required|image|max:5120'],
                    'judul' => ['label' => 'Judul Foto', 'type' => 'text', 'rules' => 'required|string|max:150'],
                    'kategori' => ['label' => 'Kategori', 'type' => 'text', 'rules' => 'required|string|max:50'],
                ],
            ],

            'prestasi_bidang' => [
                'group' => 'prestasi',
                'label' => 'Prestasi di Berbagai Bidang',
                'item_label' => 'Bidang Prestasi',
                'desc' => 'Kartu ringkasan bidang lomba (Akademik & Sains, Olahraga, dst) pada halaman publik Prestasi.',
                'model' => PrestasiBidang::class,
                'fields' => [
                    'icon' => ['label' => 'Nama Ikon', 'type' => 'text', 'rules' => 'required|string|max:50'],
                    'judul' => ['label' => 'Judul Bidang', 'type' => 'text', 'rules' => 'required|string|max:150'],
                    'deskripsi' => ['label' => 'Deskripsi', 'type' => 'textarea', 'rules' => 'required|string'],
                ],
            ],

            'magang_alasan' => [
                'group' => 'magang',
                'label' => 'Kenapa Magang ke Jepang?',
                'item_label' => 'Alasan Magang',
                'desc' => 'Kartu alasan/keuntungan magang ke Jepang pada halaman publik Magang Jepang.',
                'model' => MagangJepangAlasan::class,
                'fields' => [
                    'icon' => ['label' => 'Nama Ikon', 'type' => 'text', 'rules' => 'required|string|max:50'],
                    'judul' => ['label' => 'Judul', 'type' => 'text', 'rules' => 'required|string|max:150'],
                    'deskripsi' => ['label' => 'Deskripsi', 'type' => 'textarea', 'rules' => 'required|string'],
                ],
            ],

            'magang_langkah' => [
                'group' => 'magang',
                'label' => 'Langkah Menuju Jepang',
                'item_label' => 'Langkah',
                'desc' => 'Tahapan alur perjalanan siswa (persiapan sampai berangkat) pada halaman publik Magang Jepang.',
                'model' => MagangJepangLangkah::class,
                'fields' => [
                    'nomor' => ['label' => 'Nomor (contoh: 01)', 'type' => 'text', 'rules' => 'required|string|max:5'],
                    'judul' => ['label' => 'Judul Langkah', 'type' => 'text', 'rules' => 'required|string|max:100'],
                    'deskripsi' => ['label' => 'Deskripsi', 'type' => 'textarea', 'rules' => 'required|string'],
                ],
            ],

            'bkk_layanan' => [
                'group' => 'bkk',
                'label' => 'Layanan BKK',
                'item_label' => 'Layanan',
                'desc' => 'Kartu "Apa Saja yang BKK Bantu?" pada halaman publik BKK.',
                'model' => BkkLayanan::class,
                'fields' => [
                    'icon' => ['label' => 'Nama Ikon', 'type' => 'text', 'rules' => 'required|string|max:50'],
                    'judul' => ['label' => 'Judul', 'type' => 'text', 'rules' => 'required|string|max:150'],
                    'deskripsi' => ['label' => 'Deskripsi', 'type' => 'textarea', 'rules' => 'required|string'],
                ],
            ],

            'bkk_follow' => [
                'group' => 'bkk',
                'label' => 'Alasan Follow Instagram',
                'item_label' => 'Alasan Follow',
                'desc' => 'Kartu alasan mengikuti Instagram BKK pada bagian "Update Info Loker via Instagram".',
                'model' => BkkFollow::class,
                'fields' => [
                    'icon' => ['label' => 'Nama Ikon', 'type' => 'text', 'rules' => 'required|string|max:50'],
                    'judul' => ['label' => 'Judul', 'type' => 'text', 'rules' => 'required|string|max:150'],
                    'deskripsi' => ['label' => 'Deskripsi', 'type' => 'textarea', 'rules' => 'required|string'],
                ],
            ],

            'bkk_langkah' => [
                'group' => 'bkk',
                'label' => 'Cara Kerja Layanan BKK',
                'item_label' => 'Langkah',
                'desc' => 'Tahapan alur layanan (dari daftar hingga penempatan) pada halaman publik BKK.',
                'model' => BkkLangkah::class,
                'fields' => [
                    'nomor' => ['label' => 'Nomor (contoh: 01)', 'type' => 'text', 'rules' => 'required|string|max:5'],
                    'judul' => ['label' => 'Judul Langkah', 'type' => 'text', 'rules' => 'required|string|max:100'],
                    'deskripsi' => ['label' => 'Deskripsi', 'type' => 'textarea', 'rules' => 'required|string'],
                ],
            ],
        ];
    }

    /**
     * Pilihan ikon untuk kartu Fasilitas (nilai = nama ikon di
     * resources/views/components/icon.blade.php, label = teks di dropdown admin).
     */
    public static function fasilitasIcons(): array
    {
        return [
            'presentation' => 'Ruang Kelas',
            'book-open' => 'Perpustakaan / Buku',
            'building' => 'Gedung / Ruang Pimpinan',
            'users' => 'Ruang Guru / Pertemuan',
            'folder' => 'Administrasi / Tata Usaha',
            'mosque' => 'Tempat Ibadah (Musholla)',
            'utensils' => 'Kantin / Makan',
            'trees' => 'Taman / Area Hijau',
            'monitor' => 'Laboratorium Komputer',
            'video' => 'Studio / Multimedia',
            'activity' => 'Olahraga',
            'heart-pulse' => 'Kesehatan (UKS)',
            'wifi' => 'Jaringan / Internet',
            'school' => 'Sekolah / Umum',
        ];
    }

    /**
     * Semua resource yang termasuk grup/halaman tertentu (profil, akademik,
     * ppdb, galeri), dengan urutan sesuai definisi di atas.
     */
    public static function forGroup(string $group): array
    {
        return array_filter(
            self::definitions(),
            fn (array $def) => ($def['group'] ?? null) === $group
        );
    }

    /**
     * Nama route yang dituju setelah tambah/ubah/hapus salah satu resource
     * pada grup tertentu (dan link "Kembali" pada form-nya).
     *
     * Secara default kembali ke halaman grup itu sendiri (admin.konten.*),
     * tapi untuk grup yang kontennya sudah digabung jadi tab pada halaman
     * admin lain (mis. "magang" digabung ke halaman "Magang Jepang", dan
     * "prestasi" digabung ke halaman "Prestasi Sekolah"), arahkan ke
     * halaman gabungan tersebut supaya admin kembali ke tab yang benar.
     */
    public static function backRoute(string $group): string
    {
        return match ($group) {
            'magang' => 'admin.magang-jepang.index',
            'prestasi' => 'admin.prestasi-sekolah.index',
            'bkk' => 'admin.bkk.index',
            default => 'admin.konten.'.$group,
        };
    }
}