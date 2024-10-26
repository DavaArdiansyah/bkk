@extends('layouts.master')
@section('title', 'Profil')
@php
    $fileRoute = 'profil';
@endphp
@section('assets')
    @vite(['resources/js/components/sweetalert2.js'])
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('profil') }}">Profil</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tentang Saya</li>
        </ol>
    </nav>

    <div class="card">
        <div class="card-header">
            <div class="row align-items-center">
                <div class="col-2 col-md-1 text-center">
                    <i class="bi bi-camera-fill fs-4"></i>
                </div>
                <div class="col-8 col-md-8">
                    <h5 class="font-weight-bold mb-0">Tentang Saya</h5>
                </div>
                <div class="col-2 col-md-3 text-end">
                    @if (isset($alumni->deskripsi))
                        <a onclick="event.preventDefault(); document.getElementById('destroy-form').submit();"
                            class="btn btn-link">
                            <i class="bi bi-trash fs-4"></i>
                        </a>
                        <form id="destroy-form" action="{{ route('alumni.profil.tentang-saya.destroy', $alumni->nik) }}"
                            method="POST" class="d-none">
                            @csrf @method('DELETE')
                        </form>
                    @endif
                </div>
            </div>
        </div>
        <div class="card-body">
            <p>Silakan bagikan informasi tentang diri Anda di bawah ini:</p>
            <form class="form" action="{{ route('alumni.profil.tentang-saya.update', $alumni->nik) }}" method="POST">
                @csrf @method('PUT')
                <div class="row">
                    <div class="mb-3 col-12 form-group">
                        <label for="deskripsi" class="form-label d-none">Kolom</label>
                        <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" rows="4" name="deskripsi">{{ old('deskripsi', isset($alumni->deskripsi) ? $alumni->deskripsi : null) }}</textarea>
                        @error('deskripsi')
                            <span class="invalid-feedback d-block mt-2" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
@endsection
