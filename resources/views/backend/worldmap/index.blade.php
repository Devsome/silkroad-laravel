@extends('backend.layouts.app')

@section('backend-content')
    @include('backend.layouts.navbar')

    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">{{ __('backend/worldmap.title') }}</h1>
        </div>
        <div class="row">
            <div class="container">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0">{{ __('backend/worldmap.subtitle', ['count' => $count]) }}</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group" id="search">
                                    <label for="player">{{ __('backend/worldmap.search') }}</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control"
                                               placeholder="{{ __('backend/worldmap.search-placeholder') }}" name="player">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="submit">
                                                {{ __('backend/worldmap.submit') }}
                                            </button>
                                        </div>
                                    </div>
                                    <small id="playerHelper" class="form-text text-muted">
                                        {{ __('backend/worldmap.search-helper') }}
                                    </small>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card shadow mb-2">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-sm-6 col-md-5 col-lg-4 col-xl-4">
                                <div class="u-vmenu">
                                    <ul>
                                        <li> <a href="#">Towns</a>
                                            <ul>
                                                <li> <a href="#map" onclick="xSROMap.FlyView(6434,1044)">Jangan</a>
                                                </li>
                                                <li> <a href="#map" onclick="xSROMap.FlyView(3554,2112)">Donwhang</a>
                                                </li>
                                                <li> <a href="#map" onclick="xSROMap.FlyView(114,47.25)">Hotan</a>
                                                </li>
                                                <li> <a href="#map" onclick="xSROMap.FlyView(-5184,2889)">Samarkand</a>
                                                </li>
                                                <li> <a href="#map" onclick="xSROMap.FlyView(-10681,2584)">Constantinople</a>
                                                </li>
                                                <li> <a href="#map" onclick="xSROMap.FlyView(-16147,75)">Alexandria (North)</a>
                                                </li>
                                                <li> <a href="#map" onclick="xSROMap.FlyView(-16641,-275)">Alexandria (South)</a>
                                                </li>
                                                <li> <a href="#map" onclick="xSROMap.FlyView(-8525,-717)">Baghdad</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li> <a href="#">Zones</a>
                                            <ul>
                                                <li> <a href="#map" onclick="xSROMap.SetView(5109,420)">Tiger Mountain</a>
                                                </li>
                                                <li> <a href="#map" onclick="xSROMap.SetView(2592.75,-5.25)">Tarim Basin</a>
                                                </li>
                                                <li> <a href="#map" onclick="xSROMap.SetView(-1410,-255.75)">Karakoram</a>
                                                </li>
                                                <li> <a href="#map" onclick="xSROMap.SetView(-561,2037)">Taklamakan</a>
                                                </li>
                                                <li> <a href="#map" onclick="xSROMap.SetView(-4401,-141)">Mountain Roc</a>
                                                </li>
                                                <li> <a href="#map" onclick="xSROMap.SetView(-4224,2496)">Central Asia</a>
                                                </li>
                                                <li> <a href="#map" onclick="xSROMap.SetView(-6891,2373)">Asia Minor</a>
                                                </li>
                                                <li> <a href="#map" onclick="xSROMap.SetView(-11853,2979)">Eastern Europe</a>
                                                </li>
                                                <li> <a href="#map" onclick="xSROMap.SetView(-12378,-1344)">Storm and Cloud Desert</a>
                                                </li>
                                                <li> <a href="#map" onclick="xSROMap.SetView(-12996,-3264)">King's Valley</a>
                                                </li>
                                                <li> <a href="#map" onclick="xSROMap.SetView(-9360,-777)">Kirk Field</a>
                                                </li>
                                                <li> <a href="#map" onclick="xSROMap.SetView(-10356,-2733)">Phantom Desert</a>
                                                </li>
                                                <li> <a href="#map" onclick="xSROMap.SetView(-8787,-2370)">Flaming Tree</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li> <a href="#">Areas</a>
                                            <ul>
                                                <li> <a href="#">Donwhang Stone Cave</a>
                                                    <ul>
                                                        <li> <a href="#map" onclick="xSROMap.SetView(0,0,0,32769)">Donwhang Dungeon B1 (Lv.61~64)</a>
                                                        </li>
                                                        <li> <a href="#map" onclick="xSROMap.SetView(0,0,115,32769)">Donwhang Dungeon B2 (Lv.64~66)</a>
                                                        </li>
                                                        <li> <a href="#map" onclick="xSROMap.SetView(0,0,230,32769)">Donwhang Dungeon B3 (Lv.65~68)</a>
                                                        </li>
                                                        <li> <a href="#map" onclick="xSROMap.SetView(0,0,345,32769)">Donwhang Dungeon B4 (Lv.69~70)</a>
                                                        </li>
                                                    </ul>
                                                </li>
                                                <li> <a href="#">Tomb of Qui-Shin</a>
                                                    <ul>
                                                        <li> <a href="#map" onclick="xSROMap.SetView(0,0,0,32775)">Qin-Shi Tomb B1 (Lv.81~85)</a>
                                                        </li>
                                                        <li> <a href="#map" onclick="xSROMap.SetView(0,0,0,32774)">Qin-Shi Tomb B2 (Lv.86~90)</a>
                                                        </li>
                                                        <li> <a href="#map" onclick="xSROMap.SetView(0,0,0,32773)">Qin-Shi Tomb B3 (Lv.90~95)</a>
                                                        </li>
                                                        <li> <a href="#map" onclick="xSROMap.SetView(0,0,0,32772)">Qin-Shi Tomb B4 (Lv.96~99)</a>
                                                        </li>
                                                        <li> <a href="#map" onclick="xSROMap.SetView(0,0,0,32771)">Qin-Shi Tomb B5</a>
                                                        </li>
                                                        <li> <a href="#map" onclick="xSROMap.SetView(0,0,0,32770)">Qin-Shi Tomb B6</a>
                                                        </li>
                                                    </ul>
                                                </li>
                                                <li> <a href="#map" onclick="xSROMap.SetView(0,0,0,32784)">Temple</a>
                                                </li>
                                                <li> <a href="#map" onclick="xSROMap.SetView(0,0,0,32786)">Flame Mountain</a>
                                                </li>
                                                <li> <a href="#map" onclick="xSROMap.SetView(0,0,0,32785)">Cave of Meditation</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li id="player-nav"> <a href="#">Players</a>
                                            <ul></ul>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-7 col-lg-8 col-xl-8" id="map"></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
