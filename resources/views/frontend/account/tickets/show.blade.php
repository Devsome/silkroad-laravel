@extends('theme::layouts.app')
@section('theme::title', __('seo.tickets.show', ['name' => $ticket->title]))
@section('theme::sidebar')
    @include('theme::frontend.account.sidebar')
@endsection

@section('theme::content')
    <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <h1>
                        {{ __('home.tickets.show.title') }}
                    </h1>

                    @if(session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session()->get('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    @if(session()->has('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session()->get('error') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <div class="col-md-12">
                        <div class="form-group row">
                            <label for="title" class="col-sm-4 col-form-label">
                                {{ __('home.tickets.show.form.title') }}
                            </label>
                            <div class="col-sm-8">
                                <input type="text" readonly class="form-control-plaintext" id="title"
                                       value="{{ $ticket->title }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="category" class="col-sm-4 col-form-label">
                                {{ __('home.tickets.show.form.category') }}
                            </label>
                            <div class="col-sm-8">
                                <input type="text" readonly class="form-control-plaintext" id="category"
                                       value="{{ $ticket->getCategoryName->name }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="priority" class="col-sm-4 col-form-label">
                                {{ __('home.tickets.show.form.priority') }}
                            </label>
                            <div class="col-sm-8">
                                <input type="text" readonly class="form-control-plaintext" id="priority"
                                       value="{{ $ticket->getPriorityName->name }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="state" class="col-sm-4 col-form-label">
                                {{ __('home.tickets.show.form.state') }}
                            </label>
                            <div class="col-sm-8">
                                <input type="text" readonly class="form-control-plaintext" id="state"
                                       value="{{ $ticket->getStatusName->name }}">
                            </div>
                        </div>

                        <hr class="mt-2 mb-3">

                        <div id="custom-chat">
                            @foreach($ticket->getAnswers as $message)
                                @if($ticket->user_id === $message->user_id)
                                    <div class="incoming_msg">
                                        <div class="received_msg">
                                            <div class="received_withd_msg">
                                                <p>
                                                    <span>{{ $message->getUserName->name }}:<br></span>
                                                    {{ $message->body }}
                                                </p>
                                                <span class="time_date"
                                                      data-date="{{ $message->created_at->toIso8601String() }}">
                                                    {{ $message->created_at->diffForHumans() }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="outgoing_msg">
                                        <div class="sent_msg">
                                            <p>
                                                <span>{{ $message->getUserName->name }}:<br></span>
                                                {{ $message->body }}
                                            </p>
                                            <span class="time_date"
                                                  data-date="{{ $message->created_at->toIso8601String() }}">
                                                {{ $message->created_at->diffForHumans() }}
                                            </span>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                        <form method="POST" action="{{ route('home-tickets-show-submit', ['id' => $ticket->id]) }}">
                            @csrf

                            <hr class="mt-2 mb-3">

                            <div class="form-group row">
                                <label for="body" class="col-sm-4 col-form-label">
                                    {{ __('home.tickets.show.form.reply') }}
                                </label>
                                <div class="col-sm-8">
                                    <textarea class="form-control {{ $errors->has('body') ? ' is-invalid' : '' }}"
                                              id="body" name="body" rows="5"
                                              placeholder="{{ __('home.tickets.show.form.reply-placeholder') }}">{{ old('body') }}</textarea>
                                    @if ($errors->has('body'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('body') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-12 pb-5">
                                <hr class="mt-2 mb-3">
                                @if($ticket->getStatusName->id === \App\Tickets\TicketStatus::STATUS_CLOSED)
                                    <div class="d-flex flex-wrap float-left text-danger">
                                        {{ __('home.tickets.show.form.closed-state') }}
                                    </div>
                                @endif
                                @if($ticket->getStatusName->id !== \App\Tickets\TicketStatus::STATUS_FINAL_CLOSE)
                                <div class="d-flex flex-wrap float-right">
                                    <button class="btn btn-style-1 btn-primary float-right" type="submit">
                                        {{ __('home.tickets.show.form.submit') }}
                                    </button>
                                </div>
                                @else
                                    <div class="d-flex flex-wrap float-right">
                                        <button class="btn btn-style-1 btn-secondary float-right" type="button" disabled>
                                            {{ __('home.tickets.show.form.submit-close') }}
                                        </button>
                                    </div>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
