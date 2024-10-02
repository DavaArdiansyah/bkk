@section('title', 'Dashboard')
@php $fileRoute = 'dashboard'; @endphp
@extends('layouts.master')
@section('assets')
    @vite(['resources/js/components/sweetalert2/master.js', 'resources/js/views/dashboard.js'])
@endsection
@section('content')
    @apexchartsScripts
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Admin</li>
            <li class="breadcrumb-item active" aria-current="page">{{ Auth::user()->username }}</li>
        </ol>
    </nav>

    <section class="row">
        <div class="col-12 col-md-6">
            <form action="{{ route('admin.laporan') }}" method="get" class="d-none" id="laporan">
                <input type="hidden" name="kategori" value="lacak-alumni">
            </form>
            <a href="" onclick="event.preventDefault(); document.getElementById('laporan').submit();">
                <x-statistics title="Alumni Yang Bekerja" icon="briefcase-fill" data="{{ $data['bekerja'] }}" />
            </a>
        </div>
        <div class="col-12 col-md-6">
            <a href="" onclick="event.preventDefault(); document.getElementById('laporan').submit();">
                <x-statistics title="Alumni Yang Kuliah" icon="mortarboard-fill" data="{{ $data['kuliah'] }}" />
            </a>
        </div>
        <div class="col-12 col-md-6">
            <a href="" onclick="event.preventDefault(); document.getElementById('laporan').submit();">
                <x-statistics title="Alumni Yang Wirausaha" icon="lightbulb-fill" data="{{ $data['wirausaha'] }}" />
            </a>
        </div>
        <div class="col-12 col-md-6">
            <a href="" onclick="event.preventDefault(); document.getElementById('laporan').submit();">
                <x-statistics title="Alumni Yang Tidak Bekerja" icon="hourglass-split" data="{{ $data['tidak-bekerja'] }}" />
            </a>
        </div>
        <div class="col-12">
            <!-- Grafik Garis -->
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-12 col-md-9">
                            <h4>Alumni Yang Bekerja Di Perusahaan Tertentu di Tahun {{ $tahun }}</h4>
                        </div>
                        <div class="col-12 col-md-3">
                            <form action="{{ route('dashboard') }}" method="GET" id="periode">
                                <select class="form-select" id="tahun" name="tahun">
                                    @for ($year = now()->year; $year >= now()->year - 4; $year--)
                                        <option value="{{ $year }}"
                                            {{ old('tahun', $tahun ?? '') == $year ? 'selected' : '' }}>
                                            {{ $year }}
                                        </option>
                                    @endfor
                                </select>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    {!! $data['chart']->container() !!}
                </div>
            </div>
            <!-- Akhir Grafik Garis -->
        </div>
    </section>
    {!! $data['chart']->script() !!}
@endsection
