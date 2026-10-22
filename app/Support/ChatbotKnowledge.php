<?php

namespace App\Support;

use App\Models\BkkFollow;
use App\Models\BkkKonten;
use App\Models\BkkLangkah;
use App\Models\BkkLayanan;
use App\Models\Ekstrakurikuler;
use App\Models\Faq;
use App\Models\Fasilitas;
use App\Models\GuruStaff;
use App\Models\Jurusan;
use App\Models\KalenderAkademik;
use App\Models\KerjasamaIndustri;
use App\Models\KerjasamaUniversitas;
use App\Models\KunjunganIndustri;
use App\Models\KunjunganIndustriInfo;
use App\Models\KunjunganIndustriVideo;
use App\Models\MagangJepang;
use App\Models\MagangJepangAlasan;
use App\Models\MagangJepangLangkah;
use App\Models\Misi;
use App\Models\Pengumuman;
use App\Models\PpdbBiaya;
use App\Models\PpdbJadwal;
use App\Models\PpdbLangkah;
use App\Models\PpdbSyarat;
use App\Models\PrestasiBidang;
use App\Models\PrestasiSekolah;
use App\Models\ProfilSekolah;
use App\Models\Stat;
use App\Models\Tujuan;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

/**
 * Merangkai "basis pengetahuan" chatbot dalam bentuk teks, LANGSUNG dari database
 * (data yang sama dengan yang tampil di website & dikelola dari panel admin).
 *
 * Sengaja TIDAK memasukkan:
 *  - Berita & Galeri (permintaan: datanya belum akurat),
 *  - data pendaftar PPDB, pesan kontak, dan akun admin (data pribadi / rahasia).
 *
 * Karena dibaca dari database, perubahan dari panel admin otomatis ikut terbaca
 * chatbot (maksimal tertunda sesuai GEMINI_KNOWLEDGE_CACHE detik).
 */
class ChatbotKnowledge
{
    public const CACHE_KEY = 'chatbot.knowledge.v1';

    /** Ambil basis pengetahuan (dengan cache singkat supaya tidak query berulang tiap pesan). */
    public static function get(): string
    {
        $ttl = (int) config('services.gemini.knowledge_cache', 120);

        if ($ttl <= 0) {
            return self::build();
        }

        return Cache::remember(self::CACHE_KEY, $ttl, fn () => self::build());
    }

    /** Buang cache (mis. dipanggil dari tinker setelah mengubah data). */
    public static function flush(): void
    {
        Cache::forget(self::CACHE_KEY);
    }

    public static function build(): string
    {
        $sections = [
            self::safe('halaman', fn () => self::halaman()),
            self::safe('profil', fn () => self::profil()),
            self::safe('statistik', fn () => self::statistik()),
            self::safe('visi-misi', fn () => self::visiMisi()),
            self::safe('pengumuman', fn () => self::pengumuman()),
            self::safe('jurusan', fn () => self::jurusan()),
            self::safe('kalender', fn () => self::kalender()),
            self::safe('ekskul', fn () => self::ekskul()),
            self::safe('fasilitas', fn () => self::fasilitas()),
            self::safe('guru', fn () => self::guruStaff()),
            self::safe('ppdb', fn () => self::ppdb()),
            self::safe('faq', fn () => self::faq()),
            self::safe('prestasi', fn () => self::prestasi()),
            self::safe('bkk', fn () => self::bkk()),
            self::safe('magang', fn () => self::magangJepang()),
            self::safe('kunjungan', fn () => self::kunjunganIndustri()),
            self::safe('kerjasama', fn () => self::kerjasama()),
        ];

        return trim(implode("\n\n", array_filter($sections)));
    }

    /** Satu bagian yang gagal (mis. tabel belum ada) tidak boleh merusak seluruh chatbot. */
    protected static function safe(string $nama, callable $fn): string
    {
        try {
            return (string) $fn();
        } catch (\Throwable $e) {
            Log::warning('Chatbot: bagian pengetahuan gagal dibuat', ['bagian' => $nama, 'error' => $e->getMessage()]);

            return '';
        }
    }

