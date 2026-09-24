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

    }

    /* Attachment-style category mosaic. */
        body.skin-magz.jtv-homepage .jtv-category-sections {
            display: grid !important;
            grid-template-columns: repeat(4, minmax(0, 1fr)) !important;
            gap: 12px !important;
            margin: 16px 0 !important;
        }

        body.skin-magz.jtv-homepage .jtv-category-section {
            min-width: 0 !important;
            overflow: hidden !important;
            border: 1px solid #dbe5e0 !important;
            border-radius: 5px !important;
            background: #fff !important;
            box-shadow: 0 2px 7px rgba(0, 0, 0, .06) !important;
        }

        body.skin-magz.jtv-homepage .jtv-category-heading {
            min-height: 34px !important;
            border-bottom: 0 !important;
        }

        body.skin-magz.jtv-homepage .jtv-category-heading h2 {
            width: 100% !important;
            padding: 8px 12px !important;
            font-size: 13px !important;
        }

        body.skin-magz.jtv-homepage .jtv-category-heading a {
            display: none !important;
        }

        body.skin-magz.jtv-homepage .jtv-category-grid {
            display: block !important;
        }

        body.skin-magz.jtv-homepage .jtv-category-card {
            padding: 9px !important;
            border: 0 !important;
        }

        body.skin-magz.jtv-homepage .jtv-category-card figure {
            height: 112px !important;
            margin-bottom: 7px !important;
            border-radius: 3px !important;
        }

        body.skin-magz.jtv-homepage .jtv-category-card h3 {
            min-height: 34px !important;
            margin-bottom: 5px !important;
            font-size: 12px !important;
            line-height: 1.35 !important;
        }

        body.skin-magz.jtv-homepage .jtv-category-card p {
            font-size: 9px !important;
        }

        body.skin-magz.jtv-homepage .jtv-category-section:nth-child(4n + 1) .jtv-category-heading h2 {
            background: #d71e27 !important;
        }

        body.skin-magz.jtv-homepage .jtv-category-section:nth-child(4n + 2) .jtv-category-heading h2 {
            background: #079447 !important;
        }

        body.skin-magz.jtv-homepage .jtv-category-section:nth-child(4n + 3) .jtv-category-heading h2 {
            background: #1565b4 !important;
        }

        body.skin-magz.jtv-homepage .jtv-category-section:nth-child(4n + 4) .jtv-category-heading h2 {
            background: #6339a5 !important;
        }

        /* Attachment-style horizontal photo gallery with scroll-snap slider. */
        body.skin-magz.jtv-homepage .jtv-photo-gallery {
            position: relative !important;
            margin: 18px 0 !important;
            padding-bottom: 23px !important;
            overflow: hidden !important;
            border: 1px solid #dbe5e0 !important;
            border-radius: 6px !important;
            background: #fff !important;
            box-shadow: 0 2px 8px rgba(0, 0, 0, .05) !important;
        }

        body.skin-magz.jtv-homepage .jtv-photo-gallery-heading {
            display: flex !important;
            min-height: 38px !important;
            align-items: center !important;
            justify-content: space-between !important;
            padding: 0 13px !important;
            border-bottom: 1px solid #e2e9e5 !important;
        }

        body.skin-magz.jtv-homepage .jtv-photo-gallery-heading h2 {
            margin: 0 !important;
            color: #183f2c !important;
            font-family: "Noto Sans Bengali", Arial, sans-serif !important;
            font-size: 14px !important;
            font-weight: 800 !important;
        }

        body.skin-magz.jtv-homepage .jtv-photo-gallery-heading h2 i {
            color: #d71e27 !important;
        }

        body.skin-magz.jtv-homepage .jtv-photo-gallery-heading a {
            color: #17643d !important;
            font-size: 11px !important;
            font-weight: 700 !important;
            text-decoration: none !important;
        }

        body.skin-magz.jtv-homepage .jtv-photo-gallery-track {
            display: grid !important;
            grid-auto-flow: column !important;
            grid-auto-columns: calc((100% - 36px) / 4) !important;
            gap: 12px !important;
            overflow-x: auto !important;
            padding: 11px 12px 4px !important;
            scroll-behavior: smooth !important;
            scroll-snap-type: x mandatory !important;
            scrollbar-width: none !important;
        }

        body.skin-magz.jtv-homepage .jtv-photo-gallery-track::-webkit-scrollbar {
            display: none !important;
        }

        body.skin-magz.jtv-homepage .jtv-photo-gallery-card {
            min-width: 0 !important;
            scroll-snap-align: start !important;
        }

        body.skin-magz.jtv-homepage .jtv-photo-gallery-card > a {
            position: relative !important;
            display: block !important;
        }

        body.skin-magz.jtv-homepage .jtv-photo-gallery-card img {
            display: block !important;
            width: 100% !important;
            height: 108px !important;
            object-fit: cover !important;
            border-radius: 4px !important;
        }

        body.skin-magz.jtv-homepage .jtv-photo-gallery-count {
            position: absolute !important;
            right: 5px;
            bottom: 5px;
            padding: 3px 6px;
            border-radius: 3px;
            color: #fff;
            background: rgba(0, 0, 0, .65);
            font-size: 9px;
        }

        body.skin-magz.jtv-homepage .jtv-photo-gallery-card h3 {
            display: -webkit-box !important;
            min-height: 30px !important;
            margin: 6px 0 3px !important;
            overflow: hidden !important;
            color: #183f2c !important;
            font-family: "Noto Sans Bengali", Arial, sans-serif !important;
            font-size: 11px !important;
            line-height: 1.35 !important;
            -webkit-box-orient: vertical !important;
            -webkit-line-clamp: 2 !important;
        }

        body.skin-magz.jtv-homepage .jtv-photo-gallery-card h3 a {
            color: inherit !important;
            text-decoration: none !important;
        }

        body.skin-magz.jtv-homepage .jtv-photo-gallery-card p {
            margin: 0 !important;
            color: #76847c !important;
            font-size: 9px !important;
        }

        body.skin-magz.jtv-homepage .jtv-photo-gallery-arrow {
            position: absolute !important;
            top: 50%;
            z-index: 2;
            width: 24px;
            height: 34px;
            padding: 0;
            border: 0;
            border-radius: 3px;
            color: #fff;
            background: rgba(0, 88, 52, .82);
            transform: translateY(-25%);
            cursor: pointer;
        }

        body.skin-magz.jtv-homepage .jtv-photo-gallery-arrow.is-prev { left: 4px; }
        body.skin-magz.jtv-homepage .jtv-photo-gallery-arrow.is-next { right: 4px; }

        body.skin-magz.jtv-homepage .jtv-photo-gallery-dots {
            display: flex !important;
            position: absolute !important;
            bottom: 7px;
            left: 50%;
            gap: 5px;
            transform: translateX(-50%);
        }

        body.skin-magz.jtv-homepage .jtv-photo-gallery-dots span {
            width: 5px;
            height: 5px;
            border-radius: 50%;
            background: #c8d4ce;
        }

        body.skin-magz.jtv-homepage .jtv-photo-gallery-dots span.is-active {
            background: #d71e27;
        }

        @media (max-width: 1100px) {
            body.skin-magz.jtv-homepage .jtv-category-sections {
                grid-template-columns: repeat(2, minmax(0, 1fr)) !important;
            }

            body.skin-magz.jtv-homepage .jtv-photo-gallery-track {
                grid-auto-columns: calc((100% - 24px) / 3) !important;
            }
        }

        @media (max-width: 767px) {
            body.skin-magz.jtv-homepage .jtv-category-sections {
                grid-template-columns: repeat(2, minmax(0, 1fr)) !important;
                gap: 8px !important;
            }

            body.skin-magz.jtv-homepage .jtv-category-card figure {
                height: 105px !important;
            }

            body.skin-magz.jtv-homepage .jtv-photo-gallery-track {
                grid-auto-columns: calc((100% - 12px) / 2) !important;
            }
        }
    body.skin-magz.jtv-homepage .jtv-topbar-inner {
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

    body.skin-magz.jtv-homepage button.jtv-home-video-tab {
        margin: 0 !important;
        border: 0 !important;
        background: transparent !important;
        cursor: pointer !important;
    }

    body.skin-magz.jtv-homepage button.jtv-home-video-tab:hover,
    body.skin-magz.jtv-homepage button.jtv-home-video-tab:focus-visible {
        color: #fff !important;
        background: #d61f26 !important;
        outline: 0 !important;
    }

    body.skin-magz.jtv-homepage .jtv-home-video-layout {
        display: grid !important;
        grid-template-columns: minmax(0, 1.42fr) minmax(230px, .95fr) !important;
        gap: 12px !important;
        padding: 10px !important;
    }

    body.skin-magz.jtv-homepage .jtv-home-video-layout[hidden] {
        display: none !important;
    }

    body.skin-magz.jtv-homepage .jtv-home-video-layout.is-video-panel-hidden {
        display: none !important;
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
    body.skin-magz.jtv-homepage .jtv-home-promo-inner span {
        display: block !important;
        font-style: normal !important;
    }

    body.skin-magz.jtv-homepage .jtv-home-promo-inner strong {
        font-family: "Noto Sans Bengali", Arial, sans-serif !important;
        font-size: 24px !important;
        font-weight: 800 !important;
    }

    body.skin-magz.jtv-homepage .jtv-home-promo-live-link {
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        margin-top: 7px !important;
        padding: 6px 12px !important;
        border: 2px solid #d71e27 !important;
        border-radius: 3px !important;
        color: #fff !important;
        background: #d71e27 !important;
        font-family: "Noto Sans Bengali", Arial, sans-serif !important;
        font-size: 13px !important;
        font-weight: 800 !important;
        line-height: 1.2 !important;
        text-decoration: none !important;
        transition: background .2s ease, border-color .2s ease, transform .2s ease !important;
    }

    body.skin-magz.jtv-homepage .jtv-home-promo-live-link:hover,
    body.skin-magz.jtv-homepage .jtv-home-promo-live-link:focus {
        color: #fff !important;
        background: #b9151d !important;
        border-color: #b9151d !important;
        transform: translateY(-1px) !important;
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

    /* Only the current page receives the red active state. */
    body.skin-magz.jtv-homepage nav.jtv-main-nav ul.nav-list > li > a {
        color: #fff !important;
        background: transparent !important;
    }

    body.skin-magz.jtv-homepage nav.jtv-main-nav ul.nav-list > li.active > a,
    body.skin-magz.jtv-homepage nav.jtv-main-nav ul.nav-list > li.current-menu-item > a,
    body.skin-magz.jtv-homepage nav.jtv-main-nav ul.nav-list > li.current_page_item > a,
    body.skin-magz.jtv-homepage nav.jtv-main-nav ul.nav-list > li.jtv-nav-home-link.active > a {
        color: #fff !important;
        background: #9f1219 !important;
    }

    body.skin-magz.jtv-homepage nav.jtv-main-nav ul.nav-list > li:not(.active):not(.current-menu-item):not(.current_page_item):hover > a,
    body.skin-magz.jtv-homepage nav.jtv-main-nav ul.nav-list > li:not(.active):not(.current-menu-item):not(.current_page_item):focus-within > a {
        color: #f7dfaa !important;
        background: rgba(0, 45, 25, .28) !important;
    }

    body.skin-magz.jtv-homepage nav.jtv-main-nav ul.nav-list > li.jtv-nav-home-link:not(.active) > a {
        color: #fff !important;
        background: transparent !important;
    }

    /* Fluid full-width layout for desktop, tablet, mobile, and browser zoom. */
    body.skin-magz.jtv-homepage,
    body.skin-magz.jtv-homepage header.primary,
    body.skin-magz.jtv-homepage main.jtv-home-clone,
    body.skin-magz.jtv-homepage .jtv-home-shell {
        width: 100% !important;
        max-width: none !important;
        min-width: 0 !important;
        box-sizing: border-box !important;
    }

    body.skin-magz.jtv-homepage * {
        box-sizing: border-box !important;
    }

    body.skin-magz.jtv-homepage .jtv-topbar-inner,
    body.skin-magz.jtv-homepage .jtv-masthead-inner,
    body.skin-magz.jtv-homepage nav.jtv-main-nav .jtv-nav-container,
    body.skin-magz.jtv-homepage .jtv-home-shell,
    body.skin-magz.jtv-homepage .jtv-homepage-footer-bar {
        width: 100% !important;
        max-width: none !important;
        margin-left: auto !important;
        margin-right: auto !important;
        padding-left: clamp(12px, 2vw, 32px) !important;
        padding-right: clamp(12px, 2vw, 32px) !important;
    }

    body.skin-magz.jtv-homepage .jtv-home-hero-grid {
        width: 100% !important;
        max-width: none !important;
        grid-template-columns: minmax(0, 2.1fr) minmax(0, 1fr) minmax(0, .92fr) !important;
    }

    @media (min-width: 768px) and (max-width: 1199px) {
        body.skin-magz.jtv-homepage .jtv-masthead-inner {
            grid-template-columns: minmax(210px, 1.1fr) minmax(180px, 1fr) minmax(180px, .8fr) !important;
            text-align: left !important;
        }

        body.skin-magz.jtv-homepage .jtv-home-hero-grid {
            grid-template-columns: minmax(0, 1.55fr) minmax(0, 1fr) !important;
        }

        body.skin-magz.jtv-homepage .jtv-home-latest-panel {
            grid-column: 1 / -1 !important;
        }
    }

    @media (max-width: 767px) {
        body.skin-magz.jtv-homepage .jtv-home-hero-grid {
            display: grid !important;
            grid-template-columns: minmax(0, 1fr) !important;
            gap: 12px !important;
        }

        body.skin-magz.jtv-homepage .jtv-home-latest-panel {
            grid-column: auto !important;
        }

        body.skin-magz.jtv-homepage .jtv-masthead-inner {
            grid-template-columns: minmax(0, 1fr) !important;
            justify-items: center !important;
            text-align: center !important;
        }

        body.skin-magz.jtv-homepage .jtv-masthead-brand-copy {
            min-width: 0 !important;
        }

        body.skin-magz.jtv-homepage .jtv-masthead-brand-copy strong {
            font-size: clamp(22px, 7vw, 31px) !important;
        }

        body.skin-magz.jtv-homepage .jtv-home-lead-media {
            height: clamp(220px, 58vw, 360px) !important;
        }

        body.skin-magz.jtv-homepage .jtv-home-stack-card,
        body.skin-magz.jtv-homepage .jtv-home-video-list-item {
            min-width: 0 !important;
        }
    }

    body.skin-magz.jtv-homepage .jtv-category-sections {
        display: grid !important;
        gap: 16px !important;
        margin: 16px 0 !important;
    }

    body.skin-magz.jtv-homepage .jtv-category-section {
        min-width: 0 !important;
        overflow: hidden !important;
        border: 1px solid #d9e4de !important;
        border-radius: 6px !important;
        background: #fff !important;
        box-shadow: 0 2px 8px rgba(0, 0, 0, .04) !important;
    }

    body.skin-magz.jtv-homepage .jtv-category-heading {
        display: flex !important;
        min-height: 44px !important;
        align-items: center !important;
        justify-content: space-between !important;
        border-bottom: 1px solid #e2ebe6 !important;
    }

    body.skin-magz.jtv-homepage .jtv-category-heading h2 {
        margin: 0 !important;
        padding: 12px 18px !important;
        color: #fff !important;
        background: #d71e27 !important;
        font-family: "Noto Sans Bengali", Arial, sans-serif !important;
        font-size: 16px !important;
        font-weight: 800 !important;
        line-height: 1.2 !important;
    }

    body.skin-magz.jtv-homepage .jtv-category-heading a {
        padding: 0 16px !important;
        color: #17643d !important;
        font-size: 12px !important;
        font-weight: 700 !important;
        text-decoration: none !important;
    }

    body.skin-magz.jtv-homepage .jtv-category-grid {
        display: grid !important;
        grid-template-columns: repeat(4, minmax(0, 1fr)) !important;
        gap: 0 !important;
    }

    body.skin-magz.jtv-homepage .jtv-category-card {
        min-width: 0 !important;
        padding: 12px !important;
        border-right: 1px solid #e5ece8 !important;
    }

    body.skin-magz.jtv-homepage .jtv-category-card:last-child {
        border-right: 0 !important;
    }

    body.skin-magz.jtv-homepage .jtv-category-card figure {
        height: 145px !important;
        margin: 0 0 9px !important;
        overflow: hidden !important;
        border-radius: 4px !important;
        background: #e9efeb !important;
    }

    body.skin-magz.jtv-homepage .jtv-category-card figure img {
        width: 100% !important;
        height: 100% !important;
        object-fit: cover !important;
        transition: transform .25s ease !important;
    }

    body.skin-magz.jtv-homepage .jtv-category-card:hover figure img {
        transform: scale(1.04) !important;
    }

    body.skin-magz.jtv-homepage .jtv-category-card h3 {
        display: -webkit-box !important;
        min-height: 42px !important;
        margin: 0 0 7px !important;
        overflow: hidden !important;
        color: #183f2c !important;
        font-family: "Noto Sans Bengali", Arial, sans-serif !important;
        font-size: 15px !important;
        font-weight: 800 !important;
        line-height: 1.4 !important;
        -webkit-box-orient: vertical !important;
        -webkit-line-clamp: 2 !important;
    }

    body.skin-magz.jtv-homepage .jtv-category-card h3 a {
        color: inherit !important;
        text-decoration: none !important;
    }

    body.skin-magz.jtv-homepage .jtv-category-card p {
        margin: 0 !important;
        color: #75847c !important;
        font-size: 11px !important;
    }

    body.skin-magz.jtv-homepage .jtv-category-card p i {
        margin-right: 4px !important;
        color: #d71e27 !important;
    }

    @media (max-width: 767px) {
        body.skin-magz.jtv-homepage .jtv-category-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr)) !important;
        }

        body.skin-magz.jtv-homepage .jtv-category-card:nth-child(2n) {
            border-right: 0 !important;
        }

        body.skin-magz.jtv-homepage .jtv-category-card {
            border-bottom: 1px solid #e5ece8 !important;
        }

        body.skin-magz.jtv-homepage .jtv-category-card figure {
            height: clamp(110px, 30vw, 150px) !important;
        }
    }

    /* Show four stories in every category and give each card a stronger
       landscape proportion instead of the short, narrow appearance. */
    body.skin-magz.jtv-homepage .jtv-category-grid {
        grid-template-columns: repeat(4, minmax(0, 1fr)) !important;
        gap: 0 !important;
    }

    body.skin-magz.jtv-homepage .jtv-category-card {
        min-width: 0 !important;
        padding: 14px !important;
    }

    body.skin-magz.jtv-homepage .jtv-category-card figure {
        height: clamp(170px, 17vw, 230px) !important;
        margin-bottom: 11px !important;
    }

    body.skin-magz.jtv-homepage .jtv-category-card h3 {
        min-height: 48px !important;
        font-size: 16px !important;
        line-height: 1.5 !important;
    }

    @media (max-width: 1100px) {
        body.skin-magz.jtv-homepage .jtv-category-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr)) !important;
        }

        body.skin-magz.jtv-homepage .jtv-category-card:nth-child(2n) {
            border-right: 0 !important;
        }

        body.skin-magz.jtv-homepage .jtv-category-card figure {
            height: clamp(155px, 22vw, 205px) !important;
        }
    }

    @media (max-width: 767px) {
        body.skin-magz.jtv-homepage .jtv-category-card {
            padding: 10px !important;
        }

        body.skin-magz.jtv-homepage .jtv-category-card figure {
            height: clamp(135px, 38vw, 185px) !important;
        }

        body.skin-magz.jtv-homepage .jtv-category-card h3 {
            min-height: 44px !important;
            font-size: 14px !important;
            line-height: 1.45 !important;
        }
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

    /* Final category mosaic overrides. */
    body.skin-magz.jtv-homepage .jtv-category-sections {
        display: grid !important;
        grid-template-columns: repeat(4, minmax(0, 1fr)) !important;
        gap: 12px !important;
    }

    body.skin-magz.jtv-homepage .jtv-category-section {
        min-width: 0 !important;
        overflow: hidden !important;
        border: 1px solid #dbe5e0 !important;
        border-radius: 5px !important;
        background: #fff !important;
        box-shadow: 0 2px 7px rgba(0, 0, 0, .06) !important;
    }

    body.skin-magz.jtv-homepage .jtv-category-heading {
        min-height: 34px !important;
        border-bottom: 0 !important;
    }

    body.skin-magz.jtv-homepage .jtv-category-heading h2 {
        width: 100% !important;
        padding: 8px 12px !important;
        font-size: 13px !important;
    }

    body.skin-magz.jtv-homepage .jtv-category-heading a {
        display: none !important;
    }

    body.skin-magz.jtv-homepage .jtv-category-grid {
        display: block !important;
    }

    body.skin-magz.jtv-homepage .jtv-category-card {
        padding: 9px !important;
        border: 0 !important;
    }

    body.skin-magz.jtv-homepage .jtv-category-card figure {
        height: 112px !important;
        margin-bottom: 7px !important;
    }

    body.skin-magz.jtv-homepage .jtv-category-card h3 {
        min-height: 34px !important;
        margin-bottom: 5px !important;
        font-size: 12px !important;
        line-height: 1.35 !important;
    }

    body.skin-magz.jtv-homepage .jtv-category-section:nth-child(4n + 1) .jtv-category-heading h2 { background: #d71e27 !important; }
    body.skin-magz.jtv-homepage .jtv-category-section:nth-child(4n + 2) .jtv-category-heading h2 { background: #079447 !important; }
    body.skin-magz.jtv-homepage .jtv-category-section:nth-child(4n + 3) .jtv-category-heading h2 { background: #1565b4 !important; }
    body.skin-magz.jtv-homepage .jtv-category-section:nth-child(4n + 4) .jtv-category-heading h2 { background: #6339a5 !important; }

    @media (max-width: 1100px) {
        body.skin-magz.jtv-homepage .jtv-category-sections {
            grid-template-columns: repeat(2, minmax(0, 1fr)) !important;
        }
    }

    @media (max-width: 767px) {
        body.skin-magz.jtv-homepage .jtv-category-sections {
            grid-template-columns: repeat(2, minmax(0, 1fr)) !important;
            gap: 8px !important;
        }

        body.skin-magz.jtv-homepage .jtv-category-card figure {
            height: 105px !important;
        }
    }

    /* Category news columns inspired by the attached reference. */
    body.skin-magz.jtv-homepage .jtv-category-sections {
        display: grid !important;
        grid-template-columns: repeat(4, minmax(0, 1fr)) !important;
        gap: 22px !important;
        padding-top: 18px !important;
        border-top: 1px solid #cfd6d2 !important;
    }

    body.skin-magz.jtv-homepage .jtv-category-section {
        min-width: 0 !important;
        overflow: visible !important;
        border: 0 !important;
        border-right: 1px solid #c8cfcb !important;
        border-radius: 0 !important;
        background: transparent !important;
        box-shadow: none !important;
    }

    body.skin-magz.jtv-homepage .jtv-category-section:last-child {
        border-right: 0 !important;
    }

    body.skin-magz.jtv-homepage .jtv-category-heading {
        display: flex !important;
        min-height: 42px !important;
        align-items: flex-start !important;
        justify-content: flex-start !important;
        gap: 12px !important;
        padding: 0 12px 12px 0 !important;
        border-bottom: 0 !important;
    }

    body.skin-magz.jtv-homepage .jtv-category-heading h2 {
        width: auto !important;
        margin: 0 !important;
        padding: 0 !important;
        color: #d71e27 !important;
        background: transparent !important;
        font-family: "Noto Sans Bengali", Arial, sans-serif !important;
        font-size: clamp(18px, 1.7vw, 25px) !important;
        font-weight: 900 !important;
        line-height: 1.2 !important;
    }

    body.skin-magz.jtv-homepage .jtv-category-heading h2::after {
        display: none !important;
    }

    body.skin-magz.jtv-homepage .jtv-category-heading a {
        display: inline-block !important;
        padding: 4px 0 0 !important;
        color: #c9161d !important;
        font-family: "Noto Sans Bengali", Arial, sans-serif !important;
        font-size: 14px !important;
        font-weight: 800 !important;
        white-space: nowrap !important;
    }

    body.skin-magz.jtv-homepage .jtv-category-section:nth-child(4n + 1) .jtv-category-heading h2 {
        color: #d71e27 !important;
    }

    body.skin-magz.jtv-homepage .jtv-category-section:nth-child(4n + 2) .jtv-category-heading h2 {
        color: #079447 !important;
    }

    body.skin-magz.jtv-homepage .jtv-category-section:nth-child(4n + 3) .jtv-category-heading h2 {
        color: #1565b4 !important;
    }

    body.skin-magz.jtv-homepage .jtv-category-section:nth-child(4n + 4) .jtv-category-heading h2 {
        color: #6339a5 !important;
    }

    body.skin-magz.jtv-homepage .jtv-category-grid {
        display: block !important;
    }

    body.skin-magz.jtv-homepage .jtv-category-card {
        display: block !important;
        padding: 10px 12px 10px 0 !important;
        border: 0 !important;
        border-bottom: 1px solid #d3d8d5 !important;
    }

    body.skin-magz.jtv-homepage .jtv-category-card:first-child {
        padding-top: 0 !important;
    }

    body.skin-magz.jtv-homepage .jtv-category-card:last-child {
        border-bottom: 0 !important;
    }

    body.skin-magz.jtv-homepage .jtv-category-card figure {
        height: clamp(125px, 13vw, 175px) !important;
        margin: 0 0 9px !important;
        border-radius: 0 !important;
    }

    body.skin-magz.jtv-homepage .jtv-category-card h3 {
        min-height: 0 !important;
        margin: 0 !important;
        color: #4a4a4a !important;
        font-size: 16px !important;
        font-weight: 700 !important;
        line-height: 1.45 !important;
    }

    body.skin-magz.jtv-homepage .jtv-category-card:first-child h3 {
        margin-bottom: 8px !important;
        font-size: 17px !important;
        font-weight: 800 !important;
    }

    body.skin-magz.jtv-homepage .jtv-category-card:not(:first-child) figure {
        display: none !important;
    }

    body.skin-magz.jtv-homepage .jtv-category-card p {
        display: none !important;
    }

    @media (max-width: 1100px) {
        body.skin-magz.jtv-homepage .jtv-category-sections {
            grid-template-columns: repeat(2, minmax(0, 1fr)) !important;
        }

        body.skin-magz.jtv-homepage .jtv-category-section:nth-child(2n) {
            border-right: 0 !important;
        }
    }

    @media (max-width: 767px) {
        body.skin-magz.jtv-homepage .jtv-category-sections {
            grid-template-columns: 1fr !important;
            gap: 18px !important;
        }

        body.skin-magz.jtv-homepage .jtv-category-section {
            border-right: 0 !important;
            border-bottom: 1px solid #c8cfcb !important;
            padding-bottom: 14px !important;
        }

        body.skin-magz.jtv-homepage .jtv-category-heading h2 {
            flex: 0 1 auto !important;
            max-width: 100% !important;
            font-size: clamp(19px, 5.5vw, 23px) !important;
            overflow-wrap: anywhere !important;
        }

        body.skin-magz.jtv-homepage .jtv-category-heading {
            min-height: 38px !important;
            align-items: center !important;
            gap: 8px !important;
            padding-right: 0 !important;
        }

        body.skin-magz.jtv-homepage .jtv-category-heading a {
            flex: 0 0 auto !important;
            padding-top: 0 !important;
            font-size: 13px !important;
        }

        body.skin-magz.jtv-homepage .jtv-category-card figure {
            height: clamp(150px, 44vw, 220px) !important;
        }
    }

    /* Location news finder between category sections and the next content block. */
    body.skin-magz.jtv-homepage .jtv-location-finder {
        display: grid !important;
        grid-template-columns: minmax(0, 1fr) minmax(320px, .82fr) !important;
        gap: 28px !important;
        align-items: center !important;
        margin: 24px 0 !important;
        padding: clamp(22px, 3vw, 38px) !important;
        overflow: hidden !important;
        border: 1px solid #d8e5dd !important;
        border-radius: 12px !important;
        background: linear-gradient(120deg, #f7fbf8 0%, #fff 55%, #edf8f1 100%) !important;
        box-shadow: 0 8px 24px rgba(8, 82, 45, .08) !important;
    }

    body.skin-magz.jtv-homepage .jtv-location-finder-copy h2 {
        margin: 0 0 8px !important;
        color: #174d31 !important;
        font-family: "Noto Sans Bengali", Arial, sans-serif !important;
        font-size: clamp(22px, 2.4vw, 32px) !important;
        font-weight: 900 !important;
        line-height: 1.25 !important;
    }

    body.skin-magz.jtv-homepage .jtv-location-finder-copy p {
        max-width: 560px !important;
        margin: 0 !important;
        color: #63746a !important;
        font-family: "Noto Sans Bengali", Arial, sans-serif !important;
        font-size: 14px !important;
        line-height: 1.7 !important;
    }

    body.skin-magz.jtv-homepage .jtv-location-finder-form {
        display: grid !important;
        grid-template-columns: repeat(3, minmax(0, 1fr)) auto !important;
        gap: 10px !important;
        align-items: end !important;
    }

    body.skin-magz.jtv-homepage .jtv-location-field label {
        display: block !important;
        margin: 0 0 6px !important;
        color: #416250 !important;
        font-family: "Noto Sans Bengali", Arial, sans-serif !important;
        font-size: 12px !important;
        font-weight: 800 !important;
    }

    body.skin-magz.jtv-homepage .jtv-location-field select {
        width: 100% !important;
        height: 43px !important;
        padding: 0 12px !important;
        border: 1px solid #c6d9cc !important;
        border-radius: 7px !important;
        outline: 0 !important;
        color: #244d35 !important;
        background: #fff !important;
        font-family: "Noto Sans Bengali", Arial, sans-serif !important;
        font-size: 13px !important;
    }

    body.skin-magz.jtv-homepage .jtv-location-field select:focus {
        border-color: #0b6b3a !important;
        box-shadow: 0 0 0 3px rgba(11, 107, 58, .12) !important;
    }

    body.skin-magz.jtv-homepage .jtv-location-submit {
        height: 43px !important;
        padding: 0 18px !important;
        border: 0 !important;
        border-radius: 7px !important;
        color: #fff !important;
        background: linear-gradient(135deg, #0b6b3a, #079447) !important;
        font-family: "Noto Sans Bengali", Arial, sans-serif !important;
        font-size: 13px !important;
        font-weight: 800 !important;
        white-space: nowrap !important;
        cursor: pointer !important;
    }

    body.skin-magz.jtv-homepage .jtv-location-submit:hover {
        background: #d71e27 !important;
    }

    @media (max-width: 1100px) {
        body.skin-magz.jtv-homepage .jtv-location-finder {
            grid-template-columns: 1fr !important;
            gap: 18px !important;
        }
    }

    @media (max-width: 767px) {
        body.skin-magz.jtv-homepage .jtv-location-finder {
            margin: 18px 0 !important;
            padding: 20px 16px !important;
        }

        body.skin-magz.jtv-homepage .jtv-location-finder-form {
            grid-template-columns: 1fr !important;
        }

        body.skin-magz.jtv-homepage .jtv-location-submit {
            width: 100% !important;
        }
    }
</style>
@endpush

@push('styles')
<style>
    /* Attached-layout inspired sections; intentionally isolated from existing homepage blocks. */
    body.skin-magz.jtv-homepage .jtv-reference-section {
        margin: 18px 0 !important;
        overflow: hidden !important;
        border: 1px solid #d9e4de !important;
        border-radius: 6px !important;
        background: #fff !important;
        box-shadow: 0 2px 8px rgba(0, 0, 0, .04) !important;
    }

    body.skin-magz.jtv-homepage .jtv-reference-heading {
        display: flex !important;
        min-height: 42px !important;
        align-items: center !important;
        justify-content: space-between !important;
        border-bottom: 1px solid #dce5e0 !important;
    }

    body.skin-magz.jtv-homepage .jtv-reference-heading h2 {
        margin: 0 !important;
        padding: 11px 18px !important;
        color: #fff !important;
        background: #d71e27 !important;
        font-family: "Noto Sans Bengali", Arial, sans-serif !important;
        font-size: 16px !important;
        font-weight: 800 !important;
        line-height: 1.25 !important;
    }

    body.skin-magz.jtv-homepage .jtv-reference-heading a {
        padding: 0 16px !important;
        color: #17643d !important;
        font-family: "Noto Sans Bengali", Arial, sans-serif !important;
        font-size: 12px !important;
        font-weight: 700 !important;
        text-decoration: none !important;
    }

    body.skin-magz.jtv-homepage .jtv-reference-news-grid {
        display: grid !important;
        grid-template-columns: repeat(4, minmax(0, 1fr)) !important;
    }

    body.skin-magz.jtv-homepage .jtv-reference-news-card {
        min-width: 0 !important;
        padding: 12px !important;
        border-right: 1px solid #e1e9e5 !important;
    }

    body.skin-magz.jtv-homepage .jtv-reference-news-card:last-child {
        border-right: 0 !important;
    }

    body.skin-magz.jtv-homepage .jtv-reference-news-card figure {
        height: 175px !important;
        margin: 0 0 8px !important;
        overflow: hidden !important;
        border-radius: 4px !important;
        background: #e9efeb !important;
    }

    body.skin-magz.jtv-homepage .jtv-reference-news-card img {
        width: 100% !important;
        height: 100% !important;
        object-fit: cover !important;
        transition: transform .2s ease !important;
    }

    body.skin-magz.jtv-homepage .jtv-reference-news-card:hover img {
        transform: scale(1.04) !important;
    }

    body.skin-magz.jtv-homepage .jtv-reference-news-card h3 {
        display: -webkit-box !important;
        min-height: 39px !important;
        margin: 0 0 7px !important;
        overflow: hidden !important;
        color: #183f2c !important;
        font-family: "Noto Sans Bengali", Arial, sans-serif !important;
        font-size: 14px !important;
        font-weight: 800 !important;
        line-height: 1.4 !important;
        -webkit-box-orient: vertical !important;
        -webkit-line-clamp: 2 !important;
    }

    body.skin-magz.jtv-homepage .jtv-reference-news-card h3 a {
        color: inherit !important;
        text-decoration: none !important;
    }

    body.skin-magz.jtv-homepage .jtv-reference-news-meta {
        color: #76847c !important;
        font-size: 10px !important;
    }

    body.skin-magz.jtv-homepage .jtv-reference-news-meta i {
        margin-right: 3px !important;
        color: #d71e27 !important;
    }

    body.skin-magz.jtv-homepage .jtv-reference-live-grid {
        display: grid !important;
        grid-template-columns: 1.45fr 1fr 1fr !important;
        gap: 12px !important;
        padding: 12px !important;
    }

    body.skin-magz.jtv-homepage .jtv-reference-live-card {
        min-width: 0 !important;
        min-height: 154px !important;
        overflow: hidden !important;
        border: 1px solid #dce6e1 !important;
        border-radius: 5px !important;
        background: #fff !important;
    }

    body.skin-magz.jtv-homepage .jtv-reference-live-media {
        position: relative !important;
        height: 154px !important;
        overflow: hidden !important;
        background: #e9efeb !important;
    }

    body.skin-magz.jtv-homepage .jtv-reference-live-media img {
        width: 100% !important;
        height: 100% !important;
        object-fit: cover !important;
    }

    body.skin-magz.jtv-homepage .jtv-reference-live-badge {
        position: absolute !important;
        top: 10px;
        left: 10px;
        padding: 4px 8px;
        border-radius: 3px;
        color: #fff;
        background: #d71e27;
        font-size: 10px;
        font-weight: 800;
    }

    body.skin-magz.jtv-homepage .jtv-reference-live-copy {
        padding: 14px !important;
    }

    body.skin-magz.jtv-homepage .jtv-reference-live-copy h3 {
        margin: 0 0 9px !important;
        color: #183f2c !important;
        font-family: "Noto Sans Bengali", Arial, sans-serif !important;
        font-size: 16px !important;
        font-weight: 800 !important;
    }

    body.skin-magz.jtv-homepage .jtv-reference-live-copy p {
        margin: 0 0 12px !important;
        color: #6e7d75 !important;
        font-size: 12px !important;
        line-height: 1.5 !important;
    }

    body.skin-magz.jtv-homepage .jtv-reference-live-news {
        display: grid !important;
        grid-template-columns: 108px minmax(0, 1fr) !important;
        height: 100% !important;
        gap: 12px !important;
        align-items: center !important;
        color: inherit !important;
        text-decoration: none !important;
    }

    body.skin-magz.jtv-homepage .jtv-reference-live-news img {
        width: 108px !important;
        height: 154px !important;
        object-fit: cover !important;
    }

    body.skin-magz.jtv-homepage .jtv-reference-live-news span {
        display: block !important;
        min-width: 0 !important;
        padding: 12px 12px 12px 0 !important;
    }

    body.skin-magz.jtv-homepage .jtv-reference-live-news strong,
    body.skin-magz.jtv-homepage .jtv-reference-live-news b {
        display: block !important;
        font-family: "Noto Sans Bengali", Arial, sans-serif !important;
    }

    body.skin-magz.jtv-homepage .jtv-reference-live-news strong {
        margin-bottom: 9px !important;
        color: #d71e27 !important;
        font-size: 12px !important;
    }

    body.skin-magz.jtv-homepage .jtv-reference-live-news b {
        display: -webkit-box !important;
        overflow: hidden !important;
        color: #183f2c !important;
        font-size: 15px !important;
        line-height: 1.5 !important;
        -webkit-box-orient: vertical !important;
        -webkit-line-clamp: 4 !important;
    }

    body.skin-magz.jtv-homepage .jtv-reference-live-button {
        display: inline-block !important;
        padding: 7px 12px !important;
        border-radius: 3px !important;
        color: #fff !important;
        background: #d71e27 !important;
        font-size: 11px !important;
        font-weight: 700 !important;
        text-decoration: none !important;
    }

    body.skin-magz.jtv-homepage .jtv-reference-social-list {
        display: grid !important;
        gap: 10px !important;
        margin: 0 !important;
        padding: 14px !important;
        list-style: none !important;
    }

    body.skin-magz.jtv-homepage .jtv-reference-social-list li a {
        display: flex !important;
        align-items: center !important;
        gap: 9px !important;
        color: #183f2c !important;
        font-size: 12px !important;
        font-weight: 700 !important;
        text-decoration: none !important;
    }

    body.skin-magz.jtv-homepage .jtv-reference-social-list i {
        display: inline-flex !important;
        width: 28px !important;
        height: 28px !important;
        align-items: center !important;
        justify-content: center !important;
        border-radius: 50% !important;
        color: #fff !important;
        background: #0b6b3a !important;
    }

    /* Reference-style photo gallery slider. */
    body.skin-magz.jtv-homepage .jtv-photo-gallery {
        position: relative !important;
        margin: 18px 0 !important;
        overflow: hidden !important;
        border: 0 !important;
        border-radius: 0 !important;
        background: transparent !important;
        box-shadow: none !important;
    }

    body.skin-magz.jtv-homepage .jtv-photo-gallery-heading {
        display: flex !important;
        min-height: 45px !important;
        align-items: center !important;
        justify-content: flex-start !important;
        gap: 15px !important;
        padding: 0 !important;
        border: 0 !important;
    }

    body.skin-magz.jtv-homepage .jtv-photo-gallery-heading h2 {
        margin: 0 !important;
        color: #373737 !important;
        font-family: "Noto Sans Bengali", Arial, sans-serif !important;
        font-size: 25px !important;
        font-weight: 900 !important;
        line-height: 1 !important;
    }

    body.skin-magz.jtv-homepage .jtv-photo-gallery-heading h2::after {
        display: none !important;
    }

    body.skin-magz.jtv-homepage .jtv-photo-gallery-heading a {
        color: #c9161d !important;
        font-family: "Noto Sans Bengali", Arial, sans-serif !important;
        font-size: 16px !important;
        font-weight: 800 !important;
        text-decoration: none !important;
    }

    body.skin-magz.jtv-homepage .jtv-photo-gallery-track {
        display: flex !important;
        gap: 0 !important;
        overflow: hidden !important;
        padding: 0 !important;
        scroll-snap-type: none !important;
    }

    body.skin-magz.jtv-homepage .jtv-photo-gallery-slide {
        display: grid !important;
        flex: 0 0 100% !important;
        grid-template-columns: minmax(0, 1.28fr) minmax(0, .92fr) !important;
        gap: 20px !important;
        min-width: 100% !important;
        scroll-snap-align: none !important;
    }

    body.skin-magz.jtv-homepage .jtv-photo-gallery-featured,
    body.skin-magz.jtv-homepage .jtv-photo-gallery-card {
        min-width: 0 !important;
        border: 1px solid #e0e0e0 !important;
        background: #fff !important;
    }

    body.skin-magz.jtv-homepage .jtv-photo-gallery-featured > a,
    body.skin-magz.jtv-homepage .jtv-photo-gallery-card > a {
        position: relative !important;
        display: block !important;
        overflow: hidden !important;
        background: #e9e9e9 !important;
    }

    body.skin-magz.jtv-homepage .jtv-photo-gallery-featured > a {
        height: 416px !important;
        border-top: 5px solid #c9161d !important;
    }

    body.skin-magz.jtv-homepage .jtv-photo-gallery-featured > a::after,
    body.skin-magz.jtv-homepage .jtv-photo-gallery-card > a::after {
        position: absolute !important;
        inset: auto 0 0 !important;
        height: 42% !important;
        content: "" !important;
        background: linear-gradient(transparent, rgba(0, 0, 0, .72)) !important;
    }

    body.skin-magz.jtv-homepage .jtv-photo-gallery-featured img,
    body.skin-magz.jtv-homepage .jtv-photo-gallery-card img {
        display: block !important;
        width: 100% !important;
        height: 100% !important;
        object-fit: cover !important;
        transition: transform .25s ease !important;
    }

    body.skin-magz.jtv-homepage .jtv-photo-gallery-featured:hover img,
    body.skin-magz.jtv-homepage .jtv-photo-gallery-card:hover img {
        transform: scale(1.04) !important;
    }

    body.skin-magz.jtv-homepage .jtv-photo-gallery-feature-caption {
        position: absolute !important;
        right: 12px !important;
        bottom: 12px !important;
        left: 12px !important;
        z-index: 1 !important;
        color: #fff !important;
        font-family: "Noto Sans Bengali", Arial, sans-serif !important;
        font-size: 15px !important;
        font-weight: 800 !important;
        line-height: 1.35 !important;
    }

    body.skin-magz.jtv-homepage .jtv-photo-gallery-count {
        position: absolute !important;
        /* top: 12px !important;
        left: 12px !important; */
        z-index: 2 !important;
        padding: 5px 10px !important;
        border-radius: 2px !important;
        color: #fff !important;
        background: rgba(0, 0, 0, .55) !important;
        font-size: 13px !important;
        font-weight: 800 !important;
    }

    body.skin-magz.jtv-homepage .jtv-photo-gallery-featured > h3,
    body.skin-magz.jtv-homepage .jtv-photo-gallery-card h3 {
        margin: 0 !important;
        padding: 10px !important;
        color: #383838 !important;
        font-family: "Noto Sans Bengali", Arial, sans-serif !important;
        font-weight: 800 !important;
        line-height: 1.45 !important;
    }

    body.skin-magz.jtv-homepage .jtv-photo-gallery-featured > h3 {
        min-height: 72px !important;
        font-size: 18px !important;
    }

    body.skin-magz.jtv-homepage .jtv-photo-gallery-card h3 {
        display: -webkit-box !important;
        min-height: 66px !important;
        overflow: hidden !important;
        font-size: 16px !important;
        -webkit-box-orient: vertical !important;
        -webkit-line-clamp: 3 !important;
    }

    body.skin-magz.jtv-homepage .jtv-photo-gallery-featured h3 a,
    body.skin-magz.jtv-homepage .jtv-photo-gallery-card h3 a {
        color: inherit !important;
        text-decoration: none !important;
    }

    body.skin-magz.jtv-homepage .jtv-photo-gallery-side {
        display: grid !important;
        grid-template-columns: repeat(2, minmax(0, 1fr)) !important;
        gap: 14px 20px !important;
    }

    body.skin-magz.jtv-homepage .jtv-photo-gallery-card > a {
        height: 143px !important;
    }

    body.skin-magz.jtv-homepage .jtv-photo-gallery-icon {
        position: absolute !important;
        top: 11px !important;
        left: 11px !important;
        z-index: 2 !important;
        display: grid !important;
        width: 31px !important;
        height: 31px !important;
        place-items: center !important;
        border-radius: 3px !important;
        color: #fff !important;
        background: rgba(28, 34, 36, .78) !important;
        font-size: 14px !important;
    }

    body.skin-magz.jtv-homepage .jtv-photo-gallery-arrow {
        top: 52% !important;
        width: 34px !important;
        height: 46px !important;
        border-radius: 2px !important;
        color: #fff !important;
        background: rgba(0, 0, 0, .55) !important;
        transform: translateY(-50%) !important;
    }

    body.skin-magz.jtv-homepage .jtv-photo-gallery-arrow.is-prev { left: 8px !important; }
    body.skin-magz.jtv-homepage .jtv-photo-gallery-arrow.is-next { right: 8px !important; }

    body.skin-magz.jtv-homepage .jtv-photo-gallery-dots {
        display: none !important;
    }

    @media (max-width: 767px) {
        body.skin-magz.jtv-homepage .jtv-photo-gallery-heading h2 { font-size: 21px !important; }

        body.skin-magz.jtv-homepage .jtv-photo-gallery-slide {
            grid-template-columns: 1fr !important;
            gap: 10px !important;
        }

        body.skin-magz.jtv-homepage .jtv-photo-gallery-featured > a { height: 260px !important; }
        body.skin-magz.jtv-homepage .jtv-photo-gallery-side { gap: 8px !important; }
        body.skin-magz.jtv-homepage .jtv-photo-gallery-card > a { height: 110px !important; }
        body.skin-magz.jtv-homepage .jtv-photo-gallery-card h3 { font-size: 13px !important; }
    }

    @media (max-width: 767px) {
        body.skin-magz.jtv-homepage .jtv-reference-news-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr)) !important;
        }

        body.skin-magz.jtv-homepage .jtv-reference-news-card:nth-child(2n) {
            border-right: 0 !important;
        }

        body.skin-magz.jtv-homepage .jtv-reference-news-card {
            border-bottom: 1px solid #e1e9e5 !important;
        }

        body.skin-magz.jtv-homepage .jtv-reference-live-grid {
            grid-template-columns: 1fr !important;
        }

        body.skin-magz.jtv-homepage .jtv-reference-live-news {
            grid-template-columns: 112px minmax(0, 1fr) !important;
        }

        body.skin-magz.jtv-homepage .jtv-reference-live-news img {
            width: 112px !important;
            height: 154px !important;
        }
    }

    /* Final photo slider polish: lighter media, readable caption, visible controls. */
    body.skin-magz.jtv-homepage .jtv-photo-gallery-featured > a::after,
    body.skin-magz.jtv-homepage .jtv-photo-gallery-card > a::after {
        height: 30% !important;
        background: linear-gradient(180deg, transparent 0%, rgba(0, 0, 0, .62) 100%) !important;
        pointer-events: none !important;
    }

    body.skin-magz.jtv-homepage .jtv-photo-gallery-feature-caption {
        right: 18px !important;
        bottom: 16px !important;
        left: 18px !important;
        max-width: calc(100% - 36px) !important;
        color: #fff !important;
        text-shadow: 0 1px 3px rgba(0, 0, 0, .8) !important;
    }

    body.skin-magz.jtv-homepage .jtv-photo-gallery-arrow {
        position: absolute !important;
        top: 50% !important;
        z-index: 20 !important;
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        width: 38px !important;
        height: 48px !important;
        margin: 0 !important;
        padding: 0 !important;
        border: 1px solid rgba(255, 255, 255, .6) !important;
        border-radius: 4px !important;
        opacity: 1 !important;
        visibility: visible !important;
        color: #fff !important;
        background: rgba(0, 68, 40, .92) !important;
        box-shadow: 0 3px 12px rgba(0, 0, 0, .28) !important;
        transform: translateY(-50%) !important;
        cursor: pointer !important;
    }

    body.skin-magz.jtv-homepage .jtv-photo-gallery-arrow.is-prev {
        left: 10px !important;
        right: auto !important;
    }

    body.skin-magz.jtv-homepage .jtv-photo-gallery-arrow.is-next {
        right: 10px !important;
        left: auto !important;
    }

    body.skin-magz.jtv-homepage .jtv-photo-gallery-arrow:hover:not(:disabled) {
        background: #d61f26 !important;
        transform: translateY(-50%) scale(1.05) !important;
    }

    body.skin-magz.jtv-homepage .jtv-photo-gallery-arrow:disabled {
        opacity: .45 !important;
        cursor: not-allowed !important;
    }

    @media (max-width: 767px) {
        body.skin-magz.jtv-homepage .jtv-photo-gallery-arrow {
            width: 32px !important;
            height: 42px !important;
        }

        body.skin-magz.jtv-homepage .jtv-photo-gallery-arrow.is-prev {
            left: 6px !important;
        }

        body.skin-magz.jtv-homepage .jtv-photo-gallery-arrow.is-next {
            right: 6px !important;
        }
    }

    /* Final gallery fix: the carousel controls belong to the featured image,
       not to the complete gallery section. */
    body.skin-magz.jtv-homepage .jtv-photo-gallery-featured > a::after,
    body.skin-magz.jtv-homepage .jtv-photo-gallery-card > a::after {
        display: none !important;
        content: none !important;
        background: none !important;
    }

    body.skin-magz.jtv-homepage .jtv-photo-gallery-feature-caption {
        bottom: 14px !important;
        color: #fff !important;
        text-shadow: 0 1px 4px rgba(0, 0, 0, .95) !important;
    }

    body.skin-magz.jtv-homepage .jtv-photo-gallery-arrow {
        top: 52% !important;
        z-index: 30 !important;
    }

    body.skin-magz.jtv-homepage .jtv-photo-gallery-arrow.is-prev {
        left: 10px !important;
        right: auto !important;
    }

    body.skin-magz.jtv-homepage .jtv-photo-gallery-arrow.is-next {
        right: calc(41.8% + 10px) !important;
        left: auto !important;
    }

    @media (max-width: 1100px) {
        body.skin-magz.jtv-homepage .jtv-photo-gallery-arrow.is-next {
            right: calc(41.8% + 8px) !important;
        }
    }

    @media (max-width: 767px) {
        body.skin-magz.jtv-homepage .jtv-photo-gallery-arrow.is-prev {
            left: 6px !important;
        }

        body.skin-magz.jtv-homepage .jtv-photo-gallery-arrow.is-next {
            right: 6px !important;
        }
    }

    /* Featured-image-only carousel layout. */
    body.skin-magz.jtv-homepage .jtv-photo-gallery {
        position: relative !important;
    }

    body.skin-magz.jtv-homepage .jtv-photo-gallery-track {
        width: 58.2% !important;
        margin: 0 !important;
    }

    body.skin-magz.jtv-homepage .jtv-photo-gallery-slide {
        display: block !important;
        width: 100% !important;
        min-width: 100% !important;
    }

    body.skin-magz.jtv-homepage .jtv-photo-gallery-featured {
        width: 100% !important;
    }

    body.skin-magz.jtv-homepage .jtv-photo-gallery-side {
        position: absolute !important;
        top: 45px !important;
        right: 0 !important;
        width: 40.4% !important;
        height: 416px !important;
        grid-template-columns: repeat(2, minmax(0, 1fr)) !important;
        gap: 14px 20px !important;
    }

    body.skin-magz.jtv-homepage .jtv-photo-gallery-arrow.is-next {
        right: calc(41.8% + 10px) !important;
    }

    body.skin-magz.jtv-homepage .jtv-photo-gallery-count {
        top: 14px !important;
        right: auto !important;
        bottom: auto !important;
        left: 14px !important;
        padding: 7px 12px !important;
        border-radius: 18px !important;
        color: #fff !important;
        background: rgba(48, 50, 18, .82) !important;
        font-size: 16px !important;
        line-height: 1 !important;
        letter-spacing: .5px !important;
    }

    body.skin-magz.jtv-homepage .jtv-photo-gallery-controls {
        position: absolute !important;
        top: 61px !important;
        right: calc(41.8% + 10px) !important;
        z-index: 31 !important;
        display: flex !important;
        gap: 8px !important;
        align-items: center !important;
    }

    body.skin-magz.jtv-homepage .jtv-photo-gallery-controls .jtv-photo-gallery-arrow,
    body.skin-magz.jtv-homepage .jtv-photo-gallery-controls .jtv-photo-gallery-arrow.is-prev,
    body.skin-magz.jtv-homepage .jtv-photo-gallery-controls .jtv-photo-gallery-arrow.is-next {
        position: static !important;
        inset: auto !important;
        width: 38px !important;
        height: 38px !important;
        transform: none !important;
        border: 0 !important;
        border-radius: 50% !important;
        background: rgba(62, 65, 20, .86) !important;
    }

    body.skin-magz.jtv-homepage .jtv-photo-gallery-controls .jtv-photo-gallery-arrow:hover:not(:disabled) {
        background: #0b6b3a !important;
        transform: scale(1.08) !important;
    }

    body.skin-magz.jtv-homepage .jtv-photo-gallery-controls .jtv-photo-gallery-arrow.is-pause {
        display: inline-flex !important;
    }

    @media (max-width: 1100px) and (min-width: 768px) {
        body.skin-magz.jtv-homepage .jtv-photo-gallery-controls {
            right: calc(41.8% + 8px) !important;
        }
    }

    @media (max-width: 767px) {
        body.skin-magz.jtv-homepage .jtv-photo-gallery-count {
            top: 10px !important;
            left: 10px !important;
            padding: 6px 10px !important;
            font-size: 14px !important;
        }

        body.skin-magz.jtv-homepage .jtv-photo-gallery-controls {
            top: 48px !important;
            right: 10px !important;
        }

        body.skin-magz.jtv-homepage .jtv-photo-gallery-controls .jtv-photo-gallery-arrow,
        body.skin-magz.jtv-homepage .jtv-photo-gallery-controls .jtv-photo-gallery-arrow.is-prev,
        body.skin-magz.jtv-homepage .jtv-photo-gallery-controls .jtv-photo-gallery-arrow.is-next {
            width: 32px !important;
            height: 32px !important;
        }

        body.skin-magz.jtv-homepage .jtv-photo-gallery-track {
            width: 100% !important;
        }

        body.skin-magz.jtv-homepage .jtv-photo-gallery-side {
            position: static !important;
            width: 100% !important;
            height: auto !important;
            margin-top: 10px !important;
        }

        body.skin-magz.jtv-homepage .jtv-photo-gallery-arrow.is-next {
            right: 6px !important;
        }
    }

    @media (max-width: 1100px) and (min-width: 768px) {
        body.skin-magz.jtv-homepage .jtv-photo-gallery-side {
            top: 45px !important;
            height: 416px !important;
        }
    }
</style>
@endpush

@push('styles')
<style>
    /* Final category heading visibility override. */
    body.skin-magz.jtv-homepage .jtv-category-heading h2 {
        display: inline-flex !important;
        flex: 0 0 auto !important;
        align-items: center !important;
        width: fit-content !important;
        height: auto !important;
        min-height: 0 !important;
        margin: 0 !important;
        padding: 4px 10px !important;
        overflow: visible !important;
        position: relative !important;
        z-index: 2 !important;
        visibility: visible !important;
        opacity: 1 !important;
        text-indent: 0 !important;
        color: #fff !important;
        background: #d71e27 !important;
        -webkit-text-fill-color: #fff !important;
        font-family: "Noto Sans Bengali", Arial, sans-serif !important;
        font-size: 14px !important;
        font-weight: 800 !important;
        line-height: 1.2 !important;
    }

    body.skin-magz.jtv-homepage .jtv-category-heading {
        display: flex !important;
        align-items: center !important;
        justify-content: flex-start !important;
        gap: 10px !important;
        min-height: 42px !important;
        padding: 0 12px 10px 0 !important;
        overflow: visible !important;
    }

    body.skin-magz.jtv-homepage .jtv-category-heading a {
        display: inline-flex !important;
        flex: 0 0 auto !important;
        align-items: center !important;
        position: relative !important;
        z-index: 2 !important;
        visibility: visible !important;
        opacity: 1 !important;
        color: #c9161d !important;
        background: transparent !important;
        white-space: nowrap !important;
    }

    body.skin-magz.jtv-homepage .jtv-category-section:nth-child(4n + 1) .jtv-category-heading h2 { background: #d71e27 !important; }
    body.skin-magz.jtv-homepage .jtv-category-section:nth-child(4n + 2) .jtv-category-heading h2 { background: #079447 !important; }
    body.skin-magz.jtv-homepage .jtv-category-section:nth-child(4n + 3) .jtv-category-heading h2 { background: #1565b4 !important; }
    body.skin-magz.jtv-homepage .jtv-category-section:nth-child(4n + 4) .jtv-category-heading h2 { background: #6339a5 !important; }

    body.skin-magz.jtv-homepage .jtv-category-card:first-child figure {
        height: clamp(155px, 15vw, 205px) !important;
    }

    @media (max-width: 767px) {
        body.skin-magz.jtv-homepage .jtv-category-heading {
            gap: 7px !important;
            padding-right: 0 !important;
        }

        body.skin-magz.jtv-homepage .jtv-category-heading h2 {
            max-width: calc(100% - 42px) !important;
            padding: 3px 8px !important;
            font-size: 14px !important;
            line-height: 1.2 !important;
            overflow-wrap: anywhere !important;
        }

        body.skin-magz.jtv-homepage .jtv-category-card:first-child figure {
            height: clamp(175px, 48vw, 235px) !important;
        }
    }

    /* Attachment-inspired Live TV panel. */
    body.skin-magz.jtv-homepage .jtv-live-tv-section {
        margin: 24px 0 !important;
        padding: 22px !important;
        overflow: hidden !important;
        border: 1px solid #e8eee9 !important;
        border-radius: 22px !important;
        background: linear-gradient(145deg, #ffffff 0%, #f7faf8 100%) !important;
        box-shadow: 0 12px 32px rgba(23, 72, 46, .08) !important;
    }

    body.skin-magz.jtv-homepage .jtv-live-tv-heading {
        display: flex !important;
        align-items: center !important;
        justify-content: space-between !important;
        gap: 18px !important;
        margin-bottom: 18px !important;
    }

    body.skin-magz.jtv-homepage .jtv-live-tv-title-wrap {
        display: flex !important;
        align-items: center !important;
        gap: 12px !important;
    }

    body.skin-magz.jtv-homepage .jtv-live-tv-icon {
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        width: 45px !important;
        height: 45px !important;
        border-radius: 14px !important;
        color: #fff !important;
        background: #d71924 !important;
        box-shadow: 0 7px 16px rgba(215, 25, 36, .2) !important;
        font-size: 19px !important;
    }

    body.skin-magz.jtv-homepage .jtv-live-tv-title-wrap h2 {
        margin: 0 0 2px !important;
        color: #173e2c !important;
        font-family: "Noto Sans Bengali", Arial, sans-serif !important;
        font-size: 25px !important;
        font-weight: 900 !important;
        line-height: 1.2 !important;
    }

    body.skin-magz.jtv-homepage .jtv-live-tv-title-wrap p {
        margin: 0 !important;
        color: #839188 !important;
        font-size: 12px !important;
    }

    body.skin-magz.jtv-homepage .jtv-live-tv-all {
        display: inline-flex !important;
        align-items: center !important;
        gap: 7px !important;
        color: #d71924 !important;
        font-family: "Noto Sans Bengali", Arial, sans-serif !important;
        font-size: 13px !important;
        font-weight: 800 !important;
        text-decoration: none !important;
        white-space: nowrap !important;
    }

    body.skin-magz.jtv-homepage .jtv-live-tv-all i {
        transition: transform .2s ease !important;
    }

    body.skin-magz.jtv-homepage .jtv-live-tv-all:hover i {
        transform: translateX(4px) !important;
    }

    body.skin-magz.jtv-homepage .jtv-live-tv-grid {
        display: grid !important;
        grid-template-columns: minmax(0, 1.15fr) minmax(390px, .85fr) !important;
        gap: 18px !important;
    }

    body.skin-magz.jtv-homepage .jtv-live-tv-featured,
    body.skin-magz.jtv-homepage .jtv-live-tv-side-card {
        overflow: hidden !important;
        border: 1px solid #e4ebe6 !important;
        border-radius: 16px !important;
        background: #fff !important;
    }

    body.skin-magz.jtv-homepage .jtv-live-tv-featured-media {
        display: block !important;
        position: relative !important;
        height: 330px !important;
        overflow: hidden !important;
        color: #fff !important;
        text-decoration: none !important;
        background: #173e2c !important;
    }

    body.skin-magz.jtv-homepage .jtv-live-tv-featured-media::after {
        position: absolute !important;
        right: 0 !important;
        bottom: 0 !important;
        left: 0 !important;
        height: 52% !important;
        content: "" !important;
        background: linear-gradient(transparent, rgba(7, 29, 19, .9)) !important;
    }

    body.skin-magz.jtv-homepage .jtv-live-tv-featured-media img {
        width: 100% !important;
        height: 100% !important;
        object-fit: cover !important;
        transition: transform .35s ease !important;
    }

    body.skin-magz.jtv-homepage .jtv-live-tv-featured-media:hover img,
    body.skin-magz.jtv-homepage .jtv-live-tv-side-thumb:hover img {
        transform: scale(1.04) !important;
    }

    body.skin-magz.jtv-homepage .jtv-live-tv-live-badge {
        position: absolute !important;
        z-index: 2 !important;
        top: 14px !important;
        left: 14px !important;
        padding: 5px 9px !important;
        border-radius: 5px !important;
        color: #fff !important;
        background: #d71924 !important;
        font-size: 10px !important;
        font-weight: 900 !important;
        letter-spacing: .05em !important;
    }

    body.skin-magz.jtv-homepage .jtv-live-tv-live-badge i {
        margin-right: 3px !important;
        font-size: 7px !important;
    }

    body.skin-magz.jtv-homepage .jtv-live-tv-play,
    body.skin-magz.jtv-homepage .jtv-live-tv-side-play {
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        border-radius: 50% !important;
        color: #d71924 !important;
        background: #fff !important;
        box-shadow: 0 7px 18px rgba(0, 0, 0, .2) !important;
    }

    body.skin-magz.jtv-homepage .jtv-live-tv-play {
        position: absolute !important;
        z-index: 2 !important;
        top: 50% !important;
        left: 50% !important;
        width: 58px !important;
        height: 58px !important;
        transform: translate(-50%, -50%) !important;
        font-size: 17px !important;
    }

    body.skin-magz.jtv-homepage .jtv-live-tv-play i {
        margin-left: 3px !important;
    }

    body.skin-magz.jtv-homepage .jtv-live-tv-featured-caption {
        display: flex !important;
        position: absolute !important;
        z-index: 2 !important;
        right: 20px !important;
        bottom: 17px !important;
        left: 20px !important;
        flex-direction: column !important;
        gap: 3px !important;
        padding-left: 12px !important;
        border-left: 3px solid #d71924 !important;
    }

    body.skin-magz.jtv-homepage .jtv-live-tv-featured-caption b {
        display: -webkit-box !important;
        overflow: hidden !important;
        color: #fff !important;
        font-family: "Noto Sans Bengali", Arial, sans-serif !important;
        font-size: 18px !important;
        line-height: 1.45 !important;
        -webkit-box-orient: vertical !important;
        -webkit-line-clamp: 2 !important;
    }

    body.skin-magz.jtv-homepage .jtv-live-tv-featured-caption small {
        color: rgba(255, 255, 255, .76) !important;
        font-size: 11px !important;
    }

    body.skin-magz.jtv-homepage .jtv-live-tv-side {
        display: grid !important;
        grid-template-rows: repeat(2, minmax(0, 1fr)) !important;
        gap: 18px !important;
        min-width: 0 !important;
    }

    body.skin-magz.jtv-homepage .jtv-live-tv-side-card {
        display: grid !important;
        grid-template-columns: 145px minmax(0, 1fr) 34px !important;
        align-items: center !important;
        gap: 14px !important;
        min-height: 156px !important;
        padding: 10px !important;
    }

    body.skin-magz.jtv-homepage .jtv-live-tv-side-thumb {
        display: block !important;
        position: relative !important;
        height: 134px !important;
        overflow: hidden !important;
        border-radius: 11px !important;
        background: #eaf1ec !important;
    }

    body.skin-magz.jtv-homepage .jtv-live-tv-side-thumb img {
        width: 100% !important;
        height: 100% !important;
        object-fit: cover !important;
        transition: transform .3s ease !important;
    }

    body.skin-magz.jtv-homepage .jtv-live-tv-side-play {
        position: absolute !important;
        right: 9px !important;
        bottom: 9px !important;
        width: 32px !important;
        height: 32px !important;
        font-size: 11px !important;
    }

    body.skin-magz.jtv-homepage .jtv-live-tv-side-content {
        min-width: 0 !important;
    }

    body.skin-magz.jtv-homepage .jtv-live-tv-category {
        display: inline-block !important;
        margin-bottom: 6px !important;
        color: #d71924 !important;
        font-family: "Noto Sans Bengali", Arial, sans-serif !important;
        font-size: 10px !important;
        font-weight: 800 !important;
    }

    body.skin-magz.jtv-homepage .jtv-live-tv-side-content h3 {
        display: -webkit-box !important;
        margin: 0 0 5px !important;
        overflow: hidden !important;
        color: #173e2c !important;
        font-family: "Noto Sans Bengali", Arial, sans-serif !important;
        font-size: 15px !important;
        line-height: 1.4 !important;
        -webkit-box-orient: vertical !important;
        -webkit-line-clamp: 2 !important;
    }

    body.skin-magz.jtv-homepage .jtv-live-tv-side-content h3 a {
        color: inherit !important;
        text-decoration: none !important;
    }

    body.skin-magz.jtv-homepage .jtv-live-tv-side-content p {
        display: -webkit-box !important;
        margin: 0 0 8px !important;
        overflow: hidden !important;
        color: #829087 !important;
        font-size: 11px !important;
        line-height: 1.45 !important;
        -webkit-box-orient: vertical !important;
        -webkit-line-clamp: 2 !important;
    }

    body.skin-magz.jtv-homepage .jtv-live-tv-meta {
        display: flex !important;
        flex-wrap: wrap !important;
        gap: 9px !important;
        color: #9aa69f !important;
        font-size: 10px !important;
    }

    body.skin-magz.jtv-homepage .jtv-live-tv-meta i {
        margin-right: 3px !important;
        color: #d71924 !important;
    }

    body.skin-magz.jtv-homepage .jtv-live-tv-side-arrow {
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        width: 31px !important;
        height: 31px !important;
        border: 1px solid #e5ebe7 !important;
        border-radius: 50% !important;
        color: #d71924 !important;
        background: #fff !important;
        font-size: 11px !important;
        text-decoration: none !important;
    }

    body.skin-magz.jtv-homepage .jtv-live-tv-empty {
        display: grid !important;
        height: 330px !important;
        place-items: center !important;
        color: #fff !important;
        background: #173e2c !important;
        font-family: "Noto Sans Bengali", Arial, sans-serif !important;
        font-size: 20px !important;
        font-weight: 800 !important;
    }

    @media (max-width: 991px) {
        body.skin-magz.jtv-homepage .jtv-live-tv-grid {
            grid-template-columns: minmax(0, 1fr) !important;
        }

        body.skin-magz.jtv-homepage .jtv-live-tv-featured-media,
        body.skin-magz.jtv-homepage .jtv-live-tv-empty {
            height: clamp(280px, 45vw, 380px) !important;
        }
    }

    @media (max-width: 575px) {
        body.skin-magz.jtv-homepage .jtv-live-tv-section {
            margin: 18px 0 !important;
            padding: 14px !important;
            border-radius: 16px !important;
        }

        body.skin-magz.jtv-homepage .jtv-live-tv-heading {
            align-items: flex-start !important;
            margin-bottom: 14px !important;
        }

        body.skin-magz.jtv-homepage .jtv-live-tv-icon {
            width: 38px !important;
            height: 38px !important;
            border-radius: 11px !important;
            font-size: 16px !important;
        }

        body.skin-magz.jtv-homepage .jtv-live-tv-title-wrap h2 {
            font-size: 20px !important;
        }

        body.skin-magz.jtv-homepage .jtv-live-tv-title-wrap p {
            font-size: 10px !important;
        }

        body.skin-magz.jtv-homepage .jtv-live-tv-all {
            font-size: 11px !important;
        }

        body.skin-magz.jtv-homepage .jtv-live-tv-featured-media,
        body.skin-magz.jtv-homepage .jtv-live-tv-empty {
            height: 245px !important;
        }

        body.skin-magz.jtv-homepage .jtv-live-tv-featured-caption {
            right: 14px !important;
            bottom: 13px !important;
            left: 14px !important;
        }

        body.skin-magz.jtv-homepage .jtv-live-tv-featured-caption b {
            font-size: 15px !important;
        }

        body.skin-magz.jtv-homepage .jtv-live-tv-side {
            gap: 12px !important;
        }

        body.skin-magz.jtv-homepage .jtv-live-tv-side-card {
            grid-template-columns: 92px minmax(0, 1fr) 28px !important;
            gap: 9px !important;
            min-height: 118px !important;
            padding: 8px !important;
        }

        body.skin-magz.jtv-homepage .jtv-live-tv-side-thumb {
            height: 100px !important;
        }

        body.skin-magz.jtv-homepage .jtv-live-tv-side-content h3 {
            font-size: 12px !important;
        }

        body.skin-magz.jtv-homepage .jtv-live-tv-side-content p {
            display: none !important;
        }

        body.skin-magz.jtv-homepage .jtv-live-tv-side-arrow {
            width: 27px !important;
            height: 27px !important;
        }
    }

    /* Match the reference: the complete latest-news header is green. */
    body.skin-magz.jtv-homepage .jtv-home-latest-tabs {
        min-height: 44px !important;
        border-bottom: 0 !important;
        background: #006b3f !important;
    }

    body.skin-magz.jtv-homepage .jtv-home-latest-tab-buttons,
    body.skin-magz.jtv-homepage .jtv-home-latest-tab-buttons button {
        height: 44px !important;
    }

    body.skin-magz.jtv-homepage .jtv-home-latest-tab-buttons button,
    body.skin-magz.jtv-homepage .jtv-home-latest-tab-buttons button.is-active,
    body.skin-magz.jtv-homepage .jtv-home-latest-more {
        color: #fff !important;
        background: transparent !important;
    }

    body.skin-magz.jtv-homepage .jtv-home-latest-tab-buttons button.is-active {
        background: #006b3f !important;
    }

    body.skin-magz.jtv-homepage .jtv-home-latest-more {
        display: inline-flex !important;
        height: 44px !important;
        align-items: center !important;
        padding: 0 14px !important;
        font-size: 12px !important;
        font-weight: 700 !important;
    }

    body.skin-magz.jtv-homepage .jtv-home-latest-more:hover,
    body.skin-magz.jtv-homepage .jtv-home-latest-more:focus {
        color: #f7dfaa !important;
        text-decoration: none !important;
    }

    /* Final navigation state: only the current page is deep red. */
    body.skin-magz.jtv-homepage nav.jtv-main-nav ul.nav-list > li > a {
        color: #fff !important;
        background: transparent !important;
    }

    body.skin-magz.jtv-homepage nav.jtv-main-nav ul.nav-list > li.active > a,
    body.skin-magz.jtv-homepage nav.jtv-main-nav ul.nav-list > li.current-menu-item > a,
    body.skin-magz.jtv-homepage nav.jtv-main-nav ul.nav-list > li.current_page_item > a {
        color: #fff !important;
        background: #9f1219 !important;
    }

    body.skin-magz.jtv-homepage nav.jtv-main-nav ul.nav-list > li.jtv-nav-home-link:not(.active) > a {
        color: #fff !important;
        background: transparent !important;
    }

    body.skin-magz.jtv-homepage nav.jtv-main-nav ul.nav-list > li:not(.active):not(.current-menu-item):not(.current_page_item):hover > a,
    body.skin-magz.jtv-homepage nav.jtv-main-nav ul.nav-list > li:not(.active):not(.current-menu-item):not(.current_page_item):focus-within > a {
        color: #f7dfaa !important;
        background: rgba(0, 45, 25, .28) !important;
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
    $categorySections = $topicCategories->map(function ($category) use ($jamunaPosts) {
        $posts = $jamunaPosts
            ->filter(fn ($post) => $post->categories->contains('id', $category->id))
            ->take(4)
            ->values();

        return compact('category', 'posts');
    })->filter(fn ($section) => $section['posts']->count() >= 2)->values();
    $topicIcons = ['fa-globe', 'fa-landmark', 'fa-chart-column', 'fa-earth-asia', 'fa-futbol', 'fa-film', 'fa-stethoscope', 'fa-graduation-cap'];
    $featuredVideo = $jamunaVideos->first();
    $videoList = $jamunaVideos->slice(1, 3);
    $videoTabOffsets = [
        'latest' => 0,
        'report' => 2,
        'documentary' => 4,
    ];
    $videoTabs = collect($videoTabOffsets)->mapWithKeys(function ($offset, $tabKey) use ($jamunaVideos) {
        $videos = $jamunaVideos->slice($offset)
            ->concat($jamunaVideos->take($offset))
            ->take(6)
            ->values();

        return [$tabKey => $videos];
    })->all();
    $socialLinks = collect(json_decode(config('settings.links') ?: '[]'));
    $referencePosts = $jamunaPosts->slice(16, 4)->values();
    $gallerySlides = $jamunaPosts->slice(4, 15)->values()->chunk(5)->values();
    $bnDigits = ['0' => '০', '1' => '১', '2' => '২', '3' => '৩', '4' => '৪', '5' => '৫', '6' => '৬', '7' => '৭', '8' => '৮', '9' => '৯'];
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

        @if($categorySections->isNotEmpty())
            <section class="jtv-category-sections" aria-label="বিভাগভিত্তিক সংবাদ">
                @foreach($categorySections as $section)
                    @php
                        $category = $section['category'];
                    @endphp
                    <section class="jtv-category-section">
                        <div class="jtv-category-heading">
                            <h2>{{ $category->name }}</h2>
                            <a href="{{ url('/categories/' . $category->slug) }}">সব <i class="fa-solid fa-arrow-right"></i></a>
                        </div>

                        <div class="jtv-category-grid">
                            @foreach($section['posts'] as $categoryPost)
                                <article class="jtv-category-card">
                                    <figure>
                                        <a href="{{ $postHelper::getUriPost($categoryPost) }}">
                                            <img src="{{ $postHelper::showThumbnail($categoryPost, 420) }}" alt="{{ $categoryPost->post_title }}" loading="lazy">
                                        </a>
                                    </figure>
                                    <h3><a href="{{ $postHelper::getUriPost($categoryPost) }}">{{ $categoryPost->post_title }}</a></h3>
                                    <p><i class="fa-regular fa-clock"></i>{{ $categoryPost->created_at->locale(app()->getLocale())->diffForHumans() }} <span>•</span> <i class="fa-regular fa-eye"></i>{{ number_format((int) ($categoryPost->post_hits ?: 3200) / 1000, 1) }}K</p>
                                </article>
                            @endforeach
                        </div>
                    </section>
                @endforeach
            </section>
        @endif

        <section class="jtv-location-finder" aria-labelledby="jtv-location-title">
            <div class="jtv-location-finder-copy">
                <h2 id="jtv-location-title">এলাকাভিত্তিক খবর</h2>
                <p>আপনার এলাকার সর্বশেষ সংবাদ দেখতে বিভাগ, জেলা এবং উপজেলা নির্বাচন করুন।</p>
            </div>
            <form class="jtv-location-finder-form" data-location-finder>
                <div class="jtv-location-field">
                    <label for="jtv-division">বিভাগ</label>
                    <select id="jtv-division" name="division" data-location-division>
                        <option value="">বিভাগ নির্বাচন করুন</option>
                    </select>
                </div>
                <div class="jtv-location-field">
                    <label for="jtv-district">জেলা</label>
                    <select id="jtv-district" name="district" data-location-district disabled>
                        <option value="">আগে বিভাগ নির্বাচন করুন</option>
                    </select>
                </div>
                <div class="jtv-location-field">
                    <label for="jtv-upazila">উপজেলা</label>
                    <select id="jtv-upazila" name="upazila" data-location-upazila disabled>
                        <option value="">আগে জেলা নির্বাচন করুন</option>
                    </select>
                </div>
                <button class="jtv-location-submit" type="submit"><i class="fa-solid fa-magnifying-glass"></i> খুঁজুন</button>
            </form>
        </section>

        @if($gallerySlides->isNotEmpty())
            <section class="jtv-photo-gallery" aria-label="ফটো গ্যালারি">
                <div class="jtv-photo-gallery-heading">
                    <h2>ছবি</h2>
                    <a href="{{ url('/news/latest') }}">সব <i class="fa-solid fa-chevron-right"></i></a>
                </div>
                <div class="jtv-photo-gallery-track" data-photo-gallery-track>
                    @foreach($gallerySlides as $slide)
                        @php
                            $featuredPhoto = $slide->first();
                        @endphp
                        <div class="jtv-photo-gallery-slide">
                            <article class="jtv-photo-gallery-featured">
                                <a href="{{ $postHelper::getUriPost($featuredPhoto) }}">
                                    <img src="{{ $postHelper::showThumbnail($featuredPhoto, 720) }}" alt="{{ $featuredPhoto->post_title }}" loading="lazy">
                                    <span class="jtv-photo-gallery-count">{{ strtr((string) $loop->iteration, $bnDigits) }} / {{ strtr((string) $gallerySlides->count(), $bnDigits) }}</span>
                                    <span class="jtv-photo-gallery-feature-caption">{{ $featuredPhoto->post_title }}</span>
                                </a>
                                <h3><a href="{{ $postHelper::getUriPost($featuredPhoto) }}">{{ $featuredPhoto->post_title }}</a></h3>
                            </article>
                        </div>
                    @endforeach
                </div>
                @php
                    $gallerySidePosts = $gallerySlides->first()->skip(1);
                @endphp
                <div class="jtv-photo-gallery-side">
                    @foreach($gallerySidePosts as $post)
                        <article class="jtv-photo-gallery-card">
                            <a href="{{ $postHelper::getUriPost($post) }}">
                                <img src="{{ $postHelper::showThumbnail($post, 420) }}" alt="{{ $post->post_title }}" loading="lazy">
                                <span class="jtv-photo-gallery-icon"><i class="fa-regular fa-image"></i></span>
                            </a>
                            <h3><a href="{{ $postHelper::getUriPost($post) }}">{{ $post->post_title }}</a></h3>
                        </article>
                    @endforeach
                </div>
                <div class="jtv-photo-gallery-controls" aria-label="স্লাইডার নিয়ন্ত্রণ">
                    <button type="button" class="jtv-photo-gallery-arrow is-prev" data-photo-gallery-prev aria-label="আগের ছবি"><i class="fa-solid fa-chevron-left"></i></button>
                    <button type="button" class="jtv-photo-gallery-arrow is-pause" data-photo-gallery-pause aria-label="স্লাইড থামান"><i class="fa-solid fa-pause"></i></button>
                    <button type="button" class="jtv-photo-gallery-arrow is-next" data-photo-gallery-next aria-label="পরের ছবি"><i class="fa-solid fa-chevron-right"></i></button>
                </div>
                <div class="jtv-photo-gallery-dots" data-photo-gallery-dots aria-hidden="true"></div>
            </section>
        @endif

        @if($referencePosts->isNotEmpty())
            <section class="jtv-reference-section" aria-label="বিশেষ সংবাদ">
                <div class="jtv-reference-heading">
                    <h2>বিশেষ সংবাদ</h2>
                    <a href="{{ url('/news/latest') }}">আরও দেখুন <i class="fa-solid fa-arrow-right"></i></a>
                </div>
                <div class="jtv-reference-news-grid">
                    @foreach($referencePosts as $post)
                        <article class="jtv-reference-news-card">
                            <figure>
                                <a href="{{ $postHelper::getUriPost($post) }}">
                                    <img src="{{ $postHelper::showThumbnail($post, 420) }}" alt="{{ $post->post_title }}" loading="lazy">
                                </a>
                            </figure>
                            <h3><a href="{{ $postHelper::getUriPost($post) }}">{{ $post->post_title }}</a></h3>
                            <div class="jtv-reference-news-meta">
                                <i class="fa-regular fa-clock"></i>{{ $post->created_at->locale(app()->getLocale())->diffForHumans() }}
                                <span>•</span>
                                <i class="fa-regular fa-eye"></i>{{ number_format((int) ($post->post_hits ?: 3200) / 1000, 1) }}K
                            </div>
                        </article>
                    @endforeach
                </div>
            </section>
        @endif

        @php
            $liveSideVideos = collect([
                $jamunaVideos->get(1) ?: $latestPosts->get(1),
                $jamunaVideos->get(2) ?: $latestPosts->get(2),
            ])->filter();
        @endphp
        <section class="jtv-live-tv-section" aria-label="লাইভ টিভি">
            <div class="jtv-live-tv-heading">
                <div class="jtv-live-tv-title-wrap">
                    <span class="jtv-live-tv-icon"><i class="fa-solid fa-tv"></i></span>
                    <div>
                        <h2>লাইভ টিভি</h2>
                        <p>সরাসরি দেখুন Jagoroni TV</p>
                    </div>
                </div>
                <a class="jtv-live-tv-all" href="{{ url('/live-tv') }}">সব দেখুন <i class="fa-solid fa-arrow-right"></i></a>
            </div>

            <div class="jtv-live-tv-grid">
                <article class="jtv-live-tv-featured">
                    @if($featuredVideo)
                        <a class="jtv-live-tv-featured-media" href="{{ $postHelper::getUriPost($featuredVideo) }}">
                            <img src="{{ $postHelper::showThumbnail($featuredVideo, 900) }}" alt="{{ $featuredVideo->post_title }}">
                            <span class="jtv-live-tv-live-badge"><i class="fa-solid fa-circle"></i> LIVE</span>
                            <span class="jtv-live-tv-play"><i class="fa-solid fa-play"></i></span>
                            <span class="jtv-live-tv-featured-caption"><b>{{ $featuredVideo->post_title }}</b><small>সরাসরি সম্প্রচার ও সর্বশেষ সংবাদ</small></span>
                        </a>
                    @else
                        <div class="jtv-live-tv-empty">জাগরণী টিভি লাইভ</div>
                    @endif
                </article>

                <div class="jtv-live-tv-side">
                    @foreach($liveSideVideos as $sideVideo)
                        <article class="jtv-live-tv-side-card">
                            <a class="jtv-live-tv-side-thumb" href="{{ $postHelper::getUriPost($sideVideo) }}">
                                <img src="{{ $postHelper::showThumbnail($sideVideo, 360) }}" alt="{{ $sideVideo->post_title }}" loading="lazy">
                                <span class="jtv-live-tv-side-play"><i class="fa-solid fa-play"></i></span>
                            </a>
                            <div class="jtv-live-tv-side-content">
                                <span class="jtv-live-tv-category">বিশেষ প্রতিবেদন</span>
                                <h3><a href="{{ $postHelper::getUriPost($sideVideo) }}">{{ $sideVideo->post_title }}</a></h3>
                                <p>{{ \Illuminate\Support\Str::limit(strip_tags($sideVideo->post_excerpt ?: 'জাগরণী টিভির সর্বশেষ সংবাদ ও প্রতিবেদন দেখুন।'), 85) }}</p>
                                <div class="jtv-live-tv-meta">
                                    <span><i class="fa-regular fa-clock"></i>{{ $sideVideo->created_at->locale(app()->getLocale())->diffForHumans() }}</span>
                                    <span><i class="fa-regular fa-eye"></i>{{ number_format((int) ($sideVideo->post_hits ?: 4800) / 1000, 1) }}K</span>
                                </div>
                            </div>
                            <a class="jtv-live-tv-side-arrow" href="{{ $postHelper::getUriPost($sideVideo) }}" aria-label="প্রতিবেদন দেখুন"><i class="fa-solid fa-arrow-right"></i></a>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        <section class="jtv-home-lower-grid">
            <div class="jtv-home-video-block">
                <div class="jtv-home-video-tabs">
                    <button type="button" class="jtv-home-video-tab is-active" data-video-tab="latest" aria-selected="true"><i class="fa-brands fa-youtube"></i>সর্বশেষ ভিডিও</button>
                    <button type="button" class="jtv-home-video-tab" data-video-tab="report" aria-selected="false">বিশেষ প্রতিবেদন</button>
                    <button type="button" class="jtv-home-video-tab" data-video-tab="documentary" aria-selected="false">তথ্যচিত্র</button>
                </div>

                @foreach($videoTabs as $tabKey => $tabVideos)
                    @php
                        $tabFeaturedVideo = $tabVideos->first();
                        $tabVideoList = $tabVideos->slice(1, 3);
                    @endphp
                    @if($tabFeaturedVideo)
                        <div class="jtv-home-video-layout{{ $tabKey !== 'latest' ? ' is-video-panel-hidden' : '' }}" data-video-panel="{{ $tabKey }}" aria-hidden="{{ $tabKey === 'latest' ? 'false' : 'true' }}">
                            <article class="jtv-home-video-feature">
                                <a class="jtv-home-video-feature-thumb" href="{{ $postHelper::getUriPost($tabFeaturedVideo) }}">
                                    <img src="{{ $postHelper::showThumbnail($tabFeaturedVideo, 720) }}" alt="{{ $tabFeaturedVideo->post_title }}">
                                    <span class="jtv-home-video-play"><i class="fa-solid fa-play"></i></span>
                                </a>
                            </article>

                            <div class="jtv-home-video-list">
                                @foreach($tabVideoList as $video)
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
                @endforeach
            </div>

            <div class="jtv-home-side-widgets">
                <div class="jtv-home-promo-card">
                    <div class="jtv-home-promo-inner">
                        <div class="jtv-home-promo-icon"><i class="fa-solid fa-tower-broadcast"></i></div>
                        <div>
                            <strong>জাগরণী টিভি</strong>
                            <span>সবার আগে, সব খবর</span>
                            <a class="jtv-home-promo-live-link" href="{{ url('/live-tv') }}">লাইভ দেখুন →</a>
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
        const locationFinder = document.querySelector('[data-location-finder]');

        if (locationFinder) {
            const divisionSelect = locationFinder.querySelector('[data-location-division]');
            const districtSelect = locationFinder.querySelector('[data-location-district]');
            const upazilaSelect = locationFinder.querySelector('[data-location-upazila]');
            const locationData = {
                'ঢাকা': ['ঢাকা', 'গাজীপুর', 'নরসিংদী', 'নারায়ণগঞ্জ', 'টাঙ্গাইল', 'কিশোরগঞ্জ', 'মানিকগঞ্জ', 'মুন্সিগঞ্জ', 'মাদারীপুর', 'রাজবাড়ী', 'শরীয়তপুর', 'ফরিদপুর', 'গোপালগঞ্জ'],
                'চট্টগ্রাম': ['চট্টগ্রাম', 'কক্সবাজার', 'কুমিল্লা', 'ফেনী', 'নোয়াখালী', 'লক্ষ্মীপুর', 'চাঁদপুর', 'ব্রাহ্মণবাড়িয়া', 'রাঙামাটি', 'খাগড়াছড়ি', 'বান্দরবান'],
                'রাজশাহী': ['রাজশাহী', 'নওগাঁ', 'নাটোর', 'চাঁপাইনবাবগঞ্জ', 'পাবনা', 'সিরাজগঞ্জ', 'বগুড়া', 'জয়পুরহাট'],
                'খুলনা': ['খুলনা', 'বাগেরহাট', 'সাতক্ষীরা', 'যশোর', 'ঝিনাইদহ', 'মাগুরা', 'নড়াইল', 'কুষ্টিয়া', 'চুয়াডাঙ্গা', 'মেহেরপুর'],
                'বরিশাল': ['বরিশাল', 'ভোলা', 'ঝালকাঠি', 'পটুয়াখালী', 'পিরোজপুর', 'বরগুনা'],
                'সিলেট': ['সিলেট', 'মৌলভীবাজার', 'হবিগঞ্জ', 'সুনামগঞ্জ'],
                'রংপুর': ['রংপুর', 'দিনাজপুর', 'কুড়িগ্রাম', 'গাইবান্ধা', 'ঠাকুরগাঁও', 'পঞ্চগড়', 'নীলফামারী', 'লালমনিরহাট'],
                'ময়মনসিংহ': ['ময়মনসিংহ', 'জামালপুর', 'নেত্রকোণা', 'শেরপুর']
            };
            const upazilaData = {
                'ঢাকা': ['সাভার', 'ধামরাই', 'দোহার', 'কেরানীগঞ্জ', 'নবাবগঞ্জ'],
                'গাজীপুর': ['গাজীপুর সদর', 'কালিয়াকৈর', 'কালীগঞ্জ', 'কাপাসিয়া', 'শ্রীপুর'],
                'চট্টগ্রাম': ['মীরসরাই', 'সীতাকুণ্ড', 'রাউজান', 'ফটিকছড়ি', 'পটিয়া', 'লোহাগাড়া'],
                'কক্সবাজার': ['কক্সবাজার সদর', 'চকরিয়া', 'টেকনাফ', 'উখিয়া', 'রামু'],
                'রাজশাহী': ['পবা', 'চারঘাট', 'বাঘা', 'পুঠিয়া', 'তানোর', 'মোহনপুর'],
                'খুলনা': ['দাকোপ', 'দিঘলিয়া', 'ডুমুরিয়া', 'কয়রা', 'পাইকগাছা', 'তেরখাদা'],
                'বরিশাল': ['বরিশাল সদর', 'আগৈলঝাড়া', 'বাকেরগঞ্জ', 'বানারীপাড়া', 'গৌরনদী', 'মেহেন্দিগঞ্জ'],
                'সিলেট': ['সিলেট সদর', 'বালাগঞ্জ', 'বিয়ানীবাজার', 'গোলাপগঞ্জ', 'জকিগঞ্জ', 'কানাইঘাট'],
                'রংপুর': ['রংপুর সদর', 'গংগাচড়া', 'কাউনিয়া', 'মিঠাপুকুর', 'পীরগাছা', 'তারাগঞ্জ'],
                'ময়মনসিংহ': ['ময়মনসিংহ সদর', 'ভালুকা', 'ত্রিশাল', 'ধোবাউড়া', 'ফুলবাড়ীয়া', 'গফরগাঁও']
            };

            const setOptions = function (select, items, placeholder) {
                select.innerHTML = '';
                const firstOption = document.createElement('option');
                firstOption.value = '';
                firstOption.textContent = placeholder;
                select.appendChild(firstOption);

                items.forEach(function (item) {
                    const option = document.createElement('option');
                    option.value = item;
                    option.textContent = item;
                    select.appendChild(option);
                });
            };

            setOptions(divisionSelect, Object.keys(locationData), 'বিভাগ নির্বাচন করুন');

            divisionSelect.addEventListener('change', function () {
                const districts = locationData[divisionSelect.value] || [];
                setOptions(districtSelect, districts, districts.length ? 'জেলা নির্বাচন করুন' : 'জেলা পাওয়া যায়নি');
                setOptions(upazilaSelect, [], 'আগে জেলা নির্বাচন করুন');
                districtSelect.disabled = districts.length === 0;
                upazilaSelect.disabled = true;
            });

            districtSelect.addEventListener('change', function () {
                const district = districtSelect.value;
                const upazilas = upazilaData[district] || [district + ' সদর', district + ' পৌরসভা'];
                setOptions(upazilaSelect, upazilas, 'উপজেলা নির্বাচন করুন');
                upazilaSelect.disabled = !district;
            });

            locationFinder.addEventListener('submit', function (event) {
                event.preventDefault();
                const division = divisionSelect.value;
                const district = districtSelect.value;
                const upazila = upazilaSelect.value;

                if (!division || !district || !upazila) {
                    (upazila || district || division ? upazilaSelect : divisionSelect).focus();
                    return;
                }

                const query = new URLSearchParams({ division, district, upazila });
                window.location.href = '{{ url('/search') }}?' + query.toString();
            });
        }

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

        document.querySelectorAll('.jtv-home-video-block').forEach(function (videoBlock) {
            const tabs = videoBlock.querySelectorAll('[data-video-tab]');

            tabs.forEach(function (tab) {
                tab.addEventListener('click', function () {
                    tabs.forEach(function (button) {
                        const isActive = button === tab;
                        button.classList.toggle('is-active', isActive);
                        button.setAttribute('aria-selected', isActive ? 'true' : 'false');
                    });

                    videoBlock.querySelectorAll('[data-video-panel]').forEach(function (videoPanel) {
                        const isActivePanel = videoPanel.getAttribute('data-video-panel') === tab.getAttribute('data-video-tab');
                        videoPanel.classList.toggle('is-video-panel-hidden', !isActivePanel);
                        videoPanel.setAttribute('aria-hidden', isActivePanel ? 'false' : 'true');
                    });
                });
            });
        });

        document.querySelectorAll('.jtv-photo-gallery').forEach(function (gallery) {
            const track = gallery.querySelector('[data-photo-gallery-track]');
            const previous = gallery.querySelector('[data-photo-gallery-prev]');
            const pause = gallery.querySelector('[data-photo-gallery-pause]');
            const next = gallery.querySelector('[data-photo-gallery-next]');
            const dots = gallery.querySelector('[data-photo-gallery-dots]');

            if (!track || !previous || !pause || !next || !dots) {
                return;
            }

            const slides = Array.from(track.querySelectorAll('.jtv-photo-gallery-slide'));
            let pageCount = slides.length || 1;
            let currentPage = 0;
            let autoSlideTimer = null;
            let isPaused = false;

            const getPageCount = function () {
                return Math.max(1, slides.length);
            };

            const renderDots = function () {
                pageCount = getPageCount();
                currentPage = Math.min(currentPage, pageCount - 1);
                dots.innerHTML = '';

                for (let index = 0; index < pageCount; index += 1) {
                    const dot = document.createElement('span');
                    dot.classList.toggle('is-active', index === currentPage);
                    dots.appendChild(dot);
                }

                dots.hidden = pageCount <= 1;
                previous.disabled = pageCount <= 1;
                next.disabled = pageCount <= 1;
                pause.disabled = pageCount <= 1;
            };

            const updateSlider = function (page) {
                pageCount = getPageCount();
                currentPage = Math.max(0, Math.min(page, pageCount - 1));
                const slide = slides[currentPage];
                track.scrollTo({ left: slide ? slide.offsetLeft : 0, behavior: 'smooth' });

                Array.from(dots.children).forEach(function (dot, index) {
                    dot.classList.toggle('is-active', index === currentPage);
                });
            };

            previous.addEventListener('click', function () {
                updateSlider(currentPage - 1);
                restartAutoSlide();
            });

            next.addEventListener('click', function () {
                updateSlider(currentPage + 1);
                restartAutoSlide();
            });

            pause.addEventListener('click', function () {
                isPaused = !isPaused;
                pause.innerHTML = isPaused
                    ? '<i class="fa-solid fa-play"></i>'
                    : '<i class="fa-solid fa-pause"></i>';
                pause.setAttribute('aria-label', isPaused ? 'স্লাইড চালু করুন' : 'স্লাইড থামান');
                restartAutoSlide();
            });

            track.addEventListener('scroll', function () {
                const page = slides.reduce(function (closest, slide, index) {
                    const currentDistance = Math.abs(track.scrollLeft - slide.offsetLeft);
                    const closestDistance = Math.abs(track.scrollLeft - slides[closest].offsetLeft);

                    return currentDistance < closestDistance ? index : closest;
                }, 0);

                if (page !== currentPage) {
                    currentPage = Math.max(0, Math.min(page, pageCount - 1));
                    Array.from(dots.children).forEach(function (dot, index) {
                        dot.classList.toggle('is-active', index === currentPage);
                    });
                }
            }, { passive: true });

            renderDots();
            window.addEventListener('resize', renderDots);

            const restartAutoSlide = function () {
                window.clearInterval(autoSlideTimer);

                if (pageCount <= 1 || isPaused) {
                    return;
                }

                autoSlideTimer = window.setInterval(function () {
                    updateSlider(currentPage + 1 >= pageCount ? 0 : currentPage + 1);
                }, 5000);
            };

            restartAutoSlide();
        });
    });
</script>
@endpush
