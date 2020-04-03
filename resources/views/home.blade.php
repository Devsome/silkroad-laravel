@extends('layouts.app')

@section('sidebar')
    <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12 d-none d-lg-block">
        <p class="font-weight-light pt-2 pb-2 font-weight-bold">
            {{ __('sidebar.home.title') }}
        </p>
        <ul class="list-group list-unstyled small">
            <li>
                <div class="float-left">
                    <i class="fa fa-fw fa-desktop"></i> {{ __('sidebar.information.online') }}
                </div>
                <div class="float-right">
                    @include('layouts.playercount')
                </div>
            </li>
            <li class="pb-1 pt-2">
                <div class="float-left">
                    <i class="fa fa-fw fa-clock"></i> {{ __('sidebar.information.time') }}
                </div>
                <div class="float-right">
                    <span class="currTime">00:00:00</span>
                </div>
            </li>
        </ul>

        <p class="font-weight-light pt-4 font-weight-bold">
            {{ __('sidebar.home.currency') }}
        </p>
        <ul class="list-group list-unstyled small ">
            <li class="pb-1">
                <div class="float-left">
                    <i class="fa fa-fw fa-coins"></i> {{ __('sidebar.home.silk') }}
                </div>
                <div class="float-right">
                    {{ $account->getTbUser->getSkSilk->silk_own }}
                </div>
            </li>
            <li class="pb-1">
                <div class="float-left">
                    <i class="fa fa-fw fa-coins"></i> {{ __('sidebar.home.silk-gift') }}
                </div>
                <div class="float-right">
                    {{ $account->getTbUser->getSkSilk->silk_gift }}
                </div>
            </li>
        </ul>

        <p class="font-weight-light pt-4 font-weight-bold">
            {{ __('sidebar.home.settings') }}
        </p>
        <ul class="list-group list-unstyled small">
            <li class="pb-1">
                <div class="float-left">
                    <a href="#">
                        {{ __('sidebar.home.change-password') }}
                    </a>
                </div>
            </li>
            <li class="pb-1">
                <div class="float-left">
                    <a href="#">
                        {{ __('sidebar.home.donate') }}
                    </a>
                </div>
            </li>
        </ul>
    </div>
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
                                <a href="{{ route('chars-list') }}" class="dashboard-link d-none d-sm-block">
                                    <i class="fa fa-3x fa-users text-dark box-icon box-icon-outline"></i>
                                </a>
                                <a href="{{ route('chars-list') }}" class="dashboard-link">
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
                                <a href="https://shisha-db.de/home/favoriten" class="dashboard-link d-none d-sm-block">
                                    <i class="fa fa-3x fa-user-cog text-dark box-icon box-icon-outline"></i>
                                </a>
                                <a href="https://shisha-db.de/home/favoriten" class="dashboard-link">
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
                                <a href="https://shisha-db.de/home/favoriten" class="dashboard-link d-none d-sm-block">
                                    <i class="fa fa-3x fa-money-bill text-dark box-icon box-icon-outline"></i>
                                </a>
                                <a href="https://shisha-db.de/home/favoriten" class="dashboard-link">
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
                                <a href="https://shisha-db.de/home/favoriten" class="dashboard-link d-none d-sm-block">
                                    <i class="fa fa-3x fa-bug text-dark box-icon box-icon-outline"></i>
                                </a>
                                <a href="https://shisha-db.de/home/favoriten" class="dashboard-link">
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
