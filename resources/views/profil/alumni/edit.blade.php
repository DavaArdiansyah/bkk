@extends('layouts.master')
@section('title', 'Edit Informasi Utama')
@php
    $fileRoute = 'profil';
@endphp
@section('assets')
    @vite(['resources/js/components/parsley.js', 'resources/js/wilayah.js', 'resources/js/components/sweetalert2/master.js'])
@endsection

@section('content')
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
            <p>Silakan isi/perbaharui informasi utama di bawah ini:</p>
            <form class="form" action="{{route ('profil.update', $user->username)}}" method="POST" data-parsley-validate>
                @csrf @method('PUT')
                    <div id="data-provinsi" class="d-none">{{isset($alamat['provinsi']) ? $alamat['provinsi'] : ''}}</div>
                    <div id="data-kota" class="d-none">{{isset($alamat['kota']) ? $alamat['kota'] : ''}}</div>
                    <div id="data-kecamatan" class="d-none">{{isset($alamat['kecamatan']) ? $alamat['kecamatan'] : ''}}</div>
                    <div id="data-kelurahan" class="d-none">{{isset ($alamat['kelurahan']) ? $alamat['kelurahan'] : ''}}</div>
                <div class="row">
                    <div class="mb-3 col-md-6 col-12">
                        <x-input type="text" name="username" label="Username" placeholder="Username" value="{{$user->username}}" class="mandatory" required="true"/>
                    </div>
                    <div class="col-md-6 col-12">
                        <x-input type="text" name="alamat-lengkap" label="Alamat Lengkap" placeholder="Alamat Lengkap" value="{{$alamat['alamat-lengkap']}}" class="mandatory" required="true"/>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="provinsi" class="form-label">Provinsi</label>
                            <select name="provinsi" id="provinsi" class="form-select" data-parsley-required="true">
                                <option selected disabled>Pilih Provinsi</option>
                                @foreach ($provinsi as $pr)
                                <option value="{{$pr['id']}}">{{ ucwords(strtolower($pr['name'])) }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="kota" class="form-label">Kota/Kabupaten</label>
                            <select name="kota" id="kota" class="form-select" data-parsley-required="true" disabled>
                                <option selected disabled>Pilih Kota/Kabupaten</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="kecamatan" class="form-label">Kecamatan</label>
                            <select name="kecamatan" id="kecamatan" class="form-select" data-parsley-required="true" disabled>
                                <option selected disabled>Pilih Kecamatan</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 col-12 mb-3">
                        <div class="form-group">
                            <label for="kelurahan" class="form-label">Kelurahan</label>
                            <select name="kelurahan" id="kelurahan" class="form-select" data-parsley-required="true" disabled>
                                <option selected disabled>Pilih Kelurahan</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 col-12">
                        <x-input type="text" name="kontak" label="No Yang Dapat Dihubungi" placeholder="No Yang Dapat Dihubungi" value="{{$user->alumni->kontak}}" class="mandatory" required="true"/>
                    </div>
                    <div class="mb-3 col-12">
                        <x-input type="password" name="password-saat-ini" label="Password Saat Ini" placeholder="Password Saat Ini"/>
                    </div>
                    <div class="mb-3 col-12">
                        <x-input type="password" name="password-baru" label="Password Baru" placeholder="Password Baru" min="8"/>
                    </div>
                    <div class="mb-3 col-12">
                        <x-input type="password" name="konfirmasi-password" label="Konfirmasi Password" placeholder="Konfirmasi Password" match="password-baru"/>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
@endsection
