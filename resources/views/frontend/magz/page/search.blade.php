@extends('frontend.magz.index')

@inject('postHelper', 'App\Helpers\PostHelper')
@php
    $posts->load('categories');
    $locale = LaravelLocalization::getCurrentLocale();
    $bn = ['0' => '০', '1' => '১', '2' => '২', '3' => '৩', '4' => '৪', '5' => '৫', '6' => '৬', '7' => '৭', '8' => '৮', '9' => '৯'];
    $num = fn ($n) => strtr((string) $n, $bn);
    $views = function ($item) use ($num) {
        $n = (int) ($item->post_hits ?? 0);
        return $n >= 1000 ? $num(number_format($n / 1000, 1)) . 'ক' : $num($n);
    };
    $periods = ['day' => 'সর্বশেষ ২৪ ঘণ্টা', 'week' => 'সর্বশেষ ৭ দিন', 'month' => 'সর্বশেষ ৩০ দিন', 'all' => 'সব সময়'];
    $keepLocation = array_filter(['division' => $division, 'district' => $district, 'upazila' => $upazila]);
    $tabUrl = fn ($slug) => request()->url() . '?' . http_build_query(array_filter(array_merge(['q' => $keyword, 'period' => $period === 'all' ? null : $period, 'category' => $slug], $keepLocation)));
@endphp

