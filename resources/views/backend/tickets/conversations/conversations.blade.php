@foreach($conversations as $conversation)
    <li class="list-group-item chatButtons @if($conversation ? $conversation->id : '' === $conversationId)bg-gray-200 @endIf
            border-left-{{ $conversation->getStatusName->color }}"
        data-id="{{ $conversation->id }}" id="btn-{{ $conversation->id }}">
        <div class="media">
            <div class="media-body">
                <strong>{{ ucfirst($conversation->title) }}</strong>
                <span class="badge badge-{{ $conversation->getStatusName->color }}">
                    {{ ucfirst($conversation->getStatusName->name) }}
                </span>
                <span class="badge badge-{{ $conversation->getPriorityName->color }}">
                    {{ ucfirst($conversation->getPriorityName->name) }}
                </span>
                <span class="number float-right"># {{ $conversation ? $conversation->id : '' }}</span>
                <p class="info">
                    {{ __('backend/tickets.category-name', ['name' => $conversation->getCategoryName->name]) }}
                </p>
                <p class="info">
                    {{ __('backend/tickets.opened-by-user') }}
                    <u>{{ $conversation->getUserName ? $conversation->getUserName->silkroad_id : '' }}</u> {!! \Carbon\Carbon::parse($conversation->created_at)->diffForHumans() !!}
                </p>
            </div>
        </div>
    </li>
@endforeach
