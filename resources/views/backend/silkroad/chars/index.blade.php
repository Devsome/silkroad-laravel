@extends('theme::backend.layouts.app')

@section('theme::backend-content')
    @include('theme::backend.layouts.navbar')

    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">{{ __('backend/chars.title') }}</h1>
        </div>
        <div class="row">
            <div class="container">
                <div class="table-responsive">
                    <table id="users" class="table table-striped table-hover dataTable">
                        <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">{{ __('backend/chars.charname') }}</th>
                            <th scope="col">{{ __('backend/chars.level') }}</th>
                            <th scope="col">{{ __('backend/chars.gold') }}</th>
                            <th scope="col">{{ __('backend/chars.table.action') }}</th>
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
@push('theme::javascript')
    <script>
        $(document).ready(function() {
            $('#users').DataTable( {
                "processing": true,
                "serverSide": true,
                "ajax": '{{ route('sro-players-datatables-backend') }}',
                "columns": [
                    { data: 'CharID', name: 'CharID' },
                    { data: 'CharName16', name: 'CharName16' },
                    { data: 'CurLevel', name: 'CurLevel' },
                    { data: function ( row ) {
                        return row.RemainGold.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                        }, orderable: true, searchable: false, name: 'RemainGold'
                    },
                    { data: function ( row ) {
                            let url = '{{ route('sro-players-edit-backend', ['char' =>  ':char' ]) }}';
                            url = url.replace(':char', row.CharID);
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
