<div class="modal fade" id="modal-input-pesan-{{ $id }}" tabindex="-1" aria-labelledby="modalInputPesanTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Masukan Pesan Untuk Perusahaan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.ajuan-info-lowongan.update', $id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <input type="hidden" name="status" value="Tidak Dipublikasi">
                    <textarea class="form-control" id="pesan" rows="5" name="pesan" required></textarea>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Kirim</button>
                </div>
            </form>
        </div>
    </div>
</div>
