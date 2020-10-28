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
                    <div class="alert alert-primary" role="alert">
                        <h4 class="alert-heading">{{__('donations.notification.buy.invoice-closed-title')}}</h4>
                        <p>{{__('donations.notification.buy.invoice-closed-message')}}</p>
                    </div>
                </div>
            </div>
            <p>
                {{ __('donations.notification.buy.invoice-help') }}
            </p>

            <a href="{{ route('home') }}" class="btn btn-primary">
                {{ __('donations.notification.buy.error-ahref') }}
            </a>
        </div>
    </div>
@endsection
