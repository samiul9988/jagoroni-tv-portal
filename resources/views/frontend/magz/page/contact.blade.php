@extends('frontend.magz.index')

{{-- reCAPTCHA is switched off for now. To enable it again: uncomment the two lines below, set the hidden
     #captchaCheck value back to {{ $captchaActive }} and replace the submit block with <x-captcha/>.
@push('scripts_head')
{!! NoCaptcha::renderJs() !!}
@endpush
--}}

@php
    $links = collect(json_decode(config('settings.links') ?: '[]'))->filter(fn ($l) => !empty($l->url));
    $address = collect([config('settings.street'), config('settings.city'), config('settings.state'), config('settings.country')])->filter()->implode(', ');
    $phone = config('settings.site_phone');
    $email = config('settings.site_email');
    $features = [
        ['fa-clock', 'দ্রুত সাড়া', 'আপনার বার্তার জবাব উত্তর দেওয়া আমাদের অগ্রাধিকার'],
        ['fa-shield-halved', 'নিরাপদ যোগাযোগ', 'আপনার তথ্য সম্পূর্ণ গোপন ও নিরাপদ থাকবে'],
        ['fa-users', 'সমর্থন টিম', 'অভিজ্ঞ ও দক্ষ টিম আপনার পাশে আছে'],
        ['fa-headset', 'সরাসরি যোগাযোগ', 'ফোন, ইমেইল বা সরাসরি এসে দেখা করুন'],
    ];
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

    body.skin-magz .jtv-ct { padding: 14px 0 44px; background: #eef4f0; }
    body.skin-magz .jtv-ct-wrap { width: 100%; box-sizing: border-box; padding: 0 clamp(12px, 2vw, 32px); }

    /* Hero banner */
    body.skin-magz .jtv-ct-hero { position: relative; display: flex; align-items: center; justify-content: space-between; gap: 20px; min-height: 150px; margin-bottom: 18px; padding: 22px 32px; border-radius: 12px; overflow: hidden; color: #fff; background: linear-gradient(110deg, #064b29 0%, #0b6b3a 55%, #0d8552 100%); }
    body.skin-magz .jtv-ct-hero::after { content: ''; position: absolute; top: 0; right: 0; bottom: 0; width: 34%; background: linear-gradient(115deg, transparent 0 30%, #d61f26 30% 34%, rgba(255,255,255,.1) 34% 100%); pointer-events: none; }
    body.skin-magz .jtv-ct-hero > * { position: relative; z-index: 1; }
    body.skin-magz .jtv-ct-crumb { display: flex; flex-wrap: wrap; gap: 6px; margin: 0 0 8px; padding: 0; list-style: none; font-size: 12px; color: rgba(255,255,255,.8); }
    body.skin-magz .jtv-ct-crumb a { color: inherit; text-decoration: none; }
    body.skin-magz .jtv-ct-crumb li + li::before { content: '›'; margin-right: 6px; }
    body.skin-magz .jtv-ct-hero h1 { margin: 0 0 4px; color: #fff; font-size: clamp(30px, 4vw, 46px); font-weight: 800; line-height: 1.1; }
    body.skin-magz .jtv-ct-hero p.sub { margin: 0; color: rgba(255,255,255,.85); font-size: 15px; }
    body.skin-magz .jtv-ct-hero-right { display: flex; align-items: center; gap: 22px; text-align: right; }
    body.skin-magz .jtv-ct-hero-right p { margin: 0; max-width: 260px; font-size: 16px; font-weight: 700; line-height: 1.6; }
    body.skin-magz .jtv-ct-mail { display: grid; place-items: center; width: 92px; height: 92px; flex: none; border-radius: 18px; background: rgba(255,255,255,.95); color: #0b6b3a; font-size: 42px; transform: rotate(-6deg); box-shadow: 0 10px 24px rgba(0,0,0,.2); }

    body.skin-magz .jtv-ct-grid { display: grid; grid-template-columns: minmax(280px, 400px) minmax(0, 1fr); gap: 18px; align-items: stretch; }
    body.skin-magz .jtv-ct-card { padding: 22px; border: 1px solid #d9e8df; border-radius: 12px; background: #fff; box-shadow: 0 4px 16px rgba(13, 68, 42, .06); }
    body.skin-magz .jtv-ct-card h2 { display: flex; align-items: center; gap: 10px; margin: 0 0 8px; color: #12281c; font-size: 20px; font-weight: 800; }
    body.skin-magz .jtv-ct-card h2 i { display: grid; place-items: center; width: 34px; height: 34px; border-radius: 50%; background: #0b6b3a; color: #fff; font-size: 15px; }
    body.skin-magz .jtv-ct-lead { margin: 0 0 16px; color: #5a6a61; font-size: 13px; line-height: 1.7; }

    body.skin-magz .jtv-ct-info { display: flex; flex-direction: column; margin: 0 !important; }
    body.skin-magz .jtv-ct-row { display: flex; gap: 14px; padding: 14px 0; border-top: 1px solid #edf1ee; }
    body.skin-magz .jtv-ct-row:first-of-type { border-top: 0; }
    body.skin-magz .jtv-ct-ic { flex: none; display: grid; place-items: center; width: 38px; height: 38px; border-radius: 50%; background: #0b6b3a; color: #fff; font-size: 15px; }
    body.skin-magz .jtv-ct-ic.red { background: #d61f26; }
    body.skin-magz .jtv-ct-row .jtv-ct-ic, body.skin-magz .jtv-ct-row .jtv-ct-ic i { color: #fff !important; }
    body.skin-magz .jtv-ct-ic i { font-size: 16px; line-height: 1; }
    body.skin-magz .jtv-ct-row strong { display: block; margin-bottom: 3px; color: #12281c; font-size: 14px; font-weight: 800; }
    body.skin-magz .jtv-ct-row span, body.skin-magz .jtv-ct-row a { color: #46584e; font-size: 13px; line-height: 1.7; text-decoration: none; word-break: break-word; }
    body.skin-magz .jtv-ct-row small { display: block; color: #8a968f; font-size: 11px; }
    body.skin-magz .jtv-ct-social { display: flex; gap: 8px; margin-top: 8px; flex-wrap: wrap; }
    body.skin-magz .jtv-ct-social a { display: grid; place-items: center; width: 34px; height: 34px; border-radius: 50%; color: #fff; font-size: 14px; background: #0b6b3a; transition: transform .2s; }
    body.skin-magz .jtv-ct-social a:hover { transform: translateY(-2px); }

    /* Form (keeps the ids used by the existing AJAX submit) */
    body.skin-magz .jtv-ct-form { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 12px 14px; }
    body.skin-magz .jtv-ct-form .full { grid-column: 1 / -1; }
    body.skin-magz .jtv-ct-field { position: relative; }
    body.skin-magz .jtv-ct-field > i { position: absolute; top: 15px; left: 13px; color: #7a877f; font-size: 14px; pointer-events: none; }
    body.skin-magz .jtv-ct-field .form-control { width: 100%; height: 46px; padding: 0 12px 0 38px; border: 1px solid #d5e3da; border-radius: 6px; background: #fff; color: #17231c; font-size: 14px; box-shadow: none; }
    body.skin-magz .jtv-ct-field textarea.form-control { height: 150px; padding-top: 12px; resize: vertical; }
    body.skin-magz .jtv-ct-field .form-control:focus { border-color: #0b6b3a; box-shadow: 0 0 0 3px rgba(11, 107, 58, .12); outline: 0; }
    body.skin-magz .jtv-ct-field .form-control.is-invalid { border-color: #d61f26; }
    body.skin-magz .jtv-ct-field .invalid-feedback { display: block; margin-top: 3px; color: #d61f26; font-size: 12px; }
    body.skin-magz .jtv-ct-field .invalid-feedback:empty { display: none; }
    body.skin-magz .jtv-ct-form .col-xl-12 { grid-column: 1 / -1; padding: 0; margin: 0 !important; width: auto; max-width: none; }
    body.skin-magz .jtv-ct-form .col-xl-12:last-child { display: flex; justify-content: flex-end; }
    body.skin-magz .jtv-ct-form .btn.btn-primary { display: inline-flex; align-items: center; gap: 9px; padding: 12px 34px; border: 0; border-radius: 6px; background: #0b6b3a; color: #fff; font-size: 15px; font-weight: 800; }
    body.skin-magz .jtv-ct-form .btn.btn-primary::before { content: '\f1d8'; font-family: 'Font Awesome 6 Free'; font-weight: 900; }
    body.skin-magz .jtv-ct-form .btn.btn-primary:hover { background: #087342; }

    /* Equal-height cards: the form fills the card, so its bottom lines up with the contact card. */
    body.skin-magz .jtv-ct-grid > .jtv-ct-card { display: flex; flex-direction: column; }
    body.skin-magz .jtv-ct-grid > .jtv-ct-card > .jtv-ct-form { flex: 1 1 auto; grid-template-rows: auto auto minmax(150px, 1fr) auto; align-content: stretch; }
    /* The textarea is taken out of the flow so it stretches to the free space but never makes the card taller. */
    body.skin-magz .jtv-ct-form .form-group-message { position: relative; min-height: 150px; }
    body.skin-magz .jtv-ct-form .form-group-message textarea.form-control { position: absolute; top: 0; right: 0; bottom: 0; left: 0; width: 100%; height: 100%; min-height: 0; resize: none; }
    body.skin-magz .jtv-ct-form .form-group-message .invalid-feedback { position: absolute; left: 0; bottom: -20px; }
    body.skin-magz .jtv-ct-form .col-xl-12:last-child { align-self: end; }
    @media (max-width: 991px) { body.skin-magz .jtv-ct-grid > .jtv-ct-card > .jtv-ct-form { grid-template-rows: none; } }

    /* Map */
    body.skin-magz .jtv-ct-map { margin-top: 18px; overflow: hidden; border: 1px solid #d9e8df; border-radius: 12px; background: #fff; }
    body.skin-magz .jtv-ct-map section.maps { margin: 0; }
    body.skin-magz .jtv-ct-map iframe { display: block; width: 100%; height: 360px; border: 0; }

    /* Feature strip */
    body.skin-magz .jtv-ct-feats { display: grid; grid-template-columns: repeat(4, minmax(0, 1fr)); margin-top: 18px; padding: 8px 0; border: 1px solid #d9e8df; border-radius: 12px; background: linear-gradient(135deg, #f4faf6, #e6f2ea); }
    body.skin-magz .jtv-ct-feat { display: flex; align-items: center; gap: 14px; padding: 14px 22px; }
    body.skin-magz .jtv-ct-feat + .jtv-ct-feat { border-left: 1px solid #cfe1d6; }
    body.skin-magz .jtv-ct-feat i { flex: none; display: grid; place-items: center; width: 46px; height: 46px; border: 2px solid #0b6b3a; border-radius: 50%; color: #0b6b3a; font-size: 19px; }
    body.skin-magz .jtv-ct-feat strong { display: block; color: #12281c; font-size: 15px; font-weight: 800; }
    body.skin-magz .jtv-ct-feat span { color: #5a6a61; font-size: 12px; line-height: 1.5; }

    @media (max-width: 1100px) { body.skin-magz .jtv-ct-feats { grid-template-columns: repeat(2, minmax(0, 1fr)); } body.skin-magz .jtv-ct-feat:nth-child(3) { border-left: 0; } }
    @media (max-width: 991px) { body.skin-magz .jtv-ct-grid { grid-template-columns: 1fr; } body.skin-magz .jtv-ct-hero::after { display: none; } }
    @media (max-width: 640px) {
        body.skin-magz .jtv-ct-hero { flex-direction: column; align-items: flex-start; padding: 18px; }
        body.skin-magz .jtv-ct-hero-right { text-align: left; }
        body.skin-magz .jtv-ct-mail { width: 64px; height: 64px; font-size: 28px; }
        body.skin-magz .jtv-ct-form { grid-template-columns: 1fr; }
        body.skin-magz .jtv-ct-feats { grid-template-columns: 1fr; }
        body.skin-magz .jtv-ct-feat + .jtv-ct-feat { border-left: 0; border-top: 1px solid #cfe1d6; }
        body.skin-magz .jtv-ct-form .col-xl-12:last-child { justify-content: stretch; }
        body.skin-magz .jtv-ct-form .btn.btn-primary { width: 100%; justify-content: center; }
        body.skin-magz .jtv-ct-map iframe { height: 260px; }
    }
</style>
@endpush

@section('content')
<section class="jtv-ct">
    <div class="jtv-ct-wrap">
        <div class="jtv-ct-hero">
            <div>
                <ul class="jtv-ct-crumb">
                    <li><a href="{{ url('/') }}"><i class="fa-solid fa-house"></i> {{ __('jagoronitv::magz.home') }}</a></li>
                    <li>{{ __('jagoronitv::magz.contact_us') }}</li>
                </ul>
                <h1>{{ __('jagoronitv::magz.contact_us') }}</h1>
                <p class="sub">We'd love to hear from you</p>
            </div>
            <div class="jtv-ct-hero-right">
                <p>আপনার মতামত, পরামর্শ ও সহযোগিতা আমাদের জন্য খুবই গুরুত্বপূর্ণ।</p>
                <span class="jtv-ct-mail"><i class="fa-regular fa-envelope"></i></span>
            </div>
        </div>

        <div class="jtv-ct-grid">
            @if($contactInformation)
            <aside class="jtv-ct-card jtv-ct-info">
                <h2><i class="fa-solid fa-headset"></i> আমাদের সাথে যোগাযোগ</h2>
                @if(config('settings.contact_description') && Arr::exists(json_decode(config('settings.contact_description'), true), LaravelLocalization::getCurrentLocale()))
                    <p class="jtv-ct-lead">{{ json_decode(config('settings.contact_description'), true)[LaravelLocalization::getCurrentLocale()] }}</p>
                @else
                    <p class="jtv-ct-lead">যেকোনো প্রয়োজনে আমাদের সাথে যোগাযোগ করতে পারেন। আপনার মতামত ও পরামর্শ আমাদের কাছে গুরুত্বপূর্ণ।</p>
                @endif
                @if($phone)<div class="jtv-ct-row"><span class="jtv-ct-ic"><i class="fa-solid fa-phone"></i></span><div><strong>ফোন</strong><a href="tel:{{ preg_replace('/\s+/', '', $phone) }}">{{ $phone }}</a>@if(config('settings.contact_hours'))<small>{{ config('settings.contact_hours') }}</small>@endif</div></div>@endif
                @if($email)<div class="jtv-ct-row"><span class="jtv-ct-ic red"><i class="fa-regular fa-envelope"></i></span><div><strong>ই-মেইল</strong><a href="mailto:{{ $email }}">{{ $email }}</a></div></div>@endif
                @if($address)<div class="jtv-ct-row"><span class="jtv-ct-ic"><i class="fa-solid fa-location-dot"></i></span><div><strong>ঠিকানা</strong><span>{{ $address }}@if(config('settings.postal_code')) - {{ config('settings.postal_code') }}@endif</span></div></div>@endif
                @if($links->isNotEmpty())
                <div class="jtv-ct-row"><span class="jtv-ct-ic"><i class="fa-solid fa-share-nodes"></i></span><div><strong>সোশ্যাল মিডিয়া</strong>
                    <div class="jtv-ct-social">
                        @foreach($links as $link)<a href="{{ $link->url }}" target="_blank" rel="noopener" aria-label="{{ $link->name ?? '' }}" @if(!empty($link->color)) style="background: {{ $link->color }}" @endif><i class="{{ $link->icon ?? 'fa-solid fa-link' }}"></i></a>@endforeach
                    </div></div></div>
                @endif
            </aside>
            @endif

            <div class="jtv-ct-card" @if(!$contactInformation) style="grid-column: 1 / -1" @endif>
                <h2><i class="fa-solid fa-paper-plane"></i> মেসেজ পাঠান</h2>
                <p class="jtv-ct-lead">আপনার প্রশ্ন বা মতামত জানাতে নিচের ফর্মটি পূরণ করুন। আমরা যত দ্রুত সম্ভব যোগাযোগ করব।</p>
                <form class="jtv-ct-form contact" id="contact-form" method="POST" data-recaptcha="true">
                    <input type="hidden" id="captchaCheck" value="0">
                    <div class="jtv-ct-field form-group-name">
                        <i class="fa-regular fa-user"></i>
                        <input id="name" type="text" class="form-control" name="name" placeholder="আপনার নাম *" required>
                        <div id="msg-error-name" class="invalid-feedback"></div>
                    </div>
                    <div class="jtv-ct-field form-group-email">
                        <i class="fa-regular fa-envelope"></i>
                        <input id="email" type="text" class="form-control" name="email" placeholder="ই-মেইল ঠিকানা *" required>
                        <div id="msg-error-email" class="invalid-feedback"></div>
                    </div>
                    <div class="jtv-ct-field form-group-phone">
                        <i class="fa-solid fa-phone"></i>
                        <input id="phone" type="text" class="form-control" name="phone" placeholder="মোবাইল নাম্বার">
                        <div id="msg-error-phone" class="invalid-feedback"></div>
                    </div>
                    <div class="jtv-ct-field form-group-subject">
                        <i class="fa-regular fa-comment-dots"></i>
                        <select id="subject" class="form-control" name="subject">
                            <option value="">বিষয় নির্বাচন করুন</option>
                            <option>সংবাদ সংক্রান্ত</option>
                            <option>বিজ্ঞাপন</option>
                            <option>মতামত / পরামর্শ</option>
                            <option>কারিগরি সমস্যা</option>
                            <option>অন্যান্য</option>
                        </select>
                        <div id="msg-error-subject" class="invalid-feedback"></div>
                    </div>
                    <div class="jtv-ct-field form-group-message full">
                        <i class="fa-regular fa-pen-to-square"></i>
                        <textarea id="message" class="form-control" name="message" placeholder="আপনার বার্তা লিখুন…" required></textarea>
                        <div id="msg-error-message" class="invalid-feedback"></div>
                    </div>
                    {{-- <x-captcha/> (reCAPTCHA disabled for now) --}}
                    <div class="col-xl-12"><button type="submit" class="btn btn-primary">বার্তা পাঠান</button></div>
                </form>
            </div>
        </div>

        <div class="jtv-ct-map">
            @if(config('settings.contact_map_embed'))
                <section class="maps"><iframe src="{{ config('settings.contact_map_embed') }}" width="100%" height="360" style="border:0" allowfullscreen loading="lazy" referrerpolicy="no-referrer-when-downgrade" title="Map"></iframe></section>
            @else
                <x-map/>
            @endif
        </div>

        <div class="jtv-ct-feats">
            @foreach($features as [$icon, $title, $text])
                <div class="jtv-ct-feat"><i class="fa-solid {{ $icon }}"></i><div><strong>{{ $title }}</strong><span>{{ $text }}</span></div></div>
            @endforeach
        </div>
    </div>
</section>
@stop
