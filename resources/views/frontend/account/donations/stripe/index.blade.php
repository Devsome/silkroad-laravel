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
                    <h1>
                        {{ __('donations.stripe.title') }}
                    </h1>

                    @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{{ $message }}</strong>
                        </div>
                    @endif
                    @if ($error = Session::get('error'))
                        <div class="alert alert-danger alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{{ $error }}</strong>
                        </div>
                    @endif

                    @if ($message = Session::get('message'))
                        <div class="alert alert-primary alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{{ $message }}</strong>
                        </div>
                    @endif

                    <div class="row">
                        @forelse($stripe as $data)
                            <div class="col-lg-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <h6 class="m-0 font-weight-bold">
                                            {{ $data->silk }} {{ config('siteSettings.sro_silk_name', 'Silk') }}
                                        </h6>
                                    </div>
                                    <div class="card-body">
                                        <h6 class="card-subtitle mb-2 text-muted">
                                            {{ __('donations.stripe.pay-text', [
                                                'price' => $data->price,
                                                'currency' => $method->currency,
                                                'amount' => $data->silk,
                                                'silk_name' => config('siteSettings.sro_silk_name', 'Silk')
                                            ]) }}
                                        </h6>
                                        <p class="card-text">
                                            {{ $data->description }}
                                        </p>
                                        <a class="btn btn-primary card-link"
                                           href="{{ route('donate-stripe', ['id' => $data->id]) }}">
                                            <i class="fab fa-stripe-s"></i> {{ __('donations.stripe.submit') }}
                                        </a>
                                    </div>
                                </div>

                            </div>
                        @empty
                            {{ __('donations.stripe.empty') }}
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
