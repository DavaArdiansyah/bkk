@extends('layouts.master')
@php
    $sidebarItemName = 'Data Pengguna';
    $subName = 'Perusahaan';
    $fileRoute = 'admin.data-perusahaan.index';
@endphp
@section('title', 'Data Perusahaan')
@section('assets')
    @vite(['resources/js/components/datatables/data-perusahaan.js', 'resources/js/components/sweetalert2/master.js'])
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-body">
                <!-- table data perusahaan  -->
                <table class="table table-striped nowrap " id="data-perusahaan">
                    <thead>
                        <tr>
                            <th class="text-start"></th>
                            {{-- <th class="text-start">Logo</th> --}}
                            <th class="text-start">NAMA PERUSAHAAN</th>
                            <th class="text-start">BIDANG USAHA</th>
                            <th class="text-start">AKSI</th>
                            <th class="text-start">NO TELEPON</th>
                            <th class="text-start">ALAMAT</th>
                            <th class="text-start">STATUS</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($perusahaan as $pr)
                            <tr>
                                <td class="text-start"></td>
                                {{-- <td class="text-start"><img src="{{asset('storage/tmp/images/' . $pr->logo)}}" alt="logo-{{$pr->nama}}" style="height: 50px; width: 50px" class="{{isset($pr->logo) ? $pr->logo : 'img-fluid rounded-circle border border-3 border-light'}}"></td> --}}
                                <td class="text-start">{{ $pr->nama }}</td>
                                <td class="text-start">{{ $pr->bidang_usaha }}</td>
                                <td class="text-start">
                                    <div class="btn-group d-flex justify-content-center" role="group" aria-label="Aksi">
                                        <a href="{{ route('admin.data-perusahaan.edit', $pr->id_data_perusahaan) }}"
                                            class="btn btn-warning m-1 w-100">
                                            <i class="bi bi-pencil me-1"></i>
                                        </a>
                                        <form action="{{ route('admin.data-perusahaan.update', $pr->id_data_perusahaan) }}"
                                            method="POST" class="w-100 m-1">
                                            <input type="hidden" name="status" value="Aktif">
                                            @csrf @method('PUT')
                                            <button type="submit"
                                                class="btn btn-success w-100 {{ $pr->status == 'Aktif' ? 'disabled' : '' }}">
                                                <i class="bi bi-check-circle me-1"></i>Aktif
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.data-perusahaan.update', $pr->id_data_perusahaan) }}"
                                            method="POST" class="w-100 m-1">
                                            <input type="hidden" name="status" value="Tidak Aktif">
                                            @csrf @method('PUT')
                                            <button type="submit"
                                                class="btn btn-danger w-100 {{ $pr->status == 'Tidak Aktif' ? 'disabled' : '' }}">
                                                <i class="bi bi-x-circle me-1"></i>Non Aktif
                                            </button>
                                        </form>
                                    </div>
                                </td>
                                <td class="text-start">{{ $pr->no_telepon }}</td>
                                <td class="text-start">{{ $pr->alamat }}</td>
                                <td class="text-start">{{ $pr->status }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- end table data perusahaan  -->
            </div>
        </div>
    </section>
@endsection
