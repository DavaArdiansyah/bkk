@extends('layouts.master')
@php $sidebarItemName = 'Akun Pengguna'; $fileRoute = 'admin.akun-pengguna.index'; @endphp
@section('title', 'Edit Akun Pengguna')
@section('assets')
    @vite(['resources/js/components/sweetalert2/master.js', 'resources/js/parsley.js'])
@endsection
@section('content')
<section class="edit">
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.akun-pengguna.update', $user->username) }}" method="POST" data-parsley-validate>
                @csrf @method('PUT')
                <div class="row">
                    <div class="col-md-6 col-12">
                        <x-input type="email" name="username" label="Username" placeholder="Username" value="{{$user->username}}" class="mandatory" required="true"/>
                    </div>
                    <div class="col-md-6 col-12">
                        <x-input type="password" name="password-baru" label="Password Baru" placeholder="Password Baru"/>
                    </div>
                    <div class="col-md-6 col-12">
                        <x-input type="password" name="konfirmasi-password" label="Konfirmasi Password" placeholder="Konfirmasi Password" match="password-baru"/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary m-1">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
