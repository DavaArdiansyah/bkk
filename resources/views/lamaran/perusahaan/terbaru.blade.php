@extends('layouts.master')
@section('title', 'Data Lamaran')

@php
    $sidebarItemName = 'Lamaran';
    $fileRoute = 'perusahaan.lamaran.terbaru';
@endphp

@section('assets')
    @vite(['resources/js/components/datatables/lamaran-terbaru.js', 'resources/js/components/sweetalert2/master.js', 'resources/js/components/parsley.js'])
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Lamaran Terbaru</li>
        </ol>
    </nav>

    <div class="card">
        <div class="card-body">
            <!-- Table Data Terbaru Lamaran -->
            <table class="table table-striped nowrap" id="lamaran-terbaru">
                <thead>
                    <tr>
                        <th class="text-start"></th>
                        <th class="text-start">NAMA</th>
                        <th class="text-start">JABATAN</th>
                        <th class="text-start">AKSI</th>
                        <th class="text-start">JENIS PEKERJAAN</th>
                        <th class="text-start">WAKTU PENGAJUAN</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($lamaran as $lm)
                        <tr>
                            <td class="text-start"></td>
                            <td class="text-start">{{ $lm->alumni->nama }}</td>
                            <td class="text-start">{{ $lm->loker->jabatan }}</td>
                            <td class="text-start">
                                <div class="btn-group d-flex justify-content-center" role="group" aria-label="Aksi">
                                    <button class="btn btn-primary m-1" data-bs-toggle="modal"
                                        data-bs-target="#modalDataAlumni{{ $lm->alumni->nik }}">
                                        <i class="bi bi-file-text m-1"></i>Detail
                                    </button>

                                    <button data-bs-toggle="modal"
                                        data-bs-target="#modal-input-pesan-lolos-kualifikasi-{{ $lm->id_lamaran }}"
                                        class="btn btn-success m-1"
                                        {{ $lm->status == 'Lolos Ketahap Selanjutnya' ? 'disabled' : '' }}>
                                        <i class="bi bi-check-circle me-1"></i>Lolos Kualifikasi
                                    </button>

                                    <button data-bs-toggle="modal"
                                        data-bs-target="#modal-input-pesan-diterima-{{ $lm->id_lamaran }}"
                                        class="btn btn-success m-1" {{ $lm->status == 'Terkirim' ? 'disabled' : '' }}>
                                        <i class="bi bi-emoji-smile me-1"></i>Diterima
                                    </button>

                                    <button data-bs-toggle="modal"
                                        data-bs-target="#modal-input-pesan-ditolak-{{ $lm->id_lamaran }}"
                                        class="btn btn-danger m-1" {{ $lm->status == 'Terkirim' ? 'disabled' : '' }}>
                                        <i class="bi bi-x-circle me-1"></i>Ditolak
                                    </button>
                                </div>
                            </td>
                            <td class="text-start">{{ $lm->loker->jenis_waktu_pekerjaan }}</td>
                            <td class="text-start">{{ $lm->waktu->format('j M Y H:i') }}</td>
                        </tr>

                        <!-- Detail Alumni Component -->
                        <x-detail-alumni :data="$lm->alumni" idLamaran="{{ $lm->id_lamaran }}" />

                        <!-- Input Pesan Modal Components -->
                        <x-modal.input-pesan id="lolos-kualifikasi-{{ $lm->id_lamaran }}" title="Pesan Untuk Pelamar"
                            action="{{ route('perusahaan.lamaran.update', $lm->id_lamaran) }}"
                            for="Lolos Ketahap Selanjutnya" />

                        <x-modal.input-pesan id="diterima-{{ $lm->id_lamaran }}" title="Pesan Untuk Pelamar"
                            action="{{ route('perusahaan.lamaran.update', $lm->id_lamaran) }}" for="Diterima" />

                        <x-modal.input-pesan id="ditolak-{{ $lm->id_lamaran }}" title="Pesan Untuk Pelamar"
                            action="{{ route('perusahaan.lamaran.update', $lm->id_lamaran) }}" for="Ditolak" />
                    @endforeach
                </tbody>
            </table>
            <!-- End Table Data Terbaru Lamaran -->
        </div>
    </div>
@endsection
