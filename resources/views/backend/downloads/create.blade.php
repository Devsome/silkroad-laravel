@extends('backend.layouts.app')

@section('backend-content')
    @include('backend.layouts.navbar')

    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">
                {{ __('backend/downloads.title-create') }}
            </h1>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">
                            {{ __('backend/downloads.create') }}
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
                            <form method="POST" action="{{ route('downloads-create-backend') }}" class="form"
                                  enctype="multipart/form-data">
                                @method('POST')
                                @csrf
                                <div class="form-row">
                                    <div class="form-group col-6">
                                        <div class="form-group">
                                            <label for="name">{{ __('backend/downloads.name') }}</label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                   id="name"
                                                   aria-describedby="nameHelp" name="name"
                                                   value="{{ Request::old('name') }}">
                                            <small id="nameHelp" class="form-text text-muted">
                                                {{ __('backend/downloads.name-help') }}
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
                                            <label for="link">{{ __('backend/downloads.link') }}</label>
                                            <input type="text" class="form-control @error('link') is-invalid @enderror"
                                                   id="link"
                                                   aria-describedby="linkHelp" name="link"
                                                   value="{{ Request::old('link') }}">
                                            <small id="linkHelp" class="form-text text-muted">
                                                {{ __('backend/downloads.link-help') }}
                                            </small>
                                            @if($errors->has('link'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('link') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-6">
                                        <div class="form-group">
                                            <label for="file_size">{{ __('backend/downloads.table.file-size') }}</label>
                                            <input type="text"
                                                   class="form-control @error('file_size') is-invalid @enderror"
                                                   id="file_size"
                                                   aria-describedby="fileSizeHelp" name="file_size"
                                                   value="{{ Request::old('file_size') }}">
                                            <small id="fileSizeHelp" class="form-text text-muted">
                                                {{ __('backend/downloads.size-help') }}
                                            </small>
                                            @if($errors->has('file_size'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('file_size') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-3">
                                        <label for="image_id"
                                               class="col-form-label">{{ __('backend/downloads.image-select') }}</label>
                                        <small id="image_idHelper"
                                               class="form-text text-muted">{{ __('backend/downloads.image-empty') }}</small>
                                        <select class="form-control @error('image_id') is-invalid @enderror"
                                                name="image_id" id="image_id">
                                            <option value="">
                                                {{ __('backend/downloads.image-select-empty') }}
                                            </option>
                                            @foreach($images as $image)
                                                <option value="{{ $image->id }}"
                                                        data-href="{{ asset('storage/web/images/' . $image->filename )}}">
                                                    {{ $image->original_filename }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('image_id'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('image_id') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-3">
                                        <img src="" id="previewDownloadsImage" width="200px"/>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-12">
                                        <input class="btn btn-primary" type="submit"
                                               value="{{ __('backend/downloads.submit') }}">
                                        <a href="{{ route('downloads-index-backend') }}" class="ml-2 btn btn-secondary">
                                            {{ __('backend/downloads.back') }}
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
            const image = $(this).find(':selected').attr('data-href');
            $("#image_id").change(function () {
                const image = $(this).find(':selected').attr('data-href');
                $('#previewDownloadsImage').attr('src', image);
                showHide(image);
            });

            function showHide(image) {
                if (image) {
                    $('#previewDownloadsImage').show();
                } else {
                    $('#previewDownloadsImage').hide();
                }
            }

            showHide(image);
            $('#previewDownloadsImage').attr('src', $(this).find(':selected').attr('data-href'));
        });
    </script>
@endpush
