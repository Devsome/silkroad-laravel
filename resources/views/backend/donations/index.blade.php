@extends('theme::backend.layouts.app')

@section('theme::backend-content')
    @include('theme::backend.layouts.navbar')

    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">{{ __('backend/donations.title') }}</h1>
        </div>
        <div class="container">

            @if(session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session()->get('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <span class="font-weight-bold">
                {{ __('backend/donations.methods.title') }}
            </span>
            <form method="POST" action="{{ route('donations-update-methods-backend') }}">
                @csrf
                @foreach($donationMethods as $method)
                    <div class="form-group row pt-2">
                        <label class="col-sm-4 col-form-label">
                            {{ $method->name }}
                        </label>
                        <div class="col-sm-4">
                            <div class="d-flex flex-wrap justify-content-between align-items-center">
                                <div class="custom-control custom-checkbox d-block pt-2">
                                    <input class="custom-control-input {{ $errors->has($method->id) ? ' is-invalid' : '' }}"
                                           type="checkbox" id="{{ $method->id }}" name="{{ $method->id }}"
                                           @if($method->active) checked @endif>
                                    <label class="custom-control-label" for="{{ $method->id }}">
                                        {{ __('backend/donations.methods.activate') }}
                                    </label>
                                    @if ($errors->has($method->id))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first($method->id) }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <img src="{{ asset('/image/donations/' . $method->image) }}"
                                 class="img-fluid" alt="{{ $method->name }}">
                        </div>
                    </div>
                @endforeach
                <div class="col-12 pb-5">
                    <hr class="mt-2 mb-3">
                    <div class="d-flex flex-wrap float-left">
                        <button class="btn btn-style-1 btn-primary float-left" type="submit">
                            {{ __('backend/donations.methods.submit') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
