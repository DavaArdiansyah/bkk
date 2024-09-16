@section('title', 'Dashboard')
@php $fileRoute = 'dashboard'; @endphp
@extends('layouts.master')
@section('assets')
    @vite(['resources/js/components/sweetalert2/master.js'])
@endsection
@section('content')
    <section class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h6 class="text-muted font-extrabold">
                        {{ 'Halo ' . Auth::user()->username . ', anda login sebagai Admin BKK' }}</h6>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-2 d-flex justify-content-start mt-1">
                            <div class="stats-icon green">
                                <i class="bi bi-person-fill d-flex align-items-center justify-content-center"></i>
                            </div>
                        </div>
                        <div class="col-10 mt-1">
                            <h6 class="text-muted font-semibold">Alumni Yang Bekerja</h6>
                            <h6 class="font-extrabold mb-0">{{ $kerja }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-2 d-flex justify-content-start mt-1">
                            <div class="stats-icon green">
                                <i class="bi bi-building d-flex align-items-center justify-content-center"></i>
                            </div>
                        </div>
                        <div class="col-10 mt-1">
                            <h6 class="text-muted font-semibold">Alumni Yang Tidak Bekerja</h6>
                            <h6 class="font-extrabold mb-0">{{ $tidakKerja }}</h6>
                        </div>
                    </div>
                </div>
            </div>
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
                    {!! $chart->container() !!}
                </div>
            </div>
            <!-- Akhir Grafik Garis -->
        </div>
    </section>

@endsection
