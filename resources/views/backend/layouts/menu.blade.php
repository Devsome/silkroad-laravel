<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('index-backend') }}">
        <div class="sidebar-brand-icon">
            <img src="{{ asset('image/sdl.png') }}" width="60">
        </div>
        <div class="sidebar-brand-text mx-3">
            {{ __('backend/menu.title') }}
        </div>
    </a>
    <hr class="sidebar-divider my-0">
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('index-backend') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>{{ __('backend/menu.dashboard') }}</span></a>
    </li>

    <hr class="sidebar-divider">

    <div class="sidebar-heading">
        {{ __('backend/menu.web') }}
    </div>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('backend-news.news.index') }}">
            <i class="fas fa-fw fa-newspaper"></i>
            <span>{{ __('backend/menu.news') }}</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('downloads-index-backend') }}">
            <i class="fas fa-fw fa-download"></i>
            <span>{{ __('backend/menu.downloads') }}</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('images-index-backend') }}">
            <i class="fas fa-fw fa-images"></i>
            <span>{{ __('backend/menu.images') }}</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('ticket-index-list') }}">
            <i class="fas fa-fw fa-ticket-alt"></i>
            <span>{{ __('backend/menu.tickets') }}</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('ticket-settings-backend') }}">
            <i class="fas fa-fw fa-cogs"></i>
            <span>{{ __('backend/menu.tickets-settings') }}</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('voucher-index-backend') }}">
            <i class="fas fa-fw fa-gift"></i>
            <span>{{ __('backend/menu.voucher') }}</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="collapse"
           data-target="#collapseDonations" aria-expanded="true" aria-controls="collapseDonations">
            <i class="fas fa-fw fa-dollar-sign"></i>
            <span>{{ __('backend/menu.donations.title') }}</span>
        </a>
        <div id="collapseDonations" class="collapse"
             aria-labelledby="headingDonations" data-parent="#accordionSidebar" style="">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('donations-index-backend') }}">
                    {{ __('backend/menu.donations.settings') }}
                </a>
                <h6 class="collapse-header">
                    {{ __('backend/menu.donations.head') }}
                </h6>
                <a class="collapse-item" href="{{ route('method-paypal-backend') }}">
                    {{ __('backend/menu.donations.paypal') }}
                </a>
                <a class="collapse-item" href="{{ route('method-stripe-backend') }}">
                    {{ __('backend/menu.donations.stripe') }}
                </a>
                @if(Route::has('dev.payop.index'))
                    <a class="collapse-item" href="#">
                        {{ __('backend/menu.donations.payop') }}
                    </a>
                @endif
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('backlinks-index-backend') }}">
            <i class="fas fa-fw fa-link"></i>
            <span>{{ __('backend/menu.backlinks') }}</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('supporters-online-index-backend') }}">
            <i class="fas fa-fw fa-hands-helping"></i>
            <span>{{ __('backend/menu.supporters') }}</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('auctionshouse-settings-backend') }}">
            <i class="fas fa-fw fa-boxes"></i>
            <span>{{ __('backend/menu.auctionshouse') }}</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('server-information-index-backend') }}">
            <i class="fas fa-fw fa-info"></i>
            <span>{{ __('backend/menu.serverinformation') }}</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('pages.index') }}">
            <i class="fas fa-fw fa-pager"></i>
            <span>{{ __('backend/menu.pages') }}</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('server-rules-index-backend') }}">
            <i class="fas fa-fw fa-paragraph"></i>
            <span>{{ __('backend/menu.serverrules') }}</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('site-settings-backend') }}">
            <i class="fas fa-fw fa-cog"></i>
            <span>{{ __('backend/menu.settings') }}</span>
        </a>
    </li>


    <div class="sidebar-heading">
        {{ __('backend/menu.silkroad') }}
    </div>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('sro-notice-index-backend') }}">
            <i class="far fa-fw fa-newspaper"></i>
            <span>{{ __('backend/menu.notice') }}</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('sro-user-index-user-backend') }}">
            <i class="fas fa-fw fa-user"></i>
            <span>{{ __('backend/menu.tbuser') }}</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('sro-players-index-backend') }}">
            <i class="fas fa-fw fa-users"></i>
            <span>{{ __('backend/menu.chars') }}</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('sro-guild-index-backend') }}">
            <i class="fas fa-fw fa-compress"></i>
            <span>{{ __('backend/menu.guild') }}</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('worldmap-index-backend') }}">
            <i class="fas fa-fw fa-globe-americas"></i>
            <span>{{ __('backend/menu.worldmap') }}</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="collapse"
           data-target="#collapseHideRanking" aria-expanded="true" aria-controls="collapseHideRanking">
            <i class="fas fa-fw fa-eye-slash"></i>
            <span>{{ __('backend/menu.hide-ranking') }}</span>
        </a>
        <div id="collapseHideRanking" class="collapse"
             aria-labelledby="headingHideRanking" data-parent="#accordionSidebar" style="">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('hide-ranking-index-backend') }}">
                    {{ __('backend/menu.hide-ranking-char') }}
                </a>
                <a class="collapse-item" href="{{ route('hide-ranking-guild-index-backend') }}">
                    {{ __('backend/menu.hide-ranking-guild') }}
                </a>
            </div>
        </div>
    </li>

    <div class="sidebar-heading">
        {{ __('backend/menu.log') }}
    </div>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('smclog-index-backend') }}">
            <i class="fas fa-fw fa-table"></i>
            <span>{{ __('backend/menu.smc-log') }}</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('users-created-counts-backend') }}">
            <i class="fas fa-fw fa-user-clock"></i>
            <span>{{ __('backend/menu.users-created') }}</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('users-blocked-backend') }}">
            <i class="fas fa-fw fa-ban"></i>
            <span>{{ __('backend/menu.users-blocked') }}</span>
        </a>
    </li>


    <hr class="sidebar-divider d-none d-md-block">
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
