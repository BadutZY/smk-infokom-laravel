@extends('layouts.app')
@section('title', 'Halaman Tidak Ditemukan')

@php($site = $site ?? config('site'))

@section('content')
<section class="relative flex min-h-[80vh] items-center justify-center overflow-hidden bg-navy-radial px-4 py-20 text-center text-hero-foreground">
  <div class="pointer-events-none absolute inset-0 bg-grain"></div>
  <div class="hud-grid"></div>
  <canvas data-particles aria-hidden="true"></canvas>
  <span class="bg-orb float-y -left-16 top-10 h-64 w-64 bg-gold/25"></span>
  <span class="bg-orb float-y h-72 w-72 bg-teal/20" style="right:-4rem; bottom:-3rem; animation-delay:1.2s;"></span>

  <div class="relative">
    <span class="enter-item enter-d1 mx-auto flex h-20 w-20 items-center justify-center rounded-3xl bg-white/10 text-gold shadow-lift">
      <x-icon name="search" class="h-9 w-9" />
    </span>
    <p class="enter-item enter-d2 mt-6 font-display text-7xl font-extrabold text-gradient-gold sm:text-8xl">404</p>
    <h1 class="enter-item enter-d3 mt-3 font-display text-xl font-bold sm:text-2xl">Halaman tidak ditemukan</h1>
    <p class="enter-item enter-d4 mx-auto mt-2 max-w-md text-sm text-white/70">Halaman yang Anda cari tidak tersedia atau sudah dipindahkan. Yuk, coba salah satu tautan populer di bawah ini.</p>

    <div class="enter-item enter-d5 mt-8 flex flex-wrap items-center justify-center gap-3">
      <a href="{{ route('home') }}" class="shine inline-flex items-center gap-2 rounded-full bg-gold-gradient px-6 py-3 text-sm font-semibold text-gold-foreground shadow-lift transition-transform hover:-translate-y-0.5">
        <x-icon name="home" class="w-4 h-4" /> Kembali ke Beranda
      </a>
      <a href="{{ route('ppdb') }}" class="inline-flex items-center gap-2 rounded-full border border-white/25 px-6 py-3 text-sm font-semibold transition-colors hover:bg-white/10">
        Daftar PPDB
      </a>
      <a href="{{ route('kontak') }}" class="inline-flex items-center gap-2 rounded-full border border-white/25 px-6 py-3 text-sm font-semibold transition-colors hover:bg-white/10">
        Hubungi Kami
      </a>
    </div>
  </div>
</section>
@endsection
