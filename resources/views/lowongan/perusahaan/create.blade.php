@extends('layouts.master')
@section('title', 'Info Lowongan')
@php
    $sidebarItemName = 'Info Lowongan';
    $fileRoute = 'perusahaan.info-lowongan.create';
@endphp
@section('assets')
    @vite(['resources/js/components/parsley.js', 'resources/js/components/sweetalert2/master.js', 'resources/js/components/flatpickr.js'])
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('perusahaan.info-lowongan.index') }}">Info Lowongan</a></li>
            <li class="breadcrumb-item active" aria-current="page">Create</li>
        </ol>
    </nav>

    <div class="card">
        <div class="card-body">
            <p>Silakan isi Informasi Lowongan di bawah ini:</p>
            <form class="form" action="{{ route('perusahaan.info-lowongan.store') }}" method="post" data-parsley-validate>
                @csrf
                <div class="row">
                    <div class="mb-3 col-12">
                        <x-input type="text" name="jabatan" label="jabatan Pekerjaan" placeholder="Jabatan Pekerjaan"
                            class="mandatory" required="true" />
                    </div>
                    <div class="mb-3 col-md-6 col-12">
                        <div class="form-group mandatory">
                            <label for="jenis-waktu-pekerjaan" class="form-label">Jenis Waktu Pekerjaan</label>
                            <select name="jenis-waktu-pekerjaan" id="jenis-waktu-pekerjaan" class="form-select"
                                data-parsley-required="true">
                                <option disabled selected>Pilih Jenis Waktu Pekerjaan</option>
                                <option value="Waktu Kerja Standar (Full-Time)">
                                    Waktu Kerja Standar (Full-Time)</option>
                                <option value="Waktu Kerja Paruh Waktu (Part-Time)">
                                    Waktu Kerja Paruh Waktu (Part-Time)</option>
                                <option value="Waktu Kerja Fleksibel (Flexible Hours)">
                                    Waktu Kerja Fleksibel (Flexible Hours)</option>
                                <option value="Shift Kerja (Shift Work)">
                                    Shift
                                    Kerja (Shift Work)</option>
                                <option value="Waktu Kerja Bergilir (Rotating Shifts)">
                                    Waktu Kerja Bergilir (Rotating Shifts)</option>
                                <option value="Waktu Kerja Jarak Jauh (Remote Work)">
                                    Waktu Kerja Jarak Jauh (Remote Work)</option>
                                <option value="Waktu Kerja Kontrak (Contract Work)">
                                    Waktu Kerja Kontrak (Contract Work)</option>
                                <option value="Waktu Kerja Proyek (Project-Based Work)">
                                    Waktu Kerja Proyek (Project-Based Work)</option>
                                <option value="Waktu Kerja Tidak Teratur (Irregular Hours)">
                                    Waktu Kerja Tidak Teratur (Irregular Hours)</option>
                                <option value="Waktu Kerja Sementara (Temporary Work)">
                                    Waktu Kerja Sementara (Temporary Work)</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 col-md-6 col-12">
                        <div class="form-group mandatory">
                            <label for="tanggal-akhir" class="form-label">Batas Waktu Lowongan Pekerjaan</label>
                            <input type="text" class="form-control" id="tanggal"
                                placeholder="Batas Waktu Lowongan Pekerjaan" name="tanggal-akhir"
                                data-parsley-required="true">
                        </div>
                    </div>
                    <div class="mb-3 col-12">
                        <div class="form-group mandatory">
                            <label for="deskripsi" class="form-label">Deskripsi Pekerjaan</label>
                            <textarea class="form-control" id="deskripsi" rows="5" data-parsley-required="true" name="deskripsi"></textarea>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Ajukan</button>
            </form>
        </div>
    </div>
@endsection
