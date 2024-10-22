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
            <li class="breadcrumb-item active" aria-current="page">Alumni</li>
            <li class="breadcrumb-item active" aria-current="page">{{ Auth::user()->username }}</li>
        </ol>
    </nav>

    <section class="row">
        {{-- <div class="col-12 col-md-6">
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
        </div> --}}
        <div class="col-12">
            <!-- Grafik Garis -->
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-12 col-md-9">
                            <h4>Data Lowongan Pekerjaan yang Anda Lamar Pada Bulan
                                {{ now()->month($bulan)->format('F') . ' ' . now()->format('Y') }}</h4>
                        </div>
                        <div class="col-12 col-md-3">
                            <form action="{{ route('dashboard') }}" method="GET" id="periode">
                                <select class="form-select" id="periode" name="periode">
                                    @foreach (range(1, 12) as $month)
                                        <option value="{{ $month }}"
                                            {{ old('periode', $bulan ?? '') == $month ? 'selected' : '' }}>
                                            {{ now()->month($month)->format('F') }}
                                        </option>
                                    @endforeach
                                </select>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @if ($data['chart'])
                        {!! $data['chart']->container() !!}
                    @else
                        <div class="error-page container">
                            <div class="col-md-8 col-12 offset-md-2">
                                <div class="text-center">
                                    <img class="img-error" src="{{ asset('assets/static/images/samples/error-404.svg') }}"
                                        alt="Not Found" style="height: 10rem; width: auto">
                                    <h1 class="error-title">Oops! Gak Ketemu</h1>
                                    <p class='fs-5 text-gray-600'>Data yang kamu cari nggak ada, nih.</p>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            <!-- Akhir Grafik Garis -->
        </div>
    </section>
    @if ($data['chart'])
        {!! $data['chart']->script() !!}
    @endif
@endsection