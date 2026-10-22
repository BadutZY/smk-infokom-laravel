<?php

namespace App\Http\Controllers;

use App\Models\PrestasiBidang;
use App\Models\PrestasiSekolah;
use App\Support\Site;
use Illuminate\Support\Collection;

class PrestasiController extends Controller
{
    public function index()
    {
        // Data dikelola dari panel admin: Konten Website > Prestasi Sekolah.
        $items = PrestasiSekolah::orderBy('urutan')->orderBy('kelompok')->orderBy('id')->get();

        // Mengelompokkan beberapa baris prestasi milik siswa/tim yang sama
        // menjadi satu kartu (urutan grup mengikuti urutan kemunculan pertama).
        $grouped = $items->groupBy('kelompok');

        $stats = [
            'total' => $items->count(),
            'siswa' => $grouped->count(),
            'emas' => $items->where('peringkat', 'emas')->count(),
            'perak' => $items->where('peringkat', 'perak')->count(),
            'perunggu' => $items->where('peringkat', 'perunggu')->count(),
            'nasional' => $items->filter(fn ($i) => stripos((string) $i->tingkat, 'nasional') !== false)->count(),
        ];

        // Satu elemen = satu kartu siswa/tim, sudah lengkap dengan foto,
        // ringkasan medali, dan daftar prestasi terurut (tertinggi dulu).
        $cards = $grouped->map(fn ($rows) => $this->buatKartu($rows))->values();

        $kategoriList = $items->pluck('kategori')->filter()->unique()->values();

        // Jumlah kartu per bidang, ditampilkan pada tombol filter.
        $kategoriCounts = $cards
            ->groupBy('kategori')
            ->map(fn ($kartu) => $kartu->count());

        return view('pages.prestasi', [
            'site' => \App\Support\SiteData::all(),
            'cards' => $cards,
            'stats' => $stats,
            'kategoriList' => $kategoriList,
            'kategoriCounts' => $kategoriCounts,
            // Kartu "Prestasi di Berbagai Bidang", dikelola dari panel admin:
            // Konten Website > Bidang Prestasi.
            'bidangList' => PrestasiBidang::orderBy('urutan')->orderBy('id')->get(),
        ]);
    }

    /**
     * Menyusun data satu kartu dari beberapa baris prestasi milik kelompok yang sama.
     *
     * @param  Collection<int, PrestasiSekolah>  $rows
     * @return array<string, mixed>
     */
    protected function buatKartu(Collection $rows): array
    {
        // Prestasi terbaik di urutan pertama: medali -> tingkat lomba -> tahun terbaru.
        $urut = $rows
            ->sortByDesc(fn ($r) => $r->peringkatRank() * 1000000 + $r->tingkatRank() * 10000 + (int) $r->tahun)
            ->values();

        $pertama = $rows->first();
        $utama = $urut->first();
        $anggota = $pertama->anggota();
        $jumlahAnggota = count($anggota);

        $tahun = $rows->pluck('tahun')->map(fn ($t) => (int) $t)->filter();
        $tahunLabel = '';
        if ($tahun->isNotEmpty()) {
            $tahunLabel = $tahun->min() === $tahun->max()
                ? (string) $tahun->min()
                : $tahun->min().'–'.$tahun->max();
        }

        // Tim besar (4 nama atau lebih) diringkas di judul kartu; daftar lengkap tampil di jendela detail.
        $judul = $jumlahAnggota >= 4
            ? $anggota[0].' & '.($jumlahAnggota - 1).' lainnya'
            : $pertama->nama_siswa;

        $foto = $rows->pluck('foto')->filter()->first();

        return [
            'kelompok' => $pertama->kelompok,
            'nama' => $pertama->nama_siswa,
            'judul' => $judul,
            'anggota' => $anggota,
            'tim' => $pertama->isTim(),
            'inisial' => $pertama->initials(),
            'kategori' => $pertama->kategori,
            'ikon' => $pertama->kategoriIcon(),
            'foto' => $foto ? Site::imageUrl($foto) : null,
            'utama' => $utama,
            'dominan' => $utama->peringkatTema(),
            'medali' => [
                'emas' => $rows->where('peringkat', 'emas')->count(),
                'perak' => $rows->where('peringkat', 'perak')->count(),
                'perunggu' => $rows->where('peringkat', 'perunggu')->count(),
                'lainnya' => $rows->whereNotIn('peringkat', ['emas', 'perak', 'perunggu'])->count(),
            ],
            'jumlah' => $rows->count(),
            'tahun' => $tahunLabel,
            'items' => $urut,
        ];
    }
}