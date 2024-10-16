@extends('layouts.master')
@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@php
    $fileRoute = 'profil';
@endphp
@section('title', 'Akun Pengguna')

@section('assets')
    @vite(['resources/js/components/sweetalert2.js', 'resources/js/wilayah.js'])
@endsection
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('profil') }}">Profil</a></li>
            <li class="breadcrumb-item active" aria-current="page">Informasi Utama</li>
        </ol>
    </nav>

    <section class="edit">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('profil.update', $user->username) }}" method="POST">
                    @csrf @method('PUT')
                    <div id="data-provinsi" class="d-none" data-provinsi="{{ isset($alamat['provinsi']) ? $alamat['provinsi'] : null }}"></div>
                    <div id="data-kota" class="d-none" data-kota="{{ isset($alamat['kota']) ? $alamat['kota'] : null }}"></div>
                    <div id="data-kecamatan" class="d-none" data-kecamatan="{{ isset($alamat['kecamatan']) ? $alamat['kecamatan'] : null }}"></div>
                    <div id="data-kelurahan" class="d-none" data-kelurahan="{{ isset($alamat['kelurahan']) ? $alamat['kelurahan'] : null }}"></div>
                    <div class="row">
                        <div class="col-12">
                            <x-input type="text" name="nama" label="Nama Admin BKK" placeholder="Nama Admin BKK"
                                class="mandatory" value="{{ $user->admin->nama }}" />
                        </div>
                        <div class="col-md-6 col-12">
                            <x-input type="email" name="username" label="Email" placeholder="Email" class="mandatory"
                                value="{{ $user->username }}" />
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group mandatory">
                                <label for="jenis-kelamin" class="form-label">Jenis Kelamin</label>
                                <select name="jenis-kelamin" id="jenis-kelamin"
                                    class="form-select @error('jenis-kelamin') is-invalid @enderror">
                                    <option class="d-none" disabled>Pilih Jenis Kelamin</option>
                                    <option value="Laki Laki"
                                        {{ old('jenis-kelamin', $user->admin->jenis_kelamin) === 'Laki Laki' ? 'selected' : null }}>
                                        Laki Laki</option>
                                    <option value="Perempuan"
                                        {{ old('jenis-kelamin', $user->admin->jenis_kelamin) === 'Perempuan' ? 'selected' : null }}>
                                        Perempuan</option>
                                </select>
                                @error('jenis-kelamin')
                                    <span class="invalid-feedback d-block mt-2" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <x-input type="text" name="kontak" label="No Yang Dapat Dihubungi"
                                placeholder="No Yang Dapat Dihubungi" class="mandatory"
                                value="{{ $user->admin->kontak }}" />
                        </div>
                        <div class="col-md-6 col-12">
                            <x-input type="text" name="alamat-lengkap" label="Alamat Lengkap"
                                placeholder="Alamat Lengkap" class="mandatory" value="{{ $alamat['alamat-lengkap'] }}" />
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
                                <select name="kota" id="kota" class="form-select @error('kota') is-invalid @enderror" disabled>
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
                                <label for="kecamatan"
                                    class="form-label">Kecamatan</label>
                                <select name="kecamatan" id="kecamatan" class="form-select @error('kecamatan') is-invalid @enderror" disabled>
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
                                <label for="kelurahan"
                                    class="form-label">Kelurahan</label>
                                <select name="kelurahan" id="kelurahan" class="form-select @error('kelurahan') is-invalid @enderror" disabled>
                                    <option class="d-none" selected disabled>Pilih Kelurahan</option>
                                </select>
                                @error('kelurahan')
                                    <span class="invalid-feedback d-block mt-2" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <x-input type="password" name="password-saat-ini" label="Password Saat Ini"
                                placeholder="Password Saat Ini" />
                        </div>
                        <div class="col-12">
                            <x-input type="password" name="password-baru" label="Password Baru"
                                placeholder="Password Baru" />
                        </div>
                        <div class="col-12">
                            <x-input type="password" name="konfirmasi-password" label="Konfirmasi Password"
                                placeholder="Konfirmasi Password" />
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
    </section>
@endsection
