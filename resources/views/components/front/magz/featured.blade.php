@inject('postHelper', 'App\Helpers\PostHelper')
@inject('termHelper', 'App\Helpers\TermHelper')
@inject('themeHelper', 'App\Helpers\ThemeHelper')
@php $posts->load('categories') @endphp

@if($posts->isNotEmpty())
@if ($active)
@if($widgetData['title'] && Arr::exists($widgetData['title'], LaravelLocalization::getCurrentLocale()))
<div class="line top">
    <div>{{ $widgetData['title'][LaravelLocalization::getCurrentLocale()] }}</div>
</div>
@endif
<div class="owl-carousel owl-theme slide" id="featured" data-autoplay="{{ $autoPlay }}">
    @foreach ($posts as $post)
        <div class="item">
            <article class="featured">
                <div class="overlay"></div>
                <figure>
                    <img fetchpriority="low" src="{{ $postHelper::showThumbnail($post) }}" alt="{{ $post->post_image }}">
                </figure>
                <div class="details">
                    @if($post->categories->first() AND $post->categories->first()->name)
                        <div class="category">
                            <a href="{{ $termHelper::categoryUrl($post) }}">
                                {{ $termHelper::categoryName($post) }}
                            </a>
                        </div>
                    @endif
                    <h1><a href="{{ $postHelper::getUriPost($post) }}">{{ $post->post_title }}</a></h1>
                    <div class="time">{{ $post->created_at->locale(LaravelLocalization::getCurrentLocale())->isoFormat('LL') }}</div>
                </div>
            </article>
        </div>
    @endforeach
</div>
@endif
@endif
