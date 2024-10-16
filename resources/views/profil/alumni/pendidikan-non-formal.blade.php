@extends('layouts.master')
@section('title', 'Profil')
@php
    $fileRoute = 'profil';
@endphp

@section('assets')
    @vite(['resources/js/wilayah.js', 'resources/js/views/pendidikan-non-formal.js'])
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('profil') }}">Profil</a></li>
            <li class="breadcrumb-item active" aria-current="page">Riwayat Pendidikan Non Formal</li>
        </ol>
    </nav>

    <div class="card">
        <div class="card-header">
            <div class="row align-items-center">
                <div class="col-2 col-md-1 text-center">
                    <i class="bi bi-book fs-3"></i>
                </div>
                <div class="col-8 col-md-8">
                    <h5 class="font-weight-bold mb-0">Riwayat Pendidikan Non Formal</h5>
                </div>
                <div class="col-2 col-md-3 text-end">
                    @if (!Route::is('alumni.profil.riwayat-pendidikan-non-formal.create'))
                        <a onclick="event.preventDefault(); document.getElementById('destroy-form').submit();"
                            class="btn btn-link">
                            <i class="bi bi-trash fs-4"></i></a>
                        <form id="destroy-form"
                            action="{{ route('alumni.profil.riwayat-pendidikan-non-formal.destroy', $pendidikanNonFormal->id_riwayat_pendidikan_non_formal) }}"
                            method="POST" class="d-none">
                            @csrf @method('DELETE')
                        </form>
                    @endif
                </div>
            </div>
        </div>
        <div class="card-body">
            @if (!Route::is('alumni.profil.riwayat-pendidikan-non-formal.create'))
                <p>Silakan perbaharui informasi riwayat pendidikan non formal di bawah ini:</p>
            @else
                <p>Silakan isi informasi riwayat pendidikan non formal di bawah ini:</p>
            @endif
            <form class="form"
                @if (!Route::is('alumni.profil.riwayat-pendidikan-non-formal.create')) action="{{ route('alumni.profil.riwayat-pendidikan-non-formal.update', $pendidikanNonFormal->id_riwayat_pendidikan_non_formal) }}"
                @else
                    action="{{ route('alumni.profil.riwayat-pendidikan-non-formal.store') }}" @endif
                method="POST">
                @csrf
                @if (!Route::is('alumni.profil.riwayat-pendidikan-non-formal.create'))
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
                        <x-input type="text" name="nama-lembaga" label="Nama Lembaga" placeholder="Nama Lembaga"
                            value="{{ $pendidikanNonFormal->nama_lembaga ?? null }}" class="mandatory" />
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
                    <div class="mb-3 col-12 form-group">
                        <x-input type="text" name="nama-kursus" label="Nama Kursus" placeholder="Nama Kursus"
                            value="{{ $pendidikanNonFormal->nama_kursus ?? null }}" class="mandatory" />
                    </div>
                    <div class="mb-3 col-12">
                        <x-input type="text" name="tanggal" label="Tanggal" placeholder="Pilih Tanggal"
                            value="{{ $pendidikanNonFormal->tanggal ?? null }}" class="mandatory" />
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
@endsection
