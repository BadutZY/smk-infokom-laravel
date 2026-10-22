@extends('layouts.admin')
@section('title', 'Fasilitas Sekolah')
@section('page-title', 'Kelola Fasilitas Sekolah')

@section('content')

@php
  // Halaman ini khusus fasilitas (terpisah dari Profil Sekolah). Datanya berasal dari
  // KontenController::fasilitas() -> $rows, dan CRUD-nya memakai route generik
  // admin.konten.create / edit / destroy dengan group "fasilitas".
  $def = $resources['fasilitas'];
  $itemLabel = $def['item_label'] ?? 'Fasilitas';
  $totalRows = $rows->count();
  $tanpaFoto = $rows->filter(fn ($r) => empty($r->gambar))->count();
  $jumlahKategori = $rows->map(fn ($r) => $r->kategori ?: 'Sarana & Prasarana')->unique()->count();
@endphp

<style>
  .fasadm-head { display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 1rem; }
  .fasadm-stats { display: flex; flex-wrap: wrap; gap: 0.6rem; }
  .fasadm-stat {
    display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.5rem 0.95rem; border-radius: 999px;
    font-size: 0.8rem; font-weight: 600; color: var(--muted-foreground);
    background: var(--card); border: 1px solid var(--border); box-shadow: var(--shadow-soft);
  }
  .fasadm-stat b { font-family: var(--font-display); font-size: 0.95rem; color: var(--foreground); }
  .fasadm-stat.is-warn { color: oklch(0.45 0.12 70); background: oklch(0.96 0.05 90); border-color: oklch(0.86 0.1 85); }
  .fasadm-stat.is-warn b { color: oklch(0.4 0.12 60); }

  .fasadm-tip {
    display: flex; gap: 0.85rem; align-items: flex-start; margin-top: 1.25rem; padding: 1rem 1.2rem; border-radius: 1.1rem;
    font-size: 0.85rem; line-height: 1.6; color: var(--muted-foreground);
    background: oklch(from var(--gold) l c h / 0.1); border: 1px solid oklch(from var(--gold) l c h / 0.35);
  }
  .fasadm-tip svg { flex: none; width: 1.15rem; height: 1.15rem; margin-top: 0.15rem; color: oklch(0.55 0.15 70); }
  .fasadm-tip b { color: var(--foreground); }

  .fasadm-grid { display: grid; gap: 1.25rem; margin-top: 1.5rem; grid-template-columns: repeat(1, minmax(0, 1fr)); }
  @media (min-width: 640px) { .fasadm-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); } }
  @media (min-width: 1280px) { .fasadm-grid { grid-template-columns: repeat(3, minmax(0, 1fr)); } }

  .fasadm-card {
    display: flex; flex-direction: column; overflow: hidden; border-radius: 1.25rem;
    background: var(--card); border: 1px solid var(--border); box-shadow: var(--shadow-soft);
    transition: transform 0.45s var(--ease-out), box-shadow 0.45s var(--ease-out), border-color 0.4s ease;
  }
  @media (hover: hover) {
    .fasadm-card:hover { transform: translateY(-5px); box-shadow: var(--shadow-lift); border-color: oklch(from var(--gold) l c h / 0.5); }
    .fasadm-card:hover .fasadm-media img { transform: scale(1.06); }
  }
  .fasadm-media {
    position: relative; aspect-ratio: 16 / 9; overflow: hidden;
    background: var(--gradient-navy-radial); color: var(--hero-foreground);
  }
  .fasadm-media img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.9s var(--ease-out); }
  .fasadm-ph { position: absolute; inset: 0; display: grid; place-items: center; }
  .fasadm-ph span {
    display: grid; place-items: center; width: 4.25rem; height: 4.25rem; border-radius: 999px;
    color: oklch(0.9 0.12 92); background: oklch(1 0 0 / 0.08); border: 1px solid oklch(from var(--gold) l c h / 0.4);
  }
  .fasadm-ph svg { width: 1.75rem; height: 1.75rem; }
  .fasadm-no, .fasadm-more, .fasadm-warn {
    position: absolute; padding: 0.25rem 0.65rem; border-radius: 999px; font-size: 0.7rem; font-weight: 700;
    color: #fff; background: oklch(0.2 0.07 262 / 0.72); backdrop-filter: blur(6px);
  }
  .fasadm-no { left: 0.7rem; top: 0.7rem; letter-spacing: 0.04em; }
  .fasadm-more { right: 0.7rem; top: 0.7rem; }
  .fasadm-warn { right: 0.7rem; bottom: 0.7rem; color: oklch(0.32 0.08 65); background: var(--gradient-gold); }

  .fasadm-body { display: flex; flex: 1; flex-direction: column; padding: 1.1rem 1.25rem 0.5rem; }
  .fasadm-cat {
    width: fit-content; padding: 0.2rem 0.65rem; border-radius: 999px; font-size: 0.7rem; font-weight: 700;
    color: var(--primary); background: var(--accent);
  }
  .fasadm-body h3 { margin-top: 0.7rem; font-family: var(--font-display); font-size: 1rem; font-weight: 700; line-height: 1.35; color: var(--foreground); }
  .fasadm-body p {
    margin-top: 0.4rem; font-size: 0.82rem; line-height: 1.6; color: var(--muted-foreground);
    display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;
  }
  .fasadm-actions { display: flex; align-items: center; gap: 0.5rem; padding: 0.9rem 1.25rem 1.15rem; }
  .fasadm-edit {
    display: inline-flex; flex: 1; align-items: center; justify-content: center; gap: 0.5rem; padding: 0.6rem 1rem;
    border-radius: 0.85rem; font-size: 0.82rem; font-weight: 600; color: var(--primary);
    background: var(--accent); transition: background 0.3s, color 0.3s, transform 0.3s var(--ease-out);
  }
  .fasadm-edit:hover { background: var(--primary); color: var(--primary-foreground); transform: translateY(-1px); }
  @media (prefers-reduced-motion: reduce) {
    .fasadm-card, .fasadm-media img, .fasadm-edit { transition: none !important; }
  }
