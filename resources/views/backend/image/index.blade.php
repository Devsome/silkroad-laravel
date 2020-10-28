@extends('theme::backend.layouts.app')

@section('theme::backend-content')
    @include('theme::backend.layouts.navbar')

    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">{{ __('backend/images.title') }}</h1>
            <a href="{{ route('images-show-backend') }}"
               class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-download fa-sm text-white-50"></i> {{ __('backend/images.create') }}
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
                @if ($error = Session::get('error'))
                    <div class="alert alert-danger alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ $error }}</strong>
                    </div>
                @endif
                <div class="table-responsive">
                    <table id="users" class="table table-striped table-hover dataTable">
                        <thead class="thead-dark">
                        <tr>
                            <th scope="col">{{ __('backend/images.table.filename') }}</th>
                            <th scope="col">{{ __('backend/images.table.model') }}</th>
                            <th scope="col">{{ __('backend/images.table.original_filename') }}</th>
                            <th scope="col">{{ __('backend/images.table.created_at') }}</th>
                            <th scope="col">{{ __('backend/images.table.action') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($images as $image)
                            <tr>
                                <td>{{ $image->filename }}</td>
                                <td>{{ $image->model }}
                                <td>{{ $image->original_filename }}</td>
                                <td>{{ $image->created_at }}</td>
                                <td>
                                    <div class="row">
                                        <div class="col">
                                            <form method="POST" data-form="deleteForm"
                                                  action="{{ route('images-destroy-backend', ['image' => $image->id]) }}">
                                                <input type="hidden" name="model" value="{{ $image->model }}">
                                                @csrf
                                                <span data-toggle="modal" data-target="#imagesModalDelete"
                                                      data-title="{{ __('backend/images.delete-title') }} {{ $image->id }}"
                                                      data-message="{{ __('backend/images.delete-message') }}"
                                                      class="btn btn-danger btn-circle btn-sm" style="cursor: pointer">
                                                    <i class="fa fa-trash"></i>
                                                </span>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $images->links() }}
                </div>

            </div>
        </div>
    </div>
    <div class="modal fade" id="imagesModalDelete" role="dialog" aria-labelledby="imagesModalDeleteLabel"
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
            $('#imagesModalDelete').find('.modal-footer #confirm').on('click', function () {
                $(this).data('form').submit();
            });
            $('#imagesModalDelete').on('show.bs.modal', function (e) {
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
    </script>
@endpush
