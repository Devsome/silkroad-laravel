@isset($PvpRecordsProvider)
    <p class="font-weight-light font-weight-bold pt-3">Latest PVP Records</p>

    <ul class="list-group small overflow-auto py-1 pl-1">
        @forelse($PvpRecordsProvider as $record)
            <li>
                <span class="font-weight-bolder">
                    <a href="{{ route('information-player', ['CharName16' => Str::lower($record->CharName)]) }}">{{$record->CharName}}</a>
                </span> Killed
                <span class="font-weight-bolder">
                    <a href="{{ route('information-player', ['CharName16' => Str::lower($record->KilledCharName)]) }}">{{$record->KilledCharName}}</a>
                </span>
                {{\Carbon\Carbon::make($record->killed_at)->diffForHumans()}}
            </li>
        @empty
            <li>There is no records!</li>
        @endforelse
    </ul>
@endisset
