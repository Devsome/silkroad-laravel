@extends('theme::backend.layouts.app')

@section('theme::backend-content')
    @include('theme::backend.layouts.navbar')

    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">
                {{ __('backend/voteforsilk.title') }}
            </h1>
        </div>
        <div class="row">
            <div class="container">
                <div class="col-12">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0">
                                {{ __('backend/voteforsilk.table.title') }}
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive table-borderless">
                                <table id="voteforsilk" class="table table-hover dataTable">
                                    <thead>
                                    <tr>
                                        <th scope="col">
                                            {{ __('backend/voteforsilk.table.id') }}
                                        </th>
                                        <th scope="col">
                                            {{ __('backend/voteforsilk.table.name') }}
                                        </th>
                                        <th scope="col">
                                            {{ __('backend/voteforsilk.table.reward') }}
                                        </th>
                                        <th scope="col">
                                            {{ __('backend/voteforsilk.table.active') }}
                                        </th>
                                        <th scope="col">
                                            {{ __('backend/voteforsilk.table.action') }}
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($data as $item)
                                        <tr>
                                            <td>
                                                {{ $item->id }}
                                            </td>
                                            <td>
                                                {{ $item->name }}
                                            </td>
                                            <td>
                                                {{ $item->reward }}
                                            </td>
                                            <td>
                                                {{ $item->active === 1 ?
                                                 __('backend/voteforsilk.table.state-active') :
                                                 __('backend/voteforsilk.table.state-inactive') }}
                                            </td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-3">
                                                        <form method="POST" data-form="deleteForm"
                                                              action="{{ route('vote-toggle-backend', ['id' => $item->id]) }}">
                                                            @csrf
                                                            <span data-toggle="modal" data-target="#voteforsilkModal"
                                                                  data-title="{{ __('backend/voteforsilk.modal.title') }}"
                                                                  data-message="{{ __('backend/voteforsilk.modal.message', [
                                                            'name' => $item->name
                                                          ]) }}"
                                                                  class="btn btn-primary btn-circle btn-sm delete-btn"
                                                                  style="cursor: pointer">
                                                    @if($item->active === 1)
                                                                    <i class="fa fa-eye-slash"></i>
                                                                @else
                                                                    <i class="fa fa-eye"></i>
                                                                @endif
                                                </span>
                                                        </form>
                                                    </div>
                                                    <div class="col-3">
                                                        <a class="btn btn-secondary btn-circle btn-sm"
                                                           href="{{ route('vote-edit-backend', ['id' => $item->id]) }}">
                                                            <i class="fa fa-pen"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td>
                                                {{ __('backend/voteforsilk.table.empty') }}
                                            </td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="voteforsilkModal" role="dialog" aria-labelledby="voteforsilkModal"
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

            $('#voteforsilkModal').find('.modal-footer #confirm').on('click', function () {
                $(this).data('form').submit();
            });
            $('#voteforsilkModal').on('show.bs.modal', function (e) {
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
            $('#voteforsilk').DataTable({
                bLengthChange: false,
                columnDefs: [
                    {
                        "targets": 1,
                        "orderable": false,
                        "searchable": false,
                    }
                ],
                aaSorting: [4],
                order: [
                    [0, 'desc']
                ],
                dom: 'btrp',
            });
        });
    </script>
@endpush
