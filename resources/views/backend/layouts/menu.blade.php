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
        <a class="nav-link" href="{{ route('downloads-index-backend') }}">
            <i class="fas fa-fw fa-download"></i>
            <span>{{ __('backend/menu.downloads') }}</span>
        </a>
    </li>

    <div class="sidebar-heading">
        {{ __('backend/menu.silkroad') }}
    </div>

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


    <div class="sidebar-heading">
        {{ __('backend/menu.log') }}
    </div>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('smclog-index-backend') }}">
            <i class="fas fa-fw fa-table"></i>
            <span>{{ __('backend/menu.smc-log') }}</span>
        </a>
    </li>


    <hr class="sidebar-divider d-none d-md-block">
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
