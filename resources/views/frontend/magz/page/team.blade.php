@extends('frontend.magz.index')

@php
    $initial = fn ($name) => mb_substr(trim($name), 0, 1);
    $socials = ['facebook' => 'fa-brands fa-facebook-f', 'twitter' => 'fa-brands fa-x-twitter', 'linkedin' => 'fa-brands fa-linkedin-in'];
    $facts = $leader ? [
        ['fa-graduation-cap', 'শিক্ষাগত যোগ্যতা', $leader->education],
        ['fa-briefcase', 'পেশা', $leader->profession],
        ['fa-award', 'অভিজ্ঞতা', $leader->experience],
        ['fa-location-dot', 'অবস্থান', $leader->location],
        ['fa-handshake', $leader->motto ? '' : '', $leader->motto],
    ] : [];
    $goals = [
        ['fa-file-lines', 'নিরপেক্ষ', 'সংবাদ পরিবেশন'],
        ['fa-users', 'জনগণের', 'কণ্ঠস্বর তুলে ধরা'],
        ['fa-shield-halved', 'সত্যতা ও', 'সঠিক তথ্য ছড়িয়ে দেওয়া'],
        ['fa-globe', 'ডিজিটাল বাংলাদেশে', 'তথ্য প্রবাহে অগ্রণী ভূমিকা'],
    ];
@endphp

