@extends('theme::layouts.app', ['alias' => 'Ranking'])
@section('theme::title', __('seo.ranking.index', ['name' => Str::ucfirst($mode)]))
@section('theme::content')
    <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <h1>{{ __('ranking.title') }}</h1>
                    <div class="row pb-3">
                        <div class="col-12">
                            <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                                @if(config('siteSettings.char_ranking', true))
                                    <div class="btn-group p-2" role="group"
                                         aria-label="{{ __('ranking.search.charname') }}">
                                        <a href="{{ route('ranking.char') }}"
                                           type="button"
                                           class="btn btn-outline-dark @if($mode === config('ranking.search-charname')) active @endif">
                                            {{ __('ranking.search.charname') }}
                                        </a>
                                    </div>
                                @endif
                                @if(config('siteSettings.guild_ranking', true))
                                    <div class="btn-group p-2" role="group"
                                         aria-label="{{ __('ranking.search.guild') }}">
                                        <a href="{{ route('ranking.guild') }}"
                                           type="button"
                                           class="btn btn-outline-dark @if($mode === config('ranking.search-guild')) active @endif">
                                            {{ __('ranking.search.guild') }}
                                        </a>
                                    </div>
                                @endif
                                @if(config('siteSettings.job_ranking', true))
                                    <div class="btn-group p-2" role="group"
                                         aria-label="{{ __('ranking.search.jobname') }}">
                                        <a href="{{ route('ranking.job') }}"
                                           type="button"
                                           class="btn btn-outline-dark @if($mode === config('ranking.search-job')) active @endif">
                                            {{ __('ranking.search.jobname') }}
                                        </a>
                                    </div>
                                @endif
                                @if(config('siteSettings.trader_ranking', true))
                                    <div class="btn-group p-2" role="group"
                                         aria-label="{{ __('ranking.search.trader') }}">
                                        <a href="{{ route('ranking.job.trader') }}"
                                           type="button"
                                           class="btn btn-outline-dark @if($mode === config('ranking.search-trader')) active @endif">
                                            {{ __('ranking.search.trader') }}
                                        </a>
                                    </div>
                                @endif
                                @if(config('siteSettings.hunter_ranking', true))
                                    <div class="btn-group p-2" role="group"
                                         aria-label="{{ __('ranking.search.hunter') }}">
                                        <a href="{{ route('ranking.job.hunter') }}"
                                           type="button"
                                           class="btn btn-outline-dark @if($mode === config('ranking.search-hunter')) active @endif">
                                            {{ __('ranking.search.hunter') }}
                                        </a>
                                    </div>
                                @endif
                                @if(config('siteSettings.thief_ranking', true))
                                    <div class="btn-group p-2" role="group"
                                         aria-label="{{ __('ranking.search.thief') }}">
                                        <a href="{{ route('ranking.job.thief') }}"
                                           type="button"
                                           class="btn btn-outline-dark @if($mode === config('ranking.search-thief')) active @endif">
                                            {{ __('ranking.search.thief') }}
                                        </a>
                                    </div>
                                @endif
                                @if(config('siteSettings.unique_ranking', true))
                                    <div class="btn-group p-2" role="group"
                                         aria-label="{{ __('ranking.search.unique') }}">
                                        <a href="{{ route('ranking.unique') }}"
                                           type="button"
                                           class="btn btn-outline-dark @if($mode === config('ranking.search-unique')) active @endif">
                                            {{ __('ranking.search.unique') }}
                                        </a>
                                    </div>
                                @endif
                                @if(config('siteSettings.free_pvp_ranking', true))
                                    <div class="btn-group p-2" role="group"
                                         aria-label="{{ __('ranking.search.pvp') }}">
                                        <a href="{{ route('ranking.pvp.free') }}"
                                           type="button"
                                           class="btn btn-outline-dark @if($mode === config('ranking.search-free-pvp')) active @endif">
                                            {{ __('ranking.search.pvp') }}
                                        </a>
                                    </div>
                                @endif
                                @if(config('siteSettings.job_pvp_ranking', true))
                                    <div class="btn-group p-2" role="group"
                                         aria-label="{{ __('ranking.search.job') }}">
                                        <a href="{{ route('ranking.pvp.job') }}"
                                           type="button"
                                           class="btn btn-outline-dark @if($mode === config('ranking.search-job-pvp')) active @endif">
                                            {{ __('ranking.search.job') }}
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="result-area">
                        {!! $dataTable->table(['class' => 'table table-hover table-bordered table-striped w-100'], true) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('theme::javascript')
    {!! $dataTable->scripts() !!}
@endpush
