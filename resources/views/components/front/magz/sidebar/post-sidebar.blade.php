@inject('postHelper', 'App\Helpers\PostHelper')
@inject('termHelper', 'App\Helpers\TermHelper')
@php $posts->load('categories') @endphp

@if($widgetData['layout_type'] == 'list-post-with-link')
    <aside>
        @if($widgetData['title'] && Arr::exists($widgetData['title'], LaravelLocalization::getCurrentLocale()))
        <h1 class="aside-title">{{ $widgetData['title'][LaravelLocalization::getCurrentLocale()] }} 
            <a href="{{ route('article.popular') }}" class="all">{{ __('jagoronitv::magz.see_all') }} <i class="arrow-right"></i></a>
        </h1>
        @endif
        <div class="aside-body">
            @foreach($posts as $post)
                <article class="article-mini">
                    <div class="inner">
                        <figure>
                            <a href="{{ $postHelper::getUriPost($post) }}">
                                <img src="{{ $postHelper::showThumbnail($post, 80) }}" alt="{{ $post->post_image }}">
                            </a>
                        </figure>
                        <div class="padding">
                            <h1><a href="{{ $postHelper::getUriPost($post) }}">{{ $post->post_title }}</a>
                            </h1>
                            <div class="detail">
                                @if($post->categories->first() AND $post->categories->first()->name)
                                    <div class="category">
                                        <a href="{{ $termHelper::categoryUrl($post) }}">
                                             {{ $post->categories->first()->name }}
                                        </a>
                                    </div>
                                @endif
                                <div class="time">{{ $post->created_at->locale(LaravelLocalization::getCurrentLocale())->isoFormat('LL') }}</div>
                            </div>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
    </aside>
@elseif($widgetData['layout_type'] == 'first-large-thumb')
    <aside>
        @if($widgetData['title'] && Arr::exists($widgetData['title'], LaravelLocalization::getCurrentLocale()))
        <h1 class="aside-title">{{ $widgetData['title'][LaravelLocalization::getCurrentLocale()] }}</h1>
        @endif
        <div class="aside-body">
            @foreach ($posts as $post)
                @if($loop->first)
                    <article class="article-fw">
                        <div class="inner">
                            <figure>
                                <a href="{{ $postHelper::getUriPost($post) }}">
                                    <img src="{{ $postHelper::showThumbnail($post, 356) }}" alt="{{ $post->post_image }}">
                                </a>
                            </figure>
                            <div class="details">
                                <div class="detail">
                                    <div class="time">{{ $post->created_at->locale(LaravelLocalization::getCurrentLocale())->isoFormat('LL') }}</div>
                                    @if($post->categories->first() AND $post->categories->first()->name)
                                        <div class="category">
                                            <a href="{{ route('category.show', $post->terms()->category()->first()->slug) }}">
                                                 {{ $post->categories->first()->name }}
                                            </a>
                                        </div>
                                    @endif
                                </div>
                                <h1><a href="{{ $postHelper::getUriPost($post) }}">{{ $post->post_title }}</a>
                                </h1>
                                <p>{{ \Str::limit(strip_tags($post->post_content), 100) }}</p>
                            </div>
                        </div>
                    </article>
                    <div class="line mt-1 mb-4"></div>
                @else
                    <article class="article-mini">
                        <div class="inner">
                            <figure>
                                <a href="{{ $postHelper::getUriPost($post) }}">
                                    <img src="{{ $postHelper::showThumbnail($post, 80) }}" alt="{{ $post->post_image }}">
                                </a>
                            </figure>
                            <div class="padding">
                                <h1><a href="{{ $postHelper::getUriPost($post) }}">{{ $post->post_title }}</a>
                                </h1>
                                <div class="detail">
                                    @if($post->categories->first() AND $post->categories->first()->name)
                                        <div class="category">
                                            <a href="{{ route('category.show', $post->categories->first()->slug) }}">
                                                 {{ $post->categories->first()->name }}
                                            </a>
                                        </div>
                                    @endif
                                    <div class="time">{{ $post->created_at->locale(LaravelLocalization::getCurrentLocale())->isoFormat('LL') }}</div>
                                </div>
                            </div>
                        </div>
                    </article>
                @endif
            @endforeach
        </div>
    </aside>
@else
    <aside>
        @if($widgetData['title'] && Arr::exists($widgetData['title'], LaravelLocalization::getCurrentLocale()))
        <h1 class="aside-title">{{ $widgetData['title'][LaravelLocalization::getCurrentLocale()] }}</h1>
        @endif
        <div class="aside-body">
            @foreach ($posts as $post )
                <article class="article-mini">
                    <div class="inner">
                        <figure>
                            <a href="{{ $postHelper::getUriPost($post) }}">
                                <img src="{{ $postHelper::showThumbnail($post, 80) }}" alt="{{ $post->post_image }}">
                            </a>
                        </figure>
                        <div class="padding">
                            <h1><a href="{{ $postHelper::getUriPost($post) }}">{{ $post->post_title }}</a>
                            </h1>
                            <div class="detail">
                                @if($post->categories->first() AND $post->categories->first()->name)
                                    <div class="category">
                                        <a href="{{ route('category.show', $post->terms()->category()->first()->slug) }}">
                                             {{ $post->categories->first()->name }}
                                        </a>
                                    </div>
                                @endif
                                <div class="time">{{ $post->created_at->locale(LaravelLocalization::getCurrentLocale())->isoFormat('LL') }}</div>
                            </div>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
    </aside>

@endif

