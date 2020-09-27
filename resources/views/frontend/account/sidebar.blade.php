<div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12 d-none d-lg-block">
    <p class="font-weight-light pt-2 pb-2 font-weight-bold">
        {{ __('sidebar.home.title') }}
    </p>
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
                <span id="timerCurrent">{{ \Carbon\Carbon::now()->format('H:i:s') }}</span>
            </div>
        </li>
    </ul>

    <p class="font-weight-light pt-4 font-weight-bold">
        {{ __('sidebar.home.currency') }}
    </p>
    <ul class="list-group list-unstyled small ">
        <li class="pb-1">
            <div class="float-left">
                <i class="fa fa-fw fa-coins"></i> {{ __('sidebar.home.silk') }}
            </div>
            <div class="float-right">
                {{ $SilkGoldProvider['silk'] }}
            </div>
        </li>
        <li class="pb-1">
            <div class="float-left">
                <i class="fa fa-fw fa-coins"></i> {{ __('sidebar.home.silk-gift') }}
            </div>
            <div class="float-right">
                {{ $SilkGoldProvider['silk_gift'] }}
            </div>
        </li>
        <li class="pb-1">
            <div class="float-left">
                <i class="fa fa-fw fa-coins"></i> {{ __('sidebar.home.web-inventory-gold') }}
            </div>
            <div class="float-right">
                {{ number_format($SilkGoldProvider['web_inventory_gold'], 0, ',', '.') }}
            </div>
        </li>
    </ul>

    <p class="font-weight-light pt-4 font-weight-bold">
        {{ __('sidebar.home.references') }}
    </p>

    <div class="list-group small">
        <a href="{{ route('home') }}" class="list-group-item list-group-item-action">
            {{ __('sidebar.home.dashboard') }}
        </a>
        <a href="{{ route('home-chars-list') }}" class="list-group-item list-group-item-action">
            {{ __('sidebar.home.charlist') }}
        </a>
        <a href="{{ route('home-settings') }}" class="list-group-item list-group-item-action">
            {{ __('sidebar.home.settings') }}
        </a>
        <a href="{{ route('donations-index') }}" class="list-group-item list-group-item-action">
            {{ __('sidebar.home.donate') }}
        </a>
        <a href="{{ route('home-referral') }}" class="list-group-item list-group-item-action">
            {{ __('sidebar.home.ref') }}
        </a>
        <a href="{{ route('home-tickets') }}" class="list-group-item list-group-item-action">
            {{ __('sidebar.home.tickets') }}
        </a>
        <a href="{{ route('home-voucher') }}" class="list-group-item list-group-item-action">
            {{ __('sidebar.home.vouchers') }}
        </a>
        <a href="{{ route('web-inventory-index') }}" class="list-group-item list-group-item-action">
            {{ __('sidebar.home.web-inventory') }}
        </a>
    </div>
</div>
