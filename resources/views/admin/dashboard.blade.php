@extends('layouts.admin')
@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')

@php
  $statCards = [
    [
      'icon' => 'newspaper',
      'iconClass' => 'bg-navy-gradient text-hero-foreground',
      'value' => $totalBerita,
      'label' => 'Total Berita',
      'tren' => $trenBerita,
    ],
    [
      'icon' => 'idcard',
      'iconClass' => 'bg-gold-gradient text-gold-foreground',
      'value' => $totalPpdb,
      'label' => 'Pendaftar PPDB',
      'tren' => $trenPpdb,
    ],
    [
      'icon' => 'message-square',
      'iconClass' => 'bg-teal text-teal-foreground',
      'value' => $totalKontak,
      'label' => 'Pesan Masuk',
      'tren' => $trenKontak,
    ],
    [
      'icon' => 'bell',
      'iconClass' => 'bg-destructive/10 text-destructive',
      'value' => $belumDibaca,
      'label' => 'Pesan Belum Dibaca',
      'tren' => null,
    ],
  ];
@endphp

{{-- Sapaan singkat --}}
<div class="reveal relative mb-6 overflow-hidden rounded-2xl bg-navy-radial px-6 py-7 text-hero-foreground shadow-soft sm:px-8">
  <div class="pointer-events-none absolute inset-0 bg-grain"></div>
  <span class="bg-orb h-40 w-40 bg-gold/20" style="right:-2rem; top:-2rem;"></span>
  <div class="relative flex flex-wrap items-center justify-between gap-4">
    <div>
      <p class="text-xs font-semibold uppercase tracking-widest text-gold">Selamat datang kembali</p>
      <h2 class="mt-1 font-display text-xl font-bold sm:text-2xl">{{ auth()->user()->nama_lengkap ?? 'Admin' }}</h2>
      <p class="mt-1 text-sm text-white/70">Berikut ringkasan aktivitas website sekolah hari ini.</p>
    </div>
    <a href="{{ route('home') }}" target="_blank" class="inline-flex items-center gap-2 rounded-full border border-white/20 bg-white/10 px-4 py-2 text-xs font-semibold transition-colors hover:bg-white/20">
      <x-icon name="home" class="w-3.5 h-3.5" /> Lihat Situs
    </a>
  </div>
</div>

{{-- Kartu statistik ringkas --}}
<div class="stagger-group grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
  @foreach ($statCards as $card)
    <div class="stagger-item card-hover group relative overflow-hidden rounded-2xl border border-border bg-card p-5 shadow-soft">
      <span class="pointer-events-none absolute -right-6 -top-6 h-24 w-24 rounded-full bg-primary/5 transition-transform duration-500 group-hover:scale-125"></span>

      <div class="relative flex items-start justify-between gap-3">
        <span @class([
            'flex h-12 w-12 shrink-0 items-center justify-center rounded-xl shadow-soft',
            $card['iconClass'],
            'dash-pulse' => $card['label'] === 'Pesan Belum Dibaca' && $card['value'] > 0,
        ])>
          <x-icon :name="$card['icon']" class="w-5 h-5" />
        </span>

        @if ($card['tren'])
          @php $arah = $card['tren']['arah']; @endphp
          <span @class([
              'inline-flex items-center gap-1 rounded-full px-2 py-1 text-[11px] font-bold',
              'bg-emerald-500/10 text-emerald-600' => $arah === 'naik',
              'bg-destructive/10 text-destructive' => $arah === 'turun',
              'bg-secondary text-muted-foreground' => $arah === 'tetap',
          ])>
            <x-icon :name="$arah === 'naik' ? 'trending-up' : ($arah === 'turun' ? 'trending-down' : 'minus')" class="w-3 h-3" />
            {{ $arah === 'tetap' ? '0%' : ($arah === 'naik' ? '+' : '') . $card['tren']['persen'] . '%' }}
          </span>
        @endif
      </div>

      <div class="relative mt-4 min-w-0">
        <p class="font-display text-2xl font-extrabold leading-tight text-foreground" data-countup="{{ $card['value'] }}">0</p>
        <p class="mt-1 truncate text-xs font-semibold text-muted-foreground">{{ $card['label'] }}</p>
      </div>

      @if ($card['tren'])
        <p class="relative mt-3 truncate text-[11px] text-muted-foreground">
          <span class="font-semibold text-foreground">{{ $card['tren']['bulan_ini'] }}</span> baru bulan ini &middot; {{ $card['tren']['bulan_lalu'] }} bulan lalu
        </p>
      @else
        <p class="relative mt-3 truncate text-[11px] text-muted-foreground">Perlu ditindaklanjuti segera</p>
      @endif
    </div>
  @endforeach