    // ------------------------------------------------------------------
    // Helper format
    // ------------------------------------------------------------------

    /** Teks satu baris (newline -> spasi). */
    protected static function line(?string $v): string
    {
        $v = trim((string) $v);

        return $v === '' ? '' : trim(preg_replace('/\s+/u', ' ', $v));
    }

    /** Teks beberapa paragraf (menjaga pemisah paragraf). */
    protected static function para(?string $v): string
    {
        $v = trim(str_replace("\r", '', (string) $v));

        return trim(preg_replace("/\n{3,}/", "\n\n", $v));
    }

    protected static function rp($v): string
    {
        return Site::rupiah((int) $v);
    }

    protected static function section(string $judul, array $isi): string
    {
        $isi = array_values(array_filter($isi, fn ($l) => $l !== null && $l !== ''));

        if (empty($isi)) {
            return '';
        }

        return "## {$judul}\n".implode("\n", $isi);
    }

    // ------------------------------------------------------------------
    // Bagian-bagian pengetahuan
    // ------------------------------------------------------------------

    /** Daftar halaman website (agar chatbot hanya menautkan halaman yang benar-benar ada). */
    protected static function halaman(): string
    {
        $jurusanLinks = Jurusan::orderBy('urutan')->get()
            ->filter(fn ($j) => ! empty($j->slug))
            ->map(fn ($j) => '- Detail jurusan '.$j->kode.': '.route('akademik.jurusan', $j->slug))
            ->all();

        return self::section('DAFTAR HALAMAN WEBSITE (satu-satunya tautan yang boleh diberikan)', array_merge([
            '- Beranda: '.route('home'),
            '- Profil Sekolah (sejarah, visi, misi, tujuan): '.route('profil'),
            '- Fasilitas: '.route('fasilitas'),
            '- Akademik (jurusan, kalender akademik, ekstrakurikuler): '.route('akademik'),
            '- Guru & Staff: '.route('guru-staff'),
            '- Berita: '.route('berita.index'),
            '- Galeri: '.route('galeri'),
            '- Prestasi Sekolah: '.route('prestasi'),
            '- Magang Jepang: '.route('magang-jepang'),
            '- Kunjungan Industri: '.route('kunjungan-industri'),
            '- BKK (Bursa Kerja Khusus): '.route('bkk'),
            '- PPDB (info & formulir pendaftaran online): '.route('ppdb'),
            '- Kontak (formulir pesan ke sekolah): '.route('kontak'),
        ], $jurusanLinks));
    }

    protected static function profil(): string
    {
        $p = ProfilSekolah::first();

        if (! $p) {
            return '';
        }

        $out = [
            'Nama lengkap sekolah: '.self::line($p->nama),
            'Nama singkat: '.self::line($p->nama_singkat),
            'Tagline: '.self::line($p->tagline),
            'Alamat: '.self::line($p->alamat),
            'Telepon sekolah: '.self::line($p->telepon),
            'WhatsApp: '.self::line($p->whatsapp),
            'Email: '.self::line($p->email),
            'Jam operasional: '.self::line($p->jam_operasional),
            'Kepala sekolah (menurut data profil sekolah): '.self::line($p->kepala_sekolah),
        ];

        if (self::line($p->sejarah) !== '') {
            $out[] = "Sejarah singkat sekolah:\n".self::para($p->sejarah);
        }

        if (self::line($p->kata_pengantar) !== '') {
            $out[] = "Kata pengantar website (sambutan):\n".self::para($p->kata_pengantar);
        }

        return self::section('PROFIL SEKOLAH & KONTAK', $out);
    }

    protected static function statistik(): string
    {
        $rows = Stat::orderBy('urutan')->get()
            ->map(fn ($s) => '- '.self::line($s->label).': '.$s->value.self::line($s->suffix))
            ->all();

        if (empty($rows)) {
            return '';
        }

        $rows[] = '(Angka di atas adalah statistik resmi sekolah yang tampil di beranda. Tanda "+" berarti "lebih dari".)';

        return self::section('STATISTIK SEKOLAH', $rows);
    }

