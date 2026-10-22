@extends('layouts.admin')
@section('title', 'Kunjungan Industri')
@section('page-title', 'Kelola Kunjungan Industri')

@section('content')

@php
  $tabs = ['lokasi' => 'Lokasi & Foto', 'video' => 'Video (Opsional)', 'info' => 'Info Halaman'];
@endphp

<div class="reveal mb-6 flex gap-2 overflow-x-auto pb-2">
  @foreach ($tabs as $tabKey => $tabLabel)
    <a href="{{ route('admin.kunjungan-industri.index', ['tab' => $tabKey]) }}"
       class="shrink-0 rounded-full px-4 py-2 text-sm font-semibold transition-colors {{ $tab === $tabKey ? 'bg-navy-gradient text-hero-foreground shadow-soft' : 'border border-border text-muted-foreground hover:text-primary' }}">
      {{ $tabLabel }}
    </a>
  @endforeach
</div>

{{-- ============================ TAB: LOKASI & FOTO ============================ --}}
@if ($tab === 'lokasi')

  <div class="enter-item enter-d1 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
    <p class="text-sm text-muted-foreground">Kelola destinasi kunjungan beserta penjelasan singkat dan foto-fotonya. Setiap destinasi tampil sebagai satu bagian di halaman publik.</p>
    <div class="flex flex-wrap items-center gap-3">
      <a href="{{ route('kunjungan-industri') }}" target="_blank" class="inline-flex items-center justify-center gap-2 rounded-xl border border-border bg-card px-4 py-2.5 text-sm font-semibold text-foreground shadow-soft hover:bg-secondary">
        <x-icon name="external-link" class="w-4 h-4" /> Lihat Halaman
      </a>
      <a href="{{ route('admin.kunjungan-industri.lokasi.create') }}" class="inline-flex items-center justify-center gap-2 rounded-xl bg-navy-gradient px-5 py-2.5 text-sm font-semibold text-hero-foreground shadow-soft">
        <x-icon name="plus" class="w-4 h-4" /> Tambah Lokasi
      </a>
    </div>
  </div>

  <div class="enter-item enter-d2 mt-6 overflow-hidden rounded-2xl border border-border bg-card shadow-soft">
    <div class="overflow-x-auto">
      <table class="w-full min-w-[720px] text-left text-sm">
        <thead class="bg-secondary/60 text-xs uppercase tracking-wider text-muted-foreground">
          <tr>
            <th class="px-6 py-3.5">Lokasi</th>
            <th class="px-6 py-3.5">Kategori</th>
            <th class="px-6 py-3.5">Foto</th>
            <th class="px-6 py-3.5">Urutan</th>
            <th class="px-6 py-3.5 text-right">Aksi</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-border">
          @forelse ($lokasiList as $item)
            @php $thumb = optional($item->fotos()->first())->url(); @endphp
            <tr class="transition-colors hover:bg-secondary/40">
              <td class="px-6 py-3.5">
                <div class="flex items-center gap-3">
                  @if ($thumb)
                    <img src="{{ $thumb }}" alt="{{ $item->nama }}" class="h-12 w-16 shrink-0 rounded-lg object-cover" />
                  @else
                    <span class="flex h-12 w-16 shrink-0 items-center justify-center rounded-lg bg-navy-gradient text-hero-foreground"><x-icon :name="$item->icon" class="w-4 h-4" /></span>
                  @endif
                  <div class="leading-tight">
                    <p class="font-medium text-foreground">{{ $item->nama }}</p>
                    @if ($item->kota) <p class="mt-0.5 text-xs text-muted-foreground">{{ $item->kota }}</p> @endif
                  </div>
                </div>
              </td>
              <td class="px-6 py-3.5 text-muted-foreground">{{ $item->kategori ?: '-' }}</td>
              <td class="px-6 py-3.5">
                <span class="inline-flex items-center gap-1.5 rounded-full bg-accent px-2.5 py-1 text-xs font-semibold text-primary">
                  <x-icon name="image" class="w-3.5 h-3.5" />{{ $item->fotos_count }} foto
                </span>
              </td>
              <td class="px-6 py-3.5 text-muted-foreground">{{ $item->urutan }}</td>
              <td class="px-6 py-3.5">
                <div class="flex items-center justify-end gap-2">
                  <a href="{{ route('admin.kunjungan-industri.lokasi.edit', $item) }}" class="flex h-9 w-9 items-center justify-center rounded-lg border border-border text-muted-foreground hover:text-primary" title="Edit"><x-icon name="pencil" class="w-4 h-4" /></a>
                  <form method="POST" action="{{ route('admin.kunjungan-industri.lokasi.destroy', $item) }}" data-confirm="Hapus lokasi &quot;{{ $item->nama }}&quot;? Semua foto di dalamnya ikut terhapus.">
                    @csrf @method('DELETE')
                    <button type="submit" class="flex h-9 w-9 items-center justify-center rounded-lg border border-border text-muted-foreground hover:border-destructive hover:text-destructive" title="Hapus"><x-icon name="trash" class="w-4 h-4" /></button>
                  </form>
                </div>
              </td>
            </tr>
          @empty
            <tr><td colspan="5" class="px-6 py-10 text-center text-muted-foreground">Belum ada lokasi kunjungan.</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

