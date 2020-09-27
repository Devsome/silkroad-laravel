@extends('layouts.app')
@section('title', __('seo.donations'))
@section('sidebar')
    @include('frontend.account.sidebar')
@endsection

@section('content')

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
