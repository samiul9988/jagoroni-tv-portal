@inject('postHelper', 'App\Helpers\PostHelper')
@inject('termHelper', 'App\Helpers\TermHelper')
@php $posts->load('categories') @endphp

@if($posts->isNotEmpty())
@if($widgetData['title'] && Arr::exists($widgetData['title'], LaravelLocalization::getCurrentLocale()))
    <div class="line top">
        <div>{{ $widgetData['title'][LaravelLocalization::getCurrentLocale()] }}</div>
    </div>
@endif
<div class="row">
    @foreach ($posts as $post)
        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
            <article class="article col-lg-12">
                <div class="inner">
                    <figure>
                        <a href="{{ $postHelper::getUriPost($post) }}" aria-label="read more">
                            <img src="{{ $postHelper::showThumbnail($post, 356) }}"
                                 alt="{{ $post->post_image }}">
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
                            <div class="view">{{ $post->post_hits }} {{ __('jagoronitv::magz.views') }} &nbsp; {{ $post->like }} {{ __('jagoronitv::magz.likes') }}</div>
                        </div>
                        <h2><a href="{{ $postHelper::getUriPost($post) }}">{{ $post->post_title }}</a></h2>
                        <p>{!! \Str::limit(strip_tags($post->post_content), 150) !!}</p>
                    </div>
                </div>
            </article>
        </div>
    @endforeach
</div>
@endif
