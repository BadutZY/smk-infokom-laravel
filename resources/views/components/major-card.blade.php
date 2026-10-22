@props(['major', 'href' => null])
{{-- Kartu jurusan dengan border luar berwarna identitas jurusan ($major['color'], diatur admin).
     $major: array dengan kunci code, slug, name, desc, image, color (lihat SiteData::all()['majors']). --}}
@php
  $url = $href ?? (! empty($major['slug']) ? route('akademik.jurusan', $major['slug']) : route('akademik'));
@endphp
<a href="{{ $url }}" {{ $attributes->class(['major-tile', 'group']) }} style="--major: {{ $major['color'] ?? '#2563EB' }}" aria-label="{{ $major['name'] }} ({{ $major['code'] }})">
  <span class="major-tile__glow" aria-hidden="true"></span>
  <div class="major-tile__media">
    <img src="{{ \App\Support\Site::imageUrl($major['image']) }}" alt="" loading="lazy" />
    <span class="major-tile__code">{{ $major['code'] }}</span>
  </div>
  <div class="major-tile__body">
    <h3>{{ $major['name'] }}</h3>
    <p>{{ $major['desc'] }}</p>
    <span class="major-tile__cta">Lihat program <x-icon name="arrow-right" class="w-4 h-4" /></span>
  </div>
</a>
