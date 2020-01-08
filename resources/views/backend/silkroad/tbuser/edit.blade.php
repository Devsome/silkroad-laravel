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
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="inputStrUserId">{{ __('backend/tbuser.struserid') }}</label>
                                    <input type="text" class="form-control" id="inputStrUserId"
                                           value="{{ $tbuser->StrUserID}}" disabled>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="inputEmail">{{ __('backend/tbuser.email') }}</label>
                                    <input type="email" class="form-control" id="inputEmail"
                                           aria-describedby="emailHelp"
                                           value="{{ $tbuser->Email }}" disabled>
                                    <small id="emailHelp" class="form-text text-muted">
                                        {{ __('backend/tbuser.edit.email-info') }}
                                    </small>
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
                @forelse($tbuser->getsharduser as $tbUserChar)
                    <div class="container mt-2">
                        <div class="row">
                            <div class="col-2">
                                <img src="{{ asset('image/chars/') }}/{{ $tbUserChar->RefObjID }}.gif"
                                     class="brand-item-image d-none d-md-block" width="100px"
                                     height="150px">
                            </div>
                            <div class="col-2">
                                <ul class="list-group list-group-flush small">
                                    <li class="list-group-item font-weight-bold">
                                        <a href="{{ url('player', $tbUserChar->pivot->CharID) }}">
                                            {{ $tbUserChar->CharName16 }}
                                        </a>
                                    </li>
                                    <li class="list-group-item">
                                        {{ __('backend/tbuser.edit.level') }} {{ $tbUserChar->CurLevel }}
                                    </li>
                                    <li class="list-group-item">
                                        {{ __('backend/tbuser.edit.gold') }} {{ number_format($tbUserChar->RemainGold,0) }}
                                    </li>
                                </ul>
                            </div>
                            <div class="col-2">
                                <ul class="list-group list-group-flush small">
                                    <li class="list-group-item">
                                        {{ __('backend/tbuser.edit.health') }} {{ $tbUserChar->HP }}
                                    </li>
                                    <li class="list-group-item">
                                        {{ __('backend/tbuser.edit.mana') }} {{ $tbUserChar->MP }}
                                    </li>
                                    <li class="list-group-item">
                                        {{ __('backend/tbuser.edit.sp') }} {{ $tbUserChar->RemainSkillPoint }}
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                @empty
                    {{ __('backend/tbuser.edit.no-char') }}
                @endforelse
            </div>
        </div>

    </div>
@endsection
