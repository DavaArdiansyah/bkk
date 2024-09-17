@extends('layouts.master')
@php
    $sidebarItemName = 'Data Pengguna';
    $subName = 'Alumni';
    $fileRoute = 'admin.data-alumni.index';
@endphp

@section('title', 'Data Alumni')
@section('assets')
    @vite(['resources/js/components/parsley.js', 'resources/js/components/sweetalert2/master.js'])
@endsection
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route ('admin.data-alumni.index')}}">Data Alumni</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit</li>
        </ol>
    </nav>
    <section class="edit">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.data-alumni.update', $alumni->nik) }}" method="POST" data-parsley-validate>
                    @csrf @method('PUT')
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <x-input type="text" name="nik" label="NIK" placeholder="NIK"
                                value="{{ $alumni->nik }}" class="mandatory" required="true" />
                        </div>
                        <div class="col-md-6 col-12">
                            <x-input type="text" name="nama" label="Nama Lengkap" placeholder="Nama Lengkap"
                                value="{{ $alumni->nama }}" class="mandatory" required="true" />
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group mandatory">
                                <label for="jenis-kelamin" class="form-label">JENIS KELAMIN</label>
                                <select name="jenis-kelamin" id="jenis-kelamin" class="form-select"
                                    data-parsley-required="true">
                                    <option disabled>PILIH JENIS KELAMIN</option>
                                    <option value="Laki Laki"
                                        {{ $alumni->jenis_kelamin === 'Laki Laki' ? 'selected' : '' }}>Laki Laki</option>
                                    <option value="Perempuan"
                                        {{ $alumni->jenis_kelamin === 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group mandatory">
                                <label for="jurusan" class="form-label">JURUSAN</label>
                                <select name="jurusan" id="jurusan" class="form-select" data-parsley-required="true">
                                    <option disabled>PILIH JURUSAN</option>
                                    <option value="AK" {{ $alumni->jurusan === 'AK' ? 'selected' : '' }}>AK</option>
                                    <option value="BR" {{ $alumni->jurusan === 'BR' ? 'selected' : '' }}>BR</option>
                                    <option value="DKV" {{ $alumni->jurusan === 'DKV' ? 'selected' : '' }}>DKV</option>
                                    <option value="MLOG" {{ $alumni->jurusan === 'MLOG' ? 'selected' : '' }}>MLOG</option>
                                    <option value="MP" {{ $alumni->jurusan === 'MP' ? 'selected' : '' }}>MP</option>
                                    <option value="RPL" {{ $alumni->jurusan === 'RPL' ? 'selected' : '' }}>RPL</option>
                                    <option value="TKJ" {{ $alumni->jurusan === 'TKJ' ? 'selected' : '' }}>TKJ</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <x-input type="text" name="tahun-lulus" label="Tahun Lulus" placeholder="Tahun Lulus"
                                value="{{ $alumni->tahun_lulus }}" class="mandatory" required="true" />
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
