<?php

namespace App\Http\Controllers;

use App\Models\MagangJepang;
use App\Models\MagangJepangAlasan;
use App\Models\MagangJepangLangkah;

class MagangJepangController extends Controller
{
    public function index()
    {
        return view('pages.magang-jepang', [
            'site' => \App\Support\SiteData::all(),
            // Data dikelola dari panel admin: Konten Website > Magang Jepang.
            'alumni' => MagangJepang::orderBy('urutan')->orderBy('id')->get(),
            // Bagian "Kenapa Magang ke Jepang?" dan "Langkah Menuju Jepang",
            // dikelola dari panel admin: Konten Website > Konten Magang Jepang.
            'alasanList' => MagangJepangAlasan::orderBy('urutan')->orderBy('id')->get(),
            'langkahList' => MagangJepangLangkah::orderBy('urutan')->orderBy('id')->get(),
        ]);
    }
}