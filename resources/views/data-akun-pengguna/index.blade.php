
@extends('layouts.master')
@php
    $sidebarItemName = 'Akun Pengguna';
    $fileRoute = 'admin.akun-pengguna.index';
@endphp
@section('title', 'Akun Pengguna')
@section('assets')
    @vite(['resources/js/components/datatables/akun-pengguna.js', 'resources/js/components/sweetalert2.js'])
@endsection
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Data Akun Pengguna</li>
        </ol>
    </nav>

    <section>
        <div class="card">
            <div class="card-body">
                <div class="row">
                        {{-- <div class="col-12 col-md-6 mb-2">
                            <a href="{{ route('admin.akun-pengguna.perusahaan.create') }}" class="btn btn-outline-success w-100">
                                <i class="bi bi-plus-circle"></i> Tambah Akun Perusahaan
                            </a>
                        </div> --}}
                    <div class="col-12 col-md-6 mb-2">
                        <a href="{{ route('admin.akun-pengguna.admin.create') }}" class="btn btn-outline-primary w-100">
                            <i class="bi bi-plus-circle"></i> Tambah Akun Admin
                        </a>
                    </div>
                </div>
                <!-- table data akun pengguna  -->
                <table class="table table-striped nowrap" id="akun-pengguna">
                    <thead>
                        <tr>
                            <th class="text-start"></th>
                            <th class="text-start">USERNAME</th>
                            <th class="text-start">ROLE</th>
                            <th class="text-start">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $us)
                            <tr>
                                <td class="text-start"></td>
                                <td class="text-start">{{ $us->username }}</td>
                                <td class="text-start">{{ $us->role }}</td>
                                <td class="text-start">
                                    <div class="btn-group d-flex justify-content-center" role="group" aria-label="Aksi">
                                        <a href="{{ route('admin.akun-pengguna.show', $us->username) }}"
                                            class="btn btn-primary m-1">
                                            <i class="bi bi-activity me-1"></i>Pemantauan
                                        </a>
                                        <a href="{{ route('admin.akun-pengguna.edit', $us->username) }}"
                                            class="btn btn-warning m-1">
                                            <i class="bi bi-pencil me-1"></i>Edit
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- end table data akun pengguna  -->
            </div>
        </div>
    </section>
@endsection
