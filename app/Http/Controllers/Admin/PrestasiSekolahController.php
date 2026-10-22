<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PrestasiSekolah;
use App\Support\KontenResource;
use App\Support\Site;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class PrestasiSekolahController extends Controller
{
    /**
     * Halaman "Prestasi Sekolah" digabung jadi satu: tab "Data Prestasi"
     * (data prestasi siswa/tim) dan tab-tab konten grup "prestasi" dari
     * KontenResource ("Prestasi di Berbagai Bidang"), supaya tidak perlu
     * 2 menu terpisah di sidebar admin.
     */
    public function index(Request $request)
    {
        $resources = KontenResource::forGroup('prestasi');

        $tab = $request->query('tab', 'data');
        if ($tab !== 'data' && ! array_key_exists($tab, $resources)) {
            $tab = 'data';
        }

        $data = [
            'site' => \App\Support\SiteData::all(),
            'resources' => $resources,
            'tab' => $tab,
        ];

        if ($tab === 'data') {
            $items = PrestasiSekolah::orderBy('urutan')->orderBy('kelompok')->orderBy('id')->get();
            $data['items'] = $items;
            $data['grouped'] = $items->groupBy('kelompok');
        } else {
            $data['rows'] = $resources[$tab]['model']::orderBy('urutan')->orderBy('id')->get();
        }

        return view('admin.prestasi-sekolah.index', $data);
    }

    public function create()
    {
        $maxKelompok = (int) PrestasiSekolah::max('kelompok');

        return view('admin.prestasi-sekolah.form', [
            'site' => \App\Support\SiteData::all(),
            'item' => null,
            'kategoriOptions' => PrestasiSekolah::KATEGORI,
            'kelompokDefault' => $maxKelompok + 1,
            'fotoReady' => $this->fotoReady(),
            'fotoSaatIni' => null,
        ]);
    }

    public function edit(PrestasiSekolah $prestasiSekolah)
    {
        return view('admin.prestasi-sekolah.form', [
            'site' => \App\Support\SiteData::all(),
            'item' => $prestasiSekolah,
            'kategoriOptions' => PrestasiSekolah::KATEGORI,
            'kelompokDefault' => $prestasiSekolah->kelompok,
            'fotoReady' => $this->fotoReady(),
            'fotoSaatIni' => $this->fotoReady() ? $this->urlFotoKelompok((int) $prestasiSekolah->kelompok) : null,
        ]);
    }

    public function store(Request $request)
    {
        $this->save($request, null);

        return redirect()->route('admin.prestasi-sekolah.index')->with('success', 'Data prestasi berhasil ditambahkan');
    }

    public function update(Request $request, PrestasiSekolah $prestasiSekolah)
    {
        $this->save($request, $prestasiSekolah);

        return redirect()->route('admin.prestasi-sekolah.index')->with('success', 'Data prestasi berhasil diperbarui');
    }

    public function destroy(PrestasiSekolah $prestasiSekolah)
    {
        $foto = $prestasiSekolah->foto;
        $prestasiSekolah->delete();

        // Berkas foto ikut dihapus bila tidak dipakai lagi oleh baris lain.
        $this->hapusBerkasYangTidakDipakai([$foto]);

        return redirect()->route('admin.prestasi-sekolah.index')->with('success', 'Data prestasi berhasil dihapus');
    }

    /** Kolom `foto` baru ada setelah `php artisan migrate` dijalankan. */
    protected function fotoReady(): bool
    {
        return Schema::hasColumn('prestasi_sekolah', 'foto');
    }

    /** URL foto yang dipakai kartu pada nomor kelompok ini (null bila belum ada). */
    protected function urlFotoKelompok(int $kelompok): ?string
    {
        $path = PrestasiSekolah::where('kelompok', $kelompok)->whereNotNull('foto')->value('foto');

        return $path ? Site::imageUrl($path) : null;
    }

    protected function save(Request $request, ?PrestasiSekolah $item): void
    {
        $data = $request->validate([
            'kelompok' => ['required', 'integer', 'min:1'],
            'nama_siswa' => ['required', 'string', 'min:2', 'max:191'],
            'nama_kejuaraan' => ['required', 'string', 'min:3', 'max:500'],
            'juara' => ['required', 'string', 'max:191'],
            'peringkat' => ['required', Rule::in(array_keys(PrestasiSekolah::PERINGKAT))],
            'tingkat' => ['nullable', 'string', 'max:150'],
            'kategori' => ['required', Rule::in(PrestasiSekolah::KATEGORI)],
            'tahun' => ['required', 'string', 'max:10'],
            'urutan' => ['nullable', 'integer'],
            'foto' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'hapus_foto' => ['nullable', 'boolean'],
        ], [
            'foto.image' => 'File foto harus berupa gambar.',
            'foto.mimes' => 'Foto harus berformat JPG, PNG, atau WebP.',
            'foto.max' => 'Ukuran foto maksimal 5 MB.',
        ]);

        $item = $item ?? new PrestasiSekolah();
        $item->kelompok = $data['kelompok'];
        $item->nama_siswa = $data['nama_siswa'];
        $item->nama_kejuaraan = $data['nama_kejuaraan'];
        $item->juara = $data['juara'];
        $item->peringkat = $data['peringkat'];
        $item->tingkat = $data['tingkat'] ?? null;
        $item->kategori = $data['kategori'];
        $item->tahun = $data['tahun'];
        $item->urutan = $data['urutan'] ?? $data['kelompok'];
        $item->save();

        if ($this->fotoReady()) {
            $this->simpanFoto($request, $item);
        }
    }

    /**
     * Foto milik satu kartu (satu nomor kelompok). Karena itu foto yang
     * diunggah, diganti, atau dihapus diterapkan ke SEMUA baris pada
     * kelompok yang sama supaya halaman publik selalu konsisten.
     */
    protected function simpanFoto(Request $request, PrestasiSekolah $item): void
    {
        $kelompok = (int) $item->kelompok;
        $grup = PrestasiSekolah::where('kelompok', $kelompok);

        if ($request->hasFile('foto')) {
            $fotoLama = (clone $grup)->whereNotNull('foto')->pluck('foto')->all();
            $fotoLama[] = $item->getOriginal('foto');

            $path = $request->file('foto')->store('prestasi', 'public');
            (clone $grup)->update(['foto' => $path]);

            $this->hapusBerkasYangTidakDipakai($fotoLama);

            return;
        }

        if ($request->boolean('hapus_foto')) {
            $fotoLama = (clone $grup)->whereNotNull('foto')->pluck('foto')->all();
            $fotoLama[] = $item->getOriginal('foto');

            (clone $grup)->update(['foto' => null]);

            $this->hapusBerkasYangTidakDipakai($fotoLama);

            return;
        }

        // Tanpa unggahan baru: baris ini mengikuti foto kelompoknya
        // (berguna saat menambah prestasi baru ke kartu yang sudah punya foto).
        $fotoKelompok = PrestasiSekolah::where('kelompok', $kelompok)
            ->where('id', '!=', $item->id)
            ->whereNotNull('foto')
            ->value('foto');

        if ($fotoKelompok && $item->foto !== $fotoKelompok) {
            $fotoSebelumnya = $item->foto;
            $item->foto = $fotoKelompok;
            $item->save();

            $this->hapusBerkasYangTidakDipakai([$fotoSebelumnya]);
        }
    }

    /**
     * Menghapus berkas foto dari disk hanya bila sudah tidak dipakai baris mana pun.
     *
     * @param  array<int, string|null>  $paths
     */
    protected function hapusBerkasYangTidakDipakai(array $paths): void
    {
        foreach (collect($paths)->filter()->unique() as $path) {
            if (! PrestasiSekolah::where('foto', $path)->exists()) {
                Storage::disk('public')->delete($path);
            }
        }
    }
}