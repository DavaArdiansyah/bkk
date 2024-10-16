@extends('layouts.master')
@section('meta')
<meta name="csrf-token" content="{{ csrf_token() }}">@endsection
@php
    $sidebarItemName = 'Data Pengguna';
    $subName = 'Perusahaan';
    $fileRoute = 'admin.data-perusahaan.index';
@endphp
@section('title', 'Data Perusahaan')
@section('assets')
    @vite(['resources/js/wilayah.js', 'resources/js/components/sweetalert2.js', 'resources/js/components/filepond/images.js', 'resources/js/bidang-usaha.js'])
@endsection
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.data-perusahaan.index') }}">Data Perusahaan</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit</li>
        </ol>
    </nav>
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.data-perusahaan.update', $perusahaan->id_data_perusahaan) }}" method="POST">
                @csrf @method('PUT')
                <div id="data-provinsi" class="d-none"
                    data-provinsi="{{ isset($alamat['provinsi']) ? $alamat['provinsi'] : null }}"></div>
                <div id="data-kota" class="d-none" data-kota="{{ isset($alamat['kota']) ? $alamat['kota'] : null }}"></div>
                <div id="data-kecamatan" class="d-none"
                    data-kecamatan="{{ isset($alamat['kecamatan']) ? $alamat['kecamatan'] : null }}"></div>
                <div id="data-kelurahan" class="d-none"
                    data-kelurahan="{{ isset($alamat['kelurahan']) ? $alamat['kelurahan'] : null }}"></div>
                <div class="row">
                    <div class="col-12 mb-4 d-flex justify-content-center">
                        <a data-bs-toggle="modal" data-bs-target="#modal-avatar-edit-{{ $perusahaan->id_data_perusahaan }}">
                            <img src="{{ isset($perusahaan->nama_file_logo) ? asset('storage/images/' . $perusahaan->nama_file_logo) : asset('assets/static/images/faces/2.jpg') }}"
                                class="img-fluid rounded-circle border border-4 border-light"
                                style="height: 12rem; width: 12rem" alt="logo{{ $perusahaan->nama }}">
                        </a>
                        <x-modal.avatar id="{{ $perusahaan->id_data_perusahaan }}" title="Perbaharui Logo" />
                        <div id="path_file_image"
                            data-path-image="{{ isset($perusahaan->nama_file_logo) ? asset('storage/images/' . $perusahaan->nama_file_logo) : null }}"
                            class="d-none"></div>
                    </div>
                    <div class="col-md-6 col-12">
                        <x-input type="text" name="nama" label="Nama Perusahaan" placeholder="Nama Perusahaan"
                            value="{{ $perusahaan->nama }}" class="mandatory" />
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="form-group mandatory">
                            <label for="bidang-usaha" class="form-label">Bidang Usaha</label>
                            <select name="bidang-usaha" id="bidang-usaha" class="form-select" required>
                                <option class="d-none" disabled>Pilih Bidang Usaha</option>
                                <option value="tambah" {{ $perusahaan->bidang_usaha == 'tambah' ? 'selected' : null }}>
                                    Tambah Opsi Baru</option>

                                @foreach (['Perdagangan', 'Makanan dan Minuman', 'Pertanian dan Perkebunan', 'Jasa', 'Properti dan Konstruksi', 'Industri Kreatif', 'Teknologi Informasi dan Komunikasi', 'Pariwisata dan Perhotelan', 'Transportasi dan Logistik', 'Industri Manufaktur'] as $option)
                                    <option value="{{ $option }}"
                                        {{ old('bidang-usaha', $perusahaan->bidang_usaha) == $option ? 'selected' : '' }}>
                                        {{ $option }}
                                    </option>
                                @endforeach
                                @if (!in_array($perusahaan->bidang_usaha, ['Perdagangan', 'Makanan dan Minuman', 'Pertanian dan Perkebunan', 'Jasa', 'Properti dan Konstruksi', 'Industri Kreatif', 'Teknologi Informasi dan Komunikasi', 'Pariwisata dan Perhotelan', 'Transportasi dan Logistik', 'Industri Manufaktur']))
                                    <option value="{{ $perusahaan->bidang_usaha }}" selected>
                                        {{ $perusahaan->bidang_usaha }}</option>
                                @endif
                            </select>
                            <input type="text" name="bidang-usaha-baru" id="option-lainnya"
                                class="form-control mt-2 d-none" placeholder="Masukkan bidang usaha baru"
                                value="{{ old('bidang-usaha-baru') }}" />
                            @error('bidang-usaha')
                                <span class="invalid-feedback d-block mt-2" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                    </div>
                    <div class="col-md-6 col-12">
                        <x-input type="text" name="no-telepon" label="No Telepon" placeholder="No Telepon"
                            value="{{ $perusahaan->no_telepon }}" class="mandatory" />
                    </div>
                    <div class="col-md-6 col-12">
                        <x-input type="text" name="alamat-lengkap" label="Alamat Lengkap" placeholder="Alamat Lengkap"
                            value="{{ $alamat['alamat-lengkap'] ?? '' }}" class="mandatory" />
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="form-group mandatory">
                            <label for="provinsi" class="form-label">Provinsi</label>
                            <select name="provinsi" id="provinsi" class="form-select" data-parsley-required="true">
                                <option selected disabled>Pilih Provinsi</option>
                                @foreach ($provinsi as $pr)
                                    <option value="{{ $pr['id'] }}">{{ ucwords(strtolower($pr['name'])) }}</option>
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
                </div>
                <div class="row">
                    <div class="col-12 d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary m-1">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
