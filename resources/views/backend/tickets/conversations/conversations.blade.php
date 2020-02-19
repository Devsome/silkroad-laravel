@foreach($conversations as $conversation)
    <div class="chat_list card mb-2 chatButtons @if($conversation->id == $conversationId)bg-gray-200 @endIf border-left-{{ $conversation->getPriorityName->color }}"
         data-id="{{ $conversation->id }}" id="btn-{{ $conversation->id }}">
        <div class="chat_people">
            <div class="chat_ib">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        <h5>
                            {{ ucfirst($conversation->title) }}
{{--                            {{ __('backend/tickets.chat.from-user', ['user' => $conversation->getusername->name]) }}--}}
                            <span class="d-none d-sm-block">
                                {!! \Carbon\Carbon::parse($conversation->created_at)->format('H:i d.m.Y') !!}
                            </span>
                        </h5>
                        <p class="text-{{ $conversation->getStatusName->color }}">
                            {{ ucfirst($conversation->getStatusName->name) }}
                        </p>
                    </div>
{{--                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 d-none d-sm-block">--}}
{{--                        <table class="table table-borderless table-sm">--}}
{{--                            <tbody>--}}
{{--                            <tr>--}}
{{--                                <th scope="col">{{ __('backend/tickets.chat.priority') }}</th>--}}
{{--                                <td class="text-{{ $conversation->getPriorityName->color }}">--}}
{{--                                    {{ $conversation->getPriorityName->name }}--}}
{{--                                </td>--}}
{{--                            </tr>--}}
{{--                            <tr>--}}
{{--                                <th scope="col">{{ __('backend/tickets.chat.status') }}</th>--}}
{{--                                <td class="text-{{ $conversation->getStatusName->color }}">--}}
{{--                                    {{ $conversation->getStatusName->name }}--}}
{{--                                </td>--}}
{{--                            </tr>--}}
{{--                            </tbody>--}}
{{--                        </table>--}}
{{--                    </div>--}}
{{--                    <div class="col-6 col-sm-6 col-md-6 col-lg-12 col-xl-12">--}}
{{--                        <p>--}}
{{--                            <b>{{ $conversation->title }}</b>--}}
{{--                        </p>--}}
{{--                        <p>--}}
{{--                            {{ __('backend/tickets.chat.priority') }}--}}
{{--                        </p>--}}
{{--                    </div>--}}
{{--                    <div class="col-6 col-sm-6 col-md-6 col-lg-12 col-xl-12">--}}
{{--                        <span class="text-{{ $conversation->getPriorityName->color }}">--}}
{{--                                {{ $conversation->getPriorityName->name }}--}}
{{--                            </span>--}}
{{--                        <p>--}}
{{--                            {{ __('backend/tickets.chat.status') }}--}}
{{--                            <span class="text-{{ $conversation->getStatusName->color }}">--}}
{{--                                {{ $conversation->getStatusName->name }}--}}
{{--                            </span>--}}
{{--                        </p>--}}
{{--                    </div>--}}
                </div>
            </div>
        </div>
    </div>
@endforeach
