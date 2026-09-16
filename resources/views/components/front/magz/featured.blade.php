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
@php
    $leadPost = $posts->first();
    $sidePosts = $posts->slice(1, 6);
    $subLeadPosts = $posts->slice(7, 2);
@endphp
<div class="jtv-lead-block">
    <div class="row g-3">
        <div class="col-lg-8 col-md-12">
            <article class="featured jtv-featured-main">
                <div class="overlay"></div>
                <figure>
                    <img fetchpriority="high" src="{{ $postHelper::showThumbnail($leadPost) }}" alt="{{ $leadPost->post_image }}">
                </figure>
                <div class="details">
                    @if($leadPost->categories->first() AND $leadPost->categories->first()->name)
                        <div class="category">
                            <a href="{{ $termHelper::categoryUrl($leadPost) }}">
                                {{ $termHelper::categoryName($leadPost) }}
                            </a>
                        </div>
                    @endif
                    <h1><a href="{{ $postHelper::getUriPost($leadPost) }}">{{ $leadPost->post_title }}</a></h1>
                    <div class="time">{{ $leadPost->created_at->locale(LaravelLocalization::getCurrentLocale())->isoFormat('LL') }}</div>
                </div>
            </article>
            @if($subLeadPosts->isNotEmpty())
            <div class="row g-2 mt-1">
                @foreach ($subLeadPosts as $subPost)
                <div class="col-md-6 col-12">
                    <article class="article-mini jtv-sub-lead-card">
                        <div class="inner">
                            <figure>
                                <a href="{{ $postHelper::getUriPost($subPost) }}">
                                    <img src="{{ $postHelper::showThumbnail($subPost, 300) }}" alt="{{ $subPost->post_image }}">
                                </a>
                            </figure>
                            <div class="padding">
                                <h1><a href="{{ $postHelper::getUriPost($subPost) }}">{{ $subPost->post_title }}</a></h1>
                            </div>
                        </div>
                    </article>
                </div>
                @endforeach
            </div>
            @endif
        </div>
        <div class="col-lg-4 col-md-12">
            <div class="jtv-featured-side">
                @foreach ($sidePosts as $post)
                <article class="article-mini">
                    <div class="inner">
                        <figure>
                            <a href="{{ $postHelper::getUriPost($post) }}">
                                <img src="{{ $postHelper::showThumbnail($post, 120) }}" alt="{{ $post->post_image }}">
                            </a>
                        </figure>
                        <div class="padding">
                            <h1><a href="{{ $postHelper::getUriPost($post) }}">{{ $post->post_title }}</a></h1>
                            <div class="detail">
                                <div class="time">{{ $post->created_at->locale(LaravelLocalization::getCurrentLocale())->isoFormat('LL') }}</div>
                            </div>
                        </div>
                    </div>
                </article>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endif
@endif
