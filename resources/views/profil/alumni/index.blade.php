@extends('layouts.master')
@section('meta')
<meta name="csrf-token" content="{{ csrf_token() }}">@endsection
@section('title', 'Profil')
@php
    $fileRoute = 'profil';
@endphp
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
                        <a data-bs-toggle="modal" data-bs-target="#modal-avatar-edit-{{ $alumni->nik }}">
                            {{-- <a id="modal-edit-foto" data-update-url="/profil/foto/{{$alumni->id}}" > --}}
                            <img src="{{ isset($alumni->nama_file_foto) ? asset('storage/images/' . $alumni->nama_file_foto) : ($alumni->jenis_kelamin == 'Laki Laki' ? asset('assets/static/images/faces/2.jpg') : asset('assets/static/images/faces/1.jpg')) }}"
                                class="img-fluid rounded-circle" alt="Avatar">
                        </a>
                        <x-modal.avatar id="{{ $alumni->nik }}" title="Perbaharui Foto Profil"
                            action="{{ route('profil.update', $alumni->user->username) }}" for="Alumni" />

                        {{-- <x-edit-foto id="{{ $alumni->nik }}" /> --}}
                    </div>
                </div>
                <!-- End Avatar -->

                <!-- Profil Data -->
                <div class="col-12 col-md-10 mb-3 mb-md-0">
                    <div class="row align-items-center">
                        <div class="col-10">
                            <h5 class="font-weight-bold mb-2">{{ $alumni->user->username }} - {{ $alumni->nama }}</h5>
                        </div>
                        <div class="col-2 text-end">
                            <a href="{{ route('profil.edit', $alumni->user->username) }}" class="btn btn-link me-2">
                                <i class="bi bi-pencil fs-5 me-1"></i>
                            </a>
                        </div>
                    </div>
                    <p class="mb-1"><strong>Kontak:</strong> {{ $alumni->kontak ? $alumni->kontak : '-' }}</p>
                    <p class="mb-1"><strong>Alamat:</strong>
                        {{ isset($alumni->alamat) ? $alumni->alamat : 'Anda Belum Menambahkan Data Ini.' }}</p>
                </div>
                <!-- End Profil Data -->
            </div>
        </div>
    </div>
    <!-- End Section 1 -->

    <!-- Section 2: Riwayat Pendidikan Formal-->
    <div class="card">
        <div class="card-header">
            <div class="row align-items-center">
                <div class="col-2 col-md-1 text-center">
                    <i class="bi bi-mortarboard-fill fs-3"></i>
                </div>
                <div class="col-8 col-md-8">
                    <a href="{{ route('alumni.profil.riwayat-pendidikan-formal.create') }}"
                        class="btn btn-link text-decoration-none">
                        <h5 class="font-weight-bold mb-0">Riwayat Pendidikan Formal</h5>
                    </a>
                </div>
                <div class="col-2 col-md-3 text-end">
                    <a href="{{ route('alumni.profil.riwayat-pendidikan-formal.create') }}" class="btn btn-link">
                        <i class="bi bi-plus fs-2"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            @foreach ($pendidikanFormal as $pdf)
                <div class="mb-3">
                    <a
                        href="{{ route('alumni.profil.riwayat-pendidikan-formal.edit', $pdf->id_riwayat_pendidikan_formal) }}">
                        <h6 class="font-weight-bold">{{ $pdf->nama_sekolah }}
                            {{ isset($pdf->bidang_studi) ? ' - ' . $pdf->bidang_studi : '' }}</h6>
                    </a>
                    <p class="text-muted mb-0">{{ $pdf->tahun_awal }} - {{ $pdf->tahun_akhir }}</p>
                </div>
            @endforeach
        </div>
    </div>
    <!-- End Section 2 -->

    <!-- Section 3: Riwayat Pendidikan Non Formal-->
    <div class="card">
        <div class="card-header">
            <div class="row align-items-center">
                <div class="col-2 col-md-1 text-center">
                    <i class="bi bi-book fs-3"></i>
                </div>
                <div class="col-8 col-md-8">
                    <a href="{{ route('alumni.profil.riwayat-pendidikan-non-formal.create') }}"
                        class="btn btn-link text-decoration-none">
                        <h5 class="font-weight-bold mb-0">Riwayat Pendidikan Non Formal</h5>
                    </a>
                </div>
                <div class="col-2 col-md-3 text-end">
                    <a href="{{ route('alumni.profil.riwayat-pendidikan-non-formal.create') }}" class="btn btn-link">
                        <i class="bi bi-plus fs-2"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            @foreach ($pendidikanNonFormal as $pdnf)
                <div class="mb-3">
                    <a
                        href="{{ route('alumni.profil.riwayat-pendidikan-non-formal.edit', $pdnf->id_riwayat_pendidikan_non_formal) }}">
                        <h6 class="font-weight-bold">{{ $pdnf->nama_lembaga . ' - ' . $pdnf->nama_kursus }}</h6>
                    </a>
                    <p class="text-muted mb-0">{{ $pdnf->tanggal }}</p>
                </div>
            @endforeach
        </div>
    </div>
    <!-- End Section 3 -->

    <!-- Section 4: Pengalaman Kerja -->
    <div class="card">
        <div class="card-header">
            <div class="row align-items-center">
                <div class="col-2 col-md-1 text-center">
                    <i class="bi bi-briefcase-fill fs-4"></i>
                </div>
                <div class="col-8 col-md-8">
                    <a href="{{ route('alumni.profil.pengalaman-kerja.create') }}"
                        class="btn btn-link text-decoration-none">
                        <h5 class="font-weight-bold mb-0">Pengalaman Kerja</h5>
                    </a>
                </div>
                <div class="col-2 col-md-3 text-end">
                    <a href="{{ route('alumni.profil.pengalaman-kerja.create') }}" class="btn btn-link">
                        <i class="bi bi-plus fs-2"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            @foreach ($kerja as $kj)
                <div class="mb-3">
                    <a href="{{ route('alumni.profil.pengalaman-kerja.edit', $kj->id_pengalaman_kerja) }}">
                        <h6 class="font-weight-bold">{{ $kj->nama_perusahaan }} - {{ $kj->jabatan }}</h6>
                    </a>
                    <p class="text-muted mb-0">{{ $kj->tahun_awal }} - {{ $kj->tahun_akhir }}</p>
                </div>
            @endforeach
        </div>
    </div>
    <!-- End Section 4 -->

    <!-- Section 5: Keahlian -->
    <div class="card">
        <div class="card-header">
            <div class="row align-items-center">
                <div class="col-2 col-md-1 text-center">
                    <i class="bi bi-star-fill fs-4"></i>
                </div>
                <div class="col-8 col-md-8">
                    <a href="{{ route('alumni.profil.keahlian.edit', $alumni->nik) }}"
                        class="btn btn-link text-decoration-none">
                        <h5 class="font-weight-bold mb-0">Keahlian</h5>
                    </a>
                </div>
                <div class="col-2 col-md-3 text-end">
                    @if (!isset($alumni->keahlian))
                        <a href="{{ route('alumni.profil.keahlian.edit', $alumni->nik) }}"
                            class="btn btn-lg btn-link fs-3">
                            <i class="bi bi-plus fs-2"></i>
                        </a>
                    @endif
                </div>
            </div>
        </div>
        <div class="card-body">
            @if (isset($alumni->keahlian))
                <div class="mb-3">
                    <a href="{{ route('alumni.profil.keahlian.edit', $alumni->nik) }}">
                        <h6 class="font-weight-bold">{{ ucwords(strtolower($alumni->keahlian)) }}</h6>
                    </a>
                </div>
            @endif
        </div>
    </div>
    <!-- End Section 5 -->
@endsection
