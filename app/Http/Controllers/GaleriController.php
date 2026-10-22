<?php

namespace App\Http\Controllers;

class GaleriController extends Controller
{
    public function index()
    {
        $site = \App\Support\SiteData::all();
        $categories = collect($site['gallery_items'])->pluck('cat')->unique()->values();

        return view('pages.galeri', [
            'site' => $site,
            'categories' => $categories,
        ]);
    }
}
