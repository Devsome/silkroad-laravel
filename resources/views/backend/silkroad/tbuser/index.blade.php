@extends('backend.layouts.app')

@section('backend-content')
    @include('backend.layouts.navbar')

    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">{{ __('backend/tbuser.title') }}</h1>
        </div>
        <div class="row">
            <div class="container">
                <div class="table-responsive">
                    <table id="users" class="table table-striped table-hover dataTable">
                        <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">{{ __('backend/tbuser.struserid') }}</th>
                            <th scope="col">{{ __('backend/tbuser.email') }}</th>
                            <th scope="col">{{ __('backend/tbuser.gmrank') }}</th>
                            <th scope="col">{{ __('backend/tbuser.regtime') }}</th>
                            <th scope="col">{{ __('backend/tbuser.table.action') }}</th>
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
            $('#users').DataTable( {
                "processing": true,
                "serverSide": true,
                "ajax": '{{ route('sro-user-datatables-backend') }}',
                "columns": [
                    { data: 'JID', name: 'JID' },
                    { data: 'StrUserID', name: 'StrUserID' },
                    { data: 'Email', name: 'Email' },
                    { data: function ( row ) {
                            if(row.sec_primary === '1' && row.sec_content === '1') {
                                return '<span class="badge badge-danger">{{ __('backend/tbuser.table.gm') }}</span>';
                            } else {
                                return '<span class="badge badge-secondary">{{ __('backend/tbuser.table.gm-no') }}</span>';
                            }
                        }, orderable: false, searchable: false
                    },
                    { data: 'regtime', name: 'regtime', searchable: false },
                    { data: function ( row ) {
                            let url = '{{ route('sro-user-edit-backend', ['user' =>  ':user' ]) }}';
                            url = url.replace(':user', row.JID);
                            return `<a href='${url}' class="btn btn-primary btn-circle btn-sm"><i class="fa fa-pen"></i></a>`;
                        }, orderable: false, searchable: false
                    }
                ],
                "order": [[ 0, "desc" ]],
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
