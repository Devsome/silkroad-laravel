@extends('theme::layouts.app')
@section('theme::title', __('seo.rules'))
@section('theme::content')
    <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <h1>{{ __('rules.title') }}</h1>
                    <div class="row">
                        <div class="col-12">
                            {{ __('rules.body') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
