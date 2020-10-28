<table class="table table-hover table-striped ">
    <thead>
    <tr>
        <th scope="col">{{ __('ranking.table.rank') }}</th>
        <th scope="col">{{ __('ranking.table.charname') }}</th>
        <th scope="col">PVP Points</th>
    </tr>
    </thead>
    <tbody>
    @forelse($data as $char)
        <tr class="live-search-list">
            <td>
               {{ $char->count }}
            </td>
            <td>
                <a href="{{ route('information-player', ['CharName16' => Str::lower($char->CharName)]) }}">
                    {{ $char->CharName }}</a>
                <a class="small"
                   href="{{ route('information-player', ['CharName16' => Str::lower($char->CharName)]) }}"
                   target="_blank">
                    <i class="fas fa-external-link-alt"></i>
                </a>
            </td>
            <td>{{ $char->points }}</td>
        </tr>
    @empty
        <tr>
            <th>{{ __('ranking.no-pvp-kills') }}</th>
            <th></th>
            <th></th>
        </tr>
    @endforelse
    </tbody>
</table>
{!! $data->links() !!}
