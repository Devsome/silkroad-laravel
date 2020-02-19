@extends('backend.layouts.app')

@section('backend-content')
    @include('backend.layouts.navbar')

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold">
                            {{ __('backend/tickets.headline') }}
                        </h6>
                    </div>
                    <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <h4>
                                    {{ __('backend/tickets.conversation') }}
                                </h4>
                                <div class="mb-0 float-right mt-2 mb-2">
                                    <span class="pr-3">
                                        {{ __('backend/tickets.from') }}
                                        <span class="account-id">

                                        </span>
                                    </span>
                                    <button data-text="dasdsa"
                                            data-toggle="tooltip"
                                            data-placement="right"
                                            title=""
                                            class="btn btn-danger delete-btn btn-sm mr-1 "
                                            data-original-title="Alle Produkte löschen.">
									<span class="icon">
										<i class="fas fa-trash"></i>
                                        Close Ticket
									</span>
                                        <form method="post" action="https://sharemedia.esy.io/3/excel/view/delete-all">
                                            <input type="hidden" name="_token" value="DfjGIgcJKCc3pQHMt9e0ElhVgBQv3nbJXZIfEsKf">
                                        </form>
                                    </button>
                                </div>

                            </div>
                        <div id="custom-chat">
                            <div class="row conversations">
                                <div class="col-6 col-sm-6 col-lg-4 h-100 scroll">
                                    <div class="list-group inbox_chat">
                                        @include('backend.tickets.conversations.conversations', [
                                            'conversations' => $conversations,
                                            'conversationId' => $currentConversation->id,
                                        ])
                                    </div>
                                </div>
                                <div class="col-5 col-sm-6 col-lg-8 h-100 chat">
                                    <div class="spinner" hidden>
                                        <i class="fas fa-circle-notch fa-10x fa-spin"></i>
                                    </div>
                                    <div class="chatContent scroll">
                                        @include('backend.tickets.conversations.chat', [
                                            'messages' => $currentConversation->getAnswers()->orderBy('created_at', 'asc')->get(),
                                            'ticket' => $currentConversation
                                        ])
                                    </div>
                                    <div class="input-group chat-send">
                                        <input type="text" class="form-control"
                                               placeholder="{{ __('backend/tickets.chat.send-placeholder') }}"
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

            let textContainer = $('#text');
            let sendContainer = $('#send');

            function fetchMessages() {
                $.get({
                    url: '{{ route('ticket-fetch-backend') }}',
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
                    url: '{{ route('ticket-conversations-backend') }}',
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
                    url: '{{ route('ticket-fetch-backend') }}',
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
                    $('.chatButtons').removeClass('bg-gray-200');
                    $('#btn-' + id).addClass('bg-gray-200')

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
                $text = textContainer;
                $sendBtn = sendContainer;
                let btnText = $sendBtn.html();
                $sendBtn.html('<i class="fas fa-circle-notch fa-spin"></i>');

                $text.attr('disabled', 'disabled');

                console.log($text.val());

                $.post({
                    url: '{{ route('ticket-send-backend') }}',
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
                    checkDate();
                    fetchMessages();
                    loadConversations();
                });
            }


            scrollDown();
            initButtons();
            setInterval(checkDate, 5000);
            setInterval(fetchMessages, 10000);
            setInterval(loadConversations, 30000);

            sendContainer.click(send);
            textContainer.on('keypress', function (e) {
                if (e.which === 13) {
                    send();
                }
            });
        });
    </script>
@endpush
