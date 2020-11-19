<table class="table table-hover table-striped ">
    <thead>
    <tr>
        <th scope="col">{{ __('ranking.table.rank') }}</th>
        <th scope="col">{{ __('ranking.table.charname') }}</th>
        <th scope="col">{{ __('ranking.table.unique-points') }}</th>
    </tr>
    </thead>
    <tbody>
    @php
    $count = 1;
    @endphp
    @forelse($data as $charname => $key)
        <tr class="live-search-list">
            <td>
                {{ $count }}
            </td>
            <td>
                <a href="{{ route('information-player', ['CharName16' => Str::lower($charname)]) }}">
                    {{ $charname }}</a>
                <a class="small"
                   href="{{ route('information-player', ['CharName16' => Str::lower($charname)]) }}"
                   target="_blank">
                    <i class="fas fa-external-link-alt"></i>
                </a>
            </td>
            <td>{{ $key['points'] }}</td>
        </tr>
        @php
            ++$count
        @endphp
    @empty
        <tr>
            <th>{{ __('ranking.no-unique') }}</th>
            <th></th>
            <th></th>
        </tr>
    @endforelse
    </tbody>
</table>
{!! $data->links() !!}
