@extends('theme::backend.layouts.app')

@section('theme::backend-content')
    @include('theme::backend.layouts.navbar')

    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">{{ __('backend/donations.method.title-paypal') }}</h1>
        </div>
        <div class="container">

            @if(session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session()->get('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            @if($method->active === 0)
                <div class="alert alert-danger" role="alert">
                    <p>{{ __('backend/donations.method.disabled') }}</p>
                </div>
            @endif

            <div class="row">
                <div class="col-12">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0">
                                {{ __('backend/donations.method.panel-title') }}
                            </h6>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('method-paypal-add-backend') }}">
                                @csrf
                                <div class="form-row">
                                    <div class="form-group col-lg-3 col-md-4 col-sm-4">
                                        <label for="name" class="col-form-label">
                                            {{ __('backend/donations.method.name') }}
                                        </label>
                                        <input type="text"
                                               class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}"
                                               id="name" name="name"
                                               value="{{ $data['name'] ?? Request::old('name') }}">
                                        <small id="name" class="form-text text-muted">
                                            {{ __('backend/donations.method.name-help') }}
                                        </small>
                                        @if ($errors->has('name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form-group col-lg-3 col-md-4 col-sm-4">
                                        <label for="name" class="col-form-label">
                                            {{ __('backend/donations.method.description') }}
                                        </label>
                                        <input type="text"
                                               class="form-control {{ $errors->has('description') ? ' is-invalid' : '' }}"
                                               id="description" name="description"
                                               value="{{ $data['description'] ?? Request::old('description') }}">
                                        @if ($errors->has('description'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('description') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form-group col-lg-3 col-md-4 col-sm-4">
                                        <label for="number" class="col-form-label">
                                            {{ __('backend/donations.method.price') }}
                                        </label>
                                        <input type="text"
                                               class="form-control {{ $errors->has('price') ? ' is-invalid' : '' }}"
                                               id="price" name="price"
                                               value="{{ $data['price'] ?? Request::old('price') }}">
                                        <small id="name" class="form-text text-muted">
                                            {{ __('backend/donations.method.price-help') }}
                                        </small>
                                        @if ($errors->has('price'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('price') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form-group col-lg-3 col-md-4 col-sm-4">
                                        <label for="number" class="col-form-label">
                                            {{ __('backend/donations.method.silk') }}
                                        </label>
                                        <input type="text"
                                               class="form-control {{ $errors->has('silk') ? ' is-invalid' : '' }}"
                                               id="silk" name="silk"
                                               value="{{ $data['silk'] ?? Request::old('silk') }}">
                                        <small id="name" class="form-text text-muted">
                                            {{ __('backend/donations.method.silk-help') }}
                                        </small>
                                        @if ($errors->has('silk'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('silk') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-12 pb-5">
                                    <hr class="mt-2 mb-3">
                                    <div class="d-flex flex-wrap float-left">
                                        <button class="btn btn-style-1 btn-primary float-left" type="submit">
                                            {{ __('backend/donations.method.add') }}
                                        </button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-12 pb-3">
                    <div class="table-responsive">
                        <table id="users" class="table table-striped table-hover dataTable">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col">{{ __('backend/donations.method.name') }}</th>
                                <th scope="col">{{ __('backend/donations.method.description') }}</th>
                                <th scope="col">{{ __('backend/donations.method.price') }}</th>
                                <th scope="col">{{ __('backend/donations.method.silk') }}</th>
                                <th scope="col">{{ __('backend/donations.method.action') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($paypal as $data)
                                <tr>
                                    <td>
                                        {{ $data->name }}
                                    </td>
                                    <td>
                                        {{ $data->description }}
                                    </td>
                                    <td>
                                        {{ $data->price }}
                                    </td>
                                    <td>
                                        {{ $data->silk }}
                                    </td>
                                    <td>
                                        <form method="POST" data-form="deleteForm"
                                              action="{{ route('method-paypal-destroy-backend', ['id' => $data->id]) }}">
                                            @csrf
                                            <span data-toggle="modal" data-target="#methodModalDelete"
                                                  data-title="{{ __('backend/donations.method.modal.title') }}"
                                                  data-message="{{ __('backend/donations.method.modal.message', ['name' => $data->name]) }}"
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
                    <hr class="mt-3 mb-3"/>
                </div>
                <div class="col-12 pb-3">
                    <div class="table-responsive">
                        <table id="paypalLogging" class="table table-striped table-hover dataTable">
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
        </div>
    </div>
    <div class="modal fade" id="methodModalDelete" role="dialog" aria-labelledby="methodModalDeleteLabel"
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

@push('theme::javascript')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#methodModalDelete').find('.modal-footer #confirm').on('click', function () {
                $(this).data('form').submit();
            });
            $('#methodModalDelete').on('show.bs.modal', function (e) {
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

            $('#paypalLogging').DataTable( {
                "processing": true,
                "serverSide": true,
                "ajax": '{{ route('donations-logging-paypal-datatables-backend') }}',
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
