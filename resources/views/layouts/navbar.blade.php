<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Devsome') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="{{ __('navbar.toggle') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('downloads-index') }}">
                        {{ __('navbar.nav.download') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('ranking-index') }}">
                        {{ __('navbar.nav.ranking') }}
                    </a>
                </li>
                @auth
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('auctions-house') }}">
                            {{ __('navbar.nav.auction-house') }}
                        </a>
                    </li>
                @endauth
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('worldmap') }}">
                        {{ __('navbar.nav.worldmap') }}
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ __('navbar.nav.pages') }} <span class="caret"></span>
                    </a>
                    <div class="dropdown-menu navbar-dropdown dropdown-menu-right pr-0 pl-0" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('server-information') }}">
                            {{ __('navbar.nav.serverinformation') }}
                        </a>
                        @foreach($NavbarPagesProvider as $pages)
                            <a class="dropdown-item"
                               href="{{ route('pages-content', ['slug' => $pages->slug]) }}">
                                {{ $pages->title }}
                            </a>
                        @endforeach
                    </div>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                @if(count(config('language')) > 1)
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ config('language.' . Session::get('locale', 'en') . '.name') }} <i class="fa fa-language"></i><span class="caret"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    @foreach(config('language') as $key => $lang)
                        @if($key !== 'example')
                            <a class="dropdown-item" href="{{ route('change-language', ['lang' => $key]) }}">
                                <img class="small" src="{{ $lang['icon'] }}" width="26px" height="16px"> {{ $lang['name'] }}
                            </a>
                        @endif
                    @endforeach
                    </div>
                </li>
                @endif

                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('navbar.login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('navbar.register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('home') }}">
                                {{ __('navbar.home') }}
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                {{ __('navbar.logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                            @role('administrator')
                            <a class="dropdown-item" href="{{ route('index-backend') }}">
                                {{ __('navbar.backend') }}
                            </a>
                            @endrole
                        </div>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('notification') }}" class="nav-link">
                            <i class="fas fa-bell"></i>
                            @if($NotificationsCountProvider > 0)
                                <span class="badge badge-danger align-top">
                                {{ $NotificationsCountProvider }}
                            </span>
                            @endif
                        </a>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
