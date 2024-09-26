@extends('layouts.master')
@php
    $sidebarItemName = 'Akun Pengguna';
    $fileRoute = 'admin.akun-pengguna.index';
@endphp
@section('title', 'Akun Pengguna')
@section('assets')
    @vite(['resources/js/components/sweetalert2/master.js', 'resources/js/components/parsley.js'])
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
                <form action="{{ route('admin.akun-pengguna.store') }}" method="POST" data-parsley-validate>
                    @csrf
                    <input type="hidden" name="role" value="Perusahaan">
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="form-group mandatory">
                                <label for="id_data_perusahaan" class="form-label">Nama Perusahaan</label>
                                <select name="id_data_perusahaan" id="id_data_perusahaan" class="form-select"
                                    data-parsley-required="true">
                                    <option selected disabled>Pilih Perusahaan</option>
                                    @foreach ($perusahaan as $p)
                                        <option value="{{ $p->id_data_perusahaan }}">{{ $p->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
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
                            <button type="submit" class="btn btn-primary m-1">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
