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
            <div class="card-body">
                <h5 class="card-title">Deskripsi Pekerjaan:</h5>
                <p class="card-text">{{ $data->deskripsi }}</p>
            </div>

            {{-- Aksi Berdasarkan Role --}}
            @if (Route::is('alumni.cari-lowongan.show', $data->id_lowongan_pekerjaan))
                <button class="btn btn-primary mt-3" data-bs-toggle="modal"
                    data-bs-target="#modal-input-cv-{{ $data->id_lowongan_pekerjaan }}">
                    Lamar
                </button>
                <x-modal.cv id="{{$data->id_lowongan_pekerjaan}}" />
                    {{-- Konten opsional dalam modal lamar --}}
            @else
                <div class="btn-group mt-3" role="group">
                    {{-- Tombol Publikasi --}}
                    @if ($data->status == 'Tertunda')
                        <form action="{{ route('admin.info-lowongan.update', $data->id_lowongan_pekerjaan) }}" method="post">
                            @csrf
                            @method('put')
                            <input type="hidden" name="status" value="Dipublikasi">
                            <button type="submit" class="btn btn-success"
                                {{ $data->tanggal_akhir < now() ? 'disabled' : '' }}>
                                <i class="bi bi-check-circle me-1"></i> Publikasi
                            </button>
                        </form>
                    @endif

                    {{-- Tombol Tidak Dipublikasi --}}
                    @if ($data->status != 'Tidak Dipublikasi')
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                            data-bs-target="#modal-input-pesan-{{ $data->id_lowongan_pekerjaan }}">
                            <i class="bi bi-x-circle me-1"></i> Tidak Dipublikasi
                        </button>
                        <x-modal.lowongan.tidak-dipublikasi id="{{$data->id_lowongan_pekerjaan}}" />
                    @endif
                </div>
            @endif
        </div>
    </div>
</div>
