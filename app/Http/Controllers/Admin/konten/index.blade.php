@extends('layouts.admin')
@section('title', 'Konten Website')
@section('page-title', 'Kelola Konten Website')

@section('content')

<p class="mb-5 text-sm text-muted-foreground">
  Semua teks dan gambar yang tampil di situs publik bisa diatur di sini, tanpa perlu mengubah database secara langsung.
</p>

<div class="mb-6 flex gap-2 overflow-x-auto pb-2">
  <a href="{{ route('admin.konten.index', ['tab' => 'profil']) }}"
     class="shrink-0 rounded-full px-4 py-2 text-sm font-semibold transition-colors {{ $tab === 'profil' ? 'bg-navy-gradient text-hero-foreground shadow-soft' : 'border border-border text-muted-foreground hover:text-primary' }}">
    Profil Sekolah
  </a>
  @foreach ($resources as $key => $def)
    <a href="{{ route('admin.konten.index', ['tab' => $key]) }}"
       class="shrink-0 rounded-full px-4 py-2 text-sm font-semibold transition-colors {{ $tab === $key ? 'bg-navy-gradient text-hero-foreground shadow-soft' : 'border border-border text-muted-foreground hover:text-primary' }}">
      {{ $def['label'] }}
    </a>
  @endforeach
</div>

