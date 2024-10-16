@extends('layouts.master')
@section('title', 'Info Lowongan')
@php
    $sidebarItemName = 'Info Lowongan';
    $fileRoute = 'perusahaan.info-lowongan.index';
@endphp
@section('assets')
    @vite(['resources/js/components/sweetalert2.js', 'resources/js/components/flatpickr.js'])
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
                method="POST">
                @csrf @method('PUT')
                <div class="row">
                    <div class="mb-3 col-12">
                        <x-input type="text" name="jabatan" label="jabatan Pekerjaan" placeholder="Jabatan Pekerjaan"
                            class="mandatory" value="{{ $loker->jabatan }}" />
                    </div>
                    <div class="mb-3 col-md-6 col-12">
                        <div class="form-group mandatory">
                            <label for="jenis-waktu-pekerjaan" class="form-label">Jenis Waktu Pekerjaan</label>
                            <select name="jenis-waktu-pekerjaan" id="jenis-waktu-pekerjaan"
                                class="form-select @error('jenis-waktu-pekerjaan') is-invalid @enderror">
                                <option class="d-none" selected disabled>Pilih Jenis Waktu Pekerjaan</option>
                                @foreach (['Waktu Kerja Standar (Full-Time)', 'Waktu Kerja Paruh Waktu (Part-Time)', 'Waktu Kerja Fleksibel (Flexible Hours)', 'Shift Kerja (Shift Work)', 'Waktu Kerja Bergilir (Rotating Shifts)', 'Waktu Kerja Jarak Jauh (Remote Work)', 'Waktu Kerja Kontrak (Contract Work)', 'Waktu Kerja Proyek (Project-Based Work)', 'Waktu Kerja Tidak Teratur (Irregular Hours)', 'Waktu Kerja Sementara (Temporary Work)'] as $jenis)
                                    <option value="{{ $jenis }}"
                                        {{ old('jenis-waktu-pekerjaan', $loker->jenis_waktu_pekerjaan) == $jenis ? 'selected' : null }}>
                                        {{ $jenis }}</option>
                                @endforeach
                            </select>
                            @error('jenis-waktu-pekerjaan')
                                <span class="invalid-feedback d-block mt-2" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 col-md-6 col-12">
                        <div class="form-group mandatory">
                            <label for="tanggal-akhir" class="form-label">Batas Waktu Lowongan Pekerjaan</label>
                            <input type="text" class="form-control @error('tanggal-akhir') is-invalid @enderror"
                                id="tanggal" placeholder="Batas Waktu Lowongan Pekerjaan" name="tanggal-akhir"
                                value="{{ $loker->tanggal_akhir }}">
                            @error('tanggal-akhir')
                                <span class="invalid-feedback d-block mt-2" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 col-12">
                        <div class="form-group mandatory">
                            <label for="deskripsi" class="form-label">Deskripsi Pekerjaan</label>
                            <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" rows="5" name="deskripsi">{{ old('deskripsi', $loker->deskripsi) }}</textarea>
                            @error('deskripsi')
                                <span class="invalid-feedback d-block mt-2" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Ajukan</button>
            </form>
        </div>
    </div>
@endsection
