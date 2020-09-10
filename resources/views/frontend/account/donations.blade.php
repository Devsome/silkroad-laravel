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
                    @if(Route::has('dev.payop.index'))
                        <a href="{{ route('dev.payop.index') }}">
                            Payop
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
