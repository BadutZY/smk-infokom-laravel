@extends('layouts.admin')
@section('title', 'Akademik')
@section('page-title', 'Kelola Konten Akademik')

@section('content')

<p class="enter-item enter-d1 mb-6 text-sm text-muted-foreground">{{ $groupMeta['desc'] }}</p>

@include('admin.konten._resource-panel')

@endsection