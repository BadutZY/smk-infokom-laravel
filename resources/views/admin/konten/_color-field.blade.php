{{--
    Pemilih warna untuk field bertipe "color" (mis. Warna Identitas Jurusan).
    Variabel: $name, $field, $item, $def.

    - Teks hex (name="{{ $name }}") adalah nilai yang DISIMPAN. Kosong = otomatis
      (memakai warna bawaan jurusan, lihat Jurusan::resolveWarna()).
    - Pemilih warna bawaan browser + tombol warna cepat hanya membantu mengisi teks hex.
    - Pratinjau kartu ikut berubah langsung (script: initColorFields() di ui-v3.js).
--}}
@php
  $model = $def['model'];
  $hasColumn = \Illuminate\Support\Facades\Schema::hasColumn((new $model)->getTable(), $name);
  $current = strtoupper((string) old($name, $item->$name ?? ''));
  $fallback = method_exists($model, 'resolveWarna')
      ? $model::resolveWarna(null, $item->kode ?? null, (int) ($item->urutan ?? 0))
      : '#2563EB';
  $shown = preg_match('/^#[0-9A-F]{6}$/', $current) ? $current : $fallback;
  $presets = array_values(array_unique(array_map('strtoupper', array_merge(
      array_values((array) config('site.jurusan_warna_default', [])),
      (array) config('site.jurusan_warna_cadangan', [])
  ))));
@endphp

<div data-color-field data-fallback="{{ $fallback }}" class="color-field mt-2 grid gap-5 sm:grid-cols-[1fr_15rem] sm:items-start">
  <div class="grid gap-3">
    <div class="flex items-center gap-3">
      <label for="{{ $name }}-picker" class="color-field-picker" title="Pilih warna">
        <input type="color" id="{{ $name }}-picker" data-color-picker value="{{ strtolower($shown) }}" aria-label="Pilih warna" />
      </label>
      <input type="text" name="{{ $name }}" id="{{ $name }}" data-color-text value="{{ $current }}" maxlength="7"
             placeholder="Otomatis (bawaan)" autocomplete="off" spellcheck="false"
             class="input-field !mt-0 font-mono uppercase" />
      <button type="button" data-color-reset
              class="shrink-0 rounded-xl border border-border px-3.5 py-2.5 text-xs font-semibold text-muted-foreground transition-colors hover:border-primary hover:text-primary">
        Otomatis
      </button>
    </div>

    <div class="flex flex-wrap gap-2" role="group" aria-label="Pilihan warna cepat">
      @foreach ($presets as $preset)
        <button type="button" data-color-swatch="{{ $preset }}" class="color-swatch" style="--sw: {{ $preset }}"
                title="{{ $preset }}" aria-label="Pakai warna {{ $preset }}"></button>
      @endforeach
    </div>

    @if (! empty($field['hint']))
      <p class="text-xs leading-relaxed text-muted-foreground">{{ $field['hint'] }}</p>
    @endif

    @unless ($hasColumn)
      <p class="rounded-lg bg-destructive/10 px-3 py-2 text-xs leading-relaxed text-destructive">
        Kolom warna belum ada di database, jadi pilihan warna belum bisa tersimpan.
        Jalankan <code class="font-mono">php artisan migrate</code> terlebih dahulu.
      </p>
    @endunless
  </div>

  <div>
    <p class="text-xs font-medium text-muted-foreground">Pratinjau kartu</p>
    <div data-color-preview class="major-tile-mini mt-2" style="--major: {{ $shown }}">
      <span data-color-preview-code class="major-tile-mini__code">{{ $item->kode ?? 'KODE' }}</span>
      <span data-color-preview-name class="major-tile-mini__name">{{ $item->nama ?? 'Nama jurusan' }}</span>
    </div>
  </div>
</div>
