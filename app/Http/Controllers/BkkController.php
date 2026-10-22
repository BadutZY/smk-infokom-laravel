<?php

namespace App\Http\Controllers;

use App\Models\BkkFollow;
use App\Models\BkkKonten;
use App\Models\BkkLangkah;
use App\Models\BkkLayanan;
use App\Models\BkkMedia;

class BkkController extends Controller
{
    public function index()
    {
        return view('pages.bkk', [
            'site' => \App\Support\SiteData::all(),
            // Semua data di bawah ini dikelola dari panel admin: BKK.
            'konten' => BkkKonten::first(),
            'layananList' => BkkLayanan::orderBy('urutan')->orderBy('id')->get(),
            'followList' => BkkFollow::orderBy('urutan')->orderBy('id')->get(),
            'media' => BkkMedia::orderBy('urutan')->orderBy('id')->get(),
            'langkahList' => BkkLangkah::orderBy('urutan')->orderBy('id')->get(),
        ]);
    }
}