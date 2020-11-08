@extends('theme::layouts.app', ['alias' => 'FAQ'])

@section('theme::title', __('seo.faq'))

@section('theme::content')
    <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12 d-none d-lg-block">
        @forelse($faqs as $faq)
            <div class="card">
                <div class="card-header">
                    <span>{{ $faq->title }}</span>
                </div>
                <div class="card-body">
                    {!! $faq->body !!}
                </div>
            </div>
        @empty
            <div class="card">
                <div class="card-header">
                    <span>{{ __('faq.title') }}</span>
                </div>
                <div class="card-body">
                    {{ __('faq.empty') }}
                </div>
            </div>
        @endforelse
    </div>
@endsection
