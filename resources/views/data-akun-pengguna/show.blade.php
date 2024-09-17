@extends('layouts.master')
@php
    $sidebarItemName = 'Akun Pengguna';
    $fileRoute = 'admin.akun-pengguna.index';
@endphp
@section('title', 'Aktivitas Pengguna')
@section('assets')
    @vite(['resources/js/components/datatables.aktivitas-pengguna.js'])
@endsection
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route ('admin.akun-pengguna.index')}}">Data Akun Pengguna</a></li>
            <li class="breadcrumb-item active" aria-current="page">Aktivitas</li>
        </ol>
    </nav>

    <section>
        <div class="card">
            <div class="card-body">
                <!-- table data pengguna  -->
                <table class="table table-striped nowrap" id="aktivitas-pengguna">
                    <thead>
                        <tr>
                            <th class="text-start"></th>
                            <th class="text-start">Waktu</th>
                            <th class="text-start">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($aktivitas as $ak)
                            <tr>
                                <td class="text-start"></td>
                                <td class="text-start">{{ $ak->waktu }}</td>
                                <td class="text-start">{{ $ak->keterangan }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- end table data pengguna -->
            </div>
        </div>
    </section>
@endsection
