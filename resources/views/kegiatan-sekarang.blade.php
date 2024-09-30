@section('title', 'Laporan')
@php $fileRoute = 'alumni.kegiatan-sekarang.edit'; @endphp
@extends('layouts.master')
@section('assets')
    @vite(['resources/js/components/parsley.js', 'resources/js/components/sweetalert2/master.js'])
@endsection
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Kegiatan Sekarang</li>
        </ol>
    </nav>
    <div class="container">
        <section>
            <div class="card shadow-sm">
                <div class="card-body p-4">
                    <h4 class="text-center mb-4 text-primary fw-semibold">
                        @if ($alumni->status == 'Bekerja')
                            <i class="bi bi-briefcase-fill me-2"></i>
                            "Kerja keras Anda kini membuahkan hasil. Teruslah berkarya!"
                        @elseif ($alumni->status == 'Kuliah')
                            <i class="bi bi-mortarboard-fill me-2"></i>
                            "Pendidikan adalah kunci kesuksesan. Teruslah belajar dan berkembang!"
                        @elseif ($alumni->status == 'Wirausaha')
                            <i class="bi bi-lightbulb-fill me-2"></i>
                            "Kreativitas dan keberanian Anda membangun masa depan yang cerah!"
                        @elseif ($alumni->status == 'Tidak Bekerja')
                            <i class="bi bi-hourglass-split me-2"></i>
                            "Jangan khawatir, setiap perjalanan memiliki waktunya. Teruslah berusaha!"
                        @else
                            <i class="bi bi-graph-up-arrow me-2"></i>
                            "Setiap langkah yang Anda ambil adalah investasi untuk masa depan yang lebih baik."
                        @endif
                    </h4>
                    <form action="{{ route('alumni.kegiatan-sekarang.update', $alumni->nik) }}" method="POST"
                        data-parsley-validate>
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-7 col-12">
                                <div class="form-group mandatory">
                                    <label for="kegiatan-sekarang" class="form-label fw-bold text-secondary">Kegiatan
                                        Sekarang</label>
                                    <select name="kegiatan-sekarang" id="kegiatan-sekarang"
                                        class="form-select border-primary" data-parsley-required="true"
                                        onchange="showMessage(this.value)">
                                        <option disabled selected>Pilih Status Yang Sesuai Dengan Anda</option>
                                        <option value="Bekerja" {{ $alumni->status == 'Bekerja' ? 'selected' : '' }}>Bekerja
                                        </option>
                                        <option value="Kuliah" {{ $alumni->status == 'Kuliah' ? 'selected' : '' }}>Kuliah
                                        </option>
                                        <option value="Wirausaha" {{ $alumni->status == 'Wirausaha' ? 'selected' : '' }}>
                                            Wirausaha</option>
                                        <option value="Tidak Bekerja"
                                            {{ $alumni->status == 'Tidak Bekerja' ? 'selected' : '' }}>
                                            Tidak Bekerja
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-5 col-12 mt-4 d-flex align-items-center">
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="bi bi-save me-2"></i> Simpan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection
