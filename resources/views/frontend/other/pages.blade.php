@extends('theme::layouts.app', ['alias' => 'pages', 'slug'=>$slug])

@section('theme::title', __('seo.styles'))

@section('theme::content')
    <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12 d-none d-lg-block">
        @forelse($pageContent->getContent as $page)
            <div class="card mt-3">
                <div class="card-header">
                    <span>{{ $page->title }}</span>
                </div>
                <div class="card-body">
                    {!! $page->body !!}
                </div>
            </div>
        @empty
            <div class="card">
                <div class="card-header">
                    <span>{{ __('pages.title') }}</span>
                </div>
                <div class="card-body">
                    {{ __('pages.empty') }}
                </div>
            </div>
        @endforelse
    </div>
@endsection
