@extends('backend.layouts.app')

@section('backend-content')
    @include('backend.layouts.navbar')

    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">{{ __('backend/guild.edit.title') }}</h1>
        </div>
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">
                            {{ $guild->Name }}
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="container">
                                <div class="table-responsive">
                                    <table id="guilds-edit" class="table table-striped table-hover dataTable">
                                        <thead class="thead-dark">
                                        <tr>
                                            <th scope="col">{{ __('backend/guild.edit.charname') }}</th>
                                            <th scope="col">{{ __('backend/guild.edit.level') }}</th>
                                            <th scope="col">{{ __('backend/guild.edit.gp-donation') }}</th>
                                            <th scope="col">{{ __('backend/guild.edit.nickname') }}</th>
                                            <th scope="col">{{ __('backend/guild.edit.join-date') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('javascript')
    <script>
        $(document).ready(function() {
            $('#guilds-edit').DataTable( {
                "processing": true,
                "serverSide": true,
                "ajax": '{{ route('sro-guild-edit-datatables-backend', ['guild' => $guild->ID]) }}',
                "columns": [
                    { data: function ( row ) {
                            let url = '{{ route("sro-players-edit-backend", ['char' =>  ':char' ]) }}';
                            url = url.replace(':char', row.CharID);
                            return `<a href='${url}' target="_blank">${row.CharName}</a>`;
                        }, orderable: true, searchable: true
                    },
                    { data: 'CharLevel', name: 'CharLevel', searchable: true },
                    { data: 'GP_Donation', name: 'GP_Donation', searchable: true },
                    { data: function ( row ) {
                            if(row.Nickname) {
                                return row.Nickname;
                            } else {
                                return '';
                            }
                        }, orderable: true, searchable: false, name: 'GatheredSP'
                    },
                    { data: 'JoinDate', name: 'JoinDate', searchable: false },
                ],
                "order": [[ 1, "desc" ]],
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
