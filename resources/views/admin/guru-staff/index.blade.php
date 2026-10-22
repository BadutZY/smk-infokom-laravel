@extends('layouts.admin')
@section('title', 'Guru & Staff')
@section('page-title', 'Kelola Guru & Staff')

@section('content')

<div class="enter-item enter-d1 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
  <p class="text-sm text-muted-foreground">Kelola data guru dan staff yang tampil pada halaman publik Guru & Staff.</p>

  <a href="{{ route('admin.guru-staff.create') }}" class="inline-flex items-center justify-center gap-2 rounded-xl bg-navy-gradient px-5 py-2.5 text-sm font-semibold text-hero-foreground shadow-soft">
    <x-icon name="plus" class="w-4 h-4" /> Tambah Guru/Staff
  </a>
</div>

<div class="enter-item enter-d2 mt-6 overflow-hidden rounded-2xl border border-border bg-card shadow-soft">
  <div class="overflow-x-auto">
    <table class="w-full min-w-[620px] text-left text-sm">
      <thead class="bg-secondary/60 text-xs uppercase tracking-wider text-muted-foreground">
        <tr>
          <th class="px-6 py-3.5">Nama</th>
          <th class="px-6 py-3.5">Jabatan</th>
          <th class="px-6 py-3.5">Kategori</th>
          <th class="px-6 py-3.5">Urutan</th>
          <th class="px-6 py-3.5 text-right">Aksi</th>
        </tr>
      </thead>
      <tbody class="divide-y divide-border">
        @forelse ($guruStaff as $item)
          <tr class="transition-colors hover:bg-secondary/40">
            <td class="px-6 py-3.5">
              <div class="flex items-center gap-3">
                @if ($item->foto)
                  <img src="{{ \App\Support\Site::imageUrl($item->foto) }}" alt="{{ $item->nama_lengkap }}" class="h-11 w-11 shrink-0 rounded-full object-cover" />
                @else
                  <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full bg-accent text-primary"><x-icon name="user" class="w-5 h-5" /></span>
                @endif
                <span class="font-medium text-foreground">{{ $item->nama_lengkap }}</span>
              </div>
            </td>
            <td class="px-6 py-3.5"><span class="rounded-full bg-accent px-2.5 py-1 text-xs font-semibold text-primary">{{ $item->jabatan }}</span></td>
            <td class="px-6 py-3.5 text-muted-foreground">{{ $item->kategori }}</td>
            <td class="px-6 py-3.5 text-muted-foreground">{{ $item->urutan }}</td>
            <td class="px-6 py-3.5">
              <div class="flex items-center justify-end gap-2">
                <a href="{{ route('admin.guru-staff.edit', $item) }}" class="flex h-9 w-9 items-center justify-center rounded-lg border border-border text-muted-foreground hover:text-primary" title="Edit"><x-icon name="pencil" class="w-4 h-4" /></a>
                <form method="POST" action="{{ route('admin.guru-staff.destroy', $item) }}" data-confirm="Hapus data &quot;{{ $item->nama_lengkap }}&quot;?">
                  @csrf @method('DELETE')
                  <button type="submit" class="flex h-9 w-9 items-center justify-center rounded-lg border border-border text-muted-foreground hover:border-destructive hover:text-destructive" title="Hapus"><x-icon name="trash" class="w-4 h-4" /></button>
                </form>
              </div>
            </td>
          </tr>
        @empty
          <tr><td colspan="5" class="px-6 py-10 text-center text-muted-foreground">Belum ada data guru & staff.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

@endsection