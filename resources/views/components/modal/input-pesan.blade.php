<div class="modal fade" id="modal-input-pesan-{{ $id }}" tabindex="-1" aria-labelledby="modalInputPesanTitle{{ $id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalInputPesanTitle{{ $id }}">{{ $title }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ $action }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    @if ($for == 'lowongan')
                        <input type="hidden" name="status" value="Tidak Dipublikasi">
                    @elseif ($for == 'Lolos Ketahap Selanjutnya')
                        <input type="hidden" name="status" value="Lolos Ketahap Selanjutnya">
                    @elseif ($for == 'Diterima')
                        <input type="hidden" name="status" value="Diterima">
                    @elseif ($for == 'Ditolak')
                        <input type="hidden" name="status" value="Ditolak">
                    @endif
                    <textarea class="form-control" id="pesan" rows="5" name="pesan" required placeholder="Masukkan pesan..."></textarea>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Kirim</button>
                </div>
            </form>
        </div>
    </div>
</div>
