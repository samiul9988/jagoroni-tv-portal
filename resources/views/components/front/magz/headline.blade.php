@inject('termHelper', 'App\Helpers\TermHelper')
@inject('postHelper', 'App\Helpers\PostHelper')
@php $posts->load('categories') @endphp

@if (count($posts) AND $active)
<div class="headline">
    <div class="nav" id="headline-nav">
        <a class="left carousel-control carousel-control-prev" role="button" data-slide="prev">
            <span class="arrow-left"></span>
            <span class="sr-only">{{ __('jagoronitv::magz.previous') }}</span>
        </a>
        <a class="right carousel-control carousel-control-next" role="button" data-slide="next">
            <span class="arrow-right"></span>
            <span class="sr-only">{{ __('jagoronitv::magz.next') }}</span>
        </a>
    </div>
    <div class="owl-carousel owl-theme" id="headline" data-autoplay="{{ $autoPlay }}">
        @foreach ($posts as $post)
            <div class="item">
                <a href="{{ $postHelper::getUriPost($post) }}">
                    @if($post->categories->first() AND $post->categories->first()->name)
                    <div class="badge">
                    {{ $post->categories->first()->name }}
                    </div>
                    @endif
                    {{ $post->post_title }}
                </a>
            </div>
        @endforeach
    </div>
</div>
@endif