    protected static function visiMisi(): string
    {
        $p = ProfilSekolah::first();
        $out = [];

        if ($p && self::line($p->visi) !== '') {
            $out[] = 'Visi: '.self::line($p->visi);
        }

        $misi = Misi::orderBy('urutan')->pluck('isi')->all();
        if ($misi) {
            $out[] = 'Misi:';
            foreach ($misi as $i => $m) {
                $out[] = '  '.($i + 1).'. '.self::line($m);
            }
        }

        $tujuan = Tujuan::orderBy('urutan')->pluck('isi')->all();
        if ($tujuan) {
            $out[] = 'Tujuan sekolah:';
            foreach ($tujuan as $i => $t) {
                $out[] = '  '.($i + 1).'. '.self::line($t);
            }
        }

        return self::section('VISI, MISI & TUJUAN', $out);
    }

    protected static function pengumuman(): string
    {
        $rows = Pengumuman::orderBy('urutan')->get()
            ->map(fn ($a) => '- ['.self::line($a->judul).'] '.self::line($a->teks).($a->tanggal ? ' (tanggal: '.self::line($a->tanggal).')' : ''))
            ->all();

        if ($rows) {
            array_unshift($rows, '(Pengumuman yang tercatat di website beserta tanggal tercatatnya. Jangan menyimpulkan status "saat ini" dari tanggal ini.)');
        }

        return self::section('PENGUMUMAN DI WEBSITE', $rows);
    }

    protected static function jurusan(): string
    {
        $items = Jurusan::orderBy('urutan')->get();

        if ($items->isEmpty()) {
            return '';
        }

        $out = ['Jumlah kompetensi keahlian (jurusan): '.$items->count()];

        foreach ($items as $j) {
            $out[] = '';
            $out[] = '### '.self::line($j->nama).' ('.self::line($j->kode).')';
            $out[] = 'Deskripsi: '.self::line($j->deskripsi);

            $poin = array_filter(array_map([self::class, 'line'], (array) $j->poin));
            if ($poin) {
                $out[] = 'Materi/kompetensi yang dipelajari: '.implode('; ', $poin);
            }

            $lingkup = array_filter(array_map([self::class, 'line'], (array) $j->lingkup_kerja));
            if ($lingkup) {
                $out[] = 'Lingkup kerja / prospek karier: '.implode('; ', $lingkup);
            }

            if (! empty($j->slug)) {
                $out[] = 'Halaman detail: '.route('akademik.jurusan', $j->slug);
            }
        }

        return self::section('KOMPETENSI KEAHLIAN (JURUSAN)', $out);
    }

    protected static function kalender(): string
    {
        $rows = KalenderAkademik::orderBy('urutan')->get()
            ->map(fn ($k) => '- '.self::line($k->periode).': '.self::line($k->agenda))
            ->all();

        return self::section('KALENDER AKADEMIK (agenda tahunan, urut sepanjang tahun ajaran)', $rows);
    }

    protected static function ekskul(): string
    {
        $items = Ekstrakurikuler::orderBy('urutan')->get();

        if ($items->isEmpty()) {
            return '';
        }

        $out = ['Jumlah ekstrakurikuler: '.$items->count()];
        foreach ($items as $e) {
            $out[] = '- '.self::line($e->nama).($e->deskripsi ? ': '.self::line($e->deskripsi) : '');
        }

        return self::section('EKSTRAKURIKULER', $out);
    }

    protected static function fasilitas(): string
    {
        $items = Fasilitas::orderBy('urutan')->orderBy('id')->get();

        if ($items->isEmpty()) {
            return '';
        }

        $out = ['Jumlah fasilitas yang terdaftar: '.$items->count()];

        foreach ($items->groupBy(fn ($f) => $f->kategori ?: 'Sarana & Prasarana') as $kategori => $rows) {
            $out[] = '';
            $out[] = '### '.$kategori;
            foreach ($rows as $f) {
                $out[] = '- '.self::line($f->judul).': '.self::line($f->deskripsi);
            }
        }

        return self::section('FASILITAS SEKOLAH', $out);
    }

