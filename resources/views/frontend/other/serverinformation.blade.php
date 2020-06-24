@extends('layouts.app')
@section('title', __('seo.serverinformation'))
@section('content')
    <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <h1>{{ __('serverinformation.title') }}</h1>
                    <div class="row">
                        <div class="col-12">
                            <div id="accordion">
                                @forelse($information as $info)
                                    <div class="card">
                                        <div class="card-header" id="heading-{{ $info->id }}">
                                            <h5 class="mb-0">
                                                <button class="btn btn-link collapsed" data-toggle="collapse"
                                                        data-target="#collapse-{{ $info->id }}" aria-expanded="false"
                                                        aria-controls="collapse-{{ $info->id }}">
                                                    {{ $info->title }}
                                                </button>
                                            </h5>
                                        </div>
                                        <div id="collapse-{{ $info->id }}" class="collapse"
                                             aria-labelledby="heading-{{ $info->id }}" data-parent="#accordion">
                                            <div class="card-body">
                                                {!! $info->body !!}
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="col-12 py-3">
                                        {{ __('serverinformation.empty') }}
                                    </div>
                                @endforelse
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
