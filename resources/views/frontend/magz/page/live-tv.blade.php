@extends('frontend.magz.index')

@inject('videoHelper', 'App\Helpers\VideoHelper')
@php $posts->load('categories') @endphp

@push('styles')
<style>
    body.skin-magz .jtv-live-page {
        width: min(1280px, calc(100% - 32px));
        margin: 0 auto;
        padding: 28px 0 52px;
    }

    body.skin-magz .jtv-live-page-heading {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        margin-bottom: 18px;
        padding-bottom: 12px;
        border-bottom: 3px solid #0b6b3a;
    }

    body.skin-magz .jtv-live-page-heading h1 {
        margin: 0;
        color: #07532d;
        font-family: "Noto Sans Bengali", Arial, sans-serif;
        font-size: clamp(24px, 3vw, 38px);
        font-weight: 800;
    }

    body.skin-magz .jtv-live-page-heading a {
        color: #0b6b3a;
        font-weight: 700;
        text-decoration: none;
    }

    body.skin-magz .jtv-live-page-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 18px;
    }

    body.skin-magz .jtv-live-page-card {
        overflow: hidden;
        border: 1px solid #d9e4de;
        border-radius: 12px;
        background: #fff;
        box-shadow: 0 7px 20px rgba(7, 83, 45, .08);
    }

    body.skin-magz .jtv-live-page-card figure {
        position: relative;
        height: 205px;
        margin: 0;
        overflow: hidden;
        background: #e8efeb;
    }

    body.skin-magz .jtv-live-page-card figure img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform .25s ease;
    }

    body.skin-magz .jtv-live-page-card:hover figure img {
        transform: scale(1.04);
    }

    body.skin-magz .jtv-live-page-badge {
        position: absolute;
        top: 12px;
        left: 12px;
        padding: 5px 10px;
        border-radius: 999px;
        color: #fff;
        background: #d71e27;
        font-size: 11px;
        font-weight: 800;
    }

    body.skin-magz .jtv-live-page-card-body {
        padding: 15px 16px 18px;
    }

    body.skin-magz .jtv-live-page-card h2 {
        display: -webkit-box;
        min-height: 52px;
        margin: 0 0 10px;
        overflow: hidden;
        color: #173d2b;
        font-family: "Noto Sans Bengali", Arial, sans-serif;
        font-size: 18px;
        line-height: 1.45;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 2;
    }

    body.skin-magz .jtv-live-page-card h2 a {
        color: inherit;
        text-decoration: none;
    }

    body.skin-magz .jtv-live-page-meta {
        color: #76837d;
        font-size: 12px;
    }

    body.skin-magz .jtv-live-page-meta i {
        margin-right: 5px;
        color: #d71e27;
    }

    body.skin-magz .jtv-live-page-pagination {
        margin-top: 24px;
    }

    @media (max-width: 900px) {
        body.skin-magz .jtv-live-page-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 600px) {
        body.skin-magz .jtv-live-page {
            width: calc(100% - 24px);
            padding-top: 20px;
        }

        body.skin-magz .jtv-live-page-heading {
            align-items: flex-start;
            flex-direction: column;
        }

        body.skin-magz .jtv-live-page-grid {
            grid-template-columns: 1fr;
        }

        body.skin-magz .jtv-live-page-card figure {
            height: clamp(190px, 55vw, 280px);
        }
    }
</style>
@endpush

@section('content')
<section class="jtv-live-page">
    <div class="jtv-live-page-heading">
        <h1><i class="fa-solid fa-tower-broadcast"></i> লাইভ টিভি</h1>
        <a href="{{ url('/') }}">হোমে ফিরুন <i class="fa-solid fa-arrow-right"></i></a>
    </div>

    <div class="jtv-live-page-grid">
        @forelse($posts as $post)
            <article class="jtv-live-page-card">
                <figure>
                    <a href="{{ $videoHelper::getUriPost($post) }}">
                        <img src="{{ $videoHelper::showThumbnail($post, 520) }}" alt="{{ $post->post_title }}" loading="lazy">
                        <span class="jtv-live-page-badge"><i class="fa-solid fa-circle"></i> LIVE VIDEO</span>
                    </a>
                </figure>
                <div class="jtv-live-page-card-body">
                    <h2><a href="{{ $videoHelper::getUriPost($post) }}">{{ $post->post_title }}</a></h2>
                    <div class="jtv-live-page-meta"><i class="fa-regular fa-clock"></i>{{ $post->created_at->locale(app()->getLocale())->diffForHumans() }} &nbsp; • &nbsp; <i class="fa-regular fa-eye"></i>{{ number_format((int) ($post->post_hits ?: 0) / 1000, 1) }}K</div>
                </div>
            </article>
        @empty
            <p>এই মুহূর্তে কোনো লাইভ ভিডিও পাওয়া যায়নি।</p>
        @endforelse
    </div>

    <div class="jtv-live-page-pagination">
        {{ $posts->links('frontend.magz.inc._pagination') }}
    </div>
</section>
@endsection
