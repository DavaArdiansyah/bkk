@extends('layouts.master')
@php
    $sidebarItemName = 'Akun Pengguna';
    $fileRoute = 'admin.akun-pengguna.index';
@endphp
@section('title', 'Akun Pengguna')
@section('assets')
    @vite(['resources/js/components/sweetalert2.js'])
@endsection
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.akun-pengguna.index') }}">Data Akun Pengguna</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tambah</li>
        </ol>
    </nav>

    <section class="edit">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.akun-pengguna.perusahaan.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="role" value="Perusahaan">
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="form-group mandatory">
                                <label for="id-data-perusahaan" class="form-label">Nama Perusahaan</label>
                                <select name="id-data-perusahaan" id="id-data-perusahaan"
                                    class="form-select @error('id-data-perusahaan') is-invalid @enderror">
                                    <option class="d-none" selected disabled>Pilih Perusahaan</option>
                                    @foreach ($perusahaan as $p)
                                        <option value="{{ $p->id_data_perusahaan }}"
                                            {{ old('id-data-perusahaan') == $p->id_data_perusahaan ? 'selected' : null }}>
                                            {{ $p->nama }}</option>
                                    @endforeach
                                </select>
                                @error('id-data-perusahaan')
                                    <span class="invalid-feedback d-block mt-2" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <x-input type="email" name="username" label="Email" placeholder="Email" class="mandatory" />
                        </div>
                        <div class="col-md-6 col-12">
                            <x-input type="password" name="password" label="Password" placeholder="Password"
                                class="mandatory" />
                        </div>
                        <div class="col-md-6 col-12">
                            <x-input type="password" name="konfirmasi-password" label="Konfirmasi Password"
                                placeholder="Konfirmasi Password" class="mandatory" />
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
