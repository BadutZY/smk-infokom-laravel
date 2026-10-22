@extends('layouts.admin')
@section('title', 'BKK')
@section('page-title', 'Kelola BKK (Bursa Kerja Khusus)')

@section('content')

@php
  $tabs = ['data' => 'Media BKK', 'konten' => 'Konten Umum & Instagram'];
  foreach ($resources as $key => $resDef) {
      $tabs[$key] = $resDef['label'];
  }
@endphp

<div class="reveal mb-6 flex gap-2 overflow-x-auto pb-2">
  @foreach ($tabs as $tabKey => $tabLabel)
    <a href="{{ route('admin.bkk.index', ['tab' => $tabKey]) }}"
       class="shrink-0 rounded-full px-4 py-2 text-sm font-semibold transition-colors {{ $tab === $tabKey ? 'bg-navy-gradient text-hero-foreground shadow-soft' : 'border border-border text-muted-foreground hover:text-primary' }}">
      {{ $tabLabel }}
    </a>
  @endforeach
</div>

@if ($tab === 'data')

  <div class="enter-item enter-d1 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
    <p class="text-sm text-muted-foreground">Kelola foto, video, dan info kegiatan BKK (info loker, pembekalan, penyaluran kerja) yang tampil di halaman publik pada bagian "Kegiatan & Info Terbaru BKK".</p>

    <div class="flex flex-wrap items-center gap-3">
      <a href="{{ route('bkk') }}" target="_blank" class="inline-flex items-center justify-center gap-2 rounded-xl border border-border bg-card px-4 py-2.5 text-sm font-semibold text-foreground shadow-soft hover:bg-secondary">
        <x-icon name="external-link" class="w-4 h-4" /> Lihat Halaman
      </a>
      <a href="{{ route('admin.bkk.create') }}" class="inline-flex items-center justify-center gap-2 rounded-xl bg-navy-gradient px-5 py-2.5 text-sm font-semibold text-hero-foreground shadow-soft">
        <x-icon name="plus" class="w-4 h-4" /> Tambah Media
      </a>
    </div>
  </div>

  <div class="enter-item enter-d2 mt-6 overflow-hidden rounded-2xl border border-border bg-card shadow-soft">
    <div class="overflow-x-auto">
      <table class="w-full min-w-[720px] text-left text-sm">
        <thead class="bg-secondary/60 text-xs uppercase tracking-wider text-muted-foreground">
          <tr>
            <th class="px-6 py-3.5">Judul</th>
            <th class="px-6 py-3.5">Jenis Media</th>
            <th class="px-6 py-3.5">Keterangan</th>
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
                    <img src="{{ $thumb }}" alt="{{ $item->judul }}" class="h-14 w-10 shrink-0 rounded-lg object-cover" />
                  @else
                    <span class="flex h-14 w-10 shrink-0 items-center justify-center rounded-lg bg-navy-gradient text-hero-foreground"><x-icon :name="$icon" class="w-4 h-4" /></span>
                  @endif
                  <div class="leading-tight">
                    <p class="font-medium text-foreground">{{ $item->judul }}</p>
                  </div>
                </div>
              </td>
              <td class="px-6 py-3.5">
                <span class="inline-flex items-center gap-1.5 rounded-full bg-accent px-2.5 py-1 text-xs font-semibold text-primary">
                  <x-icon :name="$icon" class="w-3.5 h-3.5" />{{ $item->jenisLabel() }}
                </span>
              </td>
              <td class="px-6 py-3.5 text-muted-foreground">
                {{ $item->keterangan ? \Illuminate\Support\Str::limit($item->keterangan, 60) : '-' }}
              </td>
              <td class="px-6 py-3.5 text-muted-foreground">{{ $item->urutan }}</td>
              <td class="px-6 py-3.5">
                <div class="flex items-center justify-end gap-2">
                  <a href="{{ route('admin.bkk.edit', $item) }}" class="flex h-9 w-9 items-center justify-center rounded-lg border border-border text-muted-foreground hover:text-primary" title="Edit"><x-icon name="pencil" class="w-4 h-4" /></a>
                  <form method="POST" action="{{ route('admin.bkk.destroy', $item) }}" data-confirm="Hapus data &quot;{{ $item->judul }}&quot;? File foto/video yang diunggah ikut terhapus.">
                    @csrf @method('DELETE')
                    <button type="submit" class="flex h-9 w-9 items-center justify-center rounded-lg border border-border text-muted-foreground hover:border-destructive hover:text-destructive" title="Hapus"><x-icon name="trash" class="w-4 h-4" /></button>
                  </form>
                </div>
              </td>
            </tr>
          @empty
            <tr><td colspan="5" class="px-6 py-10 text-center text-muted-foreground">Belum ada data media BKK.</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

