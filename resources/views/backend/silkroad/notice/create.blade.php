@extends('theme::backend.layouts.app')

@section('theme::backend-content')
    @include('theme::backend.layouts.navbar')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">{{ __('backend/notice.title-create') }}</h1>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">{{ __('backend/notice.create') }}</h6>
                    </div>
                    <div class="card-body">
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <strong>{{ __('backend/notification.form-submit.error-title') }}</strong>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success alert-block">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong>{{ $message }}</strong>
                            </div>
                        @endif
                        <form method="POST" action="{{ route('sro-notice-save-backend') }}">
                            @csrf
                            <div class="form-group row">
                                <div class="col-6">
                                    <label for="title"
                                           class="col-form-label">{{ __('backend/notice.form.title') }}</label>
                                    <input type="text"
                                           class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}"
                                           name="title" id="title"
                                           aria-describedby="titleHelp" value="{{ old('title') }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12">
                                    <label for="body" class="col-form-label">{{ __('backend/notice.form.body') }}</label>
                                    <textarea class="form-control{{ $errors->has('body') ? ' is-invalid' : '' }}"
                                              name="body" id="body" rows="6">{{ old('body') }}</textarea>
                                </div>
                            </div>
                            <input class="btn btn-primary" type="submit" value="{{ __('backend/notice.submit') }}">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('theme::javascript')
    <script>
        $(document).ready(function () {
            $('#body').summernote({
                placeholder: '{{ __('backend/notice.form.body-placeholder') }}',
                tabsize: 2,
                height: 250,
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['insert', ['link']],
                ]
            });
        });
    </script>
@endpush
