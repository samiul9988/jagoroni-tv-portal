@inject('images', 'App\Helpers\ImageHelper')

@php
    $socialLinks = collect(json_decode(config('settings.links') ?: '[]'));
@endphp

<div class="jtv-topbar">
    <div class="jtv-topbar-inner">
        <div class="jtv-topbar-meta">
            <span class="jtv-date"><i class="fa-regular fa-calendar-days"></i> বুধবার, ১৭ সেপ্টেম্বর ২০২৫</span>
            <span class="jtv-dot">|</span>
            <span><i class="fa-regular fa-clock"></i> {{ now()->format('h:i A') }}</span>
        </div>
        <div class="jtv-topbar-title">বাংলাদেশ সরকারের অনলাইনভিত্তিক বেসরকারি টেলিভিশন চ্যানেল</div>
        <div class="jtv-topbar-actions">
            <ul class="jtv-topbar-social">
                @foreach($socialLinks->take(5) as $link)
                    <li><a href="{{ $link->url }}" target="_blank" rel="noopener" aria-label="{{ $link->name ?? 'social' }}"><i class="{{ $link->icon }}"></i></a></li>
                @endforeach
            </ul>
            <form action="{{ url('/search') }}" method="GET" class="jtv-topbar-search" autocomplete="off">
                <input type="text" name="q" placeholder="খুঁজুন..." aria-label="Search">
                <button type="submit" aria-label="search"><i class="fa-solid fa-magnifying-glass"></i></button>
            </form>
        </div>
    </div>
</div>

<div class="firstbar jtv-masthead">
    <div class="container-md jtv-masthead-inner">
        <a class="jtv-masthead-brand" href="{{ url('/') }}" aria-label="Jagoroni TV home">
            <img class="jtv-masthead-brand-mark" src="{{ $images::webLogoLight() }}" alt="Jagoroni TV">
            <span class="jtv-masthead-brand-copy">
                <strong>JAGORONI <b>TV</b></strong>
                <small>সত্যের পথে | জনগণের পাশে | দেশের জন্য</small>
            </span>
        </a>
        <div class="jtv-masthead-message">
            <strong>সত্যের পথে</strong>
            <span>জনগণের পাশে</span>
            <em>দেশের জন্য</em>
        </div>
        <div class="jtv-masthead-art" aria-hidden="true">
            <span class="jtv-art-sun"></span>
            <span class="jtv-art-wave jtv-art-wave-one"></span>
            <span class="jtv-art-wave jtv-art-wave-two"></span>
            <span class="jtv-art-wave jtv-art-wave-three"></span>
            <span class="jtv-art-monument"></span>
        </div>
    </div>
</div>

<!-- Start nav -->
<x-menu-header :localeId="$localeId"/>
<!-- End nav -->
