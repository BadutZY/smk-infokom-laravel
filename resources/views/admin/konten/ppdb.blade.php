@extends('layouts.admin')
@section('title', 'Konten PPDB')
@section('page-title', 'Kelola Konten PPDB')

@section('content')

<p class="enter-item enter-d1 mb-6 text-sm text-muted-foreground">{{ $groupMeta['desc'] }}</p>
<p class="mb-6 text-xs text-muted-foreground">
  Halaman ini khusus untuk konten halaman publik PPDB. Untuk data pendaftar, buka menu <span class="font-semibold text-foreground">"Data PPDB"</span>,
  dan untuk total biaya per gelombang buka menu <span class="font-semibold text-foreground">"Profil Sekolah"</span>.
</p>

@include('admin.konten._resource-panel')

@endsection