@elseif ($tab === 'konten')

  <p class="enter-item enter-d1 mb-6 text-sm text-muted-foreground">Teks bagian "Apa itu BKK?" dan kartu profil Instagram (nama, handle, bio, statistik, serta tautan) pada bagian "Update Info Loker via Instagram" di halaman publik BKK.</p>

  <div class="enter-item enter-d2 rounded-2xl border border-border bg-card p-7 shadow-soft">
    <form method="POST" action="{{ route('admin.bkk.konten.update') }}" enctype="multipart/form-data" class="grid gap-5 sm:grid-cols-2" data-photo-picker>
      @csrf
      @method('PUT')

      <div class="sm:col-span-2">
        <h4 class="font-display text-sm font-bold text-foreground">Apa itu BKK?</h4>
        <p class="text-xs text-muted-foreground">Tampil pada kartu ringkas di bawah hero halaman publik BKK.</p>
      </div>
      <div class="sm:col-span-2">
        <label for="apa_itu" class="text-sm font-medium text-foreground">Deskripsi BKK</label>
        <textarea name="apa_itu" id="apa_itu" rows="5" class="input-field">{{ old('apa_itu', $konten->apa_itu ?? '') }}</textarea>
        @error('apa_itu') <p class="mt-1 text-xs text-destructive">{{ $message }}</p> @enderror
      </div>

      <div class="sm:col-span-2 mt-2">
        <h4 class="font-display text-sm font-bold text-foreground">Kartu Profil Instagram</h4>
        <p class="text-xs text-muted-foreground">Tampil pada bagian "Update Info Loker via Instagram" dan tombol Instagram di bagian CTA (paling bawah halaman).</p>
      </div>
      <div class="sm:col-span-2">
        <label class="text-sm font-medium text-foreground">Foto Profil</label>
        <p class="text-xs text-muted-foreground">Foto/logo yang tampil di lingkaran avatar kartu Instagram. Disarankan bujur sangkar (1:1).</p>
        @if ($konten->ig_foto ?? null)
          <img src="{{ \App\Support\Site::imageUrl($konten->ig_foto) }}" alt="Foto profil BKK INFOKOM saat ini" class="mt-2 h-20 w-20 rounded-full border border-border object-cover" />
          <label class="mt-2 flex items-center gap-2 text-xs font-medium text-destructive">
            <input type="checkbox" name="hapus_ig_foto" value="1" class="accent-primary" /> Hapus foto ini (kembali ke ikon bawaan)
          </label>
        @endif
        <input type="file" name="ig_foto" accept="image/*" data-preview="image" class="input-field mt-2" />
        <img data-preview-target="image" alt="" class="mt-3 hidden h-20 w-20 rounded-full border border-border object-cover" />
        <p class="mt-1 text-xs text-muted-foreground">Kosongkan jika tidak ingin mengganti foto. Jika belum pernah diisi, kartu memakai ikon bawaan.</p>
        @error('ig_foto') <p class="mt-1 text-xs text-destructive">{{ $message }}</p> @enderror
      </div>
      <div>
        <label for="ig_nama" class="text-sm font-medium text-foreground">Nama Akun</label>
        <input type="text" name="ig_nama" id="ig_nama" value="{{ old('ig_nama', $konten->ig_nama ?? '') }}" class="input-field" placeholder="BKK INFOKOM" />
        @error('ig_nama') <p class="mt-1 text-xs text-destructive">{{ $message }}</p> @enderror
      </div>
      <div>
        <label for="ig_username" class="text-sm font-medium text-foreground">Username / Handle</label>
        <input type="text" name="ig_username" id="ig_username" value="{{ old('ig_username', $konten->ig_username ?? '') }}" class="input-field" placeholder="bkkinfokom" />
        <p class="mt-1 text-xs text-muted-foreground">Tanpa tanda &laquo;&#64;&raquo;, contoh: bkkinfokom.</p>
        @error('ig_username') <p class="mt-1 text-xs text-destructive">{{ $message }}</p> @enderror
      </div>
      <div class="sm:col-span-2">
        <label for="ig_bio" class="text-sm font-medium text-foreground">Bio Singkat</label>
        <textarea name="ig_bio" id="ig_bio" rows="2" class="input-field">{{ old('ig_bio', $konten->ig_bio ?? '') }}</textarea>
        @error('ig_bio') <p class="mt-1 text-xs text-destructive">{{ $message }}</p> @enderror
      </div>
      <div class="sm:col-span-2">
        <label for="ig_url" class="text-sm font-medium text-foreground">Tautan Instagram</label>
        <input type="text" name="ig_url" id="ig_url" value="{{ old('ig_url', $konten->ig_url ?? '') }}" class="input-field" placeholder="https://www.instagram.com/bkkinfokom/" />
        @error('ig_url') <p class="mt-1 text-xs text-destructive">{{ $message }}</p> @enderror
      </div>
      <div>
        <label for="ig_kiriman" class="text-sm font-medium text-foreground">Jumlah Kiriman</label>
        <input type="number" name="ig_kiriman" id="ig_kiriman" value="{{ old('ig_kiriman', $konten->ig_kiriman ?? 0) }}" class="input-field" />
        @error('ig_kiriman') <p class="mt-1 text-xs text-destructive">{{ $message }}</p> @enderror
      </div>
      <div>
        <label for="ig_pengikut" class="text-sm font-medium text-foreground">Jumlah Pengikut</label>
        <input type="number" name="ig_pengikut" id="ig_pengikut" value="{{ old('ig_pengikut', $konten->ig_pengikut ?? 0) }}" class="input-field" />
        @error('ig_pengikut') <p class="mt-1 text-xs text-destructive">{{ $message }}</p> @enderror
      </div>
      <div>
        <label for="ig_diikuti" class="text-sm font-medium text-foreground">Jumlah Diikuti</label>
        <input type="number" name="ig_diikuti" id="ig_diikuti" value="{{ old('ig_diikuti', $konten->ig_diikuti ?? 0) }}" class="input-field" />
        @error('ig_diikuti') <p class="mt-1 text-xs text-destructive">{{ $message }}</p> @enderror
      </div>

      <div class="sm:col-span-2 mt-2 flex items-center gap-3">
        <button type="submit" class="inline-flex items-center gap-2 rounded-full bg-navy-gradient px-6 py-3 text-sm font-semibold text-hero-foreground shadow-soft">
          <x-icon name="check" class="w-4 h-4" /> Simpan
        </button>
      </div>
    </form>
  </div>

  <script>
    // Pratinjau foto profil Instagram yang baru dipilih, sebelum disimpan.
    (function () {
      var root = document.querySelector('[data-photo-picker]');
      if (!root) return;
      root.querySelectorAll('input[type="file"][data-preview]').forEach(function (input) {
        input.addEventListener('change', function () {
          var target = input.parentElement.querySelector('[data-preview-target="' + input.dataset.preview + '"]');
          if (!target) return;
          var file = input.files && input.files[0];
          if (!file) { target.classList.add('hidden'); return; }
          target.src = URL.createObjectURL(file);
          target.classList.remove('hidden');
        });
      });
    })();
  </script>

@else

  @php $def = $resources[$tab]; @endphp
  @include('admin.konten._resource-table', ['group' => 'bkk', 'tab' => $tab, 'def' => $def, 'rows' => $rows])

@endif

@endsection