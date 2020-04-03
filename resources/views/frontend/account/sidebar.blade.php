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
                <span class="currTime">00:00:00</span>
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
                {{ $account->getTbUser->getSkSilk->silk_own }}
            </div>
        </li>
        <li class="pb-1">
            <div class="float-left">
                <i class="fa fa-fw fa-coins"></i> {{ __('sidebar.home.silk-gift') }}
            </div>
            <div class="float-right">
                {{ $account->getTbUser->getSkSilk->silk_gift }}
            </div>
        </li>
    </ul>

    <p class="font-weight-light pt-4 font-weight-bold">
        {{ __('sidebar.home.references') }}
    </p>
    <ul class="list-group list-unstyled small">
        <li class="pb-1">
            <div class="float-left">
                <a href="{{ route('home') }}">
                    {{ __('sidebar.home.dashboard') }}
                </a>
            </div>
        </li>
        <li class="pb-1">
            <div class="float-left">
                <a href="{{ route('home-chars-list') }}">
                    {{ __('sidebar.home.charlist') }}
                </a>
            </div>
        </li>
        <li class="pb-1">
            <div class="float-left">
                <a href="{{ route('home-settings') }}">
                    {{ __('sidebar.home.settings') }}
                </a>
            </div>
        </li>
        <li class="pb-1">
            <div class="float-left">
                <a href="#">
                    {{ __('sidebar.home.donate') }}
                </a>
            </div>
        </li>
    </ul>
</div>