@push('styles')
@include('frontend.magz.inc._reference-header-styles')
@include('frontend.magz.inc._homepage-footer-styles')
<style>
    body.skin-magz.jtv-homepage.jtv-homepage.jtv-homepage nav.jtv-main-nav ul.nav-list > li.jtv-nav-home-link > a,
    body.skin-magz.jtv-homepage.jtv-homepage.jtv-homepage nav.jtv-main-nav ul.nav-list > li.jtv-nav-home-link:not(.active) > a { background: #d61f26 !important; color: #fff !important; }
    body.skin-magz.jtv-homepage.jtv-homepage.jtv-homepage nav.jtv-main-nav ul.nav-list > li:not(.jtv-nav-home-link):hover > a,
    body.skin-magz.jtv-homepage.jtv-homepage.jtv-homepage nav.jtv-main-nav ul.nav-list > li:not(.jtv-nav-home-link):focus-within > a,
    body.skin-magz.jtv-homepage.jtv-homepage.jtv-homepage nav.jtv-main-nav ul.nav-list > li:not(.jtv-nav-home-link) > a:hover,
    body.skin-magz.jtv-homepage.jtv-homepage.jtv-homepage nav.jtv-main-nav ul.nav-list > li:not(.jtv-nav-home-link).active > a { color: #fff !important; background: #d61f26 !important; }

    body.skin-magz .jtv-s { padding: 14px 0 48px; background: #eef4f0; }
    body.skin-magz .jtv-s-wrap { width: 100%; box-sizing: border-box; padding: 0 clamp(12px, 2vw, 32px); }
    body.skin-magz .jtv-s-crumb { display: flex; flex-wrap: wrap; gap: 6px; margin: 0 0 14px; padding: 0; list-style: none; font-size: 13px; color: #667a70; }
    body.skin-magz .jtv-s-crumb a { color: inherit; text-decoration: none; }
    body.skin-magz .jtv-s-crumb li + li::before { content: '›'; margin-right: 6px; color: #9fb0a8; }
    body.skin-magz .jtv-s-shell { padding: 20px; border: 1px solid #d9e8df; border-radius: 12px; background: linear-gradient(135deg, #f8fbf9, #eef6f1); box-shadow: 0 6px 20px rgba(13, 68, 42, .06); }
    body.skin-magz .jtv-s-grid { display: grid; grid-template-columns: minmax(0, 1fr) minmax(260px, 330px); gap: 22px; align-items: start; }

    /* Search bar */
    body.skin-magz .jtv-s-form { display: flex; align-items: center; gap: 0; height: 48px; border: 1px solid #cfe1d6; border-radius: 8px; background: #fff; overflow: hidden; }
    body.skin-magz .jtv-s-form > i.lead { padding: 0 12px 0 16px; color: #667a70; }
    body.skin-magz .jtv-s-form input[type=search] { flex: 1; min-width: 0; height: 100%; border: 0; outline: 0; background: transparent; color: #17231c; font-size: 15px; }
    body.skin-magz .jtv-s-clear { display: inline-flex; align-items: center; justify-content: center; width: 30px; height: 30px; margin-right: 8px; border-radius: 50%; color: #667a70; text-decoration: none; }
    body.skin-magz .jtv-s-clear:hover { background: #eef1ef; }
    body.skin-magz .jtv-s-form button { height: 100%; padding: 0 26px; border: 0; background: #0b6b3a; color: #fff; font-size: 15px; font-weight: 800; cursor: pointer; }
    body.skin-magz .jtv-s-form button:hover { background: #087342; }
    body.skin-magz .jtv-s-hint { margin: 8px 2px 14px; color: #667a70; font-size: 12px; }
    body.skin-magz .jtv-s-hint b { color: #0b6b3a; }

    /* Tabs */
    body.skin-magz .jtv-s-tabs { display: flex; gap: 8px; overflow-x: auto; margin: 0 0 18px; padding: 0 0 4px; scrollbar-width: none; }
    body.skin-magz .jtv-s-tabs::-webkit-scrollbar { display: none; }
    body.skin-magz .jtv-s-tab { flex: none; display: inline-flex; align-items: center; gap: 6px; padding: 8px 16px; border: 1px solid #d0e2d7; border-radius: 999px; background: #fff; color: #17231c; font-size: 13px; font-weight: 700; text-decoration: none; white-space: nowrap; transition: all .2s; }
    body.skin-magz .jtv-s-tab small { color: #7a877f; font-weight: 600; }
    body.skin-magz .jtv-s-tab:hover { border-color: #0b6b3a; color: #0b6b3a; }
    body.skin-magz .jtv-s-tab.is-active { border-color: #0b6b3a; background: #0b6b3a; color: #fff; }
    body.skin-magz .jtv-s-tab.is-active small { color: rgba(255,255,255,.8); }

    /* Results */
    body.skin-magz .jtv-s-list { display: grid; gap: 14px; }
    body.skin-magz .jtv-s-item { display: grid; grid-template-columns: 210px minmax(0, 1fr); gap: 18px; padding: 12px; border: 1px solid #dfe9e3; border-radius: 10px; background: #fff; transition: box-shadow .2s, transform .2s; }
    body.skin-magz .jtv-s-item:hover { box-shadow: 0 8px 20px rgba(13, 68, 42, .1); transform: translateY(-2px); }
    body.skin-magz .jtv-s-thumb { position: relative; display: block; align-self: start; aspect-ratio: 4 / 3; overflow: hidden; border-radius: 8px; background: #dfeee4; }
    body.skin-magz .jtv-s-thumb img { position: absolute; inset: 0; width: 100%; height: 100%; object-fit: cover; }
    body.skin-magz .jtv-s-badge { position: absolute; top: 8px; left: 8px; padding: 2px 9px; border-radius: 3px; background: #d61f26; color: #fff; font-size: 11px; font-weight: 700; }
    body.skin-magz .jtv-s-body h2 { margin: 2px 0 8px; font-size: 20px; font-weight: 800; line-height: 1.4; }
    body.skin-magz .jtv-s-body h2 a { color: #12281c; text-decoration: none; }
    body.skin-magz .jtv-s-body h2 a:hover { color: #0b6b3a; }
    body.skin-magz .jtv-s-body p { margin: 0 0 10px; color: #4e6056; font-size: 14px; line-height: 1.7; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; }
    body.skin-magz .jtv-s-meta { display: flex; flex-wrap: wrap; gap: 6px 18px; color: #7a877f; font-size: 12px; }
    body.skin-magz .jtv-s-meta i { margin-right: 5px; color: #0b6b3a; }
    body.skin-magz .jtv-s-empty { padding: 50px 20px; text-align: center; border: 1px dashed #cfe1d6; border-radius: 10px; background: #fff; color: #667a70; }
    body.skin-magz .jtv-s-empty i { display: block; margin-bottom: 10px; font-size: 34px; color: #9fc4ae; }

    /* Pagination */
    body.skin-magz .jtv-s-pager { margin-top: 22px; }
    body.skin-magz .jtv-pg { text-align: center; }
    body.skin-magz .jtv-pg-list { display: flex; flex-wrap: wrap; justify-content: center; gap: 8px; margin: 0; padding: 0; list-style: none; }
    body.skin-magz .jtv-pg-btn { display: inline-flex; align-items: center; justify-content: center; min-width: 38px; height: 38px; padding: 0 10px; border: 1px solid #dce6e0; border-radius: 8px; background: #fff; color: #17231c; font-size: 14px; font-weight: 700; text-decoration: none; box-sizing: border-box; }
    body.skin-magz a.jtv-pg-btn:hover { border-color: #0b6b3a; color: #0b6b3a; }
    body.skin-magz .jtv-pg-btn.is-active { border-color: #0b6b3a; background: #0b6b3a; color: #fff; }
    body.skin-magz .jtv-pg-btn.is-disabled { opacity: .45; background: #f3f5f4; }
    body.skin-magz .jtv-pg-btn.is-dots { border-color: transparent; background: transparent; }
    body.skin-magz .jtv-pg-info { display: none; }

    /* Sidebar */
    body.skin-magz .jtv-s-side > * + * { margin-top: 16px; }
    body.skin-magz .jtv-s-box { padding: 16px; border: 1px solid #dfe9e3; border-radius: 10px; background: #fff; }
    body.skin-magz .jtv-s-box h3 { display: flex; align-items: center; gap: 8px; margin: 0 0 12px; color: #12281c; font-size: 16px; font-weight: 800; }
    body.skin-magz .jtv-s-box h3 i { color: #0b6b3a; }
    body.skin-magz .jtv-s-box h4 { margin: 14px 0 8px; color: #12281c; font-size: 14px; font-weight: 800; }
    body.skin-magz .jtv-s-check { display: flex; align-items: center; gap: 9px; padding: 5px 0; color: #2f4238; font-size: 14px; cursor: pointer; }
    body.skin-magz .jtv-s-check input { width: 16px; height: 16px; accent-color: #0b6b3a; }
    body.skin-magz .jtv-s-check small { margin-left: auto; color: #7a877f; }
    body.skin-magz .jtv-s-apply { width: 100%; margin-top: 14px; padding: 11px; border: 0; border-radius: 6px; background: #0b6b3a; color: #fff; font-size: 14px; font-weight: 800; cursor: pointer; }
    body.skin-magz .jtv-s-apply:hover { background: #087342; }
    body.skin-magz .jtv-s-live { display: flex; align-items: center; justify-content: space-between; gap: 10px; padding: 18px 16px; border-radius: 10px; color: #fff; background: linear-gradient(120deg, #0b6b3a 0%, #0d8552 62%, #d61f26 62%); }
    body.skin-magz .jtv-s-live strong { display: block; font-size: 17px; line-height: 1.35; }
    body.skin-magz .jtv-s-live em { display: inline-block; margin-bottom: 4px; padding: 1px 8px; border-radius: 3px; background: #e0141e; font-style: normal; font-size: 11px; font-weight: 800; }
    body.skin-magz .jtv-s-live a { flex: none; padding: 7px 14px; border-radius: 5px; background: #fff; color: #0b6b3a; font-size: 12px; font-weight: 800; text-decoration: none; }
    body.skin-magz .jtv-s-tags { display: flex; flex-wrap: wrap; gap: 8px; }
    body.skin-magz .jtv-s-tags a { padding: 5px 13px; border: 1px solid #d0e2d7; border-radius: 999px; background: #f4faf6; color: #2f4238; font-size: 12px; text-decoration: none; }
    body.skin-magz .jtv-s-tags a:hover { background: #0b6b3a; border-color: #0b6b3a; color: #fff; }
    body.skin-magz .jtv-s-recent { display: flex; gap: 10px; padding: 9px 0; border-bottom: 1px solid #edf1ee; }
    body.skin-magz .jtv-s-recent:last-child { border-bottom: 0; }
    body.skin-magz .jtv-s-recent img { flex: none; width: 66px; height: 50px; border-radius: 4px; object-fit: cover; }
    body.skin-magz .jtv-s-recent a { color: #17231c; font-size: 13px; font-weight: 700; line-height: 1.4; text-decoration: none; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
    body.skin-magz .jtv-s-recent time { display: block; margin-top: 3px; color: #8a968f; font-size: 11px; }

    @media (max-width: 991px) { body.skin-magz .jtv-s-grid { grid-template-columns: minmax(0, 1fr); } }
    @media (max-width: 640px) {
        body.skin-magz .jtv-s-shell { padding: 12px; }
        body.skin-magz .jtv-s-item { grid-template-columns: 110px minmax(0, 1fr); gap: 12px; }
        body.skin-magz .jtv-s-body h2 { font-size: 16px; }
        body.skin-magz .jtv-s-body p { display: none; }
        body.skin-magz .jtv-s-form button { padding: 0 16px; }
    }
</style>
@endpush

@section('content')
<section class="jtv-s">
    <div class="jtv-s-wrap">
        <ul class="jtv-s-crumb">
            <li><a href="{{ url('/') }}"><i class="fa-solid fa-house"></i> হোম</a></li>
            <li>অনুসন্ধান</li>
        </ul>

        <div class="jtv-s-shell">
            <div class="jtv-s-grid">
                <div class="jtv-s-main">
                    <form class="jtv-s-form" action="{{ url('/search') }}" method="get" role="search">
                        <i class="fa-solid fa-magnifying-glass lead"></i>
                        <input type="search" name="q" value="{{ $keyword }}" placeholder="খবর খুঁজুন…" autocomplete="off">
                        @foreach($keepLocation as $k => $v)<input type="hidden" name="{{ $k }}" value="{{ $v }}">@endforeach
                        @if($period !== 'all')<input type="hidden" name="period" value="{{ $period }}">@endif
                        @if($keyword !== '' || $searchLabel !== '')<a class="jtv-s-clear" href="{{ url('/search') }}" aria-label="মুছুন"><i class="fa-solid fa-xmark"></i></a>@endif
                        <button type="submit">খুঁজুন</button>
                    </form>
                    <p class="jtv-s-hint">মোট <b>{{ $num($countResults) }}</b> টি ফলাফল পাওয়া গেছে @if($searchLabel !== '')"<b>{{ $searchLabel }}</b>" এর জন্য @endif</p>

                    <div class="jtv-s-tabs">
                        <a class="jtv-s-tab {{ $categorySlug === '' ? 'is-active' : '' }}" href="{{ $tabUrl(null) }}"><i class="fa-solid fa-border-all"></i> সব <small>({{ $num($totalBeforeCategory) }})</small></a>
                        @foreach($categoryCounts->take(8) as $cat)
                            <a class="jtv-s-tab {{ $categorySlug === $cat->slug ? 'is-active' : '' }}" href="{{ $tabUrl($cat->slug) }}">{{ $cat->name }} <small>({{ $num($cat->result_count) }})</small></a>
                        @endforeach
                    </div>

                    @if($posts->count())
                    <div class="jtv-s-list">
                        @foreach($posts as $post)
                            @php $cat = $post->categories->first(); @endphp
                            <article class="jtv-s-item">
                                <a class="jtv-s-thumb" href="{{ $postHelper->getUriPost($post) }}">
                                    <img src="{{ $postHelper->showThumbnail($post, 300) }}" alt="{{ $post->post_title }}" loading="lazy">
                                    @if($cat && $cat->name)<span class="jtv-s-badge">{{ $cat->name }}</span>@endif
                                </a>
                                <div class="jtv-s-body">
                                    <h2><a href="{{ $postHelper->getUriPost($post) }}">{{ $post->post_title }}</a></h2>
                                    <p>{{ \Illuminate\Support\Str::limit(trim(html_entity_decode(strip_tags($post->post_summary ?: $post->post_content), ENT_QUOTES | ENT_HTML5, 'UTF-8')), 220) }}</p>
                                    <div class="jtv-s-meta">
                                        <span><i class="fa-regular fa-calendar"></i>{{ $post->created_at->locale($locale)->isoFormat('LL') }}</span>
                                        <span><i class="fa-regular fa-eye"></i>{{ $views($post) }}</span>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>
                    <div class="jtv-s-pager">
                        {{ $posts->appends(array_filter(['q' => $keyword, 'division' => $division, 'district' => $district, 'upazila' => $upazila, 'category' => $categorySlug, 'period' => $period === 'all' ? null : $period]))->links('frontend.magz.inc._category-pagination') }}
                    </div>
                    @else
                    <div class="jtv-s-empty"><i class="fa-regular fa-face-frown"></i>কোনো ফলাফল পাওয়া যায়নি। অন্য শব্দ বা ফিল্টার দিয়ে চেষ্টা করুন।</div>
                    @endif
                </div>

                <aside class="jtv-s-side">
                    <form class="jtv-s-box" action="{{ url('/search') }}" method="get">
                        <h3><i class="fa-solid fa-filter"></i> খোঁজার ফলাফল ফিল্টার</h3>
                        <input type="hidden" name="q" value="{{ $keyword }}">
                        @foreach($keepLocation as $k => $v)<input type="hidden" name="{{ $k }}" value="{{ $v }}">@endforeach

                        <h4 style="margin-top:0">ক্যাটাগরি</h4>
                        <label class="jtv-s-check"><input type="radio" name="category" value="" {{ $categorySlug === '' ? 'checked' : '' }}> সব <small>({{ $num($totalBeforeCategory) }})</small></label>
                        @foreach($categoryCounts->take(6) as $cat)
                            <label class="jtv-s-check"><input type="radio" name="category" value="{{ $cat->slug }}" {{ $categorySlug === $cat->slug ? 'checked' : '' }}> {{ $cat->name }} <small>({{ $num($cat->result_count) }})</small></label>
                        @endforeach

                        <h4>সময় অনুযায়ী</h4>
                        @foreach($periods as $value => $label)
                            <label class="jtv-s-check"><input type="radio" name="period" value="{{ $value }}" {{ $period === $value ? 'checked' : '' }}> {{ $label }}</label>
                        @endforeach
                        <button class="jtv-s-apply" type="submit">ফিল্টার প্রয়োগ করুন</button>
                    </form>

                    <div class="jtv-s-live">
                        <div><em>LIVE</em><strong>সরাসরি টিভি দেখুন</strong></div>
                        <a href="{{ url('/live-tv') }}">এখনই দেখুন →</a>
                    </div>

                    @if($popularTags->count())
                    <div class="jtv-s-box">
                        <h3>জনপ্রিয় অনুসন্ধান</h3>
                        <div class="jtv-s-tags">
                            @foreach($popularTags as $tag)<a href="{{ route('tag.show', $tag) }}">{{ $tag->name }}</a>@endforeach
                        </div>
                    </div>
                    @endif

                    @if($sidebarLatest->count())
                    <div class="jtv-s-box">
                        <h3>সাম্প্রতিক খবর</h3>
                        @foreach($sidebarLatest as $item)
                            <div class="jtv-s-recent">
                                <img src="{{ $postHelper->showThumbnail($item, 100) }}" alt="{{ $item->post_title }}" loading="lazy">
                                <div><a href="{{ $postHelper->getUriPost($item) }}">{{ $item->post_title }}</a><time>{{ $item->created_at->locale($locale)->isoFormat('LL') }}</time></div>
                            </div>
                        @endforeach
                    </div>
                    @endif
                </aside>
            </div>
        </div>
    </div>
</section>
@stop
