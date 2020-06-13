<div class="accordion" id="accordionSupporter">
        <div id="headingTwo">
            <p class="collapsed font-weight-light font-weight-bold pt-3"
               data-toggle="collapse" data-target="#collapseSupporter" aria-expanded="false" aria-controls="collapseSupporter">
                {{ __('supportersonline.title') }}
            </p>
        </div>
        <div id="collapseSupporter" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSupporter">
            <ul class="list-group list-unstyled small">
                @forelse($SupportersOnlineProvider as $supporter)
                    @if($supporter->getCharOnlineOffline->status === \App\Model\SRO\Account\OnlineOfflineLog::STATUS_LOGGED_IN)
                        <li style="padding-left: 16px;" class="pb-1">
                            <a href="{{ route('information-player', [
                                'CharName16' => Str::lower($supporter->charname)
                            ]) }}" target="_blank">
                                {{ $supporter->charname }}
                            </a>
                        </li>
                    @endif
                @empty
                    {{ __('supportersonline.no-online') }}
                @endforelse
            </ul>
        </div>
</div>
