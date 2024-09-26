@extends('layouts.master')
@section('meta')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@php
    $sidebarItemName = 'Akun Pengguna';
    $fileRoute = 'admin.akun-pengguna.index';
@endphp
@section('title', 'Akun Pengguna')
@section('assets')
    @vite(['resources/js/components/sweetalert2/master.js', 'resources/js/components/parsley.js', 'resources/js/components/filepond/images.js', 'resources/js/wilayah.js'])
@endsection
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.akun-pengguna.index') }}">Data Akun Pengguna</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tambah</li>
        </ol>
    </nav>

    <section class="edit">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.akun-pengguna.store') }}" method="POST" data-parsley-validate>
                    @csrf
                    <input type="hidden" name="role" value="Admin">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group mandatory">
                                <label class="form-label">Logo</label>
                                <input type="file" class="filepond" name="file" required/>
                            </div>
                        </div>
                        <div class="col-12">
                            <x-input type="text" name="nip" label="NIP" placeholder="NIP" class="mandatory"
                                required="true" />
                        </div>
                        <div class="col-md-6 col-12">
                            <x-input type="text" name="nama" label="Nama Admin BKK" placeholder="Nama Admin BKK"
                                class="mandatory" required="true" />
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group mandatory">
                                <label for="jenis-kelamin" class="form-label">Jenis Kelamin</label>
                                <select name="jenis-kelamin" id="jenis-kelamin" class="form-select"
                                    data-parsley-required="true">
                                    <option disabled selected>Pilih Jenis Kelamin</option>
                                    <option value="Laki Laki">Laki Laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <x-input type="text" name="kontak" label="No Yang Dapat Dihubungi"
                                placeholder="No Yang Dapat Dihubungi" class="mandatory" required="true" />
                        </div>
                        <div class="col-md-6 col-12">
                            <x-input type="text" name="alamat-lengkap" label="Alamat Lengkap" placeholder="Alamat Lengkap"
                                class="mandatory" required="true" />
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
                                <select name="kota" id="kota" class="form-select" data-parsley-required="true"
                                    disabled>
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
                        <div class="col-md-6 col-12">
                            <div class="form-group mandatory">
                                <label for="kelurahan" class="form-label">Kelurahan</label>
                                <select name="kelurahan" id="kelurahan" class="form-select" data-parsley-required="true"
                                    disabled>
                                    <option selected disabled>Pilih Kelurahan</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <x-input type="email" name="username" label="Email" placeholder="Email" class="mandatory"
                                required="true" />
                        </div>
                        <div class="col-md-6 col-12">
                            <x-input type="password" name="password" label="Password" placeholder="Password"
                                min="8" />
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
