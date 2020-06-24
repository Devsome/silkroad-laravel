@extends('backend.layouts.app')

@section('backend-content')
    @include('backend.layouts.navbar')

    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">
                {{ __('backend/serverinformation.edit-title') }}
            </h1>
        </div>
        <div class="row">
            <div class="ml-auto mr-3">
                <a href="{{ route('server-information-index-backend') }}" type="button" class="btn btn-secondary">
                    {{ __('backend/serverinformation.back') }}
                </a>
            </div>
            <div class="container">
                @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ $message }}</strong>
                    </div>
                @endif

                <form method="POST" action="{{ route('server-information-update-backend', ['id' => $information->id]) }}">
                    @csrf

                    <div class="form-group row">
                        <div class="col-6">
                            <label for="title"
                                   class="col-form-label">{{ __('backend/serverinformation.form.title') }}</label>
                            <input type="text"
                                   class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}"
                                   name="title" id="title" autocomplete="off"
                                   aria-describedby="titleHelp" value="{{ old('title') ?: $information->title }}">
                            <small id="titleHelp"
                                   class="form-text text-muted">{{ __('backend/serverinformation.form.title-help') }}</small>
                        </div>
                        <div class="col-6">
                            <label for="order"
                                   class="col-form-label">{{ __('backend/serverinformation.form.order') }}</label>
                            <input type="number"
                                   class="form-control{{ $errors->has('order') ? ' is-invalid' : '' }}"
                                   name="order" id="order"
                                   aria-describedby="orderHelper"
                                   placeholder=""
                                   value="{{ old('order') ?: $information->order }}">
                            <small id="orderHelper"
                                   class="form-text text-muted">{{ __('backend/serverinformation.form.order-help') }}</small>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-12">
                            <label for="body" class="col-form-label">{{ __('backend/serverinformation.form.body') }}</label>
                            <textarea class="form-control{{ $errors->has('body') ? ' is-invalid' : '' }}"
                                      name="body" id="body" rows="10">{{ old('body') ?: $information->body }}</textarea>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-12">
                            <input class="btn btn-primary" type="submit"
                                   value="{{ __('backend/serverinformation.form.update') }}">
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>
@endsection
@push('javascript')
    <script>
        $(document).ready(function () {
            $('#body').summernote({
                placeholder: '{{ __('backend/serverinformation.form.body-placeholder') }}',
                tabsize: 2,
                height: 200,
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['insert', ['video', 'hr']]
                ]
            });
        });
    </script>
@endpush
