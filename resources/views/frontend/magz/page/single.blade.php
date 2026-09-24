@extends('frontend.magz.index')

@inject('termHelper', 'App\Helpers\TermHelper')
@inject('themeHelper', 'App\Helpers\ThemeHelper')
@inject('postHelper', 'App\Helpers\PostHelper')

@section('content')
<section class="single top jtv-single-page">
    <div class="container-md jtv-single-container">
        <div class="row jtv-single-layout">
            @if($sidebarActive)
                @include('frontend.magz.template-parts.sidebar')
            @endif
            <div class="jtv-single-content @if($sidebarActive === false) jtv-single-content-wide @endif">
            @if($post->post_title)
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">{{ __('jagoronitv::magz.home') }}</a></li>
                    @if($post->categories->first() AND $post->categories->first()->name)
                        <li class="breadcrumb-item active" aria-current="page">{{ $post->terms()->category()->first()->name }}</li>
                    @endif
                </ol>
                <article class="article main-article">
                    <header>
                        <h1>{{ $post->post_title }}</h1>
                        <ul class="details">
                            <li>{{ __('jagoronitv::magz.posted_on') }} {{ $post->created_at->locale(LaravelLocalization::getCurrentLocale())->isoFormat('LL') }}</li>
                            @if($post->categories->first() AND $post->categories->first()->name)
                                <li>
                                    <a href="{{ $termHelper->resolveUrl($post, $post->terms()->category()->first()->slug) }}">
                                        {{ $termHelper->resolveLabel($post, $post->terms()->category()->first()->slug)}}
                                    </a>
                                </li>
                            @endif
                            <li>{{ __('jagoronitv::magz.by') }} <span>{{ $post->user->name }}</span></li>
                            <li>{{ $post->post_hits }} {{ __('jagoronitv::magz.views') }}</li>
                        </ul>
                    </header>
                    <div class="main">
                        <div class="summary">
                        {!! $post->post_summary !!}
                        </div>
                        @if($post->post_type == "page" OR $post->post_type == "post")
                            @if(!empty($post->post_image) && App\Helpers\ImageHelper::isExists('images', $post->post_image) || App\Helpers\PostHelper::isImageUrlAvailable($post))
                            <figure class="figure d-block text-center mb-4">
                                <img src="{{ $postHelper->displayThumbnailForSinglePost($post) }}" class="figure-img img-fluid rounded" alt="{{ $post->post_image }}" width="736" height="552">
                                <figcaption class="figure-caption">{!! $postHelper->getPostThumbnailCaption($post->post_image_meta) !!}</figcaption>
                            </figure>
                            @else
                            <hr>
                            @endif
                        @else
                            @php
                                $postSource = json_decode($post->post_source);
                                $postImageMeta = $postHelper->isImageUrlAvailable($post);

                                if ($postImageMeta) {
                                    $poster = json_decode($post->post_image_meta)->image_url;
                                } else {
                                    $poster = ($post->post_image) ? asset('storage/images/'.$post->post_image) : asset('img/cover-video.webp');
                                }
                            @endphp
                            @if($post->post_type == "video_embed" OR $post->post_type == "audio_embed")
                                @if($post->post_type == "video_embed")
                                    <figure class="player">
                                        <div id="player" data-plyr-provider="{{ $postSource->provider }}" data-plyr-embed-id="{{ $postSource->embed_id }}" data-poster="{{ $poster }}" style="--plyr-color-main: #eb0254;"></div>
                                    </figure>
                                @elseif($post->post_type == "audio_embed")
                                <div class="plyr__audio-embed" id="player" style="--plyr-color-main: #eb0254; margin-bottom: 3rem;">
                                    {!! $post->post_source !!}
                                </div>
                                @endif
                            @elseif($post->post_type == "audio_file" OR $post->post_type == "audio_url")
                                @php
                                    $postSource = json_decode($post->post_source);
                                    $postImageMeta = $postHelper->isImageUrlAvailable($post);

                                    $poster = '';

                                    if ($post->post_image ) {
                                        if ($postImageMeta) {
                                            $poster = json_decode($post->post_image_meta)->image_url;
                                        } else {
                                            $poster = asset('storage/images/'.$post->post_image);
                                        }
                                    }
                                @endphp
                                @if(!empty($poster))
                                    <div class="featured">
                                        <figure>
                                            <img src="{{ $poster }}" alt="{{ $post->post_title }}">
                                        </figure>
                                    </div>
                                @endif
                                <div class="container-plyr mt-3 mb-5">
                                    @php
                                    $source = ($post->post_type == 'audio_file') ? asset('storage/audios/'.$post->post_source) : $post->post_source;
                                    @endphp
                                    <audio id="player" style="--plyr-color-main: #eb0254;" controls>
                                        <source src="{{ $source }}"/>
                                    </audio>
                                </div>
                            @elseif($post->post_type == "video_url")
                                @php
                                    $poster = ($post->post_image) ? asset('storage/images/'.$post->post_image) : asset('img/cover-video.webp');
                                @endphp
                                <figure class="player">
                                    <div id="player" data-plyr-provider="youtube" data-poster="{{ $poster }}" data-plyr-embed-id="{{ $post->post_source }}" style="--plyr-color-main: #eb0254;"></div>
                                </figure>
                            @else
                                <div class="container-plyr mb-5">
                                    @php
                                    $width = ($post->post_type == "video_file") ? '100%' : '640';
                                    $poster = ($post->post_image) ? asset('storage/images/'.$post->post_image) : asset('img/cover-video.webp');
                                    @endphp
                                    <figure>
                                    <video id="player" playsinline controls data-plyr-config='{ "ratio": "16:9" }' data-poster="{{ $poster }}" style="--plyr-color-main: #eb0254;">
                                        <source src="{{ asset('storage/videos/'.$post->post_source) }}"/>
                                    </video>
                                    </figure>
                                </div>
                            @endif
                        @endif

                        {!! $post->post_content !!}
                    </div>
                    <footer>
                        <div class="col-m">
                            <ul class="tags">
                                @foreach( $tags as $tag )
                                    <li><a href="{{ route('tag.show', $tag) }}">{{ $tag->name }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="col-m">
                            <span class="love" data-id="{{ $hashids->encode($post->id) }}"><i class="fa-regular fa-thumbs-up"></i>
                                <div>{{ $post->like }}</div>
                            </span>
                        </div>
                    </footer>
                </article>
                <div class="sharing">
                    <div class="title"><i class="ion-android-share-alt"></i> {{ __('jagoronitv::magz.sharing_is_caring') }}</div>
                    {!! Share::page(request()->url(), $post->post_title, [], '<ul class="social">', '</ul>')
                    ->facebook()
                    ->twitter()
                    ->linkedin()
                    ->whatsapp()
                    ->telegram()!!}
                </div>
                <div class="line">
                    <div>{{ __('jagoronitv::magz.author') }}</div>
                </div>
                <div class="author">
                    <figure>
                        @if($post->user->photo)
                            @if($post->user->photo)
                                @if(\App\Helpers\ImageHelper::isExists('avatar', $post->user->photo))
                                    <img src="{{ asset('storage/avatar/'.$post->user->photo) }}" alt="{{ $post->user->name }}" width="100" height="100">
                                @else
                                    <img src="{{ asset('img/noavatar.png') }}" alt="{{ __('jagoronitv::magz.no_image') }}" width="100" height="100">
                                @endif
                            @else
                                <img src="{{ asset('img/noavatar.png') }}" alt="{{ __('jagoronitv::magz.no_image') }}" width="100" height="100">
                            @endif
                        @else
                            <img src="{{ asset('img/noavatar.png') }}" alt="{{ __('jagoronitv::magz.no_image') }}" width="100" height="100">
                        @endif
                    </figure>
                    <div class="details">
                        @if($post->user->occupation) <div class="job">{{ $post->user->occupation }}</div> @endif
                        <div class="name">{{ $post->user->name }}</div>
                        <p>@if($post->user->about) {{ $post->user->about }} @endif</p>

                        @if ($post->user->links)
                            <ul class="social trp sm">
                                @foreach ( json_decode($post->user->links) as $link )
                                    <li>
                                        <a href="{{ $link->url }}" aria-label="{{ $link->label }}" target="_blank" style="background-color: {{ $link->color }};color:#fff">
                                            <i class="{{ $link->icon }}"></i>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
                <x-related-post :mainPostTitle="$post->post_title" :page="$page" :post="$post" layout="body" widgetName="related_post" :widgetData="$relatedPost"/>
                <div class="line thin"></div>
                @include('frontend.magz.inc._comment-disqus')
                @include('frontend.magz.inc._comment')
            @endif
            </div>
            @if($sidebarActive)
                @include('frontend.magz.template-parts.sidebar')
            @endif
        </div>
    </div>
</section>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('vendor/prism.js/prism.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/plyr/plyr.min.css') }}" />
    <style>
        body.skin-magz section.single.jtv-single-page {
            padding: 18px 0 48px !important;
            background: #f4f6f5 !important;
        }

        body.skin-magz .jtv-single-container {
            width: min(960px, calc(100% - 28px)) !important;
            max-width: 960px !important;
            margin: 0 auto !important;
        }

        body.skin-magz .jtv-single-layout {
            display: grid !important;
            grid-template-columns: 170px minmax(0, 1fr) 170px !important;
            gap: 10px !important;
            align-items: start !important;
            margin: 0 !important;
        }

        body.skin-magz .jtv-single-layout > .jtv-single-sidebar,
        body.skin-magz .jtv-single-layout > .jtv-single-content {
            width: auto !important;
            max-width: none !important;
            min-width: 0 !important;
            margin: 0 !important;
            padding: 0 !important;
        }

        body.skin-magz .jtv-single-layout > .jtv-single-sidebar:first-child { grid-column: 1; grid-row: 1; }
        body.skin-magz .jtv-single-layout > .jtv-single-content { grid-column: 2; grid-row: 1; }
        body.skin-magz .jtv-single-layout > .jtv-single-sidebar:last-child { grid-column: 3; grid-row: 1; }

        body.skin-magz .jtv-single-page article.main-article {
            margin: 0 !important;
            border: 1px solid #e1e8e4 !important;
            border-radius: 4px !important;
            background: #fff !important;
            box-shadow: 0 2px 9px rgba(19, 58, 41, .08) !important;
        }

        body.skin-magz .jtv-single-page article.main-article > header { padding: 22px 24px 12px !important; }
        body.skin-magz .jtv-single-page article.main-article > header h1 {
            margin: 0 0 12px !important;
            color: #202b26 !important;
            font-size: clamp(25px, 3vw, 39px) !important;
            font-weight: 800 !important;
            line-height: 1.17 !important;
        }

        body.skin-magz .jtv-single-page article.main-article .details {
            display: flex !important;
            flex-wrap: wrap !important;
            gap: 8px 14px !important;
            margin: 0 !important;
            padding: 0 !important;
            font-size: 11px !important;
        }

        body.skin-magz .jtv-single-page article.main-article > .main { padding: 0 24px 22px !important; }
        body.skin-magz .jtv-single-page article.main-article .summary {
            margin: 0 0 18px !important;
            padding: 13px 15px !important;
            border-left: 4px solid #0b6b3a !important;
            color: #405149 !important;
            font-size: 15px !important;
            line-height: 1.75 !important;
            background: #eff8f2 !important;
        }

        body.skin-magz .jtv-single-page article.main-article .main figure.figure { margin: 0 0 20px !important; }
        body.skin-magz .jtv-single-page article.main-article .main figure.figure img {
            display: block !important;
            width: 100% !important;
            max-width: 100% !important;
            height: auto !important;
            max-height: 600px !important;
            object-fit: cover !important;
        }

        body.skin-magz .jtv-single-page article.main-article .main > p,
        body.skin-magz .jtv-single-page article.main-article .main > ul,
        body.skin-magz .jtv-single-page article.main-article .main > ol {
            color: #303b36 !important;
            font-size: 16px !important;
            line-height: 1.9 !important;
        }

        body.skin-magz .jtv-single-page .sharing {
            margin: 14px 0 !important;
            padding: 12px 16px !important;
            border: 1px solid #e1e8e4 !important;
            background: #fff !important;
        }

        body.skin-magz .jtv-single-page .jtv-single-sidebar > * { margin-bottom: 14px !important; }
        body.skin-magz .jtv-single-page .jtv-single-sidebar .block,
        body.skin-magz .jtv-single-page .jtv-single-sidebar aside {
            overflow: hidden !important;
            margin: 0 0 10px !important;
            border: 1px solid #e0e8e3 !important;
            background: #fff !important;
        }

        body.skin-magz .jtv-single-page .jtv-single-sidebar #sponsored .aside-body {
            padding: 0 !important;
        }

        body.skin-magz .jtv-single-page .jtv-single-sidebar #sponsored .ads,
        body.skin-magz .jtv-single-page .jtv-single-sidebar #sponsored img {
            display: block !important;
            width: 100% !important;
            height: auto !important;
            margin: 0 !important;
        }

        body.skin-magz .jtv-single-page .jtv-single-sidebar-bottom-ad {
            margin: 0 0 10px !important;
        }

        body.skin-magz .jtv-single-page .jtv-single-sidebar-bottom-ad aside {
            margin-bottom: 0 !important;
        }

        body.skin-magz .jtv-single-page .jtv-single-sidebar-bottom-ad .aside-body,
        body.skin-magz .jtv-single-page .jtv-single-sidebar-bottom-ad .ads {
            padding: 0 !important;
        }

        body.skin-magz .jtv-single-page .jtv-single-sidebar-bottom-ad img {
            display: block !important;
            width: 100% !important;
            height: auto !important;
        }

        body.skin-magz .jtv-single-page .jtv-single-sidebar .aside-title {
            margin: 0 !important;
            padding: 8px 9px !important;
            border-bottom: 2px solid #0b6b3a !important;
            color: #202b26 !important;
            font-size: 12px !important;
            font-weight: 800 !important;
            background: #fff !important;
        }

        body.skin-magz .jtv-single-page .jtv-single-sidebar .article-fw {
            margin: 0 !important;
            padding: 7px !important;
            border-bottom: 1px solid #e5ece8 !important;
        }

        body.skin-magz .jtv-single-page .jtv-single-sidebar .article-fw figure {
            width: 100% !important;
            height: 82px !important;
            margin: 0 0 5px !important;
        }

        body.skin-magz .jtv-single-page .jtv-single-sidebar .article-fw .details h1 {
            margin: 0 !important;
            font-size: 11px !important;
            line-height: 1.3 !important;
        }

        body.skin-magz .jtv-single-page .jtv-single-sidebar .newsletter {
            padding: 14px 10px !important;
        }

        @media (max-width: 991px) {
            body.skin-magz .jtv-single-container { width: calc(100% - 28px) !important; }
            body.skin-magz .jtv-single-layout { grid-template-columns: 150px minmax(0, 1fr) 150px !important; gap: 10px !important; }
            body.skin-magz .jtv-single-page article.main-article > header { padding: 17px 16px 10px !important; }
            body.skin-magz .jtv-single-page article.main-article > .main { padding: 0 16px 17px !important; }
            body.skin-magz .jtv-single-page article.main-article > header h1 { font-size: 28px !important; }
            body.skin-magz .jtv-single-page article.main-article .main > p { font-size: 14px !important; line-height: 1.75 !important; }
        }

        @media (max-width: 767px) {
            body.skin-magz section.single.jtv-single-page { padding-top: 10px !important; }
            body.skin-magz .jtv-single-container { width: calc(100% - 20px) !important; }
            body.skin-magz .jtv-single-layout { display: flex !important; flex-direction: column !important; gap: 12px !important; }
            body.skin-magz .jtv-single-layout > .jtv-single-sidebar,
            body.skin-magz .jtv-single-layout > .jtv-single-content { width: 100% !important; }
            body.skin-magz .jtv-single-layout > .jtv-single-sidebar:first-child { order: 2; }
            body.skin-magz .jtv-single-layout > .jtv-single-content { order: 1; }
            body.skin-magz .jtv-single-layout > .jtv-single-sidebar:last-child { display: block !important; order: 3; }
            body.skin-magz .jtv-single-page article.main-article > header { padding: 17px 15px 10px !important; }
            body.skin-magz .jtv-single-page article.main-article > header h1 { font-size: 26px !important; }
            body.skin-magz .jtv-single-page article.main-article > .main { padding: 0 15px 17px !important; }
            body.skin-magz .jtv-single-page article.main-article .main > p { font-size: 15px !important; line-height: 1.8 !important; }
        }

        /* Final article-page alignment: same masthead and proportions as home. */
        body.skin-magz header.primary {
            background: #fff !important;
            border-bottom: 1px solid #d7e2dc !important;
        }

        body.skin-magz header.primary .jtv-topbar,
        body.skin-magz header.primary .firstbar.jtv-masthead {
            display: block !important;
            visibility: visible !important;
            opacity: 1 !important;
        }

        body.skin-magz header.primary .jtv-topbar {
            min-height: 46px !important;
            height: 46px !important;
            background: #fff !important;
            color: #294739 !important;
            border-top: 1px solid #d8e1dc !important;
            border-bottom: 1px solid #e1eae5 !important;
        }

        body.skin-magz header.primary .firstbar.jtv-masthead {
            min-height: 104px !important;
            padding: 12px 0 10px !important;
            background: #fff !important;
            border-bottom: 1px solid #e5ece8 !important;
        }

        body.skin-magz header.primary .jtv-topbar-inner,
        body.skin-magz header.primary .jtv-masthead-inner {
            width: min(1440px, calc(100% - 48px)) !important;
            max-width: 1440px !important;
            margin: 0 auto !important;
        }

        body.skin-magz header.primary .jtv-masthead-inner {
            min-height: 82px !important;
            display: grid !important;
            grid-template-columns: minmax(260px, 1fr) minmax(180px, .7fr) minmax(260px, 1fr) !important;
            align-items: center !important;
            gap: 24px !important;
        }

        body.skin-magz header.primary .jtv-masthead-brand {
            display: flex !important;
            align-items: center !important;
            width: max-content !important;
            max-width: 100% !important;
            text-decoration: none !important;
        }

        body.skin-magz header.primary .jtv-masthead-brand-mark {
            width: 68px !important;
            height: 68px !important;
            object-fit: contain !important;
        }

        body.skin-magz header.primary .jtv-masthead-brand-copy strong {
            display: block !important;
            color: #16452e !important;
            font-size: clamp(23px, 2.1vw, 34px) !important;
            line-height: 1 !important;
        }

        body.skin-magz header.primary .jtv-masthead-brand-copy strong b { color: #d51f2a !important; }

        body.skin-magz header.primary .jtv-masthead-message {
            display: flex !important;
            flex-direction: column !important;
            align-items: center !important;
            color: #173f2b !important;
            text-align: center !important;
        }

        body.skin-magz header.primary .jtv-masthead-art { display: block !important; }

        body.skin-magz header.primary nav.jtv-main-nav {
            display: block !important;
            width: 100% !important;
            height: 68px !important;
            min-height: 68px !important;
            background: linear-gradient(105deg, #07532d, #0b6b3a 52%, #118a5b) !important;
        }

        body.skin-magz header.primary nav.jtv-main-nav .jtv-nav-container {
            width: min(1440px, calc(100% - 48px)) !important;
            max-width: 1440px !important;
            height: 68px !important;
            min-height: 68px !important;
        }

        body.skin-magz section.single.jtv-single-page {
            padding: 18px 0 52px !important;
            background: #f1f3f4 !important;
        }

        body.skin-magz section.single.jtv-single-page .jtv-single-container {
            width: min(1440px, calc(100% - 48px)) !important;
            max-width: 1440px !important;
            margin: 0 auto !important;
        }

        body.skin-magz section.single.jtv-single-page .jtv-single-layout {
            display: grid !important;
            grid-template-columns: 220px minmax(0, 1fr) 280px !important;
            gap: 14px !important;
            align-items: start !important;
        }

        body.skin-magz section.single.jtv-single-page .jtv-single-layout > .jtv-single-sidebar,
        body.skin-magz section.single.jtv-single-page .jtv-single-layout > .jtv-single-content {
            width: auto !important;
            max-width: none !important;
            min-width: 0 !important;
            margin: 0 !important;
            padding: 0 !important;
        }

        body.skin-magz section.single.jtv-single-page .jtv-single-layout > .jtv-single-sidebar:first-child { grid-column: 1 !important; grid-row: 1 !important; }
        body.skin-magz section.single.jtv-single-page .jtv-single-layout > .jtv-single-content { grid-column: 2 !important; grid-row: 1 !important; }
        body.skin-magz section.single.jtv-single-page .jtv-single-layout > .jtv-single-sidebar:last-child { grid-column: 3 !important; grid-row: 1 !important; }

        body.skin-magz section.single.jtv-single-page article.main-article {
            overflow: hidden !important;
            border: 1px solid #dce6e1 !important;
            border-radius: 7px !important;
            background: #fff !important;
            box-shadow: 0 5px 18px rgba(13, 68, 42, .08) !important;
        }

        body.skin-magz section.single.jtv-single-page article.main-article > header { padding: 24px 28px 14px !important; }
        body.skin-magz section.single.jtv-single-page article.main-article > header h1 {
            color: #173a2a !important;
            font-size: clamp(27px, 3vw, 46px) !important;
            line-height: 1.2 !important;
        }

        body.skin-magz section.single.jtv-single-page article.main-article > .main { padding: 0 28px 28px !important; }
        body.skin-magz section.single.jtv-single-page article.main-article .summary {
            margin: 0 -28px 22px !important;
            padding: 16px 28px !important;
            border-left: 5px solid #0b6b3a !important;
            background: #eff8f2 !important;
            font-size: 16px !important;
            line-height: 1.8 !important;
        }

        body.skin-magz section.single.jtv-single-page article.main-article .main figure.figure img {
            width: 100% !important;
            max-width: 100% !important;
            max-height: none !important;
            border-radius: 5px !important;
        }

        body.skin-magz section.single.jtv-single-page article.main-article .main > p,
        body.skin-magz section.single.jtv-single-page article.main-article .main > ul,
        body.skin-magz section.single.jtv-single-page article.main-article .main > ol {
            color: #293b32 !important;
            font-size: 17px !important;
            line-height: 1.95 !important;
        }

        body.skin-magz section.single.jtv-single-page .jtv-single-sidebar .block,
        body.skin-magz section.single.jtv-single-page .jtv-single-sidebar aside {
            overflow: hidden !important;
            border: 1px solid #dce8e1 !important;
            border-radius: 6px !important;
            background: #fff !important;
            box-shadow: 0 3px 12px rgba(13, 68, 42, .06) !important;
        }

        @media (max-width: 991px) {
            body.skin-magz header.primary .jtv-masthead-inner { grid-template-columns: 1fr 1fr !important; }
            body.skin-magz header.primary .jtv-masthead-message { display: none !important; }
            body.skin-magz section.single.jtv-single-page .jtv-single-layout { grid-template-columns: 180px minmax(0, 1fr) !important; }
            body.skin-magz section.single.jtv-single-page .jtv-single-layout > .jtv-single-sidebar:last-child { display: none !important; }
        }

        @media (max-width: 767px) {
            body.skin-magz header.primary .firstbar.jtv-masthead { min-height: 76px !important; padding: 8px 0 !important; }
            body.skin-magz header.primary .jtv-masthead-inner { display: flex !important; justify-content: center !important; min-height: 60px !important; }
            body.skin-magz header.primary .jtv-masthead-brand-mark { width: 52px !important; height: 52px !important; }
            body.skin-magz header.primary .jtv-masthead-brand-copy strong { font-size: 21px !important; }
            body.skin-magz header.primary .jtv-masthead-message,
            body.skin-magz header.primary .jtv-masthead-art { display: none !important; }
            body.skin-magz header.primary .jtv-topbar-inner,
            body.skin-magz header.primary nav.jtv-main-nav .jtv-nav-container { width: calc(100% - 20px) !important; }
            body.skin-magz section.single.jtv-single-page { padding: 10px 0 32px !important; }
            body.skin-magz section.single.jtv-single-page .jtv-single-container { width: calc(100% - 20px) !important; }
            body.skin-magz section.single.jtv-single-page .jtv-single-layout { display: flex !important; flex-direction: column !important; gap: 12px !important; }
            body.skin-magz section.single.jtv-single-page .jtv-single-layout > .jtv-single-content { order: 1 !important; width: 100% !important; }
            body.skin-magz section.single.jtv-single-page .jtv-single-layout > .jtv-single-sidebar:first-child { order: 2 !important; width: 100% !important; }
            body.skin-magz section.single.jtv-single-page .jtv-single-layout > .jtv-single-sidebar:last-child { display: block !important; order: 3 !important; width: 100% !important; }
            body.skin-magz section.single.jtv-single-page article.main-article > header { padding: 18px 15px 12px !important; }
            body.skin-magz section.single.jtv-single-page article.main-article > header h1 { font-size: clamp(24px, 7vw, 32px) !important; }
            body.skin-magz section.single.jtv-single-page article.main-article > .main { padding: 0 15px 18px !important; }
            body.skin-magz section.single.jtv-single-page article.main-article .summary { margin: 0 -15px 18px !important; padding: 13px 15px !important; font-size: 14px !important; }
            body.skin-magz section.single.jtv-single-page article.main-article .main > p { font-size: 15px !important; line-height: 1.85 !important; }
        }

        /* Homepage shell copy for article details. */
        body.skin-magz.jtv-homepage section.single.jtv-single-page {
            padding: 16px 0 42px !important;
            background: #f1f3f4 !important;
        }

        body.skin-magz.jtv-homepage section.single.jtv-single-page .jtv-single-container {
            width: min(1440px, calc(100% - 56px)) !important;
            max-width: 1440px !important;
            margin: 0 auto !important;
        }

        body.skin-magz.jtv-homepage section.single.jtv-single-page .jtv-single-layout {
            display: grid !important;
            grid-template-columns: 230px minmax(0, 1fr) 290px !important;
            gap: 14px !important;
            align-items: start !important;
            margin: 0 !important;
        }

        body.skin-magz.jtv-homepage section.single.jtv-single-page .jtv-single-layout > .jtv-single-sidebar,
        body.skin-magz.jtv-homepage section.single.jtv-single-page .jtv-single-layout > .jtv-single-content {
            width: auto !important;
            max-width: none !important;
            min-width: 0 !important;
            margin: 0 !important;
            padding: 0 !important;
        }

        body.skin-magz.jtv-homepage section.single.jtv-single-page .jtv-single-layout > .jtv-single-sidebar:first-child { grid-column: 1 !important; grid-row: 1 !important; }
        body.skin-magz.jtv-homepage section.single.jtv-single-page .jtv-single-layout > .jtv-single-content { grid-column: 2 !important; grid-row: 1 !important; }
        body.skin-magz.jtv-homepage section.single.jtv-single-page .jtv-single-layout > .jtv-single-sidebar:last-child { grid-column: 3 !important; grid-row: 1 !important; }

        body.skin-magz.jtv-homepage section.single.jtv-single-page .breadcrumb {
            margin: 0 0 10px !important;
            padding: 7px 12px !important;
            border: 1px solid #dbe6e0 !important;
            border-radius: 4px !important;
            background: #fff !important;
            font-size: 11px !important;
        }

        body.skin-magz.jtv-homepage section.single.jtv-single-page article.main-article {
            overflow: hidden !important;
            margin: 0 !important;
            border: 1px solid #dbe5df !important;
            border-radius: 4px !important;
            background: #fff !important;
            box-shadow: 0 3px 12px rgba(16, 69, 43, .07) !important;
        }

        body.skin-magz.jtv-homepage section.single.jtv-single-page article.main-article > header {
            padding: 22px 24px 12px !important;
            border-bottom: 1px solid #eef2ef !important;
        }

        body.skin-magz.jtv-homepage section.single.jtv-single-page article.main-article > header h1 {
            margin: 0 0 11px !important;
            color: #172d22 !important;
            font-family: Arial, "Noto Sans Bengali", sans-serif !important;
            font-size: clamp(27px, 3.2vw, 46px) !important;
            font-weight: 800 !important;
            line-height: 1.15 !important;
        }

        body.skin-magz.jtv-homepage section.single.jtv-single-page article.main-article .details {
            display: flex !important;
            flex-wrap: wrap !important;
            gap: 7px 14px !important;
            margin: 0 !important;
            padding: 0 !important;
            color: #7a8880 !important;
            font-size: 11px !important;
        }

        body.skin-magz.jtv-homepage section.single.jtv-single-page article.main-article > .main {
            padding: 0 24px 24px !important;
        }

        body.skin-magz.jtv-homepage section.single.jtv-single-page article.main-article .summary {
            margin: 0 -24px 20px !important;
            padding: 14px 24px !important;
            border-left: 4px solid #0b6b3a !important;
            color: #395246 !important;
            font-size: 15px !important;
            line-height: 1.75 !important;
            background: #eff8f2 !important;
        }

        body.skin-magz.jtv-homepage section.single.jtv-single-page article.main-article .main figure.figure {
            margin: 0 0 20px !important;
        }

        body.skin-magz.jtv-homepage section.single.jtv-single-page article.main-article .main figure.figure img {
            display: block !important;
            width: 100% !important;
            max-width: 100% !important;
            height: auto !important;
            max-height: 660px !important;
            border-radius: 3px !important;
            object-fit: cover !important;
        }

        body.skin-magz.jtv-homepage section.single.jtv-single-page article.main-article .main > p,
        body.skin-magz.jtv-homepage section.single.jtv-single-page article.main-article .main > ul,
        body.skin-magz.jtv-homepage section.single.jtv-single-page article.main-article .main > ol {
            color: #2e4037 !important;
            font-size: 16px !important;
            line-height: 1.9 !important;
        }

        body.skin-magz.jtv-homepage section.single.jtv-single-page article.main-article > footer,
        body.skin-magz.jtv-homepage section.single.jtv-single-page .sharing,
        body.skin-magz.jtv-homepage section.single.jtv-single-page .author {
            border-color: #dbe7e0 !important;
            background: #fff !important;
        }

        body.skin-magz.jtv-homepage section.single.jtv-single-page .sharing {
            margin: 14px 0 !important;
            padding: 12px 15px !important;
            border: 1px solid #dbe7e0 !important;
            border-radius: 4px !important;
        }

        body.skin-magz.jtv-homepage section.single.jtv-single-page .jtv-single-sidebar > * {
            margin-bottom: 14px !important;
        }

        body.skin-magz.jtv-homepage section.single.jtv-single-page .jtv-single-sidebar .block,
        body.skin-magz.jtv-homepage section.single.jtv-single-page .jtv-single-sidebar aside {
            overflow: hidden !important;
            margin: 0 0 12px !important;
            border: 1px solid #dbe6e0 !important;
            border-radius: 3px !important;
            background: #fff !important;
            box-shadow: 0 2px 8px rgba(16, 69, 43, .05) !important;
        }

        body.skin-magz.jtv-homepage section.single.jtv-single-page .jtv-single-sidebar .aside-title,
        body.skin-magz.jtv-homepage section.single.jtv-single-page .jtv-category-news-tabs {
            margin: 0 !important;
            padding: 9px 11px !important;
            border-bottom: 2px solid #0b6b3a !important;
            color: #fff !important;
            font-size: 13px !important;
            font-weight: 800 !important;
            background: #087642 !important;
        }

        body.skin-magz.jtv-homepage section.single.jtv-single-page .jtv-single-sidebar #sponsored .aside-body,
        body.skin-magz.jtv-homepage section.single.jtv-single-page .jtv-single-sidebar #sponsored .ads,
        body.skin-magz.jtv-homepage section.single.jtv-single-page .jtv-single-sidebar #sponsored img,
        body.skin-magz.jtv-homepage section.single.jtv-single-page .jtv-single-sidebar-bottom-ad .aside-body,
        body.skin-magz.jtv-homepage section.single.jtv-single-page .jtv-single-sidebar-bottom-ad .ads,
        body.skin-magz.jtv-homepage section.single.jtv-single-page .jtv-single-sidebar-bottom-ad img {
            display: block !important;
            width: 100% !important;
            height: auto !important;
            padding: 0 !important;
            margin: 0 !important;
        }

        body.skin-magz.jtv-homepage section.single.jtv-single-page .jtv-single-sidebar .article-fw {
            margin: 0 !important;
            padding: 8px !important;
            border-bottom: 1px solid #e5ece8 !important;
        }

        body.skin-magz.jtv-homepage section.single.jtv-single-page .jtv-single-sidebar .article-fw figure {
            width: 100% !important;
            height: 86px !important;
            margin: 0 0 6px !important;
        }

        @media (max-width: 1199px) {
            body.skin-magz.jtv-homepage section.single.jtv-single-page .jtv-single-container { width: calc(100% - 28px) !important; }
            body.skin-magz.jtv-homepage section.single.jtv-single-page .jtv-single-layout { grid-template-columns: 190px minmax(0, 1fr) 240px !important; }
        }

        @media (max-width: 991px) {
            body.skin-magz.jtv-homepage section.single.jtv-single-page .jtv-single-layout { grid-template-columns: 180px minmax(0, 1fr) !important; }
            body.skin-magz.jtv-homepage section.single.jtv-single-page .jtv-single-layout > .jtv-single-sidebar:last-child { display: none !important; }
        }

        @media (max-width: 767px) {
            body.skin-magz.jtv-homepage section.single.jtv-single-page { padding: 10px 0 32px !important; }
            body.skin-magz.jtv-homepage section.single.jtv-single-page .jtv-single-container { width: calc(100% - 20px) !important; }
            body.skin-magz.jtv-homepage section.single.jtv-single-page .jtv-single-layout { display: flex !important; flex-direction: column !important; gap: 12px !important; }
            body.skin-magz.jtv-homepage section.single.jtv-single-page .jtv-single-layout > .jtv-single-content { order: 1 !important; width: 100% !important; }
            body.skin-magz.jtv-homepage section.single.jtv-single-page .jtv-single-layout > .jtv-single-sidebar:first-child { order: 2 !important; width: 100% !important; }
            body.skin-magz.jtv-homepage section.single.jtv-single-page .jtv-single-layout > .jtv-single-sidebar:last-child { display: block !important; order: 3 !important; width: 100% !important; }
            body.skin-magz.jtv-homepage section.single.jtv-single-page article.main-article > header { padding: 17px 15px 11px !important; }
            body.skin-magz.jtv-homepage section.single.jtv-single-page article.main-article > header h1 { font-size: clamp(24px, 7vw, 32px) !important; }
            body.skin-magz.jtv-homepage section.single.jtv-single-page article.main-article > .main { padding: 0 15px 18px !important; }
            body.skin-magz.jtv-homepage section.single.jtv-single-page article.main-article .summary { margin: 0 -15px 17px !important; padding: 12px 15px !important; font-size: 14px !important; }
            body.skin-magz.jtv-homepage section.single.jtv-single-page article.main-article .main > p { font-size: 15px !important; line-height: 1.82 !important; }
        }

        /* Exact homepage header copy for the detail page. */
        body.skin-magz.jtv-homepage header.primary {
            background: #fff !important;
            box-shadow: 0 2px 14px rgba(0, 0, 0, .08) !important;
        }

        body.skin-magz.jtv-homepage .jtv-topbar {
            display: flex !important;
            align-items: center !important;
            width: 100% !important;
            min-height: 46px !important;
            height: 46px !important;
            background: #fff !important;
            color: #294739 !important;
            border-top: 1px solid #d8e1dc !important;
            border-bottom: 1px solid #e1eae5 !important;
        }

        body.skin-magz.jtv-homepage .jtv-topbar-inner {
            display: grid !important;
            position: relative !important;
            width: min(1440px, calc(100% - 30px)) !important;
            max-width: 1440px !important;
            min-height: 46px !important;
            height: 46px !important;
            margin: 0 auto !important;
            grid-template-columns: auto 1fr auto !important;
            gap: 14px !important;
            align-items: center !important;
        }

        body.skin-magz.jtv-homepage .jtv-topbar-meta,
        body.skin-magz.jtv-homepage .jtv-topbar-title,
        body.skin-magz.jtv-homepage .jtv-topbar-actions,
        body.skin-magz.jtv-homepage .jtv-topbar-social {
            display: flex !important;
            align-items: center !important;
            visibility: visible !important;
            opacity: 1 !important;
        }

        body.skin-magz.jtv-homepage .jtv-topbar-meta {
            gap: 8px !important;
            white-space: nowrap !important;
            color: #4e665a !important;
            font-size: 12px !important;
        }

        body.skin-magz.jtv-homepage .jtv-topbar-title {
            justify-content: center !important;
            color: #314d40 !important;
            font-size: 12px !important;
            font-weight: 700 !important;
            text-align: center !important;
            white-space: nowrap !important;
        }

        body.skin-magz.jtv-homepage .jtv-topbar-actions {
            min-width: 285px !important;
            justify-content: flex-end !important;
            gap: 10px !important;
            height: 34px !important;
        }

        body.skin-magz.jtv-homepage .jtv-topbar-social {
            gap: 8px !important;
            margin: 0 !important;
            padding: 0 !important;
            list-style: none !important;
        }

        body.skin-magz.jtv-homepage .jtv-topbar-social a {
            display: inline-flex !important;
            width: 18px !important;
            height: 18px !important;
            align-items: center !important;
            justify-content: center !important;
            color: #1d3d2e !important;
            font-size: 12px !important;
        }

        body.skin-magz.jtv-homepage .jtv-topbar-search {
            display: flex !important;
            flex: 0 0 190px !important;
            width: 190px !important;
            height: 30px !important;
            align-items: center !important;
            overflow: hidden !important;
            border: 1px solid #b9c9bf !important;
            border-radius: 2px !important;
            background: #fff !important;
        }

        body.skin-magz.jtv-homepage .jtv-topbar-search input {
            flex: 1 1 auto !important;
            width: auto !important;
            min-width: 0 !important;
            height: 28px !important;
            padding: 0 10px !important;
            border: 0 !important;
            outline: 0 !important;
        }

        body.skin-magz.jtv-homepage .jtv-topbar-search button {
            display: inline-flex !important;
            flex: 0 0 34px !important;
            width: 34px !important;
            height: 30px !important;
            align-items: center !important;
            justify-content: center !important;
            padding: 0 !important;
            border: 0 !important;
            color: #fff !important;
            background: #d71e27 !important;
        }

        body.skin-magz.jtv-homepage .firstbar.jtv-masthead {
            display: block !important;
            width: 100% !important;
            min-height: 94px !important;
            padding: 8px 0 9px !important;
            border-bottom: 0 !important;
            background: radial-gradient(circle at 36% 30%, rgba(11, 107, 58, .08), transparent 24%), linear-gradient(180deg, #fff 0%, #f8fbf9 100%) !important;
        }

        body.skin-magz.jtv-homepage .jtv-masthead-inner {
            display: grid !important;
            width: min(1440px, calc(100% - 30px)) !important;
            max-width: 1440px !important;
            margin: 0 auto !important;
            grid-template-columns: minmax(240px, 340px) 1fr 300px !important;
            gap: 18px !important;
            align-items: center !important;
        }

        body.skin-magz.jtv-homepage .jtv-masthead-brand {
            display: flex !important;
            align-items: flex-start !important;
            justify-content: center !important;
            gap: 8px !important;
            text-decoration: none !important;
        }

        body.skin-magz.jtv-homepage .jtv-masthead-brand-mark {
            width: 66px !important;
            height: 66px !important;
            max-width: 66px !important;
            object-fit: contain !important;
        }

        body.skin-magz.jtv-homepage .jtv-masthead-brand-copy {
            display: block !important;
            padding-top: 8px !important;
            text-align: left !important;
            white-space: nowrap !important;
        }

        body.skin-magz.jtv-homepage .jtv-masthead-brand-copy strong {
            display: block !important;
            color: #0b4f32 !important;
            font-size: 31px !important;
            font-weight: 800 !important;
            letter-spacing: -1.2px !important;
            line-height: .95 !important;
        }

        body.skin-magz.jtv-homepage .jtv-masthead-brand-copy strong b { color: #d9232e !important; }
        body.skin-magz.jtv-homepage .jtv-masthead-brand-copy small {
            display: block !important;
            margin-top: 5px !important;
            color: #365d4a !important;
            font-size: 11px !important;
            font-weight: 700 !important;
        }

        body.skin-magz.jtv-homepage .jtv-masthead-message {
            color: #163a2b !important;
            font-size: 17px !important;
            font-weight: 800 !important;
            line-height: 1.4 !important;
            text-align: right !important;
        }

        body.skin-magz.jtv-homepage .jtv-masthead-message strong,
        body.skin-magz.jtv-homepage .jtv-masthead-message span,
        body.skin-magz.jtv-homepage .jtv-masthead-message em { display: block !important; font-style: normal !important; }

        body.skin-magz.jtv-homepage .jtv-masthead-art {
            position: relative !important;
            height: 88px !important;
            overflow: hidden !important;
        }

        body.skin-magz.jtv-homepage .jtv-art-sun {
            position: absolute !important;
            top: 18px !important;
            right: 46px !important;
            width: 34px !important;
            height: 34px !important;
            border-radius: 50% !important;
            background: radial-gradient(circle at 30% 30%, #ff8f81, #e2202c 70%, #b80f1a 100%) !important;
            box-shadow: 0 0 0 8px rgba(226, 32, 44, .13) !important;
        }

        body.skin-magz.jtv-homepage .jtv-art-wave {
            position: absolute !important;
            right: -10px !important;
            border-radius: 999px 0 0 999px !important;
            transform: rotate(-8deg) !important;
        }

        body.skin-magz.jtv-homepage .jtv-art-wave-one {
            right: -12px !important;
            bottom: 8px !important;
            width: 190px !important;
            height: 18px !important;
            background: #0b6b3a !important;
        }

        body.skin-magz.jtv-homepage .jtv-art-wave-two {
            right: -16px !important;
            bottom: 19px !important;
            width: 178px !important;
            height: 12px !important;
            background: #f8faf9 !important;
        }

        body.skin-magz.jtv-homepage .jtv-art-wave-three {
            right: -18px !important;
            bottom: 28px !important;
            width: 175px !important;
            height: 14px !important;
            background: #d61f26 !important;
        }

        body.skin-magz.jtv-homepage .jtv-art-monument {
            position: absolute !important;
            right: 96px !important;
            bottom: 10px !important;
            width: 54px !important;
            height: 68px !important;
            background: linear-gradient(180deg, #3e6254, #18362b) !important;
            clip-path: polygon(50% 0, 57% 14%, 62% 45%, 71% 100%, 53% 100%, 50% 57%, 47% 100%, 29% 100%, 38% 45%, 43% 14%) !important;
        }

        body.skin-magz.jtv-homepage nav.jtv-main-nav {
            position: relative !important;
            z-index: 10 !important;
            display: block !important;
            width: 100% !important;
            min-height: 44px !important;
            height: 44px !important;
            background: #006b3f !important;
            overflow: hidden !important;
        }

        body.skin-magz.jtv-homepage nav.jtv-main-nav .jtv-nav-container {
            display: flex !important;
            width: min(1440px, calc(100% - 30px)) !important;
            max-width: 1440px !important;
            height: 44px !important;
            min-height: 44px !important;
            margin: 0 auto !important;
        }

        /* Keep the article body on the same centered canvas as the homepage reference. */
        body.skin-magz.jtv-homepage section.single.jtv-single-page .jtv-single-container {
            width: min(1160px, calc(100% - 28px)) !important;
            max-width: 1160px !important;
        }

        body.skin-magz.jtv-homepage section.single.jtv-single-page .jtv-single-layout {
            grid-template-columns: 190px minmax(0, 1fr) 240px !important;
            gap: 12px !important;
        }

        @media (max-width: 991px) {
            body.skin-magz.jtv-homepage .jtv-masthead-inner { grid-template-columns: 1fr 1fr !important; }
            body.skin-magz.jtv-homepage .jtv-masthead-message { display: none !important; }
        }

        @media (max-width: 767px) {
            body.skin-magz.jtv-homepage .jtv-masthead-inner { display: flex !important; justify-content: center !important; }
            body.skin-magz.jtv-homepage .jtv-masthead-brand-mark { width: 52px !important; height: 52px !important; }
            body.skin-magz.jtv-homepage .jtv-masthead-brand-copy strong { font-size: 21px !important; }
            body.skin-magz.jtv-homepage .jtv-masthead-message,
            body.skin-magz.jtv-homepage .jtv-masthead-art { display: none !important; }
            body.skin-magz.jtv-homepage .jtv-topbar-inner,
            body.skin-magz.jtv-homepage .jtv-masthead-inner,
            body.skin-magz.jtv-homepage nav.jtv-main-nav .jtv-nav-container { width: calc(100% - 20px) !important; }
            body.skin-magz.jtv-homepage .jtv-topbar-actions { min-width: 0 !important; gap: 4px !important; }
            body.skin-magz.jtv-homepage .jtv-topbar-social { display: none !important; }
            body.skin-magz.jtv-homepage .jtv-topbar-title { width: 38vw !important; max-width: 190px !important; font-size: 10px !important; }
        }

        /* Final homepage-position alignment for the detail page. */
        @media (min-width: 992px) {
            body.skin-magz.jtv-homepage header.primary .jtv-topbar-inner,
            body.skin-magz.jtv-homepage header.primary .jtv-masthead-inner,
            body.skin-magz.jtv-homepage header.primary nav.jtv-main-nav .jtv-nav-container {
                width: calc(100% - 56px) !important;
                max-width: 1600px !important;
                margin-right: auto !important;
                margin-left: auto !important;
            }

            body.skin-magz.jtv-homepage header.primary .jtv-masthead-inner {
                grid-template-columns: minmax(240px, 340px) 1fr 300px !important;
            }

            body.skin-magz.jtv-homepage section.single.jtv-single-page .jtv-single-container {
                width: calc(100% - 56px) !important;
                max-width: 1600px !important;
                margin-right: auto !important;
                margin-left: auto !important;
            }

            body.skin-magz.jtv-homepage section.single.jtv-single-page .jtv-single-layout {
                grid-template-columns: 190px minmax(0, 1fr) 240px !important;
                gap: 12px !important;
                width: 100% !important;
            }
        }

        body.skin-magz.jtv-homepage header.primary nav.jtv-main-nav .jtv-nav-container,
        body.skin-magz.jtv-homepage header.primary nav.jtv-main-nav #menu-list.jtv-nav-list-wrap {
            margin-top: 0 !important;
            margin-bottom: 0 !important;
        }

        body.skin-magz.jtv-homepage section.single.jtv-single-page .jtv-single-content,
        body.skin-magz.jtv-homepage section.single.jtv-single-page .jtv-single-sidebar {
            min-width: 0 !important;
        }
    </style>
@endpush

@push('scripts')
    <script src="{{ asset('vendor/prism.js/prism.js') }}"></script>
    <script src="{{ asset('js/share.js') }}"></script>
    <script src="{{ asset('vendor/plyr/plyr.min.js') }}"></script>

    <script>
        const player = new Plyr('#player');
    </script>

    <script>
        var commentModal = document.getElementById('commentModal')
        commentModal.addEventListener('hidden.bs.modal', function (event) {
            var url = '{{ route("comment") }}';
            $('input[name="_method"]').detach();
            $("#comment").val('');
            $('#replyId').val('');
            $('#mainReply').val('');
            $('#name').val('');
            $('#email').val('');
            $('#url').val('');
            $('.comment-form').attr('action', url);
            $('.comment-form').attr('data-action', '');
            $('.form-control').removeClass('is-invalid');
            $('#comment-submit').html("{{ __('jagoronitv::magz.send_response') }}");
            $(".spinner-grow").attr("hidden");
        })
    </script>

@endpush
