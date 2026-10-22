<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GuruStaff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GuruStaffController extends Controller
{
    public function index()
    {
        return view('admin.guru-staff.index', [
            'site' => \App\Support\SiteData::all(),
            'guruStaff' => GuruStaff::orderBy('urutan')->orderBy('id')->get(),
        ]);
    }

    public function create()
    {
        return view('admin.guru-staff.form', [
            'site' => \App\Support\SiteData::all(),
            'item' => null,
            'kategoriOptions' => GuruStaff::URUTAN_KATEGORI,
        ]);
    }

    public function edit(GuruStaff $guruStaff)
    {
        return view('admin.guru-staff.form', [
            'site' => \App\Support\SiteData::all(),
            'item' => $guruStaff,
            'kategoriOptions' => GuruStaff::URUTAN_KATEGORI,
        ]);
    }

    public function store(Request $request)
    {
        $this->save($request, null);

        return redirect()->route('admin.guru-staff.index')->with('success', 'Data guru & staff berhasil ditambahkan');
    }

    public function update(Request $request, GuruStaff $guruStaff)
    {
        $this->save($request, $guruStaff);

        return redirect()->route('admin.guru-staff.index')->with('success', 'Data guru & staff berhasil diperbarui');
    }

    protected function save(Request $request, ?GuruStaff $guruStaff): void
    {
        $data = $request->validate([
            'nama_lengkap' => ['required', 'string', 'min:3', 'max:150'],
            'jabatan' => ['required', 'string', 'max:150'],
            'kategori' => ['required', 'string', 'max:100'],
            'urutan' => ['nullable', 'integer'],
            'foto' => ['nullable', 'image', 'max:5120'],
        ]);

        $guruStaff = $guruStaff ?? new GuruStaff();
        $guruStaff->nama_lengkap = $data['nama_lengkap'];
        $guruStaff->jabatan = $data['jabatan'];
        $guruStaff->kategori = $data['kategori'];
        $guruStaff->urutan = $data['urutan'] ?? $guruStaff->urutan ?? 0;

        if ($request->hasFile('foto')) {
            if ($guruStaff->foto) {
                Storage::disk('public')->delete($guruStaff->foto);
            }
            $guruStaff->foto = $request->file('foto')->store('guru-staff', 'public');
        }

        $guruStaff->save();
    }

    public function destroy(GuruStaff $guruStaff)
    {
        if ($guruStaff->foto) {
            Storage::disk('public')->delete($guruStaff->foto);
        }
        $guruStaff->delete();

        return redirect()->route('admin.guru-staff.index')->with('success', 'Data guru & staff berhasil dihapus');
    }
}