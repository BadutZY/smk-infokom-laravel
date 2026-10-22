<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    public function index(Request $request)
    {
        $beritaList = Berita::orderByDesc('tanggal')->orderByDesc('id')->get();

        $categories = $beritaList->pluck('kategori')->unique()->values();

        $kategori = $request->query('kategori', 'Semua');
        $list = $kategori && $kategori !== 'Semua'
            ? $beritaList->where('kategori', $kategori)->values()
            : $beritaList;

        return view('pages.berita-index', [
            'site' => \App\Support\SiteData::all(),
            'beritaList' => $beritaList,
            'categories' => $categories,
            'activeKategori' => $kategori ?: 'Semua',
            'list' => $list,
        ]);
    }

    public function show(string $slug)
    {
        $item = Berita::with('foto')->where('slug', $slug)->first();

        if (! $item) {
            return response()->view('pages.berita-not-found', [
                'site' => \App\Support\SiteData::all(),
            ], 404);
        }

        $related = Berita::where('slug', '!=', $slug)
            ->orderByDesc('tanggal')
            ->take(3)
            ->get();

        $galeri = $item->foto->pluck('url_gambar')->values();
        if ($galeri->isEmpty()) {
            $galeri = collect([$item->gambar_sampul]);
        }

        return view('pages.berita-show', [
            'site' => \App\Support\SiteData::all(),
            'item' => $item,
            'related' => $related,
            'galeri' => $galeri,
        ]);
    }
}
