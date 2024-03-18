{{-- Navbar darkmode widget --}}

<li class="nav-item adminlte-darkmode-widget">

    <a href="javascript:void(0)" role="button" id="icon_system" onclick="toDarkMode()" title="Switch to dark mode" class="nav-link">
        <svg style="width:24px;height:24px" viewBox="0 0 24 24">
            <path fill="currentColor" d="M12 2A10 10 0 0 0 2 12A10 10 0 0 0 12 22A10 10 0 0 0 22 12A10 10 0 0 0 12 2M12 4A8 8 0 0 1 20 12A8 8 0 0 1 12 20V4Z"></path>
        </svg>
    </a>
    <a href="javascript:void(0)" role="button" id="icon_sun" onclick="toSystemMode()" title="Switch to system theme" class="nav-link">
        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-sun" style="width:24px;height:24px" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
            <circle cx="12" cy="12" r="4"></circle>
            <path d="M3 12h1m8 -9v1m8 8h1m-9 8v1m-6.4 -15.4l.7 .7m12.1 -.7l-.7 .7m0 11.4l.7 .7m-12.1 -.7l-.7 .7"></path>
        </svg>
    </a>
    <a href="javascript:void(0)" role="button" id="icon_moon" onclick="toLightMode()" title="Switch to light mode" class="nav-link">
        <svg xmlns="http://www.w3.org/2000/svg" style="width:21px;height:21px" viewBox="0 0 93.42 96.95"><style>svg{fill:#ffffff}</style><path d="M30.71,11.93A55.28,55.28,0,0,0,84.5,78.33a43.23,43.23,0,1,1-53.79-66.4M40.57,1.52A49.21,49.21,0,1,0,96.71,70.87,49.22,49.22,0,0,1,40.57,1.52Z" transform="translate(-3.29 -1.52)"/><polygon points="71.83 35.38 61.1 29.61 50.27 35.19 52.43 23.2 43.79 14.62 55.86 12.98 61.34 2.1 66.64 13.07 78.67 14.93 69.88 23.35 71.83 35.38"/><polygon points="85.12 51.08 82.75 55.59 85.13 60.1 80.11 59.24 76.55 62.9 75.82 57.85 71.25 55.6 75.81 53.34 76.54 48.3 80.1 51.95 85.12 51.08"/></svg>
    </a>

</li>

{{-- Add Javascript listener for the click event --}}

@once
    @push('js')
    
    <script>

        window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', e => {
            if (localStorage.dashboard_theme === 'system') {
                if (e.matches) {
                    document.documentElement.classList.add('dark');
                    document.documentElement.setAttribute('data-theme', 'dark');
                    document.querySelector('body').classList.add('dark-mode');

                    document.getElementsByClassName('main-header')[0].classList.add('navbar-black');
                    document.getElementsByClassName('main-header')[0].classList.add('navbar-dark');

                    document.getElementsByClassName('main-header')[0].classList.remove('navbar-white');
                    document.getElementsByClassName('main-header')[0].classList.remove('navbar-light');

                } else {
                    document.documentElement.classList.remove('dark');
                    document.documentElement.setAttribute('data-theme', 'light');
                    document.querySelector('body').classList.remove('dark-mode');

                    document.getElementsByClassName('main-header')[0].classList.remove('navbar-black');
                    document.getElementsByClassName('main-header')[0].classList.remove('navbar-dark');

                    document.getElementsByClassName('main-header')[0].classList.add('navbar-white');
                    document.getElementsByClassName('main-header')[0].classList.add('navbar-light');

                }
            }
        });

        function updateTheme() {
            if (!('dashboard_theme' in localStorage)) {
                localStorage.dashboard_theme = 'system';
            }

            switch (localStorage.dashboard_theme) {
                case 'system':
                    if (window.matchMedia('(prefers-color-scheme: dark)').matches) {
                        document.documentElement.classList.add('dark');
                        document.documentElement.setAttribute('data-theme', 'dark');
                        
                        document.querySelector('body').classList.add('dark-mode');

                        document.getElementsByClassName('main-header')[0].classList.add('navbar-black');
                        document.getElementsByClassName('main-header')[0].classList.add('navbar-dark');

                        document.getElementsByClassName('main-header')[0].classList.remove('navbar-white');
                        document.getElementsByClassName('main-header')[0].classList.remove('navbar-light');
                    } else {
                        document.documentElement.classList.remove('dark');
                        document.documentElement.setAttribute('data-theme', 'light');

                        document.querySelector('body').classList.remove('dark-mode');

                        document.getElementsByClassName('main-header')[0].classList.remove('navbar-black');
                        document.getElementsByClassName('main-header')[0].classList.remove('navbar-dark');

                        document.getElementsByClassName('main-header')[0].classList.add('navbar-white');
                        document.getElementsByClassName('main-header')[0].classList.add('navbar-light');
                    }

                    document.documentElement.setAttribute('color-theme', 'system');

                    break;

                case 'dark':
                    document.documentElement.classList.add('dark');
                    document.documentElement.setAttribute('color-theme', 'dark');
                    document.documentElement.setAttribute('data-theme', 'dark');

                    document.querySelector('body').classList.add('dark-mode');

                    document.getElementsByClassName('main-header')[0].classList.add('navbar-black');
                    document.getElementsByClassName('main-header')[0].classList.add('navbar-dark');

                    document.getElementsByClassName('main-header')[0].classList.remove('navbar-white');
                    document.getElementsByClassName('main-header')[0].classList.remove('navbar-light');
                    
                    break;

                case 'light':
                    document.documentElement.classList.remove('dark');
                    document.documentElement.setAttribute('color-theme', 'light');
                    document.documentElement.setAttribute('data-theme', 'light');

                    document.querySelector('body').classList.remove('dark-mode');

                    document.getElementsByClassName('main-header')[0].classList.remove('navbar-black');
                    document.getElementsByClassName('main-header')[0].classList.remove('navbar-dark');

                    document.getElementsByClassName('main-header')[0].classList.add('navbar-white');
                    document.getElementsByClassName('main-header')[0].classList.add('navbar-light');

                    break;
            }
        }

        function toSystemMode() {
            localStorage.dashboard_theme = 'system';
            window.updateTheme();
        }

        function toDarkMode() {
            localStorage.dashboard_theme = 'dark';
            window.updateTheme();
        }

        function toLightMode() {
            localStorage.dashboard_theme = 'light';
            window.updateTheme();
        }

        updateTheme();

        $(() => {
            const widget = document.querySelector('li.adminlte-darkmode-widget');
        

            widget.addEventListener('click', () => {

                const isDark = document.documentElement.classList.contains('dark');

                let dark = isDark ? 1 : 0;

                const fetchCfg = {
                    headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Content-type': 'application/json; charset=UTF-8'},
                    method: 'POST',
                    body: JSON.stringify({
                        dark: dark
                    }),
                };

                fetch(
                    "{{ route('user.darkmode.toggle') }}",
                    fetchCfg
                )
                .catch((error) => {
                    console.log(
                        'Failed to notify server that dark mode was toggled',
                        error
                    );
                });
            });
        });

        </script>
    @endpush
@endonce
