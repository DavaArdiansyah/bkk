@extends('layouts.master')
@php
    $sidebarItemName = 'Data Pengguna';
    $subName = 'Alumni';
    $fileRoute = 'admin.data-alumni.index';
@endphp

@section('title', 'Data Alumni')
@section('assets')
    @vite(['resources/js/components/sweetalert2.js'])
@endsection
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.data-alumni.index') }}">Data Alumni</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit</li>
        </ol>
    </nav>
    <section class="edit">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.data-alumni.update', $alumni->nik) }}" method="POST">
                    @csrf @method('PUT')
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <x-input type="text" name="nik" label="NIK" placeholder="NIK"
                                value="{{ $alumni->nik }}" class="mandatory" />
                        </div>
                        <div class="col-md-6 col-12">
                            <x-input type="text" name="nama" label="Nama Lengkap" placeholder="Nama Lengkap"
                                value="{{ $alumni->nama }}" class="mandatory" />
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group mandatory">
                                <label for="jenis-kelamin" class="form-label">Jenis Kelamin</label>
                                <select name="jenis-kelamin" id="jenis-kelamin"
                                    class="form-select @error('jenis-kelamin') is-invalid @enderror">
                                    <option class="d-none" disabled>Pilih Jenis Kelamin</option>
                                    <option value="Laki Laki"
                                        {{ old('jenis-kelamin', $alumni->jenis_kelamin) === 'Laki Laki' ? 'selected' : null }}>
                                        Laki Laki
                                    </option>
                                    <option value="Perempuan"
                                        {{ old('jenis-kelamin', $alumni->jenis_kelamin) === 'Perempuan' ? 'selected' : null }}>
                                        Perempuan
                                    </option>
                                </select>
                                @error('jenis-kelamin')
                                    <span class="invalid-feedback d-block mt-2" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6 col-12">
                            <div class="form-group mandatory">
                                <label for="jurusan" class="form-label">JURUSAN</label>
                                <select name="jurusan" id="jurusan"
                                    class="form-select @error('jenis-kelamin') is-invalid @enderror">
                                    <option class="d-none" disabled>PILIH JURUSAN</option>
                                    <option value="AK" {{ $alumni->jurusan === 'AK' ? 'selected' : null }}>AK</option>
                                    <option value="BR" {{ $alumni->jurusan === 'BR' ? 'selected' : null }}>BR</option>
                                    <option value="DKV" {{ $alumni->jurusan === 'DKV' ? 'selected' : null }}>DKV</option>
                                    <option value="MLOG" {{ $alumni->jurusan === 'MLOG' ? 'selected' : null }}>MLOG
                                    </option>
                                    <option value="MP" {{ $alumni->jurusan === 'MP' ? 'selected' : null }}>MP</option>
                                    <option value="RPL" {{ $alumni->jurusan === 'RPL' ? 'selected' : null }}>RPL
                                    </option>
                                    <option value="TKJ" {{ $alumni->jurusan === 'TKJ' ? 'selected' : null }}>TKJ
                                    </option>
                                </select>
                                @error('jurusan')
                                    <span class="invalid-feedback d-block mt-2" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <x-input type="text" name="tahun-lulus" label="Tahun Lulus" placeholder="Tahun Lulus"
                                value="{{ $alumni->tahun_lulus }}" class="mandatory" />
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
