@isset($DiscordProvider)
<p class="font-weight-light font-weight-bold pt-3">
    {{ __('sidebar.discord.title') }} {{ __('sidebar.discord.online', ['online' => $DiscordProvider['presence_count']]) }}
    @if(array_key_exists('instant_invite', $DiscordProvider))
        @if($DiscordProvider['instant_invite'] !== null)
            <span class="float-right">
                <a href="{{ $DiscordProvider['instant_invite'] }}" target="_blank" rel="noopener">
                    {{ __('sidebar.discord.join') }}
                </a>
            </span>
        @endif
    @endif
</p>
<ul class="list-group small h-25 overflow-auto py-1 pl-1">
    @forelse($DiscordProvider['members'] as $discord)
        <li class="pb-1 border-bottom text-break">
            <span class="pull-left">
                <img src="{{ $discord['avatar_url'] }}" class="img-fluid img-rounded"
                     loading="lazy" style="max-width: 20px"/>
            </span>
            {{ $discord['username'] }}
            @if(array_key_exists('game', $discord))
                <span class="float-right small pt-1 pr-2">
                    {{ $discord['game']['name'] }}
                </span>
            @endif
        </li>
    @empty
        {{ __('sidebar.discord.empty') }}
    @endforelse
</ul>
@endisset