@extends('backend.layouts.app')

@section('backend-content')
    @include('backend.layouts.navbar')

    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">{{ __('backend/downloads.title') }}</h1>
            <a href="{{ route('downloads-add-backend') }}"
               class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-download fa-sm text-white-50"></i> {{ __('backend/downloads.create') }}
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
                            <th scope="col">{{ __('backend/downloads.table.name') }}</th>
                            <th scope="col">{{ __('backend/downloads.table.link') }}</th>
                            <th scope="col">{{ __('backend/downloads.table.file-size') }}</th>
                            <th scope="col">{{ __('backend/downloads.table.action') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($downloads as $download)
                            <tr>
                                <td>{{ $download->name }}</td>
                                <td>{{ $download->link }}
                                    <a href="{{ $download->link }}" target="_blank">
                                        <i class="fas fa-external-link-alt"></i>
                                    </a></td>
                                <td>{{ $download->file_size }}</td>
                                <td>
                                    <div class="row">
                                        <div class="col-4">
                                            <a href="{{ route('downloads-edit-backend', ['download' => $download->id]) }}"
                                               class="btn btn-primary btn-circle btn-sm">
                                                <i class="fa fa-pen"></i>
                                            </a>
                                        </div>
                                        <div class="col">
                                            <form method="POST" data-form="deleteForm"
                                                  action="{{ route('downloads-destroy-backend', ['download' => $download->id]) }}">
                                                @csrf
                                                <span data-toggle="modal" data-target="#downloadModalDelete"
                                                      data-title="{{ __('backend/downloads.delete-title') }} {{ $download->id }}"
                                                      data-message="{{ __('backend/downloads.delete-message') }}"
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
                    {{ $downloads->links() }}
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="downloadModalDelete" role="dialog" aria-labelledby="downloadModalDeleteLabel"
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
    <script type="text/javascript">
        $(document).ready(function () {
            $('#downloadModalDelete').find('.modal-footer #confirm').on('click', function () {
                $(this).data('form').submit();
            });
            $('#downloadModalDelete').on('show.bs.modal', function (e) {
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
