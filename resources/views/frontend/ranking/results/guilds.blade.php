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
    @forelse($data as $key => $guild)
        <tr class="live-search-list">
            <td>
                {{ $data->firstItem() + $key }}
            </td>
            <td>
                <a href="{{ route('information-guild', ['name' => Str::lower($guild->Name)]) }}">
                    {{ $guild->Name }}</a>
                <a class="small"
                   href="{{ route('information-guild', ['name' => Str::lower($guild->Name)]) }}"
                   target="_blank">
                    <i class="fas fa-external-link-alt"></i>
                </a>
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
