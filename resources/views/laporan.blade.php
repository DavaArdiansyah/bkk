@section('title', 'Laporan')
@php $fileRoute = 'admin.laporan'; @endphp
@extends('layouts.master')
@section('assets')
    @vite(['resources/js/views/laporan.js', 'resources/js/components/datatables/detail-alumni-bekerja.js'])
@endsection
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Laporan</li>
        </ol>
    </nav>

    <div class="container">
        <section>
            <div id="periode" data-periode="{{ $periode }}"></div>
            <article class="card mb-4">
                <header class="card-header periode d-block">
                    <h4>Laporan periode {{ $periode }}</h4>
                </header>
                <header class="card-header angkatan d-none">
                    <h4>Laporan Angkatan {{ $angkatan }}</h4>
                </header>
                <div class="card-body">
                    <form action="{{ route('admin.laporan') }}" method="GET" class="periode d-block">
                        <div class="row py-3">
                            <div class="col-lg-4 col-md-6">
                                <label for="waktu" class="form-label">Rentang Waktu:</label>
                                <input type="hidden" name="kategori" value="detail-alumni-bekerja">
                            </div>
                            <div class="col-lg-8 col-md-6">
                                <div class="input-group">
                                    <input type="text" class="form-control" id="waktu"
                                        placeholder="Pilih rentang tanggal.." name="waktu">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-arrow-right d-none d-md-inline"></i>
                                        <span class="d-none d-md-inline">Terapkan</span>
                                        <i class="bi bi-arrow-right d-inline d-md-none"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>

                    <form action="{{ route('admin.laporan') }}" method="GET" class="angkatan d-none">
                        <div class="row py-3">
                            <div class="col-lg-4 col-md-6">
                                <label for="waktu" class="form-label">Angkatan:</label>
                                <input type="hidden" name="kategori" value="lacak-alumni">
                            </div>
                            <div class="col-lg-8 col-md-6">
                                <div class="input-group">
                                    <input type="text" class="form-control" id="angkatan" placeholder="Pilih angkatan.."
                                        name="angkatan" value="{{ $angkatan }}">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-arrow-right d-none d-md-inline"></i>
                                        <span class="d-none d-md-inline">Terapkan</span>
                                        <i class="bi bi-arrow-right d-inline d-md-none"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>

                    <div class="row py-3">
                        <div id="data-kategori" class="d-none">{{ isset($kategori) ? $kategori : '' }}</div>
                        <div class="col-lg-4 col-md-6">
                            <label for="kategori" class="form-label">Kategori:</label>
                        </div>
                        <div class="col-lg-8 col-md-6">
                            <select class="form-select" id="kategori" name="kategori">
                                <option value="detail-alumni-bekerja"
                                    {{ old('kategori', $kategori ?? '') == 'detail-alumni-bekerja' ? 'selected' : '' }}>
                                    Detail Alumni Bekerja
                                </option>
                                <option value="lacak-alumni"
                                    {{ old('kategori', $kategori ?? '') == 'lacak-alumni' ? 'selected' : '' }}>
                                    Lacak Alumni
                                </option>
                            </select>
                        </div>
                    </div>

                    <form id="export-form" action="{{ route('admin.laporan') }}" method="GET">
                        <input type="hidden" name="waktu" value="{{ $periode }}">
                        <input type="hidden" name="angkatan" value="{{ $angkatan }}">
                        <input type="hidden" name="data" id="export-data">
                        <input type="hidden" name="type-file" id="type-file">
                        <div class="row mt-md-3">
                            <div class="col-md-4 col-12">
                                <button type="submit" class="btn btn-outline-danger mb-2 w-100" data-type="pdf">
                                    <i class="bi bi-file-earmark-pdf"></i> Unduh .pdf
                                </button>
                            </div>
                            <div class="col-md-4 col-12">
                                <button type="submit" class="btn btn-outline-success mb-2 w-100" data-type="csv">
                                    <i class="bi bi-file-earmark-spreadsheet"></i> Unduh .csv
                                </button>
                            </div>
                            <div class="col-md-4 col-12">
                                <button type="submit" class="btn btn-outline-success mb-2 w-100" data-type="xlsx">
                                    <i class="bi bi-file-earmark-excel"></i> Unduh .xlsx
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </article>
        </section>

        <div class="card">
            <div class="card-body">
                <div class="detail-alumni-bekerja-content">
                    {{-- @php
                        $headers = ['NIK', 'Nama Lengkap', 'Nama Perusahaan'];
                    @endphp --}}

                    {{-- <x-table id="detail-alumni-bekerja" :labels="['NIK', 'NAMA LENGKAP', 'NAMA PERUSAHAAN']" :keys="['nik', 'nama', 'nama-perusahaan']" :rows="$data" /> --}}
                    <table class="table table-striped nowrap table-bordered" id="detail-alumni-bekerja">
                        <thead>
                            <tr>
                                <th class="text-center" style="width:5%">NO</th>
                                <th class="text-start">NIK</th>
                                <th class="text-start">NAMA ALUMNI</th>
                                <th class="text-start">NAMA PERUSAHAAN</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($data['detail-alumni-bekerja'])
                                @foreach ($data['detail-alumni-bekerja'] as $dt)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td class="text-start">{{ $dt['nik'] }}</td>
                                        <td class="text-start">{{ $dt['nama'] }}</td>
                                        <td class="text-start">{{ $dt['nama-perusahaan'] }}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="4" class="text-center">Tidak ada data yang ditampilkan.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>

                    {{-- @include('partials.laporan.detail-alumni-bekerja') --}}
                </div>
                <div class="lacak-alumni-content">
                    <table class="table table-striped nowrap table-bordered">
                        <thead>
                            <tr>
                                <th class="text-start">STATUS</th>
                                <th class="text-start">JUMLAH ALUMNI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($data['lacak-alumni'])
                                {{-- @foreach ($data as $dt)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td class="text-start">{{ $dt['nik'] }}</td>
                                        <td class="text-start">{{ $dt['nama'] }}</td>
                                        <td class="text-start">{{ $dt['nama-perusahaan'] }}</td>
                                    </tr>
                                @endforeach --}}
                                <tr>
                                    <td>BEKERJA</td>
                                    <td>{{ $data['lacak-alumni']['bekerja'] }}</td>
                                </tr>
                                <tr>
                                    <td>KULIAH</td>
                                    <td>{{ $data['lacak-alumni']['kuliah'] }}</td>
                                </tr>
                                <tr>
                                    <td>WIRAUSAHA</td>
                                    <td>{{ $data['lacak-alumni']['wirausaha'] }}</td>
                                </tr>
                                <tr>
                                    <td>TIDAK BEKERJA</td>
                                    <td>{{ $data['lacak-alumni']['tidak bekerja'] }}</td>
                                </tr>
                            @else
                                <tr>
                                    <td colspan="4" class="text-center">Tidak ada data yang ditampilkan.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    {{-- @include('partials.laporan.info-loker') --}}
                </div>
            </div>
        </div>

    </div>
@endsection
