@extends('layouts.app')
@section('title', __('seo.referral'))
@section('sidebar')
    @include('frontend.account.sidebar')
@endsection

@section('content')
    <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
        <div class="container">
            <div class="row justify-content-center">
                <h1 class="col-md-12">
                    {{ __('home.ref.title') }}
                </h1>

                <div class="col-md-12">
                    <h3>
                        {{ __('home.ref.signature') }}
                    </h3>
                    @if($signature)
                        <code class="mb-4">
                            [URL={{ url("/register?r={$account->reflink}") }}]<br>
                            [IMG]{{ Storage::disk('images')->url($signature) }}[/IMG]<br>
                            [/URL]<br><br>
                        </code>
                        @else
                        <p class="py-2">
                            {{ __('home.ref.no-signature') }}
                        </p>
                    @endif
                </div>
                <div class="col-md-12">
                    <h2>
                        {{ __('home.ref.your-ref') }}
                    </h2>
                    <div class="table-responsive pt-4">
                        <table id="users" class="table table-striped table-hover dataTable">
                            <thead class="thead-default">
                            <tr>
                                <th scope="col">{{ __('home.ref.table.name') }}</th>
                                <th scope="col">{{ __('home.ref.table.date') }}</th>
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
                "ajax": '{{ route('home-referral-datatables') }}',
                "columns": [
                    { data: 'name', name: 'name' },
                    { data: 'created_at', name: 'created_at', searchable: false },
                ],
                "order": [[ 1, "desc" ]],
                "lengthMenu": [[25, 50, 100, 200, -1], [25, 50, 100, 200, "{{ __('datatables.show-all') }}"]],
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
                "dom": "btrip",
            } );
            $('div.dataTables_filter input').addClass('search-input form-control');
            $('select').addClass('search-input form-control');
        });
    </script>
@endpush
