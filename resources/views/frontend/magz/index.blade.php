<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ LaravelLocalization::getCurrentLocaleDirection() }}" data-bs-theme="light">
	<head>
        @include('frontend.magz.inc._head')
	</head>

	<body class="skin-magz">
        <!-- Header -->
		<header class="primary">
            @include('frontend.magz.template-parts.header')
		</header>

        <!-- Content -->
        @yield('content')

		<!-- Start footer -->
		<footer class="footer @if(!$footerActive) pt-0 @endif">
           @include('frontend.magz.template-parts.footer')
		</footer>
		<!-- End Footer -->

		<!-- JS -->
        @include('frontend.magz.inc._scripts')
	</body>
</html>
