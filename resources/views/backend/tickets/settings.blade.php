@extends('theme::backend.layouts.app')

@section('theme::backend-content')
    @include('theme::backend.layouts.navbar')

    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">{{ __('backend/tickets.settings.title') }}</h1>
        </div>
        @if ($error = Session::get('error'))
            <div class="py-3 mt-2">
                <div class="alert alert-danger alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $error }}</strong>
                </div>
            </div>
        @endif
        @if ($message = Session::get('success'))
            <div class="py-3 mt-2">
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
            </div>
        @endif
        <div class="row">
            <!-- Categories -->
            <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
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
            </div>

            <!-- Prioritys -->
            <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
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
                                                <span class="badge badge-{{ $data->color }}">
                                                    {{ $data->name }}
                                                </span>
                                            <span class="float-right">
                                                    <a href="#" class="btn btn-sm btn-primary btn-circle ajax-modal"
                                                       data-spinner="fa-circle-notch"
                                                       data-url="{{ route('ticket-priority-update', ['id' => $data->id]) }}"
                                                       data-centered="true">
                                                        <span class="icon">
                                                            <i class="fas fa-pen"></i>
                                                        </span>
                                                    </a>
                                                    <button data-text="{{ __('backend/tickets.priority.delete-text', ['priority' => $data->name]) }}"
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
            </div>

            <!-- Status -->
            <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">
                            {{ __('backend/tickets.status.title') }}
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                @forelse($status as $data)
                                    <span class="badge badge-{{ $data->color }}">
                                            {{ $data->name }}
                                        </span>
                                @empty
                                    {{ __('backend/tickets.status.empty') }}
                                @endforelse
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

@push('theme::javascript')
    <script>
        $(document).ready(function () {
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
