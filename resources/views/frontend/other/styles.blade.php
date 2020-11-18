@extends('theme::layouts.app', ['alias' => 'Styles'])

@section('theme::title', __('seo.styles'))

@section('theme::content')
    <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12 d-none d-lg-block">
        @forelse($styles as $style)
            <div class="card">
                <div class="card-header">
                    <span>{{ $style->title }}</span>
                </div>
                <div class="card-body">
                    {!! $style->body !!}
                </div>
            </div>
        @empty
            <div class="card">
                <div class="card-header">
                    <span>{{ __('styles.title') }}</span>
                </div>
                <div class="card-body">
                    {{ __('styles.empty') }}
                </div>
            </div>
        @endforelse
    </div>
@endsection
