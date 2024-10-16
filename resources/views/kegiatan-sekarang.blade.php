@section('title', 'Kegiatan Sekarang')
@php $fileRoute = 'alumni.kegiatan-sekarang.edit'; @endphp
@extends('layouts.master')
@section('assets')
    @vite(['resources/js/components/sweetalert2.js', 'resources/js/views/kegiatan-sekarang.js'])
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
                    <form action="{{ route('alumni.kegiatan-sekarang.update', $alumni->nik) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group mandatory">
                            <div id="data-kegiatan-sekarang" data-kegiatan-sekarang="{{ $alumni->status }}"></div>
                            <label for="kegiatan-sekarang" class="form-label fw-bold text-secondary">Kegiatan Sekarang</label>
                            <select name="kegiatan-sekarang" id="kegiatan-sekarang" class="form-select border-primary">
                                <option class="d-none" disabled selected>Pilih Status Yang Sesuai Dengan Anda</option>
                                <option value="Bekerja" {{ old('kegiatan-sekarang', $alumni->status) == 'Bekerja' ? 'selected' : null }}>Bekerja</option>
                                <option value="Kuliah" {{ old('kegiatan-sekarang', $alumni->status) == 'Kuliah' ? 'selected' : null }}>Kuliah</option>
                                <option value="Wirausaha" {{ old('kegiatan-sekarang', $alumni->status) == 'Wirausaha' ? 'selected' : null }}>Wirausaha</option>
                                <option value="Tidak Bekerja" {{ old('kegiatan-sekarang', $alumni->status) == 'Tidak Bekerja' ? 'selected' : null }}>Tidak Bekerja</option>
                            </select>
                        </div>
                        <div class="form-group mandatory">
                            <div class="keterangan d-none">
                                <label for="keterangan" class="form-label fw-bold text-secondary">Keterangan</label>
                                <textarea class="form-control @error('keterangan') is-invalid @enderror" id="keterangan" rows="5" name="keterangan"
                                    placeholder="Masukkan keterangan kegiatan sekarang...">{{ old('keterangan', isset($alumni->keterangan) ? $alumni->keterangan : null) }}</textarea>
                                @error('keterangan')
                                    <span class="invalid-feedback d-block mt-2" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-save me-2"></i> Simpan
                        </button>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection
