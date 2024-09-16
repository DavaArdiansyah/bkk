@extends('layouts.master')
@section('title', 'Profil')

@php $fileRoute = 'profil'; @endphp

@section('content')
    <!-- Section 1: Profil Information -->
    <div class="card">
        <div class="card-body">
            <div class="row align-items-center">
                <!-- Avatar -->
                <div class="col-12 col-md-2 mb-3 mb-md-0 text-center">
                    <div class="avatar avatar-2xl border border-4 border-light">
                        <img src="{{ asset('assets/static/images/faces/2.jpg') }}" class="img-fluid rounded-circle"
                            alt="Avatar">
                    </div>
                </div>
                <!-- End Avatar -->

                <!-- Profil Data -->
                <div class="col-12 col-md-10 mb-3 mb-md-0">
                    <p class="mb-1"><strong>Username:</strong> {{ Auth::user()->username }}</p>
                    <p class="mb-1"><strong>Role:</strong> {{ Auth::user()->role }}</p>
                </div>
                <!-- End Profil Data -->
            </div>
        </div>
    </div>
    <!-- End Section 1 -->
@endsection
