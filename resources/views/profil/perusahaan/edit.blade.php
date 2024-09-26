@extends('layouts.master')
@section('title', 'Profil')
<?php $fileRoute = 'profil'; ?>
@section('assets')
    @vite(['resources/js/components/parsley.js', 'resources/js/wilayah.js', 'resources/js/components/sweetalert2/master.js', 'resources/js/bidang-usaha.js'])
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
            <form class="form" action="{{ route('profil.update', $user->username) }}" method="POST"
                data-parsley-validate>
                @csrf @method('PUT')
                <div id="data-provinsi" class="d-none">{{ isset($alamat['provinsi']) ? $alamat['provinsi'] : '' }}</div>
                <div id="data-kota" class="d-none">{{ isset($alamat['kota']) ? $alamat['kota'] : '' }}</div>
                <div id="data-kecamatan" class="d-none">{{ isset($alamat['kecamatan']) ? $alamat['kecamatan'] : '' }}</div>
                <div id="data-kelurahan" class="d-none">{{ isset($alamat['kelurahan']) ? $alamat['kelurahan'] : '' }}</div>
                <div class="row">
                    <div class="mb-3 col-md-6 col-12">
                        <x-input type="email" name="username" label="Username" placeholder="Username"
                            value="{{ $user->username }}" class="mandatory" required="true" />
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="bidang-usaha" class="form-label">Bidang Usaha</label>
                            <select name="bidang-usaha" id="bidang-usaha" class="form-select" required>
                                <option disabled>Pilih Bidang Usaha</option>
                                <option value="tambah" {{ $user->perusahaan->bidang_usaha == 'tambah' ? 'selected' : '' }}>
                                    Tambah
                                    Opsi Baru</option>
                                <option value="Perdagangan"
                                    {{ $user->perusahaan->bidang_usaha == 'Perdagangan' ? 'selected' : '' }}>Perdagangan
                                </option>
                                <option value="Makanan dan Minuman"
                                    {{ $user->perusahaan->bidang_usaha == 'Makanan dan Minuman' ? 'selected' : '' }}>Makanan
                                    dan
                                    Minuman</option>
                                <option value="Pertanian dan Perkebunan"
                                    {{ $user->perusahaan->bidang_usaha == 'Pertanian dan Perkebunan' ? 'selected' : '' }}>
                                    Pertanian dan Perkebunan</option>
                                <option value="Jasa" {{ $user->perusahaan->bidang_usaha == 'Jasa' ? 'selected' : '' }}>
                                    Jasa
                                </option>
                                <option value="Properti dan Konstruksi"
                                    {{ $user->perusahaan->bidang_usaha == 'Properti dan Konstruksi' ? 'selected' : '' }}>
                                    Properti
                                    dan Konstruksi</option>
                                <option value="Industri Kreatif"
                                    {{ $user->perusahaan->bidang_usaha == 'Industri Kreatif' ? 'selected' : '' }}>
                                    IndustriKreatif
                                </option>
                                <option value="Teknologi Informasi dan Komunikasi"
                                    {{ $user->perusahaan->bidang_usaha == 'Teknologi Informasi dan Komunikasi' ? 'selected' : '' }}>
                                    Teknologi Informasi dan Komunikasi</option>
                                <option value="Pariwisata dan Perhotelan"
                                    {{ $user->perusahaan->bidang_usaha == 'Pariwisata dan Perhotelan' ? 'selected' : '' }}>
                                    Pariwisata dan Perhotelan</option>
                                <option value="Transportasi dan Logistik"
                                    {{ $user->perusahaan->bidang_usaha == 'Transportasi dan Logistik' ? 'selected' : '' }}>
                                    Transportasi dan Logistik</option>
                                <option value="Industri Manufaktur"
                                    {{ $user->perusahaan->bidang_usaha == 'Industri Manufaktur' ? 'selected' : '' }}>
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
                            value="{{ isset($alamat['alamat-lengkap']) ? $alamat['alamat-lengkap'] : '' }}"
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
