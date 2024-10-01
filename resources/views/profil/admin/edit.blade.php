@extends('layouts.master')
@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@php
    $fileRoute = 'profil';
@endphp
@section('title', 'Akun Pengguna')
@section('assets')
    @vite(['resources/js/components/sweetalert2/master.js', 'resources/js/components/parsley.js', 'resources/js/components/filepond/images.js', 'resources/js/wilayah.js'])
@endsection
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Profil</li>
        </ol>
    </nav>

    <section class="edit">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('profil.update', $user->username) }}" method="POST" data-parsley-validate>
                    @csrf @method('PUT')
                    <div id="data-provinsi" class="d-none">{{ isset($alamat['provinsi']) ? $alamat['provinsi'] : '' }}</div>
                    <div id="data-kota" class="d-none">{{ isset($alamat['kota']) ? $alamat['kota'] : '' }}</div>
                    <div id="data-kecamatan" class="d-none">{{ isset($alamat['kecamatan']) ? $alamat['kecamatan'] : '' }}</div>
                    <div id="data-kelurahan" class="d-none">{{ isset($alamat['kelurahan']) ? $alamat['kelurahan'] : '' }}</div>
                        <div class="row">
                        <div class="col-12">
                            <x-input type="text" name="nama" label="Nama Admin BKK" placeholder="Nama Admin BKK"
                                class="mandatory" required="true" value="{{ $user->admin->nama }}" />
                        </div>
                        <div class="col-md-6 col-12">
                            <x-input type="email" name="username" label="Email" placeholder="Email" class="mandatory"
                                required="true" value="{{ $user->username }}" />
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group mandatory">
                                <label for="jenis-kelamin" class="form-label">Jenis Kelamin</label>
                                <select name="jenis-kelamin" id="jenis-kelamin" class="form-select"
                                    data-parsley-required="true">
                                    <option disabled>Pilih Jenis Kelamin</option>
                                    <option value="Laki Laki"
                                        {{ $user->admin->jenis_kelamin === 'Laki Laki' ? 'selected' : '' }}>Laki Laki</option>
                                    <option value="Perempuan"
                                        {{ $user->admin->jenis_kelamin === 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <x-input type="text" name="kontak" label="No Yang Dapat Dihubungi"
                                placeholder="No Yang Dapat Dihubungi" class="mandatory" required="true" value="{{$user->admin->kontak}}"/>
                        </div>
                        <div class="col-md-6 col-12">
                            <x-input type="text" name="alamat-lengkap" label="Alamat Lengkap" placeholder="Alamat Lengkap"
                                class="mandatory" required="true" value="{{{$alamat['alamat-lengkap']}}}"/>
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
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group mandatory">
                                <label for="kota" class="form-label">Kota/Kabupaten</label>
                                <select name="kota" id="kota" class="form-select" data-parsley-required="true" disabled>
                                    <option selected disabled>Pilih Kota/Kabupaten</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group mandatory">
                                <label for="kecamatan" class="form-label">Kecamatan</label>
                                <select name="kecamatan" id="kecamatan" class="form-select" data-parsley-required="true"
                                    disabled>
                                    <option selected disabled>Pilih Kecamatan</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-12 mb-3">
                            <div class="form-group mandatory">
                                <label for="kelurahan" class="form-label">Kelurahan</label>
                                <select name="kelurahan" id="kelurahan" class="form-select" data-parsley-required="true"
                                    disabled>
                                    <option selected disabled>Pilih Kelurahan</option>
                                </select>
                            </div>
                        </div>
                            <div class="col-12">
                            <x-input type="password" name="password-saat-ini" label="Password Saat Ini"
                                placeholder="Password Saat Ini" />
                        </div>
                        <div class="col-12">
                            <x-input type="password" name="password-baru" label="Password Baru"
                                placeholder="Password Baru" min="8" />
                        </div>
                        <div class="col-12">
                            <x-input type="password" name="konfirmasi-password" label="Konfirmasi Password"
                                placeholder="Konfirmasi Password" match="password-baru" />
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
