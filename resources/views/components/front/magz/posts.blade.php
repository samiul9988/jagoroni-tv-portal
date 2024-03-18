@inject('termHelper', 'App\Helpers\TermHelper')
@inject('postHelper', 'App\Helpers\PostHelper')
@inject('localizationHelper', 'App\Helpers\LocalizationHelper')

@if($posts->isNotEmpty())
@if($widgetData['title'] && Arr::exists($widgetData['title'], LaravelLocalization::getCurrentLocale()))
    <div class="line top">
        <div>{{ $widgetData['title'][LaravelLocalization::getCurrentLocale()] }}</div>
    </div>
@endif
<div class="row">
    @php $posts->load('categories') @endphp
    @foreach ($posts as $post)
        <article class="col-lg-12 article-list">
            <div class="inner">
                <figure>
                    <a href="{{ $postHelper::getUriPost($post) }}">
                        <img src="{{ $postHelper::showThumbnail($post, 300) }}"
                             alt="{{ $post->post_image }}">
                    </a>
                </figure>
                <div class="details">
                    <div class="detail">
                        @if($post->categories->first() AND $post->categories->first()->name)
                            <div class="category">
                                <a href="{{ route('category.show', $post->categories->first()->slug) }}">
                                    {{ $post->categories->first()->name }}
                                </a>
                            </div>
                        @endif
                        <div class="time">{{ $post->created_at->locale(LaravelLocalization::getCurrentLocale())->isoFormat('LL') }}</div>
                        <div class="view">{{ $post->post_hits }} {{ __('dhakawatch::magz.views') }} &nbsp; {{ $post->like }} {{ __('dhakawatch::magz.likes') }}</div>
                    </div>
                    <h1><a href="{{ $postHelper::getUriPost($post) }}">{{ $post->post_title }}</a></h1>
                    <p>
                        {!! \Str::limit(strip_tags($post->post_content), 150) !!}
                    </p>
                </div>
            </div>
        </article>
    @endforeach
</div>
@endif