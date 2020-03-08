@extends('layouts.app')

@section('content')
    <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <h1>{{ __('news.title') }}</h1>
                    <div class="posts-container mx-auto px-3 py-5">
                        @forelse($archive as $key => $newsGroup)
                            <div class="list-group mb-4">
                            <h3 class="pl-2">{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$newsGroup[$loop->index]->published_at)->format('Y-m') }}</h3>
                                @foreach($newsGroup as $news)
                                    <a href="{{ route('news-slug', ['slug' => $news->slug]) }}"
                                       class="list-group-item list-group-item-action flex-column align-items-start">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h5 class="mb-1">{{ $news->title }}</h5>
                                            <small class="d-none d-sm-block">
                                                {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$news->published_at)->format('Y-m-d') }}
                                            </small>
                                        </div>
                                        <small>
                                            {{ \Illuminate\Support\Str::words(strip_tags($news->body), 15, $end='...') }}
                                        </small>
                                    </a>
                                @endforeach
                            </div>
                        @empty
                            {{ __('news.no-news') }}
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
