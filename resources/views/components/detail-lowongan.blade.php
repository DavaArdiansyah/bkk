<div class="card">
    <div class="card-body p-4">
        @if (Route::is('admin.info-lowongan.show', $data->id_lowongan_pekerjaan))
            <div class="alert {{ $data->status == 'Dipublikasi' ? 'alert-success' : 'alert-danger' }} d-flex align-items-center mb-4"
                role="alert">
                <i class="bi {{ $data->status == 'Dipublikasi' ? 'bi-check-circle' : 'bi-x-circle' }} me-2"></i>
                <div>Status Lowongan: {{ $data->status }}</div>
            </div>
        @endif

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="card-title mb-0">{{ $data->perusahaan->nama }}</h3>
            <span class="badge bg-primary fs-6">{{ $data->jenis_waktu_pekerjaan }}</span>
        </div>

        <div class="row g-3 mb-4">
            <div class="col-md-6">
                <div class="d-flex align-items-center">
                    <i class="bi bi-calendar-event text-primary me-2 fs-5"></i>
                    <div>
                        <small class="text-muted d-block">Batas Lowongan</small>
                        <strong>{{ $data->tanggal_akhir->format('j M Y H:i') }}</strong>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="d-flex align-items-center">
                    <i class="bi bi-briefcase text-primary me-2 fs-5"></i>
                    <div>
                        <small class="text-muted d-block">Jabatan</small>
                        <strong>{{ $data->jabatan }}</strong>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="d-flex align-items-center">
                    <i class="bi bi-geo-alt text-primary me-2 fs-5"></i>
                    <div>
                        <small class="text-muted d-block">Lokasi</small>
                        <strong>{{ $data->perusahaan->alamat }}</strong>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title mb-3">Deskripsi Pekerjaan</h5>
                <p class="card-text">{{ $data->deskripsi }}</p>
            </div>
        </div>

        @if (Route::is('alumni.cari-lowongan.show', $data->id_lowongan_pekerjaan))
        @if ($status)
                    <button class="btn btn-secondary w-100" disabled>
                        <i class="bi bi-send me-2"></i>{{$status->status}}
                    </button>
                @else
                    <button class="btn btn-primary w-100" data-bs-toggle="modal"
                        data-bs-target="#modal-input-cv-{{ $data->id_lowongan_pekerjaan }}">
                        <i class="bi bi-send me-2"></i>Lamar Sekarang
                    </button>
                @endif
            <x-modal.cv id="{{ $data->id_lowongan_pekerjaan }}" />
        @elseif (Route::is('admin.ajuan-info-lowongan.show', $data->id_lowongan_pekerjaan))
            <div class="row g-3 mb-4">
                <div class="col-md-4">
                    <div class="card text-center bg-light">
                        <div class="card-body">
                            <h5 class="card-title text-primary mb-0">{{ $pelamar }}</h5>
                            <small class="text-muted">Total Pelamar</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-center bg-light">
                        <div class="card-body">
                            <h5 class="card-title text-success mb-0">{{ $diterima }}</h5>
                            <small class="text-muted">Diterima</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-center bg-light">
                        <div class="card-body">
                            <h5 class="card-title text-danger mb-0">{{ $ditolak }}</h5>
                            <small class="text-muted">Ditolak</small>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if (Route::is('admin.info-lowongan.show', $data->id_lowongan_pekerjaan) ||
                Route::is('admin.ajuan-info-lowongan.show', $data->id_lowongan_pekerjaan))
            <div class="d-flex justify-content-between mt-4">
                @if ($data->status == 'Tertunda')
                    <form action="{{ route('admin.ajuan-info-lowongan.update', $data->id_lowongan_pekerjaan) }}"
                        method="POST" class="flex-grow-1 me-2">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="status" value="Dipublikasi">
                        <button type="submit" class="btn btn-success w-100"
                            {{ $data->tanggal_akhir->lt(now()) ? 'disabled' : null }}>
                            <i class="bi bi-check-circle me-2"></i>Publikasi
                        </button>
                    </form>
                @endif
                @if ($data->status != 'Tidak Dipublikasi')
                    <button type="button" class="btn btn-danger flex-grow-1" data-bs-toggle="modal"
                        data-bs-target="#modal-input-pesan-{{ $data->id_lowongan_pekerjaan }}">
                        <i class="bi bi-x-circle me-2"></i>Tidak Dipublikasi
                    </button>
                    <x-modal.input-pesan id="{{ $data->id_lowongan_pekerjaan }}" title="Pesan Untuk Perusahaan"
                        action="{{ route('admin.ajuan-info-lowongan.update', $data->id_lowongan_pekerjaan) }}"
                        for="lowongan" />
                @endif
            </div>
        @endif
    </div>
</div>