    protected static function guruStaff(): string
    {
        $items = GuruStaff::orderBy('urutan')->orderBy('id')->get();

        if ($items->isEmpty()) {
            return '';
        }

        $urutan = GuruStaff::URUTAN_KATEGORI;
        $grouped = $items->groupBy('kategori')->sortBy(function ($rows, $kategori) use ($urutan) {
            $i = array_search($kategori, $urutan, true);

            return $i === false ? count($urutan) : $i;
        });

        $out = [
            'Catatan: daftar di bawah adalah profil yang ditampilkan di halaman Guru & Staff ('.$items->count().' profil), BUKAN jumlah seluruh guru & staff. Untuk jumlah keseluruhan, rujuk statistik sekolah.',
        ];

        foreach ($grouped as $kategori => $rows) {
            $out[] = '';
            $out[] = '### '.$kategori;
            foreach ($rows as $g) {
                $out[] = '- '.self::line($g->nama_lengkap).' — '.self::line($g->jabatan);
            }
        }

        return self::section('GURU, STAFF & PIMPINAN', $out);
    }

    protected static function ppdb(): string
    {
        $p = ProfilSekolah::first();
        $out = [];

        $langkah = PpdbLangkah::orderBy('urutan')->get();
        if ($langkah->isNotEmpty()) {
            $out[] = 'Alur pendaftaran:';
            foreach ($langkah as $l) {
                $out[] = '  '.self::line($l->nomor).'. '.self::line($l->judul).' — '.self::line($l->deskripsi);
            }
        }

        $jadwal = PpdbJadwal::orderBy('urutan')->get();
        if ($jadwal->isNotEmpty()) {
            $out[] = 'Jadwal PPDB:';
            foreach ($jadwal as $j) {
                $out[] = '  - '.self::line($j->periode).': '.self::line($j->agenda);
            }
        }

        $syarat = PpdbSyarat::orderBy('urutan')->pluck('isi')->all();
        if ($syarat) {
            $out[] = 'Persyaratan pendaftaran:';
            foreach ($syarat as $i => $s) {
                $out[] = '  '.($i + 1).'. '.self::line($s);
            }
        }

        $biaya = PpdbBiaya::orderBy('urutan')->get();
        if ($biaya->isNotEmpty()) {
            $out[] = 'Rincian biaya PPDB (Gelombang I | Gelombang II | Gelombang III):';
            foreach ($biaya as $b) {
                $out[] = '  - '.self::line($b->jenis).': '.self::rp($b->gelombang1).' | '.self::rp($b->gelombang2).' | '.self::rp($b->gelombang3);
            }
            if ($p) {
                $out[] = 'TOTAL biaya (sesuai data sekolah): Gelombang I = '.self::rp($p->total_biaya_gelombang1)
                    .'; Gelombang II = '.self::rp($p->total_biaya_gelombang2)
                    .'; Gelombang III = '.self::rp($p->total_biaya_gelombang3);
            }
        }

        $out[] = 'Pendaftaran online: '.route('ppdb');

        return self::section('PPDB (PENERIMAAN PESERTA DIDIK BARU)', $out);
    }

    protected static function faq(): string
    {
        $rows = [];
        foreach (Faq::orderBy('urutan')->get() as $f) {
            $rows[] = 'T: '.self::line($f->pertanyaan);
            $rows[] = 'J: '.self::line($f->jawaban);
        }

        return self::section('FAQ (PERTANYAAN YANG SERING DIAJUKAN)', $rows);
    }

