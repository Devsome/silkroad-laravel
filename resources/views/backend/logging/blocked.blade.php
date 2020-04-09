@extends('backend.layouts.app')

@section('backend-content')
    @include('backend.layouts.navbar')

    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">{{ __('backend/logging.blocked.title') }}</h1>
        </div>
        <div class="row">
            <div class="container">
                <div class="table-responsive">
                    <table class="table table-striped table-hover dataTable" id="blocked">
                        <thead class="thead-dark">
                        <tr>
                            <th>{{ __('backend/logging.blocked.table.jid') }}</th>
                            <th>{{ __('backend/logging.blocked.table.charname') }}</th>
                            <th>{{ __('backend/logging.blocked.table.guide') }}</th>
                            <th>{{ __('backend/logging.blocked.table.description') }}</th>
                            <th>{{ __('backend/logging.blocked.table.blockstarttime') }}</th>
                            <th>{{ __('backend/logging.blocked.table.blockendtime') }}</th>
                            <th>{{ __('backend/logging.blocked.table.status') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('javascript')
    <script>
        $(document).ready(function() {
            $('#blocked').DataTable( {
                "processing": true,
                "serverSide": true,
                "ajax": '{{ route('users-blocked-datatables-backend') }}',
                "columns": [
                    { data: function ( row ) {
                            let url = '{{ route('sro-user-edit-backend', ['user' =>  ':user' ]) }}';
                            url = url.replace(':user', row.UserJID);
                            return `<a href='${url}' target="_blank">`+ row.UserJID + `</a>`;
                        }, orderable: true, searchable: true
                    },
                    { data: 'CharName', name: 'CharName' },
                    { data: 'Guide', name: 'Guide' },
                    { data: 'Description', name: 'Description' },
                    { data: 'BlockStartTime', name: 'BlockStartTime' },
                    { data: 'BlockEndTime', name: 'BlockEndTime' },
                    { data: 'Status', name: 'Status' },
                ],
                "order": [[ 5, "desc" ]],
                "lengthMenu": [[10, 25, 50, 100, 200, -1], [10, 25, 50, 100, 200, "{{ __('backend/datatables.show-all') }}"]],
                "language": {
                    "search": "{{ __('backend/datatables.search') }}",
                    "lengthMenu": "{{ __('backend/datatables.length') }}",
                    "zeroRecords": "{{ __('backend/datatables.zero') }}",
                    "info": "{{ __('backend/datatables.info') }}",
                    "infoEmpty": "{{ __('backend/datatables.empty') }}",
                    "infoFiltered": "{{ __('backend/datatables.info-filtered') }}",
                    "paginate": {
                        "first": "{{ __('backend/datatables.first') }}",
                        "last": "{{ __('backend/datatables.last') }}",
                        "next": "{{ __('backend/datatables.next') }}",
                        "previous": "{{ __('backend/datatables.prev') }}"
                    }
                },
                "classes": {
                    "sPageButton": "button small",
                    "sPageButtonActive": "green",
                    "sPageButtonDisabled": "helper hide"
                },
                "select": {
                    "style": "os",
                    "className": "row-selected"
                },
            } );
            $('div.dataTables_filter input').addClass('search-input form-control');
            $('select').addClass('search-input form-control');
        });
    </script>
@endpush
