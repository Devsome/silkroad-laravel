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
                    <div class="alert alert-success" role="alert">
                        <h4 class="alert-heading">{{__('donations.notification.buy.success-title')}}</h4>
                        <p>{{__('donations.notification.buy.success-message')}}</p>
                    </div>
                </div>
            </div>
            @if ($message = Session::get('successfully'))
                <p>
                    {{ __('donations.notification.buy.success-help', ['amount' => $message]) }}
                </p>
            @endif

            <p>
                <a href="{{ route('home') }}">
                    {{ __('donations.notification.buy.success-back') }}
                </a>
            </p>
        </div>
    </div>

@endsection
