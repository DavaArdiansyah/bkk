<div class="modal fade" id="modal-pesan-{{ $id }}"
    data-bs-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="modalInputPesanTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="m-1">{{$title}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <textarea class="form-control" id="pesan" rows="10" data-parsley-required="true" name="pesan" readonly>{{ $pesan }}
                </textarea>
            </div>
        </div>
    </div>
</div>
