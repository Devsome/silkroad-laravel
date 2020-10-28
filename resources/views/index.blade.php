@extends('theme::layouts.app')
@section('theme::title', __('seo.index'))
@section('theme::content')
    <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12 news-container">
        <div class="latest-news container-fluid">
            <div class="container">
                <div class="row">
                    <div class="col-sm-8">
                        <div class="row-title">
                            {{ __('index.latest-news') }}
                        </div>
                    </div>
                    @if($news->count() > 4)
                    <div class="col-sm-4">
                        <div class="main-btn-holder">
                            <a href="{{ route('news-archive') }}" class="hbtn hbtn-default">
                                {{ __('index.show-all') }}
                            </a>
                        </div>
                    </div>
                    @endif
                </div>
                <div class="row">
                    @forelse($news as $newsData)
                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                            <div class="post-box"
                                 style="background-image: url('{{ Storage::disk('images')->url($newsData->image->filename) }}');">
                                <div class="post-link">
                                    <a href="{{ route('news-slug', ['slug' => $newsData->slug]) }}">
                                        {{ $newsData->title }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
