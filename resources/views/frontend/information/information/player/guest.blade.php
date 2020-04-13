<div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
    <div class="table-responsive">
        <table class="table">
            <tbody>
            <tr>
                <td class="table-nowrap">
                    {{ __('information.player.table.name') }}
                </td>
                <td>{{ $player->CharName16 }}</td>
            </tr>
            <tr>
                <td class="table-nowrap">
                    {{ __('information.player.table.level') }}
                </td>
                <td>{{ $player->CurLevel }}</td>
            </tr>
            <tr>
                <td class="table-nowrap">
                    {{ __('information.player.table.guild') }}
                </td>
                <td>
                    @if($player->getGuildUser)
                        <a href="{{ route('information-guild', ['name' => Str::lower($player->getGuildUser->Name)]) }}">
                            {{ $player->getGuildUser->Name }}</a>
                        <a href="{{ route('information-guild', ['name' => Str::lower($player->getGuildUser->Name)]) }}"
                           target="_blank">
                            <i class="fas small fa-external-link-alt pl-2"></i>
                        </a>
                    @else
                        {{ __('information.player.table.guild-none') }}
                    @endif
                </td>
            </tr>
            <tr>
                <td class="table-nowrap">
                    {{ __('information.player.table.online-state') }}
                </td>
                <td>
                    @if($player->getCharOnlineOfflineLoggedIn)
                        @if($player->getCharOnlineOfflineLoggedIn->status ===
                        \App\Model\SRO\Account\OnlineOfflineLog::STATUS_LOGGED_IN)
                            {{ __('information.player.table.logged-in') }}
                        @endif
                    @else
                        {{ __('information.player.table.logged-out') }}
                    @endif
                </td>
            </tr>
            <tr>
                <td class="table-nowrap">
                    {{ __('information.player.table.last-logout') }}
                </td>
                <td>
                    {{ $player->LastLogout }}
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
<div class="col-xl-3 col-lg-3 col-md-3 d-none d-lg-block">
    <div class="row">
        <div class="col-12">
            <label class="small">
                {{ __('information.player.table.avatar') }}
            </label>
            <img src="{{ asset('image/chars/') }}/{{ $player->RefObjID }}.gif"
                 class="rounded float-left rounded" alt="{{ $player->CharName16 }}">
        </div>
        @if($player->getAccountUser->getTbUser->getWebUser && $player->getAccountUser->getTbUser->getWebUser->show_map === 1)
            <div class="col-12 pt-3">
                <label class="small">
                    {{ __('information.player.table.map-all') }}
                </label>
                <div id="player-map"></div>
            </div>
        @endif
    </div>
</div>
