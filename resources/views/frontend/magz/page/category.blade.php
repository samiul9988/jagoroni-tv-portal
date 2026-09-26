@extends('frontend.magz.index')

@inject('postHelper', 'App\Helpers\PostHelper')
@inject('videoHelper', 'App\Helpers\VideoHelper')
@inject('audioHelper', 'App\Helpers\AudioHelper')

@php
    $locale = LaravelLocalization::getCurrentLocale();
    $thumb = function ($item, $size) use ($postHelper, $videoHelper, $audioHelper) {
        if (in_array($item->post_type, ['video_file', 'video_url', 'video_embed'])) {
            return $videoHelper->showThumbnail($item, (string) $size);
        }
        if ($item->post_type === 'audio') {
            return $audioHelper->showThumbnail($item, (string) $size);
        }
        return $postHelper->showThumbnail($item, $size);
    };
    $views = function ($item) {
        $n = (int) ($item->post_hits ?? 0);
        return $n >= 1000 ? number_format($n / 1000, 1) . 'ক' : number_format($n);
    };
@endphp

@push('styles')
@include('frontend.magz.inc._reference-header-styles')
@include('frontend.magz.inc._homepage-footer-styles')
<style>
    body.skin-magz .jtv-cat-page { padding: 18px 0 48px; background: #f3f5f4; }
    body.skin-magz .jtv-cat-container {
        width: 100%; box-sizing: border-box;
        padding: 0 clamp(12px, 2vw, 32px);
    }

    /* Banner */
    body.skin-magz .jtv-cat-banner {
        display: flex; align-items: center; gap: 18px;
        min-height: 110px; margin-bottom: 22px; padding: 18px 28px;
        border-radius: 8px; color: #fff; overflow: hidden; position: relative;
        background: linear-gradient(110deg, #064b29 0%, #0b6b3a 55%, #0d8552 100%);
    }
    body.skin-magz .jtv-cat-banner::after {
        content: ''; position: absolute; top: 0; right: 0; bottom: 0; width: 34%;
        background: linear-gradient(115deg, transparent 0 28%, #d61f26 28% 33%, rgba(255,255,255,.12) 33% 100%);
    }
    body.skin-magz .jtv-cat-banner-icon {
        flex: none; width: 64px; height: 64px; border: 2px solid rgba(255,255,255,.7);
        border-radius: 50%; display: flex; align-items: center; justify-content: center;
        font-size: 26px; position: relative; z-index: 1;
    }
    body.skin-magz .jtv-cat-banner-text { position: relative; z-index: 1; }
    body.skin-magz .jtv-cat-crumb { font-size: 12px; color: rgba(255,255,255,.8); }
    body.skin-magz .jtv-cat-crumb a { color: inherit; text-decoration: none; }
    body.skin-magz .jtv-cat-banner h1 { margin: 2px 0 2px; color: #fff; font-size: clamp(26px, 3vw, 36px); font-weight: 800; line-height: 1.2; }
    body.skin-magz .jtv-cat-banner p { margin: 0; font-size: 13px; color: rgba(255,255,255,.85); }

    /* Layout */
    body.skin-magz .jtv-cat-layout {
        display: grid; grid-template-columns: minmax(0, 1fr) minmax(260px, 340px);
        gap: clamp(16px, 2vw, 28px); align-items: start;
    }
    body.skin-magz .jtv-cat-heading {
        margin: 0 0 16px; padding-left: 10px; border-left: 4px solid #d61f26;
        font-size: 20px; font-weight: 800; color: #17231c; line-height: 1.2;
        display: flex; justify-content: space-between; align-items: center;
    }
    body.skin-magz .jtv-cat-heading a { font-size: 12px; font-weight: 700; color: #087342; text-decoration: none; }

    /* Lead */
    body.skin-magz .jtv-cat-lead {
        display: grid; grid-template-columns: minmax(0, 1.15fr) minmax(0, 1fr); gap: 22px;
        margin-bottom: 18px; align-items: center;
    }
    body.skin-magz .jtv-cat-lead-img { position: relative; display: block; overflow: hidden; border-radius: 6px; aspect-ratio: 16 / 10; background: #e4ebe7; }
    body.skin-magz .jtv-cat-lead-img img { width: 100%; height: 100%; object-fit: cover; display: block; }
    body.skin-magz .jtv-cat-tag {
        position: absolute; top: 10px; left: 10px; padding: 3px 10px; border-radius: 3px;
        background: #d61f26; color: #fff; font-size: 11px; font-weight: 700;
    }
    body.skin-magz .jtv-cat-lead h2 { margin: 0 0 12px; font-size: clamp(22px, 2.2vw, 30px); font-weight: 800; line-height: 1.35; }
    body.skin-magz .jtv-cat-lead h2 a, body.skin-magz .jtv-cat-card h3 a, body.skin-magz .jtv-cat-side-item h4 a { color: #17231c; text-decoration: none; }
    body.skin-magz .jtv-cat-lead h2 a:hover, body.skin-magz .jtv-cat-card h3 a:hover { color: #087342; }
    body.skin-magz .jtv-cat-meta { display: flex; flex-wrap: wrap; gap: 14px; color: #7a877f; font-size: 12px; }
    body.skin-magz .jtv-cat-meta i { margin-right: 4px; }
    body.skin-magz .jtv-cat-lead-meta { margin-bottom: 12px; }
    body.skin-magz .jtv-cat-lead p { margin: 0; color: #5a6a61; font-size: 14px; line-height: 1.7; }

    /* Cards */
    body.skin-magz .jtv-cat-cards {
        display: grid; grid-template-columns: repeat(2, minmax(0, 1fr));
        border: 1px solid #e0e7e3; border-radius: 6px; background: #fff; overflow: hidden;
    }
    body.skin-magz .jtv-cat-card {
        display: flex; gap: 14px; padding: 16px; align-items: flex-start;
        border-bottom: 1px solid #edf1ee;
    }
    body.skin-magz .jtv-cat-card:nth-child(odd) { border-right: 1px solid #edf1ee; }
    body.skin-magz .jtv-cat-card figure { flex: none; width: 118px; margin: 0; border-radius: 4px; overflow: hidden; aspect-ratio: 1 / 1; background: #e4ebe7; }
    body.skin-magz .jtv-cat-card figure img { width: 100%; height: 100%; object-fit: cover; display: block; }
    body.skin-magz .jtv-cat-card-badge {
        display: inline-block; margin-bottom: 6px; padding: 2px 8px; border-radius: 3px;
        background: #d61f26; color: #fff; font-size: 10px; font-weight: 700;
    }
    body.skin-magz .jtv-cat-card h3 {
        margin: 0 0 8px; font-size: 15px; font-weight: 800; line-height: 1.45;
        display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;
    }
    body.skin-magz .jtv-cat-pagination { margin-top: 22px; display: flex; justify-content: center; }
    body.skin-magz .jtv-cat-empty { padding: 40px; text-align: center; background: #fff; border-radius: 6px; color: #667a70; }

    /* Sidebar */
    body.skin-magz .jtv-cat-side > * { margin-bottom: 16px; }
    body.skin-magz .jtv-cat-box { border: 1px solid #dce6e0; border-radius: 6px; background: #fff; overflow: hidden; }
    body.skin-magz .jtv-cat-box-title {
        display: flex; justify-content: space-between; align-items: center;
        margin: 0; padding: 11px 14px; background: #087342; color: #fff; font-size: 15px; font-weight: 800;
    }
    body.skin-magz .jtv-cat-box-title a { color: rgba(255,255,255,.85); font-size: 11px; text-decoration: none; }
    body.skin-magz .jtv-cat-side-list { padding: 4px 14px; }
    body.skin-magz .jtv-cat-side-item { display: flex; gap: 10px; padding: 11px 0; border-bottom: 1px solid #eef1ef; align-items: flex-start; }
    body.skin-magz .jtv-cat-side-item:last-child { border-bottom: 0; }
    body.skin-magz .jtv-cat-side-item figure { flex: none; width: 70px; height: 54px; margin: 0; border-radius: 3px; overflow: hidden; background: #e4ebe7; }
    body.skin-magz .jtv-cat-side-item figure img { width: 100%; height: 100%; object-fit: cover; display: block; }
    body.skin-magz .jtv-cat-side-item h4 { margin: 0 0 4px; font-size: 13px; font-weight: 700; line-height: 1.4; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
    body.skin-magz .jtv-cat-side-item time { font-size: 11px; color: #8a968f; }

    body.skin-magz .jtv-cat-cta {
        padding: 22px 18px; border-radius: 6px; color: #fff; text-align: center;
        background: linear-gradient(120deg, #0b6b3a, #0d8552 60%, #d61f26 60%);
    }
    body.skin-magz .jtv-cat-cta h4 { margin: 0 0 12px; font-size: 20px; font-weight: 800; color: #fff; }
    body.skin-magz .jtv-cat-cta a { display: inline-block; padding: 7px 18px; border-radius: 3px; background: #f5b41a; color: #17231c; font-size: 13px; font-weight: 800; text-decoration: none; }

    body.skin-magz .jtv-cat-news { padding: 16px; }
    body.skin-magz .jtv-cat-news h4 { margin: 0 0 4px; font-size: 16px; font-weight: 800; color: #17231c; }
    body.skin-magz .jtv-cat-news p { margin: 0 0 12px; font-size: 12px; color: #6a7a71; }
    body.skin-magz .jtv-cat-news form { display: flex; }
    body.skin-magz .jtv-cat-news input { flex: 1; min-width: 0; padding: 8px 10px; border: 1px solid #dce6e0; border-radius: 3px 0 0 3px; font-size: 12px; }
    body.skin-magz .jtv-cat-news button { padding: 8px 14px; border: 0; border-radius: 0 3px 3px 0; background: #087342; color: #fff; font-size: 12px; font-weight: 700; }

    @media (max-width: 991px) {
        body.skin-magz .jtv-cat-layout { grid-template-columns: 1fr; }
        body.skin-magz .jtv-cat-lead { grid-template-columns: minmax(0, 1fr); }
    }
    @media (max-width: 640px) {
        body.skin-magz .jtv-cat-banner { padding: 16px; }
        body.skin-magz .jtv-cat-banner::after { display: none; }
        body.skin-magz .jtv-cat-cards { grid-template-columns: 1fr; }
        body.skin-magz .jtv-cat-card:nth-child(odd) { border-right: 0; }
        body.skin-magz .jtv-cat-card figure { width: 96px; }
    }

    /* Nav: same red home icon, active and hover states as the home page. */
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

    /* Lead: text column fills the image height, top to bottom. */
    body.skin-magz .jtv-cat-lead { align-items: stretch; }
    body.skin-magz .jtv-cat-lead-body {
        display: flex; flex-direction: column; justify-content: space-between;
        padding: 20px 22px; border: 1px solid #e0e7e3; border-radius: 6px; background: #fff;
    }
    body.skin-magz .jtv-cat-lead-img { aspect-ratio: auto; min-height: 260px; height: 100%; }
    body.skin-magz .jtv-cat-lead-img img { position: absolute; inset: 0; }

    /* Cards: fixed-ratio thumbnail, text fills the card height. */
    body.skin-magz .jtv-cat-card { display: grid; grid-template-columns: 130px minmax(0, 1fr); align-items: stretch; }
    body.skin-magz .jtv-cat-card figure { width: 130px; height: auto; aspect-ratio: 4 / 3; align-self: start; }
    body.skin-magz .jtv-cat-card figure a { display: block; width: 100%; height: 100%; }
    body.skin-magz .jtv-cat-card figure img { width: 100% !important; height: 100% !important; max-width: none; object-fit: cover; }
    body.skin-magz .jtv-cat-card-body { display: flex; flex-direction: column; justify-content: space-between; gap: 8px; }
    body.skin-magz .jtv-cat-card-body h3 { margin: 0; }
    body.skin-magz .jtv-cat-card-body .jtv-cat-card-badge { align-self: flex-start; margin: 0; }
    @media (max-width: 640px) {
        body.skin-magz .jtv-cat-card { grid-template-columns: 104px minmax(0, 1fr); }
        body.skin-magz .jtv-cat-card figure { width: 104px; }
    }

    /* Larger lead image + fuller text, larger cards with excerpt. */
    body.skin-magz .jtv-cat-lead { grid-template-columns: minmax(0, 1.5fr) minmax(0, 1fr); }
    body.skin-magz .jtv-cat-lead-img { min-height: 380px; }
    body.skin-magz .jtv-cat-lead-body h2 { font-size: clamp(20px, 2vw, 28px); }
    body.skin-magz .jtv-cat-lead-body p { font-size: 15px; line-height: 1.8; display: -webkit-box; -webkit-line-clamp: 9; -webkit-box-orient: vertical; overflow: hidden; }
    body.skin-magz .jtv-cat-card { grid-template-columns: 210px minmax(0, 1fr); gap: 16px; padding: 18px; }
    body.skin-magz .jtv-cat-card figure { width: 210px; aspect-ratio: 4 / 3; }
    body.skin-magz .jtv-cat-card-body { justify-content: flex-start; gap: 8px; }
    body.skin-magz .jtv-cat-card-body h3 { font-size: 17px; }
    body.skin-magz .jtv-cat-card-excerpt { margin: 0; color: #5a6a61; font-size: 13px; line-height: 1.65; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; }
    body.skin-magz .jtv-cat-card-body .jtv-cat-meta { margin-top: auto; }
    @media (max-width: 1199px) { body.skin-magz .jtv-cat-card { grid-template-columns: 150px minmax(0, 1fr); } body.skin-magz .jtv-cat-card figure { width: 150px; } }
    @media (max-width: 991px) { body.skin-magz .jtv-cat-lead-img { min-height: 0; aspect-ratio: 16 / 10; height: auto; } }
    @media (max-width: 640px) { body.skin-magz .jtv-cat-card { grid-template-columns: 110px minmax(0, 1fr); gap: 12px; padding: 14px; } body.skin-magz .jtv-cat-card figure { width: 110px; } body.skin-magz .jtv-cat-card-body h3 { font-size: 15px; } }

    /* See more */
    body.skin-magz .jtv-cat-lead-body { justify-content: flex-start; gap: 12px; }
    body.skin-magz .jtv-cat-lead-body .jtv-cat-lead-excerpt { -webkit-line-clamp: 7; margin: 0; }
    body.skin-magz .jtv-cat-lead-body .jtv-cat-lead-excerpt.is-open { display: block !important; -webkit-line-clamp: unset !important; overflow: visible !important; }
    body.skin-magz .jtv-cat-more {
        display: inline-flex; align-items: center; gap: 8px; margin-top: 10px; padding: 8px 18px;
        border: 1px solid #087342; border-radius: 999px; background: #fff; color: #087342;
        font-size: 13px; font-weight: 700; cursor: pointer; transition: all .2s;
    }
    body.skin-magz .jtv-cat-more:hover { background: #087342; color: #fff; box-shadow: 0 4px 12px rgba(8, 115, 66, .25); }
    body.skin-magz .jtv-cat-more i { font-size: 11px; transition: transform .25s; }
    body.skin-magz .jtv-cat-more[aria-expanded="true"] i { transform: rotate(180deg); }

    /* Pagination */
    body.skin-magz .jtv-pg { margin-top: 26px; text-align: center; }
    body.skin-magz .jtv-pg-list { display: flex; flex-wrap: wrap; justify-content: center; gap: 8px; margin: 0; padding: 0; list-style: none; }
    body.skin-magz .jtv-pg-btn {
        display: inline-flex; align-items: center; justify-content: center; min-width: 40px; height: 40px; padding: 0 12px;
        border: 1px solid #dce6e0; border-radius: 8px; background: #fff; color: #17231c;
        font-size: 14px; font-weight: 700; line-height: 1; text-decoration: none; box-sizing: border-box; transition: all .2s;
    }
    body.skin-magz a.jtv-pg-btn:hover { border-color: #087342; color: #087342; transform: translateY(-1px); box-shadow: 0 4px 10px rgba(8, 115, 66, .15); }
    body.skin-magz .jtv-pg-btn.is-active { border-color: #087342; background: #087342; color: #fff; box-shadow: 0 4px 12px rgba(8, 115, 66, .3); }
    body.skin-magz .jtv-pg-btn.is-disabled { opacity: .45; cursor: not-allowed; background: #f3f5f4; }
    body.skin-magz .jtv-pg-btn.is-dots { border-color: transparent; background: transparent; }
    body.skin-magz .jtv-pg-btn i { font-size: 12px; }
    body.skin-magz .jtv-pg-info { margin-top: 12px; color: #7a877f; font-size: 12px; }
    @media (max-width: 480px) {
        body.skin-magz .jtv-pg-list { gap: 5px; }
        body.skin-magz .jtv-pg-btn { min-width: 34px; height: 34px; padding: 0 8px; font-size: 13px; }
    }

    /* Image keeps a fixed ratio; expanding the text never stretches it. */
    body.skin-magz .jtv-cat-lead-img { min-height: 0 !important; height: auto !important; aspect-ratio: 16 / 10 !important; align-self: start; }
    body.skin-magz .jtv-cat-lead-body { align-self: stretch; }
    body.skin-magz .jtv-cat-lead.is-open { align-items: start; }
    body.skin-magz .jtv-cat-lead.is-open .jtv-cat-lead-body { align-self: start; }
    @media (max-width: 991px) { body.skin-magz .jtv-cat-lead-img { align-self: auto; } }
    @media (max-width: 991px) {
        body.skin-magz .jtv-cat-layout, body.skin-magz .jtv-cat-lead { grid-template-columns: minmax(0, 1fr); }
    }
</style>
@endpush

@section('content')
<section class="jtv-cat-page">
    <div class="jtv-cat-container">
        @if($category)
            <div class="jtv-cat-banner">
                <span class="jtv-cat-banner-icon"><i class="fa-solid fa-landmark"></i></span>
                <div class="jtv-cat-banner-text">
                    <div class="jtv-cat-crumb"><a href="{{ url('/') }}">{{ __('jagoronitv::magz.home') }}</a> &rsaquo; {{ $category->name }}</div>
                    <h1>{{ $category->name }}</h1>
                    <p>{{ $category->description ? \Illuminate\Support\Str::limit(strip_tags($category->description), 120) : $category->name . ' সম্পর্কিত সর্বশেষ খবর ও আপডেট' }}</p>
                </div>
            </div>

            <div class="jtv-cat-layout">
                <div class="jtv-cat-main">
                    <h2 class="jtv-cat-heading">{{ $category->name }} সম্পর্কিত সর্বশেষ খবর</h2>

                    @if($posts && $posts->count())
                        @php $leadPost = $posts->first(); @endphp
                        <article class="jtv-cat-lead" id="jtvLead">
                            <a class="jtv-cat-lead-img" href="{{ $postHelper->getUriPost($leadPost) }}">
                                <img src="{{ $thumb($leadPost, 700) }}" alt="{{ $leadPost->post_title }}">
                                <span class="jtv-cat-tag">{{ $category->name }}</span>
                            </a>
                            <div class="jtv-cat-lead-body">
                                <h2><a href="{{ $postHelper->getUriPost($leadPost) }}">{{ $leadPost->post_title }}</a></h2>
                                <div class="jtv-cat-meta jtv-cat-lead-meta">
                                    <span><i class="fa-regular fa-calendar"></i>{{ $leadPost->created_at->locale($locale)->isoFormat('LL') }}</span>
                                    <span><i class="fa-regular fa-eye"></i>{{ $views($leadPost) }}</span>
                                </div>
                                @php $leadText = trim(html_entity_decode(strip_tags($leadPost->post_content), ENT_QUOTES | ENT_HTML5, 'UTF-8')); @endphp
                                <div class="jtv-cat-lead-text">
                                    <p class="jtv-cat-lead-excerpt" id="jtvLeadText">{{ $leadText }}</p>
                                    <button type="button" class="jtv-cat-more" id="jtvLeadMore" aria-expanded="false" hidden>
                                        <span>আরও দেখুন</span> <i class="fa-solid fa-chevron-down"></i>
                                    </button>
                                </div>
                            </div>
                        </article>

                        @if($posts->count() > 1)
                        <div class="jtv-cat-cards">
                            @foreach($posts->skip(1) as $item)
                                <article class="jtv-cat-card">
                                    <figure><a href="{{ $postHelper->getUriPost($item) }}"><img src="{{ $thumb($item, 300) }}" alt="{{ $item->post_title }}" loading="lazy"></a></figure>
                                    <div class="jtv-cat-card-body">
                                        <span class="jtv-cat-card-badge">{{ $category->name }}</span>
                                        <h3><a href="{{ $postHelper->getUriPost($item) }}">{{ $item->post_title }}</a></h3>
                                        <p class="jtv-cat-card-excerpt">{{ \Illuminate\Support\Str::limit(html_entity_decode(strip_tags($item->post_content), ENT_QUOTES | ENT_HTML5, 'UTF-8'), 130) }}</p>
                                        <div class="jtv-cat-meta">
                                            <span><i class="fa-regular fa-calendar"></i>{{ $item->created_at->locale($locale)->isoFormat('LL') }}</span>
                                            <span><i class="fa-regular fa-eye"></i>{{ $views($item) }}</span>
                                        </div>
                                    </div>
                                </article>
                            @endforeach
                        </div>
                        @endif

                        <div class="jtv-cat-pagination">{{ $posts->links('frontend.magz.inc._category-pagination') }}</div>
                    @else
                        <div class="jtv-cat-empty">এই ক্যাটাগরিতে এখনও কোনো খবর নেই।</div>
                    @endif
                </div>

                <aside class="jtv-cat-side">
                    @if($latestPosts->count())
                    <div class="jtv-cat-box">
                        <h3 class="jtv-cat-box-title">সর্বশেষ সংবাদ <a href="{{ route('articles.latest') }}">সব খবর দেখুন →</a></h3>
                        <div class="jtv-cat-side-list">
                            @foreach($latestPosts as $item)
                                <article class="jtv-cat-side-item">
                                    <figure><a href="{{ $postHelper->getUriPost($item) }}"><img src="{{ $thumb($item, 100) }}" alt="{{ $item->post_title }}" loading="lazy"></a></figure>
                                    <div>
                                        <h4><a href="{{ $postHelper->getUriPost($item) }}">{{ $item->post_title }}</a></h4>
                                        <time>{{ $item->created_at->locale($locale)->isoFormat('LL') }}</time>
                                    </div>
                                </article>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <x-front-advertisement position="sidebar_right" />
                    <div class="jtv-cat-cta">
                        <h4>আপনার বিজ্ঞাপন এখানে দিন</h4>
                        <a href="{{ url('/contact') }}">বিজ্ঞাপন দিন →</a>
                    </div>

                    {{-- <div class="jtv-cat-box jtv-cat-news">
                        <h4>নিউজলেটার</h4>
                        <p>আপনার ইমেইল দিয়ে নতুন খবর পেতে সাবস্ক্রাইব করুন</p>
                        <form action="{{ url('/contact') }}" method="get">
                            <input type="email" name="email" placeholder="আপনার ইমেইল লিখুন">
                            <button type="submit">সাবস্ক্রাইব</button>
                        </form>
                    </div> --}}

                    @if($mostReadPosts->count())
                    <div class="jtv-cat-box">
                        <h3 class="jtv-cat-box-title">জনপ্রিয় সংবাদ</h3>
                        <div class="jtv-cat-side-list">
                            @foreach($mostReadPosts as $item)
                                <article class="jtv-cat-side-item">
                                    <figure><a href="{{ $postHelper->getUriPost($item) }}"><img src="{{ $thumb($item, 100) }}" alt="{{ $item->post_title }}" loading="lazy"></a></figure>
                                    <div>
                                        <h4><a href="{{ $postHelper->getUriPost($item) }}">{{ $item->post_title }}</a></h4>
                                        <time>{{ $item->created_at->locale($locale)->isoFormat('LL') }}</time>
                                    </div>
                                </article>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </aside>
            </div>
        @else
            <div class="jtv-cat-empty">ক্যাটাগরি পাওয়া যায়নি।</div>
        @endif
    </div>
</section>
@endsection

@push('scripts')
<script>
    (function () {
        var lead = document.getElementById('jtvLead');
        var text = document.getElementById('jtvLeadText');
        var btn = document.getElementById('jtvLeadMore');
        if (!lead || !text || !btn) return;
        var body = lead.querySelector('.jtv-cat-lead-body');
        var img = lead.querySelector('.jtv-cat-lead-img');
        var wrap = text.parentElement;

        // Fit as many lines as the image height allows, so the box is filled without a gap.
        function fit() {
            if (lead.classList.contains('is-open')) return;
            var stacked = window.getComputedStyle(lead).gridTemplateColumns.split(' ').length < 2;
            btn.hidden = false;
            if (stacked) { text.style.webkitLineClamp = '5'; }
            else {
                var cs = getComputedStyle(body);
                var inner = img.offsetHeight - parseFloat(cs.paddingTop) - parseFloat(cs.paddingBottom) - 2;
                var gap = parseFloat(cs.rowGap) || 0;
                var others = 0, count = 0;
                Array.prototype.forEach.call(body.children, function (c) {
                    if (c === wrap) return;
                    others += c.offsetHeight; count++;
                });
                var btnH = btn.offsetHeight + parseFloat(getComputedStyle(btn).marginTop);
                var avail = inner - others - count * gap - btnH;
                var lh = parseFloat(getComputedStyle(text).lineHeight) || 24;
                text.style.webkitLineClamp = String(Math.max(3, Math.floor(avail / lh)));
            }
            btn.hidden = !(text.scrollHeight > text.clientHeight + 2);
        }

        fit();
        window.addEventListener('load', fit);
        window.addEventListener('resize', fit);

        btn.addEventListener('click', function () {
            var open = text.classList.toggle('is-open');
            lead.classList.toggle('is-open', open);
            btn.setAttribute('aria-expanded', open ? 'true' : 'false');
            btn.querySelector('span').textContent = open ? 'কম দেখুন' : 'আরও দেখুন';
            if (!open) { fit(); }
        });
    })();
</script>
@endpush
