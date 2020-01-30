@extends('backend.layouts.app')

@section('backend-content')
    @include('backend.layouts.navbar')

    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">{{ __('backend/tbuser.title') }}</h1>
        </div>
        @if ($message = Session::get('success'))
            <div class="py-3 mt-2">
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
            </div>
        @endif
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-8 col-xl-8">
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

                            @php
                                $d = floor ($tbuser->AccPlayTime / 1440);
                                $h = floor (($tbuser->AccPlayTime - $d * 1440) / 60);
                                $m = $tbuser->AccPlayTime - ($d * 1440) - ($h * 60);
                            @endphp
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table class="table table-borderless table-striped">
                                        <tbody>
                                        <tr>
                                            <td>{{ __('backend/tbuser.struserid') }}</td>
                                            <td>{{ $tbuser->StrUserID }}</td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('backend/tbuser.email') }}</td>
                                            <td>{{ $tbuser->Email }}</td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('backend/tbuser.accplaytime') }}</td>
                                            <td>{{ "{$d} Days {$h} Hours {$m} Minutes" }}</td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('backend/tbuser.regip') }}</td>
                                            <td>{{ $tbuser->reg_ip }}</td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('backend/tbuser.accplaytime') }}</td>
                                            <td>{{ $tbuser->AccPlayTime }}</td>
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
                        <h6 class="m-0 font-weight-bold text-primary">
                            {{ __('backend/tbuser.edit.title-silk') }}
                        </h6>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('sro-user-silk-add-backend', ['user' => $tbuser->JID]) }}">
                            @csrf
                            <div class="row">
                                <div class="col-4">
                                    {{ __('backend/tbuser.silk') }}
                                </div>
                                <div class="col-8">
                                    {{ $tbuser->getSkSilk ? $tbuser->getSkSilk->silk_own : '0' }}
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-4">
                                    <label for="silk">
                                        {{ __('backend/tbuser.silk-add') }}
                                    </label>
                                </div>
                                <div class="col-6">
                                    <input id="silk" type="number" class="form-control form-control-sm @error('silk') is-invalid @enderror"
                                           name="silk" value="{{ old('silk') }}">
                                    @error('silk')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-6 offset-4">
                                    <button type="submit" class="btn btn-sm btn-primary">
                                        {{ __('backend/tbuser.silk-add-button') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">
                            {{ __('backend/tbuser.edit.title-block') }}
                        </h6>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('sro-user-block-add-backend', ['user' => $tbuser->JID]) }}">
                            @csrf
                            <div class="form-group row">
                                <div class="col-4">
                                    <label for="block">
                                        {{ __('backend/tbuser.block-add') }}
                                    </label>
                                </div>
                                <div class="col-8">
                                    <input id="block" type="datetime-local" class="form-control form-control-sm @error('block') is-invalid @enderror"
                                           name="block" value="{{ old('block') }}">
                                    @error('block')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-4">
                                    <label for="title">
                                        {{ __('backend/tbuser.block-title') }}
                                    </label>
                                </div>
                                <div class="col-8">
                                    <input id="title" type="text" class="form-control form-control-sm @error('title') is-invalid @enderror"
                                           name="title" value="{{ old('title') }}">
                                    @error('reason')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-4">
                                    <label for="description">
                                        {{ __('backend/tbuser.block-guide') }}
                                    </label>
                                </div>
                                <div class="col-8">
                                    <input id="description" type="text" class="form-control form-control-sm @error('description') is-invalid @enderror"
                                           name="description" value="{{ old('description') }}">
                                    @error('description')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-6 offset-4">
                                    <button type="submit" class="btn btn-sm btn-primary">
                                        {{ __('backend/tbuser.block-add-button') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header">
                        {{ __('backend/tbuser.edit.accounts') }}
                    </div>
                    <div class="card-body">
                        <div class="container mt-2">
                            <div class="row">
                                @forelse($tbuser->getsharduser as $tbUserChar)
                                    <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-2">
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
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card mb-4">
                    <div class="card-header">
                        {{ __('backend/tbuser.edit.punishment') }}
                    </div>
                    @if($tbuser->getpunishmentuser->isEmpty())
                        <div class="card-body">
                            <div class="container mt-2">
                                <div class="row">
                                    {{ __('backend/tbuser.edit.punishment-empty') }}
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable">
                                    <thead>
                                    <tr>
                                        <th>{{ __('backend/tbuser.edit.jid') }}</th>
                                        <th>{{ __('backend/tbuser.edit.guide') }}</th>
                                        <th>{{ __('backend/tbuser.edit.description') }}</th>
                                        <th>{{ __('backend/tbuser.edit.blockstarttime') }}</th>
                                        <th>{{ __('backend/tbuser.edit.blockendtime') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($tbuser->getpunishmentuser as $punishment)
                                        <tr>
                                            <td>{{ $punishment->UserJID }}</td>
                                            <td>{{ $punishment->Guide }}</td>
                                            <td>{{ $punishment->Description }}</td>
                                            <td>{{ $punishment->BlockStartTime }}</td>
                                            <td>{{ $punishment->BlockEndTime }}</td>
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
        </div>
    </div>
@endsection
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
