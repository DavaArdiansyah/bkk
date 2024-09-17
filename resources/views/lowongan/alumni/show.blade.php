@extends('layouts.master')
@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('title', 'Detail Info Lowongan')
@php
    $fileRoute = 'dashboard';
@endphp

@section('assets')
    @vite(['resources/js/components/filepond/pdf.js', 'resources/js/components/sweetalert2/master.js'])
@endsection

@section('content')
<x-detail-lowongan :data="$loker" />
    {{-- @include('partials.detail-lowongan') --}}
@endsection
