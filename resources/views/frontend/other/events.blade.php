@extends('theme::layouts.app', ['alias' => 'Events'])

@section('theme::title', __('seo.events'))

@section('theme::content')
    <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12 d-none d-lg-block">
        @forelse($events as $event)
            <div class="card">
                <div class="card-header">
                    <span>{{ $event->title }}</span>
                </div>
                <div class="card-body">
                    {!! $event->body !!}
                </div>
            </div>
        @empty
            <div class="card">
                <div class="card-header">
                    <span>{{ __('events.title') }}</span>
                </div>
                <div class="card-body">
                    {{ __('events.empty') }}
                </div>
            </div>
        @endforelse
    </div>
@endsection
