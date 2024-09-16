@extends('layouts.master')
@php $sidebarItemName = 'Akun Pengguna'; $fileRoute = 'admin.akun-pengguna.index'; @endphp
@section('title', 'Akun Pengguna')
@section('assets')
    @vite(['resources/js/components/datatables/akun-pengguna.js', 'resources/js/components/sweetalert2/master.js'])
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-body">
                <!-- table data akun pengguna  -->
                <table class="table table-striped nowrap" id="akun-pengguna">
                    <thead>
                        <tr>
                            <th class="text-start"></th>
                            <th class="text-start">Username</th>
                            <th class="text-start">Role</th>
                            <th class="text-start">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $us)
                            <tr>
                                <td class="text-start"></td>
                                <td class="text-start">{{$us->username}}</td>
                                <td class="text-start">{{$us->role}}</td>
                                <td class="text-start">
                                    <div class="btn-group d-flex justify-content-center" role="group" aria-label="Aksi">
                                        <a href="{{ route('admin.akun-pengguna.show', $us->username) }}" class="btn btn-primary m-1">
                                            <i class="bi bi-activity me-1"></i>Pemantauan
                                        </a>
                                        <a href="{{ route('admin.akun-pengguna.edit', $us->username) }}" class="btn btn-warning m-1">
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
