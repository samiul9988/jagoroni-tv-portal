@inject('audioHelper', 'App\Helpers\AudioHelper')
@inject('termHelper', 'App\Helpers\TermHelper')

@if($posts->isNotEmpty())
@if($widgetData['title'] && Arr::exists($widgetData['title'], LaravelLocalization::getCurrentLocale()))
    <div class="line top">
        <div>{{ $widgetData['title'][LaravelLocalization::getCurrentLocale()] }}</div>
    </div>
@endif
<div class="row @empty($widgetData['title']) mt-5 @endempty">
    @php $posts->load('categories') @endphp
    @foreach ($posts as $post)
        <article class="col-lg-12 article-list">
            <div class="inner">
                <figure>
                    <a href="{{ $audioHelper->getUriPost($post) }}" aria-label="read more">
                        <img src="{{ $audioHelper->showThumbnail($post, 300) }}"
                            alt="{{ $post->post_image }}">
                        <div class="link-icon"><i class="fas fa-music"></i></div>
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
                        <div class="view">{{ $post->post_hits }} {{ __('jagoronitv::magz.views') }} &nbsp; {{ $post->like }} {{ __('jagoronitv::magz.likes') }}</div>
                    </div>
                    <h1><a href="{{ $audioHelper->getUriPost($post) }}">{{ $post->post_title }}</a></h1>
                    <p>
                        {!! \Str::limit(strip_tags($post->post_content), 150) !!}
                    </p>
                </div>
            </div>
        </article>
    @endforeach
</div>
@endif
