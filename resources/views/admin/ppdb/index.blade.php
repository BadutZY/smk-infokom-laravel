@extends('layouts.admin')
@section('title', 'Data PPDB')
@section('page-title', 'Data Pendaftar PPDB')

@section('content')

<div class="stagger-group grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
  <div class="stagger-item card-hover rounded-2xl border border-border bg-card p-6 shadow-soft">
    <span class="flex h-11 w-11 items-center justify-center rounded-xl bg-accent text-primary"><x-icon name="idcard" class="w-5 h-5" /></span>
    <p class="mt-4 font-display text-2xl font-extrabold text-foreground">{{ $data->count() }}</p>
    <p class="text-sm text-muted-foreground">Total Pendaftar</p>
  </div>
  <div class="stagger-item card-hover rounded-2xl border border-border bg-card p-6 shadow-soft sm:col-span-2">
    <span class="flex h-11 w-11 items-center justify-center rounded-xl bg-accent text-primary"><x-icon name="award" class="w-5 h-5" /></span>
    <p class="mt-4 font-display text-2xl font-extrabold text-foreground">{{ $jurusanFavoritNama ?? '-' }}</p>
    <p class="text-sm text-muted-foreground">Jurusan Favorit @if($jurusanFavoritTotal) ({{ $jurusanFavoritTotal }} pendaftar) @endif</p>
  </div>
</div>

<form method="GET" class="enter-item enter-d2 mt-6 flex gap-3">
  <div class="relative flex-1 max-w-md">
    <x-icon name="search" class="pointer-events-none absolute left-3.5 top-1/2 w-4 h-4 -translate-y-1/2 text-muted-foreground" />
    <input type="text" name="search" value="{{ $search }}" placeholder="Cari nama, nomor, atau asal sekolah..." class="input-field pl-10" />
  </div>
  <button type="submit" class="rounded-xl bg-secondary px-4 py-2.5 text-sm font-semibold text-secondary-foreground">Cari</button>
</form>

