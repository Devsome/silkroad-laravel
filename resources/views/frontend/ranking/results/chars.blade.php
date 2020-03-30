<table class="table table-hover table-striped table-responsive-sm">
    <thead>
    <tr>
        <th scope="col">{{ __('ranking.table.rank') }}</th>
        <th scope="col">{{ __('ranking.table.charname') }}</th>
        <th scope="col" class="d-none d-sm-block">{{ __('ranking.table.guild') }}</th>
        <th scope="col">{{ __('ranking.table.level') }}</th>
        <th scope="col">{{ __('ranking.table.itempoints') }}</th>
    </tr>
    </thead>
    <tbody>
    @forelse($data as $player)
        <tr>
            <th scope="row">
                {{ $loop->iteration }}
            </th>
            <td class="col-auto">
                <img src="{{ asset('image/chars/') }}/{{ $player->RefObjID }}.gif"
                     class="img-fluid d-none d-sm-inline" width="16" height="16" alt="{{ $player->CharName16 }}">
                <a href="#">
                    {{ $player->CharName16 }}
                </a>
            </td>
            <td class="d-none d-sm-block">
                <a href="#">{{ $player->getGuildUser ? $player->getGuildUser->Name : '' }}</a>
            </td>
            <td>
                {{ $player->CurLevel }}
            </td>
            <td>{{ $player->ItemPoints }}</td>
        </tr>
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
