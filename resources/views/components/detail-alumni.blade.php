<div class="modal fade" id="modalDataAlumni{{ $data->nik }}"  data-bs-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="modal-detail-alumni" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header p-4">
                <h5 class="modal-title" id="modal-detail-alumni">Detail Data Alumni</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-body px-4 py-4-5">
                        <div class="text-center">
                            <div class="avatar avatar-2xl">
                                <img src="{{ isset($data->nama_file_foto) ? asset('storage/tmp/images/' . $data->nama_file_foto) : ($data->jenis_kelamin == 'Laki Laki' ? asset('assets/static/images/faces/2.jpg') : asset('assets/static/images/faces/1.jpg')) }}" alt="Avatar" />
                            </div>
                        </div>
                    </div>
                </div>

                <!-- detail data alumni  -->
                <div class="accordion accordion-flush" id="accordionDataAlumni">
                    <!-- accordion data personal  -->
                    <div class="accordion-item">
                        <div class="accordion-header" id="headerInformasiDiri">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#kolomInformasiDiri" aria-expanded="false" aria-controls="collapseTwo"
                                class="row">
                                <div class="col-2">
                                    <i class="bi bi-person-fill fs-2"></i>
                                </div>
                                <div class="col-9 d-flex align-items-center font-extrabold">
                                    Informasi Diri
                                </div>
                            </button>
                        </div>
                        <div id="kolomInformasiDiri" class="accordion-collapse collapse"
                            aria-labelledby="headerInformasiDiri" data-bs-parent="#accordionDataAlumni">
                            <div class="accordion-body">
                                <div class="card">
                                    <div class="row">
                                        <div class="col-2"></div>
                                        <div class="col-9">
                                            <h6 class="font-extrabold mt-3"></h6>
                                            <h6 class="text-muted font-semibold mt-1">{{ $data->nama }}</h6>
                                            <h6 class="text-muted font-semibold mt-1">{{ $data->jurusan }} - {{ $data->tahun_lulus }}</h6>
                                            <h6 class="text-muted font-semibold mt-1">{{ $data->kontak }}</h6>
                                            <h6 class="text-muted font-semibold mt-1">{{ isset($data->alamat) ? $data->alamat : '' }}</h6>
                                        </div>
                                        <div class="col-1"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end accordion data personal  -->

                    <!-- accordion riwayat pendidikan formal -->
                    <div class="accordion-item">
                        <div class="accordion-header" id="headerRiwayatPendidikanFormal">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#kolomRiwayatPendidikanFormal" aria-expanded="false" aria-controls="collapseTwo" class="row">
                                <div class="col-2">
                                    <i class="bi bi-mortarboard-fill fs-2"></i>
                                </div>
                                <div class="col-9 d-flex align-items-center font-extrabold">
                                    Riwayat Pendidikan Formal
                                </div>
                            </button>
                        </div>
                        <div id="kolomRiwayatPendidikanFormal" class="accordion-collapse collapse" aria-labelledby="headerRiwayatPendidikanFormal" data-bs-parent="#accordionDataAlumni">
                            <div class="accordion-body">
                                <div class="card">
                                    @if ($pendidikanFormal->isNotEmpty())
                                    @foreach ($pendidikanFormal as $pdf)
                                        <h6 class="font-extrabold mt-3 d-flex justify-content-center">{{$pdf->nama_sekolah}} {{isset($pdf->bidang_studi) ? ' - '. $pdf->bidang_studi : ''}}</h6>
                                        <h6 class="font-extrabold mt-3 d-flex justify-content-center">{{ $pdf->tahun_awal . '-' . $pdf->tahun_akhir }}</h6>
                                    @endforeach
                                @else
                                    <h6 class="font-extrabold mt-3 d-flex justify-content-center">Alumni Belum Menambahkan Data</h6>
                                @endif
                            </div>
                            </div>
                        </div>
                    </div>
                    <!-- end accordion riwayat pendidikan formal -->

                    <!-- accordion riwayat pendidikan non formal -->
                    <div class="accordion-item">
                        <div class="accordion-header" id="headerRiwayatPendidikanNonFormal">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#kolomRiwayatPendidikanNonFormal" aria-expanded="false" aria-controls="collapseTwo" class="row">
                                <div class="col-2">
                                    <i class="bi bi-book fs-2"></i>
                                </div>
                                <div class="col-9 d-flex align-items-center font-extrabold">
                                    Riwayat Pendidikan Non Formal
                                </div>
                            </button>
                        </div>
                        <div id="kolomRiwayatPendidikanNonFormal" class="accordion-collapse collapse" aria-labelledby="headerRiwayatPendidikanNonFormal" data-bs-parent="#accordionDataAlumni">
                            <div class="accordion-body">
                                <div class="card">
                                    @if ($pendidikanNonFormal->isNotEmpty())
                                    @foreach ($pendidikanNonFormal as $pdnf)
                                    <h6 class="font-extrabold mt-3 d-flex justify-content-center">{{$pdnf->nama_lembaga . ' - ' . $pdnf->nama_kursus}}</h6>
                                    <h6 class="font-extrabold mt-3 d-flex justify-content-center">{{$pdnf->tanggal }}</h6>
                                @endforeach
                                @else
                                    <h6 class="font-extrabold mt-3 d-flex justify-content-center">Alumni Belum Menambahkan Data</h6>
                                @endif
                            </div>
                            </div>
                        </div>
                    </div>
                    <!-- end accordion riwayat pendidikan non formal -->

                    <!-- accordion pengalaman kerja  -->
                    <div class="accordion-item">
                        <div class="accordion-header" id="headerPengalamanKerja">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#kolomPengalamanKerja" aria-expanded="false" aria-controls="collapseTwo"
                                class="row">
                                <div class="col-2">
                                    <i class="bi bi-briefcase-fill fs-2"></i>
                                </div>
                                <div class="col-9 d-flex align-items-center font-extrabold">
                                    Pengalaman Kerja
                                </div>
                            </button>
                        </div>
                        <div id="kolomPengalamanKerja" class="accordion-collapse collapse"
                            aria-labelledby="headerPengalamanKerja" data-bs-parent="#accordionDataAlumni">
                            <div class="accordion-body">
                                <div class="card">
                                    @if ($kerja->isNotEmpty())
                                        @foreach ($kerja as $kj)
                                            <h6 class="font-extrabold mt-3 d-flex justify-content-center">
                                                {{ $kj->nama_perusahaan . '-' . $kj->jabatan }}</h6>
                                            <h6 class="font-extrabold mt-3 d-flex justify-content-center">
                                                {{ $kj->tahun_awal . '-' . $kj->tahun_akhir }}</h6>
                                        @endforeach
                                    @else
                                        <h6 class="font-extrabold mt-3 d-flex justify-content-center">Alumni Belum
                                            Menambahkan Data</h6>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end accordion pengalaman kerja  -->

                    <!-- accordion keahlian  -->
                    <div class="accordion-item">
                        <div class="accordion-header" id="headerKeahlian">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#kolomKeahlian" aria-expanded="false" aria-controls="collapseTwo"
                                class="row">
                                <div class="col-2">
                                    <i class="bi bi-star-fill fs-2"></i>
                                </div>
                                <div class="col-9 d-flex align-items-center font-extrabold">
                                    Keahlian
                                </div>
                            </button>
                        </div>
                        <div id="kolomKeahlian" class="accordion-collapse collapse" aria-labelledby="headerKeahlian"
                            data-bs-parent="#accordionDataAlumni">
                            <div class="accordion-body">
                                <div class="card">
                                    @if (isset($lamaran->dataAlumni->keahlian))
                                        <h6 class="font-extrabold mt-3 d-flex justify-content-center">
                                            {{ $lamaran->dataAlumni->keahlian }}</h6>
                                    @else
                                        <h6 class="font-extrabold mt-3 d-flex justify-content-center">Alumni Belum
                                            Menambahkan Data</h6>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end accordion keahlian  -->

                    <!-- accordion file tambahan  -->
                    @if (isset($fileTambahan))
                    <div class="accordion-item">
                        <div class="accordion-header" id="headerFileTambahan">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#kolomFileTambahan" aria-expanded="false" aria-controls="collapseTwo"
                                class="row">
                                <div class="col-2">
                                    <i class="bi bi-file-person fs-2"></i>
                                </div>
                                <div class="col-9 d-flex align-items-center font-extrabold">
                                    File Tambahan
                                </div>
                            </button>
                        </div>
                        <div id="kolomFileTambahan" class="accordion-collapse collapse"
                            aria-labelledby="headerFileTambahan" data-bs-parent="#accordionDataAlumni">
                            <div class="accordion-body">
                                <div class="card">
                                    @if (!$fileLamaran->isEmpty())
                                    @foreach ($fileLamaran as $flm)
                                    <a href="{{asset('storage/tmp/files/' . $flm->nama_file)}}" class="mb-3">{{$lamaran->dataAlumni->nama}}.pdf</a>
                                    @endforeach
                                    {{-- <iframe src="{{asset('storage/tmp/files/' . $lamaran->file)}}" width="413" height="200" frameborder="0"></iframe> --}}
                                    @else
                                        <h6 class="font-extrabold mt-3 d-flex justify-content-center">Alumni Tidak
                                            Menambahkan File Tambahan</h6>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    <!-- end accordion file tambahan  -->
                </div>
                <!-- end detail data alumni  -->
            </div>
        </div>
    </div>
</div>
