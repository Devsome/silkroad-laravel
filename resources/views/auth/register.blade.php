@extends('layouts.app')

@section('content')
    <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">{{ __('Register') }}</div>

                        <div class="card-body">
                            <form method="POST" action="{{ route('register') }}">
                                @csrf

                                <div class="form-group row">
                                    <label for="name"
                                           class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                    <div class="col-md-6">
                                        <input id="name" type="text"
                                               class="form-control @error('name') is-invalid @enderror" name="name"
                                               value="{{ old('name') }}" required autocomplete="name" autofocus>

                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="silkroad_id"
                                           class="col-md-4 col-form-label text-md-right">{{ __('Silkroad Id') }}</label>

                                    <div class="col-md-6">
                                        <input id="silkroad_id" type="text"
                                               class="form-control @error('silkroad_id') is-invalid @enderror"
                                               name="silkroad_id" value="{{ old('silkroad_id') }}" required
                                               autocomplete="off" autofocus>

                                        @error('silkroad_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="email"
                                           class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                    <div class="col-md-6">
                                        <input id="email" type="email"
                                               class="form-control @error('email') is-invalid @enderror" name="email"
                                               value="{{ old('email') }}" required autocomplete="email">

                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row pt-4">
                                    <label for="web_password"
                                           class="col-md-4 col-form-label text-md-right">{{ __('Web Password') }}</label>

                                    <div class="col-md-6">
                                        <input id="web_password" type="password"
                                               class="form-control @error('web_password') is-invalid @enderror"
                                               name="web_password" required autocomplete="new-password">

                                        @error('web_password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="web_password-confirm"
                                           class="col-md-4 col-form-label text-md-right">{{ __('Web confirm Password') }}</label>

                                    <div class="col-md-6">
                                        <input id="web_password-confirm" type="password" class="form-control"
                                               name="web_password_confirmation" required autocomplete="new-password">
                                    </div>
                                </div>

                                <div class="form-group row pt-4">
                                    <label for="sro_password"
                                           class="col-md-4 col-form-label text-md-right">{{ __('Game Password') }}</label>

                                    <div class="col-md-6">
                                        <input id="sro_password" type="password"
                                               class="form-control @error('sro_password') is-invalid @enderror"
                                               name="sro_password" required autocomplete="new-password">

                                        @error('sro_password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="sro_password-confirm"
                                           class="col-md-4 col-form-label text-md-right">{{ __('Game confirm Password') }}</label>

                                    <div class="col-md-6">
                                        <input id="sro_password-confirm" type="password" class="form-control"
                                               name="sro_password_confirmation" required autocomplete="new-password">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-8 offset-md-4">
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input{{ $errors->has('rules') ? ' is-invalid' : '' }}"
                                                   type="checkbox" name="rules"
                                                   id="rules" {{ old('rules') ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="rules">
                                                <a href="#">{{ __('auth.accept') }}</a>
                                            </label>
                                            @if ($errors->has('rules'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('rules') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Register') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
