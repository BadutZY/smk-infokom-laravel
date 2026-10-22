@extends('layouts.admin')
@section('title', 'Pesan Masuk')
@section('page-title', 'Pesan Masuk')

@section('content')

<div class="enter-item enter-d1 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
  <form method="GET" class="flex flex-1 flex-wrap gap-3">
    <div class="relative flex-1 min-w-[200px]">
      <x-icon name="search" class="pointer-events-none absolute left-3.5 top-1/2 w-4 h-4 -translate-y-1/2 text-muted-foreground" />
      <input type="text" name="search" value="{{ $search }}" placeholder="Cari nama, email, atau subjek..." class="input-field pl-10" />
    </div>
    <select name="filter" onchange="this.form.submit()" class="input-field w-auto">
      <option value="semua" @selected($filter === 'semua')>Semua Status</option>
      <option value="belum_dibaca" @selected($filter === 'belum_dibaca')>Belum Dibaca</option>
      <option value="dibaca" @selected($filter === 'dibaca')>Sudah Dibaca</option>
    </select>
    <button type="submit" class="rounded-xl bg-secondary px-4 py-2.5 text-sm font-semibold text-secondary-foreground">Cari</button>
  </form>
  <span class="rounded-full bg-accent px-4 py-2 text-sm font-semibold text-primary">{{ $unreadCount }} pesan belum dibaca</span>
</div>

<div class="stagger-group mt-6 space-y-3">
  @forelse ($data as $pesan)
    <div class="stagger-item card-hover rounded-2xl border border-border bg-card p-6 shadow-soft {{ $pesan->status === 'belum_dibaca' ? 'border-l-4 border-l-gold' : '' }}">
      <div class="flex flex-wrap items-start justify-between gap-3">
        <div>
          <div class="flex items-center gap-2">
            <p class="font-display text-sm font-bold text-foreground">{{ $pesan->subjek }}</p>
            @if ($pesan->status === 'belum_dibaca')
              <span class="rounded-full bg-gold/20 px-2 py-0.5 text-[10px] font-bold text-gold-foreground">BARU</span>
            @endif
          </div>
          <p class="mt-1 text-xs text-muted-foreground">{{ $pesan->nama }} &middot; {{ $pesan->email }} &middot; {{ \App\Support\Site::formatTanggal($pesan->created_at) }}</p>
        </div>
        <div class="flex items-center gap-2">
          <button
            type="button"
            data-modal-open="#modal-pesan-detail"
            data-subjek="{{ $pesan->subjek }}"
            data-nama="{{ $pesan->nama }}"
            data-email="{{ $pesan->email }}"
            data-tanggal="{{ \App\Support\Site::formatTanggal($pesan->created_at) }}"
            data-status="{{ $pesan->status === 'belum_dibaca' ? 'Belum Dibaca' : 'Sudah Dibaca' }}"
            data-pesan="{{ $pesan->pesan }}"
            title="Lihat detail lengkap"
            class="flex h-9 w-9 items-center justify-center rounded-lg border border-border text-muted-foreground hover:border-primary hover:text-primary"
          >
            <x-icon name="file-text" class="w-4 h-4" />
          </button>
          @if ($pesan->status === 'belum_dibaca')
            <form method="POST" action="{{ route('admin.pesan.show', $pesan) }}">
              @csrf
              <button type="submit" class="flex h-9 w-9 items-center justify-center rounded-lg border border-border text-muted-foreground hover:text-primary" title="Tandai dibaca"><x-icon name="eye" class="w-4 h-4" /></button>
            </form>
          @endif
          <form method="POST" action="{{ route('admin.pesan.destroy', $pesan) }}" data-confirm="Hapus pesan ini?">
            @csrf @method('DELETE')
            <button type="submit" class="flex h-9 w-9 items-center justify-center rounded-lg border border-border text-muted-foreground hover:border-destructive hover:text-destructive" title="Hapus"><x-icon name="trash" class="w-4 h-4" /></button>
          </form>
        </div>
      </div>
      <p class="mt-3 line-clamp-2 text-sm leading-relaxed text-muted-foreground">{{ $pesan->pesan }}</p>
    </div>
  @empty
    <div class="rounded-2xl border border-border bg-card p-10 text-center shadow-soft">
      <p class="text-sm text-muted-foreground">Belum ada pesan masuk.</p>
    </div>
  @endforelse
