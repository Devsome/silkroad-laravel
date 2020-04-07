<div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12 d-none d-lg-block">
    <p class="font-weight-light pt-2 pb-2 font-weight-bold">{{ __('sidebar.information.title') }}</p>
    <ul class="list-group list-unstyled small">
        <li>
            <div class="float-left">
                <i class="fa fa-fw fa-desktop"></i> {{ __('sidebar.information.online') }}
            </div>
            <div class="float-right">
                @include('layouts.playercount')
            </div>
        </li>
        <li class="pb-1 pt-2">
            <div class="float-left">
                <i class="fa fa-fw fa-clock"></i> {{ __('sidebar.information.time') }}
            </div>
            <div class="float-right">
                <span class="currTime">00:00:00</span>
            </div>
        </li>
    </ul>

    <ul class="list-group list-unstyled small pt-3">
        <li class="pb-1">
            <div class="float-left">
                <i class="fas fa-fw fa-check"></i> {{ __('sidebar.information.cap') }}
            </div>
            <div class="float-right">
                {{ config('app.sro_cap') }}
            </div>
        </li>
        <li class="pb-1">
            <div class="float-left">
                <i class="fa fa-fw fa-flask"></i> {{ __('sidebar.information.exp-sp') }}
            </div>
            <div class="float-right">
                {{ config('app.sro_exp') }}x
            </div>
        </li>
        <li class="pb-1">
            <div class="float-left">
                <i class="fa fa-fw fa-users"></i> {{ __('sidebar.information.party-exp') }}
            </div>
            <div class="float-right">
                {{ config('app.sro_exp_party') }}x
            </div>
        </li>
        <li class="pb-1">
            <div class="float-left">
                <i class="fa fa-fw fa-coins"></i> {{ __('sidebar.information.gold') }}
            </div>
            <div class="float-right">
                {{ config('app.sro_exp_gold') }}x
            </div>
        </li>
        <li class="pb-1">
            <div class="float-left">
                <i class="fa fa-fw fa-coins"></i> {{ __('sidebar.information.drop') }}
            </div>
            <div class="float-right">
                {{ config('app.sro_exp_drop') }}x
            </div>
        </li>
        <li class="pb-1">
            <div class="float-left">
                <i class="fa fa-fw fa-star"></i> {{ __('sidebar.information.trade-goods') }}
            </div>
            <div class="float-right">
                {{ config('app.sro_exp_job') }}x
            </div>
        </li>
    </ul>

    <ul class="list-group list-unstyled small pt-3">
        <li class="pb-1">
            <div class="float-left">
                <i class="fa fa-fw fa-exclamation"></i> {{ __('sidebar.information.ip-limit') }}
            </div>
            <div class="float-right">
                {{ config('app.sro_ip_limit') }}
            </div>
        </li>
        <li class="pb-1">
            <div class="float-left">
                <i class="fa fa-fw fa-exclamation"></i> {{ __('sidebar.information.pc-limit') }}
            </div>
            <div class="float-right">
                {{ config('app.sro_hwid_limit') }}
            </div>
        </li>
    </ul>
    @include('layouts.fortress')

    @include('layouts.discord')
</div>
