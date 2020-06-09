<footer id="footer" class="mt-5">
    <hr>
    <div class="container">
        <div class="row">
            <div class="offset-sm-2 col-sm-2">
                <h5>
                    {{ __('footer.short-links.title') }}
                </h5>
                <ul>
                    <li>
                        <a href="{{ url('/') }}">
                            {{ __('footer.short-links.home') }}
                        </a>
                    </li>
                    @guest
                        <li>
                            <a href="{{ route('register') }}">
                                {{ __('footer.short-links.sign-up') }}
                            </a>
                        </li>
                    @endguest
                    @auth
                        <li>
                            <a href="{{ route('logout') }}"
                               onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                {{ __('footer.short-links.logout') }}
                            </a>
                        </li>
                    @else
                        <li>
                            <a href="{{ route('login') }}">
                                {{ __('footer.short-links.login') }}
                            </a>
                        </li>
                    @endauth
                </ul>
            </div>
            <div class="col-sm-2">
                <h5>
                    {{ __('footer.general.title') }}
                </h5>
                <ul>
                    @if (Route::has('rules-index'))
                        <li>
                            <a href="{{ route('rules-index') }}">
                                {{ __('footer.general.rules') }}
                            </a>
                        </li>
                    @endif
                    @if(config('siteSettings.contact_email'))
                    <li>
                        <a href="mailto:{{ config('siteSettings.contact_email') }}">
                            {{ __('footer.general.email') }}
                        </a>
                    </li>
                    @endif
                </ul>
            </div>
            <div class="col-sm-2">
                <h5>
                    {{ __('footer.backlinks.title') }}
                </h5>
                <ul>
                    @forelse($BacklinksProvider as $backlink)
                        <li>
                            <a href="{{ $backlink->url }}" target="_blank" rel="noopener">
                                {{ $backlink->name }}
                            </a>
                        </li>
                    @empty
                        <span class="small">
                                {{ __('footer.backlinks.no-backlink') }}
                        </span>
                    @endforelse
                </ul>
            </div>
            <div class="col-sm-3">
                <div class="social-networks">
                    @if(config('siteSettings.facebook_url'))
                        <a href="{{ config('siteSettings.facebook_url') }}" rel="noopener"
                           class="facebook" target="_blank">
                            <i class="fab fa-facebook"></i>
                        </a>
                    @endif
                    @if(config('siteSettings.youtube_url'))
                        <a href="{{ config('siteSettings.youtube_url') }}" rel="noopener"
                           class="youtube" target="_blank">
                            <i class="fab fa-youtube"></i>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="footer-copyright small">
        <p>
            © {{ now()->year }} <a href="https://github.com/Devsome/silkroad-laravel/"
            target="_blank" rel="noopener" class="text-secondary">
                {{ config('app.name', 'DevsomeSRO') }}
            </a>
        </p>
    </div>
</footer>
