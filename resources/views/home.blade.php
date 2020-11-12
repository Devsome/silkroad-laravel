@extends('theme::layouts.app')
@section('theme::title', __('seo.home'))
@section('theme::sidebar')
    @include('theme::frontend.account.sidebar')
@endsection

@section('theme::content')
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
                                <a href="{{ route('home-settings') }}" class="dashboard-link d-none d-sm-block">
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
                                <a href="{{ route('donations-index') }}" class="dashboard-link d-none d-sm-block">
                                    <i class="fa fa-3x fa-money-bill text-dark box-icon box-icon-outline"></i>
                                </a>
                                <a href="{{ route('donations-index') }}" class="dashboard-link">
                                    <h4 class="box-title">
                                        {{ __('home.grid.donation') }}
                                    </h4>
                                </a>
                                <p class="box-description">
                                    {{ __('home.grid.donation-desc', ['silk' => config('siteSettings.sro_silk_name', 'Silk')]) }}
                                </p>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                            <div class="box box-small-icon-alt">
                                <a href="{{ route('home-referral') }}" class="dashboard-link d-none d-sm-block">
                                    <i class="fa fa-3x fa-retweet text-dark box-icon box-icon-outline"></i>
                                </a>
                                <a href="{{ route('home-referral') }}" class="dashboard-link">
                                    <h4 class="box-title">
                                        {{ __('home.grid.ref') }}
                                    </h4>
                                </a>
                                <p class="box-description">
                                    {{ __('home.grid.ref-desc') }}
                                </p>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                            <div class="box box-small-icon-alt">
                                <a href="{{ route('home-tickets') }}" class="dashboard-link d-none d-sm-block">
                                    <i class="fa fa-3x fa-ticket-alt text-dark box-icon box-icon-outline"></i>
                                </a>
                                <a href="{{ route('home-tickets') }}" class="dashboard-link">
                                    <h4 class="box-title">
                                        {{ __('home.grid.tickets') }}
                                    </h4>
                                </a>
                                <p class="box-description">
                                    {{ __('home.grid.tickets-desc') }}
                                </p>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                            <div class="box box-small-icon-alt">
                                <a href="{{ route('home-voucher') }}" class="dashboard-link d-none d-sm-block">
                                    <i class="fa fa-3x fa-gift text-dark box-icon box-icon-outline"></i>
                                </a>
                                <a href="{{ route('home-voucher') }}" class="dashboard-link">
                                    <h4 class="box-title">
                                        {{ __('home.grid.voucher') }}
                                    </h4>
                                </a>
                                <p class="box-description">
                                    {{ __('home.grid.voucher-desc', ['silk' => config('siteSettings.sro_silk_name', 'Silk')]) }}
                                </p>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                            <div class="box box-small-icon-alt">
                                <a href="{{ route('web-inventory-index') }}" class="dashboard-link d-none d-sm-block">
                                    <i class="fa fa-3x fa-box-open text-dark box-icon box-icon-outline"></i>
                                </a>
                                <a href="{{ route('web-inventory-index') }}" class="dashboard-link">
                                    <h4 class="box-title">
                                        {{ __('home.grid.web-inventory') }}
                                    </h4>
                                </a>
                                <p class="box-description">
                                    {{ __('home.grid.web-inventory-help') }}
                                </p>
                            </div>
                        </div>
                        @if(config('siteSettings.voteforsilk'))
                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                            <div class="box box-small-icon-alt">
                                <a href="{{ route('vote-for-silk-index') }}" class="dashboard-link d-none d-sm-block">
                                    <i class="fa fa-3x fa-vote-yea text-dark box-icon box-icon-outline"></i>
                                </a>
                                <a href="{{ route('vote-for-silk-index') }}" class="dashboard-link">
                                    <h4 class="box-title">
                                        {{ __('home.grid.voteforsilk') }}
                                    </h4>
                                </a>
                                <p class="box-description">
                                    {{ __('home.grid.voteforsilk-help') }}
                                </p>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
