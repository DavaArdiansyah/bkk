   <div class="modal fade" id="modal-input-cv-{{ $id }}" data-bs-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="modalEditFotoTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="m-1">Input File Tambahan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('alumni.lamaran.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <p>JIka Anda Tidak Mengupload File Tambahan Kami Hanya Akan Mengirimkan Data Anda Yang Ada Pada
                        Bagian Profil</p>
                    <input type="hidden" name="id-lowongan-pekerjaan" value="{{ $id }}">
                    <input type="file" class="filepond" name="files[]" data-id="{{ $id }}" multiple>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary ms-1" data-bs-dismiss="modal">
                        <i class="bi bi-check-circle d-block d-sm-none d-flex align-items-center"></i>
                        <span class="d-none d-sm-block">Lamar</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
