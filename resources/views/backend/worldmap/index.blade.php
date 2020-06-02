@extends('backend.layouts.app')

@section('backend-content')
    @include('backend.layouts.navbar')

    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">{{ __('backend/worldmap.title') }}</h1>
        </div>
        <div class="row">
            <div class="container" style="height: 500px;">
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
                        <div id="map"></div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
@push('javascript')
    <script src="{{ asset('js/worldmap.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            @forelse($characters as $char)
            xSROMap.AddPlayer(
                    {{  $char->CharID }},
                    '<a href="{{ route('information-player', ['CharName16' => Str::lower($char->getCharacter->CharName16)]) }}" target="_blank">{{ $char->getCharacter->CharName16 }}</a>',
                    {{ $char->getCharacter->PosX }},
                    {{ $char->getCharacter->PosZ }},
                    {{ $char->getCharacter->PosY }},
                    {{ $char->getCharacter->LatestRegion }});
            @empty
            // Nope
            @endforelse
        });
    </script>
@endpush
@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/leaflet.css') }}">
    <style>
        #map {
            height: 450px;
            display: block;
            position: absolute;
            bottom: 0;
            top: 0;
            left: 0;
            right: 0;
        }
    </style>
@endpush
