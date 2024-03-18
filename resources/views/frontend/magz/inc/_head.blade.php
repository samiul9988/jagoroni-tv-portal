<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="robots" content="index, follow">
<meta name="author" content="{{ config('settings.company_name') }}">
<meta name="theme-color" content="#ffffff">
<meta name="color-scheme" content="light">
{!! SEO::generate() !!}
@empty(config('settings.favicon'))
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicons/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicons/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicons/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('favicons/site.webmanifest') }}">
    <link rel="shortcut icon" href="{{ asset('favicons/favicon.ico') }}" />
    <meta name="msapplication-TileColor" content="#ffffff">
@else
    <link rel="icon" sizes="32x32" href="{{ \App\Helpers\ImageHelper::webIcon() }}">
@endempty
<meta name="google-site-verification" content="{{ config('settings.google_site_verification') }}">
<meta name="csrf-token" content="{{ csrf_token() }}">

<link href="{{ asset('themes/magz/scripts/bootstrap/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
<link href="{{ asset('themes/magz/scripts/owlcarousel/dist/assets/owl.carousel.min.css') }}" rel="stylesheet">
<link href="{{ asset('themes/magz/scripts/owlcarousel/dist/assets/owl.theme.default.min.css') }}" rel="stylesheet">
<link href="{{ asset('vendor/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet">
<link href="{{ asset('themes/magz/css/style.css') }}" rel="stylesheet">
<link href="{{ asset('themes/magz/css/darkmode.css') }}" rel="stylesheet">
@if (LaravelLocalization::getCurrentLocaleDirection() == 'rtl')
<link href="{{ asset('themes/magz/css/rtl.css') }}" rel="stylesheet">
@endif
<link href="{{ asset('vendor/flag-icons/css/flag-icons.min.css') }}" rel="stylesheet">

@stack('styles')

@if(config('settings.publisher_id'))
    <!-- Google Adsense -->
    <script data-ad-client="{{ config('settings.publisher_id') }}" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
@endif

@if(config('settings.measurement_id'))
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ config('settings.measurement_id') }}"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', "{{ config('settings.measurement_id') }}");
    </script>
@endif

<!-- Mailchimp -->
<script id="mcjs">
    ! function(c, h, i, m, p) {
        m = c.createElement(h), p = c.getElementsByTagName(h)[0], m.async = 1, m.src = i, p.parentNode.insertBefore(m, p)
    }(document, "script", "https://chimpstatic.com/mcjs-connected/js/users/dce4ca90b74e9fafbfb2697a6/b08078aa3fbf02461cb5d711e.js");
</script>

@stack('scripts_head')

@include('frontend.magz.inc._theme')