@if ($tab === 'profil')

  <div class="rounded-2xl border border-border bg-card p-7 shadow-soft">
    <form method="POST" action="{{ route('admin.konten.profil.update') }}" enctype="multipart/form-data" class="grid gap-5 sm:grid-cols-2">
      @csrf
      @method('PUT')

      <div class="sm:col-span-2">
        <h3 class="font-display text-sm font-bold text-foreground">Identitas Sekolah</h3>
      </div>

      <div>
        <label for="nama" class="text-sm font-medium text-foreground">Nama Lengkap Sekolah</label>
        <input type="text" name="nama" id="nama" value="{{ old('nama', $profil->nama ?? '') }}" class="input-field" />
        @error('nama') <p class="mt-1 text-xs text-destructive">{{ $message }}</p> @enderror
      </div>
      <div>
        <label for="nama_singkat" class="text-sm font-medium text-foreground">Nama Singkat</label>
        <input type="text" name="nama_singkat" id="nama_singkat" value="{{ old('nama_singkat', $profil->nama_singkat ?? '') }}" class="input-field" />
        @error('nama_singkat') <p class="mt-1 text-xs text-destructive">{{ $message }}</p> @enderror
      </div>
      <div>
        <label for="brand_atas" class="text-sm font-medium text-foreground">Brand Baris Atas (logo/navbar)</label>
        <input type="text" name="brand_atas" id="brand_atas" value="{{ old('brand_atas', $profil->brand_atas ?? '') }}" class="input-field" />
        @error('brand_atas') <p class="mt-1 text-xs text-destructive">{{ $message }}</p> @enderror
      </div>
      <div>
        <label for="brand_bawah" class="text-sm font-medium text-foreground">Brand Baris Bawah (logo/navbar)</label>
        <input type="text" name="brand_bawah" id="brand_bawah" value="{{ old('brand_bawah', $profil->brand_bawah ?? '') }}" class="input-field" />
        @error('brand_bawah') <p class="mt-1 text-xs text-destructive">{{ $message }}</p> @enderror
      </div>
      <div class="sm:col-span-2">
        <label for="tagline" class="text-sm font-medium text-foreground">Tagline</label>
        <textarea name="tagline" id="tagline" rows="2" class="input-field">{{ old('tagline', $profil->tagline ?? '') }}</textarea>
        @error('tagline') <p class="mt-1 text-xs text-destructive">{{ $message }}</p> @enderror
      </div>

      <div class="sm:col-span-2 mt-2">
        <h3 class="font-display text-sm font-bold text-foreground">Kontak &amp; Alamat</h3>
      </div>
      <div class="sm:col-span-2">
        <label for="alamat" class="text-sm font-medium text-foreground">Alamat</label>
        <textarea name="alamat" id="alamat" rows="2" class="input-field">{{ old('alamat', $profil->alamat ?? '') }}</textarea>
        @error('alamat') <p class="mt-1 text-xs text-destructive">{{ $message }}</p> @enderror
      </div>
      <div>
        <label for="telepon" class="text-sm font-medium text-foreground">Telepon</label>
        <input type="text" name="telepon" id="telepon" value="{{ old('telepon', $profil->telepon ?? '') }}" class="input-field" />
        @error('telepon') <p class="mt-1 text-xs text-destructive">{{ $message }}</p> @enderror
      </div>
      <div>
        <label for="whatsapp" class="text-sm font-medium text-foreground">WhatsApp</label>
        <input type="text" name="whatsapp" id="whatsapp" value="{{ old('whatsapp', $profil->whatsapp ?? '') }}" class="input-field" />
        @error('whatsapp') <p class="mt-1 text-xs text-destructive">{{ $message }}</p> @enderror
      </div>
      <div>
        <label for="email" class="text-sm font-medium text-foreground">Email</label>
        <input type="email" name="email" id="email" value="{{ old('email', $profil->email ?? '') }}" class="input-field" />
        @error('email') <p class="mt-1 text-xs text-destructive">{{ $message }}</p> @enderror
      </div>
      <div>
        <label for="jam_operasional" class="text-sm font-medium text-foreground">Jam Operasional</label>
        <input type="text" name="jam_operasional" id="jam_operasional" value="{{ old('jam_operasional', $profil->jam_operasional ?? '') }}" class="input-field" />
        @error('jam_operasional') <p class="mt-1 text-xs text-destructive">{{ $message }}</p> @enderror
      </div>
      <div>
        <label for="kepala_sekolah" class="text-sm font-medium text-foreground">Kepala Sekolah</label>
        <input type="text" name="kepala_sekolah" id="kepala_sekolah" value="{{ old('kepala_sekolah', $profil->kepala_sekolah ?? '') }}" class="input-field" />
        @error('kepala_sekolah') <p class="mt-1 text-xs text-destructive">{{ $message }}</p> @enderror
      </div>

      <div class="sm:col-span-2 mt-2">
        <h3 class="font-display text-sm font-bold text-foreground">Visi</h3>
        <p class="text-xs text-muted-foreground">Untuk mengubah Misi dan Tujuan, buka tab "Misi" / "Tujuan" di atas.</p>
      </div>
      <div class="sm:col-span-2">
        <textarea name="visi" id="visi" rows="3" class="input-field">{{ old('visi', $profil->visi ?? '') }}</textarea>
        @error('visi') <p class="mt-1 text-xs text-destructive">{{ $message }}</p> @enderror
      </div>

      <div class="sm:col-span-2 mt-2">
        <h3 class="font-display text-sm font-bold text-foreground">Gambar</h3>
      </div>
      <div>
        <label for="gambar_hero" class="text-sm font-medium text-foreground">Gambar Hero (Beranda)</label>
        @if ($profil?->gambar_hero)
          <img src="{{ \App\Support\Site::imageUrl($profil->gambar_hero) }}" alt="Gambar hero" class="mt-2 mb-2 h-28 w-full rounded-xl object-cover" />
        @endif
        <input type="file" name="gambar_hero" id="gambar_hero" accept="image/*" class="input-field" />
        <p class="mt-1 text-xs text-muted-foreground">Kosongkan jika tidak ingin mengganti gambar.</p>
        @error('gambar_hero') <p class="mt-1 text-xs text-destructive">{{ $message }}</p> @enderror
      </div>
      <div>
        <label for="gambar_siswa" class="text-sm font-medium text-foreground">Gambar Siswa (Tentang Kami)</label>
        @if ($profil?->gambar_siswa)
          <img src="{{ \App\Support\Site::imageUrl($profil->gambar_siswa) }}" alt="Gambar siswa" class="mt-2 mb-2 h-28 w-full rounded-xl object-cover" />
        @endif
        <input type="file" name="gambar_siswa" id="gambar_siswa" accept="image/*" class="input-field" />
        <p class="mt-1 text-xs text-muted-foreground">Kosongkan jika tidak ingin mengganti gambar.</p>
        @error('gambar_siswa') <p class="mt-1 text-xs text-destructive">{{ $message }}</p> @enderror
      </div>

      <div class="sm:col-span-2 mt-2">
        <h3 class="font-display text-sm font-bold text-foreground">Total Biaya PPDB per Gelombang</h3>
        <p class="text-xs text-muted-foreground">Rincian per jenis biaya diatur di tab "Rincian Biaya PPDB".</p>
      </div>
      <div>
        <label for="total_biaya_gelombang1" class="text-sm font-medium text-foreground">Total Gelombang 1 (Rp)</label>
        <input type="number" name="total_biaya_gelombang1" id="total_biaya_gelombang1" value="{{ old('total_biaya_gelombang1', $profil->total_biaya_gelombang1 ?? 0) }}" class="input-field" />
        @error('total_biaya_gelombang1') <p class="mt-1 text-xs text-destructive">{{ $message }}</p> @enderror
      </div>
      <div>
        <label for="total_biaya_gelombang2" class="text-sm font-medium text-foreground">Total Gelombang 2 (Rp)</label>
        <input type="number" name="total_biaya_gelombang2" id="total_biaya_gelombang2" value="{{ old('total_biaya_gelombang2', $profil->total_biaya_gelombang2 ?? 0) }}" class="input-field" />
        @error('total_biaya_gelombang2') <p class="mt-1 text-xs text-destructive">{{ $message }}</p> @enderror
      </div>
      <div>
        <label for="total_biaya_gelombang3" class="text-sm font-medium text-foreground">Total Gelombang 3 (Rp)</label>
        <input type="number" name="total_biaya_gelombang3" id="total_biaya_gelombang3" value="{{ old('total_biaya_gelombang3', $profil->total_biaya_gelombang3 ?? 0) }}" class="input-field" />
        @error('total_biaya_gelombang3') <p class="mt-1 text-xs text-destructive">{{ $message }}</p> @enderror
      </div>

      <div class="sm:col-span-2 mt-2 flex items-center gap-3">
        <button type="submit" class="shine inline-flex items-center gap-2 rounded-full bg-navy-gradient px-6 py-3 text-sm font-semibold text-hero-foreground shadow-soft">
          <x-icon name="check" class="w-4 h-4" /> Simpan Profil
        </button>
      </div>
    </form>
  </div>

