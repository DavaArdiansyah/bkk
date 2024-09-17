@extends('layouts.master')
@section('title', 'Lamaran Saya')
@php
    $fileRoute = 'alumni.lamaran.index';
@endphp
@section('assets')
    @vite('resources/js/components/datatables/lamaran-saya.js')
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Lamaran Saya</li>
        </ol>
    </nav>

    <div class="card">
        <div class="card-body">
            <!-- table lamaran  -->
            <table class="table table-striped nowrap" id="lamaran-saya">
                <thead>
                    <tr>
                        <th class="text-start"></th>
                        <th class="text-start">NAMA PERUSAHAAN</th>
                        <th class="text-start">JABATAN</th>
                        {{-- <th class="text-start">Waktu Pengajuan Lamaran</td> --}}
                        <th class="text-start">STATUS</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($lamaran as $lm)
                        <tr>
                            <td class="text-start"></td>
                            <td class="text-start">{{ $lm->loker->perusahaan->nama }}</td>
                            <td class="text-start">{{ $lm->loker->jabatan }}</td>

                            @if ($lm->status == 'Diterima')
                                <td>
                                    <a href="#" data-bs-toggle="modal"
                                        data-bs-target="#modal-pesan-{{ $lm->id_lamaran }}"
                                        class="text-success text-decoration-none">Diterima</a>
                                </td>
                            @elseif ($lm->status == 'Ditolak')
                                <td>
                                    <a href="#" data-bs-toggle="modal"
                                        data-bs-target="#modal-pesan-{{ $lm->id_lamaran }}"
                                        class="text-danger text-decoration-none">Ditolak</a>
                                </td>
                            @elseif ($lm->status == 'Lolos Ketahap Selanjutnya')
                                <td>
                                    <a href="#" data-bs-toggle="modal"
                                        data-bs-target="#modal-pesan-{{ $lm->id_lamaran }}"
                                        class="text-warning text-decoration-none">Lolos Ketahap Selanjutnya</a>
                                </td>
                            @else
                                <td class="text-start text-secondary">Terkirim</td>
                            @endif

                            {{-- Modal Pesan Perusahaan --}}
                            <x-modal.pesan id="{{ $lm->id_lamaran }}" title="Pesan Perusahaan"
                                pesan="{{ $lm->pesan }}" />
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- end table lamaran  -->
        </div>
    </div>
@endsection
