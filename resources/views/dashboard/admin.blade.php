@section('title', 'Dashboard')
@php $fileRoute = 'dashboard'; @endphp
@extends('layouts.master')
@section('assets')
    @vite(['resources/js/components/sweetalert2.js', 'resources/js/views/dashboard.js'])
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
                <x-statistics title="Alumni Yang Tidak Bekerja" icon="hourglass-split"
                    data="{{ $data['tidak-bekerja'] }}" />
            </a>
        </div>
        <div class="col-12">
            <form action="{{ route('admin.laporan') }}" method="get" class="d-none" id="laporan">
                <input type="hidden" name="kategori" value="lacak-alumni">
            </form>
            <a href="{{route ('admin.ajuan-info-lowongan.index')}}">
                <x-statistics title="Ajuan Lowongan" icon="newspaper" data="{{ $data['ajuan-lowongan'] }}" />
            </a>
        </div>
        <div class="col-12">
            <!-- Grafik Garis -->
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-12 col-md-9">
                            <h4>Alumni Bekerja di Perusahaan Berdasarkan Lamaran Tahun {{ $tahun }}</h4>
                        </div>
                        <div class="col-12 col-md-3">
                            <form action="{{ route('dashboard') }}" method="GET" id="periode">
                                <select class="form-select" id="periode" name="periode">
                                    @for ($year = now()->year; $year >= now()->year - 4; $year--)
                                        <option value="{{ $year }}"
                                            {{ old('periode', $tahun ?? '') == $year ? 'selected' : null }}>
                                            {{ $year }}
                                        </option>
                                    @endfor
                                </select>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    {!! $data['chart']['detail-alumni-bekerja']->container() !!}
                </div>
            </div>
            <!-- Akhir Grafik Garis -->
            <div class="row">
                <div class="col-12 col-md-6 mb-4">
                    <div class="card">
                        <div class="card-header">
                            <h4>Lacak Alumni Seluruh Angkatan</h4>
                        </div>
                        <div class="card-body">
                            {!! $data['chart']['lacak-alumni']->container() !!}
                        </div>
                    </div>
                </div>

                @foreach (['AK', 'BR', 'DKV', 'MLOG', 'MP', 'RPL', 'TKJ'] as $jurusan)
                    <div class="col-12 col-md-6 mb-4">
                        <div class="card">
                            <div class="card-header">
                                <h4>Lacak Alumni Jurusan {{ $jurusan }}</h4>
                            </div>
                            <div class="card-body">
                                {!! $data['chart']['lacak-alumni-jurusan'][$jurusan]->container() !!}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    {!! $data['chart']['detail-alumni-bekerja']->script() !!}
    {!! $data['chart']['lacak-alumni']->script() !!}
    @foreach ($data['chart']['lacak-alumni-jurusan'] as $chartJurusan)
        {!! $chartJurusan->script() !!}
    @endforeach
@endsection