    protected static function prestasi(): string
    {
        $items = PrestasiSekolah::orderBy('urutan')->orderBy('kelompok')->orderBy('id')->get();

        if ($items->isEmpty()) {
            return '';
        }

        $nasional = $items->filter(fn ($i) => stripos((string) $i->tingkat, 'nasional') !== false)->count();

        $out = [
            'Ringkasan: total '.$items->count().' capaian dari '.$items->groupBy('kelompok')->count().' siswa/tim; '
                .'medali emas/juara 1 = '.$items->where('peringkat', 'emas')->count()
                .', perak/juara 2 = '.$items->where('peringkat', 'perak')->count()
                .', perunggu/juara 3 = '.$items->where('peringkat', 'perunggu')->count()
                .', lainnya = '.$items->whereNotIn('peringkat', ['emas', 'perak', 'perunggu'])->count()
                .'; tingkat nasional = '.$nasional.' capaian.',
        ];

        $bidang = PrestasiBidang::orderBy('urutan')->orderBy('id')->get();
        if ($bidang->isNotEmpty()) {
            $out[] = 'Bidang prestasi:';
            foreach ($bidang as $b) {
                $out[] = '  - '.self::line($b->judul).': '.self::line($b->deskripsi);
            }
        }

        $out[] = 'Daftar capaian (per siswa/tim):';
        foreach ($items->groupBy('kelompok') as $rows) {
            $out[] = '### '.self::line($rows->first()->nama_siswa);
            foreach ($rows as $r) {
                $out[] = '- '.self::line($r->nama_kejuaraan).' — '.self::line($r->juara)
                    .' | tingkat: '.self::line($r->tingkat)
                    .' | tahun: '.self::line($r->tahun)
                    .' | bidang: '.self::line($r->kategori);
            }
        }

        return self::section('PRESTASI SEKOLAH', $out);
    }

    protected static function bkk(): string
    {
        $out = [];
        $k = BkkKonten::first();

        if ($k) {
            if (self::line($k->apa_itu) !== '') {
                $out[] = 'Apa itu BKK: '.self::line($k->apa_itu);
            }
            $out[] = 'Instagram BKK: @'.self::line($k->ig_username).' ('.self::line($k->ig_nama).')'
                .($k->ig_url ? ' — '.self::line($k->ig_url) : '');
            if (self::line($k->ig_bio) !== '') {
                $out[] = 'Bio Instagram BKK: '.self::line($k->ig_bio);
            }
            $out[] = 'Statistik Instagram BKK (saat data diinput): '.$k->ig_kiriman.' kiriman, '.$k->ig_pengikut.' pengikut, '.$k->ig_diikuti.' diikuti.';
        }

        $layanan = BkkLayanan::orderBy('urutan')->get();
        if ($layanan->isNotEmpty()) {
            $out[] = 'Layanan BKK:';
            foreach ($layanan as $l) {
                $out[] = '  - '.self::line($l->judul).': '.self::line($l->deskripsi);
            }
        }

        $langkah = BkkLangkah::orderBy('urutan')->get();
        if ($langkah->isNotEmpty()) {
            $out[] = 'Alur penyaluran kerja BKK:';
            foreach ($langkah as $l) {
                $out[] = '  '.self::line($l->nomor).'. '.self::line($l->judul).' — '.self::line($l->deskripsi);
            }
        }

        $follow = BkkFollow::orderBy('urutan')->get();
        if ($follow->isNotEmpty()) {
            $out[] = 'Manfaat mengikuti BKK:';
            foreach ($follow as $f) {
                $out[] = '  - '.self::line($f->judul).': '.self::line($f->deskripsi);
            }
        }

        if ($out) {
            $out[] = 'Halaman BKK: '.route('bkk');
        }

        return self::section('BKK (BURSA KERJA KHUSUS) & KARIER ALUMNI', $out);
    }

