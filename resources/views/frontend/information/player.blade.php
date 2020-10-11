@extends('theme::layouts.app')
@section('theme::title', __('seo.information.player', ['name' => $player->CharName16]))
@section('theme::content')
    <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <h1>{{ __('information.player.title', ['charname16' => $player->CharName16]) }}</h1>
                    <div class="row">
                        @if($player->getAccountUser->getTbUser)
                            @role('administrator')
                                @include('theme::frontend.information.information.player.gm')
                            @else
                                @auth
                                    @if($player->getAccountUser->getTbUser->JID === Auth::user()->jid)
                                        @include('theme::frontend.information.information.player.own')
                                    @else
                                        @include('theme::frontend.information.information.player.guest')
                                    @endif
                                @else
                                    @include('theme::frontend.information.information.player.guest')
                                @endauth
                            @endrole
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@if($player->getAccountUser->getTbUser)
    @role('administrator')
        @include('theme::frontend.information.information.map', ['player' => $player])
    @else
    @auth
        @if($player->getAccountUser->getTbUser->JID === Auth::user()->jid)
            @include('theme::frontend.information.information.map', ['player' => $player])
        @else
            @if($playerUnderJob)
                @include('theme::frontend.information.information.map', ['player' => $player])
            @endif
        @endif
    @else
        @if($playerUnderJob)
        @if($player->getAccountUser->getTbUser->getWebUser && $player->getAccountUser->getTbUser->getWebUser->show_map === 1)
            @include('theme::frontend.information.information.map', ['player' => $player])
        @endif
        @endif
    @endauth
    @endrole
@endif
