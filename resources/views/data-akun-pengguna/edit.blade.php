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
            <li class="breadcrumb-item active" aria-current="page">Edit</li>
        </ol>
    </nav>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.akun-pengguna.update', $user->username) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6 col-12">
                        <x-input type="string" name="username" label="Username" placeholder="Username"
                            value="{{ $user->username }}" class="mandatory" disabled/>
                    </div>
                    <div class="col-md-6 col-12">
                        <x-input type="password" name="password-baru" label="Password Baru" placeholder="Password Baru" />
                    </div>
                    <div class="col-md-6 col-12">
                        <x-input type="password" name="konfirmasi-password" label="Konfirmasi Password"
                            placeholder="Konfirmasi Password" match="password-baru" />
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary m-1">Simpan</button>
                    </div>
                </div>
            </form>
            @if ($user->role == 'Admin BKK')
                <div class="row mt-4">
                    <div class="col-md-6 col-12 mt-2">
                        <form action="{{ route('admin.akun-pengguna.status', $user->username) }}" method="POST"
                            class="w-100 m-1">
                            <input type="hidden" name="status" value="Aktif">
                            @csrf
                            @method('PUT')
                            <button type="submit"
                                class="btn btn-success w-100 {{ $user->admin->status == 'Aktif' ? 'disabled' : null }}">
                                <i class="bi bi-check-circle me-1"></i>Aktif
                            </button>
                        </form>
                    </div>
                    <div class="col-md-6 col-12 mt-2">
                        <form action="{{ route('admin.akun-pengguna.status', $user->username) }}" method="POST"
                            class="w-100 m-1">
                            <input type="hidden" name="status" value="Tidak Aktif">
                            @csrf
                            @method('PUT')
                            <button type="submit"
                                class="btn btn-danger w-100 {{ $user->admin->status == 'Tidak Aktif' ? 'disabled' : null }}">
                                <i class="bi bi-x-circle me-1"></i>Non Aktif
                            </button>
                        </form>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
