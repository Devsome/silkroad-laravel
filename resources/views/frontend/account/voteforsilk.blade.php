@extends('theme::layouts.app')
@section('theme::title', __('seo.voteforsilk'))
@section('theme::sidebar')
    @include('theme::frontend.account.sidebar')
@endsection

@section('theme::content')
    <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
        <div class="container">
            <div class="row">
                <h1 class="col-md-12">
                    {{ __('home.voteforsilk.title') }}
                </h1>
                @forelse($data as $vote)
                    @if($vote->active === 1)
                        <div class="col-6 col-md-6 col-sm-12 col-xs-12">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        {{ $vote->name }}
                                    </h5>
                                    <p class="card-text">
                                        <span class="row">
                                            <span class="col-12">
                                               {{ __('home.voteforsilk.reward', [
                                                    'reward' => $vote->reward
                                                ]) }}
                                            </span>
                                            <span class="col-12 mt-2">
                                                @if(!$vote->getVoted || \Carbon\Carbon::create($vote->getVoted->vote_again_at)->isPast())
                                                    <a class="btn btn-primary" target="_blank" rel="noopener noreferrer"
                                                       href="{{ route('vote-for-silk-voting', ['id' => $vote->id]) }}">
                                                        {{ __('home.voteforsilk.submit') }}
                                                    </a>
                                                @else
                                                    <button class="btn btn-primary" disabled>
                                                        {{ __('home.voteforsilk.wait', [
                                                            'time' => \Carbon\Carbon::create(
                                                            $vote->getVoted->vote_again_at
                                                            )->diffInMinutes()
                                                        ]) }}
                                                    </button>
                                                @endif
                                            </span>
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endif
                @empty
                    {{ __('home.voteforsilk.empty') }}
                @endforelse
            </div>
        </div>
    </div>
@endsection
@push('theme::javascript')
    <script>
        $(document).ready(function () {

        });
    </script>
@endpush
