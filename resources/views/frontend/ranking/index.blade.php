@extends('layouts.app')

@section('content')
    <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <h1>{{ __('ranking.title') }}</h1>


                    <div class="row pb-4">
                        <div class="col-12">
                            <form method="POST" action="{{ route('ranking-search-post') }}">
                                @csrf
                                <div class="input-group">
                                    <div class="input-group-btn justify-content-center">
                                        <button type="button" class="btn btn-default dropdown-toggle"
                                                data-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false"
                                                id="dropdownMenuButton">
                                            <span id="search_concept">{{ __('ranking.search.filter-by') }}</span>
                                            <span class="caret"></span>
                                        </button>
                                        <input type="hidden" name="search-for"
                                               value="{{ __('ranking.search.search-charname') }}">
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item" href="#"
                                               data-name="{{ __('ranking.search.search-charname') }}">
                                                {{ __('ranking.search.charname') }}
                                            </a>
                                            <a class="dropdown-item" href="#"
                                               data-name="{{ __('ranking.search.search-guild') }}">
                                                {{ __('ranking.search.guild') }}
                                            </a>
                                            <a class="dropdown-item" href="#"
                                               data-name="{{ __('ranking.search.search-job') }}">
                                                {{ __('ranking.search.jobname') }}
                                            </a>
                                        </div>
                                    </div>
                                    <input type="text" class="form-control"
                                           name="search-term"
                                           placeholder="{{ __('ranking.search.placeholder') }}"
                                           value="{{ Request::has('search-term') ? Request::get('search-term') : '' }}"
                                           autocomplete="off" required>
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" id="sendingButton" type="submit">
                                            {{ __('ranking.search.submit') }}
                                        </button>
                                    </div>
                                </div>
                                <div class="py-3" id="errorArea">
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row pb-3">
                        <div class="col-12">
                            <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                                <div class="btn-group mr-2" role="group"
                                     aria-label="{{ __('ranking.search.charname') }}">
                                    <button type="button" class="btn btn-outline-dark">
                                        {{ __('ranking.search.charname') }}
                                    </button>
                                </div>
                                <div class="btn-group mr-2" role="group" aria-label="{{ __('ranking.search.guild') }}">
                                    <button type="button" class="btn btn-outline-dark">
                                        {{ __('ranking.search.guild') }}
                                    </button>
                                </div>
                                <div class="btn-group" role="group" aria-label="{{ __('ranking.search.jobname') }}">
                                    <button type="button" class="btn btn-outline-dark">
                                        {{ __('ranking.search.jobname') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="result-area">
                        @include('frontend.ranking.results.chars', [
                            'data' => $data
                        ])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('javascript')
    <script>
        $(document).ready(function () {
            const resultArea = $('.result-area');
            const submitButton = $('#sendingButton');
            const submitButtonText = submitButton.html();
            const inputSearchTerm = $('input[name="search-term"]');
            const inputSearchFor = $('input[name="search-for"]');

            // Getting the hash
            if (window.location.hash.length > 1) {
                const data = [];
                let tokens = location.hash.substring(1).split('&');
                for (let i = 0, l = tokens.length; i < l; i++) {
                    data[i] = tokens[i];
                }
                if (data.length === 2) {
                    // Category & Term exist
                    console.log(data[0], data[1]);
                    // console.log(request);
                    inputSearchFor.val(data[0]);
                    inputSearchTerm.val(data[1]);

                    let searchFor = $(`a[data-name='${data[0]}']`);
                    searchFor.parents(".input-group-btn").find('.btn').text(searchFor.text());
                }
            }

            // Dropdown selector
            $(".dropdown-menu a ").click(function (e) {
                e.preventDefault();
                inputSearchFor.val($(this).data('name'));
                $(this).parents(".input-group-btn").find('.btn').text($(this).text());
                window.location.hash = $(this).data('name');
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Form preventing
            $("form").submit(function (e) {
                e.preventDefault();
                sendingRequest();
            });

            // Function for Ajax request
            function sendingRequest()
            {
                let form = $("form").serialize();

                console.log(form);
                return;
                submitButton.html('<i class="fas fa-circle-notch fa-spin"></i>');
                inputSearchTerm.attr('disabled', 'disabled');
                $("#errorArea").empty();

                $.post({
                    url: '{{ route('ranking-search-post') }}',
                    data: form,
                }).done(function (data) {
                    if (data.success) {
                        resultArea.html(data.html);
                    } else if (data.success === false) {
                        let errorHtml = '<div class="alert alert-warning" role="alert">';
                        $.each(data.errors, function (key, value) {
                            errorHtml += value;
                        });
                        errorHtml += '</div>';
                        $("#errorArea").append(errorHtml);
                    }
                    inputSearchTerm.removeAttr('disabled');
                    submitButton.html(submitButtonText);
                });
            }
        });
    </script>
@endpush
