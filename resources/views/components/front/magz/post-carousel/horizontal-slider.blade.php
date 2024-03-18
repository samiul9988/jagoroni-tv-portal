@inject('postHelper', 'App\Helpers\PostHelper')
@inject('termHelper', 'App\Helpers\TermHelper')
@php $posts->load('categories') @endphp

<section class="best-of-the-week">
    <div class="container">
         @if($widgetData['title'] && Arr::exists($widgetData['title'], LaravelLocalization::getCurrentLocale()))
        <h1>
            <div class="text">{{ $widgetData['title'][LaravelLocalization::getCurrentLocale()] }}</div>
            <div class="carousel-nav" id="best-of-the-week-nav">
                <div class="prev">
                    <i class="arrow-left"></i>
                </div>
                <div class="next">
                    <i class="arrow-right"></i>
                </div>
            </div>
        </h1>
        @endif
        <div class="owl-carousel owl-theme carousel-1">
            @foreach ($posts as $post)
                <article class="article">
                    <div class="inner">
                        <figure>
                            <a href="{{ $postHelper::getUriPost($post) }}">
                                <img src="{{ $postHelper::showThumbnail($post->post_content, $post->post_image, 300) }}" alt="{{ $post->post_image }}" alt="{{ $post->post_image }}">
                            </a>
                        </figure>
                        <div class="padding">
                            <div class="detail">
                                <div class="time">{{ $post->created_at->locale(LaravelLocalization::getCurrentLocale())->isoFormat('LL') }}</div>
                                @if($post->categories->first() AND $post->categories->first()->name)
                                    <div class="category">
                                    <a href="{{ route('category.show', $post->categories->first()->slug) }}">
                                    {{ $post->categories->first()->name }}
                                    </a>
                                    </div>
                                @endif
                            </div>
                            <h2>
                                <a href="{{ $postHelper::getUriPost($post) }}">{{ \Str::limit($post->post_title, 50) }}</a>
                            </h2>
                            {!! \Str::limit(strip_tags($post->post_content), 100) !!}
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>
