<div class="col">
    <div class="card shadow-sm mb-4 border-0 transition hover:shadow-lg hover:-translate-y-1">
        <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0 me-3">
                        <img src="{{ asset('storage/images/' . $data->perusahaan->nama_file_logo) }}"
                            alt="{{ $data->perusahaan->nama }}" class="img-fluid rounded-circle"
                            style="width: 60px; height: 60px; object-fit: cover;">
                    </div>
                    <div>
                        <h5 class="card-title mb-0 fw-bold">{{ $data->jabatan }}</h5>
                        <p class="card-subtitle text-muted mb-0">{{ $data->perusahaan->nama }}</p>
                    </div>
                </div>
            </div>
            <p class="card-text text-muted mb-3">
                <i class="bi bi-geo-alt-fill me-1"></i>{{ $data->perusahaan->alamat }}
            </p>
            <p class="card-text mb-3">
                <i class="bi bi-calendar-event me-1"></i>
                <small
                    class="text-muted">{{ $data->waktu->format('j M Y H:i') . ' sampai ' . $data->tanggal_akhir }}</small>
            </p>
            <div class="d-grid gap-2">
                <a href="{{ isset($data->url) ? $data->url : route('alumni.cari-lowongan.show', $data->id_lowongan_pekerjaan) }}"
                    class="btn btn-outline-primary hover:bg-primary hover:text-white">
                    <i class="bi bi-info-circle me-1"></i>Detail
                </a>
                @if ($status)
                    <button class="btn btn-secondary" disabled>
                        <i class="bi bi-send me-1"></i>{{$status->status}}
                    </button>
                @else
                    <button class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#modal-input-cv-{{ $data->id_lowongan_pekerjaan }}">
                        <i class="bi bi-send me-1"></i>Lamar
                    </button>
                @endif
                <x-modal.cv id="{{ $data->id_lowongan_pekerjaan }}" />
            </div>
        </div>
    </div>
</div>
