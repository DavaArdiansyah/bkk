<div class="modal fade" id="modal-avatar-edit-{{ $id }}" data-bs-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="modalEditTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="m-1">{{ $title }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            @if ($action)
                <form action="{{ $action }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <input type="hidden" name="for" value="{{ $for }}">
                        <input type="file" class="filepond" name="file">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary ms-1" data-bs-dismiss="modal">
                            <i class="bi bi-check-circle d-block d-sm-none d-flex align-items-center"></i>
                            <span class="d-none d-sm-block">Perbaharui</span>
                        </button>
                    </div>
                </form>
            @else
                <div class="modal-body">
                    <input type="file" class="filepond" name="file">
                </div>
            @endif
        </div>
    </div>
</div>
