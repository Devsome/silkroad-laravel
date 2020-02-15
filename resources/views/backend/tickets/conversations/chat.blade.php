@foreach($messages as $message)
    @if($ticket->user_id === $message->user_id)
        <div class="incoming_msg">
            <div class="received_msg">
                <div class="received_withd_msg">
                    <p>
                        <span>{{ $message->getUserName->name }}:</span>
                        {{ $message->body }}
                    </p>
                    <span class="time_date" data-date="{{ $message->created_at->toIso8601String() }}">
                    {{ $message->created_at->diffForHumans() }}
                </span>
                </div>
            </div>
        </div>
    @else
        <div class="outgoing_msg">
            <div class="sent_msg">
                <p>
                    <span>{{ $message->getUserName->name }}:</span>
                    {{ $message->body }}
                </p>
                <span class="time_date" data-date="{{ $message->created_at->toIso8601String() }}">
                    {{ $message->created_at->diffForHumans() }}
                </span>
            </div>
        </div>
    @endif
@endforeach
