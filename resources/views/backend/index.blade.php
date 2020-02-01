@extends('backend.layouts.app')

@section('backend-content')
    @include('backend.layouts.navbar')

    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        </div>

        <div class="row">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Web User</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $userCount }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user-circle fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Player Count</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $playerCount }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-users fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Silk count</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $silkCount }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-coins fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Tasks</div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">50%</div>
                                    </div>
                                    <div class="col">
                                        <div class="progress progress-sm mr-2">
                                            <div class="progress-bar bg-info" role="progressbar" style="width: 50%"
                                                 aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col-lg-6 mb-6">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">{{ __('backend/index.recent-news-title') }}</h6>
                    </div>
                    <div class="card-body">
                        <div class="list-group mb-3">
                            @forelse($notices as $notice)
                            <a href="{{ route('sro-notice-edit-backend', ['id' => $notice->ID]) }}" class="list-group-item list-group-item-action ">
                                [{{ $notice->ID }}] {{ $notice->Subject }}
                            </a>
                            @empty
                                {{ __('backend/index.recent-news-empty') }}
                            @endforelse
                        </div>

                        <a href="{{ route('sro-notice-create-backend') }}">
                            {{ __('backend/index.recent-news-create-link') }} &rarr;
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 mb-6">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">{{ __('backend/index.recent-created-chars') }}</h6>
                    </div>
                    <div class="card-body">
                        <div class="list-group mb-3">
                            @forelse($chars as $char)
                                <a href="{{ route('sro-players-edit-backend', ['char' => $char->CharID]) }}" class="list-group-item list-group-item-action ">
                                    {{ __('backend/index.recent-created-chars-list', [
                                        'char' => $char->CharName16,
                                        'level' => $char->CurLevel
                                    ]) }}
                                </a>
                            @empty
                                {{ __('backend/index.recent-news-empty') }}
                            @endforelse
                        </div>

                        <a href="{{ route('sro-notice-create-backend') }}">
                            {{ __('backend/index.recent-news-create-link') }} &rarr;
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