</style>

<p class="enter-item enter-d1 mb-6 text-sm text-muted-foreground">{{ $groupMeta['desc'] }}</p>

<div class="enter-item enter-d2 fasadm-head">
  <div class="fasadm-stats">
    <span class="fasadm-stat"><x-icon name="school" class="w-4 h-4" /> <b>{{ $totalRows }}</b> fasilitas</span>
    <span class="fasadm-stat"><x-icon name="layers" class="w-4 h-4" /> <b>{{ $jumlahKategori }}</b> kategori</span>
    @if ($tanpaFoto > 0)
      <span class="fasadm-stat is-warn"><x-icon name="camera" class="w-4 h-4" /> <b>{{ $tanpaFoto }}</b> belum ada foto</span>
    @endif
  </div>

  <a href="{{ route('admin.konten.create', ['fasilitas', 'fasilitas']) }}" class="inline-flex items-center justify-center gap-2 rounded-xl bg-navy-gradient px-5 py-2.5 text-sm font-semibold text-hero-foreground shadow-soft">
    <x-icon name="plus" class="w-4 h-4" /> Tambah {{ $itemLabel }}
  </a>
</div>

@if ($tanpaFoto > 0)
  <div class="enter-item enter-d3 fasadm-tip">
    <x-icon name="info" />
    <p>
      <b>Cara menambah foto:</b> klik tombol <b>Edit / Tambah Foto</b> pada kartu fasilitas, lalu unggah
      <b>Foto Utama</b> (dan <b>Foto Tambahan</b> bila ada). Disarankan foto landscape rasio 16:9 (contoh 1600&times;900 px),
      maksimal 5 MB. Selama belum ada foto, halaman publik menampilkan ikon fasilitas sebagai gambar pengganti.
    </p>
  </div>
@endif

@if ($rows->isEmpty())
  <div class="enter-item enter-d3 mt-6 rounded-3xl border border-dashed border-border bg-card px-6 py-14 text-center">
    <span class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-accent text-primary"><x-icon name="school" class="w-5 h-5" /></span>
    <p class="mt-4 text-sm font-medium text-muted-foreground">Belum ada data fasilitas. Klik &ldquo;Tambah {{ $itemLabel }}&rdquo; untuk memulai.</p>
  </div>
@else
  <div class="fasadm-grid stagger-group">
    @foreach ($rows as $item)
      @php $icon = $item->icon ?: 'building'; @endphp
      <article class="stagger-item fasadm-card">
        <div class="fasadm-media">
          @if ($item->gambar)
            <img src="{{ \App\Support\Site::imageUrl($item->gambar) }}" alt="{{ $item->judul }}" loading="lazy" />
          @else
            <span class="fasadm-ph"><span><x-icon :name="$icon" /></span></span>
          @endif

          <span class="fasadm-no">Urutan {{ $item->urutan }}</span>
          @if (! $item->gambar)
            <span class="fasadm-warn">Belum ada foto</span>
          @elseif ($item->gambar_2)
            <span class="fasadm-more">2 foto</span>
          @endif
        </div>

        <div class="fasadm-body">
          <span class="fasadm-cat">{{ $item->kategori ?: 'Sarana & Prasarana' }}</span>
          <h3>{{ $item->judul }}</h3>
          <p>{{ $item->deskripsi }}</p>
        </div>

        <div class="fasadm-actions">
          <a href="{{ route('admin.konten.edit', ['fasilitas', 'fasilitas', $item->id]) }}" class="fasadm-edit">
            <x-icon name="pencil" class="w-4 h-4" /> {{ $item->gambar ? 'Edit' : 'Edit / Tambah Foto' }}
          </a>
          <form method="POST" action="{{ route('admin.konten.destroy', ['fasilitas', 'fasilitas', $item->id]) }}" data-confirm="Hapus fasilitas ini?">
            @csrf
            @method('DELETE')
            <button type="submit" class="flex h-10 w-10 items-center justify-center rounded-lg border border-border text-muted-foreground hover:border-destructive hover:text-destructive" title="Hapus">
              <x-icon name="trash" class="w-4 h-4" />
            </button>
          </form>
        </div>
      </article>
    @endforeach
  </div>
@endif

@endsection