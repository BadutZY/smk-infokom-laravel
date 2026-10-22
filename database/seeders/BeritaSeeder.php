<?php

namespace Database\Seeders;

use App\Models\Berita;
use Illuminate\Database\Seeder;

class BeritaSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            [
                'slug' => 'pendaftaran-ppdb-2025-2026-dibuka',
                'judul' => 'Pendaftaran Peserta Didik Baru Tahun Ajaran 2025/2026 Resmi Dibuka',
                'kategori' => 'Pengumuman',
                'ringkasan' => 'SMK INFOKOM Kota Bogor membuka pendaftaran peserta didik baru untuk empat kompetensi keahlian.',
                'konten' => "SMK Informatika dan Telekomunikasi (INFOKOM) Kota Bogor resmi membuka Penerimaan Peserta Didik Baru (PPDB) untuk tahun ajaran 2025/2026. Pendaftaran dapat dilakukan secara daring melalui halaman PPDB pada website ini maupun langsung datang ke sekolah pada hari dan jam kerja.\n\nCalon peserta didik dapat memilih salah satu dari empat kompetensi keahlian yang tersedia, yaitu Teknik Komputer dan Jaringan, Rekayasa Perangkat Lunak, Multimedia, serta Produksi dan Siaran Program Televisi.\n\nPanitia PPDB siap membantu proses pendaftaran melalui nomor telepon maupun WhatsApp Humas sekolah.",
                'gambar_sampul' => 'berita/demo-1.jpg',
                'penulis' => 'Admin Sekolah',
                'tanggal' => '2025-01-10',
            ],
            [
                'slug' => 'karya-siswa-multimedia-terpilih-festival-film',
                'judul' => 'Karya Siswa Multimedia Terpilih pada Festival Film Pelajar Kota Bogor',
                'kategori' => 'Prestasi',
                'ringkasan' => 'Tim Multimedia SMK INFOKOM Kota Bogor berhasil masuk nominasi festival film pelajar tingkat kota.',
                'konten' => "Siswa kompetensi keahlian Multimedia SMK INFOKOM Kota Bogor kembali menorehkan prestasi membanggakan setelah karya film pendek mereka terpilih pada festival film pelajar tingkat Kota Bogor.\n\nKarya tersebut merupakan hasil pembelajaran produksi audio visual yang dikerjakan langsung oleh siswa, mulai dari penulisan skenario, pengambilan gambar, hingga proses penyuntingan akhir.\n\nPrestasi ini menjadi bukti nyata kualitas pembelajaran praktik di studio multimedia sekolah.",
                'gambar_sampul' => 'berita/demo-4.jpg',
                'penulis' => 'Admin Sekolah',
                'tanggal' => '2025-02-18',
            ],
            [
                'slug' => 'uji-kompetensi-keahlian-kelas-xii',
                'judul' => 'Uji Kompetensi Keahlian Kelas XII Bersama Asesor Industri',
                'kategori' => 'Akademik',
                'ringkasan' => 'Siswa kelas XII mengikuti Uji Kompetensi Keahlian yang dinilai langsung oleh asesor dari industri mitra.',
                'konten' => "Sebagai bagian dari proses kelulusan, siswa kelas XII SMK INFOKOM Kota Bogor mengikuti rangkaian Uji Kompetensi Keahlian (UKK) yang dinilai langsung oleh asesor dari dunia usaha dan dunia industri.\n\nSetiap kompetensi keahlian menyiapkan proyek uji yang relevan dengan kebutuhan dunia kerja saat ini, mulai dari konfigurasi jaringan, pengembangan aplikasi, produksi konten multimedia, hingga produksi program televisi.\n\nHasil UKK menjadi salah satu tolok ukur kesiapan kerja lulusan sebelum terjun ke dunia industri.",
                'gambar_sampul' => 'berita/demo-2.jpg',
                'penulis' => 'Admin Sekolah',
                'tanggal' => '2025-03-20',
            ],
            [
                'slug' => 'dokumentasi-produksi-program-televisi-studio-sekolah',
                'judul' => 'Dokumentasi Produksi Program Televisi di Studio Sekolah',
                'kategori' => 'Kegiatan',
                'ringkasan' => 'Siswa kompetensi keahlian PSPT berlatih memproduksi program televisi secara langsung di studio sekolah.',
                'konten' => "Studio televisi SMK INFOKOM Kota Bogor kembali digunakan untuk praktik produksi program siaran oleh siswa kompetensi keahlian Produksi dan Siaran Program Televisi (PSPT).\n\nDalam kegiatan ini, siswa berperan langsung sebagai sutradara, kameramen, penata artistik, hingga pengisi acara, dengan pendampingan penuh dari guru produktif.\n\nKegiatan semacam ini rutin dilaksanakan untuk mengasah kesiapan siswa menghadapi dunia penyiaran profesional.",
                'gambar_sampul' => 'berita/demo-3.jpg',
                'penulis' => 'Admin Sekolah',
                'tanggal' => '2025-04-05',
            ],
        ];

        foreach ($items as $item) {
            Berita::firstOrCreate(['slug' => $item['slug']], $item);
        }
    }
}
