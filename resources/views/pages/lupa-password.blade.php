@extends('layouts.app')
@section('title', 'Lupa Password')

@section('content')

<section class="relative flex min-h-[80vh] items-center justify-center overflow-hidden bg-navy-radial px-4 py-16 sm:px-6 lg:px-8">
  <div class="pointer-events-none absolute inset-0 bg-grain"></div>
  <div class="hud-grid"></div>
  <canvas data-particles aria-hidden="true"></canvas>
  <span class="bg-orb float-y -left-16 -top-10 h-64 w-64 bg-gold/20"></span>
  <span class="bg-orb float-y h-72 w-72 bg-teal/20" style="right:-4rem; bottom:-3rem; animation-delay:1.2s;"></span>

  <div class="enter-item enter-d1 relative w-full max-w-md">
    <div class="text-center text-hero-foreground">
      <span class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-white/10 text-gold shadow-lift">
        <x-icon name="lock" class="w-6 h-6" />
      </span>
      <h1 class="mt-4 font-display text-2xl font-bold">Lupa Password</h1>
      <p class="mt-1 text-sm text-white/70">Masukkan kode pemulihan untuk mengatur ulang password admin</p>
    </div>

    <div class="mt-8 rounded-3xl border border-border bg-card p-7 shadow-lift sm:p-9">
      <form method="POST" action="{{ route('lupa-password.submit') }}" class="grid gap-5">
        @csrf
        <div>
          <label for="username" class="text-sm font-medium text-foreground">Username</label>
          <input type="text" name="username" id="username" value="{{ old('username') }}" class="input-field" placeholder="Username admin" />
          @error('username') <p class="mt-1 text-xs text-destructive">{{ $message }}</p> @enderror
        </div>
        <div>
          <label for="kode_pemulihan" class="text-sm font-medium text-foreground">Kode Pemulihan</label>
          <input type="text" name="kode_pemulihan" id="kode_pemulihan" class="input-field" placeholder="Kode pemulihan rahasia" />
          @error('kode_pemulihan') <p class="mt-1 text-xs text-destructive">{{ $message }}</p> @enderror
        </div>
        <div>
          <label for="password_baru" class="text-sm font-medium text-foreground">Password Baru</label>
          <input type="password" name="password_baru" id="password_baru" class="input-field" placeholder="Minimal 6 karakter" />
          @error('password_baru') <p class="mt-1 text-xs text-destructive">{{ $message }}</p> @enderror
        </div>
        <div>
          <label for="konfirmasi_password" class="text-sm font-medium text-foreground">Konfirmasi Password</label>
          <input type="password" name="konfirmasi_password" id="konfirmasi_password" class="input-field" placeholder="Ulangi password baru" />
          @error('konfirmasi_password') <p class="mt-1 text-xs text-destructive">{{ $message }}</p> @enderror
        </div>
        <button type="submit" class="shine mt-2 inline-flex items-center justify-center gap-2 rounded-full bg-navy-gradient px-6 py-3.5 text-sm font-semibold text-hero-foreground shadow-lift transition-transform hover:-translate-y-0.5">
          Atur Ulang Password
        </button>
      </form>
      <a href="{{ route('login') }}" class="mt-5 block text-center text-sm font-medium text-primary hover:underline">Kembali ke halaman login</a>
    </div>
  </div>
</section>

@endsection