<div class="enter-item enter-d3 mt-6 overflow-hidden rounded-2xl border border-border bg-card shadow-soft">
  <div class="overflow-x-auto">
    <table class="w-full min-w-[1040px] text-left text-sm">
      <thead class="bg-secondary/60 text-xs uppercase tracking-wider text-muted-foreground">
        <tr>
          <th class="px-6 py-3.5">No. Pendaftaran</th>
          <th class="px-6 py-3.5">Nama</th>
          <th class="px-6 py-3.5">Asal Sekolah</th>
          <th class="px-6 py-3.5">Pilihan Jurusan</th>
          <th class="px-6 py-3.5">Kontak</th>
          <th class="px-6 py-3.5">Berkas</th>
          <th class="px-6 py-3.5">Tanggal</th>
          <th class="px-6 py-3.5 text-right">Aksi</th>
        </tr>
      </thead>
      <tbody class="divide-y divide-border">
        @forelse ($data as $p)
          <tr class="transition-colors hover:bg-secondary/30">
            <td class="px-6 py-3.5 font-mono text-xs text-primary">{{ $p->nomor_pendaftaran }}</td>
            <td class="px-6 py-3.5">
              <p class="font-medium text-foreground">{{ $p->nama }}</p>
              <p class="text-xs text-muted-foreground">{{ $p->nisn }} &middot; {{ $p->jenis_kelamin }}</p>
            </td>
            <td class="px-6 py-3.5 text-muted-foreground">{{ $p->asal_sekolah }}</td>
            <td class="px-6 py-3.5">
              <span class="rounded-full bg-accent px-2.5 py-1 text-xs font-semibold text-primary">{{ $p->pilihan1 }}</span>
              <span class="ml-1 text-xs text-muted-foreground">{{ $p->pilihan2 }}</span>
            </td>
            <td class="px-6 py-3.5 text-muted-foreground">
              <p>{{ $p->email }}</p>
              <p class="text-xs">{{ $p->telepon }}</p>
            </td>
            <td class="px-6 py-3.5">
              @if ($p->dokumen)
                <a href="{{ \App\Support\Site::imageUrl($p->dokumen) }}" target="_blank" rel="noopener" class="inline-flex items-center gap-1.5 rounded-full bg-accent px-2.5 py-1 text-xs font-semibold text-primary hover:bg-accent/70" title="Lihat berkas">
                  <x-icon name="file-text" class="w-3.5 h-3.5" /> Ada
                </a>
              @else
                <span class="inline-flex items-center gap-1.5 rounded-full bg-secondary/60 px-2.5 py-1 text-xs font-semibold text-muted-foreground">Belum ada</span>
              @endif
            </td>
            <td class="px-6 py-3.5 text-muted-foreground">{{ \App\Support\Site::formatTanggal($p->created_at) }}</td>
            <td class="px-6 py-3.5">
              <div class="flex items-center justify-end gap-2">
                <a
                  href="{{ route('admin.ppdb.download', $p) }}"
                  title="{{ $p->dokumen ? 'Unduh formulir PDF + dokumen pendukung (ZIP)' : 'Unduh formulir PDF' }}"
                  class="flex h-9 w-9 items-center justify-center rounded-lg border border-border text-muted-foreground hover:border-primary hover:text-primary"
                >
                  <x-icon name="download" class="w-4 h-4" />
                </a>
                <button
                  type="button"
                  data-modal-open="#modal-ppdb-detail"
                  data-nomor="{{ $p->nomor_pendaftaran }}"
                  data-nama="{{ $p->nama }}"
                  data-nisn="{{ $p->nisn }}"
                  data-jk="{{ $p->jenis_kelamin }}"
                  data-tempat-lahir="{{ $p->tempat_lahir ?: '-' }}"
                  data-tanggal-lahir="{{ $p->tanggal_lahir ? \App\Support\Site::formatTanggal((string) $p->tanggal_lahir) : '-' }}"
                  data-agama="{{ $p->agama ?: '-' }}"
                  data-asal="{{ $p->asal_sekolah }}"
                  data-pilihan1="{{ $p->pilihan1 }}"
                  data-pilihan2="{{ $p->pilihan2 ?: '-' }}"
                  data-email="{{ $p->email }}"
                  data-telepon="{{ $p->telepon }}"
                  data-alamat="{{ $p->alamat ?: '-' }}"
                  data-nama-ortu="{{ $p->nama_orang_tua ?: '-' }}"
                  data-telepon-ortu="{{ $p->telepon_orang_tua ?: '-' }}"
                  data-pekerjaan-ortu="{{ $p->pekerjaan_orang_tua ?: '-' }}"
                  data-dokumen="{{ $p->dokumen ? \App\Support\Site::imageUrl($p->dokumen) : '' }}"
                  data-download-url="{{ route('admin.ppdb.download', $p) }}"
                  data-download-label="{{ $p->dokumen ? 'Unduh Formulir + Dokumen (ZIP)' : 'Unduh Formulir (PDF)' }}"
                  data-tanggal="{{ \App\Support\Site::formatTanggal($p->created_at) }}"
                  title="Lihat detail lengkap"
                  class="flex h-9 w-9 items-center justify-center rounded-lg border border-border text-muted-foreground hover:border-primary hover:text-primary"
                >
                  <x-icon name="file-text" class="w-4 h-4" />
                </button>
                <form method="POST" action="{{ route('admin.ppdb.destroy', $p) }}" data-confirm="Hapus data pendaftar &quot;{{ $p->nama }}&quot;?" class="inline">
                  @csrf @method('DELETE')
                  <button type="submit" title="Hapus" class="flex h-9 w-9 items-center justify-center rounded-lg border border-border text-muted-foreground hover:border-destructive hover:text-destructive"><x-icon name="trash" class="w-4 h-4" /></button>
                </form>
              </div>
            </td>
          </tr>
        @empty
          <tr><td colspan="8" class="px-6 py-10 text-center text-muted-foreground">Belum ada pendaftar.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

