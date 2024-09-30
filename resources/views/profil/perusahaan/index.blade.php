@extends('layouts.master')
@section('meta')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('title', 'Profil')
<?php $fileRoute = 'profil'; ?>
@section('assets')
    @vite(['resources/js/components/sweetalert2/master.js', 'resources/js/components/filepond/images.js'])
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Profil</li>
        </ol>
    </nav>
    <!-- Section 1: Profil Information -->
    <div class="card">
        <div class="card-body">
            <div class="row align-items-center">
                <!-- Avatar -->
                <div class="col-12 col-md-2 mb-3 mb-md-0 text-center">
                    <div class="avatar avatar-2xl border border-4 border-light">
                        <a data-bs-toggle="modal" data-bs-target="#modal-avatar-edit-{{ $perusahaan->id_data_perusahaan }}">
                            <img src="{{ isset($perusahaan->nama_file_logo) ? asset('storage/images/' . $perusahaan->nama_file_logo) : asset('assets/static/images/faces/2.jpg') }}"
                                class="img-fluid rounded-circle" alt="Avatar">
                        </a>
                        <x-modal.avatar id="{{ $perusahaan->id_data_perusahaan }}" title="Perbaharui Logo Perusahaan"
                            action="{{ route('profil.update', Auth::user()->username) }}" for="Perusahaan" />
                    </div>
                </div>
                <!-- End Avatar -->

                <!-- Profil Data -->
                <div class="col-12 col-md-10 mb-3 mb-md-0">
                    <div class="row align-items-center">
                        <div class="col-10">
                            <h5 class="font-weight-bold mb-2">{{ $perusahaan->nama }}</h5>
                        </div>
                        <div class="col-2 text-end">
                            <a href="{{ route('profil.edit', Auth::user()->username) }}" class="btn btn-link me-2">
                                <i class="bi bi-pencil fs-5 me-1"></i>
                            </a>
                        </div>
                    </div>
                    <p class="mb-1"><strong>Username:</strong> {{ Auth::user()->username }}</p>
                    <p class="mb-1"><strong>Bidang Usaha:</strong> {{ $perusahaan->bidang_usaha }}</p>
                    <p class="mb-1"><strong>No Telepon:</strong> {{ $perusahaan->no_telepon }}</p>
                    <p class="mb-1"><strong>Alamat:</strong> {{ $perusahaan->alamat }}</p>
                </div>
                <!-- End Profil Data -->
            </div>
        </div>
    </div>
    <!-- End Section 1 -->
@endsection
