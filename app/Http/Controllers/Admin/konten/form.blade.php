@extends('layouts.admin')
@section('title', ($item ? 'Edit' : 'Tambah').' '.$def['label'])
@section('page-title', ($item ? 'Edit' : 'Tambah').' '.$def['label'])

@section('content')

<div class="mx-auto max-w-2xl rounded-2xl border border-border bg-card p-7 shadow-soft">
  <form method="POST"
        action="{{ $item ? route('admin.konten.update', [$resource, $item->id]) : route('admin.konten.store', $resource) }}"
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
      <a href="{{ route('admin.konten.index', ['tab' => $resource]) }}" class="text-sm font-semibold text-muted-foreground hover:text-primary">Batal</a>
    </div>
  </form>
</div>

@endsection