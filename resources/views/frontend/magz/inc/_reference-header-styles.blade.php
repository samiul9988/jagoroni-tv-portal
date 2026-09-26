@once
<style>
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

body.skin-magz.jtv-homepage .jtv-topbar-title {
            white-space: normal !important;
        }

body.skin-magz.jtv-homepage .jtv-topbar-search input {
            width: 88px !important;
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

body.skin-magz.jtv-homepage,
    body.skin-magz.jtv-homepage header.primary,
    body.skin-magz.jtv-homepage main.jtv-home-clone,
    body.skin-magz.jtv-homepage .jtv-home-shell {
        width: 100% !important;
        max-width: none !important;
        min-width: 0 !important;
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

@media (min-width: 768px) and (max-width: 1199px) {
body.skin-magz.jtv-homepage .jtv-masthead-inner {
            grid-template-columns: minmax(210px, 1.1fr) minmax(180px, 1fr) minmax(180px, .8fr) !important;
            text-align: left !important;
        }
}

@media (max-width: 767px) {
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
}

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
@endonce
