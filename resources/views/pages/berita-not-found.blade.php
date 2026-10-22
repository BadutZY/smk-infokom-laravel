@extends('layouts.app')
@section('title', 'Berita Tidak Ditemukan')

@section('content')
<section class="relative flex min-h-[65vh] items-center justify-center overflow-hidden bg-navy-radial px-4 py-20 text-center text-hero-foreground">
  <div class="pointer-events-none absolute inset-0 bg-grain"></div>
  <span class="bg-orb float-y -left-16 top-6 h-56 w-56 bg-teal/20"></span>
  <span class="bg-orb float-y h-64 w-64 bg-gold/20" style="right:-3.5rem; bottom:-2.5rem; animation-delay:1s;"></span>

  <div class="relative">
    <span class="enter-item enter-d1 mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-white/10 text-gold shadow-lift">
      <x-icon name="newspaper" class="h-7 w-7" />
    </span>
    <p class="enter-item enter-d2 mt-5 font-display text-5xl font-extrabold text-gradient-gold">404</p>
    <h1 class="enter-item enter-d3 mt-3 font-display text-xl font-bold">Berita tidak ditemukan</h1>
    <p class="enter-item enter-d4 mx-auto mt-2 max-w-sm text-sm text-white/70">Berita yang Anda cari mungkin sudah dihapus atau tidak tersedia.</p>
    <a href="{{ route('berita.index') }}" class="shine enter-item enter-d5 mt-7 inline-flex items-center gap-2 rounded-full bg-gold-gradient px-6 py-3 text-sm font-semibold text-gold-foreground shadow-lift transition-transform hover:-translate-y-0.5">
      <x-icon name="arrow-left" class="w-4 h-4" /> Kembali ke Berita
    </a>
  </div>
</section>
@endsection
