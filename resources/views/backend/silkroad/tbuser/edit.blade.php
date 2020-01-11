@extends('backend.layouts.app')

@section('backend-content')
    @include('backend.layouts.navbar')

    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">{{ __('backend/tbuser.title') }}</h1>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">
                            {{ __('backend/tbuser.edit.title') }} [{{ $tbuser->JID }}]
                            @if($tbuser->sec_primary === 1 && $tbuser->sec_content === 1)
                                <span class="badge badge-danger">{{ __('backend/tbuser.gmrank') }}</span>
                            @endif
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <p>{{ $tbuser->getIsBlockedUser->isEmpty() ? '' : __('backend/tbuser.blocked', ['date' => $tbuser->getIsBlockedUser[0]->timeEnd]) }}</p>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="inputStrUserId">{{ __('backend/tbuser.struserid') }}</label>
                                    <input type="text" class="form-control" id="inputStrUserId"
                                           value="{{ $tbuser->StrUserID}}" disabled aria-describedby="strUserIdHelp">
                                    <small id="strUserIdHelp" class="form-text text-muted">
                                        {{ __('backend/tbuser.edit.email-info') }}
                                    </small>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="inputEmail">{{ __('backend/tbuser.email') }}</label>
                                    <input type="email" class="form-control" id="inputEmail"
                                           value="{{ $tbuser->Email }}" disabled>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form group">
                                    <label for="silk">{{ __('backend/tbuser.silk') }}</label>
                                    <input type="text" class="form-control" id="silk"
                                           value="{{ $tbuser->getSkSilk ? $tbuser->getSkSilk->silk_own : '0' }}" disabled>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="inputPlayTime">{{ __('backend/tbuser.accplaytime') }}</label>
                                    @php
                                        $d = floor ($tbuser->AccPlayTime / 1440);
                                        $h = floor (($tbuser->AccPlayTime - $d * 1440) / 60);
                                        $m = $tbuser->AccPlayTime - ($d * 1440) - ($h * 60);
                                    @endphp
                                    <input type="text" class="form-control" id="inputPlayTime"
                                           value="{{ "{$d} Days {$h} Hours {$m} Minutes" }}" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header">
                {{ __('backend/tbuser.edit.accounts') }}
            </div>
            <div class="card-body">
                <div class="container mt-2">
                    <div class="row">
                        @forelse($tbuser->getsharduser as $tbUserChar)
                            <div class="col-2">
                                <ul class="list-group list-group-flush small">
                                    <li class="list-group-item font-weight-bold">
                                        <a href="{{ route("sro-players-edit-backend", ['char' =>  $tbUserChar->pivot->CharID ]) }}">
                                            {{ $tbUserChar->CharName16 }}
                                        </a>
                                    </li>
                                    <li class="list-group-item">
                                        {{ __('backend/tbuser.edit.level') }} {{ $tbUserChar->CurLevel }}
                                    </li>
                                    <li class="list-group-item">
                                        {{ __('backend/tbuser.edit.guild') }} {{ $tbUserChar->getGuildUser ? $tbUserChar->getGuildUser->Name : '' }}
                                    </li>
                                    <li class="list-group-item">
                                        {{ __('backend/tbuser.edit.guild-nickname') }} {{ $tbUserChar->getGuildMemberUser ? $tbUserChar->getGuildMemberUser->Nickname : '' }}
                                    </li>
                                </ul>
                            </div>

                        @empty
                            {{ __('backend/tbuser.edit.no-char') }}
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header">
                {{ __('backend/tbuser.edit.punishment') }}
            </div>
            @if($tbuser->getpunishmentuser->isEmpty())
                <div class="card-body">
                    {{ __('backend/tbuser.edit.punishment-empty') }}
                </div>
            @else
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable">
                            <thead>
                            <tr>
                                <th>{{ __('backend/tbuser.edit.jid') }}</th>
                                <th>{{ __('backend/tbuser.edit.charname') }}</th>
                                <th>{{ __('backend/tbuser.edit.guide') }}</th>
                                <th>{{ __('backend/tbuser.edit.description') }}</th>
                                <th>{{ __('backend/tbuser.edit.blockstarttime') }}</th>
                                <th>{{ __('backend/tbuser.edit.blockendtime') }}</th>
                                <th>{{ __('backend/tbuser.edit.status') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($tbuser->getpunishmentuser as $punishment)
                                <tr>
                                    <td>{{ $punishment->UserJID }}</td>
                                    <td>{{ $punishment->CharName }}</td>
                                    <td>{{ $punishment->Guide }}</td>
                                    <td>{{ $punishment->Description }}</td>
                                    <td>{{ $punishment->BlockStartTime }}</td>
                                    <td>{{ $punishment->BlockEndTime }}</td>
                                    <td>{{ $punishment->Status }}</td>
                                </tr>
                            @empty
                                {{ __('backend/tbuser.edit.punishment-empty') }}
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>

    </div>
@endsection
@push('css')
    <link href="{{ asset('css/backend/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush
@push('javascript')
    <script>
        $(document).ready(function () {
            $('#dataTable').DataTable({
                "order": [[0, "desc"]],
                "lengthMenu": [[5, 25, 50, 100, 200, -1], [10, 25, 50, 100, 200, "{{ __('backend/datatables.show-all') }}"]],
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
                }
            });
            $('div.dataTables_filter input').addClass('search-input form-control');
            $('select').addClass('search-input form-control');
        });
    </script>
@endpush
