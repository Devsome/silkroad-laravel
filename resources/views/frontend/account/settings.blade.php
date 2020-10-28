@extends('theme::layouts.app')
@section('theme::title', __('seo.settings'))
@section('theme::sidebar')
    @include('theme::frontend.account.sidebar')
@endsection

@section('theme::content')
    <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <h1>
                        {{ __('home.settings.title') }}
                    </h1>
                </div>
                <div class="col-md-12">
                    @if(session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session()->get('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <form method="POST" action="{{ route('home-settings-update') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="name" class="col-sm-4 col-form-label">
                                {{ __('home.settings.form.name') }}
                            </label>
                            <div class="col-sm-8">
                                <input type="text"
                                       class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}"
                                       id="name" name="name"
                                       value="{{ $account->name }}" >
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-sm-4 col-form-label">
                                {{ __('home.settings.form.email') }}
                            </label>
                            <div class="col-sm-8">
                                <input type="email"
                                       class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}"
                                       id="email" name="email"
                                       value="{{ $account->email }}" >
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row pt-2">
                            <label for="show_map" class="col-sm-4 col-form-label">
                                {{ __('home.settings.form.map') }}
                            </label>
                            <div class="col-sm-8">
                                <div class="d-flex flex-wrap justify-content-between align-items-center">
                                    <div class="custom-control custom-checkbox d-block pt-2">
                                        <input class="custom-control-input" type="checkbox"
                                               id="show_map" name="show_map"
                                               @if($account->show_map === 1) checked @endif>
                                        <label class="custom-control-label" for="show_map">
                                            {{ __('home.settings.form.show-map') }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="referral" class="col-sm-4 col-form-label">
                                {{ __('home.settings.form.referral') }}
                            </label>
                            <div class="col-sm-8">
                                <input type="text" readonly class="form-control-plaintext" id="referral"
                                       value="{{ $account->reflink }}">
                            </div>
                        </div>
                        <div class="form-group row pt-4">
                            <label for="sro_password" class="col-sm-4 col-form-label">
                                {{ __('home.settings.form.silkroad-password') }}
                            </label>
                            <div class="col-sm-8">
                                <input type="password"
                                       class="form-control {{ $errors->has('sro_password') ? ' is-invalid' : '' }}"
                                       id="sro_password" name="sro_password"
                                       placeholder="">
                                @if ($errors->has('sro_password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('sro_password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="sro_password_confirmation" class="col-sm-4 col-form-label">
                                {{ __('home.settings.form.silkroad-password-confirmation') }}
                            </label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control" id="sro_password_confirmation"
                                       name="sro_password_confirmation" placeholder="">
                            </div>
                        </div>

                        <div class="form-group row pt-4">
                            <label for="web_password" class="col-sm-4 col-form-label">
                                {{ __('home.settings.form.web-password') }}
                            </label>
                            <div class="col-sm-8">
                                <input type="password"
                                       class="form-control {{ $errors->has('web_password') ? ' is-invalid' : '' }}"
                                       id="web_password" name="web_password"
                                       placeholder="">
                                @if ($errors->has('web_password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('web_password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row pb-4">
                            <label for="web_password_confirmation" class="col-sm-4 col-form-label">
                                {{ __('home.settings.form.web-password-confirmation') }}
                            </label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control" id="web_password_confirmation"
                                       name="web_password_confirmation" placeholder="">
                            </div>
                        </div>

                        <hr class="mt-2 mb-3">

                        <div class="form-group row">
                            <label for="current_web_password" class="col-sm-4 col-form-label">
                                {{ __('home.settings.form.current-web-password') }}
                            </label>
                            <div class="col-sm-8">
                                <input type="password"
                                       class="form-control {{ $errors->has('current_web_password') ? ' is-invalid' : '' }}"
                                       id="current_web_password" name="current_web_password" placeholder="">
                                <small id="current_web_passwordHelp" class="form-text text-muted">
                                    {{ __('home.settings.form.current-web-password-help') }}
                                </small>
                                @if ($errors->has('current_web_password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('current_web_password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="col-12 pb-5">
                            <hr class="mt-2 mb-3">
                            <div class="d-flex flex-wrap float-right">
                                <button class="btn btn-style-1 btn-primary float-right" type="submit">
                                    {{ __('home.settings.form.submit') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
