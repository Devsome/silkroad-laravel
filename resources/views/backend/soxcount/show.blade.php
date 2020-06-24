@extends('backend.layouts.app')

@section('backend-content')
    @include('backend.layouts.navbar')

    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">
                {{ __('backend/soxfilter.title', ['degree' => $filter ?: 'All']) }}
            </h1>
        </div>
        <div class="container">
            <div class="row">
                <div class="ml-auto mr-3">
                    <a href="{{ route('index-backend') }}" type="button" class="btn btn-secondary">
                        {{ __('backend/soxfilter.back') }}
                    </a>
                </div>
                <div class="table-responsive pt-4">
                    <table id="soxFilter" class="table table-striped table-hover dataTable">
                        <thead class="thead-dark">
                        <tr>
                            <th scope="col">
                                {{ __('backend/soxfilter.table.name') }}
                            </th>
                            <th scope="col">
                                {{ __('backend/soxfilter.table.owner') }}
                            </th>
                            <th scope="col">
                                {{ __('backend/soxfilter.table.type') }}
                            </th>
                            <th scope="col">
                                {{ __('backend/soxfilter.table.item') }}
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($data as $key => $item)
                            <tr>
                                <td>
                                    {{ $item['ItemName'] }}
                                </td>
                                <td>
                                    @isset($item['CharName'])
                                        {{ $item['CharName'] }}
                                        <a href="{{ route('sro-players-edit-backend', ['char' => $item['CharID']]) }}" target="_blank">
                                            <i class="fas fa-external-link-alt"></i>
                                        </a>
                                    @endisset
                                    @isset($item['StorageState'])
                                        <span class="text-secondary">
                                            {{ __('backend/soxfilter.table.storage') }}
                                        </span>
                                    @endisset
                                    @if($dataWeb->contains($item['ItemID']))
                                        <span class="text-secondary">
                                            {{ __('backend/soxfilter.table.web') }}
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    {{ $item['WebInventory']['sox'] }}
                                </td>
                                <td>
                                    <div id="selectInventory-{{ $item['ItemID'] }}"
                                         data-serial64="{{ $item['Serial64'] }}"
                                         data-optlevel="{{ $item['OptLevel'] }}">
                                        <div class="itemslot">
                                            <div class="image"
                                                 @isset($item['imgpath'])
                                                 style="background:url('{{ $item['imgpath'] }}') no-repeat; background-size: 34px 34px;"
                                                 data-iteminfo="1" @endisset>
                                                <i class="fa fa-check" style="color: red; position: absolute"
                                                   hidden></i>
                                                <span class="qinfo">
                                            @isset($item['amount'])
                                                        {{ $item['amount'] }}
                                                    @endisset
                                        </span>
                                                @isset($item['special'])
                                                    @if($item['special'])
                                                        <span class="plus"></span>
                                                    @endif
                                                @endisset
                                            </div>
                                        </div>
                                        <div class="itemInfo">
                                            @isset($item['data'])
                                                {!! $item['data'] !!}
                                            @endisset
                                        </div>
                                    </div>

                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">
                                    {{ __('backend/soxfilter.table.empty', ['degree' => $filter]) }}
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('javascript')
    <script type="text/javascript">
        $(document).ready(function () {
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

            $('#soxFilter').DataTable({
                columnDefs: [
                    {
                        "targets": 3,
                        "orderable": false,
                        "searchable": false,
                    }
                ],
                "aaSorting": [],
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
        });
    </script>
@endpush
