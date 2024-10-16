@extends('layouts.master')
@section('title', 'Profil')

@php
    $fileRoute = 'profil';
@endphp

@section('assets')
    @vite(['resources/js/wilayah.js', 'resources/js/components/sweetalert2.js'])
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('profil') }}">Profil</a></li>
            <li class="breadcrumb-item active" aria-current="page">Informasi Utama</li>
        </ol>
    </nav>

    <div class="card">
        <div class="card-header">
            <div class="row align-items-center">
                <div class="col-2 col-md-1 text-center">
                    <i class="bi bi-person-fill fs-4"></i>
                </div>
                <div class="col-8 col-md-8">
                    <h5 class="font-weight-bold mb-0">Informasi Utama</h5>
                </div>
            </div>
        </div>

        <div class="card-body">
            <p>Silakan isi/perbaharui informasi utama di bawah ini:</p>
            <form class="form" action="{{ route('profil.update', $user->username) }}" method="POST">
                @csrf
                @method('PUT')

                <div id="data-provinsi" class="d-none" data-provinsi="{{ $alamat['provinsi'] ?? null }}"></div>
                <div id="data-kota" class="d-none" data-kota="{{ $alamat['kota'] ?? null }}"></div>
                <div id="data-kecamatan" class="d-none" data-kecamatan="{{ $alamat['kecamatan'] ?? null }}"></div>
                <div id="data-kelurahan" class="d-none" data-kelurahan="{{ $alamat['kelurahan'] ?? null }}"></div>

                <div class="row">
                    <div class="mb-3 col-md-6 col-12">
                        <x-input type="text" name="username" label="Username" placeholder="Username" value="{{ $user->username }}" class="mandatory" />
                    </div>

                    <div class="mb-3 col-md-6 col-12">
                        <x-input type="text" name="alamat-lengkap" label="Alamat Lengkap" placeholder="Alamat Lengkap" value="{{ $alamat['alamat-lengkap'] ?? null }}" class="mandatory" />
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

                    <div class="mb-3 col-12">
                        <x-input type="text" name="kontak" label="No Yang Dapat Dihubungi" placeholder="No Yang Dapat Dihubungi" value="{{ $user->alumni->kontak }}" class="mandatory" />
                    </div>

                    <div class="mb-3 col-12">
                        <x-input type="password" name="password-saat-ini" label="Password Saat Ini" placeholder="Password Saat Ini" />
                    </div>

                    <div class="mb-3 col-12">
                        <x-input type="password" name="password-baru" label="Password Baru" placeholder="Password Baru"/>
                    </div>

                    <div class="mb-3 col-12">
                        <x-input type="password" name="konfirmasi-password" label="Konfirmasi Password" placeholder="Konfirmasi Password" />
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
@endsection
