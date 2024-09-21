@extends('layouts.master')
@section('title', 'Informasi Lowongan')
@php
    $sidebarItemName = 'Info Lowongan';
    $fileRoute = 'admin.info-lowongan.index';
@endphp
@section('assets')
    @vite(['resources/js/components/datatables/ajuan-lowongan.js'])
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Info Lowongan</li>
        </ol>
    </nav>

    <div class="card">
        <div class="card-body">
            <!-- table data permintaan lowongan pekerjaan  -->
            <table class="table table-striped nowrap" id="ajuan-lowongan">
                <thead>
                    <tr>
                        <th class="text-start"></th>
                        <th class="text-start">NAMA PERUSAHAAN</th>
                        <th class="text-start">POSISI</th>
                        <th class="text-start">STATUS PUBLIKASI</th>
                        {{-- <th class="text-start">BATAS LOWONGAN</th> --}}
                        <th class="text-start">AKSI</th>
                        <th class="text-start">WAKTU PENGAJUAN</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($loker as $lk)
                        <tr>
                            <td class="text-start"></td>
                            <td class="text-start">{{ $lk->perusahaan->nama }}</td>
                            <td class="text-start">{{ $lk->jabatan }}</td>
                            <td class="text-start">{{ $lk->status }}</td>
                            {{-- <td class="text-start">{{ $lk->tanggal_akhir }}</td> --}}
                            <td class="text-start">
                                <div class="btn-group d-flex justify-content-center" role="group" aria-label="Aksi">
                                    <a href="{{ route('admin.ajuan-info-lowongan.show', $lk->id_lowongan_pekerjaan) }}"
                                        class="btn btn-primary m-1">
                                        <i class="bi bi-file-text m-1"></i>
                                    </a>
                                    {{-- <a href="{{ route('admin.ajuan-pengguna.info-loker.show', 1) }}" class="btn btn-primary m-1">
                                    <i class="bi bi-file-text m-1"></i>Publikasi
                                </a>
                                <a href="{{ route('admin.ajuan-pengguna.info-loker.show', 1) }}" class="btn btn-primary m-1">
                                    <i class="bi bi-file-text m-1"></i>Tidak Dipublikasi
                                </a> --}}
                                    {{-- <form action="{{route('admin.ajuan-pengguna.info-loker.update', $lk->id_lowongan_pekerjaan)}}" method="post">
                                    @csrf @method('put')
                                    <input type="hidden" name="status" value="Dipublikasi">
                                    <button type="submit" class="btn btn-success m-1" {{$lk->status == 'Dipublikasi' || $lk->tanggal_akhir < now()->format('Y-m-d') ? 'disabled' : ''}}>
                                        <i class="bi bi-check-circle me-1"></i>Publikasi
                                    </button>
                                </form>
                                <form action="{{route('admin.ajuan-pengguna.info-loker.update', $lk->id_lowongan_pekerjaan)}}" method="post">
                                    @csrf @method('put')
                                    <input type="hidden" name="status" value="Tidak Dipublikasi">
                                    <button type="submit" class="btn btn-danger m-1" {{$lk->status == 'Tidak Dipublikasi' ? 'disabled' : ''}}>
                                        <i class="bi bi-x-circle me-1"></i>Tidak Dipublikasi
                                    </button>
                                </form> --}}
                                </div>
                            </td>
                            <td class="text-start">{{$lk->waktu}}</td>
                            {{-- <td class="text-start">{{$lk->updated_at->format('Y-m-d')}}</td> --}}
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- end table data permintaan lowongan pekerjaan  -->
        </div>
    </div>
@endsection
