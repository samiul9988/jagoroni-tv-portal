@extends('frontend.magz.index')

@inject('postHelper', 'App\Helpers\PostHelper')
@inject('videoHelper', 'App\Helpers\VideoHelper')
@inject('audioHelper', 'App\Helpers\AudioHelper')
@inject('themeHelper', 'App\Helpers\ThemeHelper')

@section('content')
<section class="category top">
    <div class="container-md">
        <div class="row">
            @if($sidebarPosition === "left" && $sidebarActive)
                @include('frontend.magz.template-parts.sidebar')
            @endif
            <div class="col-lg-8 text-left @if($sidebarActive === false) offset-lg-2 @endif">
                <div class="row">
                    @if($category)
                    <div class="col-lg-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">{{ __('jagoronitv::magz.home') }}</a></li>
                            <li class="breadcrumb-item active">{{ $category->name }}</li>
                        </ol>
                        <h1 class="page-title">{{ __('jagoronitv::magz.category') }}: {{ $category->name }}</h1>
                        <p class="page-subtitle">{{ __('jagoronitv::magz.category_description') }}  <i>{{ $category->name }}</i></p>
                    </div>
                    @endif
                </div>
                <div class="line"></div>
                <div class="row">
                    @if($posts)
                    @foreach($posts as $post)
                    <article class="col-lg-12 article-list">
                        <div class="inner">
                            <figure>
                                <a href="{{ $postHelper->getUriPost($post) }}">
                                    @if($post->post_type == 'post' OR $post->post_type == 'page')
                                        <img src="{{ $postHelper->showThumbnail($post, 300) }}" alt="{{ $post->post_image }}">
                                    @elseif($post->post_type == 'video_file' OR $post->post_type == 'video_url' OR $post->post_type == 'video_embed')
                                        <img src="{{ $videoHelper->showThumbnail($post, '300') }}" alt="{{ $post->post_image }}">
                                        <div class="link-icon"><i class="fas fa-play"></i></div>
                                    @else
                                        <img src="{{ $audioHelper->showThumbnail($post, '300') }}" alt="{{ $post->post_image }}">
                                        <div class="link-icon"><i class="fas fa-music"></i></div>
                                    @endif
                                </a>
                            </figure>
                            <div class="details">
                                <div class="detail">
                                    <div class="category">
                                        <a href="{{ route('category.show', $category->slug)}}">{{ $category->name }}</a>
                                    </div>
                                    <div class="time">{{ $post->created_at->locale(LaravelLocalization::getCurrentLocale())->isoFormat('LL') }}</div>
                                    <div class="view">{{ $post->post_hits }} {{ __('jagoronitv::magz.views') }} &nbsp; {{ $post->like }} {{ __('jagoronitv::magz.likes') }}</div>
                                </div>
                                <h1><a href="{{ $postHelper->getUriPost($post) }}">{{ $post->post_title }}</a></h1>
                                <p>{!! \Str::limit(strip_tags($post->post_content), 150) !!}</p>
                            </div>
                        </div>
                    </article>
                    @endforeach
                    <div class="col-lg-12 text-center">
                        {{ $posts->links('frontend.magz.inc._pagination') }}
                    </div>
                    @endif
                </div>
            </div>
            @if($sidebarPosition === "right" AND $sidebarActive)
                @include('frontend.magz.template-parts.sidebar')
            @endif
        </div>
    </div>
</section>
@stop
