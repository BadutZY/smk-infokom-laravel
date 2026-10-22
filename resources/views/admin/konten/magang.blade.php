@extends('layouts.admin')
@section('title', 'Konten Magang Jepang')
@section('page-title', 'Kelola Konten Magang Jepang')

@section('content')

<p class="enter-item enter-d1 mb-6 text-sm text-muted-foreground">{{ $groupMeta['desc'] }}</p>

@include('admin.konten._resource-panel')

@endsection