@else
  @php $def = $resources[$tab]; @endphp

  <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
    <p class="text-sm text-muted-foreground">{{ $def['desc'] ?? ('Kelola data '.$def['label'].'.') }}</p>
    <a href="{{ route('admin.konten.create', $tab) }}" class="inline-flex items-center justify-center gap-2 rounded-xl bg-navy-gradient px-5 py-2.5 text-sm font-semibold text-hero-foreground shadow-soft">
      <x-icon name="plus" class="w-4 h-4" /> Tambah {{ $def['label'] }}
    </a>
  </div>

  <div class="mt-6 overflow-hidden rounded-2xl border border-border bg-card shadow-soft">
    <div class="overflow-x-auto">
      <table class="w-full min-w-[720px] text-left text-sm">
        <thead class="bg-secondary/60 text-xs uppercase tracking-wider text-muted-foreground">
          <tr>
            <th class="px-6 py-3.5">Urutan</th>
            @foreach ($def['fields'] as $name => $field)
              <th class="px-6 py-3.5">{{ $field['label'] }}</th>
            @endforeach
            <th class="px-6 py-3.5 text-right">Aksi</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-border">
          @forelse ($rows as $item)
            <tr>
              <td class="px-6 py-3.5 text-muted-foreground">{{ $item->urutan }}</td>
              @foreach ($def['fields'] as $name => $field)
                <td class="px-6 py-3.5">
                  @if (($field['type'] ?? null) === 'image')
                    @if ($item->$name)
                      <img src="{{ \App\Support\Site::imageUrl($item->$name) }}" alt="{{ $field['label'] }}" class="h-12 w-16 rounded-lg object-cover" />
                    @else
                      <span class="text-muted-foreground">&mdash;</span>
                    @endif
                  @elseif (($field['type'] ?? null) === 'lines')
                    <span class="text-muted-foreground">{{ \Illuminate\Support\Str::limit(implode(', ', (array) $item->$name), 60) }}</span>
                  @else
                    <span class="text-foreground">{{ \Illuminate\Support\Str::limit((string) $item->$name, 60) }}</span>
                  @endif
                </td>
              @endforeach
              <td class="px-6 py-3.5">
                <div class="flex items-center justify-end gap-2">
                  <a href="{{ route('admin.konten.edit', [$tab, $item->id]) }}" class="flex h-9 w-9 items-center justify-center rounded-lg border border-border text-muted-foreground hover:text-primary" title="Edit">
                    <x-icon name="pencil" class="w-4 h-4" />
                  </a>
                  <form method="POST" action="{{ route('admin.konten.destroy', [$tab, $item->id]) }}" data-confirm="Hapus data ini?">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="flex h-9 w-9 items-center justify-center rounded-lg border border-border text-muted-foreground hover:border-destructive hover:text-destructive" title="Hapus">
                      <x-icon name="trash" class="w-4 h-4" />
                    </button>
                  </form>
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="{{ count($def['fields']) + 2 }}" class="px-6 py-10 text-center text-muted-foreground">
                Belum ada data {{ $def['label'] }}.
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
@endif

@endsection