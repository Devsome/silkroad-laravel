@extends('layouts.app')

@section('content')
    <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <h1>{{ __('information.player.title', ['charname16' => $player->CharName16]) }}</h1>
                    <div class="row">
                        @if($player->getAccountUser->getTbUser)
                            @role('backend')
                                @include('frontend.information.information.player.gm')
                            @else
                                @auth
                                    @if($player->getAccountUser->getTbUser->StrUserID === Auth::user()->silkroad_id)
                                        @include('frontend.information.information.player.own')
                                    @else
                                        @include('frontend.information.information.player.guest')
                                    @endif
                                @else
                                    @include('frontend.information.information.player.guest')
                                @endauth
                            @endrole
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('javascript')
    <script type="text/javascript">
        $(document).ready(function () {
            createMinimapCanvas(
                '{{ asset('image/worldmap/8') }}/',
                'player-map',
                150,
                150,
                {{ $player->PosX }},
                {{ $player->PosY }},
                {{ $player->PosZ }},
                {{ $player->LatestRegion }}
            );
        });
    </script>
@endpush
