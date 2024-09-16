@section('title', 'Dashboard')
@php $fileRoute = 'dashboard'; @endphp
@extends('layouts.master')
@section('assets')
    @vite(['resources/js/components/sweetalert2/master.js'])
@endsection
@section('content')
    @apexchartsScripts
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
            <x-statistics title="Alumni Yang Bekerja" icon="person-fill" data="{{$data['kerja']}}" />
        </div>
        <div class="col-12 col-md-6">
            <x-statistics title="Alumni Yang Tidak Bekerja" icon="building" data="{{$data['tidakKerja']}}" />
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
