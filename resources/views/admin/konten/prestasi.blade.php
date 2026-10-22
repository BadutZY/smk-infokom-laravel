@extends('layouts.admin')
@section('title', 'Bidang Prestasi')
@section('page-title', 'Kelola Bidang Prestasi')

@section('content')

<p class="enter-item enter-d1 mb-6 text-sm text-muted-foreground">{{ $groupMeta['desc'] }}</p>

@include('admin.konten._resource-panel')

@endsection