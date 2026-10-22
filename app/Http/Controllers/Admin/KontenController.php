<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProfilSekolah;
use App\Support\KontenResource;
use App\Support\SiteData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class KontenController extends Controller
{
    /**
     * Bersihkan HTML entity (&amp;, &nbsp;, &quot;, dst) dari teks yang
     * diketik/paste admin, supaya tidak ter-encode dua kali saat ditampilkan
     * (Blade sudah otomatis meng-escape "&" jadi "&amp;" saat render, jadi
     * kalau yang tersimpan di database sudah "&amp;", hasilnya jadi
     * "&amp;amp;" -> tampil sebagai teks "&amp;" di halaman publik).
     */
    protected static function cleanText(?string $value): ?string
    {
        if ($value === null) {
            return null;
        }

        // Bisa ke-encode berkali-kali (mis. "&amp;amp;"), jadi decode
        // berulang sampai tidak ada lagi entity yang berubah.
        do {
            $decoded = html_entity_decode($value, ENT_QUOTES | ENT_HTML5, 'UTF-8');
            $changed = $decoded !== $value;
            $value = $decoded;
        } while ($changed);

        return $value;
    }

    /**
     * Halaman "Profil Sekolah": form identitas/kontak/visi Profil Sekolah
     * (singleton) + tab untuk resource yang termasuk grup "profil"
     * (statistik beranda, pengumuman, misi, tujuan, kerjasama universitas
     * & industri). Fasilitas punya halaman sendiri: lihat fasilitas().
     */
    public function profil(Request $request)
    {
        return $this->renderGroup('profil', $request, [
            'profil' => ProfilSekolah::first(),
        ]);
    }

    /**
     * Halaman "Fasilitas Sekolah": kelola kartu fasilitas (nama, kategori,
     * deskripsi, ikon, dan foto) yang tampil di halaman publik /fasilitas.
     * Dipisah dari Profil Sekolah supaya punya menu sendiri di sidebar admin.
     */
    public function fasilitas(Request $request)
    {
        return $this->renderGroup('fasilitas', $request);
    }

    /**
     * Halaman "Akademik": jurusan, kalender akademik, ekstrakurikuler, FAQ.
     */
    public function akademik(Request $request)
    {
        return $this->renderGroup('akademik', $request);
    }

    /**
     * Halaman "Konten PPDB": alur pendaftaran, jadwal, syarat, dan rincian
     * biaya PPDB (terpisah dari "Data PPDB" yang berisi data pendaftar).
     */
    public function ppdb(Request $request)
    {
        return $this->renderGroup('ppdb', $request);
    }

    /**
     * Halaman "Galeri": kelola foto galeri.
     */
    public function galeri(Request $request)
    {
        return $this->renderGroup('galeri', $request);
    }

    /**
     * Render halaman index untuk satu grup konten (profil/fasilitas/akademik/ppdb/galeri).
     * Setiap grup punya view sendiri: admin.konten.{group}.
     */
    protected function renderGroup(string $group, Request $request, array $extra = [])
    {
        $groups = KontenResource::groups();
        abort_unless(array_key_exists($group, $groups), 404);

        $resources = KontenResource::forGroup($group);

        $tab = $request->query('tab', array_key_first($resources));
        if (! array_key_exists($tab, $resources)) {
            $tab = array_key_first($resources);
        }

        $rows = $tab ? $resources[$tab]['model']::orderBy('urutan')->orderBy('id')->get() : collect();

        return view("admin.konten.{$group}", array_merge([
            'site' => SiteData::all(),
            'group' => $group,
            'groupMeta' => $groups[$group],
            'resources' => $resources,
            'tab' => $tab,
            'rows' => $rows,
        ], $extra));
    }

    /**
     * Simpan perubahan Profil Sekolah (data singleton: identitas, kontak,
     * gambar hero/siswa, dan total biaya PPDB per gelombang). Visi sekolah
     * diedit terpisah lewat updateVisi() pada tab "Visi & Misi".
     */
    public function updateProfil(Request $request)
    {
        $data = $request->validate([
            'nama' => ['required', 'string', 'max:200'],
            'nama_singkat' => ['required', 'string', 'max:100'],
            'brand_atas' => ['required', 'string', 'max:100'],
            'brand_bawah' => ['required', 'string', 'max:100'],
            'tagline' => ['required', 'string'],
            'sejarah' => ['nullable', 'string'],
            'kata_pengantar' => ['nullable', 'string'],
            'alamat' => ['required', 'string'],
            'telepon' => ['required', 'string', 'max:50'],
            'whatsapp' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'email', 'max:100'],
            'jam_operasional' => ['required', 'string', 'max:100'],
            'kepala_sekolah' => ['required', 'string', 'max:150'],
            'gambar_hero' => ['nullable', 'image', 'max:5120'],
            'gambar_siswa' => ['nullable', 'image', 'max:5120'],
            'gambar_kepala_sekolah' => ['nullable', 'image', 'max:5120'],
            'total_biaya_gelombang1' => ['required', 'integer', 'min:0'],
            'total_biaya_gelombang2' => ['required', 'integer', 'min:0'],
            'total_biaya_gelombang3' => ['required', 'integer', 'min:0'],
        ]);

        $textFields = ['nama', 'nama_singkat', 'brand_atas', 'brand_bawah', 'tagline', 'sejarah', 'kata_pengantar', 'alamat', 'telepon', 'whatsapp', 'email', 'jam_operasional', 'kepala_sekolah'];
        foreach ($textFields as $field) {
            if (array_key_exists($field, $data)) {
                $data[$field] = self::cleanText($data[$field]);
            }
        }

        $profil = ProfilSekolah::first() ?? new ProfilSekolah();
        $profil->fill(collect($data)->except(['gambar_hero', 'gambar_siswa', 'gambar_kepala_sekolah'])->all());

        foreach (['gambar_hero', 'gambar_siswa', 'gambar_kepala_sekolah'] as $field) {
            if ($request->hasFile($field)) {
                // Hanya hapus file lama dari storage jika memang berasal dari
                // upload (bukan gambar bawaan di public/images).
                if ($profil->$field && ! Str::startsWith($profil->$field, 'images/')) {
                    Storage::disk('public')->delete($profil->$field);
                }
                $profil->$field = $request->file($field)->store('profil', 'public');
            }
        }

        $profil->save();

        return back()->with('success', 'Profil sekolah berhasil diperbarui');
    }

    /**
     * Simpan perubahan "Visi" sekolah saja. Dipisah dari updateProfil()
     * supaya Visi bisa diedit langsung dari tab "Visi & Misi" (bersebelahan
     * dengan poin-poin Misi), tanpa perlu mengisi ulang seluruh form
     * identitas & kontak yang panjang.
     */
    public function updateVisi(Request $request)
    {
        $data = $request->validate([
            'visi' => ['required', 'string'],
        ]);

        $profil = ProfilSekolah::first() ?? new ProfilSekolah();
        $profil->visi = self::cleanText($data['visi']);
        $profil->save();

        return redirect()->route('admin.konten.profil', ['tab' => 'misi'])
            ->with('success', 'Visi sekolah berhasil diperbarui');
    }

    public function create(string $group, string $resource)
    {
        $def = $this->resourceOrAbort($group, $resource);

        return view('admin.konten.form', [
            'site' => SiteData::all(),
            'group' => $group,
            'resource' => $resource,
            'def' => $def,
            'item' => null,
        ]);
    }

    public function edit(string $group, string $resource, int $id)
    {
        $def = $this->resourceOrAbort($group, $resource);
        $item = $def['model']::findOrFail($id);

        return view('admin.konten.form', [
            'site' => SiteData::all(),
            'group' => $group,
            'resource' => $resource,
            'def' => $def,
            'item' => $item,
        ]);
    }

    public function store(Request $request, string $group, string $resource)
    {
        $def = $this->resourceOrAbort($group, $resource);
        $this->save($request, $resource, $def, null);

        return redirect()->route(KontenResource::backRoute($group), ['tab' => $resource])
            ->with('success', ucfirst($def['item_label'] ?? $def['label']).' berhasil ditambahkan');
    }

    public function update(Request $request, string $group, string $resource, int $id)
    {
        $def = $this->resourceOrAbort($group, $resource);
        $item = $def['model']::findOrFail($id);
        $this->save($request, $resource, $def, $item);

        return redirect()->route(KontenResource::backRoute($group), ['tab' => $resource])
            ->with('success', ucfirst($def['item_label'] ?? $def['label']).' berhasil diperbarui');
    }

    public function destroy(string $group, string $resource, int $id)
    {
        $def = $this->resourceOrAbort($group, $resource);
        $item = $def['model']::findOrFail($id);

        foreach ($def['fields'] as $name => $field) {
            if (($field['type'] ?? null) === 'image' && $item->$name) {
                Storage::disk('public')->delete($item->$name);
            }
        }

        $item->delete();

        return redirect()->route(KontenResource::backRoute($group), ['tab' => $resource])
            ->with('success', ucfirst($def['item_label'] ?? $def['label']).' berhasil dihapus');
    }

    /**
     * Pastikan {resource} dari URL memang terdaftar di KontenResource
     * (whitelist) DAN memang bagian dari {group} yang bersangkutan, supaya
     * tidak bisa dipakai untuk mengakses model lain lewat URL grup yang salah.
     */
    protected function resourceOrAbort(string $group, string $resource): array
    {
        abort_unless(array_key_exists($group, KontenResource::groups()), 404);

        $resources = KontenResource::forGroup($group);
        abort_unless(array_key_exists($resource, $resources), 404);

        return $resources[$resource];
    }

    protected function save(Request $request, string $resource, array $def, $item): void
    {
        $model = $def['model'];
        $isNew = $item === null;

        $rules = ['urutan' => ['nullable', 'integer']];
        foreach ($def['fields'] as $name => $field) {
            $fieldRules = $field['rules'];

            // Saat edit, field bertipe gambar tidak wajib diisi ulang
            // (kosongkan input file = gambar lama tetap dipakai).
            if (($field['type'] ?? null) === 'image' && ! $isNew) {
                $fieldRules = str_replace('required', 'nullable', $fieldRules);
            }

            $rules[$name] = explode('|', $fieldRules);
        }

        $data = $request->validate($rules);

        $item = $item ?? new $model();

        $item->urutan = $data['urutan']
            ?? $item->urutan
            ?? ((int) $model::max('urutan') + 1);

        foreach ($def['fields'] as $name => $field) {
            $type = $field['type'] ?? 'text';

            if ($type === 'image') {
                if ($request->hasFile($name)) {
                    if ($item->$name) {
                        Storage::disk('public')->delete($item->$name);
                    }
                    $item->$name = $request->file($name)->store($resource, 'public');
                }

                continue;
            }

            if ($type === 'color') {
                // Kolom belum ada (migrasi belum dijalankan)? Lewati saja supaya
                // menyimpan data lain tidak error. Jalankan `php artisan migrate`.
                if (! Schema::hasColumn($item->getTable(), $name)) {
                    continue;
                }

                $hex = strtoupper(trim((string) ($data[$name] ?? '')));
                $item->$name = preg_match('/^#[0-9A-F]{6}$/', $hex) ? $hex : null;

                continue;
            }

            if ($type === 'lines') {
                $item->$name = collect(preg_split('/\r\n|\r|\n/', (string) ($data[$name] ?? '')))
                    ->map(fn ($line) => self::cleanText(trim($line)))
                    ->filter(fn ($line) => $line !== '')
                    ->values()
                    ->all();

                continue;
            }

            $item->$name = in_array($type, ['text', 'textarea'], true)
                ? self::cleanText($data[$name] ?? null)
                : ($data[$name] ?? null);
        }

        $item->save();
    }
}