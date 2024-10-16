@extends('layouts.master')
@section('title', 'Detail Info Lowongan')
@php
    $sidebarItemName = 'Info Lowongan';
    $fileRoute = 'perusahaan.info-lowongan.index';
@endphp

@section('assets')
    @vite(['resources/js/components/sweetalert2.js'])
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('perusahaan.info-lowongan.index') }}">Info Lowongan</a></li>
            <li class="breadcrumb-item active" aria-current="page">Detail</li>
        </ol>
    </nav>

    @include('partials.detail-lowongan')
@endsection
