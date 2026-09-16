@extends('frontend.magz.index')

@inject('audioHelper', 'App\Helpers\AudioHelper')
@inject('themeHelper', 'App\Helpers\ThemeHelper')
@php $posts->load('categories') @endphp

@section('content')
<section class="post top">
    <div class="container-md">
        <div class="row">
            @if($sidebarPosition === "left" AND $sidebarActive)
                @include('frontend.magz.template-parts.sidebar')
            @endif
            <div class="col-lg-8 text-left @if($sidebarActive === false) offset-lg-2 @endif">
                <div class="row">
                    <div class="col-lg-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">{{ __('jagoronitv::magz.home') }}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ __('jagoronitv::magz.all_audios') }}</li>
                        </ol>
                        <h1 class="page-title">{{ __('jagoronitv::magz.all_audios') }}</h1>
                    </div>
                </div>
                <div class="line"></div>
                <div class="row">
                    @foreach ( $posts as $post)
                    <article class="col-lg-12 article-list">
                        <div class="inner">
                            <figure>
                                <a href="{{ $audioHelper->getUriPost($post) }}" aria-label="{{ $post->post_title }}">
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
                                </div>
                                <h1><a href="{{ $audioHelper->getUriPost($post) }}">{{ $post->post_title }}</a></h1>
                                {!! \Str::limit(strip_tags($post->post_content), 150) !!}
                            </div>
                        </div>
                    </article>
                    @endforeach
                    <div class="col-lg-12 text-center">
                        {{ $posts->links('frontend.magz.inc._pagination') }}
                    </div>
                </div>
            </div>
            @if($sidebarPosition === "right" AND $sidebarActive)
                @include('frontend.magz.template-parts.sidebar')
            @endif
        </div>
    </div>
</section>
@stop
