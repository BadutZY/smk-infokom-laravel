<?php

namespace App\Http\Controllers;

use App\Models\Ppdb;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Throwable;

class PpdbController extends Controller
{
    public function create()
    {
        return view('pages.ppdb', [
            'site' => \App\Support\SiteData::all(),
            'agamaList' => Ppdb::AGAMA,
        ]);
    }

    public function store(Request $request)
    {
        // Catatan: bila request dikirim lewat AJAX (header Accept: application/json),
        // kegagalan validasi otomatis dibalas Laravel sebagai JSON status 422
        // beserta daftar error per kolom. Modal status di halaman PPDB membacanya.
        $data = $request->validate([
            'nama' => ['required', 'string', 'min:3', 'max:100'],
            'nisn' => ['required', 'digits:10'],
            'tempat_lahir' => ['required', 'string', 'min:3', 'max:100'],
            'tanggal_lahir' => ['required', 'date', 'before:today'],
            'jenis_kelamin' => ['required', 'in:Laki-laki,Perempuan'],
            'agama' => ['required', 'string', Rule::in(Ppdb::AGAMA)],
            'asal_sekolah' => ['required', 'string', 'min:3', 'max:100'],
            'email' => ['required', 'email', 'max:100'],
            'telepon' => ['required', 'digits_between:10,15'],
            'nama_orang_tua' => ['required', 'string', 'min:3', 'max:100'],
            'telepon_orang_tua' => ['required', 'digits_between:10,15'],
            'pekerjaan_orang_tua' => ['nullable', 'string', 'max:100'],
            'pilihan1' => ['required', 'string'],
            'pilihan2' => ['required', 'string', 'different:pilihan1'],
            'alamat' => ['required', 'string', 'min:10', 'max:300'],
            'dokumen' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:5120'],
        ], [
            'required' => ':attribute wajib diisi.',
            'string' => ':attribute tidak valid.',
            'digits' => ':attribute harus terdiri dari :digits digit angka.',
            'digits_between' => ':attribute harus berupa angka sepanjang :min sampai :max digit.',
            'min.string' => ':attribute minimal :min karakter.',
            'max.string' => ':attribute maksimal :max karakter.',
            'email' => ':attribute tidak berformat valid.',
            'date' => ':attribute bukan tanggal yang valid.',
            'in' => ':attribute yang dipilih tidak valid.',
            'file' => ':attribute harus berupa berkas.',
            'uploaded' => 'Berkas gagal diunggah. Pastikan ukurannya tidak melebihi batas server.',
            'pilihan2.different' => 'Pilihan 1 dan pilihan 2 tidak boleh sama',
            'tanggal_lahir.before' => 'Tanggal lahir tidak valid.',
            'dokumen.mimes' => 'Berkas harus berformat PDF, JPG, atau PNG.',
            'dokumen.max' => 'Ukuran berkas maksimal 5 MB.',
        ], [
            'nama' => 'Nama lengkap',
            'nisn' => 'NISN',
            'tempat_lahir' => 'Tempat lahir',
            'tanggal_lahir' => 'Tanggal lahir',
            'jenis_kelamin' => 'Jenis kelamin',
            'agama' => 'Agama',
            'asal_sekolah' => 'Asal sekolah',
            'email' => 'Email',
            'telepon' => 'Nomor telepon siswa',
            'nama_orang_tua' => 'Nama orang tua/wali',
            'telepon_orang_tua' => 'Nomor telepon orang tua/wali',
            'pekerjaan_orang_tua' => 'Pekerjaan orang tua/wali',
            'pilihan1' => 'Pilihan jurusan 1',
            'pilihan2' => 'Pilihan jurusan 2',
            'alamat' => 'Alamat lengkap',
            'dokumen' => 'Dokumen pendukung',
        ]);

        $dokumenPath = null;

        try {
            // Unggahan dokumen pendukung bersifat opsional; simpan terpisah dari
            // $data karena Request::validate() menyertakan objek UploadedFile
            // di dalamnya (bukan string path yang cocok untuk kolom database).
            $dokumenPath = $request->hasFile('dokumen')
                ? $request->file('dokumen')->store('ppdb', 'public')
                : null;
            unset($data['dokumen']);

            $nomorPendaftaran = 'PPDB-'.strtoupper(base_convert((string) time(), 10, 36)).rand(10, 99);

            $ppdb = Ppdb::create([
                ...$data,
                'dokumen' => $dokumenPath,
                'nomor_pendaftaran' => $nomorPendaftaran,
                'created_at' => now(),
            ]);
        } catch (Throwable $e) {
            report($e);

            // Data gagal tersimpan: buang berkas yang sempat terunggah agar tidak menjadi yatim.
            if ($dokumenPath) {
                Storage::disk('public')->delete($dokumenPath);
            }

            $pesan = 'Terjadi kesalahan pada server saat menyimpan pendaftaran. '
                .'Data Anda belum tersimpan, silakan coba lagi beberapa saat lagi.';

            if ($request->expectsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => $pesan,
                ], 500);
            }

            return back()->withInput()->with('error', $pesan);
        }

        // Permintaan AJAX (modal status): balas JSON, halaman tidak perlu dimuat ulang.
        if ($request->expectsJson()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Pendaftaran berhasil dikirim.',
                'data' => [
                    'nomor_pendaftaran' => $ppdb->nomor_pendaftaran,
                    'nama' => $ppdb->nama,
                    'dokumen_terunggah' => $dokumenPath !== null,
                    'created_at' => $ppdb->created_at->toIso8601String(),
                ],
            ], 201);
        }

        // Cadangan bila JavaScript nonaktif: alur redirect lama tetap berfungsi.
        return redirect()->route('ppdb')
            ->with('ppdb_success', true)
            ->with('nomor_pendaftaran', $nomorPendaftaran);
    }
}