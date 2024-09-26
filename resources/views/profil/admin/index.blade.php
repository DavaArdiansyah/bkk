@extends('layouts.master')
@section('title', 'Profil')
@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@php $fileRoute = 'profil'; @endphp

@section('assets')
    @vite(['resources/js/components/filepond/images.js', 'resources/js/components/sweetalert2/master.js'])
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
                        <a data-bs-toggle="modal" data-bs-target="#modal-avatar-edit-{{ $admin->nip }}">
                            <img src="{{ isset($admin->nama_file_foto) ? asset('storage/images/' . $admin->nama_file_foto) : ($admin->jenis_kelamin == 'Laki Laki' ? asset('assets/static/images/faces/2.jpg') : asset('assets/static/images/faces/1.jpg')) }}"
                                class="img-fluid rounded-circle" alt="Avatar">
                        </a>
                        <x-modal.avatar id="{{ $admin->nip }}" title="Perbaharui Avatar Anda"
                            action="{{ route('profil.update', $admin->user->username) }}" for="Admin BKK" />
                    </div>
                </div>
                <!-- End Avatar -->

                <!-- Profil Data -->
                <div class="col-12 col-md-10 mb-3 mb-md-0">
                    <div class="row align-items-center">
                        <div class="col-10">
                            <h5 class="font-weight-bold mb-2">{{ $admin->user->username }} - {{ $admin->nama }}</h5>
                        </div>
                        <div class="col-2 text-end">
                            <a href="{{ route('profil.edit', $admin->user->username) }}" class="btn btn-link me-2">
                                <i class="bi bi-pencil fs-5 me-1"></i>
                            </a>
                        </div>
                    </div>
                    <p class="mb-1"><strong>Kontak:</strong> {{ $admin->kontak ? $admin->kontak : '-' }}</p>
                    <p class="mb-1"><strong>Alamat:</strong>
                        {{ isset($admin->alamat) ? $admin->alamat : 'Anda Belum Menambahkan Data Ini.' }}</p>
                </div>

                <!-- End Profil Data -->
            </div>
        </div>
    </div>
    <!-- End Section 1 -->
@endsection
