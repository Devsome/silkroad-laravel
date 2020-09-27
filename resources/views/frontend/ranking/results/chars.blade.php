<table class="table table-hover table-striped table-responsive-sm">
    <thead>
    <tr>
        <th scope="col">{{ __('ranking.table.rank') }}</th>
        <th scope="col">{{ __('ranking.table.charname') }}</th>
        <th scope="col" class="d-none d-sm-table-cell">{{ __('ranking.table.guild') }}</th>
        <th scope="col">{{ __('ranking.table.level') }}</th>
        <th scope="col">{{ __('ranking.table.itempoints') }}</th>
    </tr>
    </thead>
    <tbody>
    @forelse($data as $key => $player)
        @if($player->CharName16)
        <tr>
            <th scope="row">
                {{ $data->firstItem() + $key }}
            </th>
            <td class="col-auto">
                <img src="{{ asset('image/sro/chars/') }}/{{ $player->RefObjID }}.gif"
                     loading="lazy"
                     class="img-fluid d-none d-sm-inline" width="16" height="16" alt="{{ $player->CharName16 }}">
                <a href="{{ route('information-player', ['CharName16' => Str::lower($player->CharName16)]) }}">
                    {{ $player->CharName16 }}</a>
                <a class="small"
                   href="{{ route('information-player', ['CharName16' => Str::lower($player->CharName16)]) }}"
                   target="_blank">
                    <i class="fas fa-external-link-alt"></i>
                </a>
            </td>
            <td class="d-none d-sm-table-cell">
                <a href="{{ $player->getGuildUser ?
                route('information-guild', ['name' => $player->getGuildUser->Name]) : '#' }}">
                    {{ $player->getGuildUser ? $player->getGuildUser->Name : '' }}
                </a>
            </td>
            <td>
                {{ $player->CurLevel }}
            </td>
            <td>{{ $player->ItemPoints }}</td>
        </tr>
        @endif
    @empty
        <tr>
            <th>{{ __('ranking.no-player') }}</th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
    @endforelse
    </tbody>
</table>
{!! $data->links() !!}
