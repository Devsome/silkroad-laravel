<table class="table table-hover table-striped ">
    <thead>
    <tr>
        <th scope="col">{{ __('ranking.table.rank') }}</th>
        <th scope="col">{{ __('ranking.table.guild') }}</th>
        <th scope="col">{{ __('ranking.table.level') }}</th>
        <th scope="col">{{ __('ranking.table.itempoints') }}</th>
    </tr>
    </thead>
    <tbody>
    @forelse($data as $guild)
        <tr class="live-search-list">
            <td>
                {{ $loop->iteration }}
            </td>
            <td>
                <a href="#">{{ $guild->Name }}</a>
            </td>
            <td>
                {{ $guild->Lvl }}
            </td>
            <td>{{ $guild->ItemPoints }}</td>
        </tr>
    @empty
        <tr>
            <th>{{ __('ranking.no-guild') }}</th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
    @endforelse
    </tbody>
</table>
{!! $data->links() !!}
