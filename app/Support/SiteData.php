<?php

namespace App\Support;

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
use Illuminate\Support\Facades\Schema;

/**
 * Merangkai konten halaman Profil & Akademik dari database (menggantikan
 * data statis yang sebelumnya ada di config/site.php), sambil tetap
 * mengembalikan struktur array yang sama supaya seluruh tampilan (blade)
 * tidak perlu diubah.
 */
class SiteData
{
    /**
     * Data situs dibangun SEKALI per permintaan HTTP, lalu dipakai ulang.
     *
     * Kenapa penting: AppServiceProvider memasang View::composer('*') yang
     * memanggil method ini untuk SETIAP view yang dirender - termasuk tiap
     * ikon <x-icon> (puluhan per halaman). Tanpa cache ini, satu halaman
     * bisa memicu ratusan kali kumpulan ~25 query database, yang membuat
     * halaman terasa berat/patah-patah saat berpindah. Cache disimpan pada
     * objek Request, jadi otomatis segar di setiap permintaan baru.
     */
    public static function all(): array
    {
        $bag = request()->attributes;

        if (! $bag->has('site.data')) {
            $bag->set('site.data', self::build());
        }

        return $bag->get('site.data');
    }

    /** Buang cache permintaan ini (dipakai bila data diubah lalu langsung dirender ulang). */
    public static function flush(): void
    {
        request()->attributes->remove('site.data');
    }

    protected static function build(): array
    {
        // Jaga-jaga: kalau method ini terpanggil sebelum migrasi dijalankan
        // (misalnya di server baru sebelum `php artisan migrate`), jangan
        // sampai aplikasi crash. Kembalikan data kosong yang aman dulu.
        if (! Schema::hasTable('profil_sekolah')) {
            return self::empty();
        }

        try {
            $profil = ProfilSekolah::first();

            return [
                'school' => [
                    'name' => $profil->nama ?? '',
                    'short' => $profil->nama_singkat ?? '',
                    'brand_top' => $profil->brand_atas ?? '',
                    'brand_bottom' => $profil->brand_bawah ?? '',
                    'tagline' => $profil->tagline ?? '',
                    'address' => $profil->alamat ?? '',
                    'phone' => $profil->telepon ?? '',
                    'whatsapp' => $profil->whatsapp ?? '',
                    'email' => $profil->email ?? '',
                    'hours' => $profil->jam_operasional ?? '',
                    'headmaster' => $profil->kepala_sekolah ?? '',
                    'sejarah' => $profil->sejarah ?? '',
                    'kata_pengantar' => $profil->kata_pengantar ?? '',
                ],

                'nav_links' => config('site.nav_links', []),

                'stats' => Stat::orderBy('urutan')->get()->map(fn ($s) => [
                    'value' => $s->value,
                    'suffix' => $s->suffix,
                    'label' => $s->label,
                    'icon' => $s->icon,
                ])->all(),

                'visi' => $profil->visi ?? '',

                'misi' => Misi::orderBy('urutan')->pluck('isi')->all(),

                'tujuan' => Tujuan::orderBy('urutan')->pluck('isi')->all(),

                'announcements' => Pengumuman::orderBy('urutan')->get()->map(fn ($a) => [
                    'title' => $a->judul,
                    'text' => $a->teks,
                    'date' => $a->tanggal,
                    'icon' => $a->icon,
                ])->all(),

                'majors' => Jurusan::orderBy('urutan')->get()->values()->map(fn ($j, $i) => [
                    'code' => $j->kode,
                    'slug' => $j->slug,
                    'name' => $j->nama,
                    'desc' => $j->deskripsi,
                    'image' => $j->gambar,
                    'lab' => $j->gambar_lab,
                    // Warna identitas (hex valid) -> border luar kartu jurusan.
                    'color' => Jurusan::resolveWarna($j->getAttributes()['warna'] ?? null, $j->kode, $i),
                    'points' => $j->poin ?? [],
                    'lingkup_kerja' => $j->lingkup_kerja ?? [],
                ])->all(),

                'fasilitas' => Fasilitas::orderBy('urutan')->orderBy('id')->get()->map(fn ($f) => [
                    'id' => $f->id,
                    'kategori' => $f->kategori ?: 'Sarana & Prasarana',
                    'title' => $f->judul,
                    'desc' => $f->deskripsi,
                    'icon' => $f->icon ?: 'building',
                    'gambar' => $f->gambar,
                    'gambar_2' => $f->gambar_2,
                ])->all(),

                'kerjasama_universitas' => KerjasamaUniversitas::orderBy('urutan')->get()->map(fn ($k) => [
                    'nama' => $k->nama,
                    'logo' => $k->logo,
                ])->all(),

                'kerjasama_industri' => KerjasamaIndustri::orderBy('urutan')->get()->map(fn ($k) => [
                    'nama' => $k->nama,
                    'logo' => $k->logo,
                ])->all(),

                'ppdb_steps' => PpdbLangkah::orderBy('urutan')->get()->map(fn ($p) => [
                    'step' => $p->nomor,
                    'title' => $p->judul,
                    'desc' => $p->deskripsi,
                ])->all(),

                'jadwal_ppdb' => PpdbJadwal::orderBy('urutan')->get()->map(fn ($p) => [
                    'periode' => $p->periode,
                    'agenda' => $p->agenda,
                ])->all(),

                'syarat_ppdb' => PpdbSyarat::orderBy('urutan')->pluck('isi')->all(),

                'biaya_ppdb' => PpdbBiaya::orderBy('urutan')->get()->map(fn ($b) => [
                    'jenis' => $b->jenis,
                    'gelombang1' => $b->gelombang1,
                    'gelombang2' => $b->gelombang2,
                    'gelombang3' => $b->gelombang3,
                ])->all(),

                'total_biaya_ppdb' => [
                    'gelombang1' => $profil->total_biaya_gelombang1 ?? 0,
                    'gelombang2' => $profil->total_biaya_gelombang2 ?? 0,
                    'gelombang3' => $profil->total_biaya_gelombang3 ?? 0,
                ],

                'kalender_akademik' => KalenderAkademik::orderBy('urutan')->get()->map(fn ($k) => [
                    'periode' => $k->periode,
                    'agenda' => $k->agenda,
                ])->all(),

                'ekskul' => Ekstrakurikuler::orderBy('urutan')->get()->map(fn ($e) => [
                    'nama' => $e->nama,
                    'icon' => $e->icon,
                    'deskripsi' => $e->deskripsi,
                ])->all(),

                'faqs' => Faq::orderBy('urutan')->get()->map(fn ($f) => [
                    'q' => $f->pertanyaan,
                    'a' => $f->jawaban,
                ])->all(),

                'gallery_items' => GaleriItem::orderBy('urutan')->get()->map(fn ($g) => [
                    'src' => $g->sumber,
                    'title' => $g->judul,
                    'cat' => $g->kategori,
                ])->all(),

                'images' => [
                    'hero_school' => $profil->gambar_hero ?? 'images/infokom-hero.jpg',
                    'students_about' => $profil->gambar_siswa ?? 'images/infokom-siswa.jpg',
                    'kepala_sekolah' => $profil->gambar_kepala_sekolah ?? null,
                ],

                'kategori_berita' => config('site.kategori_berita', []),

                'recovery_code' => config('site.recovery_code'),
            ];
        } catch (\Throwable $e) {
            // Kalau ada masalah koneksi/skema di tengah jalan, jangan sampai
            // seluruh halaman ikut error. Tampilkan data kosong yang aman.
            return self::empty();
        }
    }

