<form method="post" action="#" id="generalReleaseForm">
    @csrf
    <div class="modal-header">
        <h5 class="modal-title" id="user-create">
            @if($category)
                {{ __('backend/tickets.update-modal.update-title') }}
            @else
                {{ __('backend/tickets.update-modal.new-title') }}
            @endif
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="form-group">
            <label for="inp-name">
                {{ __('backend/tickets.update-modal.category') }}
            </label>
            <input type="text"
              name="name"
              id="inp-name"
              value="{{ $category ? $category->name : ''}}"
              class="form-control @error('name') is-invalid @enderror">
            @if($errors->has('name'))
                <div class="invalid-feedback">
                    {{ $errors->first('name') }}
                </div>
            @endif
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">
            <i class="fas fa-reply"></i> {{ __('backend/tickets.update-modal.cancel') }}
        </button>
        <button type="submit" class="btn btn-primary" id="saveBtn">
            <i class="fas fa-save"></i> {{ __('backend/tickets.update-modal.save') }}
        </button>
    </div>
</form>

<script>
    $(document).ready(function () {
        $('#generalReleaseForm').submit(function (e) {
            e.preventDefault();
            $('#saveBtn').html('<span class="icon"><i class="fas fa-circle-notch fa-spin"></i></span>');
            $.post( '@if($category){{ route('ticket-category-update', ['id' => $category->id]) }}@else{{ route('ticket-category-create') }}@endif',
                $('#generalReleaseForm').serialize())
                .done(function (data) {
                    if (data === 'saved') {
                        location.reload();
                    } else {
                        $('#ajaxModal .modal-content').html(data);
                    }
                })
                .fail(function (err) {
                    console.log(err);
                });
        });
    });
</script>
