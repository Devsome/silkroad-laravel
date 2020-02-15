@forelse ($tickets as $item)
    <div class="chat_list" data-id="{{ $item->id }}"> <!-- active_chat -->
        <div class="chat_people">
            <div class="chat_ib">

                <div class="row">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-6">
                        <h5>
                            {{ __('backend/tickets.chat.from-user', ['user' => $item->getusername->name]) }}
                        </h5>
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-6">
                        <div class="float-right small">
                            {!! \Carbon\Carbon::parse($item->created_at)->format('H:i d.m.Y') !!}
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-6">
                        <p>
                            {{ __('backend/tickets.chat.priority') }}
                            <span class="text-{{ $item->getPriorityName->color }}">
                            {{ $item->getPriorityName->name }}
                        </span>
                        </p>
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-6">
                        <p>
                            {{ __('backend/tickets.chat.status') }}
                            <span class="text-{{ $item->getStatusName->color }}">
                            {{ $item->getStatusName->name }}
                        </span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@empty
<!-- nope -->
@endforelse

{!! $tickets->render() !!}
