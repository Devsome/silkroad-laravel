@extends('theme::layouts.app')
@section('theme::title', __('seo.donations'))
@section('theme::sidebar')
    @include('theme::frontend.account.sidebar')
@endsection

@section('theme::content')
    <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
        <div class="container">
            <h3>
                {{ __('donations.stripe.error.error-title') }}
            </h3>
            <p>
                {{ __('donations.stripe.error.error-body') }}
            </p>
            <a href="{{ route('donations-index') }}" class="btn btn-primary">
                {{ __('donations.notification.buy.error-ahref') }}
            </a>
        </div>
    </div>
@endsection
