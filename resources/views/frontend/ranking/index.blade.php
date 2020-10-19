@extends('theme::layouts.app')
@section('theme::title', __('seo.ranking.index', ['name' => Str::ucfirst($mode)]))
@section('theme::content')
    <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <h1>{{ __('ranking.title') }}</h1>
                    <div class="row pb-4">
                        <div class="col-12">
                            <form method="GET" action="{{ route('ranking-index') }}">
                                <div class="input-group">
                                    <div class="input-group-btn justify-content-center">
                                        <button type="button" class="btn btn-default dropdown-toggle"
                                                data-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false"
                                                id="dropdownMenuButton">
                                            <span id="search_concept">{{ __('ranking.search.filter-by') }}</span>
                                            <span class="caret"></span>
                                        </button>
                                        <input type="hidden" name="type"
                                               value="{{ config('ranking.search-charname') }}">
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item" href="#"
                                               data-name="{{ config('ranking.search-charname') }}">
                                                {{ __('ranking.search.charname') }}
                                            </a>
                                            <a class="dropdown-item" href="#"
                                               data-name="{{ config('ranking.search-guild') }}">
                                                {{ __('ranking.search.guild') }}
                                            </a>
                                            <a class="dropdown-item" href="#"
                                               data-name="{{ config('ranking.search-job') }}">
                                                {{ __('ranking.search.jobname') }}
                                            </a>
                                        </div>
                                    </div>
                                    <input type="text" class="form-control"
                                           name="search"
                                           placeholder="{{ __('ranking.search.placeholder') }}"
                                           value="{{ Request::has('search-term') ? Request::get('search-term') : '' }}"
                                           autocomplete="off" required>
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" id="sendingButton" type="submit">
                                            {{ __('ranking.search.submit') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row pb-3">
                        <div class="col-12">
                            <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                                <div class="btn-group mr-2" role="group"
                                     aria-label="{{ __('ranking.search.charname') }}">
                                    <a href="{{ route('ranking-index', ['mode' => config('ranking.search-charname')]) }}"
                                       type="button" class="btn @if($mode === config('ranking.search-charname'))
                                               btn-dark @else btn-outline-dark @endif">
                                        {{ __('ranking.search.charname') }}
                                    </a>
                                </div>
                                <div class="btn-group mr-2" role="group" aria-label="{{ __('ranking.search.guild') }}">
                                    <a href="{{ route('ranking-index', ['mode' => config('ranking.search-guild')]) }}"
                                       type="button" class="btn @if($mode === config('ranking.search-guild'))
                                            btn-dark @else btn-outline-dark @endif">
                                        {{ __('ranking.search.guild') }}
                                    </a>
                                </div>
                                <div class="btn-group mr-2" role="group" aria-label="{{ __('ranking.search.jobname') }}">
                                    <a href="{{ route('ranking-index', ['mode' => config('ranking.search-job')]) }}"
                                       type="button" class="btn @if($mode === config('ranking.search-job'))
                                            btn-dark @else btn-outline-dark @endif">
                                        {{ __('ranking.search.jobname') }}
                                    </a>
                                </div>

                                <div class="btn-group mr-2" role="group" aria-label="{{ __('ranking.search.trader') }}">
                                    <a href="{{ route('ranking-index', ['mode' => config('ranking.search-trader')]) }}"
                                       type="button" class="btn @if($mode === config('ranking.search-trader'))
                                            btn-dark @else btn-outline-dark @endif">
                                        {{ __('ranking.search.trader') }}
                                    </a>
                                </div>
                                <div class="btn-group mr-2" role="group" aria-label="{{ __('ranking.search.hunter') }}">
                                    <a href="{{ route('ranking-index', ['mode' => config('ranking.search-hunter')]) }}"
                                       type="button" class="btn @if($mode === config('ranking.search-hunter'))
                                            btn-dark @else btn-outline-dark @endif">
                                        {{ __('ranking.search.hunter') }}
                                    </a>
                                </div>
                                <div class="btn-group mr-2" role="group" aria-label="{{ __('ranking.search.thief') }}">
                                    <a href="{{ route('ranking-index', ['mode' => config('ranking.search-thief')]) }}"
                                       type="button" class="btn @if($mode === config('ranking.search-thief'))
                                            btn-dark @else btn-outline-dark @endif">
                                        {{ __('ranking.search.thief') }}
                                    </a>
                                </div>
                                <div class="btn-group" role="group" aria-label="{{ __('ranking.search.unique') }}">
                                    <a href="{{ route('ranking-index', ['mode' => config('ranking.search-unique')]) }}"
                                       type="button" class="btn @if($mode === config('ranking.search-unique'))
                                            btn-dark @else btn-outline-dark @endif">
                                        {{ __('ranking.search.unique') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="result-area">
                        {!! $data !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('theme::javascript')
    <script>
        $(document).ready(function () {
            const inputSearchTerm = $('input[name="type"]');
            const inputSearchFor = $('input[name="search"]');

            function getUrlVars() {
                const vars = {};
                const parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function (m, key, value) {
                    vars[key] = value;
                });
                return vars;
            }

            // Getting the parameters
            if (getUrlVars()['type'] && getUrlVars()['search']) {
                inputSearchFor.val(getUrlVars()['search']);
                inputSearchTerm.val(getUrlVars()['type']);

                let searchFor = $(`a[data-name='${getUrlVars()["type"]}']`);
                searchFor.parents(".input-group-btn").find('.btn').text(searchFor.text());
            }

            // Dropdown selector
            $("form .dropdown-menu a ").click(function (e) {
                e.preventDefault();
                inputSearchTerm.val($(this).data('name'));
                $(this).parents(".input-group-btn").find('.btn').text($(this).text());
            });
        });
    </script>
@endpush
