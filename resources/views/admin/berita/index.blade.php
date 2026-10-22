@extends('layouts.admin')
@section('title', 'Berita')
@section('page-title', 'Kelola Berita')

@section('content')

<div class="enter-item enter-d1 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
  <form method="GET" class="flex flex-1 flex-wrap gap-3">
    <div class="relative flex-1 min-w-[200px]">
      <x-icon name="search" class="pointer-events-none absolute left-3.5 top-1/2 w-4 h-4 -translate-y-1/2 text-muted-foreground" />
      <input type="text" name="search" value="{{ $search }}" placeholder="Cari judul berita..." class="input-field pl-10" />
    </div>
    <select name="kategori" onchange="this.form.submit()" class="input-field w-auto">
      <option value="">Semua Kategori</option>
      @foreach ($kategoriList as $kat)
        <option value="{{ $kat }}" @selected($activeKategori === $kat)>{{ $kat }}</option>
      @endforeach
    </select>
    <button type="submit" class="rounded-xl bg-secondary px-4 py-2.5 text-sm font-semibold text-secondary-foreground">Cari</button>
  </form>

  <a href="{{ route('admin.berita.create') }}" class="inline-flex items-center justify-center gap-2 rounded-xl bg-navy-gradient px-5 py-2.5 text-sm font-semibold text-hero-foreground shadow-soft">
    <x-icon name="plus" class="w-4 h-4" /> Berita Baru
  </a>
</div>

<div class="enter-item enter-d2 mt-6 overflow-hidden rounded-2xl border border-border bg-card shadow-soft">
  <div class="overflow-x-auto">
    <table class="w-full min-w-[720px] text-left text-sm">
      <thead class="bg-secondary/60 text-xs uppercase tracking-wider text-muted-foreground">
        <tr>
          <th class="px-6 py-3.5">Berita</th>
          <th class="px-6 py-3.5">Kategori</th>
          <th class="px-6 py-3.5">Tanggal</th>
          <th class="px-6 py-3.5">Foto</th>
          <th class="px-6 py-3.5 text-right">Aksi</th>
        </tr>
      </thead>
      <tbody class="divide-y divide-border">
        @forelse ($berita as $item)
          <tr class="transition-colors hover:bg-secondary/40">
            <td class="px-6 py-3.5">
              <div class="flex items-center gap-3">
                <img src="{{ \App\Support\Site::imageUrl($item->gambar_sampul) }}" alt="{{ $item->judul }}" class="h-12 w-16 shrink-0 rounded-lg object-cover" />
                <span class="line-clamp-2 font-medium text-foreground">{{ $item->judul }}</span>
              </div>
            </td>
            <td class="px-6 py-3.5"><span class="rounded-full bg-accent px-2.5 py-1 text-xs font-semibold text-primary">{{ $item->kategori }}</span></td>
            <td class="px-6 py-3.5 text-muted-foreground">{{ \App\Support\Site::formatTanggal($item->tanggal) }}</td>
            <td class="px-6 py-3.5 text-muted-foreground">{{ $item->foto_count }}</td>
            <td class="px-6 py-3.5">
              <div class="flex items-center justify-end gap-2">
                <a href="{{ route('berita.show', $item->slug) }}" target="_blank" class="flex h-9 w-9 items-center justify-center rounded-lg border border-border text-muted-foreground hover:text-primary" title="Lihat"><x-icon name="eye" class="w-4 h-4" /></a>
                <a href="{{ route('admin.berita.edit', $item) }}" class="flex h-9 w-9 items-center justify-center rounded-lg border border-border text-muted-foreground hover:text-primary" title="Edit"><x-icon name="pencil" class="w-4 h-4" /></a>
                <form method="POST" action="{{ route('admin.berita.destroy', $item) }}" data-confirm="Hapus berita &quot;{{ $item->judul }}&quot;?">
                  @csrf @method('DELETE')
                  <button type="submit" class="flex h-9 w-9 items-center justify-center rounded-lg border border-border text-muted-foreground hover:border-destructive hover:text-destructive" title="Hapus"><x-icon name="trash" class="w-4 h-4" /></button>
                </form>
              </div>
            </td>
          </tr>
        @empty
          <tr><td colspan="5" class="px-6 py-10 text-center text-muted-foreground">Belum ada berita.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

@endsection
