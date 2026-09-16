@extends('frontend.magz.index')

@inject('postHelper', 'App\Helpers\PostHelper')
@inject('themeHelper', 'App\Helpers\themeHelper')
@php $posts->load('categories') @endphp

@section('content')
<section class="search top">
    <div class="container-md">
        <div class="row">
            @if($sidebarPosition === "left" AND $sidebarActive)
                @include('frontend.magz.template-parts.sidebar')
            @endif
            <div class="col-lg-8 col-md-12 col-sm-12 col-12 @if($sidebarActive === false) offset-lg-2 @endif">
                <div class="search-result">
                    {{ __('jagoronitv::magz.search_keyword') }} "{{ $keyword }}" {{ __('jagoronitv::magz.search_found_in') }} {{ $countResults }} {{ __('jagoronitv::magz.posts') }}.
                </div>
                <div class="row">
                    @foreach( $posts as $post )
                    <article class="col-lg-12 article-list">
                        <div class="inner">
                            <figure>
                                <a href="{{ $postHelper->getUriPost($post) }}">
                                    <img src="{{ $postHelper->showThumbnail($post, 300) }}" alt="{{ $post->post_image }}">
                                </a>
                            </figure>
                            <div class="details">
                                <div class="detail">
                                    @if($post->categories->first() AND $post->categories->first()->name)
                                    <div class="category">
                                        <a href="{{ route('category.show', $post->categories->first()->slug) }}">
                                            {{ $post->categories->first()->name }}
                                        </a>
                                    </div>&nbsp;
                                    @endif
                                    <time> {{ $post->created_at->locale(LaravelLocalization::getCurrentLocale())->isoFormat('LL') }}</time>
                                    <div class="view">{{ $post->post_hits }} {{ __('jagoronitv::magz.views') }} &nbsp; {{ $post->like }} {{ __('jagoronitv::magz.likes') }}</div>
                                </div>
                                <h1><a href="{{ $postHelper->getUriPost($post) }}">{{ $post->post_title }}</a></h1>
                                <p>{!! \Str::limit(strip_tags($post->post_content), 150) !!}</p>
                            </div>
                        </div>
                    </article>
                    @endforeach
                    <div class="col-lg-12 text-center">
                        {{ $posts->appends(['q' => $keyword])->links('frontend.magz.inc._pagination') }}
                    </div>
                </div>
            </div>
            @if($sidebarPosition === "right" AND $sidebarActive)
                @include('frontend.magz.template-parts.sidebar')
            @endif
        </div>
</section>
@stop
