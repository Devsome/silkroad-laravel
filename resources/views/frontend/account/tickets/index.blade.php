@extends('layouts.app')

@section('sidebar')
    @include('frontend.account.sidebar')
@endsection

@section('content')
    <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <h1>
                        {{ __('home.tickets.title') }}
                    </h1>

                    @if(session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session()->get('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <div class="row">
                        <div class="ml-auto mr-3">
                            <a href="{{ route('home-tickets-new') }}" type="button" class="btn btn-secondary">
                                {{ __('home.tickets.create-new') }}
                            </a>
                        </div>
                    </div>

                    <div class="table-responsive pt-4">
                        <table id="users" class="table table-striped table-hover dataTable">
                            <thead class="thead-default">
                            <tr>
                                <th scope="col">{{ __('home.tickets.table.title') }}</th>
                                <th scope="col">{{ __('home.tickets.table.state') }}</th>
                                <th scope="col">{{ __('home.tickets.table.priority') }}</th>
                                <th scope="col">{{ __('home.tickets.table.updated-at') }}</th>
                                <th scope="col">{{ __('home.tickets.table.action') }}</th>
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
@endsection
@push('javascript')
    <script>
        $(document).ready(function() {
            $('#users').DataTable( {
                "processing": true,
                "serverSide": true,
                "ajax": '{{ route('home-tickets-datatables') }}',
                "columns": [
                    { data: 'title', name: 'title' },
                    { data: 'get_status_name.name', name: 'ticket_status_id', searchable: false },
                    { data: 'get_priority_name.name', name: 'ticket_prioritys_id', searchable: false },
                    { data: 'updated_at', name: 'updated_at', searchable: false },
                    { data: function ( row ) {
                            let url = '{{ route("home-tickets-show", ['id' =>  ':id' ]) }}';
                            url = url.replace(':id', row.id);
                            return `<a href='${url}' class="btn btn-primary btn-circle btn-sm"><i class="fa fa-eye"></i></a>`;
                        }, orderable: false, searchable: false
                    }
                ],
                "order": [[ 3, "desc" ]],
                "lengthMenu": [[10, 25, 50, 100, 200, -1], [10, 25, 50, 100, 200, "{{ __('datatables.show-all') }}"]],
                "language": {
                    "search": "{{ __('datatables.search') }}",
                    "lengthMenu": "{{ __('datatables.length') }}",
                    "zeroRecords": "{{ __('datatables.zero') }}",
                    "info": "{{ __('datatables.info') }}",
                    "infoEmpty": "{{ __('datatables.empty') }}",
                    "infoFiltered": "{{ __('datatables.info-filtered') }}",
                    "paginate": {
                        "first": "{{ __('datatables.first') }}",
                        "last": "{{ __('datatables.last') }}",
                        "next": "{{ __('datatables.next') }}",
                        "previous": "{{ __('datatables.prev') }}"
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
