@extends('theme::backend.layouts.app')

@section('theme::backend-content')
    @include('theme::backend.layouts.navbar')

    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">
                {{ __('backend/voteforsilk.edit.title') }}
            </h1>
        </div>
        <div class="row">
            <div class="col-12">
                @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ $message }}</strong>
                    </div>
                @endif
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">
                            {{ __('backend/voteforsilk.edit.title-help', ['name' => $data->name]) }}
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="container">
                            <form method="POST" action="{{ route('vote-edit-submit-backend', ['id' => $data->id]) }}" class="form">
                                @method('POST')
                                @csrf
                                <div class="form-group row">
                                    <div class="col-6">
                                    <label for="name" class="col-form-label">
                                        {{ __('backend/voteforsilk.table.name') }}
                                    </label>
                                    <input type="text"
                                           class="form-control col-12 {{ $errors->has('name') ? ' is-invalid' : '' }}"
                                           id="name" name="name"
                                           value="{{ $data->name ?? Request::old('name') }}">
                                    <small class="form-text text-muted">
                                        {{ __('backend/voteforsilk.table.name-help') }}
                                    </small>
                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                    </div>
                                    <div class="col-6">
                                        <label for="reward" class="col-form-label">
                                            {{ __('backend/voteforsilk.table.reward') }}
                                        </label>
                                        <input type="number"
                                               class="form-control col-12 {{ $errors->has('reward') ? ' is-invalid' : '' }}"
                                               id="reward" name="reward"
                                               value="{{ $data->reward ?? Request::old('reward') }}">
                                        <small class="form-text text-muted">
                                            {{ __('backend/voteforsilk.table.reward-help') }}
                                        </small>
                                        @if ($errors->has('reward'))
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('reward') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-6">
                                        <label for="pingback" class="col-form-label">
                                            {{ __('backend/voteforsilk.table.pingback') }}
                                        </label>
                                        <input type="text"
                                               class="form-control col-12 {{ $errors->has('pingback') ? ' is-invalid' : '' }}"
                                               id="pingback" name="pingback"
                                               value="{{ $data->pingback ?? Request::old('pingback') }}">
                                        <small class="form-text text-muted">
                                            {{ __('backend/voteforsilk.table.pingback-help') }}
                                        </small>
                                        <small class="text-warning">
                                            {{ __('backend/voteforsilk.table.pingback-info') }}
                                        </small>
                                        @if ($errors->has('pingback'))
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('pingback') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="col-6">
                                        <label for="waiting_hours" class="col-form-label">
                                            {{ __('backend/voteforsilk.table.waiting') }}
                                        </label>
                                        <input type="number"
                                               class="form-control col-12 {{ $errors->has('waiting_hours') ? ' is-invalid' : '' }}"
                                               id="waiting_hours" name="waiting_hours"
                                               value="{{ $data->waiting_hours ?? Request::old('waiting_hours') }}">
                                        <small class="form-text text-muted">
                                            {{ __('backend/voteforsilk.table.waiting-help') }}
                                        </small>
                                        @if ($errors->has('waiting_hours'))
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('waiting_hours') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>


                                <div class="form-row">
                                    <div class="form-group col-12">
                                        <input class="btn btn-primary" type="submit"
                                               value="{{ __('backend/voteforsilk.edit.submit') }}">
                                        <a href="{{ route('vote-for-silk-index-backend') }}" class="ml-2 btn btn-secondary">
                                            {{ __('backend/voteforsilk.edit.back') }}
                                        </a>
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
