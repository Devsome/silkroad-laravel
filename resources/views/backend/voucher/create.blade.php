@extends('backend.layouts.app')

@section('backend-content')
    @include('backend.layouts.navbar')

    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">{{ __('backend/voucher.create.title') }}</h1>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">
                            {{ __('backend/voucher.create.create') }}
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="container">
                            @if ($message = Session::get('success'))
                                <div class="alert alert-success alert-block">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    <strong>{{ $message }}</strong>
                                </div>
                            @endif
                            <form method="POST" action="{{ route('voucher-create-backend') }}" class="form"
                                  enctype="multipart/form-data">
                                @method('POST')
                                @csrf
                                <div class="form-row">
                                    <div class="form-group col-6">
                                        <div class="form-group">
                                            <label for="amount">{{ __('backend/voucher.create.amount') }}</label>
                                            <input type="number" class="form-control @error('amount') is-invalid @enderror"
                                                   id="amount"
                                                   aria-describedby="amountHelp" name="amount"
                                                   value="{{ Request::old('name') }}">
                                            <small id="amountHelp" class="form-text text-muted">
                                                {{ __('backend/voucher.create.amount-help') }}
                                            </small>
                                            @if($errors->has('amount'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('amount') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group col-6">
                                        <div class="form-group">
                                            <label for="silk">{{ __('backend/voucher.create.silk') }}</label>
                                            <input type="number" class="form-control @error('silk') is-invalid @enderror"
                                                   id="silk"
                                                   aria-describedby="silkHelp" name="silk"
                                                   value="{{ Request::old('name') }}">
                                            <small id="silkHelp" class="form-text text-muted">
                                                {{ __('backend/voucher.create.silk-help') }}
                                            </small>
                                            @if($errors->has('silk'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('silk') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-12">
                                        <input class="btn btn-sm btn-primary" type="submit"
                                               value="{{ __('backend/voucher.create.submit') }}">
                                        <a href="{{ route('voucher-index-backend') }}" class="ml-2 btn btn-sm btn-secondary">
                                            {{ __('backend/voucher.create.back') }}
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