</div>

{{-- Modal Detail Pesan Masuk --}}
<div id="modal-pesan-detail" data-modal class="fixed inset-0 z-50 hidden items-center justify-center bg-foreground/50 p-4 backdrop-blur-sm">
  <div data-modal-panel class="max-h-[92vh] w-full max-w-xl overflow-hidden rounded-3xl bg-card shadow-lift flex flex-col">

    {{-- Header --}}
    <div class="relative shrink-0 overflow-hidden bg-navy-gradient px-7 py-7 text-hero-foreground">
      <div class="pointer-events-none absolute -right-10 -top-10 h-40 w-40 rounded-full bg-white/5"></div>
      <div class="relative flex items-start justify-between gap-4">
        <div class="flex items-center gap-4">
          <span class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-white/15">
            <x-icon name="message-square" class="w-6 h-6" />
          </span>
          <div class="min-w-0">
            <p class="truncate font-display text-base font-bold" data-field="subjek">-</p>
            <p class="mt-0.5 flex items-center gap-1.5 text-xs text-white/70">
              <x-icon name="calendar-days" class="w-3.5 h-3.5" /> <span data-field="tanggal">-</span>
            </p>
          </div>
        </div>
        <button type="button" data-modal-close class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-white/10 hover:bg-white/20">
          <x-icon name="x" class="w-4 h-4" />
        </button>
      </div>
      <div class="relative mt-5">
        <span class="inline-flex items-center gap-1.5 rounded-full bg-white/15 px-3 py-1 text-xs font-semibold" data-field="status">-</span>
      </div>
    </div>

    {{-- Body --}}
    <div class="min-h-0 flex-1 overflow-y-auto px-7 py-6">

      <div class="flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-primary">
        <x-icon name="user" class="w-4 h-4" /> Data Pengirim
      </div>
      <div class="mt-3 grid gap-4 sm:grid-cols-2">
        <div class="rounded-xl border border-border bg-secondary/40 p-4">
          <p class="text-[11px] font-semibold uppercase tracking-wider text-muted-foreground">Nama Pengirim</p>
          <p class="mt-1 text-sm font-semibold text-foreground" data-field="nama">-</p>
        </div>
        <div class="flex items-center justify-between gap-3 rounded-xl border border-border bg-secondary/40 p-4">
          <div class="min-w-0">
            <p class="text-[11px] font-semibold uppercase tracking-wider text-muted-foreground">Email</p>
            <p class="mt-1 truncate text-sm font-semibold text-foreground" data-field="email">-</p>
          </div>
          <a href="#" data-href-field="email" data-href-prefix="mailto:" class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg border border-border text-muted-foreground hover:border-primary hover:text-primary" title="Balas via email">
            <x-icon name="reply" class="w-4 h-4" />
          </a>
        </div>
      </div>

      <div class="mt-6 flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-primary">
        <x-icon name="mail" class="w-4 h-4" /> Isi Pesan Lengkap
      </div>
      <div class="mt-3 rounded-2xl border border-border bg-secondary/40 p-5">
        <p class="whitespace-pre-line text-sm leading-relaxed text-foreground" data-field="pesan">-</p>
      </div>
    </div>

    {{-- Footer --}}
    <div class="flex shrink-0 flex-wrap justify-end gap-3 border-t border-border px-7 py-4">
      <a href="#" data-href-field="email" data-href-prefix="mailto:" class="inline-flex items-center gap-2 rounded-xl bg-navy-gradient px-5 py-2.5 text-sm font-semibold text-hero-foreground shadow-soft hover:-translate-y-0.5 transition-transform">
        <x-icon name="reply" class="w-4 h-4" /> Balas via Email
      </a>
      <button type="button" data-modal-close class="rounded-xl border border-border px-5 py-2.5 text-sm font-semibold text-foreground hover:bg-secondary">Tutup</button>
    </div>
  </div>
</div>

@endsection