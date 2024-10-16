@extends('layouts.master')
@php
    $sidebarItemName = 'Lacak Alumni';
    $fileRoute = 'admin.lacak-alumni.index';
@endphp
@section('title', 'Data Alumni')
@section('assets')
    @vite('resources/js/components/datatables/lacak-alumni.js')
@endsection
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Lacak Alumni</li>
        </ol>
    </nav>

    <section>
        <div class="card">
            <div class="card-body">
                <!-- table data alumni  -->
                <table class="table table-striped nowrap " id="lacak-alumni">
                    <thead>
                        <tr>
                            <th class="text-start"></th>
                            <th class="text-start">NIK</th>
                            <th class="text-start">NAMA LENGKAP</th>
                            <th class="text-start">JURUSAN</th>
                            <th class="text-start">TAHUN LULUS</th>
                            <th class="text-start">STATUS</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $al)
                            <tr>
                                <td class="text-start"></td>
                                <td class="text-start">{{ $al->nik }}</td>
                                <td class="text-start">{{ $al->nama }}</td>
                                <td class="text-start">{{ $al->jurusan }}</td>
                                <td class="text-start">{{ $al->tahun_lulus }}</td>
                                <td class="text-start">{{ $al->status }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- end table data alumni  -->
            </div>
        </div>
    </section>
@endsection