</div>

{{-- Grafik ringkas --}}
<div class="reveal mt-6 grid gap-5 lg:grid-cols-2">
  <div class="card-hover rounded-2xl border border-border bg-card p-5 shadow-soft">
    <div class="flex items-center justify-between">
      <div class="flex items-center gap-2.5">
        <span class="flex h-9 w-9 items-center justify-center rounded-xl bg-navy-gradient text-hero-foreground shadow-soft"><x-icon name="trending-up" class="w-4 h-4" /></span>
        <div>
          <h3 class="font-display text-sm font-bold leading-tight text-foreground">Berita per Kategori</h3>
          <p class="text-[11px] text-muted-foreground">Distribusi konten yang dipublikasikan</p>
        </div>
      </div>
      <span class="shrink-0 rounded-full bg-accent px-2.5 py-1 text-[11px] font-semibold text-primary">{{ $kategoriData->sum() }} total</span>
    </div>
    <div class="relative mt-5 h-56">
      @if ($kategoriData->sum() > 0)
        <canvas id="chartKategori"
          data-labels='@json($kategoriData->keys())'
          data-values='@json($kategoriData->values())'></canvas>
      @else
        <div class="flex h-full flex-col items-center justify-center gap-2 text-center">
          <span class="flex h-11 w-11 items-center justify-center rounded-full bg-secondary text-muted-foreground"><x-icon name="newspaper" class="w-5 h-5" /></span>
          <p class="text-xs font-medium text-muted-foreground">Belum ada data berita</p>
        </div>
      @endif
    </div>
  </div>

  <div class="card-hover rounded-2xl border border-border bg-card p-5 shadow-soft">
    <div class="flex items-center justify-between">
      <div class="flex items-center gap-2.5">
        <span class="flex h-9 w-9 items-center justify-center rounded-xl bg-gold-gradient text-gold-foreground shadow-soft"><x-icon name="message-square" class="w-4 h-4" /></span>
        <div>
          <h3 class="font-display text-sm font-bold leading-tight text-foreground">Status Pesan Masuk</h3>
          <p class="text-[11px] text-muted-foreground">Perbandingan pesan terbaca &amp; belum</p>
        </div>
      </div>
      <span class="shrink-0 rounded-full bg-accent px-2.5 py-1 text-[11px] font-semibold text-primary">{{ $belumDibaca + $sudahDibaca }} total</span>
    </div>
    <div class="relative mt-5 h-56">
      @if (($belumDibaca + $sudahDibaca) > 0)
        <canvas id="chartStatus"
          data-labels='@json(["Belum Dibaca", "Sudah Dibaca"])'
          data-values='@json([$belumDibaca, $sudahDibaca])'></canvas>
        <div class="pointer-events-none absolute inset-0 flex flex-col items-center justify-center">
          <span class="font-display text-2xl font-extrabold text-foreground">{{ $belumDibaca + $sudahDibaca }}</span>
          <span class="text-[11px] font-medium text-muted-foreground">Pesan</span>
        </div>
      @else
        <div class="flex h-full flex-col items-center justify-center gap-2 text-center">
          <span class="flex h-11 w-11 items-center justify-center rounded-full bg-secondary text-muted-foreground"><x-icon name="inbox" class="w-5 h-5" /></span>
          <p class="text-xs font-medium text-muted-foreground">Belum ada pesan masuk</p>
        </div>
      @endif
    </div>
  </div>
</div>

{{-- Tren aktivitas 7 hari terakhir --}}
<div class="reveal mt-6 rounded-2xl border border-border bg-card p-5 shadow-soft card-hover">
  <div class="flex flex-wrap items-center justify-between gap-3">
    <div class="flex items-center gap-2.5">
      <span class="flex h-9 w-9 items-center justify-center rounded-xl bg-accent text-primary shadow-soft"><x-icon name="activity" class="w-4 h-4" /></span>
      <div>
        <h3 class="font-display text-sm font-bold leading-tight text-foreground">Aktivitas 7 Hari Terakhir</h3>
        <p class="text-[11px] text-muted-foreground">Pendaftar PPDB &amp; pesan masuk per hari</p>
      </div>
    </div>
    <div class="flex items-center gap-4 text-[11px] font-semibold text-muted-foreground">
      <span class="flex items-center gap-1.5"><span class="h-2.5 w-2.5 rounded-full bg-primary"></span> PPDB</span>
      <span class="flex items-center gap-1.5"><span class="h-2.5 w-2.5 rounded-full bg-gold"></span> Pesan Masuk</span>
    </div>
  </div>
  <div class="relative mt-5 h-64">
    <canvas id="chartAktivitas"
      data-labels='@json($labelAktivitas)'
      data-ppdb='@json($ppdbHarian)'
      data-kontak='@json($kontakHarian)'></canvas>
  </div>
