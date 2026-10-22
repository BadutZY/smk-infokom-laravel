@extends('layouts.app')
@section('title', 'Kontak')

@section('content')

<x-page-hero kicker="Hubungi Kami" title="Kontak SMK INFOKOM" desc="Kami siap membantu menjawab pertanyaan seputar sekolah maupun pendaftaran." />

<section class="section-pad px-4 sm:px-6 lg:px-8">
  <div class="mx-auto grid max-w-6xl gap-10 lg:grid-cols-5">

    <div class="stagger-group space-y-5 lg:col-span-2">
      <div class="stagger-item tilt-glow rounded-2xl border border-border bg-card p-6 shadow-soft">
        <div class="flex gap-4">
          <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-accent text-primary"><x-icon name="map-pin" class="w-5 h-5" /></span>
          <div>
            <p class="text-sm font-bold text-foreground">Alamat</p>
            <p class="mt-1 text-sm text-muted-foreground">{{ $site['school']['address'] }}</p>
          </div>
        </div>
      </div>
      <div class="stagger-item tilt-glow rounded-2xl border border-border bg-card p-6 shadow-soft">
        <div class="flex gap-4">
          <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-accent text-primary"><x-icon name="phone" class="w-5 h-5" /></span>
          <div>
            <p class="text-sm font-bold text-foreground">Telepon & WhatsApp</p>
            <p class="mt-1 text-sm text-muted-foreground">{{ $site['school']['phone'] }}</p>
            <p class="text-sm text-muted-foreground">{{ $site['school']['whatsapp'] }}</p>
          </div>
        </div>
      </div>
      <div class="stagger-item tilt-glow rounded-2xl border border-border bg-card p-6 shadow-soft">
        <div class="flex gap-4">
          <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-accent text-primary"><x-icon name="mail" class="w-5 h-5" /></span>
          <div>
            <p class="text-sm font-bold text-foreground">Email</p>
            <p class="mt-1 text-sm text-muted-foreground">{{ $site['school']['email'] }}</p>
          </div>
        </div>
      </div>
      <div class="stagger-item tilt-glow rounded-2xl border border-border bg-card p-6 shadow-soft">
        <div class="flex gap-4">
          <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-accent text-primary"><x-icon name="clock" class="w-5 h-5" /></span>
          <div>
            <p class="text-sm font-bold text-foreground">Jam Operasional</p>
            <p class="mt-1 text-sm text-muted-foreground">{{ $site['school']['hours'] }}</p>
          </div>
        </div>
      </div>

      <div class="stagger-item flex items-center gap-3 pt-2">
        <span class="text-xs font-semibold uppercase tracking-wider text-muted-foreground">Ikuti Kami</span>
        <span class="h-px flex-1 bg-border"></span>
        <a href="#" aria-label="Facebook" class="flex h-9 w-9 items-center justify-center rounded-full bg-accent text-primary transition-all duration-300 hover:-translate-y-1 hover:bg-navy-gradient hover:text-hero-foreground"><x-icon name="facebook" class="w-4 h-4" /></a>
        <a href="#" aria-label="Instagram" class="flex h-9 w-9 items-center justify-center rounded-full bg-accent text-primary transition-all duration-300 hover:-translate-y-1 hover:bg-navy-gradient hover:text-hero-foreground"><x-icon name="instagram" class="w-4 h-4" /></a>
        <a href="#" aria-label="YouTube" class="flex h-9 w-9 items-center justify-center rounded-full bg-accent text-primary transition-all duration-300 hover:-translate-y-1 hover:bg-navy-gradient hover:text-hero-foreground"><x-icon name="youtube" class="w-4 h-4" /></a>
      </div>
    </div>

    <div class="reveal lg:col-span-3">
      <div class="rounded-3xl border border-border bg-card p-7 shadow-lift sm:p-10">

        @if (session('kontak_success'))
          <div class="mb-6 flex items-center gap-3 rounded-2xl bg-accent p-5">
            <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-primary text-primary-foreground"><x-icon name="check" class="w-5 h-5" /></span>
            <p class="text-sm text-foreground">Pesan Anda berhasil terkirim. Kami akan segera merespons.</p>
          </div>
        @endif

        <form method="POST" action="{{ route('kontak.store') }}" class="grid gap-5">
          @csrf
          <div class="grid gap-5 sm:grid-cols-2">
            <div>
              <label for="nama" class="text-sm font-medium text-foreground">Nama Lengkap</label>
              <input type="text" name="nama" id="nama" value="{{ old('nama') }}" class="input-field" placeholder="Nama Anda" />
              @error('nama') <p class="mt-1 text-xs text-destructive">{{ $message }}</p> @enderror
            </div>
            <div>
              <label for="email" class="text-sm font-medium text-foreground">Email</label>
              <input type="email" name="email" id="email" value="{{ old('email') }}" class="input-field" placeholder="nama@email.com" />
              @error('email') <p class="mt-1 text-xs text-destructive">{{ $message }}</p> @enderror
            </div>
          </div>
          <div>
            <label for="subjek" class="text-sm font-medium text-foreground">Subjek</label>
            <input type="text" name="subjek" id="subjek" value="{{ old('subjek') }}" class="input-field" placeholder="Topik pesan Anda" />
            @error('subjek') <p class="mt-1 text-xs text-destructive">{{ $message }}</p> @enderror
          </div>
          <div>
            <label for="pesan" class="text-sm font-medium text-foreground">Pesan</label>
            <textarea name="pesan" id="pesan" rows="5" class="input-field" placeholder="Tulis pesan Anda di sini">{{ old('pesan') }}</textarea>
            @error('pesan') <p class="mt-1 text-xs text-destructive">{{ $message }}</p> @enderror
          </div>
          <button type="submit" class="shine mt-2 inline-flex items-center justify-center gap-2 rounded-full bg-navy-gradient px-6 py-3.5 text-sm font-semibold text-hero-foreground shadow-lift transition-transform hover:-translate-y-0.5">
            Kirim Pesan <x-icon name="arrow-right" class="w-4 h-4" />
          </button>
        </form>
      </div>
    </div>
  </div>
</section>

<section class="px-4 pb-20 sm:px-6 lg:px-8">
  <div class="reveal mx-auto max-w-6xl overflow-hidden rounded-3xl border border-border shadow-soft">
    <iframe
      title="Lokasi SMK INFOKOM Kota Bogor"
      src="https://maps.google.com/maps?q={{ urlencode($site['school']['address']) }}&t=&z=15&ie=UTF8&iwloc=&output=embed"
      class="h-80 w-full sm:h-96" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
  </div>
</section>

@endsection
