@inject('termHelper', 'App\Helpers\TermHelper')
@inject('postHelper', 'App\Helpers\PostHelper')
@php $posts->load('categories') @endphp

@if($posts->isNotEmpty())
@if($active)
@if($widgetData['title'] && Arr::exists($widgetData['title'], LaravelLocalization::getCurrentLocale()))
<h1 class="title-col">
    {{ $widgetData['title'][LaravelLocalization::getCurrentLocale()] }}
    <div class="carousel-nav" id="hot-news-nav">
        <div class="prev">
            <span class="arrow-left"></span>
        </div>
        <div class="next">
            <span class="arrow-right"></span>
        </div>
    </div>
</h1>
@endif
<div class="body-col vertical-slider" data-max="4" data-nav="#hot-news-nav" data-item="article">
    @foreach( $posts as $post )
        <article class="article-mini">
            <div class="inner">
                <figure>
                    <a href="{{ $postHelper::getUriPost($post) }}">
                        <img src="{{ $postHelper::showThumbnail($post, '80') }}"
                             alt="{{ $post->post_image }}">
                    </a>
                </figure>
                <div class="padding">
                    <h1><a href="{{ $postHelper::getUriPost($post) }}">{{ $post->post_title }}</a></h1>
                    <div class="detail">
                        @if($post->categories->first() AND $post->categories->first()->name)
                            <div class="category">
                                <a href="{{ route('category.show', $post->categories->first()->slug) }}">
                                {{ $post->categories->first()->name }}
                                </a>
                            </div>
                        @endif
                        <div class="time">{{ $post->created_at->locale(LaravelLocalization::getCurrentLocale())->isoFormat('LL')}}</div>
                    </div>
                </div>
            </div>
        </article>
    @endforeach
</div>
@endif
@endif

