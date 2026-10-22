<?php

namespace App\Http\Controllers;

use App\Models\KunjunganIndustri;
use App\Models\KunjunganIndustriInfo;
use App\Models\KunjunganIndustriVideo;

class KunjunganIndustriController extends Controller
{
    public function index()
    {
        return view('pages.kunjungan-industri', [
            'site' => \App\Support\SiteData::all(),
            // Semua data dikelola dari panel admin: Konten Website > Kunjungan Industri.
            'info' => KunjunganIndustriInfo::first(),
            'lokasiList' => KunjunganIndustri::with('fotos')->orderBy('urutan')->orderBy('id')->get(),
            'videos' => KunjunganIndustriVideo::with('lokasi')->orderBy('urutan')->orderBy('id')->get(),
        ]);
    }
}