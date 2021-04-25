<div id="updateDataModal" class="modal hide fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit data</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form id="updateDataForm" class="form-horizontal"></form>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        /*Edit data modal close*/
        $('#updateDataModal button[data-dismiss="modal"]').click(function () {
            $('#updateDataForm').html('');
        });
    </script>
@endpush
