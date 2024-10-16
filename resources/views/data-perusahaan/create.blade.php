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
    @vite(['resources/js/wilayah.js', 'resources/js/components/sweetalert2.js', 'resources/js/components/filepond/images.js', 'resources/js/components/filepond/excel.js', 'resources/js/bidang-usaha.js', 'resources/js/loader.js'])
@endsection
@section('content')
    <div id="loader-backdrop" class="loader-backdrop d-none">
        <div class="loader">
            <div class="ball"></div>
            <div class="ball"></div>
            <div class="ball"></div>
        </div>
    </div>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.data-perusahaan.index') }}">Data Perusahaan</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tambah</li>
        </ol>
    </nav>

    <section>
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.data-perusahaan.tmp-data') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group mandatory">
                                <label class="form-label">Logo</label>
                                <input type="file" class="filepond @error('file') is-invalid @enderror" name="file" />
                                @if (old('file'))
                                    <div id="path_file_image" data-path-image="{{ asset('storage/images/' . old('file')) }}"
                                        class="d-none"></div>
                                @endif

                                @error('file')
                                    <span class="invalid-feedback d-block mt-2" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <x-input type="text" name="nama" label="Nama Perusahaan" placeholder="Nama Perusahaan"
                                class="mandatory" />
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group mandatory">
                                <label for="bidang-usaha" class="form-label">Bidang Usaha</label>
                                <select name="bidang-usaha" id="bidang-usaha"
                                    class="form-select @error('bidang-usaha') is-invalid @enderror">
                                    <option class="d-none" disabled selected>Pilih Bidang Usaha</option>
                                    <option value="tambah" {{ old('bidang-usaha') == 'tambah' ? 'selected' : '' }}>Tambah
                                        Opsi Baru</option>

                                    @php
                                        $options = [
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
                                        ];
                                    @endphp

                                    @foreach ($options as $option)
                                        <option value="{{ $option }}"
                                            {{ old('bidang-usaha') == $option ? 'selected' : '' }}>
                                            {{ $option }}
                                        </option>
                                    @endforeach
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
                                class="mandatory" />
                        </div>
                        <div class="col-md-6 col-12">
                            <x-input type="text" name="alamat-lengkap" label="Alamat Lengkap"
                                placeholder="Alamat Lengkap" class="mandatory" />
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
                                <select name="kota" id="kota"
                                    class="form-select @error('kota') is-invalid @enderror" disabled>
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
                <form action="{{ route('admin.data-perusahaan.import') }}" method="POST" enctype="multipart/form-data"
                    id="import-data">
                    @csrf
                    <input type="file" class="filepond-excel @error('files') is-invalid @enderror" name="files[]">
                    @error('files')
                        <span class="invalid-feedback d-block mt-2" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
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
