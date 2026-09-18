@extends('frontend.magz.index')

@inject('postHelper', 'App\Helpers\PostHelper')

@push('styles')
<style>
    body.skin-magz.jtv-homepage {
        background: #f4f6f5 !important;
    }

    body.skin-magz.jtv-homepage header.primary,
    body.skin-magz.jtv-homepage .jtv-topbar,
    body.skin-magz.jtv-homepage .firstbar.jtv-masthead {
        display: block !important;
    }

    body.skin-magz.jtv-homepage header.primary {
        background: #fff !important;
        box-shadow: 0 2px 14px rgba(0, 0, 0, .08) !important;
        padding: 0 !important;
        margin: 0 !important;
    }

    body.skin-magz.jtv-homepage .jtv-topbar {
        position: relative !important;
        z-index: 20 !important;
        display: flex !important;
        align-items: center !important;
        width: 100% !important;
        min-height: 46px !important;
        height: 46px !important;
        overflow: visible !important;
        background: #fff !important;
        color: #294739 !important;
        border-top: 1px solid #d8e1dc !important;
        border-bottom: 1px solid #e1eae5 !important;
    }

    body.skin-magz.jtv-homepage .jtv-topbar-inner {
        display: grid !important;
        position: relative !important;
        box-sizing: border-box !important;
        width: min(1440px, calc(100% - 30px)) !important;
        max-width: 1440px !important;
        margin: 0 auto !important;
        grid-template-columns: auto 1fr auto !important;
        gap: 14px !important;
        align-items: center !important;
        min-height: 46px !important;
        height: 46px !important;
        padding: 4px 0 !important;
        visibility: visible !important;
        opacity: 1 !important;
    }

    body.skin-magz.jtv-homepage .jtv-topbar-inner > .jtv-topbar-meta,
    body.skin-magz.jtv-homepage .jtv-topbar-inner > .jtv-topbar-title,
    body.skin-magz.jtv-homepage .jtv-topbar-inner > .jtv-topbar-actions {
        display: flex !important;
        visibility: visible !important;
        opacity: 1 !important;
    }

    body.skin-magz.jtv-homepage .jtv-topbar-meta,
    body.skin-magz.jtv-homepage .jtv-topbar-title,
    body.skin-magz.jtv-homepage .jtv-topbar-actions {
        visibility: visible !important;
        opacity: 1 !important;
    }

    body.skin-magz.jtv-homepage .jtv-topbar-meta,
    body.skin-magz.jtv-homepage .jtv-topbar-actions,
    body.skin-magz.jtv-homepage .jtv-topbar-social {
        display: flex !important;
        align-items: center !important;
    }

    body.skin-magz.jtv-homepage .jtv-topbar-meta {
        gap: 8px !important;
        white-space: nowrap !important;
        color: #4e665a !important;
        font-size: 12px !important;
    }

    body.skin-magz.jtv-homepage .jtv-topbar-title {
        color: #314d40 !important;
        font-size: 12px !important;
        font-weight: 700 !important;
        text-align: center !important;
        white-space: nowrap !important;
        overflow: hidden !important;
        text-overflow: ellipsis !important;
        padding : 5px;
    }

    body.skin-magz.jtv-homepage .jtv-topbar-actions {
        display: flex !important;
        min-width: 285px !important;
        justify-content: flex-end !important;
        gap: 10px !important;
        height: 34px !important;
    }

    body.skin-magz.jtv-homepage .jtv-topbar-social {
        gap: 8px !important;
        margin: 0 !important;
        padding: 0 !important;
        list-style: none !important;
    }

    body.skin-magz.jtv-homepage .jtv-topbar-social a {
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        width: 18px !important;
        height: 18px !important;
        color: #1d3d2e !important;
        font-size: 12px !important;
        text-decoration: none !important;
    }

    body.skin-magz.jtv-homepage .jtv-topbar-search {
        display: flex !important;
        position: relative !important;
        z-index: 25 !important;
        align-items: center !important;
        flex: 0 0 190px !important;
        width: 190px !important;
        height: 30px !important;
        box-sizing: border-box !important;
        overflow: hidden !important;
        border: 1px solid #b9c9bf !important;
        border-radius: 2px !important;
        background: #fff !important;
        visibility: visible !important;
        opacity: 1 !important;
    }

    body.skin-magz.jtv-homepage header.primary > .jtv-topbar {
        display: flex !important;
        visibility: visible !important;
        opacity: 1 !important;
    }

    body.skin-magz.jtv-homepage header.primary > .jtv-topbar > .jtv-topbar-inner {
        display: grid !important;
        visibility: visible !important;
        opacity: 1 !important;
    }

    body.skin-magz.jtv-homepage .jtv-topbar-search input {
        flex: 1 1 auto !important;
        width: auto !important;
        height: 28px !important;
        min-width: 0 !important;
        box-sizing: border-box !important;
        padding: 0 10px !important;
        border: 0 !important;
        outline: 0 !important;
        color: #284638 !important;
        font-size: 12px !important;
        background: transparent !important;
    }

    body.skin-magz.jtv-homepage .jtv-topbar-search button {
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        flex: 0 0 34px !important;
        width: 34px !important;
        min-width: 34px !important;
        height: 30px !important;
        margin: 0 !important;
        padding: 0 !important;
        box-sizing: border-box !important;
        line-height: 1 !important;
        border: 0 !important;
        color: #fff !important;
        background: #d71e27 !important;
    }

    body.skin-magz.jtv-homepage .jtv-topbar-search button i {
        display: inline-block !important;
        color: #fff !important;
        font-size: 13px !important;
        line-height: 1 !important;
    }

    body.skin-magz.jtv-homepage .firstbar.jtv-masthead {
        display: block !important;
        width: 100% !important;
        min-height: 94px !important;
        padding: 8px 0 9px !important;
        border-bottom: 0 !important;
        background:
            radial-gradient(circle at 36% 30%, rgba(11, 107, 58, .08), transparent 24%),
            linear-gradient(180deg, #ffffff 0%, #f8fbf9 100%) !important;
    }

    body.skin-magz.jtv-homepage .jtv-masthead-inner {
        display: grid !important;
        width: min(1440px, calc(100% - 30px)) !important;
        max-width: 1440px !important;
        margin: 0 auto !important;
        grid-template-columns: minmax(240px, 340px) 1fr 300px !important;
        gap: 18px !important;
        align-items: center !important;
    }

    body.skin-magz.jtv-homepage .jtv-masthead-brand img {
        display: block !important;
    }

    body.skin-magz.jtv-homepage .jtv-masthead-brand {
        display: flex !important;
        flex-direction: row !important;
        align-items: flex-start !important;
        justify-content: center !important;
        gap: 8px !important;
        text-decoration: none !important;
    }

    body.skin-magz.jtv-homepage .jtv-masthead-brand-mark {
        width: 66px !important;
        height: 66px !important;
        max-width: 66px !important;
        object-fit: contain !important;
    }

    body.skin-magz.jtv-homepage .jtv-masthead-brand-copy {
        display: block !important;
        padding-top: 8px !important;
        text-align: left !important;
        white-space: nowrap !important;
    }

    body.skin-magz.jtv-homepage .jtv-masthead-brand-copy strong {
        display: block !important;
        color: #0b4f32 !important;
        font-family: Arial, Helvetica, sans-serif !important;
        font-size: 31px !important;
        font-weight: 800 !important;
        letter-spacing: -1.2px !important;
        line-height: .95 !important;
    }

    body.skin-magz.jtv-homepage .jtv-masthead-brand-copy strong b {
        color: #d9232e !important;
        font-weight: 800 !important;
    }

    body.skin-magz.jtv-homepage .jtv-masthead-brand-copy small {
        display: block !important;
        margin-top: 5px !important;
        color: #365d4a !important;
        font-family: "Noto Sans Bengali", Arial, sans-serif !important;
        font-size: 11px !important;
        font-weight: 700 !important;
        line-height: 1.2 !important;
    }

    body.skin-magz.jtv-homepage .jtv-masthead-message {
        color: #163a2b !important;
        font-family: "Noto Sans Bengali", Arial, sans-serif !important;
        font-size: 17px !important;
        font-weight: 800 !important;
        line-height: 1.4 !important;
        text-align: right !important;
    }

    body.skin-magz.jtv-homepage .jtv-masthead-message strong,
    body.skin-magz.jtv-homepage .jtv-masthead-message span,
    body.skin-magz.jtv-homepage .jtv-masthead-message em {
        display: block !important;
        font-style: normal !important;
    }

    body.skin-magz.jtv-homepage .jtv-masthead-art {
        position: relative !important;
        height: 88px !important;
        overflow: hidden !important;
    }

    body.skin-magz.jtv-homepage .jtv-art-sun {
        position: absolute;
        right: 46px;
        top: 18px;
        width: 34px;
        height: 34px;
        border-radius: 50%;
        background: radial-gradient(circle at 30% 30%, #ff8f81, #e2202c 70%, #b80f1a 100%);
        box-shadow: 0 0 0 8px rgba(226, 32, 44, .13);
    }

    body.skin-magz.jtv-homepage .jtv-art-wave {
        position: absolute;
        right: -10px;
        border-radius: 999px 0 0 999px;
        transform: rotate(-8deg);
    }

    body.skin-magz.jtv-homepage .jtv-art-wave-one {
        right: -12px;
        bottom: 8px;
        width: 190px;
        height: 18px;
        background: #0b6b3a;
    }

    body.skin-magz.jtv-homepage .jtv-art-wave-two {
        right: -16px;
        bottom: 19px;
        width: 178px;
        height: 12px;
        background: #f8faf9;
    }

    body.skin-magz.jtv-homepage .jtv-art-wave-three {
        right: -18px;
        bottom: 28px;
        width: 175px;
        height: 14px;
        background: #d61f26;
    }

    body.skin-magz.jtv-homepage .jtv-art-monument {
        position: absolute;
        right: 96px;
        bottom: 10px;
        width: 54px;
        height: 68px;
        background: linear-gradient(180deg, #3e6254, #18362b);
        clip-path: polygon(50% 0, 57% 14%, 62% 45%, 71% 100%, 53% 100%, 50% 57%, 47% 100%, 29% 100%, 38% 45%, 43% 14%);
    }

    body.skin-magz.jtv-homepage nav.jtv-main-nav {
        position: relative !important;
        z-index: 10 !important;
        display: block !important;
        width: 100% !important;
        min-height: 44px !important;
        height: 44px !important;
        overflow: hidden !important;
        border-top: 0 !important;
        border-bottom: 0 !important;
        background: #006b3f !important;
        background-image: none !important;
        background-color: #006b3f !important;
        box-shadow: none !important;
        border-radius: 0 !important;
    }

    body.skin-magz.jtv-homepage nav.jtv-main-nav::before,
    body.skin-magz.jtv-homepage nav.jtv-main-nav::after {
        display: none !important;
        content: none !important;
    }

    body.skin-magz.jtv-homepage nav.jtv-main-nav .jtv-nav-container {
        display: flex !important;
        width: min(1440px, calc(100% - 30px)) !important;
        max-width: 1440px !important;
        margin: 0 auto !important;
        padding: 0 !important;
        height: 44px !important;
        min-height: 44px !important;
        background: #006b3f !important;
        background-image: none !important;
        background-color: #006b3f !important;
        border: 0 !important;
        box-shadow: none !important;
        overflow: hidden !important;
    }

    body.skin-magz.jtv-homepage nav.jtv-main-nav .brand,
    body.skin-magz.jtv-homepage nav.jtv-main-nav ul.float-end,
    body.skin-magz.jtv-homepage nav.jtv-main-nav .mobile-toggle {
        display: none !important;
        width: 0 !important;
        min-width: 0 !important;
        padding: 0 !important;
    }

    body.skin-magz.jtv-homepage nav.jtv-main-nav #menu-list.jtv-nav-list-wrap,
    body.skin-magz.jtv-homepage nav.jtv-main-nav ul.nav-list {
        display: flex !important;
        align-items: center !important;
        justify-content: flex-start !important;
        flex: 1 1 auto !important;
        width: auto !important;
        max-width: none !important;
        margin: 0 !important;
        padding: 0 !important;
        height: 44px !important;
        min-height: 44px !important;
        background: #006b3f !important;
        border: 0 !important;
        box-shadow: none !important;
        background-color: #006b3f !important;
        background-repeat: no-repeat !important;
        overflow: hidden !important;
    }

    body.skin-magz.jtv-homepage nav.jtv-main-nav .jtv-nav-list-wrap > ul.nav-list {
        display: flex !important;
        flex: 0 0 max-content !important;
        width: max-content !important;
        min-width: 0 !important;
        justify-content: flex-start !important;
        background: #006b3f !important;
        background-image: none !important;
    }

    body.skin-magz.jtv-homepage nav.jtv-main-nav .jtv-nav-list-wrap {
        flex: 1 1 auto !important;
        min-width: 0 !important;
    }

    body.skin-magz.jtv-homepage nav.jtv-main-nav .jtv-nav-list-wrap > ul.nav-list > li:first-child {
        margin-left: 0 !important;
    }

    body.skin-magz.jtv-homepage nav.jtv-main-nav .jtv-nav-list-wrap,
    body.skin-magz.jtv-homepage nav.jtv-main-nav .jtv-nav-list-wrap > ul.nav-list,
    body.skin-magz.jtv-homepage nav.jtv-main-nav .jtv-nav-list-wrap > ul.nav-list > li {
        border-top: 0 !important;
        border-bottom: 0 !important;
        box-shadow: none !important;
    }

    body.skin-magz.jtv-homepage nav.jtv-main-nav ul.nav-list > li > a {
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        position: relative !important;
        height: 44px !important;
        padding: 0 14px !important;
        color: #fff !important;
        background: transparent !important;
        background-image: none !important;
        font-family: "Noto Sans Bengali", Arial, sans-serif !important;
        font-size: 15px !important;
        font-weight: 700 !important;
        line-height: 1 !important;
        text-decoration: none !important;
        transition: background-color .15s ease, color .15s ease !important;
    }

    body.skin-magz.jtv-homepage nav.jtv-main-nav ul.nav-list > li > a:hover,
    body.skin-magz.jtv-homepage nav.jtv-main-nav ul.nav-list > li > a:focus,
    body.skin-magz.jtv-homepage nav.jtv-main-nav ul.nav-list > li.active > a,
    body.skin-magz.jtv-homepage nav.jtv-main-nav ul.nav-list > li.current-menu-item > a,
    body.skin-magz.jtv-homepage nav.jtv-main-nav ul.nav-list > li.current_page_item > a {
        color: #fff !important;
        background: #d61f26 !important;
        background-image: none !important;
    }

    body.skin-magz.jtv-homepage nav.jtv-main-nav .jtv-nav-home-link a {
        display: flex !important;
        width: 44px !important;
        align-items: center !important;
        justify-content: center !important;
        padding: 0 !important;
        background: #d61f26 !important;
        background-image: none !important;
    }

    body.skin-magz.jtv-homepage nav.jtv-main-nav ul.nav-list > li::before,
    body.skin-magz.jtv-homepage nav.jtv-main-nav ul.nav-list > li::after,
    body.skin-magz.jtv-homepage nav.jtv-main-nav ul.nav-list > li > a::before,
    body.skin-magz.jtv-homepage nav.jtv-main-nav ul.nav-list > li > a::after {
        display: none !important;
        content: none !important;
    }

    body.skin-magz.jtv-homepage header.primary > nav.jtv-main-nav,
    body.skin-magz.jtv-homepage header.primary > nav.jtv-main-nav::before,
    body.skin-magz.jtv-homepage header.primary > nav.jtv-main-nav::after,
    body.skin-magz.jtv-homepage nav.jtv-main-nav .jtv-nav-container::before,
    body.skin-magz.jtv-homepage nav.jtv-main-nav .jtv-nav-container::after,
    body.skin-magz.jtv-homepage nav.jtv-main-nav #menu-list::before,
    body.skin-magz.jtv-homepage nav.jtv-main-nav #menu-list::after {
        background: #006b3f !important;
        background-image: none !important;
        border: 0 !important;
        box-shadow: none !important;
        content: none !important;
    }

    body.skin-magz.jtv-homepage main.jtv-home-clone {
        position: relative !important;
        z-index: 1 !important;
        padding: 12px 0 0 !important;
        background: #f3f5f4 !important;
    }

    body.skin-magz.jtv-homepage .jtv-home-shell {
        width: min(1440px, calc(100% - 30px)) !important;
        max-width: 1440px !important;
        margin: 0 auto !important;
    }

    body.skin-magz.jtv-homepage .jtv-home-hero-grid {
        display: grid !important;
        grid-template-columns: minmax(0, 2.1fr) minmax(330px, 1fr) minmax(300px, .92fr) !important;
        gap: 12px !important;
        margin-bottom: 12px !important;
    }

    body.skin-magz.jtv-homepage .jtv-home-lead,
    body.skin-magz.jtv-homepage .jtv-home-stack-card,
    body.skin-magz.jtv-homepage .jtv-home-latest-panel,
    body.skin-magz.jtv-homepage .jtv-home-video-block,
    body.skin-magz.jtv-homepage .jtv-home-side-widgets,
    body.skin-magz.jtv-homepage .jtv-home-topic-strip {
        border: 1px solid #d9e4de !important;
        border-radius: 6px !important;
        background: #fff !important;
        box-shadow: 0 2px 8px rgba(0, 0, 0, .04) !important;
        overflow: hidden !important;
    }

    body.skin-magz.jtv-homepage .jtv-home-lead-media {
        position: relative !important;
        display: block !important;
        height: 392px !important;
        min-height: 0 !important;
        overflow: hidden !important;
        isolation: isolate !important;
    }

    body.skin-magz.jtv-homepage .jtv-home-lead-media img {
        position: absolute !important;
        inset: 0 !important;
        width: 100% !important;
        height: 100% !important;
        object-fit: cover !important;
    }

    body.skin-magz.jtv-homepage .jtv-home-lead-overlay {
        position: absolute !important;
        inset: auto 0 0 0 !important;
        padding: 0 22px 20px !important;
        color: #fff !important;
        background: linear-gradient(180deg, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, .72) 65%, rgba(0, 0, 0, .84) 100%) !important;
        pointer-events: none !important;
    }

    body.skin-magz.jtv-homepage .jtv-home-badge {
        display: inline-flex !important;
        margin-bottom: 12px !important;
        padding: 4px 10px !important;
        border-radius: 4px !important;
        color: #fff !important;
        background: #d61f26 !important;
        font-size: 12px !important;
        font-weight: 800 !important;
    }

    body.skin-magz.jtv-homepage .jtv-home-lead-overlay h1 {
        margin: 0 !important;
        color: #fff !important;
        font-family: "Noto Sans Bengali", Arial, sans-serif !important;
        font-size: 25px !important;
        font-weight: 800 !important;
        line-height: 1.35 !important;
    }

    body.skin-magz.jtv-homepage .jtv-home-lead-overlay h1 a,
    body.skin-magz.jtv-homepage .jtv-home-stack-content h3 a,
    body.skin-magz.jtv-homepage .jtv-home-latest-item h3 a,
    body.skin-magz.jtv-homepage .jtv-home-video-list-item h4 a {
        color: inherit !important;
    }

    body.skin-magz.jtv-homepage .jtv-home-lead-overlay h1 a {
        position: relative !important;
        z-index: 2 !important;
        pointer-events: auto !important;
        text-decoration: none !important;
    }

    body.skin-magz.jtv-homepage .jtv-home-lead-body {
        padding: 16px 22px 18px !important;
    }

    body.skin-magz.jtv-homepage .jtv-home-lead-body p {
        margin: 0 0 14px !important;
        color: #4f5e57 !important;
        font-size: 14px !important;
        line-height: 1.7 !important;
    }

    body.skin-magz.jtv-homepage .jtv-home-meta,
    body.skin-magz.jtv-homepage .jtv-home-stack-submeta {
        display: flex !important;
        flex-wrap: wrap !important;
        gap: 14px !important;
        color: #7b8781 !important;
        font-size: 12px !important;
    }

    body.skin-magz.jtv-homepage .jtv-home-meta i,
    body.skin-magz.jtv-homepage .jtv-home-stack-submeta i,
    body.skin-magz.jtv-homepage .jtv-home-latest-item p i,
    body.skin-magz.jtv-homepage .jtv-home-video-list-item p i {
        color: #d61f26 !important;
        margin-right: 6px !important;
    }

    body.skin-magz.jtv-homepage .jtv-home-story-stack {
        display: grid !important;
        gap: 10px !important;
    }

    body.skin-magz.jtv-homepage .jtv-home-stack-card {
        display: grid !important;
        grid-template-columns: 112px minmax(0, 1fr) !important;
        gap: 10px !important;
    }

    body.skin-magz.jtv-homepage .jtv-home-stack-card img {
        width: 112px !important;
        height: 88px !important;
        object-fit: cover !important;
    }

    body.skin-magz.jtv-homepage .jtv-home-stack-content {
        padding: 8px 10px 8px 0 !important;
        min-width: 0 !important;
    }

    body.skin-magz.jtv-homepage .jtv-home-stack-content h3,
    body.skin-magz.jtv-homepage .jtv-home-latest-item h3,
    body.skin-magz.jtv-homepage .jtv-home-video-list-item h4 {
        margin: 0 0 6px !important;
        color: #1c392c !important;
        font-family: "Noto Sans Bengali", Arial, sans-serif !important;
        font-size: 14px !important;
        font-weight: 800 !important;
        line-height: 1.4 !important;
    }

    body.skin-magz.jtv-homepage .jtv-home-stack-submeta span:first-child {
        display: inline-block !important;
        padding: 1px 6px !important;
        border-radius: 3px !important;
        color: #fff !important;
        font-size: 10px !important;
        font-weight: 800 !important;
        line-height: 1.35 !important;
    }

    body.skin-magz.jtv-homepage .jtv-home-stack-submeta span:not(:first-child) {
        color: #7b8781 !important;
    }

    body.skin-magz.jtv-homepage .jtv-home-stack-card:nth-child(1) .jtv-home-stack-submeta span:first-child {
        background: #0d6d3c !important;
    }

    body.skin-magz.jtv-homepage .jtv-home-stack-card:nth-child(2) .jtv-home-stack-submeta span:first-child {
        background: #1d63a8 !important;
    }

    body.skin-magz.jtv-homepage .jtv-home-stack-card:nth-child(3) .jtv-home-stack-submeta span:first-child {
        background: #9b4dca !important;
    }

    body.skin-magz.jtv-homepage .jtv-home-stack-card:nth-child(4) .jtv-home-stack-submeta span:first-child {
        background: #d66b19 !important;
    }

    body.skin-magz.jtv-homepage .jtv-home-latest-tabs {
        display: grid !important;
        grid-template-columns: 1fr auto !important;
        align-items: center !important;
        min-height: 44px !important;
        border-bottom: 1px solid #dfe8e3 !important;
        position: relative !important;
        z-index: 2 !important;
    }

    body.skin-magz.jtv-homepage .jtv-home-latest-tab-buttons {
        display: flex !important;
    }

    body.skin-magz.jtv-homepage .jtv-home-latest-tab-buttons button {
        min-width: 126px !important;
        height: 44px !important;
        padding: 0 14px !important;
        border: 0 !important;
        color: #476154 !important;
        background: transparent !important;
        font-family: "Noto Sans Bengali", Arial, sans-serif !important;
        font-size: 14px !important;
        font-weight: 800 !important;
        cursor: pointer !important;
    }

    body.skin-magz.jtv-homepage .jtv-home-latest-tab-buttons button.is-active {
        color: #fff !important;
        background: #0c6b39 !important;
    }

    body.skin-magz.jtv-homepage .jtv-home-latest-more {
        padding: 0 14px !important;
        color: #355346 !important;
        font-size: 12px !important;
        font-weight: 700 !important;
        text-decoration: none !important;
    }

    body.skin-magz.jtv-homepage .jtv-home-latest-list {
        display: none !important;
        padding: 8px 18px !important;
    }

    body.skin-magz.jtv-homepage .jtv-home-latest-list.is-active {
        display: block !important;
    }

    body.skin-magz.jtv-homepage .jtv-home-latest-item {
        padding: 12px 0 !important;
        border-bottom: 1px solid #e4ebe7 !important;
    }

    body.skin-magz.jtv-homepage .jtv-home-latest-item:last-child {
        border-bottom: 0 !important;
    }

    body.skin-magz.jtv-homepage .jtv-home-latest-item p,
    body.skin-magz.jtv-homepage .jtv-home-video-list-item p {
        margin: 0 !important;
        color: #78837d !important;
        font-size: 11px !important;
    }

    body.skin-magz.jtv-homepage .jtv-home-topic-strip {
        display: grid !important;
        grid-template-columns: repeat(8, minmax(0, 1fr)) !important;
        justify-content: center !important;
        justify-items: stretch !important;
        align-items: stretch !important;
        align-content: center !important;
        box-sizing: border-box !important;
        width: 100% !important;
        max-width: 100% !important;
        min-height: 90px !important;
        height: 90px !important;
        padding: 0 !important;
        margin: 0 0 12px !important;
    }

    body.skin-magz.jtv-homepage .jtv-home-topic-link {
        display: flex !important;
        gap: 10px !important;
        align-items: center !important;
        justify-content: center !important;
        text-align: center !important;
        justify-self: stretch !important;
        align-self: center !important;
        height: 90px !important;
        min-height: 90px !important;
        box-sizing: border-box !important;
        padding: 0 8px !important;
        border-right: 1px solid #e4ebe7 !important;
        color: #0f5f35 !important;
        font-family: "Noto Sans Bengali", Arial, sans-serif !important;
        font-size: 14px !important;
        font-weight: 800 !important;
        text-decoration: none !important;
    }

    body.skin-magz.jtv-homepage .jtv-home-topic-link:last-child {
        border-right: 0 !important;
    }

    body.skin-magz.jtv-homepage .jtv-home-topic-link i {
        font-size: 20px !important;
    }

    body.skin-magz.jtv-homepage .jtv-home-lower-grid {
        display: grid !important;
        grid-template-columns: minmax(0, 2fr) minmax(300px, 1fr) !important;
        gap: 12px !important;
    }

    body.skin-magz.jtv-homepage .jtv-home-video-tabs {
        display: flex !important;
        flex-wrap: wrap !important;
        min-height: 42px !important;
        border-bottom: 1px solid #e2ebe6 !important;
    }

    body.skin-magz.jtv-homepage .jtv-home-video-tab {
        display: inline-flex !important;
        align-items: center !important;
        padding: 0 15px !important;
        color: #2c4a3b !important;
        font-family: "Noto Sans Bengali", Arial, sans-serif !important;
        font-size: 13px !important;
        font-weight: 700 !important;
        line-height: 42px !important;
        text-decoration: none !important;
    }

    body.skin-magz.jtv-homepage .jtv-home-video-tab.is-active {
        color: #fff !important;
        background: #d61f26 !important;
    }

    body.skin-magz.jtv-homepage .jtv-home-video-layout {
        display: grid !important;
        grid-template-columns: minmax(0, 1.42fr) minmax(230px, .95fr) !important;
        gap: 12px !important;
        padding: 10px !important;
    }

    body.skin-magz.jtv-homepage .jtv-home-video-feature-thumb {
        position: relative !important;
        display: block !important;
        border-radius: 6px !important;
        overflow: hidden !important;
    }

    body.skin-magz.jtv-homepage .jtv-home-video-feature-thumb img {
        width: 100% !important;
        height: 265px !important;
        object-fit: cover !important;
    }

    body.skin-magz.jtv-homepage .jtv-home-video-play {
        position: absolute !important;
        top: 50% !important;
        left: 50% !important;
        display: grid !important;
        width: 72px !important;
        height: 72px !important;
        place-items: center !important;
        border-radius: 50% !important;
        color: #fff !important;
        background: rgba(0, 0, 0, .65) !important;
        transform: translate(-50%, -50%) !important;
        font-size: 28px !important;
    }

    body.skin-magz.jtv-homepage .jtv-home-video-list {
        display: grid !important;
        gap: 10px !important;
    }

    body.skin-magz.jtv-homepage .jtv-home-video-list-item {
        display: grid !important;
        grid-template-columns: 112px minmax(0, 1fr) !important;
        gap: 10px !important;
    }

    body.skin-magz.jtv-homepage .jtv-home-video-list-item img {
        width: 112px !important;
        height: 70px !important;
        border-radius: 4px !important;
        object-fit: cover !important;
    }

    body.skin-magz.jtv-homepage .jtv-home-side-widgets {
        padding: 10px !important;
        display: grid !important;
        gap: 12px !important;
    }

    body.skin-magz.jtv-homepage .jtv-home-promo-card {
        position: relative !important;
        min-height: 118px !important;
        overflow: hidden !important;
        border-radius: 6px !important;
        background: linear-gradient(112deg, #056533 0%, #0f833f 44%, #d51f26 100%) !important;
    }

    body.skin-magz.jtv-homepage .jtv-home-promo-inner {
        position: relative !important;
        z-index: 1 !important;
        display: grid !important;
        grid-template-columns: 60px minmax(0, 1fr) !important;
        gap: 12px !important;
        align-items: center !important;
        height: 100% !important;
        padding: 18px !important;
        color: #fff !important;
    }

    body.skin-magz.jtv-homepage .jtv-home-promo-icon {
        display: grid !important;
        width: 60px !important;
        height: 60px !important;
        place-items: center !important;
        border-radius: 50% !important;
        background: rgba(0, 0, 0, .18) !important;
        font-size: 30px !important;
    }

    body.skin-magz.jtv-homepage .jtv-home-promo-inner strong,
    body.skin-magz.jtv-homepage .jtv-home-promo-inner span,
    body.skin-magz.jtv-homepage .jtv-home-promo-inner em {
        display: block !important;
        font-style: normal !important;
    }

    body.skin-magz.jtv-homepage .jtv-home-promo-inner strong {
        font-family: "Noto Sans Bengali", Arial, sans-serif !important;
        font-size: 24px !important;
        font-weight: 800 !important;
    }

    body.skin-magz.jtv-homepage .jtv-home-promo-inner em {
        margin-top: 6px !important;
        color: #ffe4b3 !important;
        font-weight: 800 !important;
    }

    body.skin-magz.jtv-homepage .jtv-home-connect-box h3 {
        margin: 0 0 10px !important;
        color: #13422d !important;
        font-family: "Noto Sans Bengali", Arial, sans-serif !important;
        font-size: 23px !important;
        font-weight: 800 !important;
    }

    body.skin-magz.jtv-homepage .jtv-home-connect-row {
        display: grid !important;
        grid-template-columns: minmax(0, 1fr) auto !important;
        gap: 10px !important;
        align-items: center !important;
    }

    body.skin-magz.jtv-homepage .jtv-home-connect-social {
        display: flex !important;
        flex-wrap: wrap !important;
        gap: 8px !important;
        margin: 0 !important;
        padding: 0 !important;
        list-style: none !important;
    }

    body.skin-magz.jtv-homepage .jtv-home-connect-social a {
        display: grid !important;
        width: 36px !important;
        height: 36px !important;
        place-items: center !important;
        border-radius: 50% !important;
        color: #fff !important;
        font-size: 16px !important;
        text-decoration: none !important;
    }

    body.skin-magz.jtv-homepage .jtv-home-connect-form {
        display: grid !important;
        grid-template-columns: minmax(0, 1fr) auto !important;
        overflow: hidden !important;
        border: 1px solid #d5e1db !important;
        border-radius: 4px !important;
    }

    body.skin-magz.jtv-homepage .jtv-home-connect-form input {
        height: 36px !important;
        padding: 0 10px !important;
        border: 0 !important;
        color: #234536 !important;
        font-size: 12px !important;
        background: #fff !important;
        outline: 0 !important;
    }

    body.skin-magz.jtv-homepage .jtv-home-connect-form button {
        width: 88px !important;
        border: 0 !important;
        color: #fff !important;
        background: #0a6b39 !important;
        font-size: 12px !important;
        font-weight: 700 !important;
    }

    body.skin-magz.jtv-homepage footer.footer {
        padding: 0 !important;
        border-top: 0 !important;
        background: #0d1f16 !important;
    }

    body.skin-magz.jtv-homepage .jtv-homepage-footer-bar {
        width: min(1140px, calc(100% - 30px)) !important;
        max-width: 1140px !important;
        margin: 0 auto !important;
        display: grid !important;
        grid-template-columns: auto 1fr auto !important;
        gap: 18px !important;
        align-items: center !important;
        min-height: 44px !important;
        color: rgba(255, 255, 255, .9) !important;
        font-size: 12px !important;
    }

    body.skin-magz.jtv-homepage .jtv-homepage-footer-copy {
        text-align: left !important;
    }

    body.skin-magz.jtv-homepage .jtv-homepage-footer-slogan {
        text-align: right !important;
    }

    body.skin-magz.jtv-homepage .jtv-homepage-footer-links {
        display: flex !important;
        justify-content: center !important;
        flex-wrap: wrap !important;
        gap: 16px !important;
        margin: 0 !important;
        padding: 0 !important;
        list-style: none !important;
    }

    body.skin-magz.jtv-homepage .jtv-homepage-footer-links a,
    body.skin-magz.jtv-homepage .jtv-homepage-footer-slogan {
        color: rgba(255, 255, 255, .85) !important;
        text-decoration: none !important;
    }

    @media (max-width: 1199px) {
        body.skin-magz.jtv-homepage .jtv-masthead-inner,
        body.skin-magz.jtv-homepage .jtv-home-hero-grid,
        body.skin-magz.jtv-homepage .jtv-home-lower-grid,
        body.skin-magz.jtv-homepage .jtv-homepage-footer-bar,
        body.skin-magz.jtv-homepage .jtv-topbar-inner {
            grid-template-columns: 1fr !important;
            justify-items: center !important;
            text-align: center !important;
        }

        body.skin-magz.jtv-homepage .jtv-home-topic-strip {
            grid-template-columns: repeat(4, minmax(0, 1fr)) !important;
            min-height: 90px !important;
            height: 90px !important;
        }

        body.skin-magz.jtv-homepage .jtv-homepage-footer-copy,
        body.skin-magz.jtv-homepage .jtv-homepage-footer-slogan {
            text-align: center !important;
        }
    }

    @media (max-width: 767px) {
        body.skin-magz.jtv-homepage .jtv-home-shell,
        body.skin-magz.jtv-homepage .jtv-homepage-footer-bar,
        body.skin-magz.jtv-homepage nav.jtv-main-nav .jtv-nav-container {
            width: 100% !important;
            max-width: none !important;
            margin: 0 !important;
            padding: 0 10px !important;
            box-sizing: border-box !important;
        }

        body.skin-magz.jtv-homepage nav.jtv-main-nav,
        body.skin-magz.jtv-homepage nav.jtv-main-nav .jtv-nav-container,
        body.skin-magz.jtv-homepage nav.jtv-main-nav #menu-list.jtv-nav-list-wrap {
            overflow-x: auto !important;
            overflow-y: hidden !important;
            scrollbar-width: none !important;
            flex: 1 1 auto !important;
            min-width: 0 !important;
        }

        body.skin-magz.jtv-homepage nav.jtv-main-nav::-webkit-scrollbar,
        body.skin-magz.jtv-homepage nav.jtv-main-nav .jtv-nav-container::-webkit-scrollbar,
        body.skin-magz.jtv-homepage nav.jtv-main-nav #menu-list.jtv-nav-list-wrap::-webkit-scrollbar {
            display: none !important;
        }

        body.skin-magz.jtv-homepage nav.jtv-main-nav ul.nav-list {
            flex: 0 0 max-content !important;
            width: max-content !important;
            min-width: 100% !important;
            flex-wrap: nowrap !important;
            justify-content: flex-start !important;
        }

        body.skin-magz.jtv-homepage nav.jtv-main-nav ul.nav-list > li > a {
            height: 44px !important;
            min-height: 44px !important;
            padding: 0 11px !important;
            font-size: 13px !important;
            white-space: nowrap !important;
        }

        body.skin-magz.jtv-homepage nav.jtv-main-nav .jtv-nav-home-link a {
            width: 42px !important;
            min-width: 42px !important;
            padding: 0 !important;
        }

        body.skin-magz.jtv-homepage .jtv-home-lead-media {
            height: 240px !important;
            min-height: 240px !important;
        }

        body.skin-magz.jtv-homepage .jtv-topbar-title {
            white-space: normal !important;
        }

        body.skin-magz.jtv-homepage .jtv-topbar-search input {
            width: 88px !important;
        }

        body.skin-magz.jtv-homepage .jtv-home-topic-strip {
            grid-template-columns: repeat(2, minmax(0, 1fr)) !important;
            min-height: 90px !important;
            height: auto !important;
        }

        body.skin-magz.jtv-homepage .jtv-home-topic-link {
            height: 70px !important;
            min-height: 70px !important;
        }

        body.skin-magz.jtv-homepage .jtv-home-latest-tabs,
        body.skin-magz.jtv-homepage .jtv-home-video-layout,
        body.skin-magz.jtv-homepage .jtv-home-connect-row {
            grid-template-columns: 1fr !important;
        }

        body.skin-magz.jtv-homepage .jtv-home-stack-card,
        body.skin-magz.jtv-homepage .jtv-home-video-list-item {
            grid-template-columns: 96px minmax(0, 1fr) !important;
        }

        body.skin-magz.jtv-homepage .jtv-home-stack-card img,
        body.skin-magz.jtv-homepage .jtv-home-video-list-item img {
            width: 96px !important;
        }

        body.skin-magz.jtv-homepage nav.jtv-main-nav .brand {
            display: flex !important;
        }

        body.skin-magz.jtv-homepage nav.jtv-main-nav ul.float-end {
            display: flex !important;
        }

        body.skin-magz.jtv-homepage nav.jtv-main-nav .mobile-toggle {
            display: flex !important;
        }
    }

    /* Keep the announcement centered in the full topbar, independent of the
       date block on the left and social/search controls on the right. */
    body.skin-magz.jtv-homepage .jtv-topbar-inner {
        display: flex !important;
        position: relative !important;
        grid-template-columns: none !important;
        justify-content: space-between !important;
    }

    body.skin-magz.jtv-homepage header.primary > .jtv-topbar > .jtv-topbar-inner {
        display: flex !important;
        flex-wrap: nowrap !important;
        justify-content: space-between !important;
    }

    body.skin-magz.jtv-homepage .jtv-topbar-title {
        position: absolute !important;
        top: 50% !important;
        left: 50% !important;
        z-index: 1 !important;
        width: min(440px, 42vw) !important;
        margin: 0 !important;
        padding: 4px 10px !important;
        overflow: hidden !important;
        color: #314d40 !important;
        text-align: center !important;
        text-overflow: ellipsis !important;
        white-space: nowrap !important;
        transform: translate(-50%, -50%) !important;
    }

    body.skin-magz.jtv-homepage .jtv-topbar-meta,
    body.skin-magz.jtv-homepage .jtv-topbar-actions {
        position: relative !important;
        z-index: 2 !important;
    }

    body.skin-magz.jtv-homepage .jtv-topbar-actions {
        flex: 0 0 auto !important;
        min-width: 285px !important;
        margin-left: auto !important;
        justify-content: flex-end !important;
    }

    /* Center the complete menu against the navbar, not only inside the space
       remaining after the logo. */
    @media (min-width: 768px) {
        body.skin-magz.jtv-homepage nav.jtv-main-nav .jtv-nav-container {
            position: relative !important;
        }

        body.skin-magz.jtv-homepage nav.jtv-main-nav #menu-list.jtv-nav-list-wrap {
            position: static !important;
            justify-content: initial !important;
        }

        body.skin-magz.jtv-homepage nav.jtv-main-nav ul.nav-list {
            position: absolute !important;
            top: 0 !important;
            left: 50% !important;
            display: flex !important;
            flex: 0 0 auto !important;
            width: max-content !important;
            height: 68px !important;
            justify-content: center !important;
            transform: translateX(-50%) !important;
        }
    }

    @media (max-width: 767px) {
        body.skin-magz.jtv-homepage .jtv-topbar-inner {
            min-height: 42px !important;
            height: 42px !important;
        }

        body.skin-magz.jtv-homepage .jtv-topbar-title {
            width: 38vw !important;
            max-width: 190px !important;
            padding: 3px 5px !important;
            font-size: 10px !important;
        }

        body.skin-magz.jtv-homepage .jtv-topbar-meta {
            max-width: 31vw !important;
            overflow: hidden !important;
        }

        body.skin-magz.jtv-homepage .jtv-topbar-actions {
            min-width: 0 !important;
            flex: 0 0 auto !important;
            gap: 4px !important;
        }

        body.skin-magz.jtv-homepage .jtv-topbar-social {
            display: none !important;
        }
    }

    /* Final navbar interaction fixes. */
    @media (min-width: 768px) {
        body.skin-magz.jtv-homepage nav.jtv-main-nav {
            overflow: visible !important;
        }

        body.skin-magz.jtv-homepage nav.jtv-main-nav .jtv-nav-container {
            position: relative !important;
            height: 68px !important;
            overflow: visible !important;
        }

        body.skin-magz.jtv-homepage nav.jtv-main-nav #menu-list.jtv-nav-list-wrap {
            height: 68px !important;
            min-height: 68px !important;
            overflow: visible !important;
        }

        body.skin-magz.jtv-homepage nav.jtv-main-nav ul.nav-list {
            height: 68px !important;
            min-height: 68px !important;
            align-items: stretch !important;
            overflow: visible !important;
        }

        body.skin-magz.jtv-homepage nav.jtv-main-nav ul.nav-list > li {
            position: relative !important;
            display: flex !important;
            height: 68px !important;
            align-items: stretch !important;
        }

        body.skin-magz.jtv-homepage nav.jtv-main-nav ul.nav-list > li > a {
            display: flex !important;
            height: 68px !important;
            min-height: 68px !important;
            align-items: center !important;
            justify-content: center !important;
            padding: 0 14px !important;
            border-radius: 0 !important;
            color: #fff !important;
            background: transparent !important;
            transition: color .18s ease, background-color .18s ease !important;
        }

        body.skin-magz.jtv-homepage nav.jtv-main-nav ul.nav-list > li:hover > a,
        body.skin-magz.jtv-homepage nav.jtv-main-nav ul.nav-list > li:focus-within > a,
        body.skin-magz.jtv-homepage nav.jtv-main-nav ul.nav-list > li.active > a {
            color: #07351f !important;
            background: #e8b44c !important;
        }

        body.skin-magz.jtv-homepage nav.jtv-main-nav ul.nav-list > li.jtv-nav-home-link {
            margin-right: 2px !important;
            border-right: 1px solid rgba(255, 255, 255, .65) !important;
        }

        body.skin-magz.jtv-homepage nav.jtv-main-nav ul.nav-list > li.jtv-nav-home-link > a {
            width: 48px !important;
            min-width: 48px !important;
            padding: 0 !important;
        }

        body.skin-magz.jtv-homepage nav.jtv-main-nav ul.nav-list > li.dropdown > .dropdown-menu,
        body.skin-magz.jtv-homepage nav.jtv-main-nav ul.nav-list > li.dropdown:hover > .dropdown-menu,
        body.skin-magz.jtv-homepage nav.jtv-main-nav ul.nav-list > li.dropdown:focus-within > .dropdown-menu {
            display: grid !important;
            opacity: 1 !important;
            visibility: visible !important;
            pointer-events: auto !important;
        }

        body.skin-magz.jtv-homepage nav.jtv-main-nav ul.nav-list > li.dropdown:not(:hover):not(:focus-within) > .dropdown-menu {
            opacity: 0 !important;
            visibility: hidden !important;
            pointer-events: none !important;
        }
    }

    /* Jagoroni red menu states. Keep the navbar background green. */
    body.skin-magz.jtv-homepage nav.jtv-main-nav ul.nav-list > li:hover > a,
    body.skin-magz.jtv-homepage nav.jtv-main-nav ul.nav-list > li:focus-within > a,
    body.skin-magz.jtv-homepage nav.jtv-main-nav ul.nav-list > li.active > a {
        color: #fff !important;
        background: #d71e27 !important;
    }

    body.skin-magz.jtv-homepage nav.jtv-main-nav ul.nav-list > li > a:hover,
    body.skin-magz.jtv-homepage nav.jtv-main-nav ul.nav-list > li > a:focus {
        color: #fff !important;
        background: #d71e27 !important;
    }

    /* Start the menu at the container edge and highlight the home icon red. */
    @media (min-width: 768px) {
        body.skin-magz.jtv-homepage nav.jtv-main-nav #menu-list.jtv-nav-list-wrap {
            position: relative !important;
            justify-content: flex-start !important;
        }

        body.skin-magz.jtv-homepage nav.jtv-main-nav ul.nav-list {
            position: static !important;
            width: max-content !important;
            height: 68px !important;
            flex: 0 0 auto !important;
            justify-content: flex-start !important;
            transform: none !important;
        }

        body.skin-magz.jtv-homepage nav.jtv-main-nav ul.nav-list > li.jtv-nav-home-link > a,
        body.skin-magz.jtv-homepage nav.jtv-main-nav ul.nav-list > li.jtv-nav-home-link:hover > a,
        body.skin-magz.jtv-homepage nav.jtv-main-nav ul.nav-list > li.jtv-nav-home-link:focus-within > a {
            color: #fff !important;
            background: #d71e27 !important;
        }
    }
