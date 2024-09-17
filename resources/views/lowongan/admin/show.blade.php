@extends('layouts.master')
@section('title', 'Detail Info Lowongan')
@php
    $sidebarItemName = 'Ajuan Pengguna';
    $fileRoute = 'admin.info-lowongan.index';
@endphp

@section('assets')
    @vite(['resources/js/components/parsley.js', 'resources/js/components/sweetalert2/master.js'])
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route ('admin.info-lowongan.index')}}">Info Lowongan</a></li>
            <li class="breadcrumb-item active" aria-current="page">Detail</li>
        </ol>
    </nav>

    @include('partials.detail-lowongan')
@endsection
