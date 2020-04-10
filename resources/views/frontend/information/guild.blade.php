@extends('layouts.app')

@section('content')
    <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <h1>{{ __('information.guild.title', ['name' => '2']) }}</h1>
                    <div class="row">
                        <div class="col-12">
                        </div>
                        {{ $guild }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
