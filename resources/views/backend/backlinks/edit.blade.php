@extends('theme::backend.layouts.app')

@section('theme::backend-content')
    @include('theme::backend.layouts.navbar')

    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">
                {{ __('backend/backlinks.title-edit') }}
            </h1>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">
                            {{ __('backend/backlinks.edit') }}
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
                            <form method="POST" action="{{ route('backlinks-update-backend', ['backlink' => $backlink->id]) }}">
                                @method('PATCH')
                                @csrf
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-6">
                                            <label for="name">{{ __('backend/backlinks.name') }}</label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                                   aria-describedby="nameHelp" name="name"
                                                   value="{{ $backlink->name }}">
                                            <small id="nameHelp" class="form-text text-muted">
                                                {{ __('backend/backlinks.name-help') }}
                                            </small>
                                            @if($errors->has('name'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('name') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-6">
                                        <div class="form-group">
                                            <label for="url">{{ __('backend/backlinks.url') }}</label>
                                            <input type="text" class="form-control @error('url') is-invalid @enderror"
                                                   id="url" aria-describedby="urlHelp" name="url"
                                                   value="{{ $backlink->url }}">
                                            <small id="linkHelp" class="form-text text-muted">
                                                {{ __('backend/backlinks.url-help') }}
                                            </small>
                                            @if($errors->has('url'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('url') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-3">
                                        <label for="image_id"
                                               class="col-form-label">{{ __('backend/backlinks.image') }}</label>
                                        <small id="image_idHelper"
                                               class="form-text text-muted">{{ __('backend/news.form.image-empty') }}</small>
                                        <select class="form-control" name="image_id" id="image_id">
                                            <option value="">
                                                {{ __('backend/backlinks.image-select-empty') }}
                                            </option>
                                            @foreach($images as $image)
                                                @if($image->id === $backlink->image_id)
                                                    <option value="{{ $image->id }}"
                                                            data-href="{{ asset('storage/web/images/' . $image->filename )}}"
                                                            selected="selected">{{ $image->original_filename }}</option>
                                                @else
                                                    <option value="{{ $image->id }}"
                                                            data-href="{{ asset('storage/web/images/' . $image->filename )}}">
                                                        {{ $image->original_filename }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-3">
                                        <img src="" id="previewBacklinksImage" width="200px"/>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-12">
                                        <input class="btn btn-primary" type="submit" value="{{ __('backend/backlinks.edit-submit') }}">
                                        <a href="{{ route('backlinks-index-backend') }}" class="ml-2 btn btn-secondary">
                                            {{ __('backend/backlinks.back') }}
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
@push('theme::javascript')
    <script>
        $(document).ready(function () {
            const image = $(this).find(':selected').attr('data-href');
            $( "#image_id" ).change(function() {
                const image = $(this).find(':selected').attr('data-href');
                $('#previewBacklinksImage').attr('src', image);
                showHide(image);
            });
            function showHide(image) {
                if (image) {
                    $('#previewBacklinksImage').show();
                } else {
                    $('#previewBacklinksImage').hide();
                }
            }
            showHide(image);
            $('#previewBacklinksImage').attr('src', $(this).find(':selected').attr('data-href'));

            $('#body').summernote({
                placeholder: '{{ __('backend/news.form.body-placeholder') }}',
                tabsize: 2,
                height: 150
            });
        });
    </script>
@endpush