    protected static function magangJepang(): string
    {
        $out = [];

        $alasan = MagangJepangAlasan::orderBy('urutan')->get();
        if ($alasan->isNotEmpty()) {
            $out[] = 'Alasan / manfaat magang ke Jepang:';
            foreach ($alasan as $a) {
                $out[] = '  - '.self::line($a->judul).': '.self::line($a->deskripsi);
            }
        }

        $langkah = MagangJepangLangkah::orderBy('urutan')->get();
        if ($langkah->isNotEmpty()) {
            $out[] = 'Tahapan magang ke Jepang:';
            foreach ($langkah as $l) {
                $out[] = '  '.self::line($l->nomor).'. '.self::line($l->judul).' — '.self::line($l->deskripsi);
            }
        }

        $alumni = MagangJepang::orderBy('urutan')->orderBy('id')->get();
        if ($alumni->isNotEmpty()) {
            $out[] = 'Alumni yang ditampilkan di website ('.$alumni->count().' orang):';
            foreach ($alumni as $m) {
                $out[] = '  - '.self::line($m->nama)
                    .($m->angkatan ? ' ('.self::line($m->angkatan).')' : '')
                    .($m->kota ? ', kota/negara tujuan: '.self::line($m->kota) : '')
                    .($m->handle ? ', Instagram: @'.ltrim(self::line($m->handle), '@') : '')
                    .($m->catatan ? ' — catatan sekolah: '.self::line($m->catatan) : '');
            }
        }

        if ($out) {
            $out[] = 'Halaman Magang Jepang: '.route('magang-jepang');
        }

        return self::section('MAGANG JEPANG', $out);
    }

    protected static function kunjunganIndustri(): string
    {
        $out = [];

        $info = KunjunganIndustriInfo::first();
        if ($info) {
            $out[] = 'Kegiatan: '.self::line($info->judul);
            if ($info->periode) {
                $out[] = 'Waktu pelaksanaan: '.self::line($info->periode);
            }
            if ($info->kota_tujuan) {
                $out[] = 'Kota tujuan: '.self::line($info->kota_tujuan);
            }
            if (self::line($info->intro) !== '') {
                $out[] = 'Penjelasan: '.self::line($info->intro);
            }
        }

        $lokasi = KunjunganIndustri::orderBy('urutan')->orderBy('id')->get();
        if ($lokasi->isNotEmpty()) {
            $out[] = 'Lokasi yang dikunjungi ('.$lokasi->count().' lokasi):';
            foreach ($lokasi as $l) {
                $baris = '  - '.self::line($l->nama)
                    .($l->kategori ? ' ['.self::line($l->kategori).']' : '')
                    .($l->kota ? ', '.self::line($l->kota) : '');
                if (self::line($l->deskripsi) !== '') {
                    $baris .= ' — '.self::line($l->deskripsi);
                }
                $sorotan = $l->sorotanList();
                if ($sorotan) {
                    $baris .= ' Sorotan: '.implode('; ', $sorotan).'.';
                }
                $out[] = $baris;
            }
        }

        $video = KunjunganIndustriVideo::orderBy('urutan')->orderBy('id')->pluck('judul')->filter()->all();
        if ($video) {
            $out[] = 'Video dokumentasi di website: '.implode('; ', array_map([self::class, 'line'], $video));
        }

        if ($out) {
            $out[] = 'Halaman Kunjungan Industri: '.route('kunjungan-industri');
        }

        return self::section('KUNJUNGAN INDUSTRI', $out);
    }

    protected static function kerjasama(): string
    {
        $out = [];

        $industri = KerjasamaIndustri::orderBy('urutan')->pluck('nama')->all();
        if ($industri) {
            $out[] = 'Mitra industri/perusahaan yang ditampilkan di website ('.count($industri).' mitra; statistik resmi sekolah menyebut jumlah keseluruhan mitra lebih besar): '
                .implode('; ', array_map([self::class, 'line'], $industri)).'.';
        }

        $kampus = KerjasamaUniversitas::orderBy('urutan')->pluck('nama')->all();
        if ($kampus) {
            $out[] = 'Mitra perguruan tinggi/lembaga pendidikan ('.count($kampus).'): '
                .implode('; ', array_map([self::class, 'line'], $kampus)).'.';
        }

        return self::section('KERJA SAMA (MITRA INDUSTRI & PERGURUAN TINGGI)', $out);
    }
}