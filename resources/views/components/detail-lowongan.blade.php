<div class="card">
    <div class="card-body">
        {{-- Status Lowongan --}}
        @if (Route::is('admin.info-lowongan.show', $data->id_lowongan_pekerjaan))
            <p class="card-text {{ $data->status == 'Dipublikasi' ? 'text-success' : 'text-danger' }}">
                <i class="bi bi-calendar-event"></i> Status Lowongan: {{ $data->status }}
            </p>
        @endif

        {{-- Nama Perusahaan --}}
        <h4 class="card-title">
            Nama Perusahaan: <span class="text-primary">{{ $data->perusahaan->nama }}</span>
        </h4>

        {{-- Informasi Lowongan --}}
        <p class="card-text">
            <i class="bi bi-calendar-event"></i> Batas Lowongan: {{ $data->tanggal_akhir }}
        </p>

        <p class="card-text">
            <i class="bi bi-geo-alt"></i> Lokasi: {{ $data->perusahaan->alamat }}
        </p>

        <p class="card-text">
            <i class="bi bi-briefcase"></i> Jabatan: {{ $data->jabatan }}
        </p>

        <p class="card-text">
            <i class="bi bi-clock"></i> Jenis Waktu Pekerjaan:
            <span class="badge bg-primary">{{ $data->jenis_waktu_pekerjaan }}</span>
        </p>

        {{-- Deskripsi Pekerjaan --}}
        <div class="card mt-3">
            <hr>
            <h5 class="card-title">Deskripsi Pekerjaan:</h5>
            <p class="card-text">{{ $data->deskripsi }}</p>

            {{-- Aksi Berdasarkan Role --}}
            @if (Route::is('alumni.cari-lowongan.show', $data->id_lowongan_pekerjaan))
                <button class="btn btn-primary mt-3" data-bs-toggle="modal"
                    data-bs-target="#modal-input-cv-{{ $data->id_lowongan_pekerjaan }}">
                    Lamar
                </button>
                <x-modal.cv id="{{ $data->id_lowongan_pekerjaan }}" />
                {{-- Konten opsional dalam modal lamar --}}
            @else
                <div class="row" role="group">
                    {{-- Tombol Publikasi --}}
                    @if ($data->status == 'Tertunda')
                        <div class="col-md-6 col-12 mb-3">
                            <form
                                action="{{ route('admin.ajuan-info-lowongan.update', $data->id_lowongan_pekerjaan) }}"
                                method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="status" value="Dipublikasi">
                                <button type="submit" class="btn btn-success w-100"
                                    {{ $data->tanggal_akhir < now() ? 'disabled' : '' }}>
                                    <i class="bi bi-check-circle me-1"></i> Publikasi
                                </button>
                            </form>
                        </div>
                    @endif

                    {{-- Tombol Tidak Dipublikasi --}}
                    @if ($data->status != 'Tidak Dipublikasi')
                        <div class="col-md-6 col-12 mb-3">
                            <button type="button" class="btn btn-danger w-100" data-bs-toggle="modal"
                                data-bs-target="#modal-input-pesan-{{ $data->id_lowongan_pekerjaan }}">
                                <i class="bi bi-x-circle me-1"></i> Tidak Dipublikasi
                            </button>
                            <x-modal.input-pesan id="{{ $data->id_lowongan_pekerjaan }}" title="Pesan Untuk Perusahaan"
                                action="{{ route('admin.ajuan-info-lowongan.update', $data->id_lowongan_pekerjaan) }}"
                                for="lowongan" />
                        </div>
                    @endif
                </div>
            @endif

            @if (Route::is('admin.ajuan-info-lowongan.show', $data->id_lowongan_pekerjaan))
                <hr>
                <p class="card-text">
                    <i class="bi bi-briefcase"></i> Pelamar: {{ $pelamar }}
                </p>
                <p class="card-text">
                    <i class="bi bi-check-circle"></i> Diterima: {{ $diterima }}
                </p>
                <p class="card-text">
                    <i class="bi bi-x-circle"></i> Ditolak: {{ $ditolak }}
                </p>
            @endif
        </div>
    </div>
</div>
