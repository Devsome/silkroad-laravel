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
                        {{ __('home.chars-list.title') }}
                    </h1>

                    @if($account->getTbUser->getShardUser->isEmpty())
                        {{ __('home.chars-list.no-chars') }}
                    @else
                        @foreach($account->getTbUser->getShardUser as $char)
                            <div class="row pb-4 row-bordered">
                                <div class="col-xl-3 col-lg-3 col-md-3 d-none d-md-block">
                                    <img src="{{ asset('image/chars/') }}/{{ $char->RefObjID }}.gif"
                                         class="rounded float-left rounded h-75" alt="{{ $char->CharName16 }}">
                                </div>
                                <div class="col-xl-9 col-lg-9 col-md-9">
                                    <dl class="row">
                                        <dt class="col-sm-12">
                                            <h5>
                                                <a href="#" class="text-primary font-weight-light">
                                                    {{ $char->CharName16 }}
                                                </a>
                                                <small class="float-right pt-1">
                                                    @if($char->getCharOnlineOfflineLoggedIn)
                                                        {{ __('home.chars-list.logged-in') }}
                                                    @else
                                                        {{ __('home.chars-list.logged-out') }}
                                                    @endif
                                                </small>
                                            </h5>
                                        </dt>
                                        <dt class="col-sm-3 col-4">
                                            {{ __('home.chars-list.level') }}
                                        </dt>
                                        <dd class="col-sm-9 col-8">
                                            <p>
                                                {{ $char->CurLevel }}
                                            </p>
                                        </dd>
                                        <dt class="col-sm-3 col-4">
                                            {{ __('home.chars-list.last-logout') }}
                                        </dt>
                                        <dt class="col-sm-9 col-8">
                                            {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $char->LastLogout)->diffForHumans() }}
                                        </dt>

                                        <dt class="col-sm-3 col-4">
                                            {{ __('home.chars-list.guild') }}
                                        </dt>
                                        <dd class="col-sm-9 col-8">
                                            {{ $char->getGuildUser ? $char->getGuildUser->Name : '' }}
                                        </dd>
                                        <dt class="col-sm-3 col-4">
                                            {{ __('home.chars-list.gold') }}
                                        </dt>
                                        <dd class="col-sm-9 col-8">
                                            {{ number_format($char->RemainGold, 0, ',', '.') }}
                                        </dd>
                                    </dl>
                                </div>
                            </div>
                        @endforeach
                    @endisset
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
