<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }

        return view('pages.login', [
            'site' => \App\Support\SiteData::all(),
        ]);
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        if (! Auth::attempt($credentials, true)) {
            return back()
                ->withErrors(['username' => 'Username atau password salah'])
                ->onlyInput('username');
        }

        $request->session()->regenerate();

        return redirect()->intended(route('admin.dashboard'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    public function showForgot()
    {
        return view('pages.lupa-password', [
            'site' => \App\Support\SiteData::all(),
        ]);
    }

    public function forgot(Request $request)
    {
        $data = $request->validate([
            'username' => ['required', 'string'],
            'kode_pemulihan' => ['required', 'string'],
            'password_baru' => ['required', 'string', 'min:6'],
            'konfirmasi_password' => ['required', 'string', 'same:password_baru'],
        ], [
            'konfirmasi_password.same' => 'Konfirmasi password tidak sama',
        ]);

        if (! hash_equals((string) config('site.recovery_code'), $data['kode_pemulihan'])) {
            return back()->withErrors(['kode_pemulihan' => 'Kode pemulihan salah'])->onlyInput('username');
        }

        $admin = Admin::where('username', $data['username'])->first();

        if (! $admin) {
            return back()->withErrors(['username' => 'Username admin tidak ditemukan']);
        }

        $admin->update(['password' => Hash::make($data['password_baru'])]);

        return redirect()->route('login')->with('reset_success', true);
    }
}
