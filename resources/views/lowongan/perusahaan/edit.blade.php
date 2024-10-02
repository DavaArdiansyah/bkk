@extends('layouts.master')
@section('title', 'Info Lowongan')
@php
    $sidebarItemName = 'Info Lowongan';
    $fileRoute = 'perusahaan.info-lowongan.index';
@endphp
@section('assets')
    @vite(['resources/js/components/parsley.js', 'resources/js/components/sweetalert2/master.js', 'resources/js/components/flatpickr.js'])
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('perusahaan.info-lowongan.index') }}">Info Lowongan</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit</li>
        </ol>
    </nav>

    <div class="card">
        <div class="card-body">
            <div id="tanggal-akhir" data-tanggal-akhir="{{ $loker->tanggal_akhir }}"></div>
            <p>Silakan perbaharui Informasi Lowongan di bawah ini:</p>
            <form class="form" action="{{ route('perusahaan.info-lowongan.update', $loker->id_lowongan_pekerjaan) }}"
                method="post" data-parsley-validate>
                @csrf @method('PUT')
                <div class="row">
                    <div class="mb-3 col-12">
                        <x-input type="text" name="jabatan" label="jabatan Pekerjaan" placeholder="Jabatan Pekerjaan"
                            class="mandatory" required="true" value="{{ $loker->jabatan }}" />
                    </div>
                    <div class="mb-3 col-md-6 col-12">
                        <div class="form-group mandatory">
                            <label for="jenis-waktu-pekerjaan" class="form-label">Jenis Waktu Pekerjaan</label>
                            <select name="jenis-waktu-pekerjaan" id="jenis-waktu-pekerjaan" class="form-select"
                                data-parsley-required="true">
                                <option disabled>Pilih Jenis Waktu Pekerjaan</option>
                                <option value="Waktu Kerja Standar (Full-Time)"
                                    {{ $loker->jenis_waktu_pekerjaan == 'Waktu Kerja Standar (Full-Time)' ? 'selected' : '' }}>
                                    Waktu Kerja Standar (Full-Time)</option>
                                <option value="Waktu Kerja Paruh Waktu (Part-Time)"
                                    {{ $loker->jenis_waktu_pekerjaan == 'Waktu Kerja Paruh Waktu (Part-Time)' ? 'selected' : '' }}>
                                    Waktu Kerja Paruh Waktu (Part-Time)</option>
                                <option value="Waktu Kerja Fleksibel (Flexible Hours)"
                                    {{ $loker->jenis_waktu_pekerjaan == 'Waktu Kerja Fleksibel (Flexible Hours)' ? 'selected' : '' }}>
                                    Waktu Kerja Fleksibel (Flexible Hours)</option>
                                <option value="Shift Kerja (Shift Work)"
                                    {{ $loker->jenis_waktu_pekerjaan == 'Shift Kerja (Shift Work)' ? 'selected' : '' }}>
                                    Shift
                                    Kerja (Shift Work)</option>
                                <option value="Waktu Kerja Bergilir (Rotating Shifts)"
                                    {{ $loker->jenis_waktu_pekerjaan == 'Waktu Kerja Bergilir (Rotating Shifts)' ? 'selected' : '' }}>
                                    Waktu Kerja Bergilir (Rotating Shifts)</option>
                                <option value="Waktu Kerja Jarak Jauh (Remote Work)"
                                    {{ $loker->jenis_waktu_pekerjaan == 'Waktu Kerja Jarak Jauh (Remote Work)' ? 'selected' : '' }}>
                                    Waktu Kerja Jarak Jauh (Remote Work)</option>
                                <option value="Waktu Kerja Kontrak (Contract Work)"
                                    {{ $loker->jenis_waktu_pekerjaan == 'Waktu Kerja Kontrak (Contract Work)' ? 'selected' : '' }}>
                                    Waktu Kerja Kontrak (Contract Work)</option>
                                <option value="Waktu Kerja Proyek (Project-Based Work)"
                                    {{ $loker->jenis_waktu_pekerjaan == 'Waktu Kerja Proyek (Project-Based Work)' ? 'selected' : '' }}>
                                    Waktu Kerja Proyek (Project-Based Work)</option>
                                <option value="Waktu Kerja Tidak Teratur (Irregular Hours)"
                                    {{ $loker->jenis_waktu_pekerjaan == 'Waktu Kerja Tidak Teratur (Irregular Hours)' ? 'selected' : '' }}>
                                    Waktu Kerja Tidak Teratur (Irregular Hours)</option>
                                <option value="Waktu Kerja Sementara (Temporary Work)"
                                    {{ $loker->jenis_waktu_pekerjaan == 'Waktu Kerja Sementara (Temporary Work)' ? 'selected' : '' }}>
                                    Waktu Kerja Sementara (Temporary Work)</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 col-md-6 col-12">
                        <div class="form-group mandatory">
                            <label for="tanggal-akhir" class="form-label">Batas Waktu Lowongan Pekerjaan</label>
                            <input type="text" class="form-control" id="tanggal"
                                placeholder="Batas Waktu Lowongan Pekerjaan" name="tanggal-akhir"
                                data-parsley-required="true" value="{{ $loker->tanggal_akhir }}">
                        </div>
                    </div>
                    <div class="mb-3 col-12">
                        <div class="form-group mandatory">
                            <label for="deskripsi" class="form-label">Deskripsi Pekerjaan</label>
                            <textarea class="form-control" id="deskripsi" rows="5" data-parsley-required="true" name="deskripsi">{{ $loker->deskripsi }}</textarea>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Ajukan</button>
            </form>
        </div>
    </div>
@endsection
