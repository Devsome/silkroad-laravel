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