@push('styles')
@include('frontend.magz.inc._reference-header-styles')
@include('frontend.magz.inc._homepage-footer-styles')
<style>
    body.skin-magz.jtv-homepage.jtv-homepage.jtv-homepage nav.jtv-main-nav ul.nav-list > li.jtv-nav-home-link > a,
    body.skin-magz.jtv-homepage.jtv-homepage.jtv-homepage nav.jtv-main-nav ul.nav-list > li.jtv-nav-home-link:not(.active) > a {
        background: #d61f26 !important; color: #fff !important;
    }
    body.skin-magz.jtv-homepage.jtv-homepage.jtv-homepage nav.jtv-main-nav ul.nav-list > li:not(.jtv-nav-home-link):hover > a,
    body.skin-magz.jtv-homepage.jtv-homepage.jtv-homepage nav.jtv-main-nav ul.nav-list > li:not(.jtv-nav-home-link):focus-within > a,
    body.skin-magz.jtv-homepage.jtv-homepage.jtv-homepage nav.jtv-main-nav ul.nav-list > li:not(.jtv-nav-home-link) > a:hover,
    body.skin-magz.jtv-homepage.jtv-homepage.jtv-homepage nav.jtv-main-nav ul.nav-list > li:not(.jtv-nav-home-link).active > a,
    body.skin-magz.jtv-homepage.jtv-homepage.jtv-homepage nav.jtv-main-nav ul.nav-list > li:not(.jtv-nav-home-link).current-menu-item > a {
        color: #fff !important; background: #d61f26 !important;
    }

    body.skin-magz .jtv-team-page { padding: 16px 0 48px; background: #eef4f0; }
    body.skin-magz .jtv-team-container { width: 100%; box-sizing: border-box; padding: 0 clamp(12px, 2vw, 32px); }
    body.skin-magz .jtv-team-crumb { display: flex; flex-wrap: wrap; gap: 6px; margin: 0 0 16px; padding: 0; list-style: none; font-size: 13px; color: #667a70; }
    body.skin-magz .jtv-team-crumb a { color: inherit; text-decoration: none; }
    body.skin-magz .jtv-team-crumb li + li::before { content: '›'; margin-right: 6px; color: #9fb0a8; }

    body.skin-magz .jtv-team-card {
        border: 1px solid #d9e8df; border-radius: 12px; background: linear-gradient(135deg, #f4faf6, #e8f4ec);
        box-shadow: 0 6px 20px rgba(13, 68, 42, .06);
    }

    /* Leader */
    body.skin-magz .jtv-team-hero { display: grid; grid-template-columns: minmax(0, 1fr) minmax(260px, 340px); gap: 18px; margin-bottom: 20px; }
    body.skin-magz .jtv-team-leader { display: grid; grid-template-columns: clamp(220px, 30%, 320px) minmax(0, 1fr); overflow: hidden; }
    body.skin-magz .jtv-team-leader-photo { position: relative; align-self: start; width: 100%; aspect-ratio: 4 / 5; margin: 18px 0 18px 18px; width: calc(100% - 18px); border-radius: 10px; overflow: hidden; background: linear-gradient(160deg, #d9eadf, #bcd8c7); }
    body.skin-magz .jtv-team-leader-photo img { position: absolute; inset: 0; width: 100%; height: 100%; object-fit: contain; object-position: center; }
    body.skin-magz .jtv-team-leader-body { padding: 26px 28px; display: flex; flex-direction: column; justify-content: center; gap: 10px; }
    body.skin-magz .jtv-team-role-pill { align-self: flex-start; padding: 4px 14px; border: 1px solid #b8d9c4; border-radius: 999px; background: #fff; color: #087342; font-size: 12px; font-weight: 700; }
    body.skin-magz .jtv-team-leader h1 { margin: 0; color: #12281c; font-size: clamp(26px, 3vw, 38px); font-weight: 800; line-height: 1.2; }
    body.skin-magz .jtv-team-leader h2 { margin: 0; color: #087342; font-size: 17px; font-weight: 700; }
    body.skin-magz .jtv-team-leader p.bio { margin: 0; color: #46584e; font-size: 14px; line-height: 1.8; }
    body.skin-magz .jtv-team-quote { position: relative; margin: 6px 0 0; padding: 12px 0 0 34px; border-top: 1px solid #cfe1d6; color: #087342; font-size: 17px; font-weight: 700; line-height: 1.6; }
    body.skin-magz .jtv-team-quote::before { content: '\201C'; position: absolute; left: 0; top: 4px; color: #087342; font-size: 46px; line-height: 1; font-family: Georgia, serif; }
    body.skin-magz .jtv-team-quote small { display: block; margin-top: 4px; color: #667a70; font-size: 12px; font-weight: 500; text-align: right; }

    body.skin-magz .jtv-team-facts { padding: 22px; }
    body.skin-magz .jtv-team-facts h3 { margin: 0 0 14px; color: #12281c; font-size: 17px; font-weight: 800; }
    body.skin-magz .jtv-team-facts ul { margin: 0; padding: 0; list-style: none; }
    body.skin-magz .jtv-team-facts li { display: flex; gap: 12px; align-items: center; padding: 11px 0; border-bottom: 1px solid #d6e6dc; }
    body.skin-magz .jtv-team-facts li:last-child { border-bottom: 0; }
    body.skin-magz .jtv-team-facts li i { flex: none; width: 22px; color: #087342; font-size: 17px; text-align: center; }
    body.skin-magz .jtv-team-facts strong { display: block; color: #12281c; font-size: 14px; }
    body.skin-magz .jtv-team-facts span { color: #5a6a61; font-size: 13px; line-height: 1.5; }

    /* Goals */
    body.skin-magz .jtv-team-goals { display: grid; grid-template-columns: minmax(0, 1.3fr) repeat(4, minmax(0, 1fr)); gap: 0; align-items: center; margin-bottom: 22px; padding: 22px 8px; }
    body.skin-magz .jtv-team-goals-intro { padding: 0 22px; }
    body.skin-magz .jtv-team-goals-intro h3 { margin: 0 0 8px; color: #12281c; font-size: 20px; font-weight: 800; }
    body.skin-magz .jtv-team-goals-intro p { margin: 0; color: #46584e; font-size: 13px; line-height: 1.8; }
    body.skin-magz .jtv-team-goal { padding: 6px 14px; text-align: center; border-left: 1px solid #d0e2d7; }
    body.skin-magz .jtv-team-goal i { display: inline-flex; align-items: center; justify-content: center; width: 54px; height: 54px; margin-bottom: 8px; border-radius: 50%; background: #dff0e5; color: #087342; font-size: 22px; }
    body.skin-magz .jtv-team-goal strong { display: block; color: #12281c; font-size: 14px; }
    body.skin-magz .jtv-team-goal span { color: #5a6a61; font-size: 12px; }

    /* Team grid */
    body.skin-magz .jtv-team-section { padding: 22px; }
    body.skin-magz .jtv-team-section-head { display: flex; justify-content: space-between; align-items: flex-start; gap: 12px; flex-wrap: wrap; margin-bottom: 18px; }
    body.skin-magz .jtv-team-section-head h3 { margin: 0; color: #12281c; font-size: 20px; font-weight: 800; }
    body.skin-magz .jtv-team-section-head h3 i { margin-right: 8px; color: #087342; }
    body.skin-magz .jtv-team-section-head p { margin: 4px 0 0; color: #667a70; font-size: 13px; }
    body.skin-magz .jtv-team-slogan { color: #087342; font-size: 17px; font-weight: 800; }
    body.skin-magz .jtv-slider { position: relative; --per: 5; --gap: 16px; }
    body.skin-magz .jtv-slider-track {
        display: flex; gap: var(--gap); overflow-x: auto; scroll-snap-type: x mandatory; scroll-behavior: smooth;
        padding: 6px 2px 14px; scrollbar-width: none; cursor: grab; -webkit-overflow-scrolling: touch;
    }
    body.skin-magz .jtv-slider-track::-webkit-scrollbar { display: none; }
    body.skin-magz .jtv-slider-track.is-dragging { cursor: grabbing; scroll-snap-type: none; scroll-behavior: auto; user-select: none; }
    body.skin-magz .jtv-slider-track.is-dragging a { pointer-events: none; }
    body.skin-magz .jtv-slider-track .jtv-member { flex: 0 0 calc((100% - (var(--per) - 1) * var(--gap)) / var(--per)); scroll-snap-align: start; }
    body.skin-magz .jtv-slider-track img { -webkit-user-drag: none; user-select: none; }
    body.skin-magz .jtv-slider-btn {
        position: absolute; top: 40%; z-index: 3; display: inline-flex; align-items: center; justify-content: center;
        width: 44px; height: 44px; border: 0; border-radius: 50%; background: #fff; color: #087342; font-size: 16px;
        box-shadow: 0 6px 18px rgba(13, 68, 42, .25); cursor: pointer; transform: translateY(-50%); transition: all .2s;
    }
    body.skin-magz .jtv-slider-btn:hover { background: #087342; color: #fff; }
    body.skin-magz .jtv-slider-btn:disabled { opacity: .35; cursor: default; }
    body.skin-magz .jtv-slider-prev { left: -18px; }
    body.skin-magz .jtv-slider-next { right: -18px; }
    body.skin-magz .jtv-slider-dots { display: flex; justify-content: center; gap: 7px; margin-top: 4px; }
    body.skin-magz .jtv-slider-dots button { width: 8px; height: 8px; padding: 0; border: 0; border-radius: 999px; background: #b9d3c3; cursor: pointer; transition: all .25s; }
    body.skin-magz .jtv-slider-dots button.is-active { width: 24px; background: #087342; }
    body.skin-magz .jtv-member { overflow: hidden; border: 1px solid #d9e8df; border-radius: 10px; background: #fff; text-align: center; transition: transform .2s, box-shadow .2s; }
    body.skin-magz .jtv-member:hover { transform: translateY(-3px); box-shadow: 0 10px 22px rgba(13, 68, 42, .12); }
    body.skin-magz .jtv-member-photo { position: relative; aspect-ratio: 4 / 5; background: linear-gradient(160deg, #e3f0e8, #c9dfd0); }
    body.skin-magz .jtv-member-photo img { position: absolute; inset: 0; width: 100%; height: 100%; object-fit: contain; object-position: center; }
    body.skin-magz .jtv-member-initial { position: absolute; inset: 0; display: flex; align-items: center; justify-content: center; color: #087342; font-size: 56px; font-weight: 800; }
    body.skin-magz .jtv-member-body { padding: 12px 12px 14px; }
    body.skin-magz .jtv-member h4 { margin: 0 0 6px; color: #12281c; font-size: 16px; font-weight: 800; line-height: 1.35; }
    body.skin-magz .jtv-member-role { display: inline-block; padding: 3px 12px; border: 1px solid #b8d9c4; border-radius: 999px; background: #eaf5ee; color: #087342; font-size: 12px; font-weight: 700; }
    body.skin-magz .jtv-member p { margin: 8px 0 10px; color: #5a6a61; font-size: 12px; line-height: 1.6; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; }
    body.skin-magz .jtv-member-social { display: flex; justify-content: center; gap: 8px; }
    body.skin-magz .jtv-member-social a { display: inline-flex; align-items: center; justify-content: center; width: 26px; height: 26px; border-radius: 50%; background: #087342; color: #fff; font-size: 12px; text-decoration: none; transition: background .2s; }
    body.skin-magz .jtv-member-social a:hover { background: #d61f26; }
    body.skin-magz .jtv-team-empty { padding: 40px; text-align: center; color: #667a70; }

    @media (max-width: 1199px) {
        body.skin-magz .jtv-slider { --per: 4; }
        body.skin-magz .jtv-team-goals { grid-template-columns: repeat(4, minmax(0, 1fr)); row-gap: 14px; }
        body.skin-magz .jtv-team-goals-intro { grid-column: 1 / -1; }
        body.skin-magz .jtv-team-goal:first-of-type { border-left: 0; }
    }
    @media (max-width: 991px) {
        body.skin-magz .jtv-team-hero { grid-template-columns: 1fr; }
        body.skin-magz .jtv-slider { --per: 3; }
    }
    @media (max-width: 767px) {
        body.skin-magz .jtv-team-leader { grid-template-columns: 1fr; }
        body.skin-magz .jtv-team-leader-photo { width: min(320px, calc(100% - 36px)); margin: 18px auto 0; }
        body.skin-magz .jtv-team-goals { grid-template-columns: repeat(2, minmax(0, 1fr)); }
        body.skin-magz .jtv-team-goal { border-left: 0; }
        body.skin-magz .jtv-slider { --per: 2; --gap: 12px; }
        body.skin-magz .jtv-slider-prev { left: -8px; } body.skin-magz .jtv-slider-next { right: -8px; }
    }
    @media (max-width: 420px) {
        body.skin-magz .jtv-team-leader-body { padding: 18px; }
        body.skin-magz .jtv-team-section { padding: 14px; }
        body.skin-magz .jtv-slider { --per: 1; }
    }
</style>
@endpush

@section('content')
<section class="jtv-team-page">
    <div class="jtv-team-container">
        <ul class="jtv-team-crumb">
            <li><a href="{{ url('/') }}"><i class="fa-solid fa-house"></i> হোম</a></li>
            <li>আমাদের সম্পর্কে</li>
            <li>মালিক ও টিম</li>
        </ul>

        @if($leader)
        <div class="jtv-team-hero">
            <article class="jtv-team-card jtv-team-leader">
                <div class="jtv-team-leader-photo">
                    @if($leader->photo)
                        <img src="{{ $leader->photo_url }}" alt="{{ $leader->name }}">
                    @else
                        <span class="jtv-member-initial">{{ $initial($leader->name) }}</span>
                    @endif
                </div>
                <div class="jtv-team-leader-body">
                    <span class="jtv-team-role-pill">{{ $leader->designation }}</span>
                    <h1>{{ $leader->name }}</h1>
                    @if($leader->profession)<h2>{{ $leader->profession }}</h2>@endif
                    @if($leader->bio)<p class="bio">{{ $leader->bio }}</p>@endif
                    @if($leader->quote)
                        <blockquote class="jtv-team-quote">{{ $leader->quote }}<small>— {{ $leader->name }}</small></blockquote>
                    @endif
                </div>
            </article>

            @if($leader->education || $leader->profession || $leader->experience || $leader->location || $leader->motto)
            <aside class="jtv-team-card jtv-team-facts">
                <h3>তার সম্পর্কে কিছু কথা</h3>
                <ul>
                    @if($leader->education)<li><i class="fa-solid fa-graduation-cap"></i><div><strong>শিক্ষাগত যোগ্যতা</strong><span>{{ $leader->education }}</span></div></li>@endif
                    @if($leader->profession)<li><i class="fa-solid fa-briefcase"></i><div><strong>পেশা</strong><span>{{ $leader->profession }}</span></div></li>@endif
                    @if($leader->experience)<li><i class="fa-solid fa-award"></i><div><strong>অভিজ্ঞতা</strong><span>{{ $leader->experience }}</span></div></li>@endif
                    @if($leader->location)<li><i class="fa-solid fa-location-dot"></i><div><strong>অবস্থান</strong><span>{{ $leader->location }}</span></div></li>@endif
                    @if($leader->motto)<li><i class="fa-solid fa-handshake"></i><div><strong>{{ $leader->motto }}</strong></div></li>@endif
                </ul>
            </aside>
            @endif
        </div>
        @endif

        <div class="jtv-team-card jtv-team-goals">
            <div class="jtv-team-goals-intro">
                <h3>আমাদের লক্ষ্য ও উদ্দেশ্য</h3>
                <p>জাগরণী টিভি একটি ডিজিটাল সংবাদমাধ্যম, যা সত্য, ন্যায় ও জনগণের কণ্ঠস্বরকে সর্বোচ্চ গুরুত্ব দিয়ে কাজ করে। আমরা বিশ্বাস করি, স্বচ্ছতাই একটি সুস্থ সমাজ ও শক্তিশালী গণতন্ত্রের ভিত্তি।</p>
            </div>
            @foreach($goals as [$icon, $line1, $line2])
                <div class="jtv-team-goal"><i class="fa-solid {{ $icon }}"></i><strong>{{ $line1 }}</strong><span>{{ $line2 }}</span></div>
            @endforeach
        </div>

        <div class="jtv-team-card jtv-team-section">
            <div class="jtv-team-section-head">
                <div>
                    <h3><i class="fa-solid fa-user-group"></i>আমাদের টিম</h3>
                    <p>একটি শক্তিশালী টিমই গড়ে তোলে একটি সফল সংবাদমাধ্যম।</p>
                </div>
                <div class="jtv-team-slogan">“ একসাথে কাজ করি, সত্যের পক্ষে ”</div>
            </div>

            @if($team->count())
            <div class="jtv-slider" id="jtvTeamSlider" aria-roledescription="carousel">
            <button type="button" class="jtv-slider-btn jtv-slider-prev" aria-label="Previous"><i class="fa-solid fa-chevron-left"></i></button>
            <div class="jtv-slider-track">
                @foreach($team as $member)
                    <article class="jtv-member">
                        <div class="jtv-member-photo">
                            @if($member->photo)
                                <img src="{{ $member->photo_url }}" alt="{{ $member->name }}" loading="lazy">
                            @else
                                <span class="jtv-member-initial">{{ $initial($member->name) }}</span>
                            @endif
                        </div>
                        <div class="jtv-member-body">
                            <h4>{{ $member->name }}</h4>
                            <span class="jtv-member-role">{{ $member->designation }}</span>
                            @if($member->bio)<p>{{ $member->bio }}</p>@endif
                            @if($member->facebook || $member->twitter || $member->linkedin)
                            <div class="jtv-member-social">
                                @foreach($socials as $field => $icon)
                                    @if($member->$field)<a href="{{ $member->$field }}" target="_blank" rel="noopener" aria-label="{{ $field }}"><i class="{{ $icon }}"></i></a>@endif
                                @endforeach
                            </div>
                            @endif
                        </div>
                    </article>
                @endforeach
            </div>
            <button type="button" class="jtv-slider-btn jtv-slider-next" aria-label="Next"><i class="fa-solid fa-chevron-right"></i></button>
            <div class="jtv-slider-dots"></div>
            </div>
            @else
                <div class="jtv-team-empty">টিম সদস্যদের তথ্য শীঘ্রই যুক্ত করা হবে।</div>
            @endif
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
(function () {
    var root = document.getElementById('jtvTeamSlider');
    if (!root) return;
    var track = root.querySelector('.jtv-slider-track');
    var prev = root.querySelector('.jtv-slider-prev');
    var next = root.querySelector('.jtv-slider-next');
    var dotsBox = root.querySelector('.jtv-slider-dots');
    var timer = null, paused = false;

    function step() {
        var card = track.querySelector('.jtv-member');
        return card ? card.getBoundingClientRect().width + (parseFloat(getComputedStyle(track).columnGap) || 0) : 0;
    }
    function perView() { return Math.max(1, Math.round(track.clientWidth / (step() || 1))); }
    function pages() { return Math.max(1, Math.ceil(track.children.length / perView())); }
    function maxScroll() { return track.scrollWidth - track.clientWidth - 2; }

    function buildDots() {
        dotsBox.innerHTML = '';
        for (var i = 0; i < pages(); i++) {
            (function (n) {
                var b = document.createElement('button');
                b.type = 'button'; b.setAttribute('aria-label', 'Slide ' + (n + 1));
                b.addEventListener('click', function () { track.scrollTo({ left: n * perView() * step() }); restart(); });
                dotsBox.appendChild(b);
            })(i);
        }
        sync();
    }
    function sync() {
        var atEnd = track.scrollLeft >= maxScroll();
        var page = atEnd ? pages() - 1 : Math.round(track.scrollLeft / (perView() * step() || 1));
        Array.prototype.forEach.call(dotsBox.children, function (d, i) { d.classList.toggle('is-active', i === page); });
        var scrollable = maxScroll() > 0;
        prev.disabled = !scrollable || track.scrollLeft <= 2;
        next.disabled = !scrollable;
        root.classList.toggle('is-static', !scrollable);
        prev.style.display = next.style.display = dotsBox.style.display = scrollable ? '' : 'none';
    }
    function go(dir) {
        if (dir > 0 && track.scrollLeft >= maxScroll()) { track.scrollTo({ left: 0 }); return; }
        track.scrollBy({ left: dir * step() * perView() });
    }
    function start() { stop(); timer = setInterval(function () { if (!paused && maxScroll() > 0) go(1); }, 3200); }
    function stop() { if (timer) clearInterval(timer); }
    function restart() { start(); }

    prev.addEventListener('click', function () { go(-1); restart(); });
    next.addEventListener('click', function () { go(1); restart(); });
    track.addEventListener('scroll', function () { window.requestAnimationFrame(sync); });
    root.addEventListener('mouseenter', function () { paused = true; });
    root.addEventListener('mouseleave', function () { paused = false; });
    root.addEventListener('touchstart', function () { paused = true; }, { passive: true });
    root.addEventListener('touchend', function () { setTimeout(function () { paused = false; }, 2500); }, { passive: true });

    // Mouse drag to slide.
    var down = false, startX = 0, startLeft = 0, moved = false;
    track.addEventListener('pointerdown', function (e) {
        if (e.pointerType !== 'mouse') return;
        down = true; moved = false; startX = e.clientX; startLeft = track.scrollLeft;
    });
    window.addEventListener('pointermove', function (e) {
        if (!down) return;
        var dx = e.clientX - startX;
        if (Math.abs(dx) > 4) { moved = true; track.classList.add('is-dragging'); }
        if (moved) track.scrollLeft = startLeft - dx;
    });
    window.addEventListener('pointerup', function () {
        if (!down) return;
        down = false;
        if (moved) {
            track.classList.remove('is-dragging');
            var s = step() || 1;
            track.scrollTo({ left: Math.round(track.scrollLeft / s) * s });
            restart();
        }
    });

    window.addEventListener('resize', buildDots);
    buildDots(); start();
})();
</script>
@endpush
