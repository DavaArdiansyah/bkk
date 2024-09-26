@extends('layouts.master')
@section('meta')
<meta name="csrf-token" content="{{ csrf_token() }}">@endsection
@php
    $sidebarItemName = 'Data Pengguna';
    $subName = 'Perusahaan';
    $fileRoute = 'admin.data-perusahaan.create';
@endphp
@section('title', 'Tambah Data Perusahaan')
@section('assets')
    @vite(['resources/js/components/parsley.js', 'resources/js/wilayah.js', 'resources/js/components/sweetalert2/master.js', 'resources/js/components/filepond/images.js', 'resources/js/components/filepond/excel.js', 'resources/js/bidang-usaha.js'])
@endsection
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route ('admin.data-perusahaan.index')}}">Data Perusahaan</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tambah</li>
        </ol>
    </nav>

    <section>
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.data-perusahaan.akun.create') }}" method="POST" enctype="multipart/form-data"
                    data-parsley-validate>
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group mandatory">
                                <label class="form-label">Logo</label>
                                <input type="file" class="filepond" name="file" required />
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <x-input type="text" name="nama" label="Nama Perusahaan" placeholder="Nama Perusahaan"
                                class="mandatory" required="true" />
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group mandatory">
                                <label for="bidang-usaha" class="form-label">Bidang Usaha</label>
                                <select name="bidang-usaha" id="bidang-usaha" class="form-select" required>
                                    <option disabled selected>Pilih Bidang Usaha</option>
                                    <option value="tambah">Tambah Opsi Baru</option>
                                    <option value="Perdagangan">Perdagangan</option>
                                    <option value="Makanan dan Minuman">Makanan dan Minuman</option>
                                    <option value="Pertanian dan Perkebunan">Pertanian dan Perkebunan</option>
                                    <option value="Jasa">Jasa</option>
                                    <option value="Properti dan Konstruksi">Properti dan Konstruksi</option>
                                    <option value="Industri Kreatif">Industri Kreatif</option>
                                    <option value="Teknologi Informasi dan Komunikasi">Teknologi Informasi dan Komunikasi
                                    </option>
                                    <option value="Pariwisata dan Perhotelan">Pariwisata dan Perhotelan</option>
                                    <option value="Transportasi dan Logistik">Transportasi dan Logistik</option>
                                    <option value="Industri Manufaktur">Industri Manufaktur</option>
                                </select>
                                <input type="text" inputmode="numeric" id="option-lainnya" class="form-control d-none"
                                    placeholder="Masukkan bidang usaha baru" />
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <x-input type="text" name="no-telepon" label="No Telepon" placeholder="No Telepon"
                                class="mandatory" required="true" />
                        </div>
                        <div class="col-md-6 col-12">
                            <x-input type="text" name="alamat" label="Alamat Lengkap" placeholder="Alamat Lengkap"
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
                    </div>
                    <div class="row">
                        <div class="col-12 d-flex justify-content-end">
                            <button type="reset" class="btn btn-secondary m-1">Reset</button>
                            <button type="submit" class="btn btn-primary m-1">Selanjutnya</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Upload Data Excel</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.data-perusahaan.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" class="filepond-excel" name="files[]" required>
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-upload me-2"></i>Upload
                    </button>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Petunjuk Impor Data</h4>
            </div>
            <div class="card-body">
                <ol class="list mb-0">
                    <li>Download Format Yang Sudah Disediakan Jika Belum Memilikinya: <a
                            href="{{ asset('assets/file/data-perusahaan/Format.xlsx') }}" download>Format.xlsx</a></li>
                    <li>Isi Data Sesuai Dengan Format Yang Sudah Disediakan</li>
                </ol>
                <br>
                <u>Note :</u>
                <br>Jika Impor Gagal Coba Lihat Pada File Yang Anda Impor
            </div>
        </div>
    </section>
@endsection
