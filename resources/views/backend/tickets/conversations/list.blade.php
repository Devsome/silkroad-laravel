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
                        @if($currentConversation)
                            <div class="d-flex justify-content-between align-items-center ticket-actions">
                                <h4>
                                    {{ __('backend/tickets.conversation') }}
                                </h4>
                                <div class="mb-0 float-right mt-2 mb-2">
                                    <form method="POST" data-form="deleteForm">
                                        @csrf
                                        <span data-toggle="modal" data-target="#ticketModalDelete"
                                              data-title="{{ __('backend/tickets.close-title') }}"
                                              data-message="{{ __('backend/tickets.close-message') }}"
                                              class="btn btn-danger btn-sm mr-1" style="cursor: pointer">
                                        <i class="fa fa-trash"></i> {{ __('backend/tickets.close-btn') }}
                                    </span>
                                    </form>
                                </div>
                            </div>
                            <div id="custom-chat">
                                <div class="row conversations">
                                    <div class="col-4 col-4 col-md-5 col-lg-5 h-100 scroll">
                                        <div class="inbox_chat support-content">
                                            <ul class="list-group fa-padding">
                                                @include('backend.tickets.conversations.conversations', [
                                                    'conversations' => $conversations,
                                                    'conversationId' => $currentConversation->id,
                                                ])

                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-8 col-sm-8 col-md-7 col-lg-7 h-100 chat">
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
                        @else
                            {{ __('backend/tickets.empty') }}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="ticketModalDelete" role="dialog" aria-labelledby="ticketModalDeleteLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary"
                            data-dismiss="modal">{{ __('backend/notification.modal.return') }}</button>
                    <button type="button" class="btn btn-sm btn-danger"
                            id="confirm">{{ __('backend/notification.modal.submit') }}</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('javascript')
    <script>
        $(document).ready(function () {
            moment.locale('{{app()->getLocale()}}');

                    @if($currentConversation)
            let lastMessage = '{{$currentConversation->getAnswers()->orderBy('created_at', 'asc')->get()->last()->created_at->toIso8601String()}}';
            let conversationId = {{$currentConversation->id}};
                    @else
            let lastMessage = '';
            let conversationId = 0;
                    @endif

            let $chatContent = $('.chatContent');
            let csrf = '{{csrf_token()}}';

            let textContainer = $('#text');
            let sendContainer = $('#send');

            $('#ticketModalDelete').find('.modal-footer #confirm').on('click', function () {
                $.post({
                    url: '{{ route('ticket-close-backend') }}',
                    data: {
                        conversationId: conversationId
                    },
                    headers: {
                        'X-CSRF-TOKEN': csrf,
                    },
                }).done(function (d) {
                    $('#ticketModalDelete').modal('toggle');
                    checkDate();
                    fetchMessages();
                    loadConversations();
                });

            });
            $('#ticketModalDelete').on('show.bs.modal', function (e) {
                $(this).find('.modal-body p').text($(e.relatedTarget).attr('data-message'));
                $(this).find('.modal-title').text($(e.relatedTarget).attr('data-title'));

                let form = $(e.relatedTarget).closest('form');
                $(this).find('.modal-footer #confirm').data('form', form);
            });

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
