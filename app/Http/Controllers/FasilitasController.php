<?php

namespace App\Http\Controllers;

class FasilitasController extends Controller
{
    /**
     * Halaman publik "Fasilitas Sekolah". Data fasilitas diambil dari database
     * lewat SiteData (key 'fasilitas'), dikelola admin di
     * Admin > Fasilitas Sekolah.
     */
    public function index()
    {
        return view('pages.fasilitas', [
            'site' => \App\Support\SiteData::all(),
        ]);
    }
}