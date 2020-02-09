@extends('backend.layouts.app')

@section('backend-content')
    @include('backend.layouts.navbar')

    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">{{ __('backend/tickets.title') }}</h1>
        </div>

        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-9 col-xl-9">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">
                            Body
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="tickets" class="table table-striped table-hover dataTable">
                                <thead class="thead-dark">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">{{ __('backend/tickets.table.from') }}</th>
                                    <th scope="col">{{ __('backend/tickets.table.priority') }}</th>
                                    <th scope="col">{{ __('backend/tickets.table.category') }}</th>
                                    <th scope="col">{{ __('backend/tickets.table.title') }}</th>
                                    <th scope="col">{{ __('backend/tickets.table.status') }}</th>
                                    <th scope="col">{{ __('backend/tickets.table.created_at') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-12 col-md-12 col-lg-3 col-xl-3">
                <!-- Categories -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">
                            {{ __('backend/tickets.categories') }}
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <ul class="list-group list-group-flush">
                                    @forelse($categories as $data)
                                        <li class="list-group-item">
                                            {{ $data->name }}
                                            <span class="float-right">
                                                <a href="#" class="btn btn-sm btn-primary btn-circle ajax-modal"
                                                   data-spinner="fa-circle-notch"
                                                   data-url="{{ route('ticket-category-update', ['id' => $data->id]) }}"
                                                   data-centered="true">
                                                    <span class="icon">
                                                        <i class="fas fa-pen"></i>
                                                    </span>
                                                </a>
                                                <button data-text="{{ __('backend/tickets.category.delete-text', ['category' => $data->name]) }}"
                                                        class="btn btn-danger btn-circle btn-sm delete-btn">
                                                    <span class="icon">
                                                        <i class="fas fa-trash"></i>
                                                    </span>
                                                    <form method="post"
                                                          action="{{ route('ticket-category-delete', ['id' => $data->id]) }}">
                                                        @csrf
                                                    </form>
                                                </button>
                                            </span>
                                        </li>
                                    @empty
                                        <li class="list-group-item">
                                            {{ __('backend/tickets.category.empty') }}
                                        </li>
                                    @endforelse
                                </ul>
                                <span class="float-right py-3">
                                    <a href="#"
                                       class="btn btn-sm btn-primary pull-left ajax-modal"
                                       data-spinner="fa-circle-notch"
                                       data-url="{{ route('ticket-category-create') }}"
                                       data-centered="true">
                                        {{ __('backend/tickets.category.add_button') }}
                                    </a>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Prioritys -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">
                            {{ __('backend/tickets.priorities') }}
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <ul class="list-group list-group-flush">
                                    @forelse($prioritys as $data)
                                        <li class="list-group-item">
                                            {{ $data->name }}
                                            <span class="float-right">
                                                <a href="#" class="btn btn-sm btn-primary btn-circle ajax-modal"
                                                   data-spinner="fa-circle-notch"
                                                   data-url="{{ route('ticket-priority-update', ['id' => $data->id]) }}"
                                                   data-centered="true">
                                                    <span class="icon">
                                                        <i class="fas fa-pen"></i>
                                                    </span>
                                                </a>
                                                <button data-text="{{ __('backend/tickets.priority.delete-text', ['category' => $data->name]) }}"
                                                        class="btn btn-danger btn-circle btn-sm delete-btn">
                                                    <span class="icon">
                                                        <i class="fas fa-trash"></i>
                                                    </span>
                                                    <form method="post"
                                                          action="{{ route('ticket-priority-delete', ['id' => $data->id]) }}">
                                                        @csrf
                                                    </form>
                                                </button>
                                            </span>
                                        </li>
                                    @empty
                                        {{ __('backend/tickets.priority.empty') }}
                                    @endforelse
                                </ul>
                                <span class="float-right py-3">
                                    <a href="#"
                                       class="btn btn-sm btn-primary pull-left ajax-modal"
                                       data-spinner="fa-circle-notch"
                                       data-url="{{ route('ticket-priority-create') }}"
                                       data-centered="true">
                                        {{ __('backend/tickets.priority.add_button') }}
                                    </a>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Status -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">
                            {{ __('backend/tickets.status.title') }}
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <ul class="list-group list-group-flush">
                                    @forelse($status as $data)
                                        <li class="list-group-item">
                                            <span class="badge badge-{{ $data->color }}">
                                                {{ $data->name }}
                                            </span>
                                            <span class="float-right">
                                                <a href="#" class="btn btn-sm btn-primary btn-circle ajax-modal"
                                                   data-spinner="fa-circle-notch"
                                                   data-url="{{ route('ticket-status-update', ['id' => $data->id]) }}"
                                                   data-centered="true">
                                                    <span class="icon">
                                                        <i class="fas fa-pen"></i>
                                                    </span>
                                                </a>
                                                <button data-text="{{ __('backend/tickets.status.delete-text', ['status' => $data->name]) }}"
                                                        class="btn btn-danger btn-circle btn-sm delete-btn">
                                                    <span class="icon">
                                                        <i class="fas fa-trash"></i>
                                                    </span>
                                                    <form method="post"
                                                          action="{{ route('ticket-status-delete', ['id' => $data->id]) }}">
                                                        @csrf
                                                    </form>
                                                </button>
                                            </span>
                                        </li>
                                    @empty
                                        <li class="list-group-item">
                                            {{ __('backend/tickets.status.empty') }}
                                        </li>
                                    @endforelse
                                </ul>
                                <span class="float-right py-3">
                                <a href="#"
                                   class="btn btn-sm btn-primary pull-left ajax-modal"
                                   data-spinner="fa-circle-notch"
                                   data-url="{{ route('ticket-status-create') }}"
                                   data-centered="true">
                                    {{ __('backend/tickets.status.add_button') }}
                                </a>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>


    <div class="modal fade" id="ajaxModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"
                        id="exampleModalCenterTitle">{{ __('backend/tickets.modal-delete-title') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="fas fa-reply"></i> {{ __('backend/tickets.update-modal.cancel') }}
                    </button>
                    <button type="button" class="btn btn-danger deleteBtn">
                        <i class="fas fa-trash"></i> {{ __('backend/tickets.update-modal.delete') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('javascript')
    <script>
        $(document).ready(function () {
            $(document).ready(function() {
                $('#tickets').DataTable( {
                    "processing": true,
                    "serverSide": true,
                    "ajax": '{{ route('ticket-index-datatables-backend') }}',
                    "columns": [
                        { data: 'id', name: 'id' },
                        { data: 'user_id', name: 'user_id' },
                        { data: 'ticket_prioritys_id', name: 'ticket_prioritys_id' },
                        { data: 'ticket_categories_id', name: 'ticket_categories_id' },
                        { data: 'title', name: 'title' },
                        { data: 'ticket_status_id', name: 'ticket_status_id' },
                        { data: 'created_at', name: 'created_at' },
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

            $('.ajax-modal').click(function () {
                let $btn = $(this);
                let $ajaxModal = $('#ajaxModal');

                let centered = $btn.data('centered');
                let spinner = $btn.data('spinner');
                let size = '';

                if ($btn.data('size') != '') {
                    size = $btn.data('size');
                }

                $ajaxModal.find('.modal-dialog')
                    .removeClass('modal-sm')
                    .removeClass('modal-lg')
                    .removeClass('modal-xl')
                    .removeClass(!centered ? 'modal-dialog-centered' : '')
                    .addClass(size ? 'modal-' + size : '')
                    .addClass(centered ? 'modal-dialog-centered' : '');

                let oldIcon = $btn.find('.icon i').attr('class');
                if (spinner != '') {
                    $btn.find('.icon i').attr('class', 'fas fa-spin ' + spinner);
                }

                $.get($btn.data('url'))
                    .done(function (data, e) {
                        $ajaxModal.find('.modal-content').html(data);
                        $ajaxModal.modal({backdrop: 'static', keyboard: false});
                    })
                    .fail(function (err) {
                        console.error(err.responseJSON);
                    })
                    .always(function () {
                        if (spinner != '') {
                            $btn.find('.icon i').attr('class', oldIcon);
                        }
                    });


            });

            $('.delete-btn').click(function () {
                let $this = $(this);
                let $deleteModal = $('#deleteModal');
                $deleteModal.find('.modal-body').text($this.data('text'));
                $deleteModal.modal('show');
                $deleteModal.find('.deleteBtn').one('click', function () {
                    $this.find('form').submit();
                });
            });
        });
    </script>
@endpush
