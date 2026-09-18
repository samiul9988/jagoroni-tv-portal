@inject('themeHelper', 'App\Helpers\ThemeHelper')

@if(($page ?? null) === 'home')
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
@else
    <div class="jtv-modern-footer-inner container-md">
        @if($footerActive)
        <div class="row">
            @foreach($footer as $index => $column)
                <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                    @foreach($column as $widgetName => $widgetData)
                        @if ($widgetData['active'] == 'true')
                        <div class="block mb-5">
                            <x-dynamic-component :component="$themeHelper->getComponentName($widgetName)" :page="$page" layout="footer" :column="$column" :widgetName="$widgetName" :widgetData="$widgetData" :localeId="$localeId"/>
                        </div>
                        @endif
                    @endforeach
                </div>
            @endforeach
        </div>
        @endif
        <div class="row">
            <div class="col-lg-12">
                <div class="jtv-footer-copyright copyright border-top-0 mt-0">
                    @include('frontend.magz.inc._credit-footer')
                </div>
            </div>
        </div>
    </div>
@endif
