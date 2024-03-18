@extends('frontend.magz.index')

@inject('themeHelper', 'App\Helpers\ThemeHelper')
@inject('postHelper', 'App\Helpers\PostHelper')

@section('content')
<section class="page top">
    <div class="container-md">
        <div class="row">
            @if($sidebarPosition === "left" AND $sidebarActive)
                @include('frontend.magz.template-parts.sidebar')
            @endif
            <div class="col-lg-8 @if($sidebarActive === false) offset-lg-2 @endif">
                @if($pages->post_title)
                <ol class="breadcrumb justify-content-center">
                    <li class="breadcrumb-item"><a href="/">{{ __('dhakawatch::magz.home') }}</a></li>
                    <li class="breadcrumb-item active">{{ $pages->post_title }}</li>
                </ol>
                @endif
                <h1 class="page-title">{{ $pages->post_title }}</h1>
                <p class="page-subtitle">{!! strip_tags($pages->post_summary) !!}</p>
                <div class="line thin"></div>
                <figure class="figure d-block text-center">
                    @if(!empty($pages->post_image))
                    <img class="figure-img img-fluid" src="{{ route('image.post', $pages->post_image) }}" alt="{{ $pages->post_image }}">
                    <figcaption class="figure-caption">{!! $postHelper->getPostThumbnailCaption($pages->post_image_meta) !!}</figcaption>
                    @endif
                </figure>
                <div class="page-description">
                    {!! html_entity_decode($pages->post_content) !!}
                </div>
            </div>
            @if($sidebarPosition === "right" AND $sidebarActive)
                @include('frontend.magz.template-parts.sidebar')
            @endif
        </div>
    </div>
</section>
@stop
