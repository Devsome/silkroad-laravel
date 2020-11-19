@extends('theme::layouts.app', ['alias' => 'Account'])
@section('theme::title', __('seo.tickets.new'))
@section('theme::sidebar')
    @include('theme::frontend.account.sidebar', ['account_alias'=>'Tickets'])
@endsection

@section('theme::content')
    <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <h1>
                        {{ __('home.tickets.new.title') }}
                    </h1>

                    <div class="col-md-12">
                        <form method="POST" action="{{ route('home-tickets-new-submit') }}">
                            @csrf
                            <div class="form-group row">
                                <label for="title" class="col-sm-4 col-form-label">
                                    {{ __('home.tickets.new.form.title') }}
                                </label>
                                <div class="col-sm-8">
                                    <input type="text"
                                           class="form-control {{ $errors->has('title') ? ' is-invalid' : '' }}"
                                           id="title" name="title" value="{{ old('title') }}">
                                    @if ($errors->has('title'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="category" class="col-sm-4 col-form-label">
                                    {{ __('home.tickets.new.form.category') }}
                                </label>
                                <div class="col-sm-8">
                                    <select class="form-control {{ $errors->has('category') ? ' is-invalid' : '' }}"
                                            id="category" name="category">
                                        @forelse($ticketCategories as $categories)
                                            <option value="{{ $categories->id }}">{{ $categories->name }}</option>
                                        @empty
                                            <option value="0">{{ __('home.tickets.new.form.no-categories') }}</option>
                                        @endforelse
                                    </select>
                                    @if ($errors->has('category'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('category') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="prioritys" class="col-sm-4 col-form-label">
                                    {{ __('home.tickets.new.form.priority') }}
                                </label>
                                <div class="col-sm-8">
                                    <select class="form-control {{ $errors->has('category') ? ' is-invalid' : '' }}"
                                            id="prioritys" name="prioritys">
                                        @forelse($ticketPrioritys as $prioritys)
                                            <option value="{{ $prioritys->id }}">{{ $prioritys->name }}</option>
                                        @empty
                                            <option value="0">{{ __('home.tickets.new.form.no-priorities') }}</option>
                                        @endforelse
                                    </select>
                                    @if ($errors->has('prioritys'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('prioritys') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <hr class="mt-2 mb-3">

                            <div class="form-group row">
                                <label for="body" class="col-sm-4 col-form-label">
                                    {{ __('home.tickets.new.form.body') }}
                                </label>
                                <div class="col-sm-8">
                                    <textarea class="form-control {{ $errors->has('body') ? ' is-invalid' : '' }}"
                                              id="body" name="body" rows="5"
                                              placeholder="{{ __('home.tickets.new.form.body-placeholder') }}">{{ old('body') }}</textarea>
                                    @if ($errors->has('body'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('body') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-12 pb-5">
                                <hr class="mt-2 mb-3">
                                <div class="d-flex flex-wrap float-right">
                                    <button class="btn btn-style-1 btn-primary float-right" type="submit">
                                        {{ __('home.tickets.new.form.submit') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