{{-- ============================ TAB: VIDEO ============================ --}}
@elseif ($tab === 'video')

  <div class="enter-item enter-d1 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
    <p class="text-sm text-muted-foreground">Video bersifat <strong>opsional</strong>. Jika belum ada video, bagian video tidak tampil di halaman publik. Video bisa diunggah dari komputer atau disematkan (embed) dari link YouTube, Instagram, TikTok, dll.</p>
    <div class="flex flex-wrap items-center gap-3">
      <a href="{{ route('kunjungan-industri') }}#video" target="_blank" class="inline-flex items-center justify-center gap-2 rounded-xl border border-border bg-card px-4 py-2.5 text-sm font-semibold text-foreground shadow-soft hover:bg-secondary">
        <x-icon name="external-link" class="w-4 h-4" /> Lihat Halaman
      </a>
      <a href="{{ route('admin.kunjungan-industri.video.create') }}" class="inline-flex items-center justify-center gap-2 rounded-xl bg-navy-gradient px-5 py-2.5 text-sm font-semibold text-hero-foreground shadow-soft">
        <x-icon name="plus" class="w-4 h-4" /> Tambah Video
      </a>
    </div>
  </div>

  <div class="enter-item enter-d2 mt-6 overflow-hidden rounded-2xl border border-border bg-card shadow-soft">
    <div class="overflow-x-auto">
      <table class="w-full min-w-[720px] text-left text-sm">
        <thead class="bg-secondary/60 text-xs uppercase tracking-wider text-muted-foreground">
          <tr>
            <th class="px-6 py-3.5">Video</th>
            <th class="px-6 py-3.5">Sumber</th>
            <th class="px-6 py-3.5">Lokasi</th>
            <th class="px-6 py-3.5">Urutan</th>
            <th class="px-6 py-3.5 text-right">Aksi</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-border">
          @forelse ($videos as $v)
            @php $thumb = $v->posterUrl(); @endphp
            <tr class="transition-colors hover:bg-secondary/40">
              <td class="px-6 py-3.5">
                <div class="flex items-center gap-3">
                  @if ($thumb)
                    <img src="{{ $thumb }}" alt="{{ $v->judul }}" class="h-12 w-20 shrink-0 rounded-lg object-cover" />
                  @else
                    <span class="flex h-12 w-20 shrink-0 items-center justify-center rounded-lg bg-navy-gradient text-hero-foreground"><x-icon :name="$v->icon()" class="w-4 h-4" /></span>
                  @endif
                  <p class="font-medium leading-tight text-foreground">{{ $v->judul }}</p>
                </div>
              </td>
              <td class="px-6 py-3.5">
                <span class="inline-flex items-center gap-1.5 rounded-full bg-accent px-2.5 py-1 text-xs font-semibold text-primary">
                  <x-icon :name="$v->icon()" class="w-3.5 h-3.5" />{{ $v->providerLabel() }}
                </span>
                <span class="mt-1 block text-xs text-muted-foreground">{{ $v->jenis === 'lokal' ? 'Upload' : 'Embed' }} &middot; {{ $v->isPortrait() ? 'Tegak' : 'Lebar' }}</span>
              </td>
              <td class="px-6 py-3.5 text-muted-foreground">{{ $v->lokasi->nama ?? '-' }}</td>
              <td class="px-6 py-3.5 text-muted-foreground">{{ $v->urutan }}</td>
              <td class="px-6 py-3.5">
                <div class="flex items-center justify-end gap-2">
                  <a href="{{ route('admin.kunjungan-industri.video.edit', $v) }}" class="flex h-9 w-9 items-center justify-center rounded-lg border border-border text-muted-foreground hover:text-primary" title="Edit"><x-icon name="pencil" class="w-4 h-4" /></a>
                  <form method="POST" action="{{ route('admin.kunjungan-industri.video.destroy', $v) }}" data-confirm="Hapus video &quot;{{ $v->judul }}&quot;? File video yang diunggah ikut terhapus.">
                    @csrf @method('DELETE')
                    <button type="submit" class="flex h-9 w-9 items-center justify-center rounded-lg border border-border text-muted-foreground hover:border-destructive hover:text-destructive" title="Hapus"><x-icon name="trash" class="w-4 h-4" /></button>
                  </form>
                </div>
              </td>
            </tr>
          @empty
            <tr><td colspan="5" class="px-6 py-10 text-center text-muted-foreground">Belum ada video. Halaman publik tetap tampil normal tanpa bagian video.</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

