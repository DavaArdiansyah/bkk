@extends('layouts.master')
@section('title', 'Profil')
@php
    $fileRoute = 'profil';
@endphp

@section('assets')
    @vite(['resources/js/wilayah.js'])
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('profil') }}">Profil</a></li>
            <li class="breadcrumb-item active" aria-current="page">Pengalaman Kerja</li>
        </ol>
    </nav>

    <div class="card">
        <div class="card-header">
            <div class="row align-items-center">
                <div class="col-2 col-md-1 text-center">
                    <i class="bi bi-briefcase-fill fs-4"></i>
                </div>
                <div class="col-8 col-md-8">
                    <h5 class="font-weight-bold mb-0">Pengalaman Kerja</h5>
                </div>
                @if (!Route::is('alumni.profil.pengalaman-kerja.create'))
                    <div class="col-2 col-md-3 text-end">
                        <a onclick="event.preventDefault(); document.getElementById('destroy-form').submit();"
                            class="btn btn-link">
                            <i class="bi bi-trash fs-4"></i>
                        </a>
                        <form id="destroy-form"
                            action="{{ route('alumni.profil.pengalaman-kerja.destroy', $kerja->id_pengalaman_kerja) }}"method="POST"
                            class="d-none">
                            @csrf @method('DELETE')
                        </form>
                    </div>
                @endif
            </div>
        </div>
        <div class="card-body">
            <p>
                {{ Route::is('alumni.profil.pengalaman-kerja.create') ? 'Silakan isi informasi pengalaman kerja di bawah ini:' : 'Silakan Perbaharui informasi pengalaman kerja di bawah ini:' }}
            </p>
            <form class="form"
                action="{{ Route::is('alumni.profil.pengalaman-kerja.create') ? route('alumni.profil.pengalaman-kerja.store') : route('alumni.profil.pengalaman-kerja.update', $kerja->id_pengalaman_kerja) }}"
                method="POST">
                @csrf
                @if (!Route::is('alumni.profil.pengalaman-kerja.create'))
                    @method('PUT')
                    <div id="data-provinsi" class="d-none"
                        data-provinsi="{{ isset($alamat['provinsi']) ? $alamat['provinsi'] : null }}"></div>
                    <div id="data-kota" class="d-none" data-kota="{{ isset($alamat['kota']) ? $alamat['kota'] : null }}">
                    </div>
                    <div id="data-kecamatan" class="d-none"
                        data-kecamatan="{{ isset($alamat['kecamatan']) ? $alamat['kecamatan'] : null }}"></div>
                    <div id="data-kelurahan" class="d-none"
                        data-kelurahan="{{ isset($alamat['kelurahan']) ? $alamat['kota'] : null }}"></div>
                @endif
                <div class="row">
                    <div class="mb-3 col-12">
                        <x-input type="text" name="jabatan" label="Jabatan Pekerjaan" placeholder="Jabatan Pekerjaan"
                            value="{{ $kerja->jabatan ?? null }}" class="mandatory" />
                    </div>
                    <div class="mb-3 col-12">
                        <x-input type="text" name="nama-perusahaan" label="Nama Perusahaan" placeholder="Nama Perusahaan"
                            value="{{ $kerja->nama_perusahaan ?? null }}" class="mandatory" />
                    </div>
                    <div class="mb-3 col-md-6 col-12 form-group">
                        <label for="jenis-waktu-pekerjaan" class="form-label">Jenis Waktu Pekerjaan</label>
                        <select name="jenis-waktu-pekerjaan" id="jenis-waktu-pekerjaan"
                            class="form-select @error('jenis-waktu-pekerjaan') is-invalid @enderror">
                            <option class="d-none" selected disabled>Pilih Jenis Waktu Pekerjaan</option>
                            @foreach (['Waktu Kerja Standar (Full-Time)', 'Waktu Kerja Paruh Waktu (Part-Time)', 'Waktu Kerja Fleksibel (Flexible Hours)', 'Shift Kerja (Shift Work)', 'Waktu Kerja Bergilir (Rotating Shifts)', 'Waktu Kerja Jarak Jauh (Remote Work)', 'Waktu Kerja Kontrak (Contract Work)', 'Waktu Kerja Proyek (Project-Based Work)', 'Waktu Kerja Tidak Teratur (Irregular Hours)', 'Waktu Kerja Sementara (Temporary Work)'] as $jenis)
                                <option
                                    value="{{ $jenis }}"{{ old('jenis-waktu-pekerjaan', isset($kerja) ? $kerja->jenis_waktu_pekerjaan : null) == $jenis ? 'selected' : null }}>
                                    {{ $jenis }}</option>
                            @endforeach
                        </select>
                        @error('jenis-waktu-pekerjaan')
                            <span class="invalid-feedback d-block mt-2" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-6 col-12">
                        <x-input type="text" name="alamat-lengkap" label="Alamat Lengkap" placeholder="Alamat Lengkap"
                            value="{{ $alamat['alamat-lengkap'] ?? null }}" class="mandatory" />
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="form-group mandatory">
                            <label for="provinsi" class="form-label">Provinsi</label>
                            <select name="provinsi" id="provinsi"
                                class="form-select @error('provinsi') is-invalid @enderror">
                                <option selected disabled>Pilih Provinsi</option>
                                @foreach ($provinsi as $pr)
                                    <option value="{{ $pr['id'] }}">{{ ucwords(strtolower($pr['name'])) }}
                                    </option>
                                @endforeach
                            </select>
                            @error('provinsi')
                                <span class="invalid-feedback d-block mt-2" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="form-group mandatory">
                            <label for="kota" class="form-label">Kota/Kabupaten</label>
                            <select name="kota" id="kota" class="form-select @error('kota') is-invalid @enderror"
                                disabled>
                                <option class="d-none" selected disabled>Pilih Kota/Kabupaten</option>
                            </select>
                            @error('kota')
                                <span class="invalid-feedback d-block mt-2" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="form-group mandatory">
                            <label for="kecamatan" class="form-label">Kecamatan</label>
                            <select name="kecamatan" id="kecamatan"
                                class="form-select @error('kecamatan') is-invalid @enderror" disabled>
                                <option class="d-none" selected disabled>Pilih Kecamatan</option>
                            </select>
                            @error('kecamatan')
                                <span class="invalid-feedback d-block mt-2" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="form-group mandatory">
                            <label for="kelurahan" class="form-label">Kelurahan</label>
                            <select name="kelurahan" id="kelurahan"
                                class="form-select @error('kelurahan') is-invalid @enderror" disabled>
                                <option class="d-none" selected disabled>Pilih Kelurahan</option>
                            </select>
                            @error('kelurahan')
                                <span class="invalid-feedback d-block mt-2" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                        <x-input type="text" name="tahun-awal" label="Tahun Awal" placeholder="Tahun Awal"
                            value="{{ $kerja->tahun_awal ?? null }}" class="mandatory" />
                    </div>
                    <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                        <x-input type="text" name="tahun-akhir" label="Tahun Akhir" placeholder="Tahun Akhir"
                            value="{{ $kerja->tahun_akhir ?? null }}" class="mandatory" />
                    </div>
                    <div class="mb-3 col-12 form-group">
                        <label for="deskripsi" class="form-label">Deskripsi Singkat</label>
                        <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" rows="5"
                            name="deskripsi">{{ old('deskripsi', isset($kerja->deskripsi) ? $kerja->deskripsi : null) }}</textarea>
                        @error('deskripsi')
                            <span class="invalid-feedback d-block mt-2" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
@endsection
