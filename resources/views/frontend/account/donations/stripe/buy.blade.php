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
                                <form action="{{ route('donate-stripe-post', ['id' => $stripe->id]) }}"
                                      method="post" id="payment-form">
                                    @csrf
                                    <p>
                                        {{ __('donations.stripe.buy.info-body', [
                                            'silk' => $stripe->silk,
                                            'amount' => $stripe->price,
                                            'currency' => $method->currency
                                        ]) }}
                                    </p>
                                    <div>
                                        <label>
                                            {{ __('donations.stripe.buy.card-holder') }}
                                        </label>
                                        <input id="cardholder-name" class="form-control mb-4" type="text">
                                        <div id="card-element" class="form-control"></div>

                                        <div id="card-errors" role="alert"></div>
                                    </div>
                                    <div class="d-flex flex-row mt-4 justify-content-end align-items-center">
                                        <button id="card-button" class="btn btn-primary">
                                            {{ __('donations.stripe.buy.submit') }}
                                        </button>
                                    </div>
                                    <input type="hidden" name="paymentMethodId" id="paymentMethodId">
                                </form>
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
            const stripe = Stripe('{{ config('stripe.public-key') }}');
            const elements = stripe.elements();

            const style = {
                base: {
                    color: '#32325d',
                    lineHeight: '1.8rem'
                }
            };

            let cardElement = elements.create('card', {style: style});
            cardElement.mount('#card-element');

            let cardholderName = document.getElementById('cardholder-name');
            let cardButton = document.getElementById('card-button');
            let paymentMethodIdField = document.getElementById('paymentMethodId');
            let myForm = document.getElementById('payment-form');

            cardButton.addEventListener('click', function (ev) {
                ev.preventDefault();
                cardButton.disabled = true;

                stripe.createPaymentMethod('card', cardElement, {
                    billing_details: {name: cardholderName.value}
                }).then(function (result) {

                    if (result.error) {
                        cardButton.disabled = false;
                        alert(result.error.message);
                    } else {
                        paymentMethodIdField.value = result.paymentMethod.id;
                        myForm.submit();
                    }
                });
            });
        });
    </script>
@endpush
