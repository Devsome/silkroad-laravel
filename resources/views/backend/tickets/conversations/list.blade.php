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
                            <div class="row conversations">
                                <div class="col-5 col-sm-6 col-lg-3 h-100 scroll">
                                    <div class="list-group inbox_chat">
                                        @include('backend.tickets.conversations.conversations', [
                                            'conversations' => $conversations,
                                            'conversationId' => $currentConversation->id,
                                        ])
                                    </div>
                                </div>
                                <div class="col-7 col-sm-6 col-lg-9 h-100 chat">
                                    <div class="spinner" hidden>
                                        <i class="fas fa-circle-notch fa-10x fa-spin"></i>
                                    </div>
                                    <div class="chatContent scroll">
                                        @include('backend.tickets.conversations.chat', [
                                            'messages' => $currentConversation->getAnswers()->orderBy('created_at', 'asc')->get(),
                                            'ticket' => $currentConversation
                                        ])
                                    </div>
                                    <div class="input-group" style="height: 38px;">

{{--                                        <div class="type_msg">--}}
{{--                                            <div class="input_msg_write">--}}
{{--                                                <input type="text" class="write_msg" placeholder="Type a message"/>--}}
{{--                                                <button class="msg_send_btn" type="button" id="send">--}}
{{--                                                    <i class="fa fa-paper-plane-o" aria-hidden="true"></i>--}}
{{--                                                </button>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}

                                        <input type="text" class="form-control" placeholder="{{__('conversations.text')}}"
                                               id="text">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button" id="send">
                                                <i class="fas fa-paper-plane"></i>
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

@endsection

@push('javascript')
    <script>
        $(document).ready(function () {
            moment.locale('{{app()->getLocale()}}');

            let lastMessage = '{{$currentConversation->getAnswers()->orderBy('created_at', 'asc')->get()->last()->created_at->toIso8601String()}}';
            let conversationId = {{$currentConversation->id}};
            let $chatContent = $('.chatContent');
            let csrf = '{{csrf_token()}}';

            function fetchMessages() {
                $.get({
                    url: '{{ route('conversations.fetch') }}',
                    data: {
                        lastMessage: lastMessage,
                        conversationId: conversationId,
                    },
                }).done(function (d) {
                    if (d.success && d.found) {
                        lastMessage = d.lastMessage;
                        let html = $chatContent.html();
                        $chatContent.html(html + d.html);
                        scrollDown();
                    }
                });
            }

            function loadConversations() {
                $.get({
                    url: '{{ route('conversations.conversations') }}',
                    data: {
                        conversationId: conversationId,
                    }
                }).done(function (d) {
                    $('.list-group').html(d);
                    initButtons();
                });
            }

            function loadConversation(id) {
                conversationId = id;

                $.get({
                    url: '{{ route('conversations.fetch') }}',
                    data: {
                        conversationId: conversationId,
                    },
                }).done(function (d) {
                    if (d.success && d.found) {
                        lastMessage = d.lastMessage;
                        $chatContent.html(d.html);
                        $('.spinner').attr('hidden', 'hidden');
                        scrollDown();
                    }
                });
            }

            function scrollDown() {
                $chatContent.animate({scrollTop: $chatContent[0].scrollHeight}, 200);
            }

            function initButtons() {
                $('.chatButtons').click(function () {
                    let $this = $(this);
                    let id = $this.data('id');
                    $('.spinner').removeAttr('hidden');
                    loadConversation(id);
                    $('.chatButtons').removeClass('active_chat');
                    $('#btn-' + id).addClass('active_chat')

                });
            }

            function checkDate() {
                $('.date').each(function (i, el) {
                    $el = $(el);
                    let date = $el.data('date');
                    $el.text(moment(date).fromNow())
                });
            }

            function send() {
                $text = $('#text');
                $sendBtn = $('#send');
                let btnText = $sendBtn.html();
                $sendBtn.html('<i class="fas fa-circle-notch fa-spin"></i>');

                $text.attr('disabled', 'disabled');

                console.log($text.val());

                $.post({
                    url: '{{ route('conversations.send') }}',
                    data: {
                        conversationId: conversationId,
                        text: $text.val(),
                    },
                    headers: {
                        'X-CSRF-TOKEN': csrf,
                    },
                }).done(function (d) {
                    $text.removeAttr('disabled').val('');
                    $sendBtn.html(btnText);
                });
            }


            scrollDown();
            initButtons();
            setInterval(checkDate, 5000);
            setInterval(fetchMessages, 10000);
            setInterval(loadConversations, 30000);

            $('#send').click(send);
            $('#text').on('keypress', function (e) {
                if (e.which == 13) {
                    send();
                }
            });
        });
    </script>
@endpush
