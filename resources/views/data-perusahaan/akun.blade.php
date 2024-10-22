@extends('layouts.master')
@php
    $sidebarItemName = 'Data Pengguna';
    $subName = 'Perusahaan';
    $fileRoute = 'admin.data-perusahaan.create';
@endphp
@section('title', 'Tambah Data Perusahaan')
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
                <form action="{{ route('admin.data-perusahaan.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <x-input type="text" name="nama" label="Nama Perusahaan" placeholder="Nama Perusahaan" value="{{session('nama')}}" disabled/>
                        </div>
                        <div class="col-md-6 col-12">
                            <x-input type="email" name="username" label="Email" placeholder="Email" class="mandatory"/>
                        </div>
                        <div class="col-md-6 col-12">
                            <x-input type="password" name="password" label="Password" placeholder="Password" class="mandatory" />
                        </div>
                        <div class="col-md-6 col-12">
                            <x-input type="password" name="konfirmasi-password" label="Konfirmasi Password"
                                placeholder="Konfirmasi Password" match="password-baru" />
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
