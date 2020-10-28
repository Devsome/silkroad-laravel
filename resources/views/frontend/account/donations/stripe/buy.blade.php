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
                        {{ __('donations.stripe.buy.title') }}
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
                    <div class="card">
                        <h4 class="card-header">
                            {{ __('donations.stripe.buy.info') }}
                        </h4>
                        <div class="card-body">
                            <div class="card-text">
                                <p>
                                    {{ __('donations.stripe.buy.info-body', [
                                        'silk' => $stripe->silk,
                                        'amount' => $stripe->price,
                                        'currency' => $method->currency
                                    ]) }}
                                </p>
                                <div id="paymentResponse"></div>
                                <button class="btn btn-primary stripe-button" id="payButton">
                                    {{ __('donations.stripe.buy.submit') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('theme::javascript')
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        $(document).ready(function () {
            let buyBtn = document.getElementById('payButton');
            let responseContainer = document.getElementById('paymentResponse');

            let createCheckoutSession = function (stripe) {
                return fetch('{{ route('donate-stripe-post', ['id' => $stripe->id]) }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    body: JSON.stringify({
                        checkoutSession: 1,
                    }),
                }).then(function (result) {
                    return result.json();
                });
            };

            let handleResult = function (result) {
                if (result.error) {
                    responseContainer.innerHTML = '<p>' + result.error.message + '</p>';
                }
                buyBtn.disabled = false;
                buyBtn.textContent = 'Buy Now';
            };

            const stripe = Stripe('{{ config('stripe.public-key') }}');

            buyBtn.addEventListener('click', function (evt) {
                buyBtn.disabled = true;
                buyBtn.textContent = 'Loading ...';

                createCheckoutSession().then(function (data) {
                    if (data.sessionId) {
                        stripe.redirectToCheckout({
                            sessionId: data.sessionId,
                        }).then(handleResult);
                    } else {
                        handleResult(data);
                    }
                });
            });
        });
    </script>
@endpush
