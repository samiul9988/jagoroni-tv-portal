@inject('postHelper', 'App\Helpers\PostHelper')

@if(count($posts))
<div class="block">
    <div class="block">
        @if($widgetData['title'] && Arr::exists($widgetData['title'], LaravelLocalization::getCurrentLocale()))
        <h1 class="block-title">{{ $widgetData['title'][LaravelLocalization::getCurrentLocale()] }}</h1>
        @endif
        <div class="block-body">
            @foreach ($posts as $post)
                <article class="article-mini">
                    <div class="inner">
                        <figure>
                            <a href="{{ $postHelper::getUriPost($post) }}">
                                <img src="{{ $postHelper::showThumbnail($post, 80) }}" alt="{{ $post->post_image }}">
                            </a>
                        </figure>
                        <div class="padding">
                            <h1><a href="{{ $postHelper::getUriPost($post) }}">{{ $post->post_title }}</a></h1>
                        </div>
                    </div>
                </article>
            @endforeach
            <div class="d-grid gap-2">
                <a href="{{ route('articles.latest') }}" class="btn btn-magz white btn-block">{{ __('dhakawatch::magz.see_all') }} &#8594;</a>
            </div>
        </div>
    </div>
</div>
@endif
