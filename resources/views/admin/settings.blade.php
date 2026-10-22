@extends('layouts.admin')
@section('title', 'Pengaturan')
@section('page-title', 'Pengaturan Akun')

@section('content')

<div class="grid gap-6 lg:grid-cols-5 lg:items-start">

  {{-- Kolom kiri: identitas akun --}}
  <div class="enter-item enter-d1 lg:col-span-2 lg:sticky lg:top-24">
    <div class="card-hover overflow-hidden rounded-2xl border border-border bg-card shadow-soft">
      <div class="relative overflow-hidden bg-navy-gradient px-7 py-9 text-center text-hero-foreground">
        <div class="pointer-events-none absolute -right-10 -top-10 h-32 w-32 rounded-full bg-white/5"></div>
        <div class="pointer-events-none absolute -bottom-12 -left-8 h-28 w-28 rounded-full bg-gold/10"></div>
        <span class="relative mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-white/15 text-2xl font-display font-bold">
          {{ strtoupper(substr(auth()->user()->nama_lengkap ?? auth()->user()->username ?? 'A', 0, 1)) }}
        </span>
        <p class="relative mt-4 font-display text-base font-bold">{{ auth()->user()->nama_lengkap ?? 'Admin' }}</p>
        <p class="relative text-xs text-white/70">{{ '@'.(auth()->user()->username ?? '-') }}</p>
        <span class="relative mt-3 inline-flex items-center gap-1.5 rounded-full bg-gold/20 px-3 py-1 text-[11px] font-semibold text-gold">
          <x-icon name="shield-check" class="w-3.5 h-3.5" /> Administrator
        </span>
      </div>
      <div class="space-y-4 p-7">
        <div class="flex items-start gap-3">
          <span class="mt-0.5 flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-accent text-primary"><x-icon name="lock" class="w-4 h-4" /></span>
          <div>
            <p class="text-sm font-semibold text-foreground">Keamanan Akun</p>
            <p class="mt-0.5 text-xs leading-relaxed text-muted-foreground">Gunakan kata sandi yang kuat dan jangan pernah membagikannya kepada siapa pun.</p>
          </div>
        </div>
        <div class="flex items-start gap-3">
          <span class="mt-0.5 flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-accent text-primary"><x-icon name="clock" class="w-4 h-4" /></span>
          <div>
            <p class="text-sm font-semibold text-foreground">Ganti Berkala</p>
            <p class="mt-0.5 text-xs leading-relaxed text-muted-foreground">Disarankan mengganti password admin secara rutin untuk menjaga keamanan sistem.</p>
          </div>
        </div>
        <div class="flex items-start gap-3">
          <span class="mt-0.5 flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-accent text-primary"><x-icon name="shield-check" class="w-4 h-4" /></span>
          <div>
            <p class="text-sm font-semibold text-foreground">Kombinasi Kuat</p>
            <p class="mt-0.5 text-xs leading-relaxed text-muted-foreground">Padukan huruf besar, huruf kecil, angka, dan simbol agar lebih sulit ditebak.</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  {{-- Kolom kanan: form ganti password --}}
  <div class="enter-item enter-d2 lg:col-span-3">
    <div class="card-hover rounded-2xl border border-border bg-card p-7 shadow-soft sm:p-9">
      <div class="flex items-center gap-3">
        <span class="flex h-11 w-11 items-center justify-center rounded-xl bg-accent text-primary"><x-icon name="lock" class="w-5 h-5" /></span>
        <div>
          <h3 class="font-display text-sm font-bold text-foreground">Ganti Password</h3>
          <p class="text-xs text-muted-foreground">Masuk sebagai {{ auth()->user()->username ?? '-' }}</p>
        </div>
      </div>

      <form method="POST" action="{{ route('admin.settings.update') }}" class="mt-7 grid gap-5" data-password-form>
        @csrf @method('PUT')

        <div>
          <label for="password_lama" class="text-sm font-medium text-foreground">Password Lama</label>
          <div class="relative mt-1.5">
            <x-icon name="lock" class="pointer-events-none absolute left-3.5 top-1/2 w-4 h-4 -translate-y-1/2 text-muted-foreground" />
            <input type="password" name="password_lama" id="password_lama" class="input-field pl-10 pr-11" placeholder="Masukkan password saat ini" />
            <button type="button" data-toggle-password="#password_lama" class="absolute inset-y-0 right-0 flex w-11 items-center justify-center text-muted-foreground">
              <x-icon name="eye" data-icon-eye class="w-4 h-4" />
              <x-icon name="eye-off" data-icon-eye-off class="hidden w-4 h-4" />
            </button>
          </div>
          @error('password_lama') <p class="mt-1.5 text-xs text-destructive">{{ $message }}</p> @enderror
        </div>

        <div class="h-px bg-border"></div>

        <div>
          <label for="password_baru" class="text-sm font-medium text-foreground">Password Baru</label>
          <div class="relative mt-1.5">
            <x-icon name="lock" class="pointer-events-none absolute left-3.5 top-1/2 w-4 h-4 -translate-y-1/2 text-muted-foreground" />
            <input type="password" name="password_baru" id="password_baru" data-password-strength-input class="input-field pl-10 pr-11" placeholder="Minimal 6 karakter" autocomplete="new-password" />
            <button type="button" data-toggle-password="#password_baru" class="absolute inset-y-0 right-0 flex w-11 items-center justify-center text-muted-foreground">
              <x-icon name="eye" data-icon-eye class="w-4 h-4" />
              <x-icon name="eye-off" data-icon-eye-off class="hidden w-4 h-4" />
            </button>
          </div>

          {{-- Indikator kekuatan password --}}
          <div data-password-strength class="mt-2.5 hidden">
            <div class="flex gap-1.5">
              <span data-strength-bar class="h-1.5 flex-1 rounded-full bg-border transition-colors duration-300"></span>
              <span data-strength-bar class="h-1.5 flex-1 rounded-full bg-border transition-colors duration-300"></span>
              <span data-strength-bar class="h-1.5 flex-1 rounded-full bg-border transition-colors duration-300"></span>
              <span data-strength-bar class="h-1.5 flex-1 rounded-full bg-border transition-colors duration-300"></span>
            </div>
            <p data-strength-label class="mt-1.5 text-xs font-medium text-muted-foreground">&nbsp;</p>
          </div>

          @error('password_baru') <p class="mt-1.5 text-xs text-destructive">{{ $message }}</p> @enderror
        </div>

        <div>
          <label for="konfirmasi_password" class="text-sm font-medium text-foreground">Konfirmasi Password Baru</label>
          <div class="relative mt-1.5">
            <x-icon name="lock" class="pointer-events-none absolute left-3.5 top-1/2 w-4 h-4 -translate-y-1/2 text-muted-foreground" />
            <input type="password" name="konfirmasi_password" id="konfirmasi_password" data-password-confirm-input class="input-field pl-10 pr-11" placeholder="Ulangi password baru" autocomplete="new-password" />
            <button type="button" data-toggle-password="#konfirmasi_password" class="absolute inset-y-0 right-0 flex w-11 items-center justify-center text-muted-foreground">
              <x-icon name="eye" data-icon-eye class="w-4 h-4" />
              <x-icon name="eye-off" data-icon-eye-off class="hidden w-4 h-4" />
            </button>
          </div>
          <p data-password-match class="mt-1.5 hidden items-center gap-1.5 text-xs font-medium"></p>
          @error('konfirmasi_password') <p class="mt-1.5 text-xs text-destructive">{{ $message }}</p> @enderror
        </div>

        <div class="flex items-center gap-2 rounded-xl bg-accent/60 px-4 py-3 text-xs text-primary">
          <x-icon name="info" class="w-4 h-4 shrink-0" />
          Password baru minimal 6 karakter dan sebaiknya kombinasi huruf serta angka.
        </div>

        <div class="mt-1 flex flex-wrap items-center gap-3">
          <button type="submit" class="shine inline-flex items-center justify-center gap-2 rounded-full bg-navy-gradient px-7 py-3 text-sm font-semibold text-hero-foreground shadow-soft transition-transform hover:-translate-y-0.5">
            <x-icon name="check" class="w-4 h-4" /> Simpan Perubahan
          </button>
        </div>
      </form>
    </div>
  </div>

</div>

@endsection