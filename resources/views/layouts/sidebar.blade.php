<div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12 d-none d-lg-block">
    <p class="font-weight-light pt-2 pb-2 font-weight-bold">{{ __('sidebar.information.title') }}</p>
    <ul class="list-group list-unstyled small">
        <li>
            <div class="float-left">
                <i class="fa fa-fw fa-desktop"></i> {{ __('sidebar.information.online') }}
            </div>
            <div class="float-right">
                @include('theme::layouts.playercount')
            </div>
        </li>
        <li class="pb-1 pt-2">
            <div class="float-left">
                <i class="fa fa-fw fa-clock"></i> {{ __('sidebar.information.time') }}
            </div>
            <div class="float-right">
                <span id="timerCurrent">{{ \Carbon\Carbon::now()->format('H:i:s') }}</span>
            </div>
        </li>
    </ul>

    <ul class="list-group list-unstyled small pt-3">
        <li class="pb-1">
            <div class="float-left">
                <i class="fas fa-fw fa-check"></i> {{ __('sidebar.information.cap') }}
            </div>
            <div class="float-right">
                {{ config('siteSettings.sro_cap', 110) }}
            </div>
        </li>
        <li class="pb-1">
            <div class="float-left">
                <i class="fa fa-fw fa-flask"></i> {{ __('sidebar.information.exp-sp') }}
            </div>
            <div class="float-right">
                {{ config('siteSettings.sro_exp', 1) }}x
            </div>
        </li>
        <li class="pb-1">
            <div class="float-left">
                <i class="fa fa-fw fa-users"></i> {{ __('sidebar.information.party-exp') }}
            </div>
            <div class="float-right">
                {{ config('siteSettings.sro_exp_party', 1) }}x
            </div>
        </li>
        <li class="pb-1">
            <div class="float-left">
                <i class="fa fa-fw fa-coins"></i> {{ __('sidebar.information.gold') }}
            </div>
            <div class="float-right">
                {{ config('siteSettings.sro_exp_gold', 1) }}x
            </div>
        </li>
        <li class="pb-1">
            <div class="float-left">
                <i class="fa fa-fw fa-coins"></i> {{ __('sidebar.information.drop') }}
            </div>
            <div class="float-right">
                {{ config('siteSettings.sro_exp_drop', 1) }}x
            </div>
        </li>
        <li class="pb-1">
            <div class="float-left">
                <i class="fa fa-fw fa-star"></i> {{ __('sidebar.information.trade-goods') }}
            </div>
            <div class="float-right">
                {{ config('siteSettings.sro_exp_job', 1) }}x
            </div>
        </li>
    </ul>

    <ul class="list-group list-unstyled small pt-3">
        @if(config('siteSettings.sro_ip_limit'))
        <li class="pb-1">
            <div class="float-left">
                <i class="fa fa-fw fa-exclamation"></i> {{ __('sidebar.information.ip-limit') }}
            </div>
            <div class="float-right">
                {{ config('siteSettings.sro_ip_limit', 1) }}
            </div>
        </li>
        @endif
        @if(config('siteSettings.sro_hwid_limit'))
        <li class="pb-1">
            <div class="float-left">
                <i class="fa fa-fw fa-exclamation"></i> {{ __('sidebar.information.pc-limit') }}
            </div>
            <div class="float-right">
                {{ config('siteSettings.sro_hwid_limit', 1) }}
            </div>
        </li>
        @endif
    </ul>

    @include('theme::layouts.supportersonline')

    @include('theme::layouts.latestkills')

    @include('theme::layouts.fortress')

    @include('theme::layouts.jobranking')

    @include('theme::layouts.timers')

    @include('theme::layouts.discord')
</div>