    /**
     * Struktur data kosong dengan bentuk (shape) yang sama seperti all(),
     * dipakai sebagai fallback yang aman sebelum migrasi/seeder dijalankan.
     */
    public static function empty(): array
    {
        return [
            'school' => [
                'name' => '', 'short' => '', 'brand_top' => '', 'brand_bottom' => '',
                'tagline' => '', 'address' => '', 'phone' => '', 'whatsapp' => '',
                'email' => '', 'hours' => '', 'headmaster' => '', 'sejarah' => '',
                'kata_pengantar' => '',
            ],
            'nav_links' => config('site.nav_links', []),
            'stats' => [],
            'visi' => '',
            'misi' => [],
            'tujuan' => [],
            'announcements' => [],
            'majors' => [],
            'fasilitas' => [],
            'kerjasama_universitas' => [],
            'kerjasama_industri' => [],
            'ppdb_steps' => [],
            'jadwal_ppdb' => [],
            'syarat_ppdb' => [],
            'biaya_ppdb' => [],
            'total_biaya_ppdb' => ['gelombang1' => 0, 'gelombang2' => 0, 'gelombang3' => 0],
            'kalender_akademik' => [],
            'ekskul' => [],
            'faqs' => [],
            'gallery_items' => [],
            'images' => [
                'hero_school' => 'images/infokom-hero.jpg',
                'students_about' => 'images/infokom-siswa.jpg',
                'kepala_sekolah' => null,
            ],
            'kategori_berita' => config('site.kategori_berita', []),
            'recovery_code' => config('site.recovery_code'),
        ];
    }
}