@push('javascript')
    <script src="{{ asset('js/worldmap.min.js') }}"></script>
    <script type="text/javascript">
        // Just stop default hash click behavior
        $('.u-vmenu, #map').click(function(e){
            if($(e.target).attr('href') === "#")
                e.preventDefault();
        });
    </script>
    <script>
        $(document).ready(function () {
            let nav = $('#player-nav ul');

            @forelse($characters as $char)
            xSROMap.AddPlayer(
                    {{  $char->CharID }},
                    '<a href="{{ route('information-player', ['CharName16' => Str::lower($char->getCharacter->CharName16)]) }}">{{ $char->getCharacter->CharName16 }}</a>',
                    {{ $char->getCharacter->PosX }},
                    {{ $char->getCharacter->PosZ }},
                    {{ $char->getCharacter->PosY }},
                    {{ $char->getCharacter->LatestRegion }});
            // Add to navigation
            nav.append('<li><a href="#map" onclick="xSROMap.GoToPlayer({{ $char->CharID }})">{{ $char->getCharacter->CharName16 }}</a></li>')
            @empty
            // Nope
            @endforelse
        });
    </script>
    <!-- init multilevel menu -->
    <script>
        $(".u-vmenu").vmenuModule({
            Speed: 300,
            autostart:false,
            autohide:true
        });
    </script>
@endpush
@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/leaflet.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/components.css') }}">
    <style>
        #map {
            height: 450px;
            display: block;
            bottom: 0;
            top: 0;
            left: 0;
            right: 0;
        }
    </style>
@endpush