{{-- Modal Detail Pendaftar PPDB --}}
<div id="modal-ppdb-detail" data-modal class="fixed inset-0 z-50 hidden items-center justify-center bg-foreground/50 p-4 backdrop-blur-sm">
  <div data-modal-panel class="max-h-[92vh] w-full max-w-2xl overflow-hidden rounded-3xl bg-card shadow-lift flex flex-col">

    {{-- Header --}}
    <div class="relative shrink-0 overflow-hidden bg-navy-gradient px-7 py-7 text-hero-foreground">
      <div class="pointer-events-none absolute -right-10 -top-10 h-40 w-40 rounded-full bg-white/5"></div>
      <div class="pointer-events-none absolute -bottom-16 right-16 h-28 w-28 rounded-full bg-gold/10"></div>
      <div class="relative flex items-start justify-between gap-4">
        <div class="flex items-center gap-4">
          <span class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-white/15"><x-icon name="user" class="w-6 h-6" /></span>
          <div class="min-w-0">
            <p class="truncate font-display text-base font-bold" data-field="nama">-</p>
            <p class="mt-0.5 flex items-center gap-1.5 font-mono text-xs text-white/70">
              <x-icon name="idcard" class="w-3.5 h-3.5" /> <span data-field="nomor">-</span>
            </p>
          </div>
        </div>
        <button type="button" data-modal-close class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-white/10 hover:bg-white/20">
          <x-icon name="x" class="w-4 h-4" />
        </button>
      </div>
      <div class="relative mt-5 flex flex-wrap gap-2">
        <span class="inline-flex items-center gap-1.5 rounded-full bg-white/15 px-3 py-1 text-xs font-semibold" data-field="jk">-</span>
        <span class="inline-flex items-center gap-1.5 rounded-full bg-gold/20 px-3 py-1 text-xs font-semibold text-gold">
          <x-icon name="award" class="w-3.5 h-3.5" /> Pilihan 1: <span data-field="pilihan1">-</span>
        </span>
      </div>
    </div>

    {{-- Body --}}
    <div class="min-h-0 flex-1 overflow-y-auto px-7 py-6">

      <div class="flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-primary">
        <x-icon name="user" class="w-4 h-4" /> Identitas Siswa
      </div>
      <div class="mt-3 grid gap-4 sm:grid-cols-2">
        <div class="rounded-xl border border-border bg-secondary/40 p-4">
          <p class="text-[11px] font-semibold uppercase tracking-wider text-muted-foreground">NISN</p>
          <p class="mt-1 text-sm font-semibold text-foreground" data-field="nisn">-</p>
        </div>
        <div class="rounded-xl border border-border bg-secondary/40 p-4">
          <p class="text-[11px] font-semibold uppercase tracking-wider text-muted-foreground">Jenis Kelamin</p>
          <p class="mt-1 text-sm font-semibold text-foreground" data-field="jk">-</p>
        </div>
        <div class="rounded-xl border border-border bg-secondary/40 p-4">
          <p class="text-[11px] font-semibold uppercase tracking-wider text-muted-foreground">Tempat, Tanggal Lahir</p>
          <p class="mt-1 text-sm font-semibold text-foreground"><span data-field="tempatLahir">-</span>, <span data-field="tanggalLahir">-</span></p>
        </div>
        <div class="rounded-xl border border-border bg-secondary/40 p-4">
          <p class="text-[11px] font-semibold uppercase tracking-wider text-muted-foreground">Agama</p>
          <p class="mt-1 text-sm font-semibold text-foreground" data-field="agama">-</p>
        </div>
      </div>

      <div class="mt-6 flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-primary">
        <x-icon name="school" class="w-4 h-4" /> Sekolah &amp; Jurusan
      </div>
      <div class="mt-3 grid gap-4 sm:grid-cols-2">
        <div class="rounded-xl border border-border bg-secondary/40 p-4 sm:col-span-2">
          <p class="text-[11px] font-semibold uppercase tracking-wider text-muted-foreground">Asal Sekolah</p>
          <p class="mt-1 text-sm font-semibold text-foreground" data-field="asal">-</p>
        </div>
        <div class="rounded-xl border border-border bg-secondary/40 p-4">
          <p class="text-[11px] font-semibold uppercase tracking-wider text-muted-foreground">Pilihan Jurusan 1</p>
          <p class="mt-1 text-sm font-semibold text-foreground" data-field="pilihan1">-</p>
        </div>
        <div class="rounded-xl border border-border bg-secondary/40 p-4">
          <p class="text-[11px] font-semibold uppercase tracking-wider text-muted-foreground">Pilihan Jurusan 2</p>
          <p class="mt-1 text-sm font-semibold text-foreground" data-field="pilihan2">-</p>
        </div>
      </div>

      <div class="mt-6 flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-primary">
        <x-icon name="phone" class="w-4 h-4" /> Kontak &amp; Alamat
      </div>
      <div class="mt-3 grid gap-4 sm:grid-cols-2">
        <div class="flex items-center justify-between gap-3 rounded-xl border border-border bg-secondary/40 p-4">
          <div class="min-w-0">
            <p class="text-[11px] font-semibold uppercase tracking-wider text-muted-foreground">Email</p>
            <p class="mt-1 truncate text-sm font-semibold text-foreground" data-field="email">-</p>
          </div>
          <a href="#" data-href-field="email" data-href-prefix="mailto:" class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg border border-border text-muted-foreground hover:border-primary hover:text-primary" title="Kirim email">
            <x-icon name="mail" class="w-4 h-4" />
          </a>
        </div>
        <div class="flex items-center justify-between gap-3 rounded-xl border border-border bg-secondary/40 p-4">
          <div class="min-w-0">
            <p class="text-[11px] font-semibold uppercase tracking-wider text-muted-foreground">Telepon</p>
            <p class="mt-1 truncate text-sm font-semibold text-foreground" data-field="telepon">-</p>
          </div>
          <a href="#" data-href-field="telepon" data-href-prefix="tel:" class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg border border-border text-muted-foreground hover:border-primary hover:text-primary" title="Hubungi">
            <x-icon name="phone" class="w-4 h-4" />
          </a>
        </div>
        <div class="rounded-xl border border-border bg-secondary/40 p-4 sm:col-span-2">
          <p class="text-[11px] font-semibold uppercase tracking-wider text-muted-foreground">Alamat Lengkap</p>
          <p class="mt-1 text-sm font-medium leading-relaxed text-foreground" data-field="alamat">-</p>
        </div>
      </div>

      <div class="mt-6 flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-primary">
        <x-icon name="users" class="w-4 h-4" /> Data Orang Tua/Wali
      </div>
      <div class="mt-3 grid gap-4 sm:grid-cols-2">
        <div class="rounded-xl border border-border bg-secondary/40 p-4 sm:col-span-2">
          <p class="text-[11px] font-semibold uppercase tracking-wider text-muted-foreground">Nama Orang Tua/Wali</p>
          <p class="mt-1 text-sm font-semibold text-foreground" data-field="namaOrtu">-</p>
        </div>
        <div class="flex items-center justify-between gap-3 rounded-xl border border-border bg-secondary/40 p-4">
          <div class="min-w-0">
            <p class="text-[11px] font-semibold uppercase tracking-wider text-muted-foreground">Telepon Orang Tua/Wali</p>
            <p class="mt-1 truncate text-sm font-semibold text-foreground" data-field="teleponOrtu">-</p>
          </div>
          <a href="#" data-href-field="teleponOrtu" data-href-prefix="tel:" class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg border border-border text-muted-foreground hover:border-primary hover:text-primary" title="Hubungi">
            <x-icon name="phone" class="w-4 h-4" />
          </a>
        </div>
        <div class="rounded-xl border border-border bg-secondary/40 p-4">
          <p class="text-[11px] font-semibold uppercase tracking-wider text-muted-foreground">Pekerjaan Orang Tua/Wali</p>
          <p class="mt-1 text-sm font-semibold text-foreground" data-field="pekerjaanOrtu">-</p>
        </div>
      </div>

      <div class="mt-6 flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-primary">
        <x-icon name="upload" class="w-4 h-4" /> Dokumen Pendukung
      </div>
      <div class="mt-3">
        <a href="#" data-href-field="dokumen" data-href-prefix="" target="_blank" rel="noopener"
           class="pointer-events-none inline-flex items-center gap-2 rounded-xl border border-border bg-secondary/40 px-4 py-3 text-sm font-semibold text-foreground opacity-40 transition-colors hover:border-primary hover:text-primary">
          <x-icon name="file-text" class="w-4 h-4" /> Lihat Berkas Pendukung
        </a>
      </div>

      <div class="mt-6 flex items-center gap-2 rounded-xl bg-accent/60 px-4 py-3 text-xs text-primary">
        <x-icon name="calendar-days" class="w-4 h-4 shrink-0" />
        Mendaftar pada <span class="font-semibold" data-field="tanggal">-</span>
      </div>
    </div>

    {{-- Footer --}}
    <div class="flex shrink-0 flex-wrap justify-end gap-3 border-t border-border px-7 py-4">
      <button type="button" data-modal-close class="rounded-xl border border-border px-5 py-2.5 text-sm font-semibold text-foreground hover:bg-secondary">Tutup</button>
      <a href="#" data-href-field="downloadUrl" data-href-prefix="" class="inline-flex items-center gap-2 rounded-xl bg-navy-gradient px-5 py-2.5 text-sm font-semibold text-hero-foreground shadow-soft hover:-translate-y-0.5 transition-transform">
        <x-icon name="download" class="w-4 h-4" /> <span data-field="downloadLabel">Unduh Formulir (PDF)</span>
      </a>
    </div>
  </div>
</div>

@endsection