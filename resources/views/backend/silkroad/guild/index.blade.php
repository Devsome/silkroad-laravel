@extends('theme::backend.layouts.app')

@section('theme::backend-content')
    @include('theme::backend.layouts.navbar')

    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">{{ __('backend/guild.title') }}</h1>
        </div>
        <div class="row">
            <div class="container">
                <div class="table-responsive">
                    <table id="guilds" class="table table-striped table-hover dataTable">
                        <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">{{ __('backend/guild.name') }}</th>
                            <th scope="col">{{ __('backend/guild.level') }}</th>
                            <th scope="col">{{ __('backend/guild.created') }}</th>
                            <th scope="col">{{ __('backend/guild.sp') }}</th>
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
            $('#guilds').DataTable( {
                "processing": true,
                "serverSide": true,
                "ajax": '{{ route('sro-guild-datatables-backend') }}',
                "columns": [
                    { data: 'ID', name: 'ID' },
                    { data: function ( row ) {
                            let url = '{{ route('sro-guild-edit-backend', ['guild' =>  ':guild' ]) }}';
                            url = url.replace(':guild', row.ID);
                            return `<a href='${url}'>${row.Name}</a>`;
                        }, orderable: true, searchable: true
                    },
                    { data: 'Lvl', name: 'Lvl', searchable: false },
                    { data: 'FoundationDate', name: 'FoundationDate', searchable: false },
                    { data: function ( row ) {
                        return row.GatheredSP.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                        }, orderable: true, searchable: false, name: 'GatheredSP'
                    },
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
