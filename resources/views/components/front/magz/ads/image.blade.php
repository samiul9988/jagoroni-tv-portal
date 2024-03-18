@if ($layout == 'sidebar')
<aside id="sponsored">
    @if($widgetData['title'] && Arr::exists($widgetData['title'], LaravelLocalization::getCurrentLocale()))
    <h1 class="aside-title">{{ $widgetData['title'][LaravelLocalization::getCurrentLocale()] }}</h1>
    @endif
    <div class="aside-body">
        <figure class="ads">
            @if($widgetData['ad_url'])
            <a href="{{ $widgetData['ad_url'] }}" target="_blank" aria-label="sidebar-banner-ads">
                <img src="{{ $image }}" class="img-fluid" alt="Sidebar Banner Ads" width="350" height="300">
            </a>
            @else
                <img src="{{ $image }}" class="img-fluid" alt="Sidebar Banner Ads" width="350" height="300">
            @endif
        </figure>
    </div>
</aside>
@else
<div class="banner">
    @if($widgetData['ad_url'])
    <a href="{{ $widgetData['ad_url'] }}" target="_blank" aria-label="banner-ads">
        <img src="{{ $image }}" alt="Banner Ads" width="750" height="80">
    </a>
    @else
        <img src="{{ $image }}" alt="Banner Ads" width="750" height="80">
    @endif
</div>
@endif