{{-- ============================ TAB: INFO HALAMAN ============================ --}}
@else

  <div class="enter-item enter-d1 mx-auto max-w-3xl rounded-2xl border border-border bg-card p-7 shadow-soft">
    <form method="POST" action="{{ route('admin.kunjungan-industri.info.update') }}" class="grid gap-5">
      @csrf @method('PUT')

      <div>
        <label for="judul" class="text-sm font-medium text-foreground">Judul Halaman</label>
        <input type="text" name="judul" id="judul" value="{{ old('judul', $info->judul ?? '') }}" class="input-field" placeholder="Contoh: Kunjungan Industri ke Yogyakarta" />
        @error('judul') <p class="mt-1 text-xs text-destructive">{{ $message }}</p> @enderror
      </div>

      <div class="grid gap-5 sm:grid-cols-2">
        <div>
          <label for="kota_tujuan" class="text-sm font-medium text-foreground">Kota Tujuan <span class="text-muted-foreground">(opsional)</span></label>
          <input type="text" name="kota_tujuan" id="kota_tujuan" value="{{ old('kota_tujuan', $info->kota_tujuan ?? '') }}" class="input-field" placeholder="Contoh: Yogyakarta" />
          @error('kota_tujuan') <p class="mt-1 text-xs text-destructive">{{ $message }}</p> @enderror
        </div>
        <div>
          <label for="periode" class="text-sm font-medium text-foreground">Waktu Pelaksanaan <span class="text-muted-foreground">(opsional)</span></label>
          <input type="text" name="periode" id="periode" value="{{ old('periode', $info->periode ?? '') }}" class="input-field" placeholder="Contoh: 19-22 Februari 2025" />
          @error('periode') <p class="mt-1 text-xs text-destructive">{{ $message }}</p> @enderror
        </div>
      </div>

      <div>
        <label for="intro" class="text-sm font-medium text-foreground">Penjelasan Singkat <span class="text-muted-foreground">(opsional)</span></label>
        <textarea name="intro" id="intro" rows="5" class="input-field" placeholder="Pengantar singkat tentang kegiatan kunjungan industri">{{ old('intro', $info->intro ?? '') }}</textarea>
        @error('intro') <p class="mt-1 text-xs text-destructive">{{ $message }}</p> @enderror
      </div>

      <div class="flex items-center gap-3">
        <button type="submit" class="inline-flex items-center gap-2 rounded-full bg-navy-gradient px-6 py-3 text-sm font-semibold text-hero-foreground shadow-soft">
          <x-icon name="check" class="w-4 h-4" /> Simpan
        </button>
      </div>
    </form>
  </div>

@endif

@endsection