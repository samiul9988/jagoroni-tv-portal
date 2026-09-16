@extends('frontend.magz.index')

@inject('postHelper', 'App\Helpers\PostHelper')

@section('content')
@php
    $lead = $jamunaPosts->first();
    $secondary = $jamunaPosts->slice(1, 3);
    $railPosts = $jamunaPosts->slice(4, 7);
    $categoryNames = $jamunaPosts->flatMap(fn ($post) => $post->categories)->unique('id')->take(8);
    $leadSummary = $lead
        ? trim(preg_replace('/\s+/', ' ', str_replace("\xC2\xA0", ' ', html_entity_decode(strip_tags($lead->post_summary ?: $lead->post_content), ENT_QUOTES | ENT_HTML5, 'UTF-8'))))
        : '';
@endphp

<main class="jtv-jamuna-home">
    <div class="jtv-jamuna-container">
        @if($lead)
        <div class="jtv-jamuna-top-grid">
            <section class="jtv-jamuna-lead">
                <a href="{{ $postHelper::getUriPost($lead) }}"><img src="{{ $postHelper::showThumbnail($lead, 760) }}" alt="{{ $lead->post_title }}"></a>
                <div class="jtv-lead-caption">
                    <span class="jtv-kicker">{{ optional($lead->categories->first())->name ?: 'সর্বশেষ' }}</span>
                    <h1><a href="{{ $postHelper::getUriPost($lead) }}">{{ $lead->post_title }}</a></h1>
                    <div class="jtv-lead-summary-wrap">
                        <p class="jtv-lead-summary">{{ $leadSummary }}</p>
                        @if(mb_strlen($leadSummary) > 300)
                            <button type="button" class="jtv-summary-toggle" aria-expanded="false">See more</button>
                        @endif
                    </div>
                    <time>{{ $lead->created_at->locale(app()->getLocale())->diffForHumans() }}</time>
                </div>
            </section>
            <section class="jtv-jamuna-secondary">
                @foreach($secondary as $post)
                <article class="jtv-story-card"><a href="{{ $postHelper::getUriPost($post) }}"><img src="{{ $postHelper::showThumbnail($post, 320) }}" alt="{{ $post->post_title }}"></a><h2><a href="{{ $postHelper::getUriPost($post) }}">{{ $post->post_title }}</a></h2></article>
                @endforeach
            </section>
            <aside class="jtv-jamuna-latest">
                <div class="jtv-tabs"><strong>সর্বশেষ</strong><span>পঠিত</span></div>
                @foreach($railPosts as $post)
                <article class="jtv-latest-item"><a href="{{ $postHelper::getUriPost($post) }}"><img src="{{ $postHelper::showThumbnail($post, 150) }}" alt="{{ $post->post_title }}"></a><h3><a href="{{ $postHelper::getUriPost($post) }}">{{ $post->post_title }}</a></h3></article>
                @endforeach
                <a class="jtv-more-button" href="{{ route('articles.latest') }}">সব খবর</a>
            </aside>
        </div>
        @endif

        <div class="jtv-ad-space">বিজ্ঞাপনের স্থান</div>

        <section class="jtv-category-grid">
            @foreach($categoryNames as $category)
                @php $categoryPosts = $jamunaPosts->filter(fn ($post) => $post->categories->contains('id', $category->id))->take(4); @endphp
                @if($categoryPosts->isNotEmpty())
                <section class="jtv-category-block">
                    <h2><a href="{{ route('category.show', $category->slug) }}">{{ $category->name }} <small>সব ›</small></a></h2>
                    @foreach($categoryPosts as $post)
                    <article class="jtv-category-story"><a href="{{ $postHelper::getUriPost($post) }}"><img src="{{ $postHelper::showThumbnail($post, 300) }}" alt="{{ $post->post_title }}"></a><h3><a href="{{ $postHelper::getUriPost($post) }}">{{ $post->post_title }}</a></h3></article>
                    @endforeach
                </section>
                @endif
            @endforeach
        </section>

        @if($jamunaVideos->isNotEmpty())
        <section class="jtv-video-section"><h2>ভিডিও <small>সব ›</small></h2><div class="jtv-video-grid">
            @foreach($jamunaVideos as $video)
            <article class="jtv-video-card"><a href="{{ $postHelper::getUriPost($video) }}"><img src="{{ $postHelper::showThumbnail($video, 420) }}" alt="{{ $video->post_title }}"><span>▶</span></a><h3><a href="{{ $postHelper::getUriPost($video) }}">{{ $video->post_title }}</a></h3></article>
            @endforeach
        </div></section>
        @endif
    </div>
</main>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.jtv-summary-toggle').forEach(function (button) {
            button.addEventListener('click', function () {
                const summary = button.previousElementSibling;
                const expanded = button.getAttribute('aria-expanded') === 'true';

                summary.classList.toggle('is-expanded', !expanded);
                button.setAttribute('aria-expanded', String(!expanded));
                button.textContent = expanded ? 'See more' : 'See less';
            });
        });
    });
</script>
@endpush
