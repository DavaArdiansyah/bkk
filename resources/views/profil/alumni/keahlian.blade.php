@extends('layouts.master')
@section('title', 'Profil')
@php
    $fileRoute = 'profil';
@endphp
@section('assets')
    @vite(['resources/js/components/parsley.js', 'resources/js/components/sweetalert2/master'])
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route ('profil')}}">Profil</a></li>
            <li class="breadcrumb-item active" aria-current="page">Keahlian</li>
        </ol>
    </nav>

    <div class="card">
        <div class="card-header">
            <div class="row align-items-center">
                <div class="col-2 col-md-1 text-center">
                    <i class="bi bi-star-fill fs-4"></i>
                </div>
                <div class="col-8 col-md-8">
                    <h5 class="font-weight-bold mb-0">Keahlian</h5>
                </div>
                <div class="col-2 col-md-3 text-end">
                    @if (isset($alumni->keahlian))
                        <a onclick="event.preventDefault(); document.getElementById('destroy-form').submit();"
                            class="btn btn-link">
                            <i class="bi bi-trash fs-4"></i>
                        </a>
                        <form id="destroy-form" action="{{ route('alumni.profil.keahlian.update', $alumni->nik) }}"
                            method="POST" class="d-none">
                            @csrf @method('PUT')
                        </form>
                    @endif
                </div>
            </div>
        </div>
        <div class="card-body">
            <p>Silakan isi informasi keahlian di bawah ini:</p>
            <form class="form" action="{{ route('alumni.profil.keahlian.update', $alumni->nik) }}" method="post"
                data-parsley-validate>
                @csrf @method('PUT')
                <div class="row">
                    <div class="mb-3 col-12 form-group">
                        <label for="keahlian" class="form-label">Keahlian</label>
                        <textarea class="form-control" id="keahlian" rows="5" data-parsley-required="true" name="keahlian">{{ isset($alumni->keahlian) ? $alumni->keahlian : '' }}</textarea>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
@endsection