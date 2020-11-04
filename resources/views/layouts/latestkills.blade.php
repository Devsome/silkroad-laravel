@isset($UniqueKillsProvider)
    <p class="font-weight-light font-weight-bold pt-3">
        {{ __('sidebar.unique.title') }}
    </p>

    <ul class="list-group small overflow-auto py-1 pl-1">
        @forelse($UniqueKillsProvider as $Unique)
            <li class="font-weight-light">
                <span class="font-weight-bold">
                    {{ $Unique->CharName16 }}
                </span> {{ __('sidebar.unique.killed') }}
                <span class="font-weight-bold">
                    {{ $Unique->unique_name }}
                </span>
                {{ \Carbon\Carbon::make($Unique->killed_at)->diffForHumans() }}
            </li>
        @empty
            <li>
                {{ __('sidebar.unique.empty') }}
            </li>
        @endforelse
    </ul>
@endisset
