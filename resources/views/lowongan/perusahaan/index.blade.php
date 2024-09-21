@extends('layouts.master')
@section('title', 'Informasi Lowongan')

@php
    $sidebarItemName = 'Info Lowongan';
    $fileRoute = 'perusahaan.info-lowongan.index';
@endphp

@section('assets')
    @vite(['resources/js/components/datatables/lowongan.js', 'resources/js/components/sweetalert2/master.js'])
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <!-- Table data lowongan pekerjaan -->
            <table class="table table-striped nowrap" id="lowongan">
                <thead>
                    <tr>
                        <th class="text-start"></th>
                        <th class="text-start">POSISI</th>
                        <th class="text-start">BATAS LOWONGAN</th>
                        <th class="text-start">STATUS</th>
                        <th class="text-start">AKSI</th>
                        <th class="text-start">WAKTU</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($loker as $lk)
                        <tr>
                            <td class="text-start"></td>
                            <td class="text-start">{{ $lk->jabatan }}</td>
                            <td class="text-start">{{ $lk->tanggal_akhir }}</td>
                            <td class="text-start
                                @if ($lk->status == 'Tertunda') text-warning
                                @elseif ($lk->status == 'Dipublikasi') text-success
                                @elseif ($lk->status == 'Tidak Dipublikasi') text-danger
                                @endif">
                                {{ $lk->status }}
                            </td>
                            <td class="text-start">
                                <div class="btn-group d-flex justify-content-center" role="group" aria-label="Aksi">
                                    <a href="{{ route('perusahaan.info-lowongan.show', $lk->id_lowongan_pekerjaan) }}" class="btn btn-primary m-1">
                                        <i class="bi bi-file-text m-1"></i> Detail
                                    </a>
                                    <a href="{{ route('perusahaan.info-lowongan.edit', $lk->id_lowongan_pekerjaan) }}" class="btn btn-warning m-1">
                                        <i class="bi bi-pencil me-1"></i> Edit
                                    </a>
                                    @if ($lk->status === 'Dipublikasi')
                                        <form action="{{ route('perusahaan.info-lowongan.update', $lk->id_lowongan_pekerjaan) }}" method="post">
                                            @csrf
                                            @method('put')
                                            <input type="hidden" name="status" value="Tidak Dipublikasi">
                                            <button type="submit" class="btn btn-danger m-1"
                                                {{ $lk->status == 'Tidak Dipublikasi' || $lk->status == 'Tertunda' ? 'disabled' : '' }}>
                                                <i class="bi bi-x-circle me-1"></i> Tidak Dipublikasi
                                            </button>
                                        </form>
                                    @else
                                        <button data-bs-toggle="modal" data-bs-target="#modal-pesan-{{ $lk->id_lowongan_pekerjaan }}" class="btn btn-warning m-1
                                            {{ $lk->status == 'Tertunda' ? 'disabled' : '' }}">
                                            <i class="bi bi-envelope me-1"></i> Pesan Admin BKK
                                        </button>
                                        <!-- Modal -->
                                        <x-modal.pesan id="{{ $lk->id_lowongan_pekerjaan }}" title="Pesan Admin BKK" pesan="{{ $lk->pesan }}" />
                                    @endif
                                </div>
                            </td>
                            <td class="text-start">{{ $lk->waktu->format('j M Y H:i') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- End table data lowongan pekerjaan -->
        </div>
    </div>
@endsection
