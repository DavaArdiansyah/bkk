@extends('layouts.master')
@section('title', 'Data Lamaran')
@php
    $sidebarItemName = 'Lamaran';
    $fileRoute = 'perusahaan.lamaran.arsip';
@endphp
@section('assets')
    @vite(['resources/js/components/datatables/lamaran-arsip.js', 'resources/js/components/sweetalert2/master.js'])
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Arsip Lamaran</li>
        </ol>
    </nav>

    <div class="card">
        <div class="card-body">
            <!-- table data terbaru lamaran  -->
            <table class="table table-striped nowrap" id="lamaran-arsip">
                <thead>
                    <tr>
                        <th class="text-start"></th>
                        <th class="text-start">NAMA</th>
                        <th class="text-start">JABATAN</th>
                        <th class="text-start">JENIS PEKERJAAN</th>
                        <th class="text-start">STATUS</th>
                        {{-- <th class="text-start">Waktu Konfirmasi</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach ($lamaran as $lm)
                        <tr>
                            <td class="text-start"></td>
                            <td class="text-start">{{ $lm->alumni->nama }}</td>
                            <td class="text-start">{{ $lm->loker->jabatan }}</td>
                            <td class="text-start">{{ $lm->loker->jenis_waktu_pekerjaan }}</td>
                            @if ($lm->status == 'Diterima')
                                <td class="text-start text-success">Diterima</td>
                            @else
                                <td class="text-start text-danger">Ditolak</td>
                            @endif
                            {{-- <td class="text-start">{{$lm->created_at->format('Y-m-d')}}</td> --}}
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- end table data terbaru lamaran  -->
        </div>
    </div>
@endsection
