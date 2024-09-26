@extends('layouts.master')
@php
    $sidebarItemName = 'Data Pengguna';
    $subName = 'Perusahaan';
    $fileRoute = 'admin.data-perusahaan.create';
@endphp
@section('title', 'Tambah Data Perusahaan')
@section('assets')
    @vite('resources/js/components/parsley.js')
@endsection
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route ('admin.data-perusahaan.index')}}">Data Perusahaan</a></li>
            <li class="breadcrumb-item"><a href="{{route ('admin.data-perusahaan.create')}}">Tambah</a></li>
            <li class="breadcrumb-item active" aria-current="page">Akun</li>
        </ol>
    </nav>

    <section class="tambah">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.data-perusahaan.store') }}" method="POST" data-parsley-validate>
                    @csrf
                    <input type="hidden" name="nama" value="{{ $request['nama'] }}">
                    <input type="hidden" name="bidang-usaha" value="{{ $request['bidang-usaha'] }}">
                    <input type="hidden" name="no-telepon" value="{{ $request['no-telepon'] }}">
                    <input type="hidden" name="alamat" value="{{ $request['alamat'] }}">
                    <input type="hidden" name="logo" value="{{ $request['nama-file-logo'] }}">
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <x-input type="email" name="username" label="Email" placeholder="Email" class="mandatory"
                                required="true" />
                        </div>
                        <div class="col-md-6 col-12">
                            <x-input type="password" name="password" label="Password" placeholder="Password"
                                class="mandatory" required="true" min="8" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary m-1">Buat</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
