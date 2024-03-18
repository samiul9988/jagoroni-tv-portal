@inject('termHelper', 'App\Helpers\TermHelper')
@inject('postHelper', 'App\Helpers\PostHelper')
@php $posts->load('categories') @endphp

@if($posts->isNotEmpty())
@if ($active)
@if($countRelatedPost > 1)
    <div class="line">
        @if($widgetData['title'] && Arr::exists($widgetData['title'], LaravelLocalization::getCurrentLocale()))
        <div>{{ $widgetData['title'][LaravelLocalization::getCurrentLocale()] }}</div>
        @endif
    </div>
@endif
<div class="row">
    @empty($posts)
    @else
        @foreach ( $posts as $post)
            @if ($mainPostTitle !== $post->post_title)
                <article class="article related col-lg-6 col-md-6 col-sm-12 col-12">
                    <div class="inner">
                        <figure>
                            <a href="{{ $postHelper::getUriPost($post) }}">
                                <img src="{{ $postHelper::showThumbnail($post, 356) }}" alt="{{ $post->post_image }}" width="100" height="100">
                            </a>
                        </figure>
                        <div class="padding">
                            <h2><a href="{{ $postHelper::getUriPost($post) }}">{{ $post->post_title }}</a></h2>
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
    @endempty
</div>
@endif
@endif
