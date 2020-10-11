@extends('backend.layouts.app')

@section('backend-content')
    @include('backend.layouts.navbar')

    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">
                {{ __('backend/rules.title-create') }}
            </h1>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">
                            {{ __('backend/rules.create') }}
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
                            <form method="POST" action="{{ route('server-rules-update-backend', ['id' => $rules->id]) }}" class="form"
                                  enctype="multipart/form-data">
                                @method('POST')
                                @csrf
                                <div class="form-row">
                                    <div class="form-group col-12">
                                        <label for="body" class="col-form-label">{{ __('backend/rules.body') }}</label>
                                        <textarea class="form-control{{ $errors->has('body') ? ' is-invalid' : '' }}"
                                                  name="body" id="body" rows="6">{{ $rules->body }}</textarea>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-12">
                                        <input class="btn btn-primary" type="submit"
                                               value="{{ __('backend/rules.submit') }}">
                                        <a href="{{ route('server-rules-index-backend') }}" class="ml-2 btn btn-secondary">
                                            {{ __('backend/rules.back') }}
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
@push('javascript')
    <script>
        $(document).ready(function () {
            $('#body').summernote({
                placeholder: '{{ __('backend/rules.body-placeholder') }}',
                tabsize: 2,
                height: 150
            });
        });
    </script>
@endpush
