@if ($active)
    @if($widgetData['title'] && Arr::exists($widgetData['title'], LaravelLocalization::getCurrentLocale()))
    <h1 class="block-title">{{ $widgetData['title'][LaravelLocalization::getCurrentLocale()] }}</h1>
    @endif
    <div class="block-body">
        @if($widgetData['description'] && Arr::exists($widgetData['description'], LaravelLocalization::getCurrentLocale()))<p>{{ $widgetData['description'][LaravelLocalization::getCurrentLocale()] }}</p>@endif
        <ul class="social trp">
            @foreach($links as $link)
                <li>
                    <a href="{{ $link->url }}" style="background-color: {{ $link->color }}" aria-label="link-social-media">
                        <i class="{{ $link->icon }}"></i>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
@endif
