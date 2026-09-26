@extends('frontend.magz.index')

@inject('termHelper', 'App\Helpers\TermHelper')
@inject('postHelper', 'App\Helpers\PostHelper')

@php
    $categoryTerm = $post->terms()->category()->first();
    $viewsCount = (int) ($post->post_hits ?? 0);
    $viewsLabel = $viewsCount >= 1000
        ? number_format($viewsCount / 1000, 1) . 'ক'
        : number_format($viewsCount);
@endphp

@section('content')
<section class="jtv-details-page">
    <div class="jtv-details-container">
        <ol class="jtv-details-breadcrumb">
            <li><a href="{{ url('/') }}"><i class="fa-solid fa-house"></i> {{ __('jagoronitv::magz.home') }}</a></li>
            @if($categoryTerm)
                <li><a href="{{ $termHelper->resolveUrl($post, $categoryTerm->slug) }}">{{ $termHelper->resolveLabel($post, $categoryTerm->slug) }}</a></li>
            @endif
            <li class="is-active">{{ \Illuminate\Support\Str::limit($post->post_title, 40) }}</li>
        </ol>

        <div class="jtv-details-layout">
            {{-- Left sidebar --}}
            <aside class="jtv-details-sidebar">
                <x-front-advertisement position="sidebar_left" />

                @if($latestPosts->count())
                <div class="jtv-side-block">
                    <h3 class="jtv-side-title">সর্বশেষ সংবাদ</h3>
                    <div class="jtv-side-list">
                        @foreach($latestPosts as $latestPost)
                            <article class="jtv-side-item">
                                <figure>
                                    <a href="{{ $postHelper::getUriPost($latestPost) }}">
                                        <img src="{{ $postHelper::showThumbnail($latestPost, 100) }}" alt="{{ $latestPost->post_title }}" loading="lazy">
                                    </a>
                                </figure>
                                <div class="jtv-side-item-body">
                                    <h4><a href="{{ $postHelper::getUriPost($latestPost) }}">{{ $latestPost->post_title }}</a></h4>
                                    <span>{{ $latestPost->created_at->locale(app()->getLocale())->isoFormat('LL') }}</span>
                                </div>
                            </article>
                        @endforeach
                    </div>
                    <a href="{{ route('articles.latest') }}" class="jtv-side-more">সর্বশেষ আরও →</a>
                </div>
                @endif

                <div class="jtv-promo-block">
                    <h4>আপনার প্রতিষ্ঠানের বিজ্ঞাপন দিন আমাদের মাধ্যমে</h4>
                    <a href="{{ url('/contact') }}" class="jtv-promo-btn">যোগাযোগ করুন</a>
                </div>
            </aside>

            {{-- Main content --}}
            <article class="jtv-details-content">
                <x-front-advertisement position="article_top" />
                @if($categoryTerm)
                    <a href="{{ $termHelper->resolveUrl($post, $categoryTerm->slug) }}" class="jtv-details-badge">{{ $termHelper->resolveLabel($post, $categoryTerm->slug) }}</a>
                @endif

                <h1 class="jtv-details-title">{{ $post->post_title }}</h1>

                <ul class="jtv-details-meta">
                    <li><i class="fa-regular fa-user"></i> {{ $post->user->name ?? 'জাগরনী টিভি ডেস্ক' }}</li>
                    <li><i class="fa-regular fa-calendar"></i> {{ $post->created_at->locale(app()->getLocale())->isoFormat('LL') }}</li>
                    <li><i class="fa-regular fa-eye"></i> {{ $viewsLabel }} বার দেখা হয়েছে</li>
                </ul>

                @if(in_array($post->post_type, ['page', 'post']))
                    @if(!empty($post->post_image) || $postHelper::isImageUrlAvailable($post))
                    <figure class="jtv-details-figure">
                        <img src="{{ $postHelper::displayThumbnailForSinglePost($post) }}" alt="{{ $post->post_title }}">
                        @if($post->post_image_meta && $postHelper::getPostThumbnailCaption($post->post_image_meta))
                            <figcaption>{!! $postHelper::getPostThumbnailCaption($post->post_image_meta) !!}</figcaption>
                        @endif
                    </figure>
                    @endif
                @else
                    @php
                        $postSource = json_decode($post->post_source);
                        $hasMetaImage = $postHelper::isImageUrlAvailable($post);
                        $poster = $hasMetaImage
                            ? json_decode($post->post_image_meta)->image_url
                            : ($post->post_image ? asset('storage/images/' . $post->post_image) : asset('img/cover-video.webp'));
                    @endphp
                    <div class="jtv-details-player">
                        @if($post->post_type === 'video_embed')
                            <div id="player" data-plyr-provider="{{ $postSource->provider }}" data-plyr-embed-id="{{ $postSource->embed_id }}" data-poster="{{ $poster }}" style="--plyr-color-main: #d61f26;"></div>
                        @elseif($post->post_type === 'audio_embed')
                            <div class="plyr__audio-embed" id="player" style="--plyr-color-main: #d61f26;">{!! $post->post_source !!}</div>
                        @elseif(in_array($post->post_type, ['audio_file', 'audio_url']))
                            @php $audioSource = $post->post_type === 'audio_file' ? asset('storage/audios/' . $post->post_source) : $post->post_source; @endphp
                            @if($post->post_image || $hasMetaImage)
                                <img class="jtv-details-player-cover" src="{{ $poster }}" alt="{{ $post->post_title }}">
                            @endif
                            <audio id="player" style="--plyr-color-main: #d61f26;" controls><source src="{{ $audioSource }}"></audio>
                        @elseif($post->post_type === 'video_url')
                            <div id="player" data-plyr-provider="youtube" data-plyr-embed-id="{{ $post->post_source }}" data-poster="{{ $poster }}" style="--plyr-color-main: #d61f26;"></div>
                        @else
                            <video id="player" playsinline controls data-plyr-config='{ "ratio": "16:9" }' data-poster="{{ $poster }}" style="--plyr-color-main: #d61f26;">
                                <source src="{{ asset('storage/videos/' . $post->post_source) }}">
                            </video>
                        @endif
                    </div>
                @endif

                @if($post->post_summary)
                    <div class="jtv-details-summary">{!! $post->post_summary !!}</div>
                @endif

                <div class="jtv-details-body">
                    {!! $post->post_content !!}
                </div>

                <x-front-advertisement position="article_bottom" />

                <div class="jtv-details-share">
                    <span>শেয়ার করুন:</span>
                    {!! Share::page(request()->url(), $post->post_title, [], '<ul class="jtv-details-share-list">', '</ul>')
                        ->facebook()
                        ->twitter()
                        ->linkedin()
                        ->whatsapp()
                        ->telegram() !!}
                </div>

                @if($tags->count())
                <div class="jtv-details-tags">
                    <span class="jtv-details-tags-label"><i class="fa-solid fa-tags"></i> ট্যাগ</span>
                    @foreach($tags as $tag)
                        <a href="{{ route('tag.show', $tag) }}">{{ $tag->name }}</a>
                    @endforeach
                </div>
                @endif

                @if($relatedPosts->count())
                <div class="jtv-details-related">
                    <h3><i class="fa-regular fa-bookmark"></i> আরও পড়ুন</h3>
                    <div class="jtv-details-related-grid">
                        @foreach($relatedPosts as $relatedPost)
                            <article class="jtv-details-related-card">
                                <figure>
                                    <a href="{{ $postHelper::getUriPost($relatedPost) }}">
                                        <img src="{{ $postHelper::showThumbnail($relatedPost, 300) }}" alt="{{ $relatedPost->post_title }}" loading="lazy">
                                    </a>
                                </figure>
                                <h4><a href="{{ $postHelper::getUriPost($relatedPost) }}">{{ $relatedPost->post_title }}</a></h4>
                                <span>{{ $relatedPost->created_at->locale(app()->getLocale())->isoFormat('LL') }}</span>
                            </article>
                        @endforeach
                    </div>
                </div>
                @endif
            </article>

            {{-- Right sidebar --}}
            <aside class="jtv-details-sidebar">
                <x-front-advertisement position="sidebar_right" />
                <h3 class="jtv-side-title jtv-side-title-plain">বিজ্ঞাপন</h3>
                <div class="jtv-promo-block jtv-promo-red">
                    <h4>দেশের খবর সবসময় জাগরনী টিভিতে</h4>
                    <a href="{{ url('/contact') }}" class="jtv-promo-btn jtv-promo-btn-red">বিজ্ঞাপন দিন</a>
                </div>
                <div class="jtv-promo-block jtv-promo-green">
                    <h4>আপনার ব্র্যান্ডকে পৌঁছে দিন লক্ষ মানুষের কাছে</h4>
                    <a href="{{ url('/contact') }}" class="jtv-promo-btn">বিজ্ঞাপন দিন →</a>
                </div>

                @if($popularPosts->count())
                <div class="jtv-side-block">
                    <h3 class="jtv-side-title">জনপ্রিয় সংবাদ</h3>
                    <div class="jtv-side-list jtv-side-list-numbered">
                        @foreach($popularPosts as $index => $popularPost)
                            <article class="jtv-side-item">
                                <span class="jtv-side-number">{{ $index + 1 }}</span>
                                <div class="jtv-side-item-body">
                                    <h4><a href="{{ $postHelper::getUriPost($popularPost) }}">{{ $popularPost->post_title }}</a></h4>
                                    <span>{{ $popularPost->created_at->locale(app()->getLocale())->isoFormat('LL') }}</span>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </div>
                @endif

            </aside>
        </div>
    </div>
