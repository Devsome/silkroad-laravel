@foreach($conversations as $conversation)
    <div class="chat_list chatButtons @if($conversation->id == $conversationId) active_chat @endIf"
         data-id="{{ $conversation->id }}" id="btn-{{ $conversation->id }}">
        <div class="chat_people">
            <div class="chat_ib">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        <div class="float-right small">
                            {!! \Carbon\Carbon::parse($conversation->created_at)->format('H:i d.m.Y') !!}
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        <h5>
                            {{ __('backend/tickets.chat.from-user', ['user' => $conversation->getusername->name]) }}
                        </h5>
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        <p>
                            <b>{{ $conversation->title }}</b>
                        </p>
                        <p>
                            {{ __('backend/tickets.chat.priority') }}
                            <span class="text-{{ $conversation->getPriorityName->color }}">
                            {{ $conversation->getPriorityName->name }}
                        </span>
                        </p>
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        <p>
                            {{ __('backend/tickets.chat.status') }}
                            <span class="text-{{ $conversation->getStatusName->color }}">
                            {{ $conversation->getStatusName->name }}
                        </span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach
