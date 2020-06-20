@extends('layouts.app')
@section('title', __('seo.auctionshouse.own'))
@section('sidebar')
    @include('frontend.account.auctionsidebar')
@endsection

@section('content')
    <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <h1>
                        {{ __('auctionshouse.own.title') }}
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
                            <a href="{{ route('auctions-house') }}" type="button" class="btn btn-secondary">
                                {{ __('auctionshouse.own.back') }}
                            </a>
                        </div>
                    </div>

                    <div class="table-responsive pt-4">
                        <table id="items" class="table table-striped table-hover dataTable">
                            <thead class="thead-default">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">{{ __('auctionshouse.table.name') }}</th>
                                <th scope="col">{{ __('auctionshouse.table.price') }}</th>
                                <th scope="col">{{ __('auctionshouse.table.price_instead') }}</th>
                                <th scope="col">{{ __('auctionshouse.table.until') }}</th>
                                <th scope="col">{{ __('auctionshouse.table.actions') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($items as $item)
                                <tr role="row" class="odd">
                                    <td>
                                        <div id="selectInventory">
                                            <div class="itemslot">
                                                <div class="image"
                                                     style="background:url('{{ $item->getItemInformation->imgpath }}')
                                                             no-repeat; background-size: 34px 34px;"
                                                     data-iteminfo="1">
                                                    <span class="qinfo">
                                                        @if($item->getItemInformation->amount > 0)
                                                            {{ $item->getItemInformation->amount }}
                                                        @endisset
                                                    </span>
                                                    @isset($item->getItemInformation->special)
                                                        @if($item->getItemInformation->special)
                                                            <span class="plus"></span>
                                                        @endif
                                                    @endisset
                                                </div>
                                            </div>
                                            <div class="itemInfo">
                                                @isset($item->getItemInformation->data)
                                                    {!! $item->getItemInformation->data !!}
                                                @endisset
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="{{ route('auctions-house-show-item', ['id' => $item->id]) }}">
                                            {{ $item->getItemInformation->name }}
                                        </a>
                                    </td>
                                    <td>
                                        {{ number_format($item->price, 0, ',', '.') }}
                                    </td>
                                    <td>
                                        {{ number_format($item->price_instead, 0, ',', '.') }}
                                    </td>
                                    <td>
                                        {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $item->until)->diffForHumans() }}
                                    </td>
                                    <td>
                                        <form method="POST" data-form="cancelForm"
                                        action="{{ route('auction-house-cancel-own', ['id' => $item->id]) }}">
                                            @csrf
                                            <span data-toggle="modal" data-target="#cancelModal"
                                                  data-title="{{ __('auctionshouse.own.cancel-title') }}"
                                                  data-message="{{ __('auctionshouse.own.cancel-message', [
                                                    'item' => $item->getItemInformation->name
                                                  ]) }}"
                                                  class="btn btn-danger btn-circle btn-sm" style="cursor: pointer">
                                                <i class="fa fa-trash"></i>
                                            </span>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="cancelModal" role="dialog" aria-labelledby="cancelModalLabel"
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
            $('#items').DataTable({
                columnDefs: [
                    {
                        "targets": 0,
                        "orderable": false,
                        "searchable": false,
                    },
                    {
                        "targets": 5,
                        "orderable": false,
                        "searchable": false,
                    }
                ],
                "order": [[4, "desc"]],
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
            });
            $('div.dataTables_filter input').addClass('search-input form-control');
            $('select').addClass('search-input form-control');

            $(document).tooltip({
                items: "[data-itemInfo], [title]",
                position: {my: "left+5 center", at: "right center"},
                content: function () {
                    let element = jQuery(this);
                    if (jQuery(this).prop("tagName").toUpperCase() === 'IFRAME') {
                        return;
                    }
                    if (element.is("[data-itemInfo]")) {
                        if (element.parent().parent().find('.itemInfo').html() === '') {
                            return;
                        }
                        return element.parent().parent().find('.itemInfo').html();
                    }
                    if (element.is("[title]")) {
                        return element.attr("title");
                    }
                },
                close: function (event, ui) {
                    $(".ui-helper-hidden-accessible").remove();
                }
            });

            $(document).ready(function () {
                $('#cancelModal').find('.modal-footer #confirm').on('click', function () {
                    $(this).data('form').submit();
                });
                $('#cancelModal').on('show.bs.modal', function (e) {
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
