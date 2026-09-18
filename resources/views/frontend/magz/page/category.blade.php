@extends('frontend.magz.index')

@inject('postHelper', 'App\Helpers\PostHelper')
@inject('videoHelper', 'App\Helpers\VideoHelper')
@inject('audioHelper', 'App\Helpers\AudioHelper')
@inject('themeHelper', 'App\Helpers\ThemeHelper')

@push('styles')
<style>
    body.skin-magz section.jtv-category-page {
        box-sizing: border-box !important;
        padding: 20px 0 56px !important;
        background: #f4f7f5 !important;
        font-family: "Lato", Arial, sans-serif !important;
    }

    body.skin-magz section.jtv-category-page .jtv-category-container {
        width: min(1240px, calc(100% - 48px)) !important;
        max-width: 1240px !important;
        margin: 0 auto !important;
    }

    body.skin-magz section.jtv-category-page > .jtv-category-container > .row {
        align-items: flex-start !important;
        margin-right: -12px !important;
        margin-left: -12px !important;
        row-gap: 24px !important;
    }

    body.skin-magz section.jtv-category-page .jtv-category-header {
        display: flex !important;
        min-height: 124px !important;
        align-items: center !important;
        justify-content: space-between !important;
        gap: 20px !important;
        margin: 0 0 20px !important;
        padding: 22px 26px !important;
        border-radius: 16px !important;
        background: linear-gradient(120deg, #064b29, #0d8552 70%, #16a86d) !important;
        box-shadow: 0 10px 24px rgba(7, 83, 45, .14) !important;
    }

    body.skin-magz section.jtv-category-page .jtv-category-header > div {
        min-width: 0 !important;
    }

    body.skin-magz section.jtv-category-page .jtv-category-breadcrumb {
        display: block !important;
        margin: 0 0 7px !important;
        color: rgba(255, 255, 255, .78) !important;
        font-family: "Lato", Arial, sans-serif !important;
        font-size: 11px !important;
    }

    body.skin-magz section.jtv-category-page .jtv-category-eyebrow {
        display: block !important;
        margin: 0 0 4px !important;
        color: #f7dfaa !important;
        font-family: "Lato", Arial, sans-serif !important;
        font-size: 10px !important;
        font-weight: 800 !important;
        letter-spacing: 1.5px !important;
        text-transform: uppercase !important;
    }

    body.skin-magz section.jtv-category-page .jtv-category-header h1 {
        margin: 0 !important;
        color: #fff !important;
        font-family: "Noto Sans Bengali", "Lato", Arial, sans-serif !important;
        font-size: clamp(25px, 3vw, 38px) !important;
        line-height: 1.15 !important;
    }

    body.skin-magz section.jtv-category-page .jtv-category-header p {
        margin: 7px 0 0 !important;
        color: rgba(255, 255, 255, .78) !important;
        font-family: "Lato", Arial, sans-serif !important;
        font-size: 12px !important;
        line-height: 1.45 !important;
    }

    body.skin-magz section.jtv-category-page .jtv-category-header p strong {
        color: #f7dfaa !important;
    }

    body.skin-magz section.jtv-category-page .jtv-category-header-icon {
        display: grid !important;
        width: 56px !important;
        height: 56px !important;
        flex: 0 0 56px !important;
        place-items: center !important;
        border: 1px solid rgba(247, 223, 170, .5) !important;
        border-radius: 15px 6px 15px 6px !important;
        color: #f7dfaa !important;
        font-size: 22px !important;
        background: rgba(0, 35, 20, .2) !important;
        transform: rotate(5deg) !important;
    }

    body.skin-magz section.jtv-category-page .jtv-category-lead {
        display: grid !important;
        grid-template-columns: minmax(0, 1.12fr) minmax(250px, .88fr) !important;
        width: 100% !important;
        min-width: 0 !important;
        margin: 0 0 22px !important;
        border: 1px solid #dfe9e3 !important;
        border-radius: 16px !important;
        background: #fff !important;
        box-shadow: 0 8px 22px rgba(11, 64, 37, .08) !important;
        overflow: hidden !important;
    }

    body.skin-magz section.jtv-category-page .jtv-category-lead-image {
        display: block !important;
        position: relative !important;
        min-height: 320px !important;
        overflow: hidden !important;
    }

    body.skin-magz section.jtv-category-page .jtv-category-lead-image img {
        position: absolute !important;
        inset: 0 !important;
        width: 100% !important;
        height: 100% !important;
        object-fit: cover !important;
    }

    body.skin-magz section.jtv-category-page .jtv-category-cards {
        display: grid !important;
        grid-template-columns: repeat(2, minmax(0, 1fr)) !important;
        gap: 18px !important;
        width: 100% !important;
    }

    body.skin-magz section.jtv-category-page .jtv-category-card {
        display: block !important;
        min-width: 0 !important;
        overflow: hidden !important;
        border: 1px solid #dfe9e3 !important;
        border-radius: 14px !important;
        background: #fff !important;
    }

    body.skin-magz section.jtv-category-page .jtv-category-card-image {
        display: block !important;
        position: relative !important;
        height: 178px !important;
        overflow: hidden !important;
    }

    body.skin-magz section.jtv-category-page .jtv-category-card-image img {
        width: 100% !important;
        height: 100% !important;
        object-fit: cover !important;
    }

    body.skin-magz section.jtv-category-page .jtv-category-card-content {
        padding: 14px 16px 16px !important;
    }

    body.skin-magz section.jtv-category-page .jtv-category-card-content h3 {
        min-height: 44px !important;
        margin: 0 0 9px !important;
        color: #123f29 !important;
        font-family: "Merriweather", Georgia, serif !important;
        font-size: 17px !important;
        line-height: 1.4 !important;
    }

    body.skin-magz section.jtv-category-page .jtv-category-lead-content {
        min-width: 0 !important;
        align-self: center !important;
        padding: 26px !important;
    }

    body.skin-magz section.jtv-category-page .jtv-category-lead-content h2 {
        margin: 0 0 10px !important;
        color: #123f29 !important;
        font-family: "Noto Sans Bengali", "Merriweather", Georgia, serif !important;
        font-size: clamp(22px, 2.4vw, 31px) !important;
        line-height: 1.35 !important;
    }

    body.skin-magz section.jtv-category-page .jtv-category-lead-content h2 a {
        color: #123f29 !important;
    }

    body.skin-magz section.jtv-category-page .jtv-category-card-content p,
    body.skin-magz section.jtv-category-page .jtv-category-lead-content p {
        color: #64736a !important;
        font-family: "Lato", Arial, sans-serif !important;
        font-size: 12px !important;
        line-height: 1.65 !important;
    }

    body.skin-magz section.jtv-category-page .jtv-category-meta {
        display: flex !important;
        flex-wrap: wrap !important;
        gap: 8px !important;
        align-items: center !important;
        color: #829087 !important;
        font-family: "Lato", Arial, sans-serif !important;
        font-size: 10px !important;
    }

    body.skin-magz section.jtv-category-page .jtv-category-meta span {
        color: #08703b !important;
        font-weight: 800 !important;
    }

    body.skin-magz section.jtv-category-page .jtv-category-section-title {
        display: flex !important;
        align-items: center !important;
        gap: 12px !important;
        margin: 0 0 14px !important;
        color: #173d29 !important;
        font-family: "Lato", Arial, sans-serif !important;
        font-size: 15px !important;
        font-weight: 800 !important;
        text-transform: uppercase !important;
    }

    body.skin-magz section.jtv-category-page .jtv-category-section-title i {
        height: 2px !important;
        flex: 1 1 auto !important;
        background: linear-gradient(90deg, #0b6b3a, transparent) !important;
    }

    body.skin-magz section.jtv-category-page .jtv-category-pagination {
        display: block !important;
        clear: both !important;
        width: 100% !important;
        margin: 34px 0 0 !important;
        padding: 0 0 18px !important;
        text-align: center !important;
    }

    body.skin-magz section.jtv-category-page .jtv-category-pagination .pagination {
        display: flex !important;
        min-height: 38px !important;
        align-items: center !important;
        justify-content: center !important;
        margin: 0 0 13px !important;
        padding: 0 !important;
    }

    body.skin-magz section.jtv-category-page .jtv-category-pagination .pagination-help-text {
        display: block !important;
        margin: 0 !important;
        color: #6b786f !important;
        font-family: "Lato", Arial, sans-serif !important;
        font-size: 11px !important;
        line-height: 1.4 !important;
    }

    @media (max-width: 991px) {
        body.skin-magz section.jtv-category-page {
            padding-top: 18px !important;
        }

        body.skin-magz section.jtv-category-page .jtv-category-lead {
            grid-template-columns: 1fr !important;
        }

        body.skin-magz section.jtv-category-page .jtv-category-lead-image {
            min-height: 290px !important;
        }
    }

    @media (max-width: 600px) {
        body.skin-magz section.jtv-category-page {
            padding: 14px 0 40px !important;
        }

        body.skin-magz section.jtv-category-page .jtv-category-container {
            width: calc(100% - 24px) !important;
        }

        body.skin-magz section.jtv-category-page > .jtv-category-container > .row {
            margin-right: -6px !important;
            margin-left: -6px !important;
        }

        body.skin-magz section.jtv-category-page .jtv-category-header {
            min-height: 108px !important;
            gap: 10px !important;
            margin-bottom: 16px !important;
            padding: 17px 16px !important;
            border-radius: 13px !important;
        }

        body.skin-magz section.jtv-category-page .jtv-category-header h1 {
            font-size: 25px !important;
        }

        body.skin-magz section.jtv-category-page .jtv-category-header p {
            font-size: 11px !important;
        }

        body.skin-magz section.jtv-category-page .jtv-category-header-icon {
            width: 42px !important;
            height: 42px !important;
            flex-basis: 42px !important;
            font-size: 17px !important;
        }

        body.skin-magz section.jtv-category-page .jtv-category-lead-content {
            padding: 20px 17px 22px !important;
        }

        body.skin-magz section.jtv-category-page .jtv-category-lead-image {
            min-height: 220px !important;
        }

        body.skin-magz section.jtv-category-page .jtv-category-pagination {
            margin-top: 26px !important;
            padding-bottom: 8px !important;
        }

        body.skin-magz section.jtv-category-page .jtv-category-cards {
            grid-template-columns: 1fr !important;
            gap: 14px !important;
        }

        body.skin-magz section.jtv-category-page .jtv-category-card-image {
            height: 205px !important;
        }
    }

    /* Keep category pages aligned with the homepage container. */
    body.skin-magz section.jtv-category-page .jtv-category-container {
        width: min(1280px, calc(100% - 40px)) !important;
        max-width: 1280px !important;
    }

    body.skin-magz section.jtv-category-page .jtv-category-news-panel {
        margin-bottom: 22px !important;
        padding: 0 14px 14px !important;
        border: 1px solid #dfe9e3 !important;
        border-radius: 12px !important;
        background: #fff !important;
        box-shadow: 0 8px 20px rgba(11, 64, 37, .06) !important;
    }

    body.skin-magz section.jtv-category-page .jtv-category-news-tabs {
        display: grid !important;
        grid-template-columns: 1fr 1fr !important;
        margin: 0 -14px 10px !important;
        border-bottom: 1px solid #dfe9e3 !important;
    }

    body.skin-magz section.jtv-category-page .jtv-category-news-tabs button {
        padding: 12px 8px !important;
        border: 0 !important;
        border-bottom: 2px solid transparent !important;
        color: #66736c !important;
        background: transparent !important;
        font-family: "Noto Sans Bengali", "Lato", Arial, sans-serif !important;
        font-size: 13px !important;
        font-weight: 800 !important;
        cursor: pointer !important;
    }

    body.skin-magz section.jtv-category-page .jtv-category-news-tabs button.is-active {
        border-bottom-color: #0b6b3a !important;
        color: #08703b !important;
    }

    body.skin-magz section.jtv-category-page .jtv-category-news-list {
        display: none !important;
    }

    body.skin-magz section.jtv-category-page .jtv-category-news-list.is-active {
        display: block !important;
    }

    body.skin-magz section.jtv-category-page .jtv-category-news-item {
        margin: 0 !important;
        padding: 9px 0 !important;
        border-bottom: 1px solid #e5ece7 !important;
    }

    body.skin-magz section.jtv-category-page .jtv-category-news-item:last-child {
        border-bottom: 0 !important;
    }

    body.skin-magz section.jtv-category-page .jtv-category-news-item a {
        display: grid !important;
        grid-template-columns: 74px minmax(0, 1fr) !important;
        gap: 10px !important;
        align-items: center !important;
        color: #183f2b !important;
        text-decoration: none !important;
    }

    body.skin-magz section.jtv-category-page .jtv-category-news-item img {
        width: 74px !important;
        height: 54px !important;
        border-radius: 5px !important;
        object-fit: cover !important;
    }

    body.skin-magz section.jtv-category-page .jtv-category-news-item span {
        display: -webkit-box !important;
        overflow: hidden !important;
        color: #183f2b !important;
        font-family: "Noto Sans Bengali", "Lato", Arial, sans-serif !important;
        font-size: 12px !important;
        font-weight: 700 !important;
        line-height: 1.45 !important;
        -webkit-box-orient: vertical !important;
        -webkit-line-clamp: 2 !important;
    }

    body.skin-magz section.jtv-category-page .sidebar > aside:first-of-type {
        display: none !important;
    }

    @media (max-width: 991px) {
        body.skin-magz section.jtv-category-page .jtv-category-container {
            width: min(960px, calc(100% - 32px)) !important;
        }

        body.skin-magz section.jtv-category-page .sidebar {
            margin-top: 4px !important;
        }
    }

    @media (max-width: 600px) {
        body.skin-magz section.jtv-category-page .jtv-category-container {
            width: calc(100% - 24px) !important;
        }
    }
</style>
@endpush

@section('content')
<section class="category top jtv-category-page">
    <div class="container-md jtv-category-container">
        <div class="row">
            @if($sidebarPosition === "left" && $sidebarActive)
                @php $categorySidebarMode = true; @endphp
                @include('frontend.magz.template-parts.sidebar')
            @endif
            <div class="col-lg-8 text-left @if($sidebarActive === false) offset-lg-2 @endif">
                @if($category)
                    <div class="jtv-category-header">
                        <div>
                            <a class="jtv-category-breadcrumb" href="/">{{ __('jagoronitv::magz.home') }} <i class="fas fa-chevron-right"></i></a>
                            <span class="jtv-category-eyebrow">{{ __('jagoronitv::magz.category') }}</span>
                            <h1>{{ $category->name }}</h1>
                            <p>{{ __('jagoronitv::magz.category_description') }} <strong>{{ $category->name }}</strong></p>
                        </div>
                        <span class="jtv-category-header-icon"><i class="fas fa-newspaper"></i></span>
                    </div>
                @endif

                @if($posts && $posts->count())
                    @php $leadPost = $posts->first(); @endphp
                    <article class="jtv-category-lead">
                        <a class="jtv-category-lead-image" href="{{ $postHelper->getUriPost($leadPost) }}">
                            @if(in_array($leadPost->post_type, ['video_file', 'video_url', 'video_embed']))
                                <img src="{{ $videoHelper->showThumbnail($leadPost, '700') }}" alt="{{ $leadPost->post_image }}">
                                <span class="jtv-category-media-badge"><i class="fas fa-play"></i> Video</span>
                            @elseif($leadPost->post_type === 'audio')
                                <img src="{{ $audioHelper->showThumbnail($leadPost, '700') }}" alt="{{ $leadPost->post_image }}">
                                <span class="jtv-category-media-badge"><i class="fas fa-music"></i> Audio</span>
                            @else
                                <img src="{{ $postHelper->showThumbnail($leadPost, 700) }}" alt="{{ $leadPost->post_image }}">
                            @endif
                            <span class="jtv-category-lead-tag">Featured story</span>
                        </a>
                        <div class="jtv-category-lead-content">
                            <div class="jtv-category-meta"><span>{{ $category->name }}</span><time>{{ $leadPost->created_at->locale(LaravelLocalization::getCurrentLocale())->diffForHumans() }}</time></div>
                            <h2><a href="{{ $postHelper->getUriPost($leadPost) }}">{{ $leadPost->post_title }}</a></h2>
                            <p>{{ \Str::limit(strip_tags($leadPost->post_content), 180) }}</p>
                            <a class="jtv-category-read-more" href="{{ $postHelper->getUriPost($leadPost) }}">Read story <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </article>

                    <div class="jtv-category-section-title"><span>Latest in {{ $category->name }}</span><i></i></div>
                    <div class="jtv-category-cards">
                        @foreach($posts->skip(1) as $post)
                            <article class="jtv-category-card">
                                <a class="jtv-category-card-image" href="{{ $postHelper->getUriPost($post) }}">
                                    @if(in_array($post->post_type, ['video_file', 'video_url', 'video_embed']))
                                        <img src="{{ $videoHelper->showThumbnail($post, '300') }}" alt="{{ $post->post_image }}">
                                        <span class="jtv-category-media-badge"><i class="fas fa-play"></i></span>
                                    @elseif($post->post_type === 'audio')
                                        <img src="{{ $audioHelper->showThumbnail($post, '300') }}" alt="{{ $post->post_image }}">
                                        <span class="jtv-category-media-badge"><i class="fas fa-music"></i></span>
                                    @else
                                        <img src="{{ $postHelper->showThumbnail($post, 300) }}" alt="{{ $post->post_image }}">
                                    @endif
                                </a>
                                <div class="jtv-category-card-content">
                                    <div class="jtv-category-meta"><span>{{ $category->name }}</span><time>{{ $post->created_at->locale(LaravelLocalization::getCurrentLocale())->diffForHumans() }}</time></div>
                                    <h3><a href="{{ $postHelper->getUriPost($post) }}">{{ $post->post_title }}</a></h3>
                                    <p>{{ \Str::limit(strip_tags($post->post_content), 88) }}</p>
                                </div>
                            </article>
                        @endforeach
                    </div>
                    <div class="jtv-category-pagination">{{ $posts->links('frontend.magz.inc._pagination') }}</div>
                @endif
            </div>
            @if($sidebarPosition === "right" AND $sidebarActive)
                @php $categorySidebarMode = true; @endphp
                @include('frontend.magz.template-parts.sidebar')
            @endif
        </div>
    </div>
</section>
@stop

@push('scripts')
<script>
    document.querySelectorAll('[data-category-tab]').forEach(function (tab) {
        tab.addEventListener('click', function () {
            var panelName = tab.getAttribute('data-category-tab');
            var scope = tab.closest('.jtv-category-news-panel');

            scope.querySelectorAll('[data-category-tab]').forEach(function (item) {
                item.classList.toggle('is-active', item === tab);
            });
            scope.querySelectorAll('[data-category-panel]').forEach(function (panel) {
                panel.classList.toggle('is-active', panel.getAttribute('data-category-panel') === panelName);
            });
        });
    });
</script>
@endpush
