<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('index-backend') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-cog"></i>
        </div>
        <div class="sidebar-brand-text mx-3">{{ env('APP_NAME') }}</div>
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
        <a class="nav-link" href="{{ route('backlinks-index-backend') }}">
            <i class="fas fa-fw fa-link"></i>
            <span>{{ __('backend/menu.backlinks') }}</span>
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
        <a class="nav-link" href="{{ route('hide-ranking-index-backend') }}">
            <i class="fas fa-fw fa-eye-slash"></i>
            <span>{{ __('backend/menu.hide-ranking') }}</span>
        </a>
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
