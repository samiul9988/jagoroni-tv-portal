@if($widgetData['title'] && Arr::exists($widgetData['title'], LaravelLocalization::getCurrentLocale()))
<h1 class="block-title">{{ $widgetData['title'][LaravelLocalization::getCurrentLocale()] }} <div class="right"></div></h1>
@endif
<div class="block-body">
    @if($widgetData['description'] && Arr::exists($widgetData['description'], LaravelLocalization::getCurrentLocale()))
    <p>{{ $widgetData['description'][LaravelLocalization::getCurrentLocale()] }}</p>
    @endif
    <ul class="tags">
        @foreach ($terms as $term)
            <li><a href="{{ route('tag.show', $term->slug) }}">{{ $term->name }}</a></li>
        @endforeach
    </ul>
</div>
