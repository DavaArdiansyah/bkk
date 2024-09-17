@extends('layouts.master')

@section('title')
    {{ Route::is('alumni.profil.pengalaman-kerja.create') ? 'Tambah Data Pengalaman Kerja' : 'Edit Data Pengalaman Kerja' }}
@endsection

@php
    $fileRoute = 'profil';
@endphp

@section('assets')
    @vite(['resources/js/components/parsley.js', 'resources/js/wilayah.js'])
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row align-items-center">
                <div class="col-2 col-md-1 text-center">
                    <i class="bi bi-briefcase-fill fs-4"></i>
                </div>
                <div class="col-8 col-md-8">
                    <h5 class="font-weight-bold mb-0">Pengalaman Kerja</h5>
                </div>
                @if (!Route::is('alumni.profil.pengalaman-kerja.create'))
                    <div class="col-2 col-md-3 text-end">
                        <a onclick="event.preventDefault(); document.getElementById('destroy-form').submit();" class="btn btn-link">
                            <i class="bi bi-trash fs-4"></i>
                        </a>
                        <form id="destroy-form" action="{{ route('alumni.profil.pengalaman-kerja.destroy', $kerja->id_pengalaman_kerja) }}" method="POST" class="d-none">
                            @csrf @method('DELETE')
                        </form>
                    </div>
                @endif
            </div>
        </div>
        <div class="card-body">
            <p>
                {{ Route::is('alumni.profil.pengalaman-kerja.create') ? 'Silakan isi informasi pengalaman kerja di bawah ini:' : 'Silakan Perbaharui informasi pengalaman kerja di bawah ini:' }}
            </p>
            <form class="form" action="{{ Route::is('alumni.profil.pengalaman-kerja.create') ? route('alumni.profil.pengalaman-kerja.store') : route('alumni.profil.pengalaman-kerja.update', $kerja->id_pengalaman_kerja) }}" method="POST" data-parsley-validate>
                @csrf
                @if (!Route::is('alumni.profil.pengalaman-kerja.create'))
                    @method('PUT')
                    <div id="data-provinsi" class="d-none">{{ $alamat['provinsi'] }}</div>
                    <div id="data-kota" class="d-none">{{ $alamat['kota'] }}</div>
                    <div id="data-kecamatan" class="d-none">{{ $alamat['kecamatan'] }}</div>
                    <div id="data-kelurahan" class="d-none">{{ $alamat['kelurahan'] }}</div>
                @endif
                <div class="row">
                    <div class="mb-3 col-12">
                        <x-input type="text" name="jabatan" label="Jabatan Pekerjaan" placeholder="Jabatan Pekerjaan" value="{{ $kerja->jabatan ?? '' }}" class="mandatory" required="true" />
                    </div>
                    <div class="mb-3 col-12">
                        <x-input type="text" name="nama-perusahaan" label="Nama Perusahaan" placeholder="Nama Perusahaan" value="{{ $kerja->nama_perusahaan ?? '' }}" class="mandatory" required="true" />
                    </div>
                    <div class="mb-3 col-md-6 col-12 form-group">
                        <label for="jenis-waktu-pekerjaan" class="form-label">Jenis Waktu Pekerjaan</label>
                        <select name="jenis-waktu-pekerjaan" id="jenis-waktu-pekerjaan" class="form-select" data-parsley-required="true">
                            <option selected disabled>Pilih Jenis Waktu Pekerjaan</option>
                            @foreach ([
                                'Waktu Kerja Standar (Full-Time)',
                                'Waktu Kerja Paruh Waktu (Part-Time)',
                                'Waktu Kerja Fleksibel (Flexible Hours)',
                                'Shift Kerja (Shift Work)',
                                'Waktu Kerja Bergilir (Rotating Shifts)',
                                'Waktu Kerja Jarak Jauh (Remote Work)',
                                'Waktu Kerja Kontrak (Contract Work)',
                                'Waktu Kerja Proyek (Project-Based Work)',
                                'Waktu Kerja Tidak Teratur (Irregular Hours)',
                                'Waktu Kerja Sementara (Temporary Work)'
                            ] as $jenis)
                                <option value="{{ $jenis }}" {{ isset($kerja) && $kerja->jenis_waktu_pekerjaan == $jenis ? 'selected' : '' }}>{{ $jenis }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 col-12">
                        <x-input type="text" name="alamat-lengkap" label="Alamat Lengkap" placeholder="Alamat Lengkap" value="{{ $alamat['alamat-lengkap'] ?? '' }}" class="mandatory" required="true" />
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
                            <select name="kecamatan" id="kecamatan" class="form-select" data-parsley-required="true" disabled>
                                <option selected disabled>Pilih Kecamatan</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="form-group mandatory">
                            <label for="kelurahan" class="form-label">Kelurahan</label>
                            <select name="kelurahan" id="kelurahan" class="form-select" data-parsley-required="true" disabled>
                                <option selected disabled>Pilih Kelurahan</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                        <x-input type="text" name="tahun-awal" label="Tahun Awal" placeholder="Tahun Awal" value="{{ $kerja->tahun_awal ?? '' }}" class="mandatory" required="true" />
                    </div>
                    <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                        <x-input type="text" name="tahun-akhir" label="Tahun Akhir" placeholder="Tahun Akhir" value="{{ $kerja->tahun_akhir ?? '' }}" class="mandatory" required="true" />
                    </div>
                    <div class="mb-3 col-12 form-group">
                        <label for="deskripsi" class="form-label">Deskripsi Singkat</label>
                        <textarea class="form-control" id="deskripsi" rows="5" data-parsley-required="true" name="deskripsi">{{ isset($kerja) ? $kerja->deskripsi : ''}}</textarea>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
@endsection
