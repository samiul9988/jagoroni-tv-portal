@inject('themeHelper', 'App\Helpers\ThemeHelper')

    <div class="jtv-homepage-footer-bar">
        <div class="jtv-homepage-footer-copy">&copy; {{ date('Y') }} Jagoroni TV. All rights reserved.</div>
        <ul class="jtv-homepage-footer-links">
            <li><a href="{{ url('/page/about') }}">আমাদের সম্পর্কে</a></li>
            <li><a href="{{ url('/news/latest') }}">সকল খবর</a></li>
            <li><a href="{{ url('/videos/latest') }}">ভিডিও</a></li>
            <li><a href="{{ url('/contact') }}">যোগাযোগ</a></li>
        </ul>
        <div class="jtv-homepage-footer-slogan">সত্যের পথে | জনগণের পাশে | দেশের জন্য</div>
    </div>