</div>

{{-- Aktivitas terbaru --}}
<div class="reveal mt-6 grid gap-5 lg:grid-cols-2">
  <div class="overflow-hidden rounded-2xl border border-border bg-card shadow-soft card-hover">
    <div class="flex items-center justify-between border-b border-border px-5 py-3.5">
      <h3 class="font-display text-sm font-bold text-foreground">Pendaftar PPDB Terbaru</h3>
      <a href="{{ route('admin.ppdb.index') }}" class="inline-flex items-center gap-1 text-xs font-semibold text-primary hover:underline">Lihat semua <x-icon name="arrow-right" class="w-3.5 h-3.5" /></a>
    </div>
    <div class="divide-y divide-border">
      @forelse ($ppdbTerbaru as $p)
        <div class="flex items-center gap-3 px-5 py-3 text-sm transition-colors hover:bg-secondary/50">
          <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-navy-gradient text-xs font-bold text-hero-foreground">
            {{ strtoupper(substr($p->nama, 0, 1)) }}
          </span>
          <div class="min-w-0 flex-1">
            <p class="truncate font-medium text-foreground">{{ $p->nama }}</p>
            <p class="truncate text-xs text-muted-foreground">{{ $p->pilihan1 }} &middot; {{ $p->asal_sekolah }}</p>
          </div>
          <span class="shrink-0 text-xs text-muted-foreground">{{ \App\Support\Site::formatTanggal($p->created_at) }}</span>
        </div>
      @empty
        <div class="flex flex-col items-center gap-2 px-5 py-8 text-center">
          <span class="flex h-11 w-11 items-center justify-center rounded-full bg-secondary text-muted-foreground"><x-icon name="idcard" class="w-5 h-5" /></span>
          <p class="text-sm text-muted-foreground">Belum ada pendaftar.</p>
        </div>
      @endforelse
    </div>
  </div>

  <div class="overflow-hidden rounded-2xl border border-border bg-card shadow-soft card-hover">
    <div class="flex items-center justify-between border-b border-border px-5 py-3.5">
      <h3 class="font-display text-sm font-bold text-foreground">Pesan Terbaru</h3>
      <a href="{{ route('admin.pesan.index') }}" class="inline-flex items-center gap-1 text-xs font-semibold text-primary hover:underline">Lihat semua <x-icon name="arrow-right" class="w-3.5 h-3.5" /></a>
    </div>
    <div class="divide-y divide-border">
      @forelse ($kontakTerbaru as $k)
        <div class="flex items-center gap-3 px-5 py-3 text-sm transition-colors hover:bg-secondary/50">
          <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-gold-gradient text-xs font-bold text-gold-foreground">
            {{ strtoupper(substr($k->nama, 0, 1)) }}
          </span>
          <div class="min-w-0 flex-1">
            <p class="truncate font-medium text-foreground">{{ $k->subjek }}</p>
            <p class="truncate text-xs text-muted-foreground">{{ $k->nama }}</p>
          </div>
          <span class="shrink-0 rounded-full px-2.5 py-1 text-[11px] font-semibold {{ $k->status === 'belum_dibaca' ? 'bg-gold/20 text-gold-foreground' : 'bg-secondary text-muted-foreground' }}">
            {{ $k->status === 'belum_dibaca' ? 'Baru' : 'Dibaca' }}
          </span>
        </div>
      @empty
        <div class="flex flex-col items-center gap-2 px-5 py-8 text-center">
          <span class="flex h-11 w-11 items-center justify-center rounded-full bg-secondary text-muted-foreground"><x-icon name="message-square" class="w-5 h-5" /></span>
          <p class="text-sm text-muted-foreground">Belum ada pesan.</p>
        </div>
      @endforelse
    </div>
  </div>
</div>

@endsection