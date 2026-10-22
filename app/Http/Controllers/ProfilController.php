<?php

namespace App\Http\Controllers;

class ProfilController extends Controller
{
    public function index()
    {
        return view('pages.profil', [
            'site' => \App\Support\SiteData::all(),
        ]);
    }
}
