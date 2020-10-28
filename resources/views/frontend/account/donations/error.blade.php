@extends('theme::layouts.app')
@section('theme::title', __('seo.donations'))
@section('theme::sidebar')
    @include('theme::frontend.account.sidebar')
@endsection

@section('theme::content')
    <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="alert alert-danger" role="alert">
                        <h4 class="alert-heading">{{ __('donations.notification.buy.error-title') }}</h4>
                        <p>{{ __('donations.notification.buy.error') }}</p>
                    </div>
                </div>
            </div>

            @if ($message = Session::get('error'))
                <div class="alert alert-warning alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
            @endif

            <p>
                {{ __('donations.notification.buy.error-helper') }}
            </p>
            <a href="{{ route('donations-index') }}" class="btn btn-primary">
                {{ __('donations.notification.buy.error-ahref') }}
            </a>
        </div>
    </div>
@endsection
