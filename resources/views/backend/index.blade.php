@extends('theme::backend.layouts.app')

@section('theme::backend-content')
    @include('theme::backend.layouts.navbar')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">
                {{ __('backend/index.panels.title') }}
            </h1>
        </div>
        <div class="row">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-gray shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1">
                                    {{ __('backend/index.panels.web-accounts-count') }}
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ $userCount }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user-circle fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-gray shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1">
                                    {{ __('backend/index.panels.player-count') }}
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ $playerCount }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-users fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-gray shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1">
                                    {{ __('backend/index.panels.silk-count') }}
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ $silkCount }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-coins fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-gray shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1">
                                    {{ __('backend/index.panels.vouchers-count') }}
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ $vouchersCount }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-gift fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-gray shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1">
                                    {{ __('backend/index.panels.web-gold') }}
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ number_format($webGold->gold , 0, ',', '.')}}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-coins fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-gray shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1">
                                    {{ __('backend/index.panels.server-gold') }}
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ number_format($serverGold , 0, ',', '.')}}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-coins fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6 mb-6">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0">{{ __('backend/index.recent-news-title') }}</h6>
                    </div>
                    <div class="card-body small">
                        <div class="list-group mb-3">
                            @forelse($notices as $notice)
                                <a href="{{ route('sro-notice-edit-backend', ['id' => $notice->ID]) }}"
                                   class="list-group-item list-group-item-action">
                                    [{{ $notice->ID }}] {{ $notice->Subject }}
                                </a>
                            @empty
                                {{ __('backend/index.recent-news-empty') }}
                            @endforelse
                        </div>

                        <a href="{{ route('sro-notice-create-backend') }}">
                            {{ __('backend/index.recent-news-create-link') }} &rarr;
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 mb-6">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0">{{ __('backend/index.recent-created-chars') }}</h6>
                    </div>
                    <div class="card-body small">
                        <div class="list-group mb-3">
                            @forelse($chars as $char)
                                <a href="{{ route('sro-players-edit-backend', ['char' => $char->CharID]) }}"
                                   class="list-group-item list-group-item-action ">
                                    {{ __('backend/index.recent-created-chars-list', [
                                        'char' => $char->CharName16,
                                        'level' => $char->CurLevel
                                    ]) }}
                                </a>
                            @empty
                                {{ __('backend/index.recent-news-empty') }}
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            @include('theme::backend.soxcount.index', [
                'soxCount' => $soxCount
            ])

            <div class="col-xl-6 col-lg-6">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">
                            {{ __('backend/index.todo-title') }}
                        </h6>
                    </div>
                    <div class="card-body">
                        <div id="todoListState"></div>
                        <div class="list-group mb-3">
                            @forelse($todos as $todo)
                                <div class="list-group-item list-group-item-action">
                                    <span class="small">
                                        {{ $todo->getUserName->name }} ({{ $todo->getUserName->silkroad_id }}):
                                    </span>
                                    {{ $todo->body }}
                                    <span class="float-right">
                                        <span class="icon delete-btn">
                                            <i class="fa fas fa-remove text-danger" style="cursor: pointer;"></i>
                                            <form method="post"
                                                  action="{{ route('todo-delete-backend', ['id' => $todo->id]) }}">
                                            @csrf
                                        </form>
                                        </span>
                                    </span>
                                </div>
                            @empty
                                {{ __('backend/index.empty-todo') }}
                            @endforelse
                        </div>
                        <div class="input-group chat-send">
                            <input type="text" class="form-control"
                                   placeholder="{{ __('backend/index.input-placeholder') }}"
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
@endsection
@push('theme::javascript')
    <script type="text/javascript">
        $(document).ready(function () {
            let csrf = '{{csrf_token()}}';

            let textContainer = $('#text');
            let sendContainer = $('#send');

            sendContainer.click(send);
            textContainer.on('keypress', function (e) {
                if (e.which === 13) {
                    send();
                }
            });

            $('.delete-btn').click(function () {
                let $this = $(this);
                $this.find('form').submit();
            });

            function send() {
                $text = textContainer;
                $sendBtn = sendContainer;
                let btnText = $sendBtn.html();
                $sendBtn.html('<i class="fas fa-circle-notch fa-spin"></i>');

                $text.attr('disabled', 'disabled');

                $.post({
                    url: '{{ route('todo-add-backend') }}',
                    data: {
                        _token: csrf,
                        body: $text.val(),
                    },
                    headers: {
                        'X-CSRF-TOKEN': csrf,
                    },
                }).done(function (d) {
                    $text.removeAttr('disabled').val('');
                    $sendBtn.html(btnText);
                    console.log(d.state);
                    console.log(d);
                    if (d.state === 'successfully') {
                        $("#todoListState").append(
                            '<div class="alert alert-success alert-dismissible fade show" role="alert">' +
                            '{{ __('backend/notification.form-submit.todo-add') }}' +
                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                            '<span aria-hidden="true">&times;</span>' +
                            '</button>' +
                            '</div>');
                    } else {

                    }
                });
            }
        });
    </script>
@endpush
