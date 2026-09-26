<nav class="menu jtv-main-nav">
    <div class="container jtv-nav-container">
        <div class="mobile-toggle">
            <a href="#" data-toggle="menu" data-target="#menu-list"><i class="fa-solid fa-bars"></i></a>
        </div>
        <div class="mobile-toggle">
            <a href="#" data-toggle="sidebar" data-target="#sidebar"><i class="arrow-left"></i></a>
        </div>
        <div id="menu-list" class="jtv-nav-list-wrap">
            @php $menus = $menuHeader @endphp
            @if($menus)
                <ul class="nav-list">
                    @php($isHome = request()->is('/') || request()->is(''))
                    <li class="jtv-nav-home-link @if($isHome)active current-menu-item @endif">
                        <a href="{{ url('/') }}" title="Home" aria-label="Home"><i class="fa-solid fa-house"></i></a>
                    </li>
                    @foreach($menus as $menu)
                        @php($isCurrentMenu = !empty($menu['link']) && url()->current() === url($menu['link']))
                        @php($isLiveMenu = !empty($menu['link']) && \Illuminate\Support\Str::endsWith(rtrim($menu['link'], '/'), '/live-tv'))
                        <li class="@if($menu['child'])dropdown magz-dropdown @endif @if($isCurrentMenu)active current-menu-item @endif @if($isLiveMenu)jtv-nav-live-item @endif">
                            @if($isLiveMenu)
                                <a href="{{ $menu['link'] }}" title="{{ $menu['label'] }}">
                                    <span class="jtv-live-ico" aria-hidden="true"><i class="fa-solid fa-tower-broadcast"></i></span>
                                    <span class="jtv-live-txt">{{ $menu['label'] }}</span>
                                    <span class="jtv-live-tag">LIVE</span>
                                </a>
                            @else
                                <a href="{{ $menu['link'] }}" title="">{{ $menu['label'] }} @if($menu['child'])<i class="arrow-right"></i>@endif</a>
                            @endif
                            @if($menu['child'])
                                @include('frontend.magz.inc._child', ['childs'=>$menu['child']])
                            @endif
                        </li>
                    @endforeach
                </ul>
            @endif
            <ul class="float-end">
                <li class="jtv-nav-live"><a href="{{ url('/live-tv') }}">Live</a></li>
                <li class="jtv-nav-search">
                    <form class="jtv-search-form" action="{{ url('/search') }}" method="GET" role="search">
                        <input id="jtv-search-input" type="search" name="q" value="{{ request('q') }}" placeholder="খুঁজুন" aria-label="Search">
                            <button type="button" class="jtv-search-toggle" aria-label="Open search" aria-expanded="false" aria-controls="jtv-search-input">
                                <i class="fa-solid fa-magnifying-glass" aria-hidden="true"></i>
                            </button>
                    </form>
                </li>
                @if($displayLanguage == 'y')
                <li class="dropdown magz-dropdown">
                    <a href="javascript:;"><span class="flag-icon flag-icon-{{ \App\Helpers\LocalizationHelper::getCurrentLocaleFlag(LaravelLocalization::getCurrentLocaleRegional()) }} mr-1"></span> <span class="d-none d-sm-inline">{{ LaravelLocalization::getCurrentLocaleName() }}</span></a>
                    @if(count($languages) > 1)
                    <ul class="dropdown-menu">
                        @foreach($languages as $language)
                            @if($language->language != LaravelLocalization::getCurrentLocale())
                                <li>
                                    <a rel="alternate" hreflang="{{ $language->language }}" href="{{ LaravelLocalization::getLocalizedURL($language->language, null, [], true) }}">
                                        <span class="flag-icon flag-icon-{{ Str::lower($language->country_code) }} mr-1"></span>
                                        {{ $language->name }}
                                    </a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                    @endif
                </li>
                @endif
                <li>
                    <a id="icon_system" onclick="toDarkMode()" title="Switch to dark mode" class="text-gray-500">
                        <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M12 2A10 10 0 0 0 2 12A10 10 0 0 0 12 22A10 10 0 0 0 22 12A10 10 0 0 0 12 2M12 4A8 8 0 0 1 20 12A8 8 0 0 1 12 20V4Z"></path>
                        </svg>
                    </a>
                    <a id="icon_sun" onclick="toSystemMode()" title="Switch to system theme">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-sun" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <circle cx="12" cy="12" r="4"></circle>
                            <path d="M3 12h1m8 -9v1m8 8h1m-9 8v1m-6.4 -15.4l.7 .7m12.1 -.7l-.7 .7m0 11.4l.7 .7m-12.1 -.7l-.7 .7"></path>
                        </svg>
                    </a>
                    <a id="icon_moon" onclick="toLightMode()" title="Switch to light mode">
                        <svg xmlns="http://www.w3.org/2000/svg" height="1.5em" viewBox="0 0 93.42 96.95"><style>svg{fill:#ffffff}</style><path d="M30.71,11.93A55.28,55.28,0,0,0,84.5,78.33a43.23,43.23,0,1,1-53.79-66.4M40.57,1.52A49.21,49.21,0,1,0,96.71,70.87,49.22,49.22,0,0,1,40.57,1.52Z" transform="translate(-3.29 -1.52)"/><polygon points="71.83 35.38 61.1 29.61 50.27 35.19 52.43 23.2 43.79 14.62 55.86 12.98 61.34 2.1 66.64 13.07 78.67 14.93 69.88 23.35 71.83 35.38"/><polygon points="85.12 51.08 82.75 55.59 85.13 60.1 80.11 59.24 76.55 62.9 75.82 57.85 71.25 55.6 75.81 53.34 76.54 48.3 80.1 51.95 85.12 51.08"/></svg>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

@once
<style>
    /* Live streaming menu item: amber badge (stands out on the green nav), pulsing icon, shine. */
    body.skin-magz nav.jtv-main-nav ul.nav-list > li.jtv-nav-live-item {
        display: flex !important;
        align-items: center !important;
        padding: 0 6px !important;
        background: transparent !important;
    }
    body.skin-magz.jtv-homepage.jtv-homepage.jtv-homepage nav.jtv-main-nav ul.nav-list > li.jtv-nav-live-item > a,
    body.skin-magz.jtv-homepage.jtv-homepage.jtv-homepage nav.jtv-main-nav ul.nav-list > li.jtv-nav-live-item:hover > a,
    body.skin-magz.jtv-homepage.jtv-homepage.jtv-homepage nav.jtv-main-nav ul.nav-list > li.jtv-nav-live-item.active > a,
    body.skin-magz nav.jtv-main-nav ul.nav-list > li.jtv-nav-live-item > a {
        position: relative !important;
        display: inline-flex !important;
        align-items: center !important;
        gap: 8px !important;
        width: auto !important;
        height: 36px !important;
        min-height: 0 !important;
        margin: 0 !important;
        padding: 0 12px 0 8px !important;
        border-radius: 8px !important;
        color: #0d3b22 !important;
        font-weight: 800 !important;
        line-height: 1 !important;
        white-space: nowrap !important;
        background: linear-gradient(120deg, #ffd200, #ffae00, #ffd200) !important;
        background-size: 200% 100% !important;
        box-shadow: 0 0 0 0 rgba(255, 196, 0, .65) !important;
        overflow: hidden !important;
        animation: jtvLiveGlow 2s infinite, jtvLiveShift 4s linear infinite !important;
    }
    body.skin-magz.jtv-homepage.jtv-homepage.jtv-homepage nav.jtv-main-nav ul.nav-list > li.jtv-nav-live-item > a:hover {
        transform: translateY(-1px);
        filter: brightness(1.06);
    }
    body.skin-magz nav.jtv-main-nav ul.nav-list > li.jtv-nav-live-item > a::after {
        content: '' !important;
        position: absolute !important;
        top: 0; bottom: 0; left: -60%;
        width: 40%;
        background: linear-gradient(100deg, transparent, rgba(255, 255, 255, .7), transparent);
        transform: skewX(-20deg);
        animation: jtvLiveShine 3s ease-in-out infinite;
        pointer-events: none;
    }
    body.skin-magz nav.jtv-main-nav .jtv-live-ico {
        position: relative !important; flex: none !important; display: grid !important; place-items: center !important;
        width: 24px !important; height: 24px !important; margin: 0 !important; padding: 0 !important; color: #0d3b22 !important; line-height: 1 !important;
    }
    body.skin-magz nav.jtv-main-nav .jtv-live-ico i {
        position: static !important; display: block !important; width: auto !important; height: auto !important;
        margin: 0 !important; padding: 0 !important; font-size: 14px !important; line-height: 1 !important; transform-origin: center !important;
    }
    body.skin-magz nav.jtv-main-nav .jtv-live-txt { margin: 0 !important; padding: 0 !important; line-height: 1 !important; }
    body.skin-magz nav.jtv-main-nav .jtv-live-tag { margin: 0 !important; line-height: 1 !important; }
    .jtv-live-ico::before, .jtv-live-ico::after {
        content: ''; position: absolute; top: 0; left: 0; width: 100%; height: 100%; box-sizing: border-box; border: 2px solid rgba(13, 59, 34, .55); border-radius: 50%; transform-origin: center;
        animation: jtvLiveRing 1.8s ease-out infinite;
    }
    .jtv-live-ico::after { animation-delay: .9s; }
    .jtv-live-ico i { animation: jtvLiveBeat 1.2s ease-in-out infinite; }
    .jtv-live-txt { color: #0d3b22; font-size: 14px; font-weight: 800; }
    .jtv-live-tag {
        padding: 3px 6px; border-radius: 4px; background: #0d3b22; color: #ffd200;
        font-size: 10px; font-weight: 900; letter-spacing: .8px; animation: jtvLiveBlink 1.2s ease-in-out infinite;
    }
    @keyframes jtvLiveRing { 0% { transform: scale(.7); opacity: .9; } 100% { transform: scale(1.6); opacity: 0; } }
    @keyframes jtvLiveBeat { 0%, 100% { transform: scale(1); } 50% { transform: scale(1.15); } }
    @keyframes jtvLiveBlink { 0%, 100% { opacity: 1; } 50% { opacity: .55; } }
    @keyframes jtvLiveGlow { 0% { box-shadow: 0 0 0 0 rgba(255, 196, 0, .6); } 70% { box-shadow: 0 0 0 9px rgba(255, 196, 0, 0); } 100% { box-shadow: 0 0 0 0 rgba(255, 196, 0, 0); } }
    @keyframes jtvLiveShift { 0% { background-position: 0 0; } 100% { background-position: 200% 0; } }
    @keyframes jtvLiveShine { 0% { left: -60%; } 55%, 100% { left: 130%; } }
    @media (prefers-reduced-motion: reduce) {
        body.skin-magz nav.jtv-main-nav ul.nav-list > li.jtv-nav-live-item > a, .jtv-live-ico::before, .jtv-live-ico::after, .jtv-live-ico i, .jtv-live-tag { animation: none !important; }
        body.skin-magz nav.jtv-main-nav ul.nav-list > li.jtv-nav-live-item > a::after { display: none !important; }
    }
    @media (max-width: 991px) {
        body.skin-magz nav.jtv-main-nav ul.nav-list > li.jtv-nav-live-item { padding: 6px 12px !important; }
    }
</style>
@endonce
