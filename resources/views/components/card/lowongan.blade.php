<div class="col">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $data->jabatan }}</h5>
            <h6 class="card-subtitle mb-2 text-muted">{{ $data->perusahaan->nama }}</h6>
            <p class="card-text">{{ $data->perusahaan->alamat }}</p>
            <p class="card-text"><small
                    class="text-muted">{{ $data->waktu->format('j M Y H:i') . ' sampai ' . $data->tanggal_akhir }}</small>
            </p>
            <div class="d-grid gap-2 mb-2">
                <a href="{{ isset($data->url) ? $data->url : route('alumni.cari-lowongan.show', $data->id_lowongan_pekerjaan) }}"
                    class="btn btn-outline-primary">Detail</a>
                <a class="btn btn-primary" data-bs-toggle="modal"
                    data-bs-target="#modal-input-cv-{{ $data->id_lowongan_pekerjaan }}">Lamar</a>
                <x-modal.cv id="{{ $data->id_lowongan_pekerjaan }}" />
            </div>
        </div>
    </div>
</div>
