@if($widgetData['title'] && Arr::exists($widgetData['title'], LaravelLocalization::getCurrentLocale()))<h1 class="block-title">{{ $widgetData['title'][LaravelLocalization::getCurrentLocale()] }}</h1>@endif
<div class="block-body">
    @if($widgetData['logo'] == 'true')
    <figure class="foot-logo">
        <img src="{{ \App\Helpers\ImageHelper::webLogoLight() }}" alt="Web Logo" width="140" height="44">
    </figure>
    @endif
    <p class="brand-description">
        {{ config('settings.site_description') }}
    </p>
    @if($widgetData['link'] == 'true')
    <a href="{{ route('page.show', 'about') }}" class="btn btn-magz white" aria-label="{{ __('jagoronitv::magz.about_us') }}">{{ __('jagoronitv::magz.about_us') }} &#8594;</a>
    @endif
</div>
