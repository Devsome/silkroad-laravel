@php
    $i = 0;
@endphp

<p class="font-weight-light font-weight-bold pt-3">
    {{ __('sidebar.timers.title') }}
</p>
<ul class="list-group list-unstyled small py-1 pl-1">
    @forelse($TimersProvider['timer'] as $timer)
        <li class="pb-1">
            <span class="pull-left">
                @if(array_key_exists('icon', $timer))
                    <i class="{{ $timer['icon'] }}"></i>
                @endif
                {{ $timer['name'] }}
            </span>
            <span class="float-right small pt-1 pr-2">
                @if($timer['time'] > 0)
                    <span class="timerCountdown" id="timer_{{ $i++ }}"
                          data-time="{{ $timer['time'] }}"></span>
                @else
                    {{ $timer['text'] }}
                @endif
            </span>
        </li>
    @empty
        {{ __('sidebar.timers.empty') }}
    @endforelse
</ul>
