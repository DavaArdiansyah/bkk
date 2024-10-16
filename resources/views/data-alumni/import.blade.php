@extends('layouts.master')
@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@php
    $sidebarItemName = 'Data Pengguna';
    $subName = 'Alumni';
    $fileRoute = 'admin.data-alumni.import';
@endphp
@section('title', 'Data Alumni')
@section('assets')
    @vite(['resources/js/components/filepond/excel.js', 'resources/js/components/sweetalert2.js', 'resources/js/loader.js'])
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
            <li class="breadcrumb-item"><a href="{{ route('admin.data-alumni.index') }}">Data Alumni</a></li>
            <li class="breadcrumb-item active" aria-current="page">Import</li>
        </ol>
    </nav>

    <section>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Upload Data Excel</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.data-alumni.store') }}" method="POST" enctype="multipart/form-data" id="import-data">
                    @csrf
                    <div class="form-group mandatory">
                        <label class="form-label d-none">File</label>
                        <input type="file" class="filepond-excel @error('files') is-invalid @enderror" name="files[]" />
                    </div>
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
                            href="{{ asset('assets/file/data-alumni/Format.xlsx') }}" download>Format.xlsx</a></li>
                    <li>Isi Data Sesuai Dengan Format Yang Sudah Disediakan</li>
                </ol>
                <br>
                <u>Note :</u>
                <br>Jika Impor Gagal Coba Lihat Pada File Yang Anda Impor
            </div>
        </div>
    </section>
@endsection
