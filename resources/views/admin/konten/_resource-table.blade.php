{{--
    Partial tabel CRUD generik untuk SATU resource konten. Dipakai oleh
    admin.konten._resource-panel (lewat tab-nya sendiri), dan juga
    di-include langsung oleh halaman yang menggabungkan resource konten
    ke dalam tab miliknya sendiri, seperti admin.magang-jepang.index
    (tab "Kenapa Magang ke Jepang?" / "Langkah Menuju Jepang") dan
    admin.prestasi-sekolah.index (tab "Bidang Prestasi").

    Variabel yang dibutuhkan:
    - $group : kunci grup, contoh 'magang'
    - $tab   : kunci resource yang sedang aktif, contoh 'magang_alasan'
    - $def   : definisi resource aktif (dari KontenResource::definitions())
    - $rows  : data untuk resource yang sedang aktif
--}}

@php $itemLabel = $def['item_label'] ?? $def['label']; @endphp

<div class="reveal flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
  <p class="text-sm text-muted-foreground">{{ $def['desc'] ?? ('Kelola data '.$itemLabel.'.') }}</p>
  <a href="{{ route('admin.konten.create', [$group, $tab]) }}" class="inline-flex items-center justify-center gap-2 rounded-xl bg-navy-gradient px-5 py-2.5 text-sm font-semibold text-hero-foreground shadow-soft">
    <x-icon name="plus" class="w-4 h-4" /> Tambah {{ $itemLabel }}
  </a>
</div>

<div class="reveal mt-6 overflow-hidden rounded-2xl border border-border bg-card shadow-soft">
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
          <tr class="transition-colors hover:bg-secondary/40">
            <td class="px-6 py-3.5 text-muted-foreground">{{ $item->urutan }}</td>
            @foreach ($def['fields'] as $name => $field)
              <td class="px-6 py-3.5">
                @if (($field['type'] ?? null) === 'image')
                  @if ($item->$name)
                    <img src="{{ \App\Support\Site::imageUrl($item->$name) }}" alt="{{ $field['label'] }}" class="h-12 w-16 rounded-lg object-cover" />
                  @else
                    <span class="text-muted-foreground">&mdash;</span>
                  @endif
                @elseif (($field['type'] ?? null) === 'color')
                  @php
                    $hex = method_exists($def['model'], 'resolveWarna')
                        ? $def['model']::resolveWarna($item->$name ?? null, $item->kode ?? null, (int) $item->urutan)
                        : ($item->$name ?? '#2563EB');
                  @endphp
                  <span class="inline-flex items-center gap-2">
                    <span class="h-6 w-6 rounded-full border border-border shadow-soft" style="background: {{ $hex }}"></span>
                    <span class="font-mono text-xs text-muted-foreground">{{ ! empty($item->$name) ? strtoupper($item->$name) : 'Otomatis' }}</span>
                  </span>
                @elseif (($field['type'] ?? null) === 'lines')
                  <span class="text-muted-foreground">{{ \Illuminate\Support\Str::limit(implode(', ', (array) $item->$name), 60) }}</span>
                @else
                  <span class="text-foreground">{{ \Illuminate\Support\Str::limit((string) $item->$name, 60) }}</span>
                @endif
              </td>
            @endforeach
            <td class="px-6 py-3.5">
              <div class="flex items-center justify-end gap-2">
                <a href="{{ route('admin.konten.edit', [$group, $tab, $item->id]) }}" class="flex h-9 w-9 items-center justify-center rounded-lg border border-border text-muted-foreground hover:text-primary" title="Edit">
                  <x-icon name="pencil" class="w-4 h-4" />
                </a>
                <form method="POST" action="{{ route('admin.konten.destroy', [$group, $tab, $item->id]) }}" data-confirm="Hapus data ini?">
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
              Belum ada data {{ $itemLabel }}.
            </td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>