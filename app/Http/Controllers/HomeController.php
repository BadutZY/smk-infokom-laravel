<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\MagangJepang;

class HomeController extends Controller
{
    public function index()
    {
        $site = \App\Support\SiteData::all();

        // Slide ke-3 dibuat dari data jurusan asli (bukan teks tetap), jadi otomatis
        // ikut berubah bila jurusan ditambah/diganti dari panel admin.
        $codes = collect($site['majors'])->pluck('code')->values();
        $majorTitle = $codes->isEmpty()
            ? "TKJ - RPL\nDKV - PSPT"
            : $codes->chunk(2)->map(fn ($c) => $c->implode(' - '))->implode("\n");
        $numWords = [1 => 'Satu', 2 => 'Dua', 3 => 'Tiga', 4 => 'Empat', 5 => 'Lima', 6 => 'Enam'];
        $majorKicker = ($numWords[$codes->count()] ?? ($codes->count() ?: 'Empat')).' Kompetensi Keahlian';

        $heroSlides = [
            [
                'kicker' => 'Selamat Datang di',
                'title' => "SMK INFOKOM\nKOTA BOGOR",
                'desc' => $site['school']['tagline'],
            ],
            [
                'kicker' => 'Informatika & Telekomunikasi',
                'title' => "BELAJAR LANGSUNG\nDARI DUNIA KERJA",
                'desc' => 'Kurikulum berstandar Nasional yang selaras dengan kebutuhan dunia usaha dan dunia industri.',
            ],
            [
                'kicker' => $majorKicker,
                'title' => $majorTitle,
                'desc' => 'Laboratorium jaringan, kelas pemrograman, studio multimedia, dan studio televisi untuk praktik nyata.',
            ],
        ];

        $beritaTerbaru = Berita::orderByDesc('tanggal')->orderByDesc('id')->take(4)->get();

        return view('pages.home', [
            'site' => $site,
            'heroSlides' => $heroSlides,
            'beritaTerbaru' => $beritaTerbaru,
            'magangJepang' => MagangJepang::orderBy('urutan')->orderBy('id')->take(3)->get(),
            'totalMagang' => MagangJepang::count(),
        ]);
    }
}