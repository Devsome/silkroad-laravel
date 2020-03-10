@extends('layouts.app')

@section('content')
    <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <h1>{{ __('downloads.title') }}</h1>
                    <div class="row">
                        @forelse($downloads as $download)
                            <div class="col-md-4">
                                <div class="card download-card">
                                    <img src="{{ Storage::disk('images')->url($download->image->filename) }}" class="card-img-top"
                                         alt="{{ $download->name }}">
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            {{ $download->name }}
                                        </h5>
                                        <p class="card-text">
                                            {{ $download->file_size }}
                                        </p>
                                        <a href="{{ $download->link }}" target="_blank"
                                           class="btn btn-sm btn-primary">
                                            {{ __('downloads.download-button') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @empty
                            {{ __('download.no-downloads') }}
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
