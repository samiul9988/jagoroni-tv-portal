@inject('imageHelper', 'App\Helpers\ImageHelper')

<nav class="menu">
    <div class="container">
        <div class="brand">
            <a href="/">
                <img class="logo_dark" src="{{ $imageHelper::webLogoLight() }}" alt="Web Logo">
                <img class="logo_light" src="{{ $imageHelper::webLogoDark() }}" alt="Web Logo">
            </a>
        </div>
        <div class="mobile-toggle">
            <a href="#" data-toggle="menu" data-target="#menu-list"><i class="fa-solid fa-bars"></i></a>
        </div>
        <div class="mobile-toggle">
            <a href="#" data-toggle="sidebar" data-target="#sidebar"><i class="arrow-left"></i></a>
        </div>
        <div id="menu-list">
            @php $menus = $menuHeader @endphp
            @if($menus)
                <ul class="nav-list">
                    @foreach($menus as $menu)
                        <li class="@if($menu['child'])dropdown magz-dropdown @endif">
                            <a href="{{ $menu['link'] }}" title="">{{ $menu['label'] }} @if($menu['child'])<i class="arrow-right"></i>@endif</a>
                            @if($menu['child'])
                                @include('frontend.magz.inc._child', ['childs'=>$menu['child']])
                            @endif
                        </li>
                    @endforeach
                </ul>
            @endif
            <ul class="float-end">
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