</style>
@endpush

@section('content')
@php
    $lead = $jamunaPosts->first();
    $secondary = $jamunaPosts->slice(1, 4);
    $latestPosts = $jamunaPosts->take(6);
    $readPosts = $mostReadPosts->take(6);
    $topicCategories = $jamunaPosts->flatMap(fn ($post) => $post->categories)->unique('id')->take(8)->values();
    $topicIcons = ['fa-globe', 'fa-landmark', 'fa-chart-column', 'fa-earth-asia', 'fa-futbol', 'fa-film', 'fa-stethoscope', 'fa-graduation-cap'];
    $featuredVideo = $jamunaVideos->first();
    $videoList = $jamunaVideos->slice(1, 3);
    $socialLinks = collect(json_decode(config('settings.links') ?: '[]'));
    $leadSummary = $lead ? \Illuminate\Support\Str::limit(trim(preg_replace('/\s+/', ' ', strip_tags(html_entity_decode($lead->post_summary ?: $lead->post_content, ENT_QUOTES | ENT_HTML5, 'UTF-8')))), 220) : '';
@endphp

<main class="jtv-home-clone">
    <div class="jtv-home-shell">
        @if($lead)
            <section class="jtv-home-hero-grid">
                <article class="jtv-home-lead">
                    <div class="jtv-home-lead-media">
                        <img src="{{ $postHelper::showThumbnail($lead, 900) }}" alt="{{ $lead->post_title }}">
                        <div class="jtv-home-lead-overlay">
                            <span class="jtv-home-badge">{{ optional($lead->categories->first())->name ?: 'জাতীয়' }}</span>
                            <h1><a href="{{ $postHelper::getUriPost($lead) }}">{{ $lead->post_title }}</a></h1>
                        </div>
                    </div>
                    <div class="jtv-home-lead-body">
                        <p>{{ $leadSummary }}</p>
                        <div class="jtv-home-meta">
                            <span><i class="fa-regular fa-clock"></i>{{ $lead->created_at->locale(app()->getLocale())->diffForHumans() }}</span>
                            <span><i class="fa-regular fa-eye"></i>{{ number_format((int) ($lead->post_hits ?: 5800) / 1000, 1) }}K</span>
                            <span><i class="fa-solid fa-share-nodes"></i>শেয়ার</span>
                        </div>
                    </div>
                </article>

                <div class="jtv-home-story-stack">
                    @foreach($secondary as $post)
                        <article class="jtv-home-stack-card">
                            <a href="{{ $postHelper::getUriPost($post) }}"><img src="{{ $postHelper::showThumbnail($post, 240) }}" alt="{{ $post->post_title }}"></a>
                            <div class="jtv-home-stack-content">
                                <h3><a href="{{ $postHelper::getUriPost($post) }}">{{ $post->post_title }}</a></h3>
                                <div class="jtv-home-stack-submeta">
                                    <span>{{ optional($post->categories->first())->name ?: 'সর্বশেষ' }}</span>
                                    <span><i class="fa-regular fa-clock"></i>{{ $post->created_at->locale(app()->getLocale())->diffForHumans() }}</span>
                                    <span><i class="fa-regular fa-eye"></i>{{ number_format((int) ($post->post_hits ?: 4200) / 1000, 1) }}K</span>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>

                <aside class="jtv-home-latest-panel">
                    <div class="jtv-home-latest-tabs">
                        <div class="jtv-home-latest-tab-buttons">
                            <button type="button" class="is-active" data-home-tab="latest">সর্বশেষ সংবাদ</button>
                        </div>
                        <a class="jtv-home-latest-more" href="{{ url('/news/latest') }}">আরো দেখুন →</a>
                    </div>

                    <div class="jtv-home-latest-list is-active" data-home-panel="latest">
                        @foreach($latestPosts as $post)
                            <article class="jtv-home-latest-item">
                                <h3><a href="{{ $postHelper::getUriPost($post) }}">{{ $post->post_title }}</a></h3>
                                <p><i class="fa-regular fa-clock"></i>{{ $post->created_at->locale(app()->getLocale())->diffForHumans() }}</p>
                            </article>
                        @endforeach
                    </div>

                    <div class="jtv-home-latest-list" data-home-panel="read">
                        @foreach($readPosts as $post)
                            <article class="jtv-home-latest-item">
                                <h3><a href="{{ $postHelper::getUriPost($post) }}">{{ $post->post_title }}</a></h3>
                                <p><i class="fa-regular fa-eye"></i>{{ number_format((int) ($post->post_hits ?: 6100) / 1000, 1) }}K পাঠ</p>
                            </article>
                        @endforeach
                    </div>
                </aside>
            </section>
        @endif

        @if($topicCategories->isNotEmpty())
            <section class="jtv-home-topic-strip">
                @foreach($topicCategories as $index => $category)
                    <a class="jtv-home-topic-link" href="{{ url('/categories/' . $category->slug) }}">
                        <i class="fa-solid {{ $topicIcons[$index % count($topicIcons)] }}"></i>
                        <span>{{ $category->name }}</span>
                    </a>
                @endforeach
            </section>
        @endif

        <section class="jtv-home-lower-grid">
            <div class="jtv-home-video-block">
                <div class="jtv-home-video-tabs">
                    <a class="jtv-home-video-tab is-active" href="{{ url('/videos/latest') }}"><i class="fa-brands fa-youtube"></i>সর্বশেষ ভিডিও</a>
                    <span class="jtv-home-video-tab">বিশেষ প্রতিবেদন</span>
                    <span class="jtv-home-video-tab">তথ্যচিত্র</span>
                    <span class="jtv-home-video-tab">লাইভ</span>
                </div>

                @if($featuredVideo)
                    <div class="jtv-home-video-layout">
                        <article class="jtv-home-video-feature">
                            <a class="jtv-home-video-feature-thumb" href="{{ $postHelper::getUriPost($featuredVideo) }}">
                                <img src="{{ $postHelper::showThumbnail($featuredVideo, 720) }}" alt="{{ $featuredVideo->post_title }}">
                                <span class="jtv-home-video-play"><i class="fa-solid fa-play"></i></span>
                            </a>
                        </article>

                        <div class="jtv-home-video-list">
                            @foreach($videoList as $video)
                                <article class="jtv-home-video-list-item">
                                    <a href="{{ $postHelper::getUriPost($video) }}"><img src="{{ $postHelper::showThumbnail($video, 220) }}" alt="{{ $video->post_title }}"></a>
                                    <div>
                                        <h4><a href="{{ $postHelper::getUriPost($video) }}">{{ $video->post_title }}</a></h4>
                                        <p><i class="fa-regular fa-clock"></i>{{ $video->created_at->locale(app()->getLocale())->diffForHumans() }} • <i class="fa-regular fa-eye"></i>{{ number_format((int) ($video->post_hits ?: 4800) / 1000, 1) }}K</p>
                                    </div>
                                </article>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <div class="jtv-home-side-widgets">
                <div class="jtv-home-promo-card">
                    <div class="jtv-home-promo-inner">
                        <div class="jtv-home-promo-icon"><i class="fa-solid fa-tower-broadcast"></i></div>
                        <div>
                            <strong>জাগরণী টিভি</strong>
                            <span>সবার আগে, সব খবর</span>
                            <em>লাইভ দেখুন →</em>
                        </div>
                    </div>
                </div>

                <div class="jtv-home-connect-box">
                    <h3>আমাদের সাথে থাকুন</h3>
                    <div class="jtv-home-connect-row">
                        <ul class="jtv-home-connect-social">
                            @foreach($socialLinks->take(5) as $link)
                                <li><a href="{{ $link->url }}" target="_blank" rel="noopener" style="background: {{ $link->color ?? '#0b6b3a' }}" aria-label="{{ $link->name ?? 'social' }}"><i class="{{ $link->icon }}"></i></a></li>
                            @endforeach
                        </ul>

                        <form class="jtv-home-connect-form">
                            <input type="email" name="email" placeholder="আপনার ইমেইল লিখুন">
                            <button type="button">সাবস্ক্রাইব</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
</main>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('[data-home-tab]').forEach(function (tab) {
            tab.addEventListener('click', function () {
                const target = tab.getAttribute('data-home-tab');
                const wrap = tab.closest('.jtv-home-latest-panel');

                wrap.querySelectorAll('[data-home-tab]').forEach(function (button) {
                    button.classList.toggle('is-active', button === tab);
                });

                wrap.querySelectorAll('[data-home-panel]').forEach(function (panel) {
                    panel.classList.toggle('is-active', panel.getAttribute('data-home-panel') === target);
                });
            });
        });
    });
</script>
@endpush
