@extends('layouts.admin')
@section('title', 'Prestasi Sekolah')
@section('page-title', 'Kelola Prestasi Sekolah')

@section('content')

@php
  $tabs = ['data' => 'Data Prestasi'];
  foreach ($resources as $key => $resDef) {
      $tabs[$key] = $resDef['label'];
  }
@endphp

<div class="reveal mb-6 flex gap-2 overflow-x-auto pb-2">
  @foreach ($tabs as $tabKey => $tabLabel)
    <a href="{{ route('admin.prestasi-sekolah.index', ['tab' => $tabKey]) }}"
       class="shrink-0 rounded-full px-4 py-2 text-sm font-semibold transition-colors {{ $tab === $tabKey ? 'bg-navy-gradient text-hero-foreground shadow-soft' : 'border border-border text-muted-foreground hover:text-primary' }}">
      {{ $tabLabel }}
    </a>
  @endforeach
</div>

@if ($tab === 'data')

  @php
    $peringkatBadge = [
      'emas' => 'bg-gold/15 text-gold-foreground border border-gold/40',
      'perak' => 'bg-slate-200 text-slate-700 border border-slate-300',
      'perunggu' => 'bg-orange-100 text-orange-700 border border-orange-200',
      'lainnya' => 'bg-secondary text-muted-foreground border border-border',
    ];
  @endphp

  <div class="enter-item enter-d1 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
    <p class="text-sm text-muted-foreground">Kelola daftar prestasi siswa/tim yang tampil di halaman publik Prestasi Sekolah. Baris dengan angka <strong>Kelompok</strong> yang sama akan digabung jadi satu kartu (beserta fotonya).</p>

    <div class="flex flex-wrap items-center gap-3">
      <a href="{{ route('prestasi') }}" target="_blank" class="inline-flex items-center justify-center gap-2 rounded-xl border border-border bg-card px-4 py-2.5 text-sm font-semibold text-foreground shadow-soft hover:bg-secondary">
        <x-icon name="external-link" class="w-4 h-4" /> Lihat Halaman
      </a>
      <a href="{{ route('admin.prestasi-sekolah.create') }}" class="inline-flex items-center justify-center gap-2 rounded-xl bg-navy-gradient px-5 py-2.5 text-sm font-semibold text-hero-foreground shadow-soft">
        <x-icon name="plus" class="w-4 h-4" /> Tambah Prestasi
      </a>
    </div>
  </div>

  <div class="enter-item enter-d2 mt-6 grid grid-cols-2 gap-3 sm:grid-cols-4">
    @php
      $total = $items->count();
      $emas = $items->where('peringkat', 'emas')->count();
      $perak = $items->where('peringkat', 'perak')->count();
      $perunggu = $items->where('peringkat', 'perunggu')->count();
    @endphp
    <div class="rounded-2xl border border-border bg-card p-4 text-center shadow-soft">
      <p class="font-display text-2xl font-extrabold text-primary">{{ $total }}</p>
      <p class="mt-0.5 text-xs text-muted-foreground">Total Prestasi</p>
    </div>
    <div class="rounded-2xl border border-gold/40 bg-gold/10 p-4 text-center shadow-soft">
      <p class="font-display text-2xl font-extrabold text-gold-foreground">{{ $emas }}</p>
      <p class="mt-0.5 text-xs text-muted-foreground">Medali Emas</p>
    </div>
    <div class="rounded-2xl border border-slate-300 bg-slate-100 p-4 text-center shadow-soft">
      <p class="font-display text-2xl font-extrabold text-slate-700">{{ $perak }}</p>
      <p class="mt-0.5 text-xs text-muted-foreground">Medali Perak</p>
    </div>
    <div class="rounded-2xl border border-orange-200 bg-orange-50 p-4 text-center shadow-soft">
      <p class="font-display text-2xl font-extrabold text-orange-700">{{ $perunggu }}</p>
      <p class="mt-0.5 text-xs text-muted-foreground">Medali Perunggu</p>
    </div>
  </div>

  <div class="enter-item enter-d3 mt-6 overflow-hidden rounded-2xl border border-border bg-card shadow-soft">
    <div class="overflow-x-auto">
      <table class="w-full min-w-[880px] text-left text-sm">
        <thead class="bg-secondary/60 text-xs uppercase tracking-wider text-muted-foreground">
          <tr>
            <th class="px-4 py-3.5">Klp.</th>
            <th class="px-6 py-3.5">Nama Siswa / Tim</th>
            <th class="px-6 py-3.5">Nama Kejuaraan</th>
            <th class="px-6 py-3.5">Juara</th>
            <th class="px-6 py-3.5">Kategori</th>
            <th class="px-6 py-3.5">Tahun</th>
            <th class="px-6 py-3.5 text-right">Aksi</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-border">
          @forelse ($items as $item)
            <tr class="transition-colors hover:bg-secondary/40">
              <td class="px-4 py-3.5 text-center font-semibold text-muted-foreground">{{ $item->kelompok }}</td>
              <td class="px-6 py-3.5">
                <div class="flex items-center gap-3">
                  @if ($item->foto)
                    <img src="{{ $item->fotoUrl() }}" alt="" loading="lazy" class="h-9 w-9 shrink-0 rounded-lg border border-border object-cover" style="object-position:50% 22%;" />
                  @else
                    <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-navy-gradient text-hero-foreground">
                      <x-icon :name="$item->kategoriIcon()" class="w-4 h-4" />
                    </span>
                  @endif
                  <p class="font-medium leading-snug text-foreground">{{ $item->nama_siswa }}</p>
                </div>
              </td>
              <td class="px-6 py-3.5 max-w-xs text-muted-foreground">{{ $item->nama_kejuaraan }}</td>
              <td class="px-6 py-3.5">
                <span class="inline-flex items-center gap-1.5 whitespace-nowrap rounded-full px-2.5 py-1 text-xs font-semibold {{ $peringkatBadge[$item->peringkat] ?? $peringkatBadge['lainnya'] }}">
                  <x-icon :name="$item->peringkatIcon()" class="w-3.5 h-3.5" />{{ $item->juara }}
                </span>
                @if ($item->tingkat) <p class="mt-1 text-xs text-muted-foreground">{{ $item->tingkat }}</p> @endif
              </td>
              <td class="px-6 py-3.5 text-muted-foreground">{{ $item->kategori ?: '-' }}</td>
              <td class="px-6 py-3.5 text-muted-foreground">{{ $item->tahun }}</td>
              <td class="px-6 py-3.5">
                <div class="flex items-center justify-end gap-2">
                  <a href="{{ route('admin.prestasi-sekolah.edit', $item) }}" class="flex h-9 w-9 items-center justify-center rounded-lg border border-border text-muted-foreground hover:text-primary" title="Edit"><x-icon name="pencil" class="w-4 h-4" /></a>
                  <form method="POST" action="{{ route('admin.prestasi-sekolah.destroy', $item) }}" data-confirm="Hapus prestasi &quot;{{ $item->nama_kejuaraan }}&quot; milik {{ $item->nama_siswa }}?">
                    @csrf @method('DELETE')
                    <button type="submit" class="flex h-9 w-9 items-center justify-center rounded-lg border border-border text-muted-foreground hover:border-destructive hover:text-destructive" title="Hapus"><x-icon name="trash" class="w-4 h-4" /></button>
                  </form>
                </div>
              </td>
            </tr>
          @empty
            <tr><td colspan="7" class="px-6 py-10 text-center text-muted-foreground">Belum ada data prestasi sekolah.</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

@else

  @php $def = $resources[$tab]; @endphp
  @include('admin.konten._resource-table', ['group' => 'prestasi', 'tab' => $tab, 'def' => $def, 'rows' => $rows])

@endif

@endsection