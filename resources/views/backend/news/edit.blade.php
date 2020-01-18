@extends('backend.layouts.app')

@section('backend-content')
    @include('backend.layouts.navbar')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">{{ __('backend/news.title-edit') }}</h1>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">{{ __('backend/news.edit') }}</h6>
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
                        <form method="POST" action="{{ route('backend-news.news.update', ['news' => $news->id]) }}">
                            @method('PUT')
                            @csrf
                            <div class="form-group row">
                                <div class="col-6">
                                    <label for="title"
                                           class="col-form-label">{{ __('backend/news.form.title') }}</label>
                                    <input type="text" class="form-control" name="title" id="title"
                                           aria-describedby="titleHelp" value="{{ $news->title }}">
                                </div>
                                <div class="col-6">
                                    <label for="slug"
                                           class="col-form-label">{{ __('backend/news.form.slug') }}</label>
                                    <input type="text" class="form-control" name="slug" id="slug"
                                           aria-describedby="slugHelper"
                                           placeholder=""
                                           value="{{ $news->slug }}">
                                    <small id="slugHelper"
                                           class="form-text text-muted">{{ __('backend/news.form.slug-help') }}</small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12">
                                    <label for="body" class="col-form-label">{{ __('backend/news.form.body') }}</label>
                                    <textarea class="form-control" name="body" id="body"
                                              rows="4">{{ $news->body }}</textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-3">
                                    <label for="published_at"
                                           class="col-form-label">{{ __('backend/news.form.published_at') }}</label>
                                    <input class="form-control" type="datetime-local"
                                           value="{{ old('published_at', Carbon\Carbon::parse($news->published_at)->format('Y-m-d\TH:i:s') ) }}"
                                           id="published_at" name="published_at">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-3">
                                    <label for="image_id"
                                           class="col-form-label">{{ __('backend/news.form.image-id') }}</label>
                                        <small id="image_idHelper"
                                               class="form-text text-muted">{{ __('backend/news.form.image-empty') }}</small>
                                    <select class="form-control" name="image_id" id="image_id">
                                        @foreach($images as $image)
                                            @if($image->id === $news->image_id)
                                                <option value="{{ $image->id }}"
                                                        data-href="{{ asset('storage/web/images/' . $image->filename )}}"
                                                        selected="selected">{{ $image->filename }}</option>
                                            @else
                                                <option value="{{ $image->id }}"
                                                        data-href="{{ asset('storage/web/images/' . $image->filename )}}">{{ $image->original_filename }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-3">
                                    <img src="" id="previewNewsImage" width="200px"/>
                                </div>
                            </div>

                            <input class="btn btn-primary" type="submit" value="{{ __('backend/news.submit') }}">
                        </form>
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
            $( "#image_id" ).change(function() {
                const image = $(this).find(':selected').attr('data-href');
                $('#previewNewsImage').attr('src', image);
                showHide(image);
            });
            function showHide(image) {
                if (image) {
                    $('#previewNewsImage').show();
                } else {
                    $('#previewNewsImage').hide();
                }
            }
            showHide(image);
            $('#previewNewsImage').attr('src', $(this).find(':selected').attr('data-href'));

            $('#body').summernote({
                placeholder: '{{ __('backend/news.form.body-placeholder') }}',
                tabsize: 2,
                height: 150
            });
        });
    </script>
@endpush
