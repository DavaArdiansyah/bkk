@extends('layouts.master')
@section('title', 'Detail Info Lowongan')
@php
$sidebarItemName = 'Ajuan Pengguna'; $fileRoute = 'admin.info-lowongan.index';
@endphp

@section('assets')
@vite(['resources/js/components/parsley.js' ,'resources/js/components/sweetalert2/master.js'])
@endsection

@section('content')
    @include('partials.detail-lowongan')
@endsection
