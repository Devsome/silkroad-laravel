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
                    <h1>
                        {{ __('home.donations.title') }}
                    </h1>

                    <p>
                        {{ __('home.donations.text') }}
                    </p>

                    @if ($error = Session::get('error'))
                        <div class="row">
                            <div class="col-12">
                                <div class="alert alert-danger alert-block">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    <strong>{{ $error }}</strong>
                                </div>
                            </div>
                        </div>
                    @endif

                    <ul class="list-group list-group-flush">
                        @if(Route::has('dev.payop.index'))
                            <li class="list-group-item">
                                <span style="padding-right: 25px; max-width: 140px">
                                    <img src="{{ asset('/image/donations/payop.png') }}"
                                         class="img-fluid" alt="quixote">
                                </span>
                                <a href="{{ route('dev.payop.index') }}">
                                    {{ __('payoplang::payop.donation_payop') }}</a>
                            </li>
                        @endif

                        @forelse($donationMethods as $method)
                            <li class="list-group-item">
                                <span style="padding-right: 25px; max-width: 140px">
                                    <img src="{{ asset('/image/donations/' . $method->image) }}"
                                         class="img-fluid" alt="{{ $method->name }}">
                                </span>
                                <a href="{{ route('donations-method-index', ['method' => $method->method]) }}">
                                    {{ $method->name }}</a>
                            </li>
                        @empty
                            <li class="list-group-item">
                                {{ __('home.donations.no_methods') }}
                            </li>
                        @endforelse
                    </ul>

                </div>
            </div>
        </div>
    </div>
@endsection
