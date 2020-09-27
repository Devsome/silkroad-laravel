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
                        {{ __('donations.paypal.title') }}
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

                    @if($invoices->count() > 0)
                        <p class="font-weight-bold">
                            {{ __('donations.paypal.pending') }}
                        </p>
                        <ul class="list-group pb-4">
                        @foreach($invoices as $data)
                                <li class="list-group-item">
                                    {{ $data->name }}<span class="float-right">[{{ $data->created_at->diffForHumans() }}]</span>
                                </li>
                        @endforeach
                        </ul>
                    @endif

                    <div class="row">
                    @forelse($paypal as $data)
                            <div class="col-lg-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <h6 class="m-0 font-weight-bold">
                                            {{ $data->silk }} {{ config('siteSettings.sro_silk_name', 'Silk') }}
                                        </h6>
                                    </div>
                                    <div class="card-body">
                                        <h6 class="card-subtitle mb-2 text-muted">
                                            {{ __('donations.paypal.pay-text', [
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
                                           href="{{ route('donate-paypal', ['id' => $data->id]) }}">
                                            <i class="fa fa-paypal"></i> {{ __('donations.paypal.submit') }}
                                        </a>
                                    </div>
                                </div>

                            </div>
                        @empty
                        {{ __('donations.paypal.empty') }}
                    @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
