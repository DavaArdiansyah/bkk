@extends('layouts.master')
@section('meta')
<meta name="csrf-token" content="{{ csrf_token() }}">@endsection
@php
    $sidebarItemName = 'Data Pengguna';
    $subName = 'Perusahaan';
    $fileRoute = 'admin.data-perusahaan.index';
@endphp
@section('title', 'Tambah Data Perusahaan')
@section('assets')
    @vite(['resources/js/components/parsley.js', 'resources/js/wilayah.js', 'resources/js/components/sweetalert2/master.js', 'resources/js/components/filepond/images.js', 'resources/js/bidang-usaha.js'])
@endsection
@section('content')
    <section class="tambah">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.data-perusahaan.update', $perusahaan->id_data_perusahaan) }}" method="POST"
                    enctype="multipart/form-data" data-parsley-validate>
                    @csrf @method('PUT')
                    <div id="data-provinsi" class="d-none">{{ $alamat['provinsi'] }}</div>
                    <div id="data-kota" class="d-none">{{ $alamat['kota'] }}</div>
                    <div id="data-kecamatan" class="d-none">{{ $alamat['kecamatan'] }}</div>
                    <div id="data-kelurahan" class="d-none">{{ $alamat['kelurahan'] }}</div>
                    <div class="row">
                        {{-- <div class="col-12">
                            <div class="form-group mandatory">
                                <label class="form-label">Logo</label>
                                <input type="file" class="filepond" name="file"/>
                            </div>
                        </div> --}}
                        <div class="col-md-6 col-12">
                            <x-input type="text" name="nama" label="Nama Perusahaan" placeholder="Nama Perusahaan" value="{{$perusahaan->nama}}" class="mandatory" required="true"/>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group mandatory">
                                <label for="bidang-usaha" class="form-label">Bidang Usaha</label>
                                <select name="bidang-usaha" id="bidang-usaha" class="form-select" required>
                                    <option disabled>Pilih Bidang Usaha</option>
                                    <option value="tambah" {{ $perusahaan->bidang_usaha == 'tambah' ? 'selected' : '' }}>
                                        Tambah Opsi Baru</option>
                                    <option value="Perdagangan"
                                        {{ $perusahaan->bidang_usaha == 'Perdagangan' ? 'selected' : '' }}>Perdagangan
                                    </option>
                                    <option value="Makanan dan Minuman"
                                        {{ $perusahaan->bidang_usaha == 'Makanan dan Minuman' ? 'selected' : '' }}>Makanan
                                        dan Minuman</option>
                                    <option value="Pertanian dan Perkebunan"
                                        {{ $perusahaan->bidang_usaha == 'Pertanian dan Perkebunan' ? 'selected' : '' }}>
                                        Pertanian dan Perkebunan</option>
                                    <option value="Jasa" {{ $perusahaan->bidang_usaha == 'Jasa' ? 'selected' : '' }}>Jasa
                                    </option>
                                    <option value="Properti dan Konstruksi"
                                        {{ $perusahaan->bidang_usaha == 'Properti dan Konstruksi' ? 'selected' : '' }}>
                                        Properti dan Konstruksi</option>
                                    <option value="Industri Kreatif"
                                        {{ $perusahaan->bidang_usaha == 'Industri Kreatif' ? 'selected' : '' }}>Industri
                                        Kreatif</option>
                                    <option value="Teknologi Informasi dan Komunikasi"
                                        {{ $perusahaan->bidang_usaha == 'Teknologi Informasi dan Komunikasi' ? 'selected' : '' }}>
                                        Teknologi Informasi dan Komunikasi</option>
                                    <option value="Pariwisata dan Perhotelan"
                                        {{ $perusahaan->bidang_usaha == 'Pariwisata dan Perhotelan' ? 'selected' : '' }}>
                                        Pariwisata dan Perhotelan</option>
                                    <option value="Transportasi dan Logistik"
                                        {{ $perusahaan->bidang_usaha == 'Transportasi dan Logistik' ? 'selected' : '' }}>
                                        Transportasi dan Logistik</option>
                                    <option value="Industri Manufaktur"
                                        {{ $perusahaan->bidang_usaha == 'Industri Manufaktur' ? 'selected' : '' }}>Industri
                                        Manufaktur</option>

                                    @if (
                                        !in_array($perusahaan->bidang_usaha, [
                                            'Perdagangan',
                                            'Makanan dan Minuman',
                                            'Pertanian dan Perkebunan',
                                            'Jasa',
                                            'Properti dan Konstruksi',
                                            'Industri Kreatif',
                                            'Teknologi Informasi dan Komunikasi',
                                            'Pariwisata dan Perhotelan',
                                            'Transportasi dan Logistik',
                                            'Industri Manufaktur',
                                        ]))
                                        <option value="{{ $perusahaan->bidang_usaha }}" selected>
                                            {{ $perusahaan->bidang_usaha }}</option>
                                    @endif
                                </select>
                                <input type="text" inputmode="numeric" id="option-lainnya" class="form-control d-none"
                                    placeholder="Masukkan bidang usaha baru" />
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <x-input type="text" name="no-telepon" label="No Telepon" placeholder="No Telepon" value="{{$perusahaan->no_telepon}}" class="mandatory" required="true"/>
                        </div>
                        <div class="col-md-6 col-12">
                            <x-input type="text" name="alamat" label="Alamat Lengkap" placeholder="Alamat Lengkap" value="{{$alamat['alamat-lengkap']}}" class="mandatory" required="true"/>
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
                            <button type="submit" class="btn btn-primary m-1">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
