@props(['kicker' => null, 'title', 'desc' => null, 'crumb' => null, 'accent' => null, 'parent' => null])
{{-- Hero halaman dalam. Rata kiri + breadcrumb. Empat busur "sinyal" di sudut kanan-bawah
     digambar bertahap saat halaman dibuka. Warnanya emas (warna bawaan situs). Warna jurusan
     HANYA dipakai bila $accent diisi, yaitu di halaman detail jurusan. --}}
@php
  $arcs = [[80, 125.66], [140, 219.91], [200, 314.16], [260, 408.41]];
  $arcAlpha = $accent ? 1 : 0.8; // emas dibuat sedikit lebih lembut daripada warna jurusan
@endphp
<section class="page-hero hero-inner relative overflow-hidden bg-navy-radial text-hero-foreground">
  <div class="pointer-events-none absolute inset-0 bg-grain"></div>
  <span class="bg-orb float-y -left-16 -top-16 h-64 w-64 bg-gold/20"></span>
  @if ($accent)
    <span class="bg-orb" style="right:8%; bottom:-6rem; width:22rem; height:22rem; background: {{ $accent }}; opacity:.22;"></span>
  @endif
  <div class="hud-grid"></div>
  <canvas data-particles aria-hidden="true"></canvas>

  <svg class="hero-arcs" viewBox="0 0 400 400" aria-hidden="true" @if ($accent) style="--arc: {{ $accent }}" @endif>
    @foreach ($arcs as $k => [$r, $len])
      <path d="M {{ 400 - $r }} 400 A {{ $r }} {{ $r }} 0 0 1 400 {{ 400 - $r }}"
            opacity="{{ number_format($arcAlpha * (1 - $k * 0.2), 2) }}"
            style="--len: {{ $len }}; --k: {{ $k }};" />
    @endforeach
  </svg>

  <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
    <nav class="hero-crumb enter-item enter-d1" aria-label="Breadcrumb">
      <a href="{{ route('home') }}">Beranda</a><span aria-hidden="true">/</span>@if ($parent)<a href="{{ $parent['to'] }}">{{ $parent['label'] }}</a><span aria-hidden="true">/</span>@endif<span aria-current="page">{{ $crumb ?? \Illuminate\Support\Str::limit($title, 32) }}</span>
    </nav>
    @if ($kicker)
      <p class="kicker kicker--light enter-item enter-d2 mt-7"><i class="accent-mark" aria-hidden="true" @if ($accent) style="background: {{ $accent }}" @endif></i>{{ $kicker }}</p>
    @endif
    <h1 data-split style="--d:.18s">{{ $title }}</h1>
    @if ($desc)
      <p class="hero-desc enter-item enter-d4">{{ $desc }}</p>
    @endif
  </div>

  <span class="accent-bar absolute inset-x-0 bottom-0" aria-hidden="true" @if ($accent) style="background: {{ $accent }}" @endif></span>
</section>
