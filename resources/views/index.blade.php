@extends('layouts.app')

@section('content')
    <div class="col-md-9 col-sm-12">
        <div class="card">
            <div class="card-body">
                @forelse($news as $newsData)
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card-body">
                                <div class="news-content">
                                    <a href="{{ url('/news', $newsData->slug) }}"><h3>{{ $newsData->title }}</h3>
                                    </a>
                                    <p class="small">
                                        {!! \Illuminate\Support\Str::words(strip_tags($newsData->body), 25, $end='...') !!}
                                    </p>
                                </div>
                                <div class="news-footer">
                                    <div class="news-author">
                                        <ul class="list-inline list-unstyled">
                                            <li class="list-inline-item text-secondary">
                                                <i class="fa fa-calendar-day"></i>
                                                {{ $newsData->published_at->format('Y-m-d') }}
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    Still no news written.
                @endforelse
            </div>
        </div>
    </div>
@endsection
