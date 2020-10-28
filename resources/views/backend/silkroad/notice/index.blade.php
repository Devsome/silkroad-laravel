@extends('theme::backend.layouts.app')

@section('theme::backend-content')
    @include('theme::backend.layouts.navbar')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">{{ __('backend/notice.title') }}</h1>
            <a href="{{ route('sro-notice-create-backend') }}"
               class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-download fa-sm text-white-50"></i> {{ __('backend/notice.create') }}
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
                    <table class="table table-striped table-hover" id="news">
                        <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">{{ __('backend/notice.table.title') }}</th>
                            <th scope="col">{{ __('backend/notice.table.published_at') }}</th>
                            <th scope="col">{{ __('backend/notice.table.action') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($notices as $notice)
                            <tr>
                                <th scope="row">{{ $notice->ID }}</th>
                                <td>{{ $notice->Subject }}</td>
                                <td>{{ Carbon\Carbon::parse($notice->EditDate) }}</td>
                                <td>
                                    <div class="row">
                                        <div class="col-3">
                                            <a href="{{ route('sro-notice-edit-backend', ['id' => $notice->ID]) }}"
                                               class="btn btn-primary btn-circle btn-sm">
                                                <i class="fa fa-pen"></i>
                                            </a>
                                        </div>
                                        <div class="col-3">
                                            <form method="POST" data-form="deleteForm"
                                                  action="{{ route('sro-notice-edit-destroy', ['id' => $notice->ID]) }}">
                                                @method('DELETE')
                                                @csrf
                                                <span data-toggle="modal" data-target="#noticeModalDelete"
                                                      data-title="{{ __('backend/notice.delete-title') }} {{ $notice->ID }}"
                                                      data-message="{{ __('backend/notice.delete-message') }}"
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
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="noticeModalDelete" role="dialog" aria-labelledby="noticeModalDeleteLabel"
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
            $('#noticeModalDelete').find('.modal-footer #confirm').on('click', function () {
                $(this).data('form').submit();
            });
            $('#noticeModalDelete').on('show.bs.modal', function (e) {
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
