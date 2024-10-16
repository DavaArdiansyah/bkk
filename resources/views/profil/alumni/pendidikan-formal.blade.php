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
            <li class="breadcrumb-item active" aria-current="page">Riwayat Pendidikan Formal</li>
        </ol>
    </nav>

    <div class="card">
        <div class="card-header">
            <div class="row align-items-center">
                <div class="col-2 col-md-1 text-center">
                    <i class="bi bi-mortarboard-fill fs-3"></i>
                </div>
                <div class="col-8 col-md-8">
                    <h5 class="font-weight-bold mb-0">Riwayat Pendidikan Formal</h5>
                </div>
                @if (!Route::is('alumni.profil.riwayat-pendidikan-formal.create'))
                    <div class="col-2 col-md-3 text-end">
                        <a onclick="event.preventDefault(); document.getElementById('destroy-form').submit();"
                            class="btn btn-link">
                            <i class="bi bi-trash fs-4"></i>
                        </a>
                        <form id="destroy-form"
                            action="{{ route('alumni.profil.riwayat-pendidikan-formal.destroy', $pendidikanFormal->id_riwayat_pendidikan_formal) }}"
                            method="POST" class="d-none">
                            @csrf
                            @method('DELETE')
                        </form>
                    </div>
                @endif
            </div>
        </div>
        <div class="card-body">
            @if (!Route::is('alumni.profil.riwayat-pendidikan-formal.create'))
                <p>Silakan perbaharui informasi riwayat pendidikan formal di bawah ini:</p>
            @else
                <p>Silakan isi informasi riwayat pendidikan formal di bawah ini:</p>
            @endif
            <form class="form"
                @if (!Route::is('alumni.profil.riwayat-pendidikan-formal.create')) action="{{ route('alumni.profil.riwayat-pendidikan-formal.update', $pendidikanFormal->id_riwayat_pendidikan_formal) }}"
                @else
                    action="{{ route('alumni.profil.riwayat-pendidikan-formal.store') }}" @endif
                method="POST">
                @csrf
                @if (!Route::is('alumni.profil.riwayat-pendidikan-formal.create'))
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
                    <div class="mb-3 col-md-6 col-12">
                        <x-input type="text" name="nama-sekolah" label="Nama Sekolah Atau Universitas"
                            placeholder="Nama Sekolah Atau Universitas"
                            value="{{ $pendidikanFormal->nama_sekolah ?? null }}" class="mandatory" />
                    </div>
                    <div class="mb-3 col-md-6 col-12">
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
                    <div class="mb-3 col-12">
                        <x-input type="text" name="gelar" label="Gelar" placeholder="Gelar"
                            value="{{ $pendidikanFormal->gelar ?? null }}" />
                    </div>
                    <div class="mb-3 col-12">
                        <x-input type="text" name="bidang-studi" label="Bidang Studi/Jurusan"
                            placeholder="Bidang Studi/Jurusan" value="{{ $pendidikanFormal->bidang_studi ?? null }}" />
                    </div>
                    <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                        <x-input type="text" name="tahun-awal" label="Tahun Awal" placeholder="Tahun Awal"
                            value="{{ $pendidikanFormal->tahun_awal ?? null }}" class="mandatory" />
                    </div>
                    <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                        <x-input type="text" name="tahun-akhir" label="Tahun Akhir" placeholder="Tahun Akhir"
                            value="{{ $pendidikanFormal->tahun_akhir ?? null }}" class="mandatory" />
                    </div>
                    <div class="mb-3 col-12 form-group">
                        <label for="deskripsi" class="form-label">Deskripsi Singkat</label>
                        <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" rows="5"
                            name="deskripsi">{{ old('deskripsi', isset($pendidikanFormal->deskripsi) ? $pendidikanFormal->deskripsi : null) }}</textarea>
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
