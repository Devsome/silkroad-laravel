@extends('backend.layouts.app')

@section('backend-content')
    @include('backend.layouts.navbar')

    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">{{ __('backend/tickets.title') }}</h1>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold">
                            {{ __('backend/tickets.headline') }}
                        </h6>
                    </div>
                    <div class="card-body">
                        <div id="custom-chat">
                            <div class="messaging">
                                <div class="inbox_msg">
                                    <div class="inbox_people">
                                        <div class="headind_srch">
                                            <div class="recent_heading">
                                                <h4>
                                                    {{ __('backend/tickets.chat.recent') }}
                                                </h4>
                                            </div>
                                        </div>
                                        <div class="inbox_chat h-100 scroll">
{{--                                            @include('backend.tickets.chat-tickets')--}}
                                        </div>
                                    </div>
                                    <div class="mesgs">
                                        <div class="msg_history">

                                            {{--                                            @includeIf('backend.tickets.message-tickets', ['answers' => []])--}}

                                        </div>

                                        <div class="type_msg">
                                            <div class="input_msg_write">
                                                <input type="text" class="write_msg" placeholder="Type a message"/>
                                                <button class="msg_send_btn" type="button">
                                                    <i class="fa fa-paper-plane-o" aria-hidden="true"></i>
                                                </button>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@push('javascript')
    <script>
        $(document).ready(function () {
            // Pagination
            $(document).on('click', '.pagination a', function (event) {
                event.preventDefault();

                $('li').removeClass('active');
                $(this).parent('li').addClass('active');

                getData($(this).attr('href').split('page=')[1]);
            });

            function getData(page) {
                $.ajax({
                    url: '?page=' + page,
                    type: 'get',
                    datatype: 'html'
                }).done(function (data) {
                    $(".inbox_chat").empty().html(data);
                    location.hash = page;
                }).fail(function () {
                    console.log('Ticket Pagination error');
                });
            }
        });

    </script>
@endpush
