<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    <ul class="navbar-nav ml-auto">

        <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown"
               aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw"></i>
                <span class="badge badge-danger badge-counter">{{ $ticketNewProvider['count'] }}</span>
            </a>
            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                 aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header">
                    {{ $ticketNewProvider['count'] > 0 ? __('backend/navbar.notification-title') :
                    __('backend/navbar.notification-no-tickets-title') }}
                </h6>
                @forelse($ticketNewProvider['ticket'] as $ticket)
                    <span class="dropdown-item d-flex align-items-center">
                        <div class="mr-3">
                            <div class="icon-circle bg-primary">
                                <i class="fa fa-ticket text-white"></i>
                            </div>
                        </div>
                        <div>
                            <div class="small text-gray-500">{{ $ticket->created_at->diffForHumans() }}</div>
                            <span>{{ Str::limit(ucfirst($ticket->title), 30, '...') }}</span>
                        </div>
                    </span>
                @empty
                    <span class="dropdown-item d-flex align-items-center">
                        <div class="py-3">
                            {{ __('backend/navbar.notification-no-tickets') }}
                        </div>
                    </span>
                @endforelse
                <a class="dropdown-item text-center small text-gray-500" href="{{ route('ticket-index-list') }}">
                    {{ __('backend/navbar.notification-show-all') }}
                </a>
            </div>
        </li>

        <div class="topbar-divider d-none d-sm-block"></div>

        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
               aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                    {{ __('backend/navbar.user', ['user' => Auth::user()->name]) }}
                </span>
                <i class="fa fa-caret-down"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="{{ url('/') }}">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    {{ __('backend/navbar.back-to-page') }}
                </a>
            </div>
        </li>

    </ul>

</nav>
