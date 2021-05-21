<!-- Modal -->
<div id="AddItemModal" class="modal hide fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{__('webmall/webmall.backend.modal.add')}}</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form id="AddDataForm" class="form-horizontal"></form>
            </div>
        </div>
    </div>
</div>

@push('theme::javascript')
    <script>
        /*Edit data modal close*/
        $('#AddItemModal button[data-dismiss="modal"]').click(function () {
            $('#AddDataForm').html('');
        });
    </script>
@endpush
