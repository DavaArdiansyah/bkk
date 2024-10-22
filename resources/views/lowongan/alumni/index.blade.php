@extends('layouts.master')
@section('meta')
<meta name="csrf-token" content="{{ csrf_token() }}">@endsection
@section('title', 'Cari Lowongan')
@php $fileRoute = 'alumni.cari-lowongan.index'; @endphp
@section('assets')
    @vite(['resources/js/components/sweetalert2.js', 'resources/js/components/filepond/pdf.js'])
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Cari Lowongan</li>
        </ol>
    </nav>

    <div class="row mb-3">
        <div class="col">
            <form class="d-flex" action="{{ route('alumni.cari-lowongan.index') }}" method="GET">
                <input class="form-control me-2" name="kata-kunci" type="search" placeholder="Cari pekerjaan..."
                    aria-label="Search" value="{{ isset($kataKunci) ? $kataKunci : null }}">
                <button class="btn btn-outline-primary" type="submit"><i class="bi bi-search"></i></button>
            </form>
        </div>
    </div>

    @if (!$data->isEmpty())
        <section class="row row-cols-1 row-cols-md-2">
            @foreach ($data as $dt)
                <x-card.lowongan :data="$dt" />
            @endforeach
        </section>
        {{ $data->links('pagination::bootstrap-5') }}
    @else
        <section class="card">
            <div class="card-body">
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
            </div>
        </section>
    @endif

@endsection
