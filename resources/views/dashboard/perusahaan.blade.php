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
            <li class="breadcrumb-item">{{ Auth::user()->perusahaan->nama }}</li>
            <li class="breadcrumb-item active" aria-current="page">{{ Auth::user()->username }}</li>
        </ol>
    </nav>

    <section class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col-12 col-md-9">
                            <h4 class="mb-0">Statistik Lowongan dan Lamaran Tahun {{ $tahun }}</h4>
                        </div>
                        <div class="col-12 col-md-3">
                            <form action="{{ route('dashboard') }}" method="GET" id="periode">
                                <select class="form-select" id="periode" name="periode"
                                    onchange="document.getElementById('periode').submit();">
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
            </div>
        </div>
        <div class="col-12 col-md-6">
            <a href="{{ route('perusahaan.info-lowongan.index') }}">
                <x-statistics title="Total Lowongan" icon="person-fill" data="{{ $data['loker'] }}" />
            </a>
        </div>
        <div class="col-12 col-md-6">
            <a href="{{ route('perusahaan.info-lowongan.index') }}">
                <x-statistics title="Lowongan Yang Dipublikasi" icon="person-fill" data="{{ $data['lokerPublikasi'] }}" />
            </a>
        </div>
        <div class="col-md-6 col-12">
            <a href="{{ route('perusahaan.lamaran.terbaru') }}">
                <x-statistics title="Total Lamaran" icon="person-fill" data="{{ $data['total-lamaran'] }}" />
            </a>
        </div>
        <div class="col-md-6 col-12">
            <a href="{{ route('perusahaan.lamaran.terbaru') }}">
                <x-statistics title="Lamaran Terbaru" icon="person-fill" data="{{ $data['lamaran'] }}" />
            </a>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="mb-3">Jumlah Lowongan dan Lamaran</h5>
                    @if ($data['chart']['lowongan-lamaran'])
                        {!! $data['chart']['lowongan-lamaran']->container() !!}
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
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="mb-3">Lamaran Yang Masuk</h5>
                    @if ($data['chart']['lamaran'])
                        {!! $data['chart']['lamaran']->container() !!}
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
        </div>
    </section>
    @if ($data['chart']['lamaran'])
        {!! $data['chart']['lamaran']->script() !!}
    @endif
    @if ($data['chart']['lowongan-lamaran'])
        {!! $data['chart']['lowongan-lamaran']->script() !!}
    @endif
@endsection
