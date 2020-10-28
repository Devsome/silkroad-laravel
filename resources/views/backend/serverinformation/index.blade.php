@extends('theme::backend.layouts.app')

@section('theme::backend-content')
    @include('theme::backend.layouts.navbar')

    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">
                {{ __('backend/serverinformation.title') }}
            </h1>
        </div>
        <div class="row">
            <div class="ml-auto mr-3">
                <a href="{{ route('server-information-show-add-backend') }}" type="button" class="btn btn-primary">
                    {{ __('backend/serverinformation.add') }}
                </a>
                <a href="{{ route('index-backend') }}" type="button" class="btn btn-secondary">
                    {{ __('backend/serverinformation.back') }}
                </a>
            </div>
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
                            <th scope="col">{{ __('backend/serverinformation.table.order') }}</th>
                            <th scope="col">{{ __('backend/serverinformation.table.title') }}</th>
                            <th scope="col">{{ __('backend/serverinformation.table.body') }}</th>
                            <th scope="col">{{ __('backend/serverinformation.table.action') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($information as $info)
                            <tr>
                                <td>
                                    {{ $info->order }}
                                </td>
                                <td>
                                    {{ $info->title }}
                                </td>
                                <td>
                                    {{ \Illuminate\Support\Str::words(strip_tags($info->body), 5, $end='...') }}
                                </td>
                                <td>

                                    <div class="row">
                                        <div class="col-3">
                                            <a href="{{ route('server-information-edit-show-backend', ['id' => $info->id]) }}"
                                               class="btn btn-primary btn-circle btn-sm">
                                                <i class="fa fa-pen"></i>
                                            </a>
                                        </div>
                                        <div class="col-3">
                                            <form method="POST" data-form="deleteForm"
                                                  action="{{ route('server-information-destroy-backend', ['id' => $info->id]) }}">
                                                @method('DELETE')
                                                @csrf
                                                <span data-toggle="modal" data-target="#informationModalDelete"
                                                      data-title="{{ __('backend/serverinformation.modal.title', ['name' => $info->title]) }}"
                                                      data-message="{{ __('backend/serverinformation.modal.delete-message') }}"
                                                      class="btn btn-danger btn-circle btn-sm" style="cursor: pointer">
                                                    <i class="fa fa-trash"></i>
                                                </span>
                                            </form>
                                        </div>
                                    </div>

                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">
                                    {{ __('backend/serverinformation.table.empty') }}
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="informationModalDelete" role="dialog" aria-labelledby="informationModalDeleteLabel"
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
            $('#informationModalDelete').find('.modal-footer #confirm').on('click', function () {
                $(this).data('form').submit();
            });
            $('#informationModalDelete').on('show.bs.modal', function (e) {
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
