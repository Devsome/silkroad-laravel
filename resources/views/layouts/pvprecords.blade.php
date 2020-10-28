@isset($PvpRecordsProvider)
    <p class="font-weight-light font-weight-bold pt-3">
        {{ __('sidebar.pvp.title') }}
    </p>

    <ul class="list-group small overflow-auto py-1 pl-1">
        @forelse($PvpRecordsProvider as $record)
            <li class="font-weight-light">
                <span class="font-weight-bold">
                    <a href="{{ route('information-player', ['CharName16' => Str::lower($record->CharName)]) }}">
                        {{ $record->CharName }}
                    </a>
                </span> {{ __('sidebar.pvp.killed') }}
                <span class="font-weight-bold">
                    <a href="{{ route('information-player', ['CharName16' => Str::lower($record->KilledCharName)]) }}">
                        {{ $record->KilledCharName }}
                    </a>
                </span>
                {{ \Carbon\Carbon::make($record->killed_at)->diffForHumans() }}
            </li>
        @empty
            <li>
                {{ __('sidebar.pvp.empty') }}
            </li>
        @endforelse
    </ul>
@endisset
