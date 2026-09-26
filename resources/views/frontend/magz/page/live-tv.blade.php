@extends('frontend.magz.index')

@php
    $bn = ['0' => '০', '1' => '১', '2' => '২', '3' => '৩', '4' => '৪', '5' => '৫', '6' => '৬', '7' => '৭', '8' => '৮', '9' => '৯'];
    $bnTime = fn ($t) => strtr((string) $t, $bn);
    $iframe = $stream->iframe_url;
    $hasSource = $stream->stream_type === 'embed' ? filled($stream->embed_code) : filled($stream->stream_url);
    $shown = $current ?? $upcoming;
    $posterUrl = $stream->poster_url ?: asset('img/cover-video.webp');
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

    body.skin-magz .jtv-live { padding: 16px 0 48px; background: #f4f6f5; }
    body.skin-magz .jtv-live-wrap { width: 100%; box-sizing: border-box; padding: 0 clamp(12px, 2vw, 32px); }
    body.skin-magz .jtv-live-crumb { display: flex; flex-wrap: wrap; gap: 6px; margin: 0 0 14px; padding: 0; list-style: none; font-size: 13px; color: #667a70; }
    body.skin-magz .jtv-live-crumb a { color: inherit; text-decoration: none; }
    body.skin-magz .jtv-live-crumb li + li::before { content: '›'; margin-right: 6px; color: #9fb0a8; }
    body.skin-magz .jtv-live-grid { display: grid; grid-template-columns: minmax(0, 1fr) minmax(300px, 360px); gap: 20px; align-items: start; }

    body.skin-magz .jtv-live-card { border: 1px solid #e1e8e4; border-radius: 10px; background: #fff; box-shadow: 0 4px 16px rgba(13, 68, 42, .06); }

    /* Player */
    body.skin-magz .jtv-live-player { position: relative; overflow: hidden; border-radius: 10px; background: #050b09; aspect-ratio: 16 / 9; }
    body.skin-magz .jtv-live-player iframe, body.skin-magz .jtv-live-player video { position: absolute; inset: 0; width: 100%; height: 100%; border: 0; background: #000; }
    body.skin-magz .jtv-live-player .jtv-live-embed { position: absolute; inset: 0; }
    body.skin-magz .jtv-live-player .jtv-live-embed iframe { width: 100%; height: 100%; }
    body.skin-magz .jtv-live-badges { position: absolute; top: 14px; left: 14px; z-index: 3; display: flex; gap: 8px; align-items: center; pointer-events: none; }
    body.skin-magz .jtv-live-pill { display: inline-flex; align-items: center; gap: 7px; padding: 5px 13px; border-radius: 5px; background: #e0141e; color: #fff; font-size: 13px; font-weight: 800; letter-spacing: .5px; }
    body.skin-magz .jtv-live-pill::before { content: ''; width: 9px; height: 9px; border-radius: 50%; background: #fff; animation: jtvPulse 1.4s infinite; }
    body.skin-magz .jtv-live-pill.is-off { background: #56635c; }
    body.skin-magz .jtv-live-pill.is-off::before { animation: none; opacity: .6; }
    body.skin-magz .jtv-live-views { padding: 5px 11px; border-radius: 5px; background: rgba(0,0,0,.6); color: #fff; font-size: 12px; font-weight: 700; }
    body.skin-magz .jtv-live-views i { margin-right: 5px; }
    @keyframes jtvPulse { 0%, 100% { opacity: 1; transform: scale(1); } 50% { opacity: .35; transform: scale(.7); } }
    body.skin-magz .jtv-live-off { position: absolute; inset: 0; display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 8px; padding: 20px; text-align: center; color: #fff; background: radial-gradient(circle at 50% 40%, #12382a, #050b09); }
    body.skin-magz .jtv-live-off i { font-size: 44px; color: #2e9a63; }
    body.skin-magz .jtv-live-off strong { font-size: 20px; }
    body.skin-magz .jtv-live-off span { font-size: 14px; color: rgba(255,255,255,.75); }
    body.skin-magz .jtv-live-stage { position: absolute; inset: 0; }
    body.skin-magz .jtv-live-back { pointer-events: auto; display: inline-flex; align-items: center; gap: 7px; padding: 5px 13px; border: 0; border-radius: 5px; background: #ffd200; color: #0d3b22; font-size: 13px; font-weight: 800; cursor: pointer; }
    body.skin-magz .jtv-live-back[hidden] { display: none; }
    body.skin-magz .jtv-live-back:hover { filter: brightness(1.06); }
    body.skin-magz .jtv-live-pill[hidden] { display: none; }
    body.skin-magz .jtv-live-pill.is-rec { background: #2b5cff; }
    body.skin-magz .jtv-live-pill.is-rec::before { animation: none; }
    body.skin-magz .jtv-live-prog { padding: 0; border: 0; background: transparent; text-align: left; cursor: pointer; font: inherit; }
    body.skin-magz .jtv-live-prog:hover .jtv-live-prog-img img { transform: scale(1.05); }
    body.skin-magz .jtv-live-prog-img img { transition: transform .3s; }
    body.skin-magz .jtv-live-prog-img::after { content: '\f04b'; font-family: 'Font Awesome 6 Free'; font-weight: 900; position: absolute; top: 50%; left: 50%; display: grid; place-items: center; width: 42px; height: 42px; margin: -21px 0 0 -21px; border-radius: 50%; background: rgba(0,0,0,.6); color: #fff; font-size: 15px; opacity: 0; transition: opacity .2s; }
    body.skin-magz .jtv-live-prog:hover .jtv-live-prog-img::after, body.skin-magz .jtv-live-prog:focus-visible .jtv-live-prog-img::after { opacity: 1; }
    body.skin-magz .jtv-live-prog.is-playing .jtv-live-prog-tag { background: #2b5cff; }
    body.skin-magz .jtv-live-off-poster, body.skin-magz .jtv-live-fallback { background-size: cover; background-position: center; }
    body.skin-magz .jtv-live-fallback { position: absolute; inset: 0; z-index: 2; display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 8px; padding: 20px; text-align: center; color: #fff; }
    body.skin-magz .jtv-live-fallback[hidden] { display: none; }
    body.skin-magz .jtv-live-fallback i { font-size: 40px; color: #ffd200; }
    body.skin-magz .jtv-live-fallback strong { font-size: 19px; text-shadow: 0 2px 8px rgba(0,0,0,.6); }
    body.skin-magz .jtv-live-fallback span { font-size: 14px; color: rgba(255,255,255,.85); }
    body.skin-magz .jtv-live-title { margin: 12px 4px 0; color: #17231c; font-size: 18px; font-weight: 800; }

    /* Featured programs slider */
    body.skin-magz .jtv-live-featured { margin-top: 18px; padding: 16px 18px 18px; }
    body.skin-magz .jtv-live-featured h3 { margin: 0 0 14px; color: #17231c; font-size: 17px; font-weight: 800; }
    body.skin-magz .jtv-live-slider { position: relative; padding: 0 30px; }
    body.skin-magz .jtv-live-track { display: flex; gap: 16px; overflow-x: auto; scroll-snap-type: x mandatory; scroll-behavior: smooth; scrollbar-width: none; }
    body.skin-magz .jtv-live-track::-webkit-scrollbar { display: none; }
    body.skin-magz .jtv-live-prog { flex: 0 0 calc((100% - 48px) / 4); scroll-snap-align: start; min-width: 0; }
    body.skin-magz .jtv-live-prog-img { position: relative; display: block; aspect-ratio: 16 / 10; overflow: hidden; border-radius: 6px; background: #dfeee4; }
    body.skin-magz .jtv-live-prog-img img { position: absolute; inset: 0; width: 100%; height: 100%; object-fit: cover; }
    body.skin-magz .jtv-live-prog-tag { position: absolute; top: 8px; left: 8px; padding: 2px 8px; border-radius: 3px; background: #d61f26; color: #fff; font-size: 10px; font-weight: 700; }
    body.skin-magz .jtv-live-prog h4 { margin: 8px 0 2px; color: #17231c; font-size: 14px; font-weight: 800; line-height: 1.4; }
    body.skin-magz .jtv-live-prog span.t { color: #6a7a71; font-size: 12px; }
    body.skin-magz .jtv-live-arrow { position: absolute; top: 40%; z-index: 2; width: 26px; height: 26px; padding: 0; border: 1px solid #dce6e0; border-radius: 50%; background: #fff; color: #17231c; cursor: pointer; transform: translateY(-50%); }
    body.skin-magz .jtv-live-arrow:hover { background: #087342; color: #fff; }
    body.skin-magz .jtv-live-arrow.prev { left: 0; } body.skin-magz .jtv-live-arrow.next { right: 0; }

    /* Right column */
    body.skin-magz .jtv-live-side > * + * { margin-top: 16px; }
    body.skin-magz .jtv-live-now { overflow: hidden; }
    body.skin-magz .jtv-live-now-head { display: flex; align-items: center; gap: 10px; padding: 12px 16px; background: #0b6b3a; color: #fff; font-size: 17px; font-weight: 800; }
    body.skin-magz .jtv-live-now-head .jtv-live-pill { padding: 3px 10px; font-size: 12px; background: #e0141e; }
    body.skin-magz .jtv-live-now-body { padding: 14px 16px 16px; }
    body.skin-magz .jtv-live-now-title { display: inline-block; padding: 6px 16px; border-radius: 4px; background: #0b6b3a; color: #fff; font-size: 17px; font-weight: 800; }
    body.skin-magz .jtv-live-now-time { margin: 10px 0 6px; color: #3e5147; font-size: 13px; }
    body.skin-magz .jtv-live-now-time b { color: #17231c; }
    body.skin-magz .jtv-live-now-desc { margin: 0; color: #46584e; font-size: 13px; line-height: 1.7; }

    body.skin-magz .jtv-live-sched { padding: 14px 16px; }
    body.skin-magz .jtv-live-sched-head { display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px; }
    body.skin-magz .jtv-live-sched-head h3 { margin: 0; color: #17231c; font-size: 15px; font-weight: 800; }
    body.skin-magz .jtv-live-sched ul { margin: 0; padding: 0; list-style: none; max-height: 330px; overflow-y: auto; }
    body.skin-magz .jtv-live-sched li { display: flex; align-items: center; gap: 12px; padding: 9px 10px; margin-bottom: 4px; border-radius: 6px; border-bottom: 1px solid #edf1ee; }
    body.skin-magz .jtv-live-sched li .tm { flex: none; min-width: 56px; padding: 4px 6px; border: 1px solid #dce6e0; border-radius: 5px; background: #f7faf8; color: #17231c; font-size: 12px; font-weight: 800; text-align: center; }
    body.skin-magz .jtv-live-sched li strong { display: block; color: #17231c; font-size: 14px; }
    body.skin-magz .jtv-live-sched li small { color: #7a877f; font-size: 11px; }
    body.skin-magz .jtv-live-sched li.is-on { background: #0b6b3a; border-color: #0b6b3a; }
    body.skin-magz .jtv-live-sched li.is-on strong, body.skin-magz .jtv-live-sched li.is-on small { color: #fff; }
    body.skin-magz .jtv-live-sched li.is-on .tm { border-color: transparent; background: #e0141e; color: #fff; }

    body.skin-magz .jtv-live-ways { padding: 14px 16px; }
    body.skin-magz .jtv-live-ways h3 { margin: 0 0 10px; color: #17231c; font-size: 15px; font-weight: 800; }
    body.skin-magz .jtv-live-ways-row { display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 8px; }
    body.skin-magz .jtv-live-way { display: flex; align-items: center; justify-content: center; gap: 6px; padding: 10px 6px; border-radius: 6px; color: #fff; font-size: 13px; font-weight: 800; text-decoration: none; }
    body.skin-magz .jtv-live-way.yt { background: #d61f26; } body.skin-magz .jtv-live-way.fb { background: #1466d8; } body.skin-magz .jtv-live-way.web { background: #eef1ef; color: #17231c; border: 1px solid #dce6e0; }
    body.skin-magz .jtv-live-way:hover { filter: brightness(1.08); color: inherit; }
    body.skin-magz .jtv-live-way.yt:hover, body.skin-magz .jtv-live-way.fb:hover { color: #fff; }

    body.skin-magz .jtv-live-cta { display: flex; align-items: center; justify-content: space-between; gap: 12px; padding: 20px 18px; border-radius: 10px; color: #fff; background: linear-gradient(115deg, #0b6b3a 0%, #0d8552 60%, #d61f26 60%); }
    body.skin-magz .jtv-live-cta strong { display: block; font-size: 18px; line-height: 1.4; }
    body.skin-magz .jtv-live-cta a { flex: none; padding: 8px 16px; border-radius: 999px; background: #d61f26; color: #fff; font-size: 13px; font-weight: 800; text-decoration: none; }

    @media (max-width: 1100px) { body.skin-magz .jtv-live-prog { flex-basis: calc((100% - 32px) / 3); } }
    @media (max-width: 991px) { body.skin-magz .jtv-live-grid { grid-template-columns: 1fr; } }
    @media (max-width: 640px) { body.skin-magz .jtv-live-prog { flex-basis: calc((100% - 16px) / 2); } body.skin-magz .jtv-live-ways-row { grid-template-columns: 1fr; } body.skin-magz .jtv-live-badges { top: 8px; left: 8px; } }
</style>
@endpush

@section('content')
<section class="jtv-live">
    <div class="jtv-live-wrap">
        <ul class="jtv-live-crumb">
            <li><a href="{{ url('/') }}"><i class="fa-solid fa-house"></i> হোম</a></li>
            <li>লাইভ স্ট্রীমিং</li>
        </ul>

        <div class="jtv-live-grid">
            <div class="jtv-live-main">
                <div class="jtv-live-player">
                    <div class="jtv-live-badges">
                        <span class="jtv-live-pill {{ $stream->is_live ? '' : 'is-off' }}" id="jtvLivePill">{{ $stream->is_live ? 'LIVE' : 'OFFLINE' }}</span>
                        @if($stream->is_live && $stream->viewers_label)<span class="jtv-live-views" id="jtvLiveViews"><i class="fa-regular fa-eye"></i>{{ $stream->viewers_label }}</span>@endif
                        <button type="button" class="jtv-live-back" id="jtvBackLive" hidden><i class="fa-solid fa-tower-broadcast"></i> লাইভ দেখুন</button>
                    </div>

                    <div class="jtv-live-stage" id="jtvLiveStage">

                    @if($stream->is_live && $hasSource)
                        @if($stream->stream_type === 'embed')
                            <div class="jtv-live-embed">{!! $stream->embed_code !!}</div>
                        @elseif($iframe)
                            <iframe id="jtvLiveFrame" src="{{ $iframe }}{{ $stream->stream_type === 'youtube' ? '&enablejsapi=1&origin=' . urlencode(url('/')) : '' }}" title="{{ $stream->title }}" allow="autoplay; encrypted-media; picture-in-picture; fullscreen" allowfullscreen loading="lazy"></iframe>
                        @else
                            <video id="jtvLiveVideo" controls playsinline autoplay muted @if($stream->poster_url) poster="{{ $stream->poster_url }}" @endif data-src="{{ $stream->stream_url }}" data-type="{{ $stream->stream_type }}"></video>
                        @endif
                    @else
                        <div class="jtv-live-off jtv-live-off-poster" style="background-image: linear-gradient(rgba(5,11,9,.35), rgba(5,11,9,.7)), url('{{ $posterUrl }}')">
                            <i class="fa-solid fa-tower-broadcast"></i>
                            <strong>{{ $stream->is_live ? 'স্ট্রিম শীঘ্রই শুরু হচ্ছে' : 'এখন সরাসরি সম্প্রচার নেই' }}</strong>
                            <span>@if($upcoming)পরবর্তী অনুষ্ঠান: {{ $upcoming->title }} — {{ $bnTime($upcoming->start_label) }}@else অনুগ্রহ করে পরে আবার দেখুন @endif</span>
                        </div>
                    @endif
                    </div>

                    {{-- Shown when the video cannot be played: the admin poster acts as the thumbnail. --}}
                    <div class="jtv-live-fallback" id="jtvLiveFallback" hidden style="background-image: linear-gradient(rgba(5,11,9,.3), rgba(5,11,9,.75)), url('{{ $posterUrl }}')">
                        <i class="fa-solid fa-circle-exclamation"></i>
                        <strong>ভিডিওটি এই মুহূর্তে চালু করা যাচ্ছে না</strong>
                        <span>@if($upcoming)পরবর্তী অনুষ্ঠান: {{ $upcoming->title }} — {{ $bnTime($upcoming->start_label) }}@else কিছুক্ষণ পর আবার চেষ্টা করুন @endif</span>
                    </div>
                </div>
                <div class="jtv-live-title" id="jtvLiveTitle" data-live-title="{{ $stream->title }}">{{ $stream->title }}</div>

                @if($featured->count())
                <div class="jtv-live-card jtv-live-featured">
                    <h3>সম্প্রচারিত অন্যান্য প্রোগ্রাম</h3>
                    <div class="jtv-live-slider" id="jtvLiveSlider">
                        <button type="button" class="jtv-live-arrow prev" aria-label="Previous"><i class="fa-solid fa-chevron-left"></i></button>
                        <div class="jtv-live-track">
                            @foreach($featured as $program)
                                <button type="button" class="jtv-live-prog" data-video="{{ $program->video_url }}" data-title="{{ $program->title }}" data-poster="{{ $program->image_url }}">
                                    <span class="jtv-live-prog-img">
                                        @if($program->image)<img src="{{ $program->image_url }}" alt="{{ $program->title }}" loading="lazy">@endif
                                        <span class="jtv-live-prog-tag">সম্প্রচারিত</span>
                                    </span>
                                    <h4>{{ $program->title }}</h4>
                                    <span class="t">{{ $bnTime($program->start_label) }}@if($program->end_label) – {{ $bnTime($program->end_label) }}@endif</span>
                                </button>
                            @endforeach
                        </div>
                        <button type="button" class="jtv-live-arrow next" aria-label="Next"><i class="fa-solid fa-chevron-right"></i></button>
                    </div>
                </div>
                @endif
            </div>

            <aside class="jtv-live-side">
                <div class="jtv-live-card jtv-live-now">
                    <div class="jtv-live-now-head"><span class="jtv-live-pill {{ $stream->is_live ? '' : 'is-off' }}">{{ $stream->is_live ? 'LIVE' : 'OFF' }}</span> বর্তমান সম্প্রচার</div>
                    <div class="jtv-live-now-body">
                        @if($shown)
                            <span class="jtv-live-now-title">{{ $shown->title }}</span>
                            <div class="jtv-live-now-time"><b>{{ $current ? 'এখন দেখছেন' : 'পরবর্তী' }}</b> &nbsp;|&nbsp; {{ $bnTime($shown->start_label) }}@if($shown->end_label) – {{ $bnTime($shown->end_label) }}@endif</div>
                            @if($shown->description || $shown->subtitle)<p class="jtv-live-now-desc">{{ $shown->description ?: $shown->subtitle }}</p>@endif
                        @else
                            <p class="jtv-live-now-desc mb-0">অনুষ্ঠানসূচি শীঘ্রই যুক্ত করা হবে।</p>
                        @endif
                    </div>
                </div>

                @if($programs->count())
                <div class="jtv-live-card jtv-live-sched">
                    <div class="jtv-live-sched-head"><h3>আজকের লাইভ প্রোগ্রাম সূচি</h3></div>
                    <ul>
                        @foreach($programs as $program)
                            @php $on = $current && $current->id === $program->id; @endphp
                            <li class="{{ $on ? 'is-on' : '' }}">
                                <span class="tm">{{ $on ? 'LIVE' : '' }}{{ $on ? ' ' : '' }}{{ $bnTime($program->start_label) }}</span>
                                <div><strong>{{ $program->title }}</strong>@if($program->subtitle)<small>{{ $program->subtitle }}</small>@endif</div>
                            </li>
                        @endforeach
                    </ul>
                </div>
                @endif

                @if($stream->youtube_url || $stream->facebook_url || $stream->website_url)
                <div class="jtv-live-card jtv-live-ways">
                    <h3>দেখুন যেভাবে</h3>
                    <div class="jtv-live-ways-row">
                        @if($stream->youtube_url)<a class="jtv-live-way yt" href="{{ $stream->youtube_url }}" target="_blank" rel="noopener"><i class="fa-brands fa-youtube"></i> YouTube</a>@endif
                        @if($stream->facebook_url)<a class="jtv-live-way fb" href="{{ $stream->facebook_url }}" target="_blank" rel="noopener"><i class="fa-brands fa-facebook-f"></i> Facebook</a>@endif
                        @if($stream->website_url)<a class="jtv-live-way web" href="{{ $stream->website_url }}" target="_blank" rel="noopener"><i class="fa-solid fa-globe"></i> ওয়েবসাইট</a>@endif
                    </div>
                </div>
                @endif

                @if($stream->cta_title)
                <div class="jtv-live-cta">
                    <strong>{{ $stream->cta_title }}</strong>
                    <a href="#top" onclick="window.scrollTo({top:0,behavior:'smooth'});return false;">{{ $stream->cta_text ?: 'এখনই দেখুন' }} →</a>
                </div>
                @endif
            </aside>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
(function () {
    var stage = document.getElementById('jtvLiveStage');
    var fallback = document.getElementById('jtvLiveFallback');
    var pill = document.getElementById('jtvLivePill');
    var views = document.getElementById('jtvLiveViews');
    var backBtn = document.getElementById('jtvBackLive');
    var titleEl = document.getElementById('jtvLiveTitle');
    var liveHTML = stage.innerHTML;
    var livePill = pill.textContent, livePillOff = pill.classList.contains('is-off');
    var ytReady = false, ytQueue = [];

    function showFallback() { if (fallback) { fallback.hidden = false; } }
    function hideFallback() { if (fallback) { fallback.hidden = true; } }

    function loadYT(cb) {
        if (window.YT && YT.Player) { cb(); return; }
        ytQueue.push(cb);
        if (document.getElementById('jtvYtApi')) { return; }
        window.onYouTubeIframeAPIReady = function () { ytQueue.splice(0).forEach(function (fn) { fn(); }); };
        var yt = document.createElement('script');
        yt.id = 'jtvYtApi'; yt.src = 'https://www.youtube.com/iframe_api';
        document.head.appendChild(yt);
    }

    function attachVideo(video, src, type) {
        video.addEventListener('error', showFallback);
        var isHls = type === 'hls' || /\.m3u8(\?|$)/i.test(src);
        if (isHls && !video.canPlayType('application/vnd.apple.mpegurl')) {
            var go = function () {
                if (window.Hls && Hls.isSupported()) {
                    var hls = new Hls();
                    hls.on(Hls.Events.ERROR, function (e, data) { if (data && data.fatal) { showFallback(); } });
                    hls.loadSource(src); hls.attachMedia(video);
                } else { showFallback(); }
            };
            if (window.Hls) { go(); return; }
            var s = document.createElement('script');
            s.src = 'https://cdn.jsdelivr.net/npm/hls.js@1'; s.onload = go; s.onerror = showFallback;
            document.head.appendChild(s);
        } else {
            video.src = src;
        }
    }

    function watchYT(frame) {
        loadYT(function () { new YT.Player(frame.id, { events: { onError: showFallback } }); });
    }

    // Re-arm whatever the live stage currently contains.
    function initStage() {
        hideFallback();
        var video = stage.querySelector('video[data-src]');
        if (video) { attachVideo(video, video.dataset.src, video.dataset.type); }
        var frame = stage.querySelector('iframe[id]');
        if (frame && frame.src.indexOf('youtube.com') !== -1) { watchYT(frame); }
    }

    function youtubeId(url) {
        var m = url.match(/(?:youtu\.be\/|youtube\.com\/(?:watch\?(?:.*&)?v=|embed\/|live\/|shorts\/))([\w-]{11})/);
        return m ? m[1] : null;
    }

    // Recorded program in the main player (no LIVE badge).
    function playProgram(card) {
        var url = card.dataset.video;
        if (!url) { return; }
        var id = youtubeId(url);
        hideFallback();
        if (id) {
            stage.innerHTML = '<iframe id="jtvProgFrame" src="https://www.youtube.com/embed/' + id + '?autoplay=1&rel=0&enablejsapi=1&origin=' + encodeURIComponent(location.origin) + '" allow="autoplay; encrypted-media; picture-in-picture; fullscreen" allowfullscreen></iframe>';
            watchYT(document.getElementById('jtvProgFrame'));
        } else {
            stage.innerHTML = '<video controls playsinline autoplay' + (card.dataset.poster ? ' poster="' + card.dataset.poster + '"' : '') + '></video>';
            attachVideo(stage.querySelector('video'), url, '');
        }
        pill.hidden = true;
        if (views) { views.hidden = true; }
        backBtn.hidden = false;
        titleEl.textContent = card.dataset.title;
        document.querySelectorAll('.jtv-live-prog').forEach(function (c) { c.classList.toggle('is-playing', c === card); });
        document.querySelector('.jtv-live-player').scrollIntoView({ behavior: 'smooth', block: 'center' });
    }

    function backToLive() {
        stage.innerHTML = liveHTML;
        pill.hidden = false;
        if (views) { views.hidden = false; }
        backBtn.hidden = true;
        titleEl.textContent = titleEl.dataset.liveTitle;
        document.querySelectorAll('.jtv-live-prog').forEach(function (c) { c.classList.remove('is-playing'); });
        initStage();
        document.querySelector('.jtv-live-player').scrollIntoView({ behavior: 'smooth', block: 'center' });
    }

    backBtn.addEventListener('click', backToLive);
    document.querySelectorAll('.jtv-live-prog').forEach(function (card) {
        card.addEventListener('click', function () { card.dataset.video ? playProgram(card) : backToLive(); });
    });
    initStage();

    // Featured programs slider
    var root = document.getElementById('jtvLiveSlider');
    if (!root) return;
    var track = root.querySelector('.jtv-live-track');
    function step() { var c = track.querySelector('.jtv-live-prog'); return c ? c.getBoundingClientRect().width + 16 : 0; }
    root.querySelector('.prev').addEventListener('click', function () { track.scrollBy({ left: -step() }); });
    root.querySelector('.next').addEventListener('click', function () {
        if (track.scrollLeft >= track.scrollWidth - track.clientWidth - 2) { track.scrollTo({ left: 0 }); } else { track.scrollBy({ left: step() }); }
    });
})();
</script>
@endpush
