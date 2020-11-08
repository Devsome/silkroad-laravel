<table class="table table-hover table-striped ">
    <thead>
    <tr>
        <th scope="col">{{ __('ranking.table.rank') }}</th>
        <th scope="col">{{ __('ranking.table.charname') }}</th>
        <th scope="col">{{ __('ranking.table.type') }}</th>
        <th scope="col">{{ __('ranking.table.pvp-points') }}</th>
    </tr>
    </thead>
    <tbody>
    @forelse($data as $char)
        <tr class="live-search-list">
            <td>
               {{ $char->count }}
            </td>
            <td>
                {{ $char->CharName }}
            </td>
            <td>{{ $char->type }}</td>
            <td>{{ $char->points }}</td>
        </tr>
    @empty
        <tr>
            <th>{{ __('ranking.no-job-kills') }}</th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
    @endforelse
    </tbody>
</table>
{!! $data->links() !!}
