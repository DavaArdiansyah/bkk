<div class="modal fade" id="modal-pesan-{{ $id }}" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="modalInputPesanTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content border-0 shadow-sm rounded-3">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title text-center w-100 fw-semibold">{{ $title }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-3">
                <textarea class="form-control border-0 fs-6 p-3" id="pesan" rows="8" name="pesan" readonly>{{ $pesan }}</textarea>
            </div>
        </div>
    </div>
</div>
