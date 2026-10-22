@extends('layouts.admin')
@section('title', 'Magang Jepang')
@section('page-title', 'Kelola Magang Jepang')

@section('content')

@php
  $tabs = ['data' => 'Data Alumni'];
  foreach ($resources as $key => $resDef) {
      $tabs[$key] = $resDef['label'];
  }
@endphp

<div class="reveal mb-6 flex gap-2 overflow-x-auto pb-2">
  @foreach ($tabs as $tabKey => $tabLabel)
    <a href="{{ route('admin.magang-jepang.index', ['tab' => $tabKey]) }}"
       class="shrink-0 rounded-full px-4 py-2 text-sm font-semibold transition-colors {{ $tab === $tabKey ? 'bg-navy-gradient text-hero-foreground shadow-soft' : 'border border-border text-muted-foreground hover:text-primary' }}">
      {{ $tabLabel }}
    </a>
  @endforeach
</div>

@if ($tab === 'data')

  <div class="enter-item enter-d1 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
    <p class="text-sm text-muted-foreground">Kelola alumni yang berangkat magang ke Jepang beserta foto atau videonya di halaman publik.</p>

    <div class="flex flex-wrap items-center gap-3">
      <a href="{{ route('magang-jepang') }}" target="_blank" class="inline-flex items-center justify-center gap-2 rounded-xl border border-border bg-card px-4 py-2.5 text-sm font-semibold text-foreground shadow-soft hover:bg-secondary">
        <x-icon name="external-link" class="w-4 h-4" /> Lihat Halaman
      </a>
      <a href="{{ route('admin.magang-jepang.create') }}" class="inline-flex items-center justify-center gap-2 rounded-xl bg-navy-gradient px-5 py-2.5 text-sm font-semibold text-hero-foreground shadow-soft">
        <x-icon name="plus" class="w-4 h-4" /> Tambah Alumni
      </a>
    </div>
  </div>

  <div class="enter-item enter-d2 mt-6 overflow-hidden rounded-2xl border border-border bg-card shadow-soft">
    <div class="overflow-x-auto">
      <table class="w-full min-w-[720px] text-left text-sm">
        <thead class="bg-secondary/60 text-xs uppercase tracking-wider text-muted-foreground">
          <tr>
            <th class="px-6 py-3.5">Alumni</th>
            <th class="px-6 py-3.5">Jenis Media</th>
            <th class="px-6 py-3.5">Lokasi</th>
            <th class="px-6 py-3.5">Urutan</th>
            <th class="px-6 py-3.5 text-right">Aksi</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-border">
          @forelse ($items as $item)
            @php
              $thumb = $item->posterUrl();
              $icon = ['foto' => 'image', 'video_lokal' => 'video', 'youtube' => 'youtube', 'instagram' => 'instagram'][$item->jenis_media] ?? 'video';
            @endphp
            <tr class="transition-colors hover:bg-secondary/40">
              <td class="px-6 py-3.5">
                <div class="flex items-center gap-3">
                  @if ($thumb)
                    <img src="{{ $thumb }}" alt="{{ $item->nama }}" class="h-14 w-10 shrink-0 rounded-lg object-cover" />
                  @else
                    <span class="flex h-14 w-10 shrink-0 items-center justify-center rounded-lg bg-navy-gradient text-hero-foreground"><x-icon :name="$icon" class="w-4 h-4" /></span>
                  @endif
                  <div class="leading-tight">
                    <p class="font-medium text-foreground">{{ $item->nama }}</p>
                    @if ($item->handle) <p class="mt-0.5 text-xs text-muted-foreground">&#64;{{ $item->handle }}</p> @endif
                  </div>
                </div>
              </td>
              <td class="px-6 py-3.5">
                <span class="inline-flex items-center gap-1.5 rounded-full bg-accent px-2.5 py-1 text-xs font-semibold text-primary">
                  <x-icon :name="$icon" class="w-3.5 h-3.5" />{{ $item->jenisLabel() }}
                </span>
              </td>
              <td class="px-6 py-3.5 text-muted-foreground">
                {{ $item->kota ?: '-' }}
                @if ($item->angkatan) <span class="block text-xs">{{ $item->angkatan }}</span> @endif
              </td>
              <td class="px-6 py-3.5 text-muted-foreground">{{ $item->urutan }}</td>
              <td class="px-6 py-3.5">
                <div class="flex items-center justify-end gap-2">
                  <a href="{{ route('admin.magang-jepang.edit', $item) }}" class="flex h-9 w-9 items-center justify-center rounded-lg border border-border text-muted-foreground hover:text-primary" title="Edit"><x-icon name="pencil" class="w-4 h-4" /></a>
                  <form method="POST" action="{{ route('admin.magang-jepang.destroy', $item) }}" data-confirm="Hapus data &quot;{{ $item->nama }}&quot;? File foto/video yang diunggah ikut terhapus.">
                    @csrf @method('DELETE')
                    <button type="submit" class="flex h-9 w-9 items-center justify-center rounded-lg border border-border text-muted-foreground hover:border-destructive hover:text-destructive" title="Hapus"><x-icon name="trash" class="w-4 h-4" /></button>
                  </form>
                </div>
              </td>
            </tr>
          @empty
            <tr><td colspan="5" class="px-6 py-10 text-center text-muted-foreground">Belum ada data magang Jepang.</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

@else

  @php $def = $resources[$tab]; @endphp
  @include('admin.konten._resource-table', ['group' => 'magang', 'tab' => $tab, 'def' => $def, 'rows' => $rows])

@endif

@endsection