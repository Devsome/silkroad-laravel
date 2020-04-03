@extends('layouts.app')

@section('sidebar')
    @include('frontend.account.sidebar')
@endsection

@section('content')
    <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <h1>
                        {{ __('home.title') }}
                    </h1>
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                            <div class="box box-small-icon-alt">
                                <a href="{{ route('home-chars-list') }}" class="dashboard-link d-none d-sm-block">
                                    <i class="fa fa-3x fa-users text-dark box-icon box-icon-outline"></i>
                                </a>
                                <a href="{{ route('home-chars-list') }}" class="dashboard-link">
                                    <h4 class="box-title">
                                        {{ __('home.grid.char-list') }}
                                    </h4>
                                </a>
                                <p class="box-description">
                                    {{ __('home.grid.char-list-desc') }}
                                </p>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                            <div class="box box-small-icon-alt">
                                <a href="h{{ route('home-settings') }}" class="dashboard-link d-none d-sm-block">
                                    <i class="fa fa-3x fa-user-cog text-dark box-icon box-icon-outline"></i>
                                </a>
                                <a href="{{ route('home-settings') }}" class="dashboard-link">
                                    <h4 class="box-title">
                                        {{ __('home.grid.settings') }}
                                    </h4>
                                </a>
                                <p class="box-description">
                                    {{ __('home.grid.settings-desc') }}
                                </p>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                            <div class="box box-small-icon-alt">
                                <a href="#" class="dashboard-link d-none d-sm-block">
                                    <i class="fa fa-3x fa-money-bill text-dark box-icon box-icon-outline"></i>
                                </a>
                                <a href="#" class="dashboard-link">
                                    <h4 class="box-title">
                                        {{ __('home.grid.donation') }}
                                    </h4>
                                </a>
                                <p class="box-description">
                                    {{ __('home.grid.donation-desc', ['silk' => config('app.sro_silk_name')]) }}
                                </p>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                            <div class="box box-small-icon-alt">
                                <a href="#" class="dashboard-link d-none d-sm-block">
                                    <i class="fa fa-3x fa-bug text-dark box-icon box-icon-outline"></i>
                                </a>
                                <a href="#" class="dashboard-link">
                                    <h4 class="box-title">
                                        {{ __('home.grid.other') }}
                                    </h4>
                                </a>
                                <p class="box-description">
                                    {{ __('home.grid.other-desc') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
