<div class="card">
    <div class="card-body">
        <p class="card-text {{ $loker->status == 'Dipublikasi' ? 'text-success' : 'text-danger' }}">
            <i class="bi bi-calendar-event"></i> Status Lowongan: {{ $loker->status }}
        </p>

        <h4 class="card-title">
            Nama Perusahaan: <span class="text-primary">{{ $loker->perusahaan->nama }}</span>
        </h4>

        <p class="card-text">
            <i class="bi bi-calendar-event"></i> Batas Lowongan: {{ $loker->tanggal_akhir }}
        </p>

        <p class="card-text">
            <i class="bi bi-geo-alt"></i> Lokasi: {{ $loker->perusahaan->alamat }}
        </p>

        <p class="card-text">
            <i class="bi bi-briefcase"></i> Jabatan: {{ $loker->jabatan }}
        </p>

        <p class="card-text">
            <i class="bi bi-clock"></i> Jenis Waktu Pekerjaan:
            <span class="badge bg-primary">{{ $loker->jenis_waktu_pekerjaan }}</span>
        </p>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Deskripsi Pekerjaan:</h5>
                <p class="card-text">{{ $loker->deskripsi }}</p>
            </div>

            @if (Route::is('alumni.cari-lowongan.detail', $loker->id_lowongan_pekerjaan))
                <a class="btn btn-primary mt-3 ms-1" data-bs-toggle="modal"
                    data-bs-target="#modal-input-cv-{{ $loker->id_lowongan_pekerjaan }}">
                    Lamar
                </a>
                {{-- <x-input-cv id="{{ $loker->id_lowongan_pekerjaan }}"/> --}}
            @elseif (Route::is('admin.ajuan-info-lowongan.detail', $loker->id_lowongan_pekerjaan))
                <div class="btn-group" role="group" aria-label="Aksi">
                    <form action="{{ route('admin.ajuan-info-lowongan.update', $loker->id_lowongan_pekerjaan) }}"
                        method="post">
                        @csrf
                        @method('put')
                        <input type="hidden" name="status" value="Dipublikasi">
                        @if ($loker->status == 'Tertunda')
                            <button type="submit" class="btn btn-success m-1"
                                {{ $loker->status == 'Dipublikasi' || $loker->tanggal_akhir < now() ? 'disabled' : '' }}>
                                <i class="bi bi-check-circle me-1"></i>Publikasi
                            </button>
                        @endif
                        @if ($loker->status != 'Tidak Dipublikasi')
                            <button type="button" data-bs-toggle="modal"
                                data-bs-target="#modal-input-pesan-{{ $loker->id_lowongan_pekerjaan }}"
                                class="btn btn-danger m-1"
                                {{ $loker->status == 'Tidak Dipublikasi' ? 'disabled' : '' }}>
                                <i class="bi bi-check-circle me-1"></i>Tidak Dipublikasi
                            </button>
                        @endif
                    </form>

                    <div class="modal fade" id="modal-input-pesan-{{ $loker->id_lowongan_pekerjaan }}"
                        data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="modalInputPesanTitle"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable"
                            role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="m-1">Masukan Pesan Untuk Perusahaan</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form action="{{ route('admin.ajuan-info-lowongan.update', $loker->id_lowongan_pekerjaan) }}"
                                    method="POST" data-parsley-validate>
                                    @csrf @method('PUT')
                                    <div class="modal-body">
                                        <input type="hidden" name="status" value="Tidak Dipublikasi">
                                        <textarea class="form-control" id="pesan" rows="10" data-parsley-required="true" name="pesan" required></textarea>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary ms-1">
                                            <i
                                                class="bi bi-check-circle d-block d-sm-none d-flex align-items-center"></i>
                                            <span class="d-none d-sm-block">Kirim</span>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
