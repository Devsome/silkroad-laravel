@isset($UniqueKillsProvider)
    <p class="font-weight-light font-weight-bold pt-3">Latest Unique Kills</p>

    <ul class="list-group small overflow-auto py-1 pl-1">
        @forelse($UniqueKillsProvider as $Unique)
            <li>
                <span class="font-weight-bolder">{{$Unique->CharName16}}</span> Killed
                <span class="font-weight-bolder">{{$Unique->unique_name}}</span>
                {{\Carbon\Carbon::make($Unique->killed_at)->diffForHumans()}}
            </li>
        @empty
            <li>There is no records!</li>
        @endforelse
    </ul>
@endisset
