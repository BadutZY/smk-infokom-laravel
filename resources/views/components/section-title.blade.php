@props(['kicker' => null, 'title', 'desc' => null, 'center' => true, 'light' => false])
{{-- Judul section. Label kecil (kicker) diberi penanda garis emas (warna bawaan situs),
     bukan lencana huruf kapital. Tambah :light="true" untuk latar gelap. --}}
<div {{ $attributes->class(['section-head', 'reveal', 'is-center' => $center, 'is-light' => $light]) }}>
  @if ($kicker)
    <span class="kicker {{ $light ? 'kicker--light' : '' }}"><i class="accent-mark" aria-hidden="true"></i>{{ $kicker }}</span>
  @endif
  <h2>{{ $title }}</h2>
  @if ($desc)
    <p>{{ $desc }}</p>
  @endif
</div>
