@extends('layouts.app')

@section('content')
    <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <h1>{{ __('ranking.title') }}</h1>


                    <div class="row pb-4 py-3">
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
                    <div class="result-area">
                        @include('frontend.ranking.results.chars', [
                            'data' => $data
                        ])
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if($errors->any())
        {{ implode('', $errors->all('<div>:message</div>')) }}
    @endif
@endsection

@push('javascript')
    <script>
        $(document).ready(function () {
            const resultArea = $('.result-area');
            const submitButton = $('#sendingButton');
            const submitButtonText = submitButton.html();
            const inputSearchFor = $('input[name="search-term"]');

            // Dropdown selector
            $(".dropdown-menu a ").click(function () {
                $('input[name="search-for"]').val($(this).data('name'));
                $(this).parents(".input-group-btn").find('.btn').text($(this).text());
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Form preventing
            $("form").submit(function (e) {
                e.preventDefault();
                let form = $("form").serialize();
                submitButton.html('<i class="fas fa-circle-notch fa-spin"></i>');
                inputSearchFor.attr('disabled', 'disabled');
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
                    $('input[name="search-term"]').removeAttr('disabled');
                    inputSearchFor.removeAttr('disabled');
                    submitButton.html(submitButtonText);
                });

            });
        });
    </script>
@endpush
