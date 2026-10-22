<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SettingsController extends Controller
{
    public function edit()
    {
        return view('admin.settings', [
            'site' => \App\Support\SiteData::all(),
        ]);
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'password_lama' => ['required', 'string'],
            'password_baru' => ['required', 'string', 'min:6'],
            'konfirmasi_password' => ['required', 'string', 'same:password_baru'],
        ], [
            'konfirmasi_password.same' => 'Konfirmasi password tidak sama',
        ]);

        $admin = Auth::user();

        if (! Hash::check($data['password_lama'], $admin->password)) {
            return back()->withErrors(['password_lama' => 'Password lama yang Anda masukkan salah']);
        }

        $admin->update(['password' => Hash::make($data['password_baru'])]);

        return back()->with('success', 'Password berhasil diubah');
    }
}
