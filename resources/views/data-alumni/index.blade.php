@extends('layouts.master')
@php
    $sidebarItemName = 'Data Pengguna';
    $subName = 'Alumni';
    $fileRoute = 'admin.data-alumni.index';
@endphp
@section('title', 'Data Alumni')
@section('assets')
    @vite('resources/js/components/datatables/data-alumni.js')
@endsection
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Data Alumni</li>
        </ol>
    </nav>

    <section>
        <div class="card">
            <div class="card-body">
                <!-- table data alumni  -->
                <table class="table table-striped nowrap " id="data-alumni">
                    <thead>
                        <tr>
                            <th class="text-start"></th>
                            <th class="text-start">NIK</th>
                            <th class="text-start">NAMA LENGKAP</th>
                            <th class="text-start">JENIS KELAMIN</th>
                            <th class="text-start">JURUSAN</th>
                            <th class="text-start">TAHUN LULUS</th>
                            <th class="text-start">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($alumni as $al)
                            <tr>
                                <td class="text-start"></td>
                                <td class="text-start">{{ $al->nik }}</td>
                                <td class="text-start">{{ $al->nama }}</td>
                                <td class="text-start">{{ $al->jenis_kelamin }}</td>
                                <td class="text-start">{{ $al->jurusan }}</td>
                                <td class="text-start">{{ $al->tahun_lulus }}</td>
                                <td class="text-start">
                                    <div class="btn-group d-flex justify-content-center" role="group" aria-label="Aksi">
                                        <button class="btn btn-primary m-1" data-bs-toggle="modal"
                                            data-bs-target="#modalDataAlumni{{ $al->nik }}">
                                            <i class="bi bi-file-text m-1"></i>
                                        </button>
                                        <a href="{{ route('admin.data-alumni.edit', $al->nik) }}"
                                            class="btn btn-warning m-1">
                                            <i class="bi bi-pencil me-1"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <x-detail-alumni :data="$al" for="data-alumni" />
                        @endforeach
                    </tbody>
                </table>
                <!-- end table data alumni  -->
            </div>
        </div>
    </section>
@endsection
