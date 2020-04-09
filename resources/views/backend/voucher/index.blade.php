@extends('backend.layouts.app')

@section('backend-content')
    @include('backend.layouts.navbar')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">{{ __('backend/voucher.title') }}</h1>
            <a href="{{ route('voucher-add-backend') }}"
               class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-download fa-sm text-white-50"></i> {{ __('backend/voucher.title-create') }}
            </a>
        </div>
        <div class="row">
            <div class="container">
                @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ $message }}</strong>
                    </div>
                @endif
                <div class="table-responsive">
                    <table id="users" class="table table-striped table-hover dataTable">
                        <thead class="thead-dark">
                        <tr>
                            <th scope="col">{{ __('backend/voucher.table.code') }}</th>
                            <th scope="col">{{ __('backend/voucher.table.amount') }}</th>
                            <th scope="col">{{ __('backend/voucher.table.redeemed_at') }}</th>
                            <th scope="col">{{ __('backend/voucher.table.expires_at') }}</th>
                            <th scope="col">{{ __('backend/voucher.table.created_at') }}</th>
                            <th scope="col">{{ __('backend/voucher.table.action') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="voucherModalDelete" role="dialog" aria-labelledby="voucherModalDeleteLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary"
                            data-dismiss="modal">{{ __('backend/notification.modal.return') }}</button>
                    <button type="button" class="btn btn-sm btn-danger"
                            id="confirm">{{ __('backend/notification.modal.submit') }}</button>
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
                "ajax": '{{ route('voucher-index-datatables-backend') }}',
                "columns": [
                    {data: 'code', name: 'code'},
                    {data: 'amount', name: 'amount'},
                    {data: 'redeemed_at', name: 'redeemed_at'},
                    {data: 'expires_at', name: 'expires_at'},
                    {data: 'created_at', name: 'created_at', searchable: false},
                    { data: function ( row ) {
                            let url = '{{ route('voucher-destroy-backend', ['id' =>  ':id' ]) }}';
                            let msg = '{{ __('backend/voucher.modal-delete-message', ['code' => ':code']) }}';
                            msg = msg.replace(':code', row.code);
                            url = url.replace(':id', row.id);
                            return `<form method="POST" data-form="deleteForm"
                                action="${url}">@csrf
                                <span data-toggle="modal" data-target="#voucherModalDelete"
                                data-title="{{ __('backend/voucher.modal-delete-title') }}" data-message="${msg}"
                                class="btn btn-danger btn-circle btn-sm" style="cursor: pointer"><i class="fa fa-trash"></i></span></form>`;
                        }, orderable: false, searchable: false
                    }
                ],
                "order": [[4, "desc"]],
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
            });
            $('div.dataTables_filter input').addClass('search-input form-control');
            $('select').addClass('search-input form-control');

            $(document).ready(function () {
                $('#voucherModalDelete').find('.modal-footer #confirm').on('click', function () {
                    $(this).data('form').submit();
                });
                $('#voucherModalDelete').on('show.bs.modal', function (e) {
                    $(this).find('.modal-body p').text($(e.relatedTarget).attr('data-message'));
                    $(this).find('.modal-title').text($(e.relatedTarget).attr('data-title'));

                    let form = $(e.relatedTarget).closest('form');
                    $(this).find('.modal-footer #confirm').data('form', form);
                });
                $('form[data-form="deleteForm"]').on('click', '.form-delete', function (e) {
                    e.preventDefault();
                    $('#confirm').modal({backdrop: 'static', keyboard: false})
                        .on('click', '#delete-btn', function () {
                            $('form[data-form="deleteForm"]').submit();
                        });
                });
            });
        });
    </script>
@endpush
