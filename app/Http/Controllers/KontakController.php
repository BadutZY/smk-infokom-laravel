<?php

namespace App\Http\Controllers;

use App\Models\PesanKontak;
use Illuminate\Http\Request;

class KontakController extends Controller
{
    public function create()
    {
        return view('pages.kontak', [
            'site' => \App\Support\SiteData::all(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => ['required', 'string', 'min:3', 'max:100'],
            'email' => ['required', 'email', 'max:100'],
            'subjek' => ['required', 'string', 'min:3', 'max:150'],
            'pesan' => ['required', 'string', 'min:10', 'max:1000'],
        ]);

        PesanKontak::create([
            ...$data,
            'status' => 'belum_dibaca',
            'created_at' => now(),
        ]);

        return redirect()->route('kontak')->with('kontak_success', true);
    }
}
