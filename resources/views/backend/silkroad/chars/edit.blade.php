@extends('backend.layouts.app')

@section('backend-content')
    @include('backend.layouts.navbar')

    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">{{ __('backend/chars.title') }}</h1>
        </div>
        @if ($message = Session::get('success'))
            <div class="py-3 mt-2">
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
            </div>
        @endif
        @if ($error = Session::get('error'))
            <div class="py-3 mt-2">
                <div class="alert alert-danger alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $error }}</strong>
                </div>
            </div>
        @endif
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-8 col-xl-8">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">
                            {{ $char->CharName16 }} [{{ $char->CharID }}]
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table class="table table-borderless table-striped">
                                        <tbody>
                                        <tr>
                                            <td>{{ __('backend/chars.edit.level') }}</td>
                                            <td>{{ $char->CurLevel }}</td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('backend/chars.edit.jobname') }}</td>
                                            <td>{{ $char->NickName16 }}</td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('backend/chars.edit.gold') }}</td>
                                            <td>{!! preg_replace('/\B(?=(\d{3})+(?!\d))/', '.', $char->RemainGold) !!}</td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('backend/chars.edit.last-logout') }}</td>
                                            <td>{{ $char->LastLogout }}</td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('backend/chars.edit.account-id') }}</td>
                                            <td>
                                                <a href="{{ route('sro-user-edit-backend', ['user' => $tbUser]) }}" target="_blank">
                                                    {{ __('backend/chars.edit.visit-account') }} <i class="fas fa-external-link-alt"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('backend/chars.edit.guild') }}</td>
                                            <td>
                                                @if($char->getGuildUser)
                                                    <a href="{{ route('sro-guild-edit-backend', ['guild' => $char->getGuildUser->ID]) }}"
                                                       target="_blank">
                                                        {{ $char->getGuildUser->Name }}
                                                    </a>
                                                @endif
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0">
                            {{ __('backend/chars.edit.unstuck.title') }}
                        </h6>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('sro-players-unstuck', ['char' => $char->CharID]) }}">
                            @csrf
                            <div class="row">
                                <div class="col-4">
                                    {{ __('backend/chars.edit.unstuck.current-x') }}
                                </div>
                                <div class="col-8">
                                    {{ round($char->PosX, 2) }}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    {{ __('backend/chars.edit.unstuck.current-y') }}
                                </div>
                                <div class="col-8">
                                    {{ round($char->PosY, 2) }}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    {{ __('backend/chars.edit.unstuck.current-z') }}
                                </div>
                                <div class="col-8">
                                    {{ round($char->PosZ, 2) }}
                                </div>
                            </div>
                            <div class="form-group row mt-2">
                                <div class="col-6 offset-4">
                                    <span data-toggle="modal" data-target="#unstockModal"
                                          data-title="{{ __('backend/chars.edit.unstuck.modal-title') }}"
                                          data-message="{{ __('backend/chars.edit.unstuck.modal-body', ['char' => $char->CharName16]) }}"
                                          class="btn btn-danger btn-sm" style="cursor: pointer">
                                        {{ __('backend/chars.edit.unstuck.submit') }}
                                    </span>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0">
                            {{ __('backend/chars.edit.logged-history.title') }}
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive table-borderless">
                            <table id="loggedInHistory" class="table table-hover dataTable">
                                <thead>
                                <tr>
                                    <th scope="col">{{ __('backend/chars.edit.logged-history.state') }}</th>
                                    <th scope="col">{{ __('backend/chars.edit.logged-history.date') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($loggedInHistory as $log)
                                    <tr>
                                        <td>
                                            {{ $log->status == 4 ? __('backend/chars.edit.logged-history.in') :
                                            __('backend/chars.edit.logged-history.out') }}
                                        </td>
                                        <td>{{ $log->created_at }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td>{{ __('backend/chars.edit.logged-history.empty') }}</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                <div class="card mb-4">
                    <div class="card-header">
                        {{ __('backend/chars.edit.equipment') }}
                    </div>
                    <div class="card-body">
                        <div class="container mt-2">
                            <div class="row">
                                @foreach($char->getEquipmentUser as $item)
                                    @php
                                        $refregObjCommon = $item->getRefObjCommon;
                                    @endphp
                                    <div class="col-4">
                                        <div class="image"
                                             style="background:url('{{
                                            asset('/image/icon/' .
                                            str_replace(['ddj', '\\'], ['PNG', '/'], $refregObjCommon->AssocFileIcon128))
                                        }}');">
                                            @if (strpos($refregObjCommon->NameStrID128, 'RARE') !== false)
                                                <img src="{{ asset('/image/sox.gif') }}" width="32" height="32"
                                                     alt="Seal of X">
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                <div class="card mb-4">
                    <div class="card-header">
                        {{ __('backend/chars.edit.inventory') }}
                    </div>
                    <div class="card-body">
                        <div class="container mt-2">
                            <div class="row">
                                @foreach($char->getInventoryItemUser as $item)
                                    @php
                                        $refregObjCommon = $item->getRefObjCommon;
                                    @endphp
                                    <div class="col-3">
                                        <div class="image"
                                             style="background:url('{{
                                            asset('/image/icon/' .
                                            str_replace(['ddj', '\\'], ['PNG', '/'], $refregObjCommon->AssocFileIcon128))
                                         }}');">
                                            @if (strpos($refregObjCommon->NameStrID128, 'RARE') !== false)
                                                <img src="{{ asset('/image/sox.gif') }}" width="32" height="32"
                                                     alt="Seal of X">
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="unstockModal" role="dialog" aria-labelledby="unstockModalLabel"
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
@push('css')
    <style>
        .image {
            width: 32px;
            height: 32px;
            margin: 3px;
            padding: 0;
            color: #fff;
        }
    </style>
@endpush

@push('javascript')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#unstockModal').find('.modal-footer #confirm').on('click', function () {
                $(this).data('form').submit();
            });
            $('#unstockModal').on('show.bs.modal', function (e) {
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


            $('#loggedInHistory').DataTable({
                bLengthChange: false,
                columnDefs: [
                    {
                        "targets": 1,
                        "orderable": false,
                        "searchable": false,
                    }
                ],
                order: [
                    [1, 'desc']
                ],
                dom: 'btrp',
            });

        });
    </script>
@endpush
