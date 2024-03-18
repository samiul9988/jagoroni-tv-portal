@if($terms->isNotEmpty())
@if ($active)
@if($widgetData['title'] && Arr::exists($widgetData['title'], LaravelLocalization::getCurrentLocale()))
    <h1 class="title-col">{{ $widgetData['title'][LaravelLocalization::getCurrentLocale()] }}</h1>
@endif
<div class="body-col">
    <ol class="tags-list">
        @foreach ($terms as $term)
            @if ($widgetData['term_type'] == 'tags')
                <li><a href="{{ route('tag.show', $term->slug) }}">{{ $term->name }}</a></li>
            @else
                <li><a href="{{ route('categories.show', $term->slug) }}">{{ $term->name }}</a></li>
            @endif
        @endforeach
    </ol>
</div>
@endif
@endif
