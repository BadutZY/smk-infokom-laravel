@extends('layouts.admin')
@php $itemLabel = $def['item_label'] ?? $def['label']; @endphp
@php $backRoute = \App\Support\KontenResource::backRoute($group); @endphp
@section('title', ($item ? 'Edit' : 'Tambah').' '.$itemLabel)
@section('page-title', ($item ? 'Edit' : 'Tambah').' '.$itemLabel)

@section('content')

<a href="{{ route($backRoute, ['tab' => $resource]) }}" class="enter-item enter-d1 inline-flex items-center gap-1 text-sm text-muted-foreground hover:text-primary">
  <x-icon name="arrow-left" class="w-4 h-4" /> Kembali
</a>

<div class="enter-item enter-d2 mx-auto mt-4 max-w-2xl rounded-2xl border border-border bg-card p-7 shadow-soft">
  <form method="POST"
        action="{{ $item ? route('admin.konten.update', [$group, $resource, $item->id]) : route('admin.konten.store', [$group, $resource]) }}"
        enctype="multipart/form-data" class="grid gap-5">
    @csrf
    @if ($item) @method('PUT') @endif

    <div>
      <label for="urutan" class="text-sm font-medium text-foreground">Urutan Tampil</label>
      <input type="number" name="urutan" id="urutan" value="{{ old('urutan', $item->urutan ?? '') }}" class="input-field" placeholder="Kosongkan untuk otomatis di urutan terakhir" />
      @error('urutan') <p class="mt-1 text-xs text-destructive">{{ $message }}</p> @enderror
    </div>

    @foreach ($def['fields'] as $name => $field)
      @php $type = $field['type'] ?? 'text'; @endphp
      <div>
        <label for="{{ $name }}" class="text-sm font-medium text-foreground">{{ $field['label'] }}</label>

        @if ($type === 'textarea')
          <textarea name="{{ $name }}" id="{{ $name }}" rows="4" class="input-field">{{ old($name, $item->$name ?? '') }}</textarea>

        @elseif ($type === 'lines')
          <textarea name="{{ $name }}" id="{{ $name }}" rows="4" class="input-field">{{ old($name, $item ? implode("\n", (array) $item->$name) : '') }}</textarea>
          <p class="mt-1 text-xs text-muted-foreground">Satu poin per baris.</p>

        @elseif ($type === 'number')
          <input type="number" name="{{ $name }}" id="{{ $name }}" value="{{ old($name, $item->$name ?? '') }}" class="input-field" />

        @elseif ($type === 'color')
          @include('admin.konten._color-field', ['name' => $name, 'field' => $field, 'item' => $item, 'def' => $def])

        @elseif ($type === 'select')
          @php $selected = (string) old($name, $item->$name ?? ($field['default'] ?? '')); @endphp
          <select name="{{ $name }}" id="{{ $name }}" class="input-field">
            @foreach (($field['options'] ?? []) as $optValue => $optLabel)
              <option value="{{ $optValue }}" @selected($selected === (string) $optValue)>{{ $optLabel }}</option>
            @endforeach
          </select>
          @if (! empty($field['hint']))
            <p class="mt-1 text-xs text-muted-foreground">{{ $field['hint'] }}</p>
          @endif

        @elseif ($type === 'image')
          @if ($item && $item->$name)
            <img src="{{ \App\Support\Site::imageUrl($item->$name) }}" alt="{{ $field['label'] }}" class="mt-2 mb-3 h-28 w-full max-w-xs rounded-xl object-cover" />
          @endif
          <input type="file" name="{{ $name }}" id="{{ $name }}" accept="image/*" class="input-field" />
          @if ($item)
            <p class="mt-1 text-xs text-muted-foreground">Kosongkan jika tidak ingin mengganti gambar.</p>
          @endif

        @else
          <input type="text" name="{{ $name }}" id="{{ $name }}" value="{{ old($name, $item->$name ?? '') }}" class="input-field" />
        @endif

        @error($name) <p class="mt-1 text-xs text-destructive">{{ $message }}</p> @enderror
      </div>
    @endforeach

    <div class="mt-2 flex items-center gap-3">
      <button type="submit" class="inline-flex items-center gap-2 rounded-full bg-navy-gradient px-6 py-3 text-sm font-semibold text-hero-foreground shadow-soft">
        <x-icon name="check" class="w-4 h-4" /> Simpan
      </button>
      <a href="{{ route($backRoute, ['tab' => $resource]) }}" class="text-sm font-semibold text-muted-foreground hover:text-primary">Batal</a>
    </div>
  </form>
</div>

@endsection