</section>
@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('vendor/plyr/plyr.min.css') }}" />
@include('frontend.magz.inc._reference-header-styles')
@include('frontend.magz.inc._homepage-footer-styles')
<style>
    body.skin-magz .jtv-details-page {
        width: 100%;
        padding: 22px 0 56px;
        background: #f3f5f4;
    }

    /* Managed Ads use the same full-width content area as the details page. */
    body.skin-magz .jtv-details-page .jtv-managed-ads {
        display: flex !important;
        width: 100% !important;
        min-height: 0 !important;
        margin: 0 0 18px !important;
        padding: 10px !important;
        box-sizing: border-box !important;
        align-items: center !important;
        justify-content: center !important;
        gap: 12px !important;
        overflow: visible !important;
        border: 1px solid #dce8e1 !important;
        border-radius: 6px !important;
        background: #fff !important;
    }

    body.skin-magz .jtv-details-page .jtv-managed-ad {
        display: block !important;
        width: auto !important;
        max-width: 100% !important;
        min-height: 0 !important;
        margin: 0 !important;
        padding: 0 !important;
        overflow: visible !important;
        text-align: center !important;
    }

    body.skin-magz .jtv-details-page .jtv-managed-ad[style] {
        width: 100% !important;
        height: auto !important;
    }

    body.skin-magz .jtv-details-page .jtv-managed-ad img {
        display: block !important;
        width: 100% !important;
        max-width: 100% !important;
        height: auto !important;
        max-height: none !important;
        object-fit: contain !important;
    }

    body.skin-magz .jtv-details-page .jtv-managed-ads-article_top,
    body.skin-magz .jtv-details-page .jtv-managed-ads-article_bottom {
        display: block !important;
        width: 100% !important;
        padding: 10px !important;
    }

    body.skin-magz .jtv-details-page .jtv-managed-ads-article_top .jtv-managed-ad,
    body.skin-magz .jtv-details-page .jtv-managed-ads-article_bottom .jtv-managed-ad,
    body.skin-magz .jtv-details-page .jtv-managed-ads-article_top .jtv-managed-ad a,
    body.skin-magz .jtv-details-page .jtv-managed-ads-article_bottom .jtv-managed-ad a {
        display: block !important;
        width: 100% !important;
    }

    body.skin-magz .jtv-details-page .jtv-managed-ads-sidebar_left,
    body.skin-magz .jtv-details-page .jtv-managed-ads-sidebar_right {
        flex-direction: column !important;
        align-items: center !important;
        padding: 0 !important;
        border: 0 !important;
        background: transparent !important;
    }

    body.skin-magz .jtv-details-page .jtv-managed-ads-sidebar_left .jtv-managed-ad,
    body.skin-magz .jtv-details-page .jtv-managed-ads-sidebar_right .jtv-managed-ad {
        width: 100% !important;
    }

    body.skin-magz .jtv-details-page .jtv-managed-ads-sidebar_left img,
    body.skin-magz .jtv-details-page .jtv-managed-ads-sidebar_right img {
        width: 100% !important;
        max-height: 250px !important;
    }

    body.skin-magz .jtv-details-page .jtv-managed-ads-article_top,
    body.skin-magz .jtv-details-page .jtv-managed-ads-article_bottom {
        margin-right: 0 !important;
        margin-left: 0 !important;
    }

    body.skin-magz .jtv-details-page .jtv-managed-ads-article_top,
    body.skin-magz .jtv-details-page .jtv-managed-ads-article_bottom {
        max-width: 100% !important;
    }

    /* Same width/padding formula the reference nav, masthead and topbar
       containers resolve to (see the full-width override further down in
       the shared header partial), so this column's edges line up exactly
       under the home icon and the masthead on every viewport. */
    body.skin-magz .jtv-details-container {
        width: 100%;
        max-width: none;
        margin-left: auto;
        margin-right: auto;
        padding-left: clamp(12px, 2vw, 32px);
        padding-right: clamp(12px, 2vw, 32px);
        box-sizing: border-box;
    }

    /* The reference nav only reddens the home icon and active item when the
       menu item carries an .active class; this page never sets one, so force
       the same red treatment the homepage shows by default. */
    body.skin-magz.jtv-homepage.jtv-homepage.jtv-homepage nav.jtv-main-nav ul.nav-list > li.jtv-nav-home-link > a,
    body.skin-magz.jtv-homepage.jtv-homepage.jtv-homepage nav.jtv-main-nav ul.nav-list > li.jtv-nav-home-link:not(.active) > a {
        background: #d61f26 !important;
        color: #fff !important;
    }

    body.skin-magz.jtv-homepage.jtv-homepage.jtv-homepage nav.jtv-main-nav ul.nav-list > li:not(.jtv-nav-home-link):hover > a,
    body.skin-magz.jtv-homepage.jtv-homepage.jtv-homepage nav.jtv-main-nav ul.nav-list > li:not(.jtv-nav-home-link):focus-within > a,
    body.skin-magz.jtv-homepage.jtv-homepage.jtv-homepage nav.jtv-main-nav ul.nav-list > li:not(.jtv-nav-home-link) > a:hover,
    body.skin-magz.jtv-homepage.jtv-homepage.jtv-homepage nav.jtv-main-nav ul.nav-list > li:not(.jtv-nav-home-link).active > a,
    body.skin-magz.jtv-homepage.jtv-homepage.jtv-homepage nav.jtv-main-nav ul.nav-list > li:not(.jtv-nav-home-link).current-menu-item > a,
    body.skin-magz.jtv-homepage.jtv-homepage.jtv-homepage nav.jtv-main-nav ul.nav-list > li:not(.jtv-nav-home-link).current_page_item > a {
        color: #fff !important;
        background: #d61f26 !important;
    }

    body.skin-magz .jtv-details-breadcrumb {
        display: flex;
        flex-wrap: wrap;
        gap: 0;
        margin: 0 0 14px;
        padding: 0;
        list-style: none;
        font-size: 13px;
        color: #667a70;
    }

    body.skin-magz .jtv-details-breadcrumb li:not(:last-child)::after {
        content: '›';
        margin: 0 8px;
        color: #9fb0a8;
    }

    body.skin-magz .jtv-details-breadcrumb a {
        color: #667a70;
        text-decoration: none;
    }

    body.skin-magz .jtv-details-breadcrumb a:hover {
        color: #087342;
    }

    body.skin-magz .jtv-details-breadcrumb li.is-active {
        color: #1d2b24;
        font-weight: 600;
    }

    body.skin-magz .jtv-details-layout {
        display: grid;
        grid-template-columns: minmax(180px, 260px) minmax(0, 1fr) minmax(180px, 260px);
        gap: clamp(12px, 1.6vw, 24px);
        align-items: start;
    }

    /* Content */
    body.skin-magz .jtv-details-content {
        padding: 22px 26px 28px;
        border: 1px solid #e0e7e3;
        border-radius: 4px;
        background: #fff;
        box-shadow: 0 4px 18px rgba(20, 62, 42, .07);
    }

    body.skin-magz .jtv-details-badge {
        display: inline-block;
        margin-bottom: 14px;
        padding: 4px 12px;
        border-radius: 3px;
        color: #fff;
        background: #087342;
        font-size: 12px;
        font-weight: 700;
        text-decoration: none;
    }

    body.skin-magz .jtv-details-title {
        margin: 0 0 14px;
        color: #17231c;
        font-family: Arial, "Noto Sans Bengali", sans-serif;
        font-size: clamp(24px, 2.6vw, 34px);
        font-weight: 800;
        line-height: 1.28;
    }

    body.skin-magz .jtv-details-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 8px 20px;
        margin: 0 0 20px;
        padding: 0 0 16px;
        border-bottom: 1px solid #eef1ef;
        list-style: none;
        color: #748078;
        font-size: 13px;
    }

    body.skin-magz .jtv-details-meta i {
        margin-right: 5px;
        color: #087342;
    }

    body.skin-magz .jtv-details-figure {
        margin: 0 0 18px;
    }

    body.skin-magz .jtv-details-figure img {
        display: block;
        width: 100%;
        height: auto;
        max-height: none;
        object-fit: contain;
        border-radius: 3px;
    }

    body.skin-magz .jtv-details-figure figcaption {
        margin-top: 8px;
        color: #8a968f;
        font-size: 12px;
    }

    body.skin-magz .jtv-details-summary {
        margin: 0 0 18px;
        padding: 14px 16px;
        border-left: 4px solid #087342;
        color: #3e5147;
        font-size: 15px;
        line-height: 1.75;
        background: #eef8f1;
    }

    body.skin-magz .jtv-details-body {
        color: #34423b;
        font-size: 16px;
        line-height: 1.95;
    }

    body.skin-magz .jtv-details-body p {
        margin: 0 0 16px;
    }

    /* Editor content often carries inline borders/padding/margins; flatten them. */
    body.skin-magz .jtv-details-body *:not(img):not(iframe):not(video):not(a):not(strong):not(em):not(b):not(i):not(span) {
        max-width: 100% !important;
        margin-left: 0 !important;
        margin-right: 0 !important;
        padding: 0 !important;
        border: 0 !important;
        background: transparent !important;
        box-shadow: none !important;
        text-align: left !important;
        text-indent: 0 !important;
    }

    body.skin-magz .jtv-details-body p:empty,
    body.skin-magz .jtv-details-body div:empty {
        display: none;
    }

    body.skin-magz .jtv-details-body p {
        margin: 0 0 16px !important;
    }

    body.skin-magz .jtv-details-body img {
        max-width: 100%;
        height: auto;
        border-radius: 3px;
    }

    body.skin-magz .jtv-details-share {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 10px;
        margin: 24px 0 0;
        padding-top: 18px;
        border-top: 1px solid #eef1ef;
    }

    body.skin-magz .jtv-details-share > span {
        color: #17231c;
        font-weight: 700;
        font-size: 14px;
    }

    body.skin-magz .jtv-details-share ul {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin: 0;
        padding: 0;
        list-style: none;
    }

    body.skin-magz .jtv-details-share ul a {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 7px 14px;
        border-radius: 3px;
        color: #fff;
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
        background: #087342;
    }

    body.skin-magz .jtv-details-share ul a.facebook { background: #1877f2; }
    body.skin-magz .jtv-details-share ul a.twitter { background: #14171a; }
    body.skin-magz .jtv-details-share ul a.linkedin { background: #0a66c2; }
    body.skin-magz .jtv-details-share ul a.whatsapp { background: #25d366; }
    body.skin-magz .jtv-details-share ul a.telegram { background: #229ed9; }

    body.skin-magz .jtv-details-tags {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 9px;
        margin-top: 20px;
    }

    body.skin-magz .jtv-details-tags-label {
        color: #17231c;
        font-weight: 700;
        font-size: 13px;
    }

    body.skin-magz .jtv-details-tags-label i {
        margin-right: 4px;
        color: #087342;
    }

    body.skin-magz .jtv-details-tags a {
        padding: 5px 13px;
        border: 1px solid #dce6e0;
        border-radius: 999px;
        color: #3e5147;
        font-size: 12px;
        text-decoration: none;
        background: #f5f8f6;
    }

    body.skin-magz .jtv-details-tags a:hover {
        color: #fff;
        background: #087342;
    }

    body.skin-magz .jtv-details-related {
        margin-top: 28px;
        padding-top: 22px;
        border-top: 1px solid #eef1ef;
    }

    body.skin-magz .jtv-details-related h3 {
        margin: 0 0 16px;
        color: #17231c;
        font-size: 17px;
        font-weight: 800;
    }

    body.skin-magz .jtv-details-related h3 i {
        margin-right: 6px;
        color: #087342;
    }

    body.skin-magz .jtv-details-related-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 18px;
    }

    body.skin-magz .jtv-details-related-card figure {
        margin: 0 0 10px;
        border-radius: 4px;
        overflow: hidden;
        aspect-ratio: 4 / 3;
        background: #eef1ef;
    }

    body.skin-magz .jtv-details-related-card img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    body.skin-magz .jtv-details-related-card h4 {
        margin: 0 0 6px;
        font-size: 14px;
        line-height: 1.5;
        font-weight: 700;
    }

    body.skin-magz .jtv-details-related-card h4 a {
        color: #17231c;
        text-decoration: none;
    }

    body.skin-magz .jtv-details-related-card span {
        color: #8a968f;
        font-size: 12px;
    }

    /* Sidebars */
    body.skin-magz .jtv-details-sidebar > * {
        margin-bottom: 16px;
    }

    body.skin-magz .jtv-ad-slot {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 4px;
        padding: 40px 14px;
        border: 1px dashed #cbd6d0;
        border-radius: 4px;
        text-align: center;
        background: #fff;
        box-shadow: 0 2px 10px rgba(20, 62, 42, .06);
    }

    body.skin-magz .jtv-ad-slot-label {
        color: #d71e27;
        font-size: 16px;
        font-weight: 800;
    }

    body.skin-magz .jtv-ad-slot-size {
        color: #8a968f;
        font-size: 12px;
    }

    body.skin-magz .jtv-ad-slot-btn {
        display: inline-block;
        margin-top: 10px;
        padding: 6px 18px;
        border-radius: 3px;
        color: #fff;
        font-size: 12px;
        font-weight: 700;
        text-decoration: none;
        background: #d71e27;
    }

    body.skin-magz .jtv-side-block {
        overflow: hidden;
        border: 1px solid #dce6e0;
        border-radius: 4px;
        background: #fff;
        box-shadow: 0 2px 10px rgba(20, 62, 42, .06);
    }

    body.skin-magz .jtv-side-title {
        margin: 0;
        padding: 11px 14px;
        border-left: 4px solid #087342;
        color: #fff;
        font-size: 14px;
        font-weight: 800;
        background: #087342;
    }

    body.skin-magz .jtv-side-title-plain {
        border: none;
        border-radius: 4px 4px 0 0;
        background: #087342;
    }

    body.skin-magz .jtv-side-list {
        padding: 4px 12px;
    }

    body.skin-magz .jtv-side-item {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        padding: 12px 0;
        border-bottom: 1px solid #eef1ef;
    }

    body.skin-magz .jtv-side-item:last-child {
        border-bottom: none;
    }

    body.skin-magz .jtv-side-item figure {
        flex: none;
        width: 68px;
        height: 54px;
        margin: 0;
        overflow: hidden;
        border-radius: 3px;
        background: #eef1ef;
    }

    body.skin-magz .jtv-side-item figure img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    body.skin-magz .jtv-side-item-body h4 {
        display: -webkit-box;
        margin: 0 0 4px;
        overflow: hidden;
        color: #17231c;
        font-size: 13px;
        line-height: 1.4;
        font-weight: 700;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 2;
    }

    body.skin-magz .jtv-side-item-body h4 a {
        color: inherit;
        text-decoration: none;
    }

    body.skin-magz .jtv-side-item-body span {
        color: #8a968f;
        font-size: 11px;
    }

    body.skin-magz .jtv-side-list-numbered .jtv-side-item {
        align-items: center;
    }

    body.skin-magz .jtv-side-number {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        flex: none;
        width: 24px;
        height: 24px;
        border-radius: 50%;
        color: #087342;
        font-size: 12px;
        font-weight: 800;
        background: #eaf5ee;
    }

    body.skin-magz .jtv-side-more {
        display: block;
        padding: 11px;
        color: #087342;
        font-size: 13px;
        font-weight: 700;
        text-align: center;
        text-decoration: none;
        border-top: 1px solid #eef1ef;
    }

    body.skin-magz .jtv-promo-block {
        padding: 20px 16px;
        border-radius: 4px;
        color: #fff;
        text-align: center;
        background: #087342;
    }

    body.skin-magz .jtv-promo-block h4 {
        margin: 0 0 14px;
        font-size: 15px;
        font-weight: 800;
        line-height: 1.4;
    }

    body.skin-magz .jtv-promo-btn {
        display: inline-block;
        padding: 8px 18px;
        border-radius: 3px;
        color: #087342;
        font-size: 13px;
        font-weight: 700;
        text-decoration: none;
        background: #fff;
    }

    body.skin-magz .jtv-promo-red {
        background: #d71e27;
    }

    body.skin-magz .jtv-promo-btn-red {
        color: #d71e27;
    }

    @media (max-width: 1150px) {
        body.skin-magz .jtv-details-layout {
            grid-template-columns: minmax(160px, 220px) minmax(0, 1fr) minmax(160px, 220px);
            gap: 16px;
        }
    }

    @media (max-width: 991px) {
        body.skin-magz .jtv-details-layout {
            display: flex;
            flex-direction: column;
        }

        body.skin-magz .jtv-details-sidebar {
            width: 100%;
            display: flex;
            flex-wrap: wrap;
            gap: 16px;
        }

        body.skin-magz .jtv-details-sidebar > * {
            flex: 1 1 260px;
            margin-bottom: 0;
        }

        body.skin-magz .jtv-details-related-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 600px) {
        body.skin-magz .jtv-details-container {
            padding: 0 14px;
        }

        body.skin-magz .jtv-details-content {
            padding: 16px 16px 20px;
        }

        body.skin-magz .jtv-details-sidebar > * {
            flex: 1 1 100%;
        }

        body.skin-magz .jtv-details-related-grid {
            grid-template-columns: 1fr;
        }

        body.skin-magz .jtv-details-share {
            flex-direction: column;
            align-items: flex-start;
        }
    }

    /* Full lead image, never cropped. */
    body.skin-magz .jtv-details-page .jtv-details-figure,
    body.skin-magz .jtv-details-page .jtv-details-figure img {
        height: auto !important;
        min-height: 0 !important;
        max-height: none !important;
        aspect-ratio: auto !important;
        object-fit: contain !important;
    }

    /* Full-width body text: no floats, fixed widths or leftover boxes. */
    body.skin-magz .jtv-details-page .jtv-details-body,
    body.skin-magz .jtv-details-page .jtv-details-body > *,
    body.skin-magz .jtv-details-page .jtv-details-body div,
    body.skin-magz .jtv-details-page .jtv-details-body p,
    body.skin-magz .jtv-details-page .jtv-details-body section,
    body.skin-magz .jtv-details-page .jtv-details-body article {
        float: none !important;
        display: block !important;
        width: 100% !important;
        max-width: 100% !important;
        min-width: 0 !important;
        height: auto !important;
        min-height: 0 !important;
        columns: auto !important;
        column-count: 1 !important;
        text-align: left !important;
        text-align-last: auto !important;
    }

    body.skin-magz .jtv-details-page .jtv-details-body :is(div, p):empty {
        display: none !important;
    }

    /* Article ads: full width, whole image visible. */
    body.skin-magz .jtv-details-page .jtv-managed-ads-article_top .jtv-managed-ad,
    body.skin-magz .jtv-details-page .jtv-managed-ads-article_bottom .jtv-managed-ad {
        width: 100% !important;
        height: auto !important;
        margin: 0 auto !important;
    }

    /* Fixed banner box; the whole ad image is always visible (never cropped). A blurred copy of the
       same image fills any leftover side space so the banner still looks full width. */
    body.skin-magz .jtv-details-page .jtv-managed-ads-article_top,
    body.skin-magz .jtv-details-page .jtv-managed-ads-article_bottom { padding: 0 !important; overflow: hidden !important; }
    body.skin-magz .jtv-details-page .jtv-managed-ads-article_top .jtv-managed-ad,
    body.skin-magz .jtv-details-page .jtv-managed-ads-article_bottom .jtv-managed-ad {
        position: relative !important;
        overflow: hidden !important;
        height: clamp(80px, 13vw, 150px) !important;
    }
    body.skin-magz .jtv-details-page .jtv-managed-ads-article_top .jtv-managed-ad::before,
    body.skin-magz .jtv-details-page .jtv-managed-ads-article_bottom .jtv-managed-ad::before {
        content: '' !important;
        position: absolute !important;
        inset: -16px !important;
        background: var(--ad-bg) center / cover no-repeat !important;
        filter: blur(14px) saturate(1.1) !important;
        transform: scale(1.05) !important;
    }
    body.skin-magz .jtv-details-page .jtv-managed-ads-article_top .jtv-managed-ad a,
    body.skin-magz .jtv-details-page .jtv-managed-ads-article_bottom .jtv-managed-ad a { position: relative !important; z-index: 1 !important; height: 100% !important; }
    body.skin-magz .jtv-details-page .jtv-managed-ads-article_top img,
    body.skin-magz .jtv-details-page .jtv-managed-ads-article_bottom img {
        position: relative !important;
        z-index: 1 !important;
        width: 100% !important;
        height: 100% !important;
        max-height: none !important;
        object-fit: contain !important;
        object-position: center !important;
    }

    /* Plain text only: strip every box style from the summary and body. */
    body.skin-magz .jtv-details-page .jtv-details-content .jtv-details-body *:not(img):not(iframe):not(video),
    body.skin-magz .jtv-details-page .jtv-details-content .jtv-details-summary * {
        border: 0 !important;
        border-radius: 0 !important;
        outline: 0 !important;
        box-shadow: none !important;
        background: transparent !important;
        padding: 0 !important;
        text-indent: 0 !important;
        text-align: left !important;
        text-align-last: auto !important;
        word-spacing: normal !important;
        letter-spacing: normal !important;
        white-space: normal !important;
    }

    body.skin-magz .jtv-details-page .jtv-details-content .jtv-details-body p,
    body.skin-magz .jtv-details-page .jtv-details-content .jtv-details-summary p {
        display: block !important;
        width: 100% !important;
        margin: 0 0 14px !important;
    }

    body.skin-magz .jtv-details-page .jtv-details-content .jtv-details-summary p:last-child {
        margin-bottom: 0 !important;
    }

    body.skin-magz .jtv-details-page .jtv-details-content .jtv-details-summary {
        padding: 14px 16px !important;
        border-left: 4px solid #087342 !important;
        background: #eef8f1 !important;
    }
    body.skin-magz .jtv-details-player { margin: 0 0 18px; border-radius: 4px; overflow: hidden; }
    body.skin-magz .jtv-details-player-cover { display: block; width: 100%; height: auto; margin-bottom: 12px; }
</style>
@endpush

@push('scripts')
    <script src="{{ asset('vendor/plyr/plyr.min.js') }}"></script>
    <script>
        if (document.getElementById('player')) { new Plyr('#player'); }
    </script>
@endpush
