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

        <ul class="list-group list-unstyled small pt-3">
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

        <p class="font-weight-light pt-4 font-weight-bold">{{ __('sidebar.home.settings') }}</p>
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
                    <div class="card">
                        <div class="card-header">
                            {{ __('home.title') }}
                        </div>

                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                            <div class="container">
                                <div class="row">
                                    @if($account->getTbUser->getShardUser->isEmpty())
                                        {{ __('home.no-chars') }}
                                    @else
                                        @foreach($account->getTbUser->getShardUser as $char)
                                            <div class="col-12">
                                                {{ $char->CharName16 }} {{ $char->CurLevel }}
                                            </div>
                                        @endforeach
                                    @endisset
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
