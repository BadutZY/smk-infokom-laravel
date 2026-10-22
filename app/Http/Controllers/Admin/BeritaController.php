<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\BeritaFoto;
use App\Support\Site;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BeritaController extends Controller
{
    public function index(Request $request)
    {
        $query = Berita::withCount('foto')->orderByDesc('tanggal')->orderByDesc('id');

        if ($search = $request->query('search')) {
            $query->where('judul', 'like', '%'.$search.'%');
        }

        if ($kategori = $request->query('kategori')) {
            $query->where('kategori', $kategori);
        }

        $berita = $query->get();
        $kategoriList = Berita::select('kategori')->distinct()->pluck('kategori');

        return view('admin.berita.index', [
            'site' => \App\Support\SiteData::all(),
            'berita' => $berita,
            'kategoriList' => $kategoriList,
            'search' => $search,
            'activeKategori' => $kategori,
        ]);
    }

    public function create()
    {
        return view('admin.berita.form', [
            'site' => \App\Support\SiteData::all(),
            'item' => null,
            'existingFoto' => collect(),
        ]);
    }

    public function edit(Berita $berita)
    {
        return view('admin.berita.form', [
            'site' => \App\Support\SiteData::all(),
            'item' => $berita,
            'existingFoto' => $berita->foto,
        ]);
    }

    public function store(Request $request)
    {
        $this->save($request, null);

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil ditambahkan');
    }

    public function update(Request $request, Berita $berita)
    {
        $this->save($request, $berita);

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil diperbarui');
    }

    protected function save(Request $request, ?Berita $berita): void
    {
        $data = $request->validate([
            'judul' => ['required', 'string', 'min:5', 'max:200'],
            'kategori' => ['required', 'string', 'max:50'],
            'tanggal' => ['required', 'date'],
            'ringkasan' => ['required', 'string', 'min:10', 'max:400'],
            'konten' => ['required', 'string', 'min:20'],
            'foto_baru.*' => ['nullable', 'image', 'max:5120'],
            'hapus_foto' => ['nullable', 'array'],
            'sampul_pilihan' => ['nullable', 'string'],
        ]);

        // ---- Slug unik dari judul ----
        $baseSlug = Site::slug($data['judul']);
        $slug = $baseSlug;
        $suffix = 2;
        while (
            Berita::where('slug', $slug)
                ->when($berita, fn ($q) => $q->where('id', '!=', $berita->id))
                ->exists()
        ) {
            $slug = $baseSlug.'-'.$suffix;
            $suffix++;
        }

        $isNew = $berita === null;
        $berita = $berita ?? new Berita();
        $berita->slug = $slug;
        $berita->judul = $data['judul'];
        $berita->kategori = $data['kategori'];
        $berita->ringkasan = $data['ringkasan'];
        $berita->konten = $data['konten'];
        $berita->tanggal = $data['tanggal'];
        $berita->penulis = $berita->penulis ?: 'Admin Sekolah';
        if (! $isNew) {
            // keep existing gambar_sampul for now, may be overwritten below
        } else {
            $berita->gambar_sampul = '';
        }
        $berita->save();

        // ---- Hapus foto lama yang dicentang untuk dihapus ----
        $hapusIds = collect($request->input('hapus_foto', []))->map(fn ($id) => (int) $id);
        if ($hapusIds->isNotEmpty()) {
            $fotoDihapus = BeritaFoto::where('berita_id', $berita->id)->whereIn('id', $hapusIds)->get();
            foreach ($fotoDihapus as $foto) {
                Storage::disk('public')->delete($foto->url_gambar);
                $foto->delete();
            }
        }

        // ---- Unggah foto baru ----
        $urutan = (int) BeritaFoto::where('berita_id', $berita->id)->max('urutan');
        $fotoBaruPaths = [];
        if ($request->hasFile('foto_baru')) {
            foreach ($request->file('foto_baru') as $file) {
                if (! $file) {
                    continue;
                }
                $urutan++;
                $path = $file->store('berita', 'public');
                $fotoBaruPaths[] = $path;
                BeritaFoto::create([
                    'berita_id' => $berita->id,
                    'url_gambar' => $path,
                    'urutan' => $urutan,
                ]);
            }
        }

        // ---- Tentukan gambar sampul ----
        $sampulPilihan = $data['sampul_pilihan'] ?? null;
        $semuaFoto = BeritaFoto::where('berita_id', $berita->id)->orderBy('urutan')->pluck('url_gambar', 'id');

        if ($sampulPilihan === 'baru:0' && count($fotoBaruPaths) > 0) {
            $berita->gambar_sampul = $fotoBaruPaths[0];
        } elseif ($sampulPilihan && str_starts_with($sampulPilihan, 'lama:')) {
            $id = (int) str_replace('lama:', '', $sampulPilihan);
            if ($semuaFoto->has($id)) {
                $berita->gambar_sampul = $semuaFoto->get($id);
            }
        }

        if (! $berita->gambar_sampul && $semuaFoto->isNotEmpty()) {
            $berita->gambar_sampul = $semuaFoto->first();
        }

        $berita->save();
    }

    public function destroy(Berita $berita)
    {
        foreach ($berita->foto as $foto) {
            Storage::disk('public')->delete($foto->url_gambar);
        }
        Storage::disk('public')->delete($berita->gambar_sampul);
        $berita->delete();

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil dihapus');
    }
}
