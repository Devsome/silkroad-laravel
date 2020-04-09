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
                        {{ __('home.voucher.title') }}
                    </h1>

                    @if(session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session()->get('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    @if(session()->has('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session()->get('error') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('home-voucher-use') }}" class="form">
                        @method('POST')
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-6">
                                <div class="form-group">
                                    <label for="voucher">{{ __('home.voucher.form.voucher') }}</label>
                                    <input type="text" class="form-control @error('voucher') is-invalid @enderror"
                                           id="voucher"
                                           aria-describedby="voucherHelp" name="voucher"
                                           value="{{ Request::old('voucher') }}"
                                           autocomplete="off">
                                    <small id="voucherHelp" class="form-text text-muted">
                                        {{ __('home.voucher.form.voucher-help') }}
                                    </small>
                                    @if($errors->has('voucher'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('voucher') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-12">
                                <input class="btn btn-sm btn-primary" type="submit"
                                       value="{{ __('home.voucher.form.submit') }}">
                            </div>
                        </div>
                    </form>

                    <div class="table-responsive pt-4">
                        <table id="users" class="table table-striped table-hover dataTable">
                            <thead class="thead-default">
                            <tr>
                                <th scope="col">{{ __('home.voucher.table.voucher') }}</th>
                                <th scope="col">{{ __('home.voucher.table.amount') }}</th>
                                <th scope="col">{{ __('home.voucher.table.used-at') }}</th>
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
        $(document).ready(function () {
            $('#users').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": '{{ route('home-voucher-datatables') }}',
                "columns": [
                    {data: 'get_voucher.code', name: 'code', orderable: false, searchable: false},
                    {data: 'get_voucher.amount', name: 'amount', orderable: false, searchable: false},
                    {data: 'redeemed_at', name: 'redeemed_at', searchable: false},
                ],
                "order": [[2, "desc"]],
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
            });
            $('div.dataTables_filter input').addClass('search-input form-control');
            $('select').addClass('search-input form-control');
        });
    </script>
@endpush
