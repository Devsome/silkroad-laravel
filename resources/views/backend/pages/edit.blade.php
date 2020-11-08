@extends('theme::backend.layouts.app')

@section('theme::backend-content')
    @include('theme::backend.layouts.navbar')

    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">
                {{ __('backend/serverinformation.edit-title') }}
            </h1>
        </div>
        <div class="row">
            <div class="ml-auto mr-3">
                <a href="{{ route('pages.index') }}" type="button" class="btn btn-secondary">
                    {{ __('backend/pages.back') }}
                </a>
            </div>
            <div class="container">
                @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ $message }}</strong>
                    </div>
                @endif

                <form method="POST"
                      action="{{ route('pages.update', $page->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="form-group row">
                        <div class="col-6">
                            <label for="title"
                                   class="col-form-label">{{ __('backend/serverinformation.form.title') }}</label>
                            <input type="text"
                                   class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}"
                                   name="title" id="title" autocomplete="off"
                                   aria-describedby="titleHelp" value="{{ old('title') ?: $page->title }}">
                            <small id="titleHelp"
                                   class="form-text text-muted">{{ __('backend/serverinformation.form.title-help') }}</small>
                        </div>
                        <div class="col-6">
                            <label for="type" class="col-form-label">{{ __('backend/pages.form.type') }}</label>
                            <select name="type" id="type"
                                    class="form-control{{ $errors->has('type') ? ' is-invalid' : '' }}">
                                <optgroup label="Select Type">
                                    <option @if(old('type') === 'styles') selected
                                            @elseif($page->type === 'styles') selected
                                            @endif value="styles">{{__('backend/pages.enum.styles')}}</option>
                                    <option @if(old('type') === 'faq') selected
                                            @elseif($page->type === 'faq') selected
                                            @endif value="faq">{{__('backend/pages.enum.faq')}}</option>
                                    <option @if(old('type') === 'event') selected
                                            @elseif($page->type === 'event') selected
                                            @endif value="event">{{__('backend/pages.enum.event')}}</option>
                                </optgroup>
                            </select>
                            <small id="typeHelper"
                                   class="form-text text-muted">{{ __('backend/pages.form.type-help') }}</small>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-12">
                            <label for="body"
                                   class="col-form-label">{{ __('backend/serverinformation.form.body') }}</label>
                            <textarea class="form-control{{ $errors->has('body') ? ' is-invalid' : '' }}"
                                      name="body" id="body" rows="10">{{ old('body') ?: $page->body }}</textarea>
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
@push('theme::javascript')
    <script>
        $(document).ready(function () {
            $('#body').summernote({
                placeholder: '{{ __('backend/serverinformation.form.body-placeholder') }}',
                tabsize: 2,
                height: 200,
            });
        });
    </script>
@endpush
