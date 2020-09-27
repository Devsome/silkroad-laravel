@extends('backend.layouts.app')

@section('backend-content')
    @include('backend.layouts.navbar')

    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">{{ __('backend/donations.logging.title') }}</h1>
        </div>
        <div class="container">
            <div class="table-responsive">
                <table id="users" class="table table-striped table-hover dataTable">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">{{ __('backend/donations.logging.table.user_id') }}</th>
                        <th scope="col">{{ __('backend/donations.logging.table.name') }}</th>
                        <th scope="col">{{ __('backend/donations.logging.table.price') }}</th>
                        <th scope="col">{{ __('backend/donations.logging.table.silk') }}</th>
                        <th scope="col">{{ __('backend/donations.logging.table.date') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
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
                "ajax": '{{ route('donations-logging-datatables-backend') }}',
                "columns": [
                    { data: 'user_id', name: 'user_id' },
                    { data: 'name', name: 'name' },
                    { data: 'price', name: 'price' },
                    { data: 'silk', name: 'silk' },
                    { data: 'created_at', name: 'created_at', searchable: false },
                ],
                "order": [[ 4, "desc" ]],
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
