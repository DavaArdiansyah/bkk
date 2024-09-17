@extends('layouts.master')
@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('title', 'Cari Lowongan')
@php
    $fileRoute = 'dashboard';
@endphp

@section('assets')
    @vite(['resources/js/components/filepond/pdf.js', 'resources/js/components/sweetalert2/master.js'])
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route ('dashboard')}}">Cari Lowongan</a></li>
            <li class="breadcrumb-item active" aria-current="page">Detail</li>
        </ol>
    </nav>

    <x-detail-lowongan :data="$loker" />
@endsection
