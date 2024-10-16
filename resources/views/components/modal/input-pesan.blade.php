<div class="modal fade" id="modal-input-pesan-{{ $id }}" tabindex="-1" aria-labelledby="modalInputPesanTitle{{ $id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-sm rounded-3">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title text-center w-100 fw-semibold">{{ $title }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ $action }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body p-3">
                    @if ($for == 'lowongan')
                        <input type="hidden" name="status" value="Tidak Dipublikasi">
                    @elseif ($for == 'Lolos Ketahap Selanjutnya')
                        <input type="hidden" name="status" value="Lolos Ketahap Selanjutnya">
                    @elseif ($for == 'Diterima')
                        <input type="hidden" name="status" value="Diterima">
                    @elseif ($for == 'Ditolak')
                        <input type="hidden" name="status" value="Ditolak">
                    @endif
                    <textarea class="form-control border border-secondary fs-6 p-3 @error('pesan') is-invalid @enderror" id="pesan" rows="5" name="pesan" placeholder="Masukkan pesan..."></textarea>
                    @error('pesan')
                        <span class="invalid-feedback d-block mt-2" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="modal-footer border-top-0">
                    <button type="submit" class="btn btn-primary w-100">Kirim</button>
                </div>
            </form>
        </div>
    </div>
</div>
