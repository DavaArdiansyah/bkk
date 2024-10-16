@extends('layouts.master')
@section('title', 'Profil')
<?php $fileRoute = 'profil'; ?>
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
                <div class="col-2 col-md-3 text-end">
                </div>
            </div>
        </div>
        <div class="card-body">
            <p>Silakan perbaharui informasi utama di bawah ini:</p>
            <form class="form" action="{{ route('profil.update', $user->username) }}" method="POST">
                @csrf @method('PUT')
                <div id="data-provinsi" class="d-none"
                    data-provinsi="{{ isset($alamat['provinsi']) ? $alamat['provinsi'] : null }}"></div>
                <div id="data-kota" class="d-none" data-kota="{{ isset($alamat['kota']) ? $alamat['kota'] : null }}"></div>
                <div id="data-kecamatan" class="d-none"
                    data-kecamatan="{{ isset($alamat['kecamatan']) ? $alamat['kecamatan'] : null }}"></div>
                <div id="data-kelurahan" class="d-none"
                    data-kelurahan="{{ isset($alamat['kelurahan']) ? $alamat['kelurahan'] : null }}"></div>
                <div class="row">
                    <div class="mb-3 col-md-6 col-12">
                        <x-input type="email" name="username" label="Username" placeholder="Username"
                            value="{{ $user->username }}" class="mandatory" required="true" />
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="bidang-usaha" class="form-label">Bidang Usaha</label>
                            <select name="bidang-usaha" id="bidang-usaha" class="form-select" required>
                                <option class="d-none" disabled>Pilih Bidang Usaha</option>
                                <option value="tambah"
                                    {{ $user->perusahaan->bidang_usaha == 'tambah' ? 'selected' : null }}>
                                    Tambah
                                    Opsi Baru</option>
                                <option value="Perdagangan"
                                    {{ $user->perusahaan->bidang_usaha == 'Perdagangan' ? 'selected' : null }}>Perdagangan
                                </option>
                                <option value="Makanan dan Minuman"
                                    {{ $user->perusahaan->bidang_usaha == 'Makanan dan Minuman' ? 'selected' : null }}>
                                    Makanan
                                    dan
                                    Minuman</option>
                                <option value="Pertanian dan Perkebunan"
                                    {{ $user->perusahaan->bidang_usaha == 'Pertanian dan Perkebunan' ? 'selected' : null }}>
                                    Pertanian dan Perkebunan</option>
                                <option value="Jasa" {{ $user->perusahaan->bidang_usaha == 'Jasa' ? 'selected' : null }}>
                                    Jasa
                                </option>
                                <option value="Properti dan Konstruksi"
                                    {{ $user->perusahaan->bidang_usaha == 'Properti dan Konstruksi' ? 'selected' : null }}>
                                    Properti
                                    dan Konstruksi</option>
                                <option value="Industri Kreatif"
                                    {{ $user->perusahaan->bidang_usaha == 'Industri Kreatif' ? 'selected' : null }}>
                                    IndustriKreatif
                                </option>
                                <option value="Teknologi Informasi dan Komunikasi"
                                    {{ $user->perusahaan->bidang_usaha == 'Teknologi Informasi dan Komunikasi' ? 'selected' : null }}>
                                    Teknologi Informasi dan Komunikasi</option>
                                <option value="Pariwisata dan Perhotelan"
                                    {{ $user->perusahaan->bidang_usaha == 'Pariwisata dan Perhotelan' ? 'selected' : null }}>
                                    Pariwisata dan Perhotelan</option>
                                <option value="Transportasi dan Logistik"
                                    {{ $user->perusahaan->bidang_usaha == 'Transportasi dan Logistik' ? 'selected' : null }}>
                                    Transportasi dan Logistik</option>
                                <option value="Industri Manufaktur"
                                    {{ $user->perusahaan->bidang_usaha == 'Industri Manufaktur' ? 'selected' : null }}>
                                    Industri
                                    Manufaktur</option>

                                @if (
                                    !in_array($user->perusahaan->bidang_usaha, [
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
                                    <option value="{{ $user->perusahaan->bidang_usaha }}" selected>
                                        {{ $user->perusahaan->bidang_usaha }}</option>
                                @endif
                            </select>
                            <input type="text" id="option-lainnya" class="form-control d-none"
                                placeholder="Masukkan bidang usaha baru" />
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <x-input type="text" name="no-telepon" label="No Telepon" placeholder="No Telepon"
                            value="{{ $user->perusahaan->no_telepon }}" class="mandatory" required="true" />
                    </div>
                    <div class="col-md-6 col-12">
                        <x-input type="text" name="alamat-lengkap" label="Alamat Lengkap" placeholder="Alamat Lengkap"
                            value="{{ isset($alamat['alamat-lengkap']) ? $alamat['alamat-lengkap'] : null }}"
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
                        <x-input type="password" name="password-saat-ini" label="Password Saat Ini"
                            placeholder="Password Saat Ini" />
                    </div>
                    <div class="mb-3 col-12">
                        <x-input type="password" name="password-baru" label="Password Baru" placeholder="Password Baru"
                            min="8" />
                    </div>
                    <div class="mb-3 col-12">
                        <x-input type="password" name="konfirmasi-password" label="Konfirmasi Password"
                            placeholder="Konfirmasi Password" match="password-baru" />
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
@